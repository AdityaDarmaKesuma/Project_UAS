@extends('layout.layout-admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Halaman Produk</h1>

    <div class="card shadow mb-4 col">
        <div class="card-header py-3 row">
            <div class="col-6">
                <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('produk.create') }}" class="btn btn-success rounded-pill">
                    Tambah Data +
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Min Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($produks as $produk)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $produk->kode }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>Rp. {{ $produk->harga_beli }}</td>
                                <td>Rp. {{ $produk->harga_jual }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>{{ $produk->min_stok }}</td>
                                <td>
                                    <a href="{{ route('produk.edit', $produk->id) }}"
                                        class="btn btn-warning rounded mb-3">Edit</a>
                                    <form class="mb-3" action="{{ route('produk.delete', $produk->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Anda Yakin ingin Menghapus Data ini ?')"
                                            class="btn btn-danger rounded">Hapus</button>
                                    </form>
                                    <a href="{{ route('produk.show', $produk->id) }}"
                                        class="btn btn-dark rounded mb-3">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
