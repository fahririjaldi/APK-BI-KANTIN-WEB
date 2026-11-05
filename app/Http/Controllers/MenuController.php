<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Menampilkan semua menu
    public function index()
    {
        $menus = Menu::orderBy('kategori')
            ->orderBy('nama_menu')
            ->get();

        return view('admin.menu.index', compact('menus'));
    }

    // Menyimpan menu baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'kategori' => 'required|string|max:50',
        ]);

        Menu::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    // Memperbarui menu
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'kategori' => 'required|string|max:50',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Menu berhasil diperbarui.');
    }

    // Menghapus menu
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->pesanans()->exists()) {
            return redirect()
                ->back()
                ->with('error', 'Menu tidak bisa dihapus karena sudah memiliki pesanan.');
        }

        $menu->delete();

        return redirect()
            ->back()
            ->with('success', 'Menu berhasil dihapus.');
    }
}