<?php
namespace App\Http\Controllers;

use App\Http\Requests\BilanPeriodeRequest;
use App\Models\SaleDetail;
use App\Models\Sales;
use App\Models\Category;
use App\Models\Product;

class BilanController extends Controller
{
    //chiffre d'affaire
    private function turnover($begin, $ending)
    {
        return Sales::whereBetween('created_at', [$begin, $ending])
            ->sum('total_price');
    }

    //nombre de produits vendus
    private function products($begin, $ending)
    {
        return SaleDetail::whereBetween('created_at', [$begin, $ending])
            ->sum('quantity');
    }

    //panier moyen
    private function meanSale($begin, $ending)
    {
        $salesCount = Sales::whereBetween('created_at', [$begin, $ending])->count();

        if ($salesCount == 0) {
            return 0;
        }

        $turnover = Sales::whereBetween('created_at', [$begin, $ending])
            ->sum('total_price');

        return $turnover / $salesCount;
    }

    //benefice
    private function benefice($begin, $ending)
    {
        $sumTotalPrices = SaleDetail::whereBetween('created_at', [$begin, $ending])->sum('total_line');
        $sumCostPrices  = SaleDetail::whereBetween('created_at', [$begin, $ending])->sum('cost_price');

        return $sumTotalPrices - $sumCostPrices;
    }

    // ventes par catégorie
    private function salesByCategory($begin, $ending)
    {
        $categories = Category::with([
            'product.salesdetail' => function ($query) use ($begin, $ending) {
                $query->whereBetween('created_at', [$begin, $ending]);
            },
        ])->get();

        $labels = [];
        $data   = [];

        foreach ($categories as $category) {

            $quantity = 0;

            foreach ($category->product as $product) {

                $quantity += $product->salesdetail->sum('quantity');

            }

            // On peut ignorer les catégories sans vente, ou ce que vous voulez 
            if ($quantity > 0) {
                $labels[] = $category->name_category;
                $data[]   = $quantity;
            }
        }

        return [
            'labels' => $labels,
            'data'   => $data,
        ];
    }

    //clients
    private function clients($begin, $ending)
    {
        return Sales::whereBetween('created_at', [$begin, $ending])->count('client_id');
    }

    //évolution des ventes par moi
    private function salesEvolution($begin, $ending)
    {
        // Tous les mois de l'année
        $months = [
            'Jan'  => 1,
            'Fév'  => 2,
            'Mar'  => 3,
            'Avr'  => 4,
            'Mai'  => 5,
            'Juin' => 6,
            'Juil' => 7,
            'Août' => 8,
            'Sept' => 9,
            'Oct'  => 10,
            'Nov'  => 11,
            'Déc'  => 12,
        ];

        // On prépare tous les mois à 0
        $salesData = array_fill(0, 12, 0);

        // On récupère simplement les ventes de la période
        $sales = Sales::whereBetween('created_at', [$begin, $ending])
            ->get(['created_at', 'total_price']);

        foreach ($sales as $sale) {

            $month = (int) $sale->created_at->format('n');

            // Les mois vont de 1 à 12 alors que le tableau commence à 0
            $salesData[$month - 1] += $sale->total_price;
        }

        return [
            'labels' => array_keys($months),
            'data'   => $salesData,
        ];
    }

    //top products
    private function topProducts($begin, $ending)
    {
        return SaleDetail::with('product')
            ->whereBetween('created_at', [$begin, $ending])
            ->selectRaw('product_id, SUM(quantity) as total_quantity, SUM(total_line) as total_sales')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();
    }

    //stock

    private function stockState()
    {
        $products = Product::with('mouvement')->get();

        $stockTotal = 0;
        $lowStock   = 0;
        $outOfStock = 0;

        foreach ($products as $product) {

            $stock = $product->mouvement[0]->in_stock ?? 0;

            $stockTotal += $stock;

            if ($stock == 0) {
                $outOfStock++;
            } elseif ($stock <= 10) {
                $lowStock++;
            }
        }

        $toWatch  = $products
            ->filter(function ($product) {
                $stock = $product->mouvement[0]->in_stock ?? 0;

                return $stock <= 10;
            })
            ->sortBy(function ($product) {
                return $product->mouvement[0]->in_stock ?? 0;
            })
            ->take(5);

        return [
            'stockTotal' => $stockTotal,
            'lowStock'   => $lowStock,
            'outOfStock' => $outOfStock,
            'toWatch'    => $toWatch,
        ];
    }

    public function index(BilanPeriodeRequest $periode)
    {
        $p = $periode->validated();

        $turnover       = null;
        $benefice       = null;
        $clients        = null;
        $products       = null;
        $meanSale       = null;
        $categorySales  = [];
        $salesEvolution = [];
        $topProducts    = [];
        $stock          = $this->stockState();

        if ($p) {

            //top products
            $topProducts = $this->topProducts(
                $p['begin'] . ' 00:00:00',
                $p['ending'] . ' 23:59:59'
            );
            //Récupération des données de ventes
            $salesEvolution = $this->salesEvolution(
                $p['begin'] . ' 00:00:00',
                $p['ending'] . ' 23:59:59'
            );

            //Récupération des ventes par catégorie
            $categorySales = $this->salesByCategory(
                $p['begin'] . ' 00:00:00',
                $p['ending'] . ' 23:59:59'
            );

            //récupération du penier moyen
            $meanSale = $this->meanSale(
                $p['begin'] . ' 00:00:00',
                $p['ending'] . ' 23:59:59'
            );

            //récupération du nombre de produits vendus
            $products = $this->products(
                $p['begin'] . ' 00:00:00',
                $p['ending'] . ' 23:59:59');
            //récupération du CA
            $turnover = $this->turnover(
                $p['begin'] . ' 00:00:00',
                $p['ending'] . ' 23:59:59'
            );
            //récupération des bénéfices
            $benefice = $this->benefice(
                $p['begin'] . ' 00:00:00',
                $p['ending'] . ' 23:59:59'
            );

            //récupération du nombre de client
            $clients = $this->clients(
                $p['begin'] . ' 00:00:00',
                $p['ending'] . ' 23:59:59'
            );
        }

        return view('bilan.bilan', [
            'stock'                => $stock,
            'topProducts'          => $topProducts,
            'salesEvolutionLabels' => $salesEvolution['labels'] ?? [],
            'salesEvolutionData'   => $salesEvolution['data'] ?? [],
            'categoryLabels'       => $categorySales['labels'] ?? null,
            'categoryData'         => $categorySales['data'] ?? null,
            'products'             => $products,
            'meanSale'             => $meanSale,
            'clients'              => $clients,
            'benefice'             => $benefice,
            'turnover'             => $turnover,
            'begin'                => $p['begin'] ?? null,
            'ending'               => $p['ending'] ?? null,
        ]);
    }
}
