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

        $users = User::pluck('name', 'id');
        $paymentMethods = PaymentMethod::pluck('name', 'id');
        $products = Product::pluck('name', 'id');

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

        $sale = Sale::create($validated);
        $sale->products()->attach($productSales);


        return redirect()
            ->route('sales.edit', $sale)
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

        return view('app.sales.show', compact('sale'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     * 
     */
    public function edit(Request $request, Sale $sale)
    {
        $this->authorize('update', $sale);

        $users = User::pluck('name', 'id');
        $paymentMethods = PaymentMethod::pluck('name', 'id');
        $products = Product::pluck('name', 'id');

        return view(
            'app.sales.edit',
            compact('sale', 'users', 'paymentMethods', 'products')
        );
    }

    /**
     * @param \App\Http\Requests\SaleUpdateRequest $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleUpdateRequest $request, Sale $sale)
    {
        $this->authorize('update', $sale);

        $validated = $request->validated();

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $totalPrice = $request->input('total_price');

        $productSales = [
            $productId => [
                'quantity' => $quantity,
                'total_price' => $totalPrice,
            ]
        ];

        $sale = Sale::create($validated);
        $sale->products()->attach($productSales);

        $sale->update($validated);

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
