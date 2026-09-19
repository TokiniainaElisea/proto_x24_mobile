<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\SearchProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Numbering;
use App\Models\Category;
use App\Models\Detail;
use App\Models\Mouvement;
use App\Models\Product;
use App\Models\Provider;

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

}
