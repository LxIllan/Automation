<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        $customers = Customer::latest()->paginate(3);

        return view('customer.index', ['customers' => $customers]);
    }

    public function create(Request $request): View
    {
        return view('customer.create');
    }

    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        $customer = Customer::create($request->validated());

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit(Request $request, Customer $customer): View
    {
        return view('customer.edit', ['customer' => $customer]);
    }

    public function update(CustomerUpdateRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Request $request, Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
