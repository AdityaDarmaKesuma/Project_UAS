@extends('layout.layout-etalase')

@section('content')
    <div id="mainContent" style="margin-top: 150px">
        <div class="wrapperProduct line">
            <div class="container pb-5">
                <a href="#" class="header-line">
                    <img src="./assets/img/icon/icons8-open-end-wrench-100.png" alt="" />
                    <p>Semua Produk</p>
                </a>

                <div class="row">
                    @foreach ($produks as $produk)
                        <div class="col-6 col-lg-3">
                            <a href="{{ route('produk.detail', $produk->id) }}" class="product">
                                <div class="imagesProduct">
                                    <img src="{{ $produk->foto_produk ? asset('/storage/produk/' . $produk->foto_produk) : asset('assets/image/no-image.jpg') }}"
                                        width="250px" alt="">
                                </div>
                                <div class="infoProduct">
                                    <p class="nameProduct"><b>{{ $produk->nama }}</b></p>
                                    <p class="price">Rp. {{ number_format($produk->harga_jual) }}</p>
                                    <div class="discountDetail">
                                        <div class="discountValue"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
