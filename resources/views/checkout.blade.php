<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BrewBase - Checkout</title>
    <link rel="shortcut icon" href="logo/brewbase.ico" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <link rel="stylesheet" type="text/css" href="css/slick.css" />
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css" />
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

            <!-- breadcrumb_section - start
				================================================== -->
            <section class="breadcrumb_section text-uppercase" style="background-image: url(img/headerall.png)">
                <div class="container">
                    <h1 class="page_title text-black wow fadeInUp" data-wow-delay=".1s">Checkout</h1>
                    <ul class="breadcrumb_nav ul_li wow fadeInUp" data-wow-delay=".2s">
                        <li><a href="/" class="text-secondary"><i class="fas fa-home"></i> Home</a></li>
                        <li>Checkout</li>
                    </ul>
                </div>
                <div class="breadcrumb_icon_wrap">
                    <div class="container">
                        <div class="breadcrumb_icon wow fadeInUp" data-wow-delay=".3s">
                            <img src="images/icon_01_1.png" alt="icon_not_found">
                            <span class="bg_shape"></span>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb_section - end
				================================================== -->

            <!-- cart_section - start
        ================================================== -->
            <section class="cart_section sec_ptb_120 bg_default_gray">
                <div class="container container_boxed">
                    <div class="checkout_form">
                        <h2 class="form_title text-uppercase wow fadeInUp" data-wow-delay=".1s">Delivery Address</h2>
                        <div class="checkout_address wow fadeInUp" data-wow-delay=".2s">
                        </div>
                        <h2 class="form_title text-uppercase wow fadeInUp" data-wow-delay=".1s">item details</h2>
                        <div class="checkout_items wow fadeInUp" data-wow-delay=".2s">
                            <hr>
                        </div>
                        <h2 class="form_title text-uppercase" data-wow-delay=".1s">Select payment Method
                        </h2>
                        <ul class="checkout_steps_nav ul_li wow fadeInUp" data-wow-delay=".2s">
                            <li id="direct"><a href="#!">Direct Bank Transfer</a></li>
                            <li id="cod"><a href="#!">Cash on Delivery</a></li>
                        </ul>
                        <h2 class="direct_bank_transfer form_title text-uppercase">Direct bank transfer</h2>
                        <div class="direct_bank_transfer row p-0 ">
                            <div class="col-md-6">
                                <div class="card_info row">
                                    <div class="col-lg-12">
                                        <div class="form_item">
                                            <h4 class="form_field_title">Card Number <sup class="text-danger">*</sup></h4>
                                            <input class="direct_transfer" type="text" name="card_number" id="card_number" placeholder="0000 0000 0000 0000" minlength="19" maxlength="19" size="18">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form_item">
                                            <h4 class="form_field_title">Expiration Date <sup class="text-danger">*</sup></h4>
                                            <input class="direct_transfer" type="text" name="exp_date" id="card_exp" placeholder="MM / YY" size="6" minlength="5" maxlength="5">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form_item">
                                            <h4 class="form_field_title">CV Code <sup class="text-danger">*</sup>
                                            </h4>
                                            <input class="direct_transfer" type="text" name="cv_code" placeholder="000" size="1" minlength="3" maxlength="3">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form_item">
                                            <h4 class="form_field_title">Card Owner <sup class="text-danger">*</sup>
                                            </h4>
                                            <input class="direct_transfer" type="text" name="card_owner" placeholder="Card Owner Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" col-md-12">
                                    <h6>Delivery Address</h6>
                                    <div class="order_del_add mb-2 pl-0">

                                    </div>
                                    <div class="totalsummary">
                                        <h6>Total Summary</h6>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="cash_on_delivery form_title text-uppercase">
                            Cash on Delivery</h2>
                        <div class="cash_on_delivery row p-0 ">
                            <div class=" col-md-12">
                                <h6>Delivery Address</h6>
                                <div class="order_del_add mb-2 pl-0">

                                </div>
                                <div class="totalsummary">
                                    <h6>Total Summary</h6>
                                    <hr>
                                    <hr>
                                </div>

                            </div>
                        </div>
                        <div class="checkout_form_footer ml-3 mr-3">
                            <span class="total_price"></span>
                            <button id="place_order" type="button" class="btn btn_primary text-uppercase">place
                                order</button>
                        </div>

                    </div>
                </div>
            </section>
            <!-- cart_section - end
        ================================================== -->

        </main>
        <!-- main body - end
			================================================== -->

        <!-- footer_section - start
      ================================================== -->
      @include('layout\footer')
        <!-- footer_section - end
      ================================================== -->
        <div class="modal fade" id="ordersuccess" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ordersuccessLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body ">
                        <div class="text-right">
                            <i class="fa fa-close close" data-dismiss="modal"></i>
                        </div>
                        <div class="px-4 py-5">
                            <h5 class="text-uppercase profile_name"></h5>
                            <h4 class="mt-5  mb-5" style="color: #c7a17a;">Thanks for your order</h4>
                            <h6 class="mt-2 mb-2">Order No: <span id="orderNo"></span></h6>
                            <span class="theme-color">Payment Summary</span>
                            <div class="mb-3">
                                <hr style="border-top: 2px dashed #626262;margin: 0.4rem 0;">
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="font-weight-bold">Products Subtotal</span>
                                <span class="text-muted">₱<span class="prodTotal"></span></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <small>Add-ons</small>
                                <small>₱<span class="addonsTotal"></span></small>
                            </div>
                            <div class="d-flex justify-content-between">
                                <small>Delivery Fee</small>
                                <small>₱0.00</small>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <span class="font-weight-bold">Total</span>
                                <span class="font-weight-bold theme-color">₱<span class="totalAmount"></span></span>
                            </div>
                            <div class="text-center mt-5">
                                <button class="btn btn_primary" onclick="location.replace('order')">MY ORDER</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- body_wrap - end -->

    <!-- All Script -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.cookie.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/pages_js/checkout.js"></script>i
    <!-- END Script -->
</body>

</html>