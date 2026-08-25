<?php

use App\Models\Category;
use App\Models\Detail;
use App\Models\Mouvement;
use App\Models\Numbering;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Camera\PhotoTaken;
use Native\Mobile\Events\Gallery\MediaSelected;
use Native\Mobile\Facades\Camera;

new class extends Component {
    // ---- Champs du formulaire ----
    public string $name_product = '';
    public string $price = '';
    public string $id_provider = '';
    public string $enter_date = '';
    public string $initial_quantity = '';
    public string $provider_price = '';
    public string $id_category = '';
    public string $size = '';
    public string $color = '';
    public string $matter = '';

    // ---- Photo ----
    public ?string $tempPhotoPath = null; // chemin temporaire device
    public string $message = '';
    public string $messageType = 'info';

    public $providers = [];
    public $categories = [];

    public function mount(): void
    {
        $this->providers = Provider::orderBy('name_provider')->get();
        $this->categories = Category::orderBy('name_category')->get();
        $this->enter_date = now()->format('Y-m-d');

        if ($this->providers->isNotEmpty()) {
            $this->id_provider = (string) $this->providers->first()->id;
        }
        if ($this->categories->isNotEmpty()) {
            $this->id_category = (string) $this->categories->first()->id;
        }
    }

    // ---- Caméra ----
    public function takePhoto(): void
    {
        Camera::getPhoto()->id('product-photo');
    }

    // ---- Galerie ----
    public function pickFromGallery(): void
    {
        Camera::pickImages('images', false)->id('product-photo');
    }

    #[OnNative(PhotoTaken::class)]
    public function handlePhotoTaken(string $path, string $mimeType = 'image/jpeg', ?string $id = null): void
    {
        if ($id && $id !== 'product-photo') {
            return;
        }

        $this->tempPhotoPath = $path;
        $this->message = 'Photo capturée : ' . basename($path);
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

        if ($id && $id !== 'product-photo') {
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
        $this->message = 'Image sélectionnée : ' . basename($path);
        $this->messageType = 'success';
    }

    public function removePhoto(): void
    {
        $this->tempPhotoPath = null;
        $this->message = 'Photo retirée';
        $this->messageType = 'info';
    }

    // ---- Enregistrement ----
    public function store(): void
    {
        $this->validate([
            'name_product' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'id_provider' => 'required|exists:providers,id',
            'enter_date' => 'required|date',
            'initial_quantity' => 'required|integer|min:1',
            'provider_price' => 'required|numeric|min:0',
            'id_category' => 'required|exists:categories,id',
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'matter' => 'nullable|string|max:100',
        ]);

        // Chemin/URL complète à stocker en BDD (ex: /_assets/storage/uploads/product/xxx.jpg)
        $imagePathForDb = '';

        if ($this->tempPhotoPath) {
            $imagePathForDb = $this->savePhoto($this->tempPhotoPath);
        }

        $detail = Detail::create([
            'size' => $this->size,
            'color' => $this->color,
            'matter' => $this->matter,
        ]);

        $productPrefix = Numbering::first() ?? 'PRD';

        $product = Product::create([
            'name_product' => $this->name_product,
            'price' => $this->price,
            'provider_id' => $this->id_provider,
            'image_path' => $imagePathForDb, // URL complète utilisable en src
            'category_id' => $this->id_category,
            'detail_id' => $detail->id,
        ]);

        if (is_string($productPrefix)) {
            $product->update(['reference' => $productPrefix . $product->id]);
        } else {
            $product->update(['reference' => $productPrefix->product_prefix . $product->id]);
        }

        Mouvement::create([
            'enter_date' => $this->enter_date,
            'initial_quantity' => $this->initial_quantity,
            'in_stock' => $this->initial_quantity,
            'provider_price' => $this->provider_price,
            'product_id' => $product->id,
        ]);

        session()->flash('success', 'Nouveau produit ajouté');

        $this->redirect(route('produits'), navigate: true);
    }

    /**
     * Copie la photo temporaire vers le stockage persistant
     * et retourne l'URL complète à mettre en BDD.
     */
    protected function savePhoto(string $tempPath): string
    {
        $filename = time() . '_' . uniqid() . '.jpg';
        $relativePath = 'uploads/product/' . $filename;

        if (!is_string($tempPath) || $tempPath === '' || !file_exists($tempPath)) {
            $this->message = 'Photo temporaire introuvable.';
            $this->messageType = 'danger';
            return '';
        }

        $contents = @file_get_contents($tempPath);
        if ($contents === false || $contents === '') {
            $this->message = 'Impossible de lire la photo.';
            $this->messageType = 'danger';
            return '';
        }

        // 1) Disque persistant NativePHP
        try {
            $ok = Storage::disk('mobile_public')->put($relativePath, $contents);
            if ($ok) {
                @unlink($tempPath);

                // URL complète → à stocker en BDD et utiliser directement en <img src="...">
                return Storage::disk('mobile_public')->url($relativePath);
            }
        } catch (\Throwable $e) {
            // continue
        }

        // 2) Fallback disque public Laravel (même root storage/app/public)
        try {
            $ok = Storage::disk('public')->put($relativePath, $contents);
            if ($ok) {
                @unlink($tempPath);

                return Storage::disk('public')->url($relativePath);
            }
        } catch (\Throwable $e) {
            // ignore
        }

        $this->message = 'Impossible d\'enregistrer la photo. Produit sans image.';
        $this->messageType = 'warning';

        return '';
    }

    public function resetForm(): void
    {
        $this->reset(['name_product', 'price', 'enter_date', 'initial_quantity', 'provider_price', 'size', 'color', 'matter', 'tempPhotoPath', 'message']);
        $this->enter_date = now()->format('Y-m-d');
        $this->messageType = 'info';
    }
};
?>

<div class="container">
    {{-- En-tête --}}
    <div class="d-flex justify-content-between align-items-center my-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-box-seam-fill text-primary me-2"></i>
                Nouveau produit
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

    <form wire:submit="store">
        {{-- Informations générales --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Informations générales
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    {{-- Photo --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-image me-1 text-primary"></i>
                            Photo du produit
                        </label>

                        <div class="d-flex flex-column gap-2">
                            <div class="btn-group w-100">
                                <button type="button" class="btn btn-outline-primary" wire:click="takePhoto">
                                    <i class="bi bi-camera me-1"></i> Caméra
                                </button>
                                <button type="button" class="btn btn-outline-secondary" wire:click="pickFromGallery">
                                    <i class="bi bi-images me-1"></i> Galerie
                                </button>
                            </div>

                            @if ($tempPhotoPath)
                                <div class="border rounded p-2 bg-light">
                                    <div class="small text-muted mb-1 text-truncate">
                                        {{ basename($tempPhotoPath) }}
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger w-100"
                                        wire:click="removePhoto">
                                        <i class="bi bi-trash me-1"></i> Retirer
                                    </button>
                                </div>
                            @else
                                <div class="border rounded p-3 text-center text-muted small">
                                    Aucune photo sélectionnée
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Nom --}}
                    <div class="col-md-8">
                        <label for="name_product" class="form-label fw-semibold">
                            <i class="bi bi-box-seam me-1 text-primary"></i>
                            Nom du produit
                        </label>
                        <input type="text" id="name_product" wire:model="name_product"
                            class="form-control @error('name_product') is-invalid @enderror"
                            placeholder="Ex : T-shirt classique">
                        @error('name_product')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Prix --}}
                    <div class="col-md-6">
                        <label for="price" class="form-label fw-semibold">
                            <i class="bi bi-cash-stack me-1 text-success"></i>
                            Prix de vente
                        </label>
                        <div class="input-group">
                            <input type="number" id="price" wire:model="price"
                                class="form-control @error('price') is-invalid @enderror" placeholder="0"
                                step="any">
                            <span class="input-group-text">Ar</span>
                        </div>
                        @error('price')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Fournisseur --}}
                    <div class="col-12">
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

        {{-- Approvisionnement --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="bi bi-box-arrow-in-down me-2"></i>
                    Approvisionnement
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="enter_date" class="form-label fw-semibold">
                            <i class="bi bi-calendar-event me-1 text-primary"></i>
                            Date d'approvisionnement
                        </label>
                        <input type="date" id="enter_date" wire:model="enter_date"
                            class="form-control @error('enter_date') is-invalid @enderror">
                        @error('enter_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="initial_quantity" class="form-label fw-semibold">
                            <i class="bi bi-boxes me-1 text-info"></i>
                            Quantité initiale
                        </label>
                        <input type="number" id="initial_quantity" wire:model="initial_quantity"
                            class="form-control @error('initial_quantity') is-invalid @enderror" placeholder="0">
                        @error('initial_quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="provider_price" class="form-label fw-semibold">
                            <i class="bi bi-cash-coin me-1 text-success"></i>
                            Prix fournisseur
                        </label>
                        <div class="input-group">
                            <input type="number" id="provider_price" wire:model="provider_price"
                                class="form-control @error('provider_price') is-invalid @enderror" placeholder="0"
                                step="any">
                            <span class="input-group-text">Ar</span>
                        </div>
                        @error('provider_price')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
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
                        <label for="id_category" class="form-label fw-semibold">
                            <i class="bi bi-tags-fill me-1 text-info"></i>
                            Catégorie
                        </label>
                        <select id="id_category" wire:model="id_category"
                            class="form-select @error('id_category') is-invalid @enderror">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                            @endforeach
                        </select>
                        @error('id_category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="size" class="form-label fw-semibold">
                            <i class="bi bi-rulers me-1 text-primary"></i>
                            Taille
                        </label>
                        <input type="text" id="size" wire:model="size"
                            class="form-control @error('size') is-invalid @enderror" placeholder="Ex : M, L, XL...">
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
                            class="form-control @error('color') is-invalid @enderror" placeholder="Ex : Noir">
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
                            class="form-control @error('matter') is-invalid @enderror" placeholder="Ex : Coton">
                        @error('matter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="d-flex justify-content-end gap-2 mb-5">
            <button type="button" class="btn btn-outline-danger" wire:click="resetForm">
                <i class="bi bi-arrow-counterclockwise me-1"></i>
                Effacer
            </button>
            <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="store">
                    <i class="bi bi-plus-circle-fill me-1"></i>
                    Ajouter le produit
                </span>
                <span wire:loading wire:target="store">
                    <span class="spinner-border spinner-border-sm me-1"></span>
                    Enregistrement...
                </span>
            </button>
        </div>
    </form>
</div>
