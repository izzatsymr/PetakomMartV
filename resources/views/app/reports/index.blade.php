<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Dashboard</title>
    <!-- Include Google Charts library -->
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        /* Custom CSS styles for the chart containers */
        #salesByUserChart,
        #productCategoryChart {
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 1rem;
            text-align: center;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 1rem;
        }

        .card h3 {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>
    <!-- The x-app-layout component -->
    <x-app-layout>
        <!-- The header slot with the title -->
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @lang('Report Dashboard')
            </h2>
        </x-slot>

        <div class="container mx-auto mt-16 px-4">
            <!-- Report Grid -->
            <div class="grid">
                <!-- Product Report card -->
                <div class="card">
                    <a href="{{ route('reports.ProductReport') }}">
                        <img src="https://icons.veryicon.com/png/o/miscellaneous/fu-jia-intranet/product-29.png"
                            alt="Product Report">
                    </a>
                    <h3>Product Report</h3>
                </div>
                <!-- Sales Report card -->
                <div class="card">
                    <a href="{{ route('reports.SalesReport') }}">
                        <img src="https://cdn-icons-png.flaticon.com/512/1585/1585258.png" alt="Sales Report">
                    </a>
                    <h3>Sales Report</h3>
                </div>
                <!-- Staff Report card -->
                <div class="card">
                    <a href="{{ route('reports.StaffReport') }}">
                        <img src="https://icons.veryicon.com/png/o/internet--web/prejudice/user-128.png"
                            alt="Staff Report">
                    </a>
                    <h3>Staff Report</h3>
                </div>
            </div>

            <!-- Chart containers -->
            <div id="salesByUserChart" style="width: 100%; height: 400px;"></div>
            <div id="productCategoryChart" style="width: 100%; height: 400px;"></div>
        </div>

        <!-- Google Charts library -->
        <script>
            google.charts.load('current', {
                packages: ['corechart']
            });
            google.charts.setOnLoadCallback(drawCharts);

            function drawCharts() {
                drawSalesByUserChart();
                drawProductCategoryChart();
            }

            function drawSalesByUserChart() {
                var salesByUser = {!! json_encode($salesByUser) !!};
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Week');
                data.addColumn('number', 'User ID');
                data.addColumn('number', 'Total Sales');

                salesByUser.forEach(function(row) {
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

            function drawProductCategoryChart() {
                var categories = {!! json_encode($categories) !!};
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Category ID');
                data.addColumn('number', 'Count');

                categories.forEach(function(category) {
                    data.addRow([category.category_id, category.count]);
                });

                var options = {
                    title: 'Product Category Distribution',
                    is3D: true
                };

                var chart = new google.visualization.PieChart(document.getElementById('productCategoryChart'));
                chart.draw(data, options);
            }
        </script>
    </x-app-layout>
</body>

</html>
