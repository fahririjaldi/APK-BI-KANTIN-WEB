<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('kategori')
            ->orderBy('nama_menu')
            ->get();

        return view('admin.menu.index', compact('menus'));
    }

    public function store(Request $request)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'kategori' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
        ]);

        Menu::create($validated);

        return redirect('/admin/dashboard#daftar-menu')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'kategori' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($validated);

        return redirect('/admin/dashboard#daftar-menu')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        $menu = Menu::findOrFail($id);

        if ($menu->pesanans()->exists()) {
            return back()->with(
                'error',
                'Menu tidak dapat dihapus karena sudah memiliki riwayat pesanan.'
            );
        }

        $menu->delete();

        return redirect('/admin/dashboard#daftar-menu')
            ->with('success', 'Menu berhasil dihapus.');
    }
}
