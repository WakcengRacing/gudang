<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ItemHistory; // Contoh model untuk histori item

class UserController extends Controller
{
    public function index()
    {
        // Misalnya mengambil semua data item untuk admin
        $items = Item::all(); // Sesuaikan dengan model dan data yang Anda ambil

        return view('user.index', compact('items')); // Mengirimkan $items ke view
    }
    // Method untuk menampilkan halaman checkout
    public function showCheckout()
    {
        $items = Item::all(); // Data barang untuk ditampilkan
        return view('user.checkout', compact('items')); // Pastikan view ini ada
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
        return redirect()->route('user.checkout')->with('success', 'Checkout berhasil!');
    }

    public function history()
    {
        $histories = ItemHistory::with('item')->orderBy('created_at', 'desc')->get();
        return view('user.history', compact('histories'));
    }
}
