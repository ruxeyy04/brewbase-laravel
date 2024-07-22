<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrewBase - Home</title>
    <link rel="shortcut icon" href="{{ asset('logo/brewbase.ico') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}" />
</head>


<body>

    <!-- body_wrap - start -->
    <div class="body_wrap">

        <!-- backtotop - start -->
        <div class="backtotop">
            <a href="#" class="scroll">
                <i class="fa-sharp fa-solid fa-arrow-up"></i>
                <i class="fa-sharp fa-solid fa-arrow-up"></i>
            </a>
        </div>
        <!-- backtotop - end -->

        <!-- preloader - start -->
        <div id="preloader"></div>
        <!-- preloader - end -->

        <!-- header_section - start
            ================================================== -->
        <header class="header_section style_3">
            <div class="content_wrap">
                <div class="container maxw_1720">
                    <div class="row align-items-center">

                        <div class="col-lg-2 col-md-5 col-5">
                            <div class="brand_logo">
                                <a class="brand_link" href="/">
                                    <img src="logo/brewbase-blck.png" alt="logo_not_found">
                                </a>
                            </div>
                        </div>

                        @include('layout\navigation')


                    </div>
                </div>
            </div>

            <!-- collapse search - start -->
            @include('layout\searchbar')
            <!-- collapse search - end -->
        </header>
        <!-- header_section - end ================================================== -->

        <!-- main body - start ================================================== -->
        <main>
            <!-- user_sidebar - start ================================================== -->
            @include('layout\usersidebar')
            <!-- user_sidebar - end ================================================== -->
            <!-- cart_sidebar - start  ================================================== -->
            @include('layout\cartsidebar')
            <!-- cart_sidebar - end ================================================== -->

            <!-- slider_section - start
        ================================================== -->
            @include('home_layout\slidersection')
            <!-- slider_section - end
        ================================================== -->
            <!-- feature_primary box_style wow fadeInUp -->
            <!-- feature_primary_section - start
        ================================================== -->
            @include('home_layout\featureprimary')
            <!-- feature_primary_section - end
        ================================================== -->

            <!-- about_section - start
        ================================================== -->
            @include('home_layout\aboutsection')
            <!-- about_section - end
        ================================================== -->

            <!-- recipe_menu_section - start
        ================================================== -->
            <section class="recipe_menu_section sec_ptb_120 bg_gray deco_wrap">
                <div class="container">
                    <div class="section_title text-uppercase text-center">
                        <h3 class="big_title wow fadeInUp" data-wow-delay=".2s">
                            Brewbase menu
                        </h3>
                    </div>

                    <ul class="cattt filters-button-group ul_li_center wow fadeInUp" data-wow-delay=".3s">
                        <li><button class="button text-uppercase active" data-filter="*">all</button></li>
                    </ul>

                    <div class="recipe_item_grid grid wow fadeInUp" data-wow-delay=".4s">
                    </div>
                    <ul class="pagination_nav ul_li_center">
                        <li><a href="#!"><i class="fa-solid fa-angles-left"></i></a></li>
                        <li class="active"><a href="#!">1</a></li>
                        <li><a href="#!"><i class="fa-solid fa-angles-right"></i></a></li>
                    </ul>
                </div>

                <div class="deco_item shape_1">
                    <img src="images/shape_01_1.png" alt="image_not_found">
                </div>
                <div class="deco_item shape_2">
                    <img src="images/shape_02_1.png" alt="image_not_found">
                </div>
            </section>
            <!-- recipe_menu_section - end
        ================================================== -->
            <!-- Our Products sesion -->
            @include('home_layout\ourproducts')
            <!-- END Our Products Sesion -->

            <!-- shop_section - start
        ================================================== -->
            <section class="shop_section sec_ptb_120 bg_gray">
                <div class="container">
                    <div class="section_title text-uppercase">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-8">
                                <h3 class="big_title wow fadeInUp" data-wow-delay=".2s">
                                    Our Affordable Drink
                                </h3>
                            </div>

                            <div class="col-lg-6 col-md-4">
                                <div class="abtn_wrap text-lg-end text-md-end">
                                    <a class="btn btn_border border_black" href="products">See all product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Display New Products --}}

                    {{-- <div class="affordabledrink row justify-content-center wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        @foreach($newProducts['new'] as $value)
                        <div class="afford col-lg-4 col-md-6 col-sm-6">
                            <div class="shop_card">
                                <a class="{{ $value['is_added_to_wishlist'] ? 'wishlist_btn wishlist_added' : 'wishlist_btn' }}" href="#!" data-prodid="{{ $value['number'] }}">
                    <i class="{{ $value['is_added_to_wishlist'] ? 'fa-solid fa-heart' : 'fa-sharp fa-regular fa-heart' }}"></i>
                    </a>
                    <a class="item_image" href="productdetails?name={{ $value['prodname'] }}">
                        <img src="productimg/{{ $value['image'] }}" alt="image_not_found">
                    </a>
                    <div class="item_content">
                        <h3 class="item_title text-uppercase">
                            <a href="productdetails?name={{ $value['prodname'] }}">{{ $value['prodname'] }}</a>
                        </h3>
                        <div class="btns_group">
                            <span class="item_price bg_default_brown"><i class="fa-solid fa-peso-sign"></i> {{ $value['price'] }}</span>
                            <button class="{{ $value['is_added_to_cart'] ? 'btn btn_secondary text-uppercase addtocart' : 'btn btn_border border_black text-uppercase addtocart' }}" href="#!" data-prodid="{{ $value['number'] }}" {{ $value['status'] == 'Not Available' ? 'disabled' : '' }}>
                                {{ $value['is_added_to_cart'] ? 'Added to Cart' : 'Add to Cart' }}
                            </button>
                        </div>
                    </div>
                </div>
    </div>
    @endforeach
    </div>
    --}}
    <div class="affordabledrink row justify-content-center wow fadeInUp" data-wow-delay=".2s">

    </div>
    <ul class="pagination_nav1 ul_li_center">
    </ul>
    </div>
    </section>
    <!-- shop_section - end
        ================================================== -->

    </main>
    <!-- main body - end
      ================================================== -->

    <!-- footer_section - start
      ================================================== -->
    @include('layout\footer')
    <!-- footer_section - end
      ================================================== -->

    </div>
    <!-- body_wrap - end -->

    <!-- All Script -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mCustomScrollbar.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/jquery.cookie.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/pages_js/home_index.js') }}"></script>
    <!-- END Script -->

</body>

</html>