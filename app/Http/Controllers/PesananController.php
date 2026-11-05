<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Pesanan;

class PesananController extends Controller
{
    // Menyimpan pesanan siswa
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menu,id',
            'jumlah' => 'required|integer|min:1|max:50',
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        Pesanan::create([
            'user_id' => Auth::id(),
            'menu_id' => $menu->id,
            'jumlah' => $request->jumlah,
            'total_harga' => $menu->harga * $request->jumlah,
            'status' => 'Menunggu',
        ]);

        return back()->with('success', 'Pesanan berhasil dibuat!');
    }

    // Menampilkan pesanan untuk admin
    public function index()
    {
        $pesanans = Pesanan::with(['user', 'menu'])
            ->orderByDesc('id')
            ->get();

        return view('admin.pesanan.index', compact('pesanans'));
    }
}