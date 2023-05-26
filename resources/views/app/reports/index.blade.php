<!DOCTYPE html>
<html>
<head>
  <title>Report Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .report-image {
      cursor: pointer;
    }
  </style>
</head>
<body>

  <div class="container mx-auto mt-16 px-4">

    <!-- Report Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="rounded-lg overflow-hidden shadow-md">
        <img class="Productreport-image" src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.nicepng.com%2Fourpic%2Fu2e6y3o0u2i1q8u2_png-file-fa-fa-product-icon%2F&psig=AOvVaw25WgZZEDbCbR9uWYC1RRHS&ust=1685173967545000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCLiA3rbAkv8CFQAAAAAdAAAAABAE" alt="Sandwich" onclick="window.location.href='product_report_ui.html'">
        <h3 class="text-center mt-4 text-lg font-semibold">Product Report</h3>
      </div>
      <div class="rounded-lg overflow-hidden shadow-md">
        <img class="Salesreport-image" src="/w3images/steak.jpg" alt="Steak" onclick="window.location.href='sales_report_ui.html'">
        <h3 class="text-center mt-4 text-lg font-semibold">Sales Report</h3>
      </div>
      <div class="rounded-lg overflow-hidden shadow-md">
        <img class="Staffreport-image" src="/w3images/cherries.jpg" alt="Cherries" onclick="window.location.href='staff_report_ui.html'">
        <h3 class="text-center mt-4 text-lg font-semibold">Staff Report</h3>
      </div>
    </div>

  </div>

</body>
</html>

