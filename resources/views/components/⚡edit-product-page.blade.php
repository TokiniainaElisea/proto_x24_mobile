<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Camera\PhotoTaken;
use Native\Mobile\Events\Gallery\MediaSelected;
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\File;

new class extends Component
{
    public Product $product;

    // Champs
    public string $name_product = '';
    public string $reference = '';
    public string $price = '';
    public string $id_provider = '';
    public string $id_category = '';
    public string $size = '';
    public string $color = '';
    public string $matter = '';

    // Image
    public ?string $currentImagePath = null; // image actuelle en DB
    public ?string $tempPhotoPath = null;    // nouvelle photo (temporaire device)
    public bool $removeCurrentImage = false;
    public string $message = '';
    public string $messageType = 'info';

    public $providers = [];
    public $categories = [];

    public function mount(Product $product): void
    {
        $product->loadMissing(['detail', 'provider', 'category']);

        $this->product = $product;
        $this->name_product = $product->name_product ?? '';
        $this->reference = $product->reference ?? '';
        $this->price = (string) ($product->price ?? '');
        $this->id_provider = (string) ($product->provider_id ?? '');
        $this->id_category = (string) ($product->category_id ?? '');
        $this->size = $product->detail->size ?? '';
        $this->color = $product->detail->color ?? '';
        $this->matter = $product->detail->matter ?? '';
        $this->currentImagePath = $product->image_path ?: null;

        $this->providers = Provider::orderBy('name_provider')->get();
        $this->categories = Category::orderBy('name_category')->get();
    }

    // ---- Caméra / Galerie ----
    public function takePhoto(): void
    {
        Camera::getPhoto()->id('product-edit-photo');
    }

    public function pickFromGallery(): void
    {
        Camera::pickImages('images', false)->id('product-edit-photo');
    }

    #[OnNative(PhotoTaken::class)]
    public function handlePhotoTaken(string $path, string $mimeType = 'image/jpeg', ?string $id = null): void
    {
        if ($id && $id !== 'product-edit-photo') {
            return;
        }

        $this->tempPhotoPath = $path;
        $this->removeCurrentImage = false;
        $this->message = 'Nouvelle photo capturée : ' . basename($path);
        $this->messageType = 'success';
    }

    #[OnNative(MediaSelected::class)]
    public function handleMediaSelected($success, $files = [], $count = 0, ?string $id = null): void
    {
        if (is_array($success) && isset($success['files'])) {
            $payload = $success;
            $files = $payload['files'] ?? [];
            $id = $payload['id'] ?? $id;
            $success = $payload['success'] ?? true;
        }

        if (!$success || empty($files)) {
            $this->message = 'Aucune image sélectionnée';
            $this->messageType = 'warning';
            return;
        }

        if ($id && $id !== 'product-edit-photo') {
            return;
        }

        $file = is_array($files[0]) ? $files[0] : ['path' => $files[0]];
        $path = $file['path'] ?? null;

        if (!$path) {
            $this->message = 'Chemin image introuvable';
            $this->messageType = 'danger';
            return;
        }

        $this->tempPhotoPath = $path;
        $this->removeCurrentImage = false;
        $this->message = 'Nouvelle image sélectionnée : ' . basename($path);
        $this->messageType = 'success';
    }

    public function clearNewPhoto(): void
    {
        $this->tempPhotoPath = null;
        $this->message = 'Nouvelle photo annulée';
        $this->messageType = 'info';
    }

    public function markRemoveCurrentImage(): void
    {
        $this->removeCurrentImage = true;
        $this->tempPhotoPath = null;
        $this->message = 'L\'image actuelle sera supprimée à l\'enregistrement';
        $this->messageType = 'warning';
    }

    public function cancelRemoveCurrentImage(): void
    {
        $this->removeCurrentImage = false;
        $this->message = '';
    }

    // ---- Update ----
    public function update(): void
    {
        $this->validate([
            'name_product' => 'required|string|max:255',
            'reference'    => 'required|string|max:100',
            'price'        => 'required|numeric|min:0',
            'id_provider'  => 'required|exists:providers,id',
            'id_category'  => 'required|exists:categories,id',
            'size'         => 'nullable|string|max:50',
            'color'        => 'nullable|string|max:50',
            'matter'       => 'nullable|string|max:100',
        ]);

        $product = Product::with('detail')->findOrFail($this->product->id);

        // --- Gestion image ---
        if ($this->tempPhotoPath) {
            // Nouvelle photo → supprimer l'ancienne puis sauver la nouvelle
            $this->deleteOldImage($product->image_path);

            $newPath = $this->savePhoto($this->tempPhotoPath);
            if ($newPath !== '') {
                $product->image_path = $newPath;
            }
        } elseif ($this->removeCurrentImage) {
            // Suppression sans remplacement
            $this->deleteOldImage($product->image_path);
            $product->image_path = '';
        }

        // --- Infos produit ---
        $product->update([
            'name_product' => $this->name_product,
            'reference'    => $this->reference,
            'price'        => $this->price,
            'provider_id'  => $this->id_provider,
            'category_id'  => $this->id_category,
            'image_path'   => $product->image_path,
        ]);

        // --- Détails ---
        if ($product->detail) {
            $product->detail->update([
                'size'   => $this->size,
                'color'  => $this->color,
                'matter' => $this->matter,
            ]);
        }

        session()->flash('success', 'Modification(s) effectuée(s)');

        $this->redirect(route('produits'), navigate: true);
    }

    protected function deleteOldImage(?string $relativePath): void
    {
        if (empty($relativePath)) {
            return;
        }

        // Ne pas supprimer le placeholder
        if (str_contains($relativePath, 'sans.png')) {
            return;
        }

        $fullPath = base_path('public/' . ltrim($relativePath, '/'));

        if (file_exists($fullPath)) {
            @unlink($fullPath);
            return;
        }

        // Fallback Storage public
        try {
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
        } catch (\Throwable $e) {
            // ignore
        }
    }

    protected function savePhoto(string $tempPath): string
    {
        $filename = time() . '_' . uniqid() . '.jpg';
        $relativePath = 'uploads/product/' . $filename;

        $destinationDir = base_path('public/uploads/product');
        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0777, true);
        }
        $destination = $destinationDir . DIRECTORY_SEPARATOR . $filename;

        // 1) File::move (native:run)
        try {
            $result = File::move($tempPath, $destination);
            $ok = $result === true || (is_array($result) && ($result['success'] ?? false));
            if ($ok) {
                return $relativePath;
            }
        } catch (\Throwable $e) {
            // continue
        }

        // 2) PHP classique
        if (file_exists($tempPath)) {
            $contents = @file_get_contents($tempPath);
            if ($contents !== false && file_put_contents($destination, $contents) !== false) {
                @unlink($tempPath);
                return $relativePath;
            }
        }

        // 3) Storage
        try {
            if (file_exists($tempPath)) {
                Storage::disk('public')->put('uploads/product/' . $filename, file_get_contents($tempPath));
                @unlink($tempPath);
                return 'uploads/product/' . $filename;
            }
        } catch (\Throwable $e) {
            // ignore
        }

        $this->message = 'Nouvelle photo non accessible (mode Jump ?). Les autres champs seront quand même mis à jour.';
        $this->messageType = 'warning';

        return '';
    }

    public function getDisplayImageProperty(): string
    {
        if ($this->removeCurrentImage && !$this->tempPhotoPath) {
            return asset('uploads/product/sans.png');
        }

        if ($this->currentImagePath && !$this->removeCurrentImage) {
            return asset($this->currentImagePath);
        }

        return asset('uploads/product/sans.png');
    }
};
?>

<div class="container">
    {{-- En-tête --}}
    <div class="d-flex justify-content-between align-items-center my-3">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-pencil-square text-warning me-2"></i>
                Modifier le produit
            </h2>
        </div>
        <a href="{{ route('produits') }}" class="btn btn-outline-secondary" wire:navigate>
            <i class="bi bi-arrow-left me-1"></i>
        </a>
    </div>

    @if ($message)
        <div class="alert alert-{{ $messageType }} alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" wire:click="$set('message', '')"></button>
        </div>
    @endif

    <form wire:submit="update">
        {{-- Informations générales --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Informations générales
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    {{-- Image --}}
                    <div class="col-lg-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-image me-1 text-primary"></i>
                            Image actuelle
                        </label>

                        <div class="bg-light rounded p-3 text-center mb-3">
                            <img
                                src="{{ $this->displayImage }}"
                                alt="{{ $name_product }}"
                                class="img-fluid rounded"
                                style="height: 220px; width: 100%; object-fit: contain;"
                            >

                            @if ($tempPhotoPath)
                                <div class="mt-2 small text-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Nouvelle photo prête : {{ basename($tempPhotoPath) }}
                                </div>
                            @elseif ($removeCurrentImage)
                                <div class="mt-2 small text-warning">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    Image sera supprimée
                                </div>
                            @endif
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <div class="btn-group w-100">
                                <button type="button" class="btn btn-outline-primary btn-sm" wire:click="takePhoto">
                                    <i class="bi bi-camera me-1"></i> Caméra
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="pickFromGallery">
                                    <i class="bi bi-images me-1"></i> Galerie
                                </button>
                            </div>

                            @if ($tempPhotoPath)
                                <button type="button" class="btn btn-outline-warning btn-sm" wire:click="clearNewPhoto">
                                    <i class="bi bi-x-circle me-1"></i> Annuler la nouvelle photo
                                </button>
                            @elseif ($currentImagePath && !$removeCurrentImage)
                                <button type="button" class="btn btn-outline-danger btn-sm" wire:click="markRemoveCurrentImage">
                                    <i class="bi bi-trash me-1"></i> Supprimer l'image actuelle
                                </button>
                            @elseif ($removeCurrentImage)
                                <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="cancelRemoveCurrentImage">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Garder l'image actuelle
                                </button>
                            @endif
                        </div>

                        <small class="text-muted d-block mt-2">
                            Laissez tel quel pour conserver l'image actuelle.
                        </small>
                    </div>

                    {{-- Infos --}}
                    <div class="col-lg-8">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name_product" class="form-label fw-semibold">
                                    <i class="bi bi-box-seam me-1 text-primary"></i>
                                    Nom du produit
                                </label>
                                <input type="text" id="name_product" wire:model="name_product"
                                       class="form-control @error('name_product') is-invalid @enderror">
                                @error('name_product')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="reference" class="form-label fw-semibold">
                                    <i class="bi bi-upc-scan me-1 text-primary"></i>
                                    Référence
                                </label>
                                <input type="text" id="reference" wire:model="reference"
                                       class="form-control @error('reference') is-invalid @enderror">
                                @error('reference')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label fw-semibold">
                                    <i class="bi bi-cash-stack me-1 text-success"></i>
                                    Prix de vente
                                </label>
                                <div class="input-group">
                                    <input type="number" id="price" wire:model="price" step="any"
                                           class="form-control @error('price') is-invalid @enderror">
                                    <span class="input-group-text">Ar</span>
                                </div>
                                @error('price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="id_category" class="form-label fw-semibold">
                                    <i class="bi bi-tags-fill me-1 text-info"></i>
                                    Catégorie
                                </label>
                                <select id="id_category" wire:model="id_category"
                                        class="form-select @error('id_category') is-invalid @enderror">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name_category }}</option>
                                    @endforeach
                                </select>
                                @error('id_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Caractéristiques --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="bi bi-sliders me-2"></i>
                    Caractéristiques du produit
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="size" class="form-label fw-semibold">
                            <i class="bi bi-rulers me-1 text-primary"></i>
                            Taille
                        </label>
                        <input type="text" id="size" wire:model="size"
                               class="form-control @error('size') is-invalid @enderror">
                        @error('size')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="color" class="form-label fw-semibold">
                            <i class="bi bi-palette-fill me-1 text-warning"></i>
                            Couleur
                        </label>
                        <input type="text" id="color" wire:model="color"
                               class="form-control @error('color') is-invalid @enderror">
                        @error('color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="matter" class="form-label fw-semibold">
                            <i class="bi bi-layers-fill me-1 text-secondary"></i>
                            Matière
                        </label>
                        <input type="text" id="matter" wire:model="matter"
                               class="form-control @error('matter') is-invalid @enderror">
                        @error('matter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="id_provider" class="form-label fw-semibold">
                            <i class="bi bi-truck me-1 text-info"></i>
                            Fournisseur
                        </label>
                        <select id="id_provider" wire:model="id_provider"
                                class="form-select @error('id_provider') is-invalid @enderror">
                            @foreach ($providers as $provider)
                                <option value="{{ $provider->id }}">{{ $provider->name_provider }}</option>
                            @endforeach
                        </select>
                        @error('id_provider')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Stock (info seulement) --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="bi bi-boxes me-2"></i>
                    Stock
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-0 d-flex align-items-center">
                    <i class="bi bi-info-circle-fill fs-5 me-2"></i>
                    <div>
                        La quantité en stock et le prix fournisseur sont gérés
                        depuis la section <strong>Gestion du stock</strong>.
                        <a href="{{ route('show_mouvement', $product) }}" class="alert-link" wire:navigate>
                            Gérer le stock
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('produits') }}" class="btn btn-outline-secondary" wire:navigate>
                <i class="bi bi-x-circle me-1"></i>
                Annuler
            </a>
            <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="update">
                    <i class="bi bi-floppy-fill me-1"></i>
                    Enregistrer les modifications
                </span>
                <span wire:loading wire:target="update">
                    <span class="spinner-border spinner-border-sm me-1"></span>
                    Enregistrement...
                </span>
            </button>
        </div>
    </form>
</div>