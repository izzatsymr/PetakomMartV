<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CashStoreRequest;
use App\Http\Requests\CashUpdateRequest;

class CashController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Cash::class);

        $search = $request->get('search', '');

        $allCash = Cash::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_cash.index', compact('allCash', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Cash::class);

        $users = User::pluck('name', 'id');

        return view('app.all_cash.create', compact('users'));
    }

    /**
     * @param \App\Http\Requests\CashStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashStoreRequest $request)
    {
        $this->authorize('create', Cash::class);

        $validated = $request->validated();

        $cash = Cash::create($validated);

        return redirect()
            ->route('all-cash.edit', $cash)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cash $cash
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Cash $cash)
    {
        $this->authorize('view', $cash);

        return view('app.all_cash.show', compact('cash'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cash $cash
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Cash $cash)
    {
        $this->authorize('update', $cash);

        $users = User::pluck('name', 'id');

        return view('app.all_cash.edit', compact('cash', 'users'));
    }

    /**
     * @param \App\Http\Requests\CashUpdateRequest $request
     * @param \App\Models\Cash $cash
     * @return \Illuminate\Http\Response
     */
    public function update(CashUpdateRequest $request, Cash $cash)
    {
        $this->authorize('update', $cash);

        $validated = $request->validated();

        $cash->update($validated);

        return redirect()
            ->route('all-cash.edit', $cash)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cash $cash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cash $cash)
    {
        $this->authorize('delete', $cash);

        $cash->delete();

        return redirect()
            ->route('all-cash.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
