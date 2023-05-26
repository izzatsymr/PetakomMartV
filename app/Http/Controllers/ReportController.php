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

    public function GenerateProductReport()
    {
        return view('app.reports.GenerateProductReport');
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