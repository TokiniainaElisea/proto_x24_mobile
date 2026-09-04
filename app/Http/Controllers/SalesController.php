<?php
namespace App\Http\Controllers;

use App\Http\Requests\SalesRequest;
use App\Models\Company;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function show_vente(Sales $sale)
    {
        return view('ventes.parts.show_vente', [
            'sale' => $sale,
        ]);
    }

    //download invoice
    public function downloadInvoice(Sales $sale)
    {
        $sale->load([
            'client',
            'saledetail.product',
        ]);
        return view('ventes.invoice', [
            'sale'    => $sale,
            'company' => Company::first(),
        ]);
    }

    public function savePdf(Request $request)
    {
        try {
            $request->validate([
                'pdf'            => 'required|file|mimes:pdf|max:10240', // 10 Mo max
                'sale_reference' => 'required|string|max:100',
            ]);

            $filename = 'facture-' . $request->sale_reference . '-' . now()->format('YmdHis') . '.pdf';

            // Crée le dossier s'il n'existe pas
            if (! Storage::exists('temp')) {
                Storage::makeDirectory('temp');
            }

            $path = $request->file('pdf')->storeAs('temp', $filename);

            $absolutePath = Storage::path($path);

            return response()->json([
                'success'  => true,
                'path'     => $absolutePath,
                'filename' => $filename,
            ]);

        } catch (\Throwable $e) {
            // On renvoie l'erreur pour la voir côté front
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ], 500);
        }
    }
}
