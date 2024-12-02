<?php

namespace App\Http\Controllers;

use App\Models\ItemHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Item; // Contoh model

class AdminController extends Controller
{
    public function index()
    {
        // Misalnya mengambil semua data item untuk admin
        $items = Item::all(); // Sesuaikan dengan model dan data yang Anda ambil

        return view('admin.index', compact('items')); // Mengirimkan $items ke view
    }

    public function create()
    {
        // Menampilkan halaman form untuk menambah item
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0', // Validasi harga
        ]);

        Item::create($request->all()); // Pastikan kolom price ada di model fillable

        return redirect()->route('admin.index')->with('success', 'Item berhasil ditambahkan!');
    }


    public function edit($id)
    {
        // Menampilkan halaman form untuk mengedit item
        $item = Item::findOrFail($id);
        return view('admin.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0', // Validasi untuk harga
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all()); // Memperbarui data barang

        return redirect()->route('admin.index')->with('success', 'Item berhasil diperbarui!');
    }
    public function history()
    {
        $histories = ItemHistory::with('item')->orderBy('created_at', 'desc')->get();
        return view('admin.history', compact('histories'));
    }

    public function checkout(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil data barang berdasarkan ID
        $item = Item::find($request->item_id);

        // Cek apakah stok mencukupi
        if ($item->quantity < $request->quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Stok barang tidak cukup!']);
        }

        // Kurangi stok barang
        $item->quantity -= $request->quantity;
        $item->save();

        // Simpan ke riwayat transaksi
        ItemHistory::create([
            'item_id' => $item->id,
            'quantity' => $request->quantity,
            'user_id' => Auth::id(), // Pastikan pengguna sedang login
        ]);

        // Redirect ke halaman checkout dengan pesan sukses
        return redirect()->route('admin.checkout')->with('success', 'Checkout berhasil!');
    }

    // Method untuk menampilkan halaman checkout
    public function showCheckout()
    {
        $items = Item::all(); // Data barang untuk ditampilkan
        return view('admin.checkout', compact('items')); // Pastikan view ini ada
    }


    public function destroy($id)
    {
        // Temukan entitas berdasarkan ID, misalnya pengguna atau barang
        $item = Item::findOrFail($id);

        // Hapus entitas
        $item->delete();

        // Redirect kembali setelah berhasil menghapus
        return redirect()->route('admin.index')->with('success', 'Data berhasil dihapus.');
    }
}
