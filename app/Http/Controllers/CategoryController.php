<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //créer une catégorie
    public function create(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return to_route('produits')->with('success', 'Catégorie ajoutée avec succès');
    }

    //modifier catégorie
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return to_route('produits')->with('success', 'Catégorie modifiée');
    }
 
    //supprimer catégorie
    public function delete(Category $category)
    {
        $category->delete();
        return to_route('produits')->with('success', 'Catégorie supprimée');
    }
}
