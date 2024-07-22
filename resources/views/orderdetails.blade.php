<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BrewBase - Order Details</title>
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
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
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
                    <h1 class="page_title text-black wow fadeInUp" data-wow-delay=".1s">order details</h1>
                    <ul class="breadcrumb_nav ul_li wow fadeInUp" data-wow-delay=".2s">
                        <li><a href="index" class="text-secondary"><i class="fas fa-home"></i> Home</a></li>
                        <li>order details</li>
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
            <!-- orderdetails - start
				================================================== -->
            <section class="orderdetails_section sec_ptb_120 bg_default_gray">
                <div class="container ">
                    <div class="ordetail_header d-flex justify-content-between border-bottom">
                        <div class="orderback" onclick="location.replace('order')">
                            <i class="fa-solid fa-chevron-left"></i> <span>BACK</span>
                        </div>
                        <div class="ordernum">
                            <span>ORDER #: 20234989</span>
                            <span class="m-1">|</span>
                            <span class="font-weight-bold text-info">PENDING</span>
                        </div>

                    </div>
                    <div class="order_sec">
                        <div class="col-12 ord_track d-flex align-items-center justify-content-between">
                            <span id="orderInfo"></span>
                            <button class="btn btn_secondary" data-toggle="modal" data-target="#tracking">Tracking
                                Details</button>
                        </div>
                    </div>
                    <div class="order_payment_method">
                        <span class="font-weight-bold">Order Number: <span class="orderID"></span></span>
                        <span>Placed on <span class="orderDate"></span></span>
                        <span>Paid on <span class="paymentMethod"></span></span>
                    </div>
                    <div class="row p-0">
                        <div class=" col-md-6 vjkrto">
                            <div class="cCejjr row ml-0">
                                <div class="order_del_add col-md-12">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="order_total col-md-12">
                                <h6>Total Summary</h6>
                                <hr>
                                <div class="row m-0 d-flex justify-content-between subTotal">

                                </div>
                                <div class="row m-0 d-flex justify-content-between">
                                    <span>Add-ons: </span><span class="font-weight-bold">₱<span class="addonsTotal"></span></span>
                                </div>
                                <div class="row m-0 d-flex justify-content-between">
                                    <span>Delivery Fee:</span><span class="font-weight-bold">₱0.00</span>
                                </div>
                                <hr>
                                <div class="row d-flex justify-content-between m-0 align-items-center">
                                    <h6>Total</h6><span class="font-weight-bold" style="font-size: 20px; color: black;">₱<span class="totalAmount"></span></span>
                                </div>
                                <hr>
                                <p class="m-0">Paid on <span class="paymentMethod"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- orderdetails - end
				================================================== -->
            <div class="modal fade" id="tracking" tabindex="-1" aria-labelledby="tracking" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 0px">
                        <div class="modal-header">
                            <h5 class="modal-title">My Orders / Tracking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6>Order ID: <span class="orderID"></span></h6>
                            <article class="tracking_card card">
                                <div class="tracking_card card-body row">
                                    <div class="col-lg-4 mb-2"> <strong>Estimated Delivery time:</strong> <br><span id="estTime"></span></div>
                                    <div class="col-lg-4 mb-2"> <strong>Prepared by:</strong> <br> <span class="prepared"></span>
                                    </div>
                                    <div class="col-lg-4"> <strong>Status:</strong> <br> <span class="status"></span></div>
                                </div>
                            </article>
                            <div class="track">
                                <div class="step"> <span class="icon"> <i class="fa-regular fa-clock"></i></span> <span class="text">Pending</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order
                                        Confirmed</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"><span>On the
                                            Way</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready to
                                        Receive</span> </div>
                            </div>
                            <hr>
                            <ul class="track_item row">

                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn_secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="js/pages_js/orderdetails.js"></script>

    <!-- END Script -->
</body>

</html>