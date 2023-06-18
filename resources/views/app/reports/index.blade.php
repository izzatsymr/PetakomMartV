<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Dashboard</title>
    <style>
        /* Custom CSS styles for the chart containers */
        #salesByUserChart,
        #productQuantitiesChart,
        #dailySalesChart {
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @lang('Report Dashboard')
            </h2>
        </x-slot>

        <div class="container mx-auto mt-16 px-4">
            <!-- Report Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="rounded-lg overflow-hidden shadow-md">
                    <a href="{{ route('reports.ProductReport') }}">
                        <img class="Productreport-image"
                            src="https://icons.veryicon.com/png/o/miscellaneous/fu-jia-intranet/product-29.png">
                    </a>
                    <h3 class="text-center mt-4 text-lg font-semibold">Product Report</h3>
                </div>
                <div class="rounded-lg overflow-hidden shadow-md">
                    <a href="{{ route('reports.SalesReport') }}">
                        <img class="Salesreport-image" src="https://cdn-icons-png.flaticon.com/512/1585/1585258.png"
                            alt="Sales Report">
                    </a>
                    <h3 class="text-center mt-4 text-lg font-semibold">Sales Report</h3>
                </div>
                <div class="rounded-lg overflow-hidden shadow-md">
                    <a href="{{ route('reports.StaffReport') }}">
                        <img class="Staffreport-image"
                            src="https://icons.veryicon.com/png/o/internet--web/prejudice/user-128.png"
                            alt="Staff Report">
                    </a>
                    <h3 class="text-center mt-4 text-lg font-semibold">Staff Report</h3>
                </div>
            </div>

            <div id="salesByUserChart" style="width: 100%; height: 400px;"></div>
            <div id="productQuantitiesChart" style="width: 100%; height: 400px;"></div>
            <div id="dailySalesChart" style="width: 100%; height: 400px;"></div>
        </div>

        <script src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
            google.charts.load('current', {
                packages: ['corechart']
            });
            google.charts.setOnLoadCallback(drawCharts);

            function drawCharts() {
                drawSalesByUserChart();
                drawProductQuantitiesChart();
                drawDailySalesChart();
            }

            function drawSalesByUserChart() {
                var salesByUser = {!! json_encode($salesByUser) !!};

                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Week');
                data.addColumn('number', 'User ID');
                data.addColumn('number', 'Total Sales');

                salesByUser.forEach(function(row) {
                    // Convert the value to a string
                    var week = String(row.week);

                    data.addRow([week, row.user_id, row.total_sales]);
                });

                var options = {
                    title: 'Sales by User ID (Weekly)',
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };

                var chart = new google.visualization.LineChart(document.getElementById('salesByUserChart'));
                chart.draw(data, options);
            }


            
        </script>
    </x-app-layout>
</body>

</html>
