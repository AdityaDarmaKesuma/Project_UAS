<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function list()
    {
        if (auth()->user()->role == "user") {
            return redirect()->route('produk.etalase');
        }

        $produks = Produk::all();
        return view('produk.list', compact('produks'));
    }

    public function etalase()
    {
        $produks = Produk::all();
        return view('etalase', compact('produks'));
    }

    public function detail($id)
    {
        $produk = Produk::find($id);

        return view('detail', compact('produk'));
    }

    public function create()
    {
        $kategoris = KategoriProduk::get();
        return view('produk.create', compact('kategoris'));
    }

    public function simpan()
    {
        $this->validate(request(), [
            'kode' => 'required',
            'nama' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'min_stok' => 'required',
            'deskripsi' => 'required',
            'foto_produk' => 'required',
            'kategori_produk_id' => 'required',
        ]);

        //upload image
        $image = request()->file('foto_produk');
        $image->storeAs('public/produk', $image->hashName());

        $pesanan = Produk::create([
            'kode' => request()->kode,
            'nama' => request()->nama,
            'harga_beli' => request()->harga_beli,
            'harga_jual' => request()->harga_jual,
            'stok' => request()->stok,
            'min_stok' => request()->min_stok,
            'deskripsi' => request()->deskripsi,
            'foto_produk' => $image->hashName(),
            'kategori_produk_id' => request()->kategori_produk_id,
        ]);

        return redirect()->route('produk.list');
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        $kategoris = KategoriProduk::get();

        return view('produk.edit', compact('produk', 'kategoris'));
    }

    public function update($id)
    {
        $this->validate(request(), [
            'kode' => 'required',
            'nama' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'min_stok' => 'required',
            'deskripsi' => 'required',
            'kategori_produk_id' => 'required',
        ]);

        $produk = Produk::find($id);

        //upload image
        if (request()->has('foto_produk')) {
            $image = request()->file('foto_produk');
            $image->storeAs('public/produk', $image->hashName());
            $image_name = $image->hashName();
        } else {
            $image_name = $produk->foto_produk;
        }

        $produk->update([
            'kode' => request()->kode,
            'nama' => request()->nama,
            'harga_beli' => request()->harga_beli,
            'harga_jual' => request()->harga_jual,
            'stok' => request()->stok,
            'min_stok' => request()->min_stok,
            'deskripsi' => request()->deskripsi,
            'foto_produk' => $image_name,
            'kategori_produk_id' => request()->kategori_produk_id,
        ]);

        return redirect()->route('produk.list');
    }

    public function show($id)
    {
        $produk = Produk::find($id);

        return view('produk.show', compact('produk'));
    }

    public function delete($id)
    {
        try {
            $produk = Produk::find($id);

            if ($produk == null) {
                return back()->with('fail', 'data Produk gagal dihapus');
            }

            $produk->delete();

            return back()->with('success', 'data berhasil dihapus');
        } catch (QueryException $error) {
            return $error;
        }
    }
}
