<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryStoreRequest;
use App\Http\Requests\InventoryUpdateRequest;
use App\Models\Inventory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventoryController extends Controller
{
    public function index(Request $request): View
    {
        $inventories = Inventory::all();

        return view('inventory.index', ['inventories' => $inventories]);
    }

    public function create(Request $request): View
    {
        return view('inventory.create');
    }

    public function store(InventoryStoreRequest $request): RedirectResponse
    {
        $inventory = Inventory::create($request->validated());

        return redirect()->route('inventories.index')->with('success', 'Inventory created successfully.');
    }

    public function show(Request $request, Inventory $inventory): View
    {
        $inventory = Inventory::with('inventoryItems')->find($inventory->id);
        $countItems = $inventory->inventoryItems->sum('qty');
        return view('inventory.show', [
            'inventory' => $inventory,
            'countItems' => $countItems,
            'total' => $inventory->inventoryItems->sum('price') * $countItems,
        ]);
    }

    public function edit(Request $request, Inventory $inventory): View
    {
        return view('inventory.edit', ['inventory' => $inventory]);
    }

    public function update(InventoryUpdateRequest $request, Inventory $inventory): RedirectResponse
    {
        $inventory->update($request->validated());

        return redirect()->route('inventories.index')->with('success', 'Inventory updated successfully.');
    }

    public function destroy(Request $request, Inventory $inventory): redirectResponse
    {
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Inventory deleted successfully.');
    }
}
