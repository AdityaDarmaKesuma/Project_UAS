<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function list()
    {
        if (auth()->user()->role == "user") {
            return redirect()->route('produk.etalase');
        }

        $kategoris = KategoriProduk::all();
        return view('kategori.list', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function simpan()
    {
        $this->validate(request(), [
            'nama' => 'required',
        ]);

        $pesanan = KategoriProduk::create([
            'nama' => request()->nama,
        ]);

        return redirect()->route('kategori.list');
    }

    public function edit($id)
    {
        $kategori = KategoriProduk::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update($id)
    {
        $this->validate(request(), [
            'nama' => 'required',
        ]);

        $kategori = KategoriProduk::find($id);

        $kategori->update([
            'nama' => request()->nama,
        ]);

        return redirect()->route('kategori.list');
    }

    public function delete($id)
    {
        try {
            $kategori = KategoriProduk::find($id);

            if ($kategori == null) {
                return back()->with('fail', 'data kategori gagal dihapus');
            }

            $kategori->delete();

            return back()->with('success', 'data berhasil dihapus');
        } catch (QueryException $error) {
            return $error;
        }
    }
}
