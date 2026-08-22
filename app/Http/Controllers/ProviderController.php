<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use App\Models\Stock\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        return view('fournisseurs.providers', ['providers' => Provider::all()]);
    }

    //new provider
    public function new(ProviderRequest $request)
    {
        $provider = Provider::create($request->validated());
        return to_route('provider')->with('success', 'Nouveau fournisseur ajouté');
    }

    //update provider
    public function update(ProviderRequest $request, Provider $provider)
    {
        $provider->update($request->validated());
        return to_route('provider')->with('success', 'Modification(s) effectuée(s)');
    }

    //destroy provider
    public function delete(Provider $provider)
    {
        $provider->delete();
        return to_route('provider')->with('success', 'Suppression effectuée');
    }
}
