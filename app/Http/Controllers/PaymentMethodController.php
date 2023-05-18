<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Requests\PaymentMethodStoreRequest;
use App\Http\Requests\PaymentMethodUpdateRequest;

class PaymentMethodController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', PaymentMethod::class);

        $search = $request->get('search', '');

        $paymentMethods = PaymentMethod::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.payment_methods.index',
            compact('paymentMethods', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', PaymentMethod::class);

        return view('app.payment_methods.create');
    }

    /**
     * @param \App\Http\Requests\PaymentMethodStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentMethodStoreRequest $request)
    {
        $this->authorize('create', PaymentMethod::class);

        $validated = $request->validated();

        $paymentMethod = PaymentMethod::create($validated);

        return redirect()
            ->route('payment-methods.edit', $paymentMethod)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PaymentMethod $paymentMethod)
    {
        $this->authorize('view', $paymentMethod);

        return view('app.payment_methods.show', compact('paymentMethod'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PaymentMethod $paymentMethod)
    {
        $this->authorize('update', $paymentMethod);

        return view('app.payment_methods.edit', compact('paymentMethod'));
    }

    /**
     * @param \App\Http\Requests\PaymentMethodUpdateRequest $request
     * @param \App\Models\PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(
        PaymentMethodUpdateRequest $request,
        PaymentMethod $paymentMethod
    ) {
        $this->authorize('update', $paymentMethod);

        $validated = $request->validated();

        $paymentMethod->update($validated);

        return redirect()
            ->route('payment-methods.edit', $paymentMethod)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PaymentMethod $paymentMethod)
    {
        $this->authorize('delete', $paymentMethod);

        $paymentMethod->delete();

        return redirect()
            ->route('payment-methods.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
