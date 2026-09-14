<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use App\Http\Requests\ProviderSearchRequest;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index(ProviderSearchRequest $request)
    {
        $query = Provider::query();

        if($request->has('name_provider') && !empty($request->name_provider)){
            $query->where('name_provider', 'LIKE', '%'.$request->name_provider.'%');
        }

        if($request->has('mail') && !empty($request->mail)){
            $query->where('mail', 'LIKE', '%'.$request->mail.'%');
        }

        if($request->has('phone') && !empty($request->phone)){
            $query->where('phone', 'LIKE', '%'.$request->phone.'%');
        }
        return view('fournisseurs.providers', ['providers' => $query->paginate(10)]);
    }
    // nouveau fournisseur
    public function new_privider_form(){
        return view('fournisseurs.parts.new_provider');
    }


    //new provider
    public function new(ProviderRequest $request)
    {
        $provider = Provider::create($request->validated());
        return to_route('provider')->with('success', 'Nouveau fournisseur ajouté');
    }

    //edit provider
    public function edit_provider($id){
        return view('fournisseurs.parts.edit', ['provider' => Provider::findOrFail($id)]);
    }
    //update provider
    public function update(ProviderRequest $request, Provider $provider)
    {
        $provider->update($request->validated());
        return to_route('provider')->with('success', 'Modification(s) effectuée(s)');
    }

    //show provider 
    public function show_provider($id){
        return view('fournisseurs.parts.show_provider', ['provider' => Provider::findOrFail($id) ]);
    }
    //destroy provider
    public function delete(Provider $provider)
    {
        $provider->delete();
        return to_route('provider')->with('success', 'Suppression effectuée');
    }
}