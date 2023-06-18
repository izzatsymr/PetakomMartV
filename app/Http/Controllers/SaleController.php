<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;
use App\Models\Product;

class SaleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Sale::class);

        $search = $request->get('search', '');

        // Fetch sales using the Sale model
        $sales = Sale::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.sales.index', compact('sales', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $this->authorize('create', Sale::class);

        // Fetch users, payment methods, and products using their respective models
        $users = User::pluck('name', 'id');
        $paymentMethods = PaymentMethod::pluck('name', 'id');

        $products = Product::all()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
            ];
        });

        return view('app.sales.create', compact('users', 'paymentMethods', 'products'));
    }

    /**
     * @param \App\Http\Requests\SaleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleStoreRequest $request)
    {
        $this->authorize('create', Sale::class);

        $validated = $request->validated();

        $sale = Sale::create($validated);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $totalPrice = $request->input('total_price');

        $productSales = [
            $productId => [
                'quantity' => $quantity,
                'total_price' => $totalPrice,
            ]
        ];

        $sale->products()->attach($productSales);

        return redirect()
            ->route('sales.show', $sale)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Sale $sale)
    {
        $this->authorize('view', $sale);

        $sale->load('products'); // Eager load the products relationship

        return view('app.sales.show', compact('sale'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $this->authorize('update', $sale);
        return view('app.sales.edit')
            ->with('sale', $sale);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $this->authorize('update', $sale);

        $sale->status = $request->input('status');
        $sale->refunded_reason = $request->input('refunded_reason');

        $sale->update();

        return redirect()
            ->route('sales.edit', $sale)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sale $sale)
    {
        $this->authorize('delete', $sale);

        $sale->delete();

        return redirect()
            ->route('sales.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
