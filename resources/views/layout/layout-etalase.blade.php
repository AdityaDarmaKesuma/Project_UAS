<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E L E K U - Produk</title>

    <!--Bootstrap Css-->
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css" />

    <!--Slick CSS-->
    <link rel="stylesheet" href="./assets/vendor/slick/slick.css" />
    <link rel="stylesheet" href="./assets/vendor/slick/slick-theme.css" />

    <!--App Css-->
    <link rel="stylesheet" href="./assets/css/app.css" />

    <!--Main CSS-->
    <link rel="stylesheet" href="./assets/css/main.css" />

    <link rel="icon" type="image/png" href="{{ asset('assets/image/virtual.png') }}" />

</head>

<body>
    <style>
        .dropdown-toggle::after {
            content: none !important;
        }
    </style>

    <div id="app">
        <div id="navbar" class="fixed-top" style="background-color:royalblue;">
            <div class="container">
                <div class="navbar-wrapper">
                    <div class="leftSideNavbar">
                        <div class="logo-brand">
                            <a href="" class="text-white text-decoration-none">
                                <h1 class="ps-3 pe-3">E L E K U</h1>
                            </a>
                        </div>
                    </div>

                    <div class="rightSideNavbar">
                        <div class="beforeLogin">
                            <div class="buttonWrapper">
                                @if (Route::has('login'))
                                    @auth
                                        @if (auth()->user()->role == 'admin')
                                            <a href="{{ route('dashboard') }}"
                                                class="button button-outline button-outline-primary">Dashboard</a>
                                        @endif
                                        <form action="{{ route('user.logout') }}" method="POST">
                                            @csrf
                                            <button class="button button-outline button-outline-primary"
                                                type="submit">Logout</button>
                                        </form>
                                        {{-- <a href="/login" class="button button-outline button-outline-primary">Logout</a> --}}
                                    @else
                                        <div></div>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @yield('content')
    </div>
    </div>

    <!--Vendor-->
    <!--Jquery-->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <!--Bootstrap-->
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--Slick Js-->
    <script src="./assets/vendor/slick/slick.min.js"></script>
    <script src="./assets/vendor/slick/slick.js"></script>

    <script>
        $(".wrapperBanner").slick({
            Infinity: true,
            centerMode: true,
            centerPadding: "120px",
            slidesToShow: 1,
            arrows: false,
            dots: true,
            appendDots: $(".slick-slider-dots"),

            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        centerPadding: "100px",
                    },
                },
                {
                    breakpoint: 992,
                    settings: {
                        centerPadding: "60px",
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        centerPadding: "40px",
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        centerPadding: "40px",
                    },
                },
                {
                    breakpoint: 475,
                    settings: {
                        centerMode: false,
                    },
                },
            ],
        });
    </script>

    <script>
        $(".bestOfferProduct").slick({
            dots: false,
            infinite: false,
            arrows: false,
            speed: 300,
            slidesToShow: 3.2,
            slidesToScroll: 3,

            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2.2,
                    slidesToScroll: 2,
                },
            }, ],
        });
    </script>


    <script>
        $(document).ready(function() {
            // Mengambil data dari localStorage saat halaman dimuat
            var cartData = JSON.parse(localStorage.getItem('cartData')) || [];

            function updateTotalItem() {
                var totalItem = cartData.length;
                $('.totalItem').text(totalItem);
            }

            // Fungsi untuk menghasilkan elemen HTML untuk setiap item dalam data keranjang
            function generateCartItemHTML(item, index) {
                return `
                <div class="product-list">
                    <div class="form-check checkbox-select checkbox-item">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    </div>
                    <div class="product-detail">
                        <div class="image-product">
                            <img src="${item.imageSrc}" alt="">
                        </div>
                        <div class="wrapper-info-product">
                            <div class="name-price-product">
                                <h5>${item.productName}</h5>
                                <p>Rp. <span class="price" data-price="${item.totalPrice}" data-index="${index}">${item.totalPrice}</span></p>
                            </div>
                            <p class="price-per-plant">Rp. <span class="price-plant">${item.price}</span>/Produk</p>
                            <div class="action-cart">
                                <div class="quantity-product">
                                    <button class="quantity-count quantity-count--minus" data-action="minus" type="button" data-index="${index}">-</button>
                                    <input class="product-quantity" type="number" name="product-quantity" min="0" max="10" value="${item.quantity}" data-index="${index}">
                                    <button class="quantity-count quantity-count--add" data-action="add" type="button" data-index="${index}">+</button>
                                </div>
                                <button class="delete-cart-button" data-index="${index}">
                                    <img src="./assets/img/icon/trash-delete-icon.svg" alt="">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                `;
            }

            // Fungsi untuk mengupdate total price
            function updateTotalPrice() {
                var totalPrice = 0;
                for (var i = 0; i < cartData.length; i++) {
                    totalPrice += cartData[i].totalPrice;
                }
                $('.value-total-fix').text('Rp. ' + totalPrice);
            }

            // Fungsi untuk mengupdate harga total per item
            function updateItemTotalPrice(index) {
                var item = cartData[index];
                var priceElement = $('.price[data-index="' + index + '"]');
                priceElement.text(item.totalPrice);
                priceElement.attr('data-price', item.totalPrice);
            }

            // Fungsi untuk menghapus item dari keranjang berdasarkan index
            function deleteCartItem(index) {
                cartData.splice(index, 1);
                localStorage.setItem('cartData', JSON.stringify(cartData));
                $('.body-cart').empty(); // Menghapus elemen HTML sebelum memperbarui
                updateCartItems(); // Memperbarui tampilan keranjang setelah menghapus item
                updateTotalPrice(); // Memperbarui total price
                updateTotalItem();
            }

            // Fungsi untuk memperbarui quantity item dalam keranjang
            function updateCartItemQuantity(index, quantity) {
                cartData[index].quantity = quantity;
                cartData[index].totalPrice = quantity * cartData[index].price; // Mengupdate totalPrice
                localStorage.setItem('cartData', JSON.stringify(cartData));
                updateTotalPrice(); // Memperbarui total price
                updateItemTotalPrice(index); // Memperbarui harga total per item
            }

            // Menambahkan elemen HTML untuk setiap item dalam data keranjang
            function updateCartItems() {
                var cartContainer = $('.body-cart');
                for (var i = 0; i < cartData.length; i++) {
                    var itemHTML = generateCartItemHTML(cartData[i], i);
                    cartContainer.append(itemHTML);
                }
            }

            // Menangani klik tombol minus dan plus
            $('.body-cart').on('click', '.quantity-count', function() {
                var action = $(this).data('action');
                var index = $(this).data('index');
                var quantityInput = $('.product-quantity[data-index="' + index + '"]');
                var quantity = parseInt(quantityInput.val());
                if (action === 'minus' && quantity > 0) {
                    quantityInput.val(quantity - 1);
                    updateCartItemQuantity(index, quantity - 1);
                } else if (action === 'add' && quantity < 10) {
                    quantityInput.val(quantity + 1);
                    updateCartItemQuantity(index, quantity + 1);
                }
            });

            // Menangani klik tombol hapus
            $('.body-cart').on('click', '.delete-cart-button', function() {
                var index = $(this).data('index');
                deleteCartItem(index);
            });

            updateCartItems(); // Memperbarui tampilan keranjang saat halaman dimuat
            updateTotalPrice(); // Memperbarui total price saat halaman dimuat
            updateTotalItem();
        });
    </script>
</body>

</html>
