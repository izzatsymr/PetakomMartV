<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Cash;
use App\Models\Inventory;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // Graph 1: Sales by User ID (Weekly)
        // Retrieve sales data grouped by week and user, ordered by week
        $salesByUser = Sale::select(
            DB::raw('YEARWEEK(created_at) as week'),
            'user_id',
            DB::raw('SUM(total_sales) as total_sales')
        )
            ->groupBy('week', 'user_id')
            ->orderBy('week')
            ->get();


        // Graph 2: Product by Category
    
        $categories = Product::select('category_id', DB::raw('COUNT(*) as count'))
            ->groupBy('category_id')
            ->get();
        return view('app.reports.index', compact('salesByUser', 'categories'));
    }

    public function ProductReport(Request $request)
    {
        // Query products and inventories data for product reporting
        $query = DB::table('products')
            ->join('inventories', 'products.id', '=', 'inventories.product_id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'inventories.stock_quantity',
                DB::raw("DATE_FORMAT(inventories.created_at, '%m/%d/%y') as created_date"),
                DB::raw("DATE_FORMAT(inventories.updated_at, '%m/%d/%y') as updated_date")
            );

        // Search by product name
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('products.name', 'like', '%' . $searchTerm . '%');
        }

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $query->whereBetween('inventories.created_at', [$startDate, $endDate]);
        }

        $datas = $query->get();

        // Retrieve stock quantity data for each product
        foreach ($datas as $product) {
            // Query stock quantity data grouped by week for each product
            $stockData = DB::table('inventories')
                ->where('product_id', $product->id)
                ->select(
                    DB::raw('YEARWEEK(created_at) as week'),
                    DB::raw('SUM(stock_quantity) as stock_quantity')
                )
                ->groupBy('week')
                ->orderBy('week')
                ->get();

            $product->stock_data = $stockData;
        }

        return view('app.reports.ProductReport', compact('datas'));
    }

    public function SalesReport(Request $request)
    {
        $query = Sale::query();

        // Apply filters based on the request parameters
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!empty($startDate) && !empty($endDate)) {
            // Filter sales by date range
            $query->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        }

        // Retrieve sales data grouped by sale date
        $sales = $query->select(
            DB::raw("DATE_FORMAT(created_at, '%m/%d/%y') as sale_date"),
            DB::raw('SUM(total_sales) as total_sales')
        )
            ->groupBy('sale_date')
            ->get();

        return view('app.reports.SalesReport', compact('sales'));
    }

    public function getSecondTableData(Request $request)
    {
        $query = Sale::query();
        $selectedDate = $request->query('date');

        if ($request->has('sales_id')) {
            // Filter sales by sales ID
            $salesId = $request->input('sales_id');
            $query->where('id', $salesId);
        }

        if ($request->has('user_id')) {
            // Filter sales by user ID
            $userId = $request->input('user_id');
            $query->where('user_id', $userId);
        }

        // Retrieve second table data based on the applied filters
        $secondTableData = $query->get();

        return view('app.reports.ShowSalesReport', compact('secondTableData', 'selectedDate'));
    }

    public function StaffReport(Request $request)
    {
        $query = DB::table('users')
            ->join('schedules', 'users.id', '=', 'schedules.user_id')
            ->select('schedules.created_at', 'schedules.start_time', 'schedules.end_time', 'users.id', 'users.name')
            ->groupBy('users.name')
            ->orderBy('schedules.start_time');

        // Filter by user ID
        if ($request->has('user_id')) {
            $userId = $request->input('user_id');
            $query->where('users.id', $userId);
        }

        // Retrieve staff report data
        $datas = $query->get();

        return view('app.reports.StaffReport', compact('datas'));
    }
}
