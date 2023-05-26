<!DOCTYPE html>
<html>
<head>
  <title>Product Report Generator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
    .search-bar {
      width: 400px;
    }
  </style>
</head>
<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100">
    <div class="container mx-auto px-4 py-16">

      <h1 class="text-3xl font-semibold mb-4">Product Report Generator</h1>

      <div class="flex justify-between items-center mb-8">
        <input id="search-input" class="search-bar px-4 py-2 rounded-lg border border-gray-300" type="text" placeholder="Search for a product">
        <button id="search-button" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Search</button>
      </div>

      <table id="report-table" class="table-auto w-full border border-gray-300">
        <thead>
          <tr>
            <th class="px-4 py-2 border-b">Product ID</th>
            <th class="px-4 py-2 border-b">Product Name</th>
            <th class="px-4 py-2 border-b">Description</th>
            <th class="px-4 py-2 border-b">Price</th>
            <th class="px-4 py-2 border-b">Product Image</th>
            <th class="px-4 py-2 border-b">Stock Quantity</th>
            <th class="px-4 py-2 border-b">Created At</th>
            <th class="px-4 py-2 border-b">Updated At</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
          <tr>
            <td class="px-4 py-2 border-b">{{ $product->id }}</td>
            <td class="px-4 py-2 border-b">{{ $product->name }}</td>
            <td class="px-4 py-2 border-b">{{ $product->description }}</td>
            <td class="px-4 py-2 border-b">{{ $product->price }}</td>
            <td class="px-4 py-2 border-b">
              <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" class="w-10 h-10">
            </td>
            <td class="px-4 py-2 border-b">{{ $product->stock_quantity }}</td>
            <td class="px-4 py-2 border-b">{{ $product->created_at }}</td>
            <td class="px-4 py-2 border-b">{{ $product->updated_at }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    document.getElementById('search-button').addEventListener('click', function() {
      var searchInput = document.getElementById('search-input').value;
      
      fetch('/reports/GenerateProductReport?searchInput=' + searchInput)
        .then(response => response.json())
        .then(data => {
          var tableBody = document.getElementById('report-table').getElementsByTagName('tbody')[0];
          tableBody.innerHTML = ''; // Clear existing rows
          data.forEach(function(product) {
            var row = tableBody.insertRow();
            row.innerHTML = `
              <td class="px-4 py-2 border-b">${product.id}</td>
              <td class="px-4 py-2 border-b">${product.name}</td>
              <td class="px-4 py-2 border-b">${product.description}</td>
              <td class="px-4 py-2 border-b">${product.price}</td>
              <td class="px-4 py-2 border-b">
                <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" class="w-10 h-10">
              </td>
              <td class="px-4 py-2 border-b">${product.stock_quantity}</td>
              <td class="px-4 py-2 border-b">${product.created_at}</td>
              <td class="px-4 py-2 border-b">${product.updated_at}</td>
            `;
          });
        });
      
    });
  </script>

</body>
</html>
