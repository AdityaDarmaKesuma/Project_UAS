@extends('layout.layout-admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Halaman Detail</h1>

    <div class="card shadow mb-4 col">
        <div class="card-header py-3 row">
            Detail Data Pesanan
        </div>
        <div class="card-body">
            <div class="amount-info my-1">
                <p style="font-size: 15px">
                    <b>Nama Pemesan : </b> {{ $pesanan->nama_pemesan }}
                </p>
                <p style="font-size: 15px">
                    <b>Email : </b> {{ $pesanan->email }}
                </p>
                <p style="font-size: 15px">
                    <b>Tanggal pemesanan : </b> <i> {{ $pesanan->tanggal }} </i>
                </p>
                <p style="font-size: 15px">
                    <b>Alamat : </b> {{ $pesanan->alamat_pemesan }}
                </p>
                <p style="font-size: 15px">
                    <b>No. Telp : {{ $pesanan->no_hp }}
                </p>
                <p style="font-size: 15px">
                    <b>Jumlah Pesanan : </b> {{ $pesanan->jumlah_pesanan }}
                </p>
                <p style="font-size: 15px">
                    <b>Deskripsi : </b> {{ $pesanan->deskripsi }}
                </p>
                <p style="font-size: 15px">
                    <b>Produk : </b> {{ $pesanan->produk->nama }}
                </p>
            </div>

            <div class="mt-2 text-right">
                <a href="{{ route('pesanan.list') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
