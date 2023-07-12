@extends('layout.layout-detail')

@section('content')
    <div id="mainContent">
        <div class="container">
            <div class="row first-line">
                <div class="col-12 col-lg-8 col-xl-9">
                    <a class="btn btn-outline-danger" href="{{ route('produk.etalase') }}"
                        style="width: 100px; margin: -20px 0 10px 0;">Kembali</a>
                    <div class="card">
                        <div class="wrapperDetailProduct row">
                            <div class="col-12 col-lg-5">
                                <div class="wrapper-image-product">

                                    <img width="300px" height="300px"
                                        src="{{ $produk->foto_produk ? asset('/storage/produk/' . $produk->foto_produk) : asset('assets/image/no-image.jpg') }}"
                                        alt="">

                                </div>
                            </div>
                        </div>
                        <div class="descripsi-product">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-detail-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-detail" type="button" role="tab" aria-controls="nav-detail"
                                    aria-selected="true">Detail</button>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-detail" role="tabpanel"
                                    aria-labelledby="nav-detail-tab">
                                    <p><b>Nama Produk :</b> {{ $produk->nama }}<span class="primary-text"></span></p>
                                    <p><b>Kategori :</b> {{ $produk->kategori->nama }}<span class="primary-text"></span>
                                    </p>
                                    <div class="desc-section">
                                        <p><b>Deskripsi :</b> {{ $produk->deskripsi }}</p>
                                        <p class="text-desc">

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
