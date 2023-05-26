<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Cash;
use App\Models\Inventory;
use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('app.reports.index');
    }
    public function ProductReport()
    {
        return view('app.reports.ProductReport');
    }
    public function SalesReport()
    {
        return view('app.reports.SalesReport');
    }
    public function StaffReport()
    {
        return view('app.reports.StaffReport');
    }

    public function GenerateProductReport(Request $request)
    {
        $searchInput = $request->input('searchInput');

        $query = Product::join('inventories', 'products.id', '=', 'inventories.product_id')
        ->select('products.id', 'products.name', 'products.description', 'products.price', 'products.image', 'inventories.stock_quantity', 'inventories.created_at', 'inventories.updated_at');

        if ($searchInput) {
        $query->where(function ($q) use ($searchInput) {
            $q->where('products.id', $searchInput)
              ->orWhere('products.name', 'like', "%$searchInput%");
        });
    }

    $products = $query->get();

    return view('app.reports.GenerateProductReport', ['products' => $products]);
    }
    public function GenerateSalesReport()
    {
        return view('app.reports.GenerateSalesReport');
    }
    public function GenerateStaffReport()
    {
        return view('app.reports.GenerateStaffReport');
    }
}