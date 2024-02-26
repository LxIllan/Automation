<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryItemStoreRequest;
use App\Http\Requests\InventoryItemUpdateRequest;
use App\Models\Inventory;
use App\Models\InventoryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventoryItemController extends Controller
{
    public function index(Request $request): View
    {
        $inventoryItems = InventoryItem::all();

        return view('inventoryItem.index', compact('inventoryItems'));
    }

    public function create(Inventory $inventory): View
    {
        return view('inventoryItem.create', ['inventory' => $inventory]);
    }

    public function store(InventoryItemStoreRequest $request): RedirectResponse
    {
        $inventoryItem = InventoryItem::create($request->validated());
        return redirect()->route('inventories.show', ['inventory' => $inventoryItem->inventory])->with('success', 'Inventory item created successfully');
    }

    public function show(Request $request, InventoryItem $inventoryItem): View
    {
        return view('inventoryItem.show', compact('inventoryItem'));
    }

    public function edit(Request $request, InventoryItem $inventoryItem): View
    {
        return view('inventoryItem.edit', compact('inventoryItem'));
    }

    public function update(InventoryItemUpdateRequest $request, InventoryItem $inventoryItem): RedirectResponse
    {
        $inventoryItem->update($request->validated());

        $request->session()->flash('inventoryItem.id', $inventoryItem->id);

        return redirect()->route('inventoryItem.index');
    }

    public function destroy(Request $request, InventoryItem $inventoryItem): RedirectResponse
    {
        $inventoryItem->delete();

        return redirect()->route('inventoryItem.index');
    }
}
