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

class ReportController extends Controller
{
    public function index()
    {
        return view('app.reports.index');
    }

    public function ProductReport()
    {
        $datas = DB::table('products')
        ->join('inventories', 'products.id', '=', 'inventories.product_id')
        ->select('products.id', 'products.name', 'products.category_id', 'products.price', 'inventories.stock_quantity','inventories.created_at','inventories.updated_at')
        ->get();

        return view('app.reports.ProductReport', compact('datas'));
    }
    public function SalesReport()
    {
        $datas = DB::table('sales')
        ->join('cashes', 'sales.user_id', '=', 'cashes.user_id')
        ->select('sales.created_at', 'sales.user_id', DB::raw('COUNT(*) as total_sales'))
        ->groupBy('sales.created_at', 'sales.user_id')
        ->orderBy('sales.created_at')
        ->get();

        return view('app.reports.SalesReport',compact('datas'));
    }
    public function ShowSalesReport()
    {
        $datas = DB::table('sales')
        ->join('cashes', 'sales.user_id', '=', 'cashes.user_id')
        ->select('sales.created_at', 'sales.user_id', DB::raw('COUNT(*) as total_sales'))
        ->groupBy('sales.created_at', 'sales.user_id')
        ->orderBy('sales.created_at')
        ->get();

        return view('app.reports.StaffReport');
    }
    public function StaffReport()
    {
        $datas = DB::table('users')
        ->join('schedule', 'users.id', '=', 'schedule.user_id')
        ->select('schedule.created_at', 'schedule.start_time','schedule.end_time','users.id','users.name',)
        ->groupBy('schedule.created_at')
        ->orderBy('sales.created_at')
        ->get();

        return view('app.reports.StaffReport');
    }

}
