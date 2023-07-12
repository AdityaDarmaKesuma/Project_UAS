<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E L E K U - Detail Produk</title>

    <!--Bootstrap Css-->
    <link rel="stylesheet" href="../../assets/vendor/bootstrap/css/bootstrap.min.css">

    <!--Slick CSS-->
    <link rel="stylesheet" href="../../assets/vendor/slick/slick.css">
    <link rel="stylesheet" href="../../assets/vendor/slick/slick-theme.css">

    <!--App Css-->
    <link rel="stylesheet" href="../../assets/css/app.css">

    <!--CSS Assets this page-->
    <link rel="stylesheet" href="../../assets/css/detailProduct.css">

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
                        <!-- <div class="searchMenu">
                            <form action="">
                                <div class="input-group">
                                    <div class="form-outline">
                                        <input type="search" id="form1" class="form-control" />
                                        <label class="form-label" for="form1">Search</label>
                                    </div>
                                    <button type="button" class="buttonSearch button button-primary">
                                        <img src="./assets/img/icon/search_icon.svg" alt="" />
                                    </button>
                                </div>
                            </form>
                        </div> -->
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

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <!--Vendor-->
    <!--Jquery-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <!--Bootstrap-->
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--Slick Js-->
    <script src="../../assets/vendor/slick/slick.min.js"></script>
    <script src="../../assets/vendor/slick/slick.js"></script>

    <!--Slick Images Product-->
    <script>
        $('.view-Images').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            adaptiveHeight: true,
            infinite: false,
            useTransform: true,
            speed: 400,
            asNavFor: '.nav-images',
            cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
        });

        $('.nav-images')
            .on('init', function(event, slick) {
                $('.nav-images .slick-slide.slick-current').addClass('is-active');
            })
            .slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                dots: false,
                focusOnSelect: false,
                infinite: false,
                asNavFor: '.view-Images',
            });

        $('.view-Images').on('afterChange', function(event, slick, currentSlide) {
            $('.nav-images').slick('slickGoTo', currentSlide);
            var currrentNavSlideElem = '.nav-images .slick-slide[data-slick-index="' + currentSlide + '"]';
            $('.nav-images .slick-slide.is-active').removeClass('is-active');
            $(currrentNavSlideElem).addClass('is-active');
        });

        $('.nav-images').on('click', '.slick-slide', function(event) {
            event.preventDefault();
            var goToSingleSlide = $(this).data('slick-index');

            $('.view-Images').slick('slickGoTo', goToSingleSlide);
        });
    </script>

    <!--Quantity Input-->
    <script>
        var QtyInput = (function() {
            var $qtyInputs = $(".quantity-product");

            if (!$qtyInputs.length) {
                return;
            }

            var $inputs = $qtyInputs.find(".product-quantity");
            var $countBtn = $qtyInputs.find(".quantity-count");
            var qtyMin = parseInt($inputs.attr("min"));
            var qtyMax = parseInt($inputs.attr("max"));

            $inputs.change(function() {
                var $this = $(this);
                var $minusBtn = $this.siblings(".quantity-count--minus");
                var $addBtn = $this.siblings(".quantity-count--add");
                var qty = parseInt($this.val());

                if (isNaN(qty) || qty <= qtyMin) {
                    $this.val(qtyMin);
                    $minusBtn.attr("disabled", true);
                } else {
                    $minusBtn.attr("disabled", false);

                    if (qty >= qtyMax) {
                        $this.val(qtyMax);
                        $addBtn.attr('disabled', true);
                    } else {
                        $this.val(qty);
                        $addBtn.attr('disabled', false);
                    }
                }
            });

            $countBtn.click(function() {
                var operator = this.dataset.action;
                var $this = $(this);
                var $input = $this.siblings(".product-quantity");
                var qty = parseInt($input.val());

                if (operator == "add") {
                    qty += 1;
                    if (qty >= qtyMin + 1) {
                        $this.siblings(".quantity-count--minus").attr("disabled", false);
                    }

                    if (qty >= qtyMax) {
                        $this.attr("disabled", true);
                    }
                } else {
                    qty = qty <= qtyMin ? qtyMin : (qty -= 1);

                    if (qty == qtyMin) {
                        $this.attr("disabled", true);
                    }

                    if (qty < qtyMax) {
                        $this.siblings(".quantity-count--add").attr("disabled", false);
                    }
                }

                $input.val(qty);
            });
        })();
    </script>

    <script>
        function updateSummary() {
            var quantity = parseInt($('.product-quantity').val());
            var price = parseInt($('#price').text().replace(/[^0-9]/g, ''));
            var totalPrice = quantity * price;

            $('.total-order span').text(quantity);
            $('.total-price span').text(totalPrice.toLocaleString()); // Memformat total harga dengan format angka
        }

        $('.quantity-count--add').click(function() {
            var quantityInput = $(this).siblings('.product-quantity');
            var maxQuantity = parseInt(quantityInput.attr('max'));
            var currentQuantity = parseInt(quantityInput.val());
            if (currentQuantity < maxQuantity) {
                currentQuantity += 0;
                quantityInput.val(currentQuantity);
                updateSummary();
            }
        });

        $('.quantity-count--minus').click(function() {
            var quantityInput = $(this).siblings('.product-quantity');
            var minQuantity = parseInt(quantityInput.attr('min'));
            var currentQuantity = parseInt(quantityInput.val());
            if (currentQuantity > minQuantity) {
                currentQuantity -= 0;
                quantityInput.val(currentQuantity);
                updateSummary();
            }
        });

        $('#add-to-cart').click(function() {
            var quantity = parseInt($('.product-quantity').val());
            var price = parseInt($('#price').text().replace(/[^0-9]/g, ''));
            var totalPrice = quantity * price;
            var productName = $('.name').data('name'); // Mengambil nama produk
            var imageSrc = $('.product-image').attr('src');

            // Mengambil data yang sudah ada dalam localStorage (jika ada)
            var cartData = JSON.parse(localStorage.getItem('cartData')) || [];

            // Menambahkan data baru ke dalam array
            var newData = {
                quantity: quantity,
                totalPrice: totalPrice,
                productName: productName,
                price: price,
                imageSrc: imageSrc
            };
            cartData.push(newData);

            // Menyimpan data ke localStorage sebagai string
            localStorage.setItem('cartData', JSON.stringify(cartData));

            // Tampilkan pesan sukses atau lakukan tindakan lainnya
            alert('Produk telah ditambahkan ke keranjang.');
            location.reload(); // Lakukan refresh halaman

            // Bersihkan nilai jumlah order dan update summary
            $('.product-quantity').val(0);
            updateSummary();
        });


        $(document).ready(function() {
            // Mengambil data dari localStorage saat halaman dimuat
            var cartData = JSON.parse(localStorage.getItem('cartData')) || [];

            if (cartData.length > 0) {
                var lastData = cartData[cartData.length - 1];
                // Mengisi nilai jumlah order, total harga, dan nama produk dari data terakhir
                $('.product-quantity').val(lastData.quantity);
                $('.total-order span').text(lastData.quantity);

                var price = parseInt($('#price').text().replace(/[^0-9]/g, ''));
                $('.total-price span').text((price * lastData.quantity).toLocaleString());

                $('.name-product').text(lastData.productName);
                $('.images.product').text(lastData.imageSrc);
            } else {
                updateSummary();
            }
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
