<?php

use App\Http\Controllers\BilanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MouvementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SettingController;
use App\Models\STock\Category;
use Illuminate\Support\Facades\Route;

//dashboard
Route::controller(DashboardController::class)->group(function(){
    //index
    Route::get('/', 'index')->name('dashboard');
});

//ventes
Route::prefix('/ventes')->controller(SalesController::class)->group(function(){
    //index
    Route::get('/', 'index')->name('ventes');

    //new
    Route::get('/new', 'new')->name('new_vente');

    //show vente
    Route::get('/show/{sale}', 'show_vente')->name('show_vente');

    //download invoice
    Route::get('/invoice/{sale}', 'downloadInvoice')->name('downloadInvoice');

    //save invoice to pdf
    Route::post('/invoice/savepdf', 'savePdf')->name('savePdf');
});

//product route
Route::prefix('/products')->controller(ProductController::class)->group(function (){
    //index
    Route::get('/', 'index')->name('produits');

    //new product
    Route::get('/new', 'new')->name('new_product');

    //store new product
    Route::post('/store', 'store')->name('store_new_product');

    //show product
    Route::get('/show/{product}', 'show_product')->name('show_product');

    //modify product informarions
    Route::get('/modify/{product}', 'modify_product')->name('modify_product');

    //update product
    Route::put('/update/{product}', 'update_product')->name('update_product');

});

//category route 
Route::prefix('/category')->controller(CategoryController::class)->group(function(){
    
    //add new category
    Route::post('/new', 'create')->name('new_category');

    //get all categories
    Route::get('/categories', 'getCategories')->name('get_categories');

    //update category
    Route::put('/update/{category}', 'update')->name('update_category');

    //delete category
    Route::delete('/delete/{category}', 'delete')->name('delete_category');
}); 

//mouvement
Route::prefix('/mouvement')->controller(MouvementController::class)->group(function(){
    //new mouvement
    Route::post('/new_mouvement', 'create')->name('new_mouvement');

    //show mouvement stock
    Route::get('/show_mouvement/{product}', 'show_mouvement')->name('show_mouvement');

    //update mouvement
    Route::put('/update/{mouvement}', 'update')->name('update_mouvement');

    //delete mouvement
    Route::delete('/delete/{mouvement}', 'delete')->name('delete_mouvement');
});

//provider route
Route::prefix('/provider')->controller(ProviderController::class)->group(function(){
    //index
    Route::get('/', 'index')->name('provider');

    //create new provider
    Route::get('/new_privider_form', 'new_privider_form')->name('new_privider_form');

    //store new provider
    Route::post('/new', 'new')->name('new_provider');

    //edit provider
    Route::get('/edit/{id}', 'edit_provider')->name('edit_provider');

    //update provider
    Route::put('/update/{provider}', 'update')->name('update_provider');

    //destroy provider
    Route::delete('/delete/{provider}', 'delete')->name('delete_provider');

    //show provider
    Route::get('/show/{id}', 'show_provider')->name('show_provider');

});

//clients route
Route::prefix('/client')->controller(ClientController::class)->group(function(){
    //index
    Route::get('/', 'index')->name('client');

    //store
    Route::post('/new', 'store')->name('new_client');

    //update
    Route::put('/update/{client}', 'update')->name('update_client');

    //destroy client
    Route::delete('/delete/{client}', 'delete')->name('delete_client');

    //show client
    Route::get('/show_client/{id}', 'show_client')->name('show_client');
});

//bilan route
Route::prefix('/bilan')->controller(BilanController::class)->group(function(){
    //index
    Route::get('/', 'index')->name('bilan');
});

Route::prefix('/paramètre')->controller(SettingController::class)->group(function(){
    //company
    Route::get('/company', 'company')->name('company');

    //numbering
    Route::get('/numbering', 'numbering')->name('numbering');

    //about 
    Route::get('/about', 'about')->name('about');
});