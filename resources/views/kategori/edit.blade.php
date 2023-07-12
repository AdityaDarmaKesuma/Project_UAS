@extends('layout.layout-admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Halaman Tambah</h1>

    <div class="card shadow mb-4 col">
        <div class="card-header py-3 row">
            Tambah Data kategori
        </div>
        <div class="card-body">
            @if (Session::get('fail') !== null)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Berhasil, </strong> {{ Session::get('fail') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Nama :</label>
                    <input type="text" class="form-control" name="nama" value="{{ old('nama', $kategori->nama) }}"
                        placeholder="Masukan Nama Kategori" required>

                    @error('nama')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        </div>
        <div class="modal-footer">
            <a href="{{ route('kategori.list') }}" class="btn btn-dark" data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
