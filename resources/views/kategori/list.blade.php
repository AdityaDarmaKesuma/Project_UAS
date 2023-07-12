@extends('layout.layout-admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Halaman kategori</h1>

    <div class="card shadow mb-4 col">
        <div class="card-header py-3 row">
            <div class="col-6">
                <h6 class="m-0 font-weight-bold text-primary">Data kategori</h6>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('kategori.create') }}" class="btn btn-success rounded-pill">
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
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($kategoris as $kategori)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $kategori->nama }}</td>
                                <td>
                                    <a href="{{ route('kategori.edit', $kategori->id) }}"
                                        class="btn btn-warning rounded mb-3">Edit</a>
                                    <form class="mb-3" action="{{ route('kategori.delete', $kategori->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Anda Yakin ingin Menghapus Data ini ?')"
                                            class="btn btn-danger rounded">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
