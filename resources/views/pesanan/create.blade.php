@extends('layout.layout-admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Halaman Tambah</h1>

    <div class="card shadow mb-4 col">
        <div class="card-header py-3 row">
            Tambah Data pesanan
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

            <form action="{{ route('pesanan.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Nama :</label>
                    <input type="text" class="form-control" name="nama_pemesan" value="{{ old('nama_pemesan') }}"
                        placeholder="Masukan Nama Pemesan" required>

                    @error('nama_pemesan')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Email :</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                        placeholder="Masukan Email Pemesan" required>

                    @error('email')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Alamat :</label>
                    <input type="text" class="form-control" name="alamat_pemesan" value="{{ old('alamat_pemesan') }}"
                        placeholder="Masukan Alamat Pemesan" required>

                    @error('alamat_pemesan')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Tanggal :</label>
                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}"
                        placeholder="Masukan Tanggal Pemesan" required>

                    @error('tanggal')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">No. Telp :</label>
                    <input type="number" class="form-control" name="no_hp" value="{{ old('no_hp') }}"
                        placeholder="Masukan No. Telp Pemesan" required>

                    @error('no_hp')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Jumlah Pesanan :</label>
                    <input type="number" class="form-control" name="jumlah_pesanan" value="{{ old('jumlah_pesanan') }}"
                        placeholder="Masukan Nama Pemesan" required>

                    @error('jumlah_pesanan')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Deskripsi :</label>
                    <textarea name="deskripsi" class="form-control" cols="30" rows="10" placeholder="Masukan Deskripsi"></textarea>
                    @error('deskripsi')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Produk :</label>
                    <select name="produk_id" class="form-control">
                        <option disabled selected>Pilih Produk</option>
                        @foreach ($produks as $produk)
                            <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                        @endforeach
                    </select>
                </div>
        </div>
        <div class="modal-footer">
            <a href="{{ route('pesanan.list') }}" class="btn btn-dark" data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
