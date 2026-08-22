<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\SearchProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Numbering;
use App\Models\Stock\Category;
use App\Models\Stock\Detail;
use App\Models\Stock\Mouvement;
use App\Models\Stock\Product;
use App\Models\Stock\Provider;

class ProductController extends Controller
{
    //
    public function index(SearchProductRequest $request)
    {
        $query         = Product::with(['detail', 'provider', 'mouvement']);
        $name_category = null;

        if ($request->has('name_product') && ! empty($request->name_product)) {
            $query->where('name_product', 'LIKE', '%' . $request->name_product . '%');
        }
        if ($request->has('id_category') && ! empty($request->id_category)) {
            $query->where('category_id', '=', $request->id_category);
            $name_category = Category::find($request->id_category);
        }
        return view('products.products', [
            'categories'    => Category::all(),
            'name_category' => $name_category,
            'products'      => $query->paginate(10),
        ]);
    }

    //new product
    public function new ()
    {
        return view('products.product.new_product', [
            'categories' => Category::all(),
            'providers'  => Provider::all(),
        ]);
    }

    //store new product
    public function store(ProductRequest $request)
    {
        $credentials = $request->validated();

        // 📸 Gestion de l'image NativePHP (base64)
        if ($request->has('image_data') && ! empty($request->image_data)) {
            // Décoder l'image base64
            $imageData = base64_decode($request->image_data);

            // 📁 Dossier cible
            $path = base_path('public/uploads/product');

            // 📁 Création du dossier s'il n'existe pas
            if (! file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // 🏷️ Nom unique
            $filename = time() . '_' . uniqid() . '.jpg';

            // 💾 Sauvegarde du fichier
            file_put_contents($path . '/' . $filename, $imageData);

            // 💾 Chemin à stocker en DB
            $credentials['image_path'] = 'uploads/product/' . $filename;
        }
        // Fallback pour l'upload de fichier standard (web)
        elseif ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $path = base_path('public/uploads/product');

            if (! file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $credentials['image_path'] = 'uploads/product/' . $filename;
        }

        // Si aucune image n'a été uploadée, mettre une valeur par défaut
        if (empty($credentials['image_path'])) {
            $credentials['image_path'] = 'uploads/product/default.jpg';
        }

        // Details product
        $detail = Detail::create([
            'size'   => $credentials['size'],
            'color'  => $credentials['color'],
            'matter' => $credentials['matter'],
        ]);

        // Store product information
        $productPrefix = Numbering::first() ?? 'PRD';
        $product       = Product::create([
            'name_product' => $credentials['name_product'],
            'price'        => $credentials['price'],
            'provider_id'  => $credentials['id_provider'],
            'image_path'   => $credentials['image_path'],
            'category_id'  => $credentials['id_category'],
            'detail_id'    => $detail->id,
        ]);

        if (is_string($productPrefix)) {
            $product->update([
                'reference' => $productPrefix . $product->id,
            ]);
        } else {
            $product->update([
                'reference' => $productPrefix->product_prefix . $product->id,
            ]);
        }

        // Mouvement stock information
        $mouvement = Mouvement::create([
            'enter_date'       => $credentials['enter_date'],
            'initial_quantity' => $credentials['initial_quantity'],
            'in_stock'         => $credentials['initial_quantity'],
            'provider_price'   => $credentials['provider_price'],
            'product_id'       => $product->id,
        ]);

        return to_route('produits')->with('success', 'Nouveau produit ajouté');
    }

    //show product informations
    public function show_product(Product $product)
    {

        $total_stock = $product->mouvement->sum('in_stock');

        return view('products.product.info_product', [
            'product'     => $product,
            'category'    => Category::find($product->category_id),
            'total_stock' => $total_stock,
        ]);
    }

    //modify product informations
    public function modify_product(Product $product)
    {
        return view('products.product.edit_product', [
            'product'    => $product,
            'category'   => Category::find($product->category_id),
            'categories' => Category::all(),
            'providers'  => Provider::all()]);
    }

    //update product
    public function update_product(UpdateProductRequest $request, Product $product)
    {
        $_product = Product::find($product->id)->load(['detail', 'mouvement']);

        $credentials = $request->validated(); //validated data

        //update image
        if ($request->hasFile('image_path')) {
            // 1. Supprimer l'ancienne photo si elle existe
            if ($product->image_path && ! empty($product->image_path)) {
                $oldImagePath = base_path('public/' . $product->image_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Suppression du fichier
                }
            }

            // 2. Upload de la nouvelle photo
            $file = $request->file('image_path');

            // 📁 Dossier cible (même logique que dans store)
            $path = base_path('public/uploads/product');

            // 📁 Création du dossier s'il n'existe pas
            if (! file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // 🏷️ Nom unique
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // 📦 Move du fichier
            $file->move($path, $filename);

            // 💾 Chemin à stocker en DB
            $credentials['image_path'] = 'uploads/product/' . $filename;

            $product->update([
                'image_path' => $credentials['image_path'],
            ]);
        }

        //update product informations
        $_product->update([
            'name_product' => $credentials['name_product'],
            'reference'    => $credentials['reference'],
            'price'        => $credentials['price'],
            'provider_id'  => $credentials['id_provider'],
            'category_id'  => $credentials['id_category'],
        ]);

        //update product details
        $_product->detail->update([
            'size'   => $credentials['size'],
            'color'  => $credentials['color'],
            'matter' => $credentials['matter'],
        ]);

        return to_route('produits')->with('success', 'Modification(s) effectuée(s)');

    }
}
