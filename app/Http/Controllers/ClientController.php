<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientSearchRequest;
use App\Models\Client;
use App\Models\Numbering;
use App\Models\Sales;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(ClientSearchRequest $request){

        $query = Client::query();

        if($request->has('name') && !empty($request->name)){
            $query->where('name', 'LIKE', '%'.$request->name.'%');
        }

        if($request->has('firstname') && !empty($request->firstname)){
            $query->where('firstname', 'LIKE','%'.$request->firstname.'%');
        }

        if($request->has('phone') && !empty($request->phone)){
            $query->where('phone', 'LIKE', '%'.$request->phone.'%');
        }

        if($request->has('client_number') && !empty($request->client_number)){
            $query->where('client_number', 'LIKE', '%'.$request->client_number.'%');
        }
        return view('clients.clients', [
            'clients' => $query->paginate(10)
        ]);
    }

    //store new client
    public function store(ClientRequest $request){
        $client = Client::create($request->validated());
        $clientPrefix = Numbering::first() ?? 'CLI';
        //Génération du numéro client
        if(is_string($clientPrefix))
        {
            $client_number = $clientPrefix.$client->id;
        }

        else{
            $client_number = $clientPrefix->client_prefix.$client->id;
        }
        $client->update([
            'client_number' => $client_number
        ]);
        return to_route('client')->with('success', 'Client(e) ajouté(e) avec succès');
    }

    //update new client
    public function update(ClientRequest $request, Client $client){
        $client->update($request->validated());
        return to_route('client')->with('success', 'Modification(s) effectuée(s)');
    }

    //delete client
    public function delete(Client $client){
        $client->delete();
        return to_route('client')->with('success', 'Suppréssion effectuée');
    }

    //show client
    public function show_client($id){
        $client = Client::with('sales')->findOrFail($id);
        $sales = Sales::with('client')->where('client_id', '=', $id)->paginate(10);
        return view('clients.parts.client_card', ['client' => $client, 'sales' => $sales]);
    }
}