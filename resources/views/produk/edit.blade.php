@extends('layout.layout-admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Halaman Tambah</h1>

    <div class="card shadow mb-4 col">
        <div class="card-header py-3 row">
            Tambah Data produk
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

            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Nama :</label>
                    <input type="text" class="form-control" name="nama" value="{{ old('nama', $produk->nama) }}"
                        placeholder="Masukan Nama produk" required>

                    @error('nama')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Kode :</label>
                    <input type="text" class="form-control" name="kode" value="{{ old('kode', $produk->kode) }}"
                        placeholder="Masukan kode produk" required>

                    @error('kode')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Harga Beli :</label>
                    <input type="number" class="form-control" name="harga_beli"
                        value="{{ old('harga_beli', $produk->harga_beli) }}" placeholder="Masukan Harga Beli produk"
                        required>

                    @error('harga_beli')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Harga Jual :</label>
                    <input type="number" class="form-control" name="harga_jual"
                        value="{{ old('harga_jual', $produk->harga_jual) }}" placeholder="Masukan Harga Jual produk"
                        required>

                    @error('harga_jual')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Min Stok :</label>
                    <input type="number" class="form-control" name="min_stok"
                        value="{{ old('min_stok', $produk->min_stok) }}" placeholder="Masukan min Stok produk" required>

                    @error('min_stok')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Stok :</label>
                    <input type="number" class="form-control" name="stok" value="{{ old('stok', $produk->stok) }}"
                        placeholder="Masukan stok produk" required>

                    @error('stok')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Deskripsi :</label>
                    <textarea name="deskripsi" placeholder="deskripsi" class="form-control" cols="30" rows="10">{{ old('deskripsi', $produk->deskripsi) }}</textarea>

                    @error('deskripsi')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Foto (upload jika ingin mengubah) :</label>
                    <input type="file" class="form-control" name="foto_produk" value="{{ old('foto_produk') }}"
                        placeholder="Masukan Foto produk">

                    @error('foto_produk')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">kategori :</label>
                    <select name="kategori_produk_id" class="form-control">
                        <option disabled selected>Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ $kategori->id == $produk->kategori_produk_id ? 'selected' : '' }}>{{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
        </div>
        <div class="modal-footer">
            <a href="{{ route('produk.list') }}" class="btn btn-dark" data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
