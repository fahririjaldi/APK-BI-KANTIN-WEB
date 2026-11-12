<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class PesananController extends Controller
{
    // Siswa membuat pesanan
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'siswa') {
            abort(403);
        }

        $validated = $request->validate([
            'menu_id' => 'required|exists:menu,id',
            'jumlah' => 'required|integer|min:1|max:50',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $menu = Menu::where('id', $validated['menu_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $jumlah = $validated['jumlah'];

                if ($menu->stok < $jumlah) {
                    throw new Exception('Stok makanan tidak mencukupi.');
                }

                Pesanan::create([
                    'user_id' => Auth::id(),
                    'menu_id' => $menu->id,
                    'jumlah' => $jumlah,
                    'total_harga' => $menu->harga * $jumlah,
                    'status' => 'Menunggu',
                ]);

                $menu->decrement('stok', $jumlah);
            });

            return back()->with('success', 'Pesanan berhasil dibuat!');

        } catch (Exception $e) {
            return back()->withErrors([
                'pesanan' => $e->getMessage()
            ]);
        }
    }

    // Menampilkan pesanan untuk admin
    public function indexAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $pesanans = Pesanan::with(['user', 'menu'])
            ->orderByDesc('id')
            ->get();

        return view('admin.pesanan.index', compact('pesanans'));
    }

    // Admin mengubah status pesanan
    public function updateStatus(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai,Dibatalkan',
        ]);

        try {
            DB::transaction(function () use ($id, $validated) {
                $pesanan = Pesanan::where('id', $id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $statusLama = $pesanan->status;
                $statusBaru = $validated['status'];

                if ($statusLama === $statusBaru) {
                    return;
                }

                if ($statusLama === 'Dibatalkan') {
                    throw new Exception('Pesanan sudah dibatalkan.');
                }

                if ($statusLama === 'Selesai' && $statusBaru === 'Dibatalkan') {
                    throw new Exception('Pesanan selesai tidak dapat dibatalkan.');
                }

                if ($statusBaru === 'Dibatalkan') {
                    $menu = Menu::where('id', $pesanan->menu_id)
                        ->lockForUpdate()
                        ->firstOrFail();

                    $menu->increment('stok', $pesanan->jumlah);
                }

                $pesanan->update([
                    'status' => $statusBaru
                ]);
            });

            return back()->with('success', 'Status pesanan berhasil diperbarui.');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // Menampilkan riwayat pesanan siswa
    public function riwayat()
    {
        if (!Auth::check() || Auth::user()->role !== 'siswa') {
            abort(403);
        }

        $pesanans = Pesanan::with('menu')
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();

        return view('siswa.riwayat', compact('pesanans'));
    }
}
