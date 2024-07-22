<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BrewBase - Login</title>
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

        <!-- main body - start
                    ================================================== -->
        <main>
            <!-- user_sidebar - start ================================================== -->
            @include('layout\usersidebar')
            <!-- user_sidebar - end ================================================== -->
            <!-- cart_sidebar - start  ================================================== -->
            @include('layout\cartsidebar')
            <!-- cart_sidebar - end ================================================== -->

            <!-- loginform - start
        ================================================== -->
            <div class=" bg_default_gray d-flex align-items-center" style="width: 100vw;height: 100vh;">
                <div class="login container d-flex justify-content-center">
                    <div class="contact_form bg_white wow fadeInUp col-sm-5" data-wow-delay=".1s">
                        <h1 class="text-center mb-4">Login</h1>
                        <form action="#">
                            <div class="form_item username">
                                <input class="form-control" type="text" name="username" placeholder="Username/Email">
                                <div class="invalid-feedback text-center">
                                    The username/email entered is not registered.
                                </div>
                            </div>
                            <div class="form_item password">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                                <div class="invalid-feedback text-center">
                                    The password is incorrect.
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="checkuser btn btn_primary text-uppercase">next</button>
                            </div>
                        </form>
                        <h6 class="text-center mt-3 createacc" style="cursor: pointer;" data-toggle="modal" data-target="#registrationModal">
                            Create an Account</h6>
                    </div>
                </div>

            </div>
            <!-- loginform - end
          ================================================== -->
            <!-- register modal start -->
            <!-- Large Modal -->
            <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModal" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="bg_white wow fadeInUp col-sm-12" data-wow-delay=".1s" style="  padding: 20px 50px;
        background-color: #f6f6f6;">
                                <h1 class="text-center mb-4">Registration</h1>
                                <form action="#" class="register" id="reg">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form_item">
                                                <input class="form-control" type="text" name="fname" placeholder="First Name:">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form_item">
                                                <input class="form-control" type="text" name="lname" placeholder="Last Name:">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form_item">
                                                <input class="form-control username" type="text" name="user" placeholder="Username:">
                                                <div class="invalid-feedback text-center uin">
                                                    The username is already used
                                                </div>
                                                <div class="valid-feedback text-center uva">
                                                    Username is Available
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form_item">
                                                <input class="form-control email" type="email" name="email" placeholder="Email:">
                                                <div class="invalid-feedback text-center ein">
                                                    The email is already used
                                                </div>
                                                <div class="valid-feedback text-center eva">
                                                    Email is Available
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form_item" style="position: relative;">
                                                <input class="form-control pass1" type="password" name="pass" placeholder="Password:">
                                                <i class="fas fa-eye toggle-password"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form_item" style="position: relative;">
                                                <input class="form-control pass2" type="password" name="pass_confirmation" placeholder="Confirm Password:" disabled>
                                                <i class="fas fa-eye toggle-password"></i>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="pass-validation d-none">
                                        <p class="text-center text-danger d-none">Password not Match</p>
                                        <p class="text-center text-success d-none">Password Matched</p>
                                    </div>

                                    <div class="pass-spec row d-none justify-content-center">
                                        <div class="col-sm-6 mb-4">
                                            <h5 class="text-center">Password must contain:</h5>
                                            <ul class="list-group">
                                                <!-- <i class="fa-solid fa-check"></i> -->
                                                <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
                                                    least 8 characters</li>
                                                <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
                                                    least 1 lower letter (a-z)
                                                </li>
                                                <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
                                                    least 1 uppercase letter
                                                    (A-Z)</li>
                                                <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
                                                    least 1 number (0-9)</li>
                                                <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
                                                    least 1 special characters
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn_primary text-uppercase signup" disabled>Sign-up</button>
                                    </div>
                                </form>
                                <h6 class="text-center mt-3" style="cursor: pointer;" data-dismiss="modal">
                                    Go back to Login</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- register modal end  -->
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
    <script src="js/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.cookie.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/pages_js/login.js"></script>
    <!-- END Script -->
</body>

</html>