<?php
namespace App\Http\Controllers;

use App\Models\SaleDetail;
use App\Models\Sales;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{

    //chiffre d'affaire du jour
    private function dailyResume()
    {
        return Sales::whereDate('created_at', today())->sum('total_price');
    }

    //nombre de client
    private function clientNumber()
    {
        return Sales::whereDate('created_at', today())->count('client_id');
    }

    //nombre de produit vendu
    private function ProductCount()
    {
        return SaleDetail::whereDate('created_at', today())->sum('quantity');
    }

    //panier moyen
    private function meanSale()
    {
        $salesCount = Sales::whereDate('created_at', today())->count();

        if ($salesCount == 0) {
            return 0;
        }

        $turnover = Sales::whereDate('created_at', today())
            ->sum('total_price');

        return $turnover / $salesCount;
    }
    //index
    public function index()
    {
        //sales
        $sales = Sales::with('client', 'saledetail')->orderBy('created_at', 'DESC');

        //category chart
        //$categories = Category::pluck('name_category');

        //vente par catégorie
        $categories = Category::with('product.salesdetail')->get();

        foreach ($categories as $category) {

            $nbVentes = $category->product
                ->sum(fn($product) => $product->salesdetail->count());

            $categoryLabels[] = $category->name_category;
            $categoryData[]   = $nbVentes;
        }

        //vente par semaine
        $weeks = Sales::query()
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
            ])
            ->get()
            ->groupBy(function ($sale) {
                return ceil($sale->created_at->day / 7);
            });

        $salesLabel = [];
        $salesData  = [];

        for ($i = 1; $i <= 5; $i++) {
            $salesLabel[] = "S$i";
            $salesData[]  = isset($weeks[$i]) ? $weeks[$i]->count() : 0;
        }

        //dd($datas);
        return view('dashboard.dashboard',
            [
                'meanSale'       => $this->meanSale(),
                'productCount'   => $this->ProductCount(),
                'clientNumber'   => $this->clientNumber(),
                'dailyResume'    => $this->dailyResume(),
                'salesLabel'     => $salesLabel,
                'salesData'      => $salesData,
                'categoryLabels' => $categoryLabels ?? [],
                'categoryData'   => $categoryData ?? [],
                'sales'          => $sales->paginate(10),
            ]);
    }
}
