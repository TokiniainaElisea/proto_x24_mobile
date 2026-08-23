<?php
namespace App\Http\Controllers;

use App\Http\Requests\MouvementRequest;
use App\Http\Requests\UpdateMouvementRequest;
use App\Models\Mouvement;
use App\Models\Product;

class MouvementController extends Controller
{
    //create new mouvement
    public function create(MouvementRequest $request)
    {
        $credentials = $request->validated();
        Mouvement::create([
            'enter_date'       => $credentials['enter_date'],
            'initial_quantity' => $credentials['initial_quantity'],
            'in_stock'         => $credentials['initial_quantity'],
            'provider_price'   => $credentials['provider_price'],
            'product_id'       => $credentials['product_id'],
        ]);

        return back();
    }

    //mouvement de stock
    public function show_mouvement(Product $product)
    {
        $stocks = Mouvement::with(['product'])->where('product_id', $product->id)->orderBy('created_at', 'DESC');
        return view('products.product.mouvement', [
            'product_id'=> $product->id,
            'stocks' => $stocks->paginate(10),
            'product' => $product
        ]);
    }

    //update mouvement
    public function update(UpdateMouvementRequest $request, $mouvement)
    {
        $stock       = Mouvement::find($mouvement);
        $credentials = $request->validated();
        $stock->update([
            'enter_date'       => $credentials['enter_date'],
            'initial_quantity' => $credentials['initial_quantity'],
            'in_stock'         => $credentials['in_stock'],
            'provider_price'   => $credentials['provider_price'],
            'product_id'       => $credentials['product_id'],
        ]);
        return back();
    }

    //delete mouvement
    public function delete($mouvement){
        $stock = Mouvement::find($mouvement);
        $stock->delete();
        return back();
    }
}
