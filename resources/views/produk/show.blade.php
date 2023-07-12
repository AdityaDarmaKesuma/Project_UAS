@extends('layout.layout-admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Halaman Detail</h1>

    <div class="card shadow mb-4 col">
        <div class="card-header py-3 row">
            Detail Data Produk
        </div>
        <div class="card-body">
            <div class="amount-info my-1">
                <img class="img img-detail rounded" width="300px" height="300px"
                    src="{{ $produk->foto_produk ? asset('/storage/produk/' . $produk->foto_produk) : asset('assets/image/no-image.jpg') }}">
                <br><br>

                <p style="font-size: 15px">
                    <b>Nama : </b> {{ $produk->nama }}
                </p>
                <p style="font-size: 15px">
                    <b>Kode : </b> {{ $produk->kode }}
                </p>
                <p style="font-size: 15px">
                    <b>Harga Beli : </b> Rp. {{ $produk->harga_beli }}
                </p>
                <p style="font-size: 15px">
                    <b>Harga Jual : </b> Rp. {{ $produk->harga_jual }}
                </p>
                <p style="font-size: 15px">
                    <b>Stok : </b> {{ $produk->stok }}
                </p>
                <p style="font-size: 15px">
                    <b>Min Stok : </b> {{ $produk->min_stok }}
                </p>
                <p style="font-size: 15px">
                    <b>Deskripsi : </b> {{ $produk->deskripsi }}
                </p>
                <p style="font-size: 15px">
                    <b>Kategori : </b> {{ $produk->kategori->nama }}
                </p>
            </div>

            <div class="mt-2 text-right">
                <a href="{{ route('produk.list') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
