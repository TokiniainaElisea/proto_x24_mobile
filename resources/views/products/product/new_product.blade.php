@extends('layout')
@section('title', 'Ajouter un nouveau produit')

@section('content')

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-2 my-2">

            <div>
                <h2 class="fw-bold mb-1">
                    <i class="bi bi-box-seam-fill text-primary me-2"></i>
                    Nouveau produit
                </h2>
            </div>

            <a href="{{ route('produits') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
            </a>

        </div>

        <form method="post" action="{{ route('store_product') }}" enctype="multipart/form-data" id="productForm">

            @csrf

            <!-- Informations générales -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Informations générales
                    </h5>
                </div>

                <div class="card-body p-4">
                    <div class="row g-3">

                        {{-- Image avec NativePHP Camera --}}
                        <div class="col-md-4">
                            <label for="image_path" class="form-label fw-semibold">
                                <i class="bi bi-image me-1 text-primary"></i>
                                Photo du produit
                            </label>

                            <div class="mb-2">
                                <button type="button" 
                                        onclick="openCamera()" 
                                        class="btn btn-primary w-100">
                                    <i class="bi bi-camera me-1"></i>
                                    Prendre une photo
                                </button>
                                <button type="button" 
                                        onclick="openGallery()" 
                                        class="btn btn-secondary w-100 mt-1">
                                    <i class="bi bi-images me-1"></i>
                                    Choisir depuis la galerie
                                </button>
                            </div>

                            <!-- Prévisualisation -->
                            <div id="imagePreview" style="display: none;">
                                <img id="previewImage" 
                                     src="#" 
                                     alt="Prévisualisation" 
                                     class="img-fluid rounded border mt-2"
                                     style="max-height: 200px; width: 100%; object-fit: cover;">
                                <button type="button" 
                                        onclick="removeImage()" 
                                        class="btn btn-danger btn-sm mt-1 w-100">
                                    <i class="bi bi-trash me-1"></i>
                                    Supprimer l'image
                                </button>
                            </div>

                            <!-- Champ caché pour l'image base64 -->
                            <input type="hidden" name="image_data" id="image_data">
                            <input type="hidden" name="image_filename" id="image_filename">

                            @error('image_path')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Nom --}}
                        <div class="col-md-8">
                            <label for="name_product" class="form-label fw-semibold">
                                <i class="bi bi-box-seam me-1 text-primary"></i>
                                Nom du produit
                            </label>
                            <input type="text" name="name_product" id="name_product"
                                class="form-control @error('name_product') is-invalid @enderror"
                                placeholder="Ex : T-shirt classique" value="{{ old('name_product') }}">
                            @error('name_product')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Prix --}}
                        <div class="col-md-6">
                            <label for="price" class="form-label fw-semibold">
                                <i class="bi bi-cash-stack me-1 text-success"></i>
                                Prix de vente
                            </label>
                            <div class="input-group">
                                <input type="number" name="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror" 
                                    placeholder="0"
                                    value="{{ old('price') }}">
                                <span class="input-group-text">Ar</span>
                            </div>
                            @error('price')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Fournisseur --}}
                        <div class="col-12">
                            <label for="id_provider" class="form-label fw-semibold">
                                <i class="bi bi-truck me-1 text-info"></i>
                                Fournisseur
                            </label>
                            <select name="id_provider" id="id_provider" class="form-select">
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->id }}"
                                        {{ old('id_provider') == $provider->id ? 'selected' : '' }}>
                                        {{ $provider->name_provider }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Approvisionnement -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-box-arrow-in-down me-2"></i>
                        Approvisionnement
                    </h5>
                </div>

                <div class="card-body p-4">
                    <div class="row g-3">
                        {{-- Date --}}
                        <div class="col-md-4">
                            <label for="enter_date" class="form-label fw-semibold">
                                <i class="bi bi-calendar-event me-1 text-primary"></i>
                                Date d'approvisionnement
                            </label>
                            <input type="date" name="enter_date" id="enter_date"
                                class="form-control @error('enter_date') is-invalid @enderror"
                                value="{{ old('enter_date') }}">
                            @error('enter_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Quantité --}}
                        <div class="col-md-4">
                            <label for="initial_quantity" class="form-label fw-semibold">
                                <i class="bi bi-boxes me-1 text-info"></i>
                                Quantité initiale
                            </label>
                            <input type="number" name="initial_quantity" id="initial_quantity"
                                class="form-control @error('initial_quantity') is-invalid @enderror" 
                                placeholder="0"
                                value="{{ old('initial_quantity') }}">
                            @error('initial_quantity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Prix fournisseur --}}
                        <div class="col-md-4">
                            <label for="provider_price" class="form-label fw-semibold">
                                <i class="bi bi-cash-coin me-1 text-success"></i>
                                Prix fournisseur
                            </label>
                            <div class="input-group">
                                <input type="number" name="provider_price" id="provider_price"
                                    class="form-control @error('provider_price') is-invalid @enderror" 
                                    placeholder="0"
                                    value="{{ old('provider_price') }}">
                                <span class="input-group-text">Ar</span>
                            </div>
                            @error('provider_price')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Caractéristiques -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-sliders me-2"></i>
                        Caractéristiques du produit
                    </h5>
                </div>

                <div class="card-body p-4">
                    <div class="row g-3">
                        {{-- Catégorie --}}
                        <div class="col-md-6">
                            <label for="id_category" class="form-label fw-semibold">
                                <i class="bi bi-tags-fill me-1 text-info"></i>
                                Catégorie
                            </label>
                            <select name="id_category" id="id_category" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('id_category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Taille --}}
                        <div class="col-md-6">
                            <label for="size" class="form-label fw-semibold">
                                <i class="bi bi-rulers me-1 text-primary"></i>
                                Taille
                            </label>
                            <input type="text" name="size" id="size"
                                class="form-control @error('size') is-invalid @enderror" 
                                placeholder="Ex : M, L, XL..."
                                value="{{ old('size') }}">
                            @error('size')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Couleur --}}
                        <div class="col-md-6">
                            <label for="color" class="form-label fw-semibold">
                                <i class="bi bi-palette-fill me-1 text-warning"></i>
                                Couleur
                            </label>
                            <input type="text" name="color" id="color"
                                class="form-control @error('color') is-invalid @enderror" 
                                placeholder="Ex : Noir"
                                value="{{ old('color') }}">
                            @error('color')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Matière --}}
                        <div class="col-md-6">
                            <label for="matter" class="form-label fw-semibold">
                                <i class="bi bi-layers-fill me-1 text-secondary"></i>
                                Matière
                            </label>
                            <input type="text" name="matter" id="matter"
                                class="form-control @error('matter') is-invalid @enderror" 
                                placeholder="Ex : Coton"
                                value="{{ old('matter') }}">
                            @error('matter')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex justify-content-end gap-2 mb-5">
                <button type="reset" class="btn btn-outline-danger">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                    Effacer
                </button>
                <button type="submit" class="btn btn-success" id="submitBtn">
                    <i class="bi bi-plus-circle-fill me-1"></i>
                    Ajouter le produit
                </button>
            </div>

        </form>

    </div>

@endsection

@push('scripts')
<script>
    // Fonction pour ouvrir la caméra
    function openCamera() {
        console.log('Tentative d\'ouverture de la caméra...');
        
        // Vérifier si l'API NativePHP est disponible
        if (typeof window.nativephp !== 'undefined' && window.nativephp) {
            console.log('NativePHP détecté');
            
            // Utiliser l'API nativephp mobile camera
            try {
                window.nativephp.camera.takePhoto({
                    quality: 0.8,
                    maxWidth: 1200,
                    maxHeight: 1200
                }).then(function(result) {
                    console.log('Photo prise avec succès');
                    handleImageResult(result);
                }).catch(function(error) {
                    console.error('Erreur lors de la prise de photo:', error);
                    alert('Erreur: ' + (error.message || 'Impossible de prendre la photo'));
                });
            } catch (error) {
                console.error('Erreur d\'appel de la caméra:', error);
                alert('Erreur d\'appel de la caméra: ' + error.message);
            }
        } else {
            console.warn('NativePHP non détecté, fallback vers la galerie du navigateur');
            // Fallback: utiliser l'input file classique
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.capture = 'environment';
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    handleFile(file);
                }
            };
            input.click();
        }
    }

    // Fonction pour ouvrir la galerie
    function openGallery() {
        console.log('Tentative d\'ouverture de la galerie...');
        
        // Vérifier si l'API NativePHP est disponible
        if (typeof window.nativephp !== 'undefined' && window.nativephp) {
            console.log('NativePHP détecté');
            
            // Utiliser l'API nativephp mobile camera pour la galerie
            try {
                window.nativephp.camera.pickFromGallery({
                    quality: 0.8,
                    maxWidth: 1200,
                    maxHeight: 1200
                }).then(function(result) {
                    console.log('Image sélectionnée avec succès');
                    handleImageResult(result);
                }).catch(function(error) {
                    console.error('Erreur lors de la sélection de l\'image:', error);
                    alert('Erreur: ' + (error.message || 'Impossible de sélectionner l\'image'));
                });
            } catch (error) {
                console.error('Erreur d\'appel de la galerie:', error);
                alert('Erreur d\'appel de la galerie: ' + error.message);
            }
        } else {
            console.warn('NativePHP non détecté, fallback vers l\'input file');
            // Fallback: utiliser l'input file classique
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    handleFile(file);
                }
            };
            input.click();
        }
    }

    // Gérer le résultat de l'image (pour NativePHP)
    function handleImageResult(result) {
        console.log('Résultat reçu:', typeof result);
        
        // Le résultat peut être une chaîne base64 ou un objet avec des propriétés
        let imageData = result;
        let filename = 'photo_' + Date.now() + '.jpg';
        
        // Si c'est un objet, essayer d'extraire les données
        if (typeof result === 'object') {
            if (result.data) {
                imageData = result.data;
            } else if (result.base64) {
                imageData = result.base64;
            } else if (result.image) {
                imageData = result.image;
            }
            
            if (result.filename) {
                filename = result.filename;
            }
        }
        
        // Si l'image contient déjà le préfixe data:image
        let base64Data = imageData;
        let previewUrl = imageData;
        
        if (typeof imageData === 'string') {
            if (imageData.startsWith('data:image')) {
                // Extraire le base64 pur
                base64Data = imageData.split(',')[1];
                previewUrl = imageData;
            } else {
                // Ajouter le préfixe pour l'affichage
                previewUrl = 'data:image/jpeg;base64,' + imageData;
            }
        }
        
        // Afficher la prévisualisation
        document.getElementById('previewImage').src = previewUrl;
        document.getElementById('imagePreview').style.display = 'block';
        document.getElementById('image_data').value = base64Data;
        document.getElementById('image_filename').value = filename;
        
        console.log('Image traitée avec succès');
    }

    // Gérer les fichiers (fallback web)
    function handleFile(file) {
        if (file) {
            console.log('Fichier sélectionné:', file.name);
            const reader = new FileReader();
            reader.onload = function(event) {
                const imageUrl = event.target.result;
                document.getElementById('previewImage').src = imageUrl;
                document.getElementById('imagePreview').style.display = 'block';
                
                // Extraire le base64
                const base64String = imageUrl.split(',')[1];
                document.getElementById('image_data').value = base64String;
                document.getElementById('image_filename').value = file.name;
                
                console.log('Image chargée avec succès');
            };
            reader.onerror = function(error) {
                console.error('Erreur de lecture du fichier:', error);
                alert('Erreur lors de la lecture du fichier');
            };
            reader.readAsDataURL(file);
        }
    }

    // Supprimer l'image
    function removeImage() {
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('previewImage').src = '#';
        document.getElementById('image_data').value = '';
        document.getElementById('image_filename').value = '';
        console.log('Image supprimée');
    }

    // Vérifier la disponibilité de NativePHP au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Page chargée');
        console.log('window.nativephp:', typeof window.nativephp !== 'undefined' ? 'disponible' : 'non disponible');
        
        // Vérifier si l'image existe déjà dans le champ
        const imageData = document.getElementById('image_data').value;
        if (imageData) {
            document.getElementById('previewImage').src = 'data:image/jpeg;base64,' + imageData;
            document.getElementById('imagePreview').style.display = 'block';
            console.log('Image existante chargée');
        }
        
        // Ajouter un écouteur sur le formulaire
        document.getElementById('productForm').addEventListener('submit', function(e) {
            const imageData = document.getElementById('image_data').value;
            console.log('Soumission du formulaire, image:', imageData ? 'présente' : 'absente');
        });
    });

</script>
@endpush