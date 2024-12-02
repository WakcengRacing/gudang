<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\ItemHistory;
use App\Models\Item;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function history()
    {
        $histories = ItemHistory::with('item')->orderBy('created_at', 'desc')->get();
        return view('activities.history', compact('histories'));
    }
   
    public function index()
    {
        if (Auth::user()->role === 'user') {
            // Tampilkan halaman aktivitas
            return view('user.checkout');
        } elseif (Auth::user()->role === 'admin') {
            // Tampilkan halaman aktivitas untuk admin
            return view('admin.checkout');
        }
    
        // Jika role tidak diketahui, arahkan ke halaman login
        return redirect()->route('login');
    }


    // Di dalam metode checkout()
    public function checkout(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Item::find($request->item_id);

        // Mengurangi stok barang
        if ($item->quantity >= $request->quantity) {
            $item->quantity -= $request->quantity;
            $item->save();

            // Menyimpan riwayat pengeluaran dengan user_id
            ItemHistory::create([
                'item_id' => $item->id,
                'quantity' => $request->quantity,
                'user_id' => Auth::id(), // Mengambil ID pengguna yang sedang login
            ]);

            return redirect()->route('activities.index')->with('success', 'Barang berhasil dikeluarkan.');
        } else {
            return redirect()->route('activities.index')->with('error', 'Stok tidak cukup.');
        }
    }

   
}
