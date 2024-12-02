<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // public function index()
    // {
    //     $items = Item::all();
    //     return view('items.index', compact('items'));
    // }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'quantity' => 'required|integer']);
        Item::create($request->all());
        return redirect()->route('items.index');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate(['name' => 'required', 'quantity' => 'required|integer']);
        $item->update($request->all());
        return redirect()->route('items.index');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete(); // Soft delete
        return redirect()->route('items.index')->with('success', 'Item berhasil dihapus.');
    }

}
