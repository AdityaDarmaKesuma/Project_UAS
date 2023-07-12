<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function list()
    {
        if (auth()->user()->role == "user") {
            return redirect()->route('produk.etalase');
        }

        $pesanans = Pesanan::all();
        return view('pesanan.list', compact('pesanans'));
    }

    public function create()
    {
        $produks = Produk::get();
        return view('pesanan.create', compact('produks'));
    }

    public function simpan()
    {
        $this->validate(request(), [
            'nama_pemesan' => 'required',
            'alamat_pemesan' => 'required',
            'tanggal' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'jumlah_pesanan' => 'required',
            'deskripsi' => 'required',
            'produk_id' => 'required',
        ]);

        $pesanan = Pesanan::create([
            'nama_pemesan' => request()->nama_pemesan,
            'alamat_pemesan' => request()->alamat_pemesan,
            'no_hp' => request()->no_hp,
            'email' => request()->email,
            'tanggal' => request()->tanggal,
            'jumlah_pesanan' => request()->jumlah_pesanan,
            'deskripsi' => request()->deskripsi,
            'produk_id' => request()->produk_id,
        ]);

        return redirect()->route('pesanan.list');
    }

    public function edit($id)
    {
        $pesanan = Pesanan::find($id);
        $produks = Produk::get();

        return view('pesanan.edit', compact('pesanan', 'produks'));
    }

    public function update($id)
    {
        $this->validate(request(), [
            'nama_pemesan' => 'required',
            'alamat_pemesan' => 'required',
            'tanggal' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'jumlah_pesanan' => 'required',
            'deskripsi' => 'required',
            'produk_id' => 'required',
        ]);

        $pesanan = Pesanan::find($id);

        $pesanan->update([
            'nama_pemesan' => request()->nama_pemesan,
            'alamat_pemesan' => request()->alamat_pemesan,
            'no_hp' => request()->no_hp,
            'email' => request()->email,
            'tanggal' => request()->tanggal,
            'jumlah_pesanan' => request()->jumlah_pesanan,
            'deskripsi' => request()->deskripsi,
            'produk_id' => request()->produk_id,
        ]);

        return redirect()->route('pesanan.list');
    }

    public function show($id)
    {
        $pesanan = Pesanan::find($id);

        return view('pesanan.show', compact('pesanan'));
    }

    public function delete($id)
    {
        $produk = Pesanan::find($id);

        if ($produk == null) {
            return back()->with('fail', 'data produk gagal dihapus');
        }

        $produk->delete();

        return back()->with('success', 'data berhasil dihapus');
    }
}
