<?php
namespace App\Http\Controllers;

use App\Http\Requests\SalesRequest;
use App\Models\Company;
use App\Models\SaleDetail;
use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(SalesRequest $request)
    {
        $sales = Sales::with(['client', 'saledetail']);

        // Filtre par période
        if ($request->filled('begin') && $request->filled('ending')) {
            $sales->whereBetween('created_at', [
                $request->begin . ' 00:00:00',
                $request->ending . ' 23:59:59',
            ]);
        }

        // Numéro de commande
        if ($request->filled('order_number')) {
            $sales->where('sale_reference', 'LIKE', '%' . $request->order_number . '%');
        }

        // Montant
        if ($request->filled('montant')) {
            $sales->where('total_price', $request->montant);
        }

        // Nom du client
        if ($request->filled('name_client')) {
            $sales->whereHas('client', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->name_client . '%');
            });
        }

        return view('ventes.ventes', [
            'sales' => $sales->latest()->paginate(5),
        ]);
    }

    //new sale
    public function new ()
    {
        return view('ventes.new.new_ventes');
    }

    //show sale
    public function show_vente(Sales $sale){
        return view('ventes.parts.show_vente', [
            'sale' => $sale
        ]);
    }

    //download invoice
    public function downloadInvoice(Sales $sale){
        $sale->load([
        'client',
        'saledetail.product',
    ]);
        return view('ventes.invoice', [
            'sale' => $sale,
            'company' => Company::first()
        ]);
    }
}
