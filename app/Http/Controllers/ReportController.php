<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function indexReport()
    {
        // Display the report dashboard view with menu buttons
        return view('reports.dashboard');
    }
//ProductReport
    public function indexProductReport()
    {
        
        return view('reports.ProductReportdashboard');
    }

    public function generateProductReport()
    {
        
        $productReports = DB::table('products as pro')
        ->join('inventories as inv', 'pro.id', '=', 'inv.product_id')
        ->select('pro.id', 'pro.category_id', 'pro.name', 'pro.description', 'pro.price', 'inv.stock_quantity', 'inv.created_at', 'inv.updated_at')
        ->get();

        foreach ($productReports as $productReportData) {
        $productReport = new ProductReport();

        $productReport->category_id = $productReportData->category_id;
        $productReport->name = $productReportData->name;
        $productReport->description = $productReportData->description;
        $productReport->price = $productReportData->price;
        $productReport->stock_quantity = $productReportData->stock_quantity;
        $productReport->created_at = $productReportData->created_at;
        $productReport->updated_at = $productReportData->updated_at;

        $productReport->save();
         
         $html = '<h1>Product Report</h1>';
         foreach ($productReports as $productReport) {
             $html .= '<p>' . $productReport->name . ': ' . $productReport->stock_quantity . '</p>';
         }
         
         // Generate the PDF file
         $dompdf = new \Dompdf\Dompdf();
         $dompdf->loadHtml($html);
         $dompdf->setPaper('A4', 'landscape');
         $dompdf->render();
         
         // Store the generated report (optional, you can customize this based on your requirements)
         $pdf = $dompdf->output();
         file_put_contents('path/to/store/report.pdf', $pdf);
         
         // Redirect or return a response, depending on your needs
         return redirect()->back()->with('success', 'Product report generated successfully.');;
    }

    public function showProductReport()
    {
        $productReports = ProductReport::all();

    $html = '<h1>Product Report</h1>';
    foreach ($productReports as $productReport) {
        $html .= '<p>Category: ' . $productReport->category_id . '</p>';
        $html .= '<p>Name: ' . $productReport->name . '</p>';
        $html .= '<p>Description: ' . $productReport->description . '</p>';
        $html .= '<p>Price: ' . $productReport->price . '</p>';
        $html .= '<p>Stock Quantity: ' . $productReport->stock_quantity . '</p>';
        $html .= '<p>Created At: ' . $productReport->created_at . '</p>';
        $html .= '<p>Updated At: ' . $productReport->updated_at . '</p>';
        $html .= '<hr>';
    }

    // Generate the PDF file
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    // Output the generated report (optional)
    $dompdf->stream('product_report.pdf', ['Attachment' => false]);

    // Redirect or return a response, depending on your needs
    return redirect()->back()->with('success', 'Product report shown successfully.');
    }

    public function listProductReport()
    {
        
        return view('reports.listProductReport');
    }

    public function deleteProductReport()
    {
       
        return view('reports.deleteProductReport');
    }

    public function searchProductReport()
    {
        
        return view('reports.searchProductReport');
    }

}
