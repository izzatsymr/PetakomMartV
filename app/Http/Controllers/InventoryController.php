<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Requests\InventoryStoreRequest;
use App\Http\Requests\InventoryUpdateRequest;

class InventoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Inventory::class);

        $search = $request->get('search', '');

        $inventories = Inventory::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.inventories.index', compact('inventories', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Inventory::class);

        $products = Product::pluck('name', 'id');

        return view('app.inventories.create', compact('products'));
    }

    /**
     * @param \App\Http\Requests\InventoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryStoreRequest $request)
    {
        $this->authorize('create', Inventory::class);

        $validated = $request->validated();

        $inventory = Inventory::create($validated);

        return redirect()
            ->route('inventories.edit', $inventory)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Inventory $inventory)
    {
        $this->authorize('view', $inventory);

        return view('app.inventories.show', compact('inventory'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Inventory $inventory)
    {
        $this->authorize('update', $inventory);

        $products = Product::pluck('name', 'id');

        return view('app.inventories.edit', compact('inventory', 'products'));
    }

    /**
     * @param \App\Http\Requests\InventoryUpdateRequest $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(
        InventoryUpdateRequest $request,
        Inventory $inventory
    ) {
        $this->authorize('update', $inventory);

        $validated = $request->validated();

        $inventory->update($validated);

        return redirect()
            ->route('inventories.edit', $inventory)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Inventory $inventory)
    {
        $this->authorize('delete', $inventory);

        $inventory->delete();

        return redirect()
            ->route('inventories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
