<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BrewBase - Profile</title>
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
                    <h1 class="page_title text-black wow fadeInUp" data-wow-delay=".1s">Profile</h1>
                    <ul class="breadcrumb_nav ul_li wow fadeInUp" data-wow-delay=".2s">
                        <li><a href="index.html" class="text-secondary"><i class="fas fa-home"></i> Home</a></li>
                        <li>Profile</li>
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
            <!-- [ Main Content ] start -->
            <section class="userprofile_section sec_ptb_120 bg_default_gray">
                <div class="container">
                    <ul class="userprofile filters-button-group style_3 ul_li_center wow fadeInUp" data-wow-delay=".1s">
                        <li><button class="button text-uppercase active" data-filter=".profile"><i class="fa fa-user mr-2"></i> Profile</button></li>
                        <li><button class="button text-uppercase" data-filter=".personal"><i class="fa-solid fa-file-invoice mr-2"></i> personal</button></li>
                        <li><button class="button text-uppercase" data-filter=".myaccount"><i class="fa-solid fa-address-card mr-2"></i> my account</button></li>
                        <li><button class="button text-uppercase" data-filter=".changepassword"><i class="fa-solid fa-key mr-2"></i> change password</button></li>
                        <li><button class="button text-uppercase" data-filter=".deliveryaddress"><i class="fa-solid fa-map-location mr-2"></i> delivery address</button></li>
                        <!-- <li><button class="button text-uppercase" data-filter=".carddetails"><i
                                    class="fa-solid fa-credit-card"></i> Credit / Debit Card</button></li> -->
                    </ul>
                    <div class="userprofile_row grid wow fadeIn" data-wow-delay=".2s">
                        <div class="element_userprofile profile" data-category="profile">
                            <div class="row">
                                <div class="col-lg-4 col-xxl-3">
                                    <div class="card mb-4">
                                        <div class="card-body position-relative">
                                            <div class="text-center mt-3">
                                                <div class="chat-avtar d-inline-flex mx-auto wid-100">
                                                    <img class="rounded-circle profileImg" src="profileimg/default-pic.png" alt="User image">
                                                </div>
                                                <h5 class="mb-0 profileFullName">N/A</h5>
                                                <hr class="my-3">
                                                <div class="row g-3">
                                                    <div class="col-4">
                                                        <h5 class="mb-0 totalOrders"></h5>
                                                        <small class="text-muted">Order</small>
                                                    </div>
                                                    <div class="col-4 border border-top-0 border-bottom-0">
                                                        <h5 class="mb-0 totalPaid"></h5>
                                                        <small class="text-muted ">Total Invested</small>
                                                    </div>
                                                    <div class="col-4">
                                                        <h5 class="mb-0 totalWishlist"></h5>
                                                        <small class="text-muted ">Total Wishlist</small>
                                                    </div>
                                                </div>
                                                <hr class="my-3">
                                                <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                                    <i class="fa-solid fa-envelope"></i>
                                                    <p class="mb-0 profEmail"></p>
                                                </div>
                                                <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                                    <i class="fa fa-phone"></i>
                                                    <p class="mb-0 profPhoneNo"></p>
                                                </div>
                                                <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <p class="mb-0 profCountry"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-xxl-9">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5>Personal Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 pt-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Full Name</p>
                                                            <p class="mb-0 font-weight-bold fullName"></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">User Name</p>
                                                            <p class="mb-0 font-weight-bold uName"></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Phone/Tel No.</p>
                                                            <p class="mb-0 font-weight-bold profPhoneNo">
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Country</p>
                                                            <p class="mb-0 font-weight-bold uCountry"></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Email</p>
                                                            <p class="mb-0 font-weight-bold profEmail">
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Zip Code</p>
                                                            <p class="mb-0 font-weight-bold uzCode"></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5>Home Address</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 pt-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Street</p>
                                                            <p class="mb-0 font-weight-bold uStreet"></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Barangay</p>
                                                            <p class="mb-0 font-weight-bold uBarangay"></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">City</p>
                                                            <p class="mb-0 font-weight-bold uCity"></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Province/Region</p>
                                                            <p class="mb-0 font-weight-bold uProvince"></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 pb-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Postal/Zip Code</p>
                                                            <p class="mb-0 font-weight-bold uzCode">7200</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Country</p>
                                                            <p class="mb-0 font-weight-bold uCountry">Philippines</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card mb-4 defaultDeliveryAddress">
                                        <div class="card-header">
                                            <h5>Default Delivery Address</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 pt-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Street</p>
                                                            <p class="mb-0 font-weight-bold defStreet">NaN</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Barangay</p>
                                                            <p class="mb-0 font-weight-bold defBarangay">NaN</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">City</p>
                                                            <p class="mb-0 font-weight-bold defCity">NaN</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Province/Region</p>
                                                            <p class="mb-0 font-weight-bold defProvince">NaN</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 pb-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Postal/Zip Code</p>
                                                            <p class="mb-0 font-weight-bold defCode">NaN</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Country</p>
                                                            <p class="mb-0 font-weight-bold profCountry">NaN</p>
                                                        </div>

                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 pb-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Full Name | Contact No.</p>
                                                            <p class="mb-0 font-weight-bold defFullname">NaN</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Additional Address Information</p>
                                                            <p class="mb-0 font-weight-bold defAddInfo">NaN</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element_userprofile personal" data-category="personal">
                            <form action="" method="post" id="profileInfoField">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5>Personal Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 text-center mb-3">
                                                        <div class="user-upload wid-100">
                                                            <img class="user-image" src="profileimg/default-pic.png" alt="User image" width="100" height="100">
                                                            <label for="uplfile" class="img-avtar-upload">
                                                                <i class="fa fa-camera mb-1"></i>
                                                                <span>Upload</span>
                                                            </label>
                                                            <input type="file" id="uplfile" class="d-none" name="photo" accept="image/*">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" value="" name="fname" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Middle Name</label>
                                                            <input type="text" class="form-control" value="" name="midname" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" value="" name="lname" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Suffix</label>
                                                            <input type="text" class="form-control" value="" name="suffix" required>
                                                        </div>
                                                    </div>
                                                    <style>
                                                        /* Style the disabled select element to make it appear readonly */
                                                        #country-select {
                                                            background-color: #f0f0f0;
                                                            pointer-events: none;
                                                        }
                                                    </style>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Gender<span class="text-danger">*</span></label>
                                                            <select class="form-control" name="gender">
                                                                <option value="">Select Gender</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Rather not to Say">Rather not to Say</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Birth Date <span class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" value="" name="birthdate" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Country <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="country" id="country-select">
                                                                <option value="" required>Select Country</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Zip Code <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" value="" name="zipcode" required>
                                                            <div class="invalid-feedback text-center">
                                                                Invalid Zipcode
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5>Home Address Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Region <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="region" id="region-select" required>
                                                                <option value="">Select Region</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Province <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="province" id="province" disabled required>
                                                                <option value="">Select Province</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">City/Municipality <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="city" id="city" disabled required>
                                                                <option value="">Select City</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Barangay <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="barangay" id="barangay" disabled required>
                                                                <option value="">Select Barangay</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Street Name, Building, House No.
                                                                <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" required id="streetName" name="streetname"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5>Contact Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="phonenum">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Telephone Number <span class="text-danger"></span></label>
                                                            <input type="text" class="form-control" name="telnum">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-center">
                                        <div class="btn btn_primary" id="updateProfile">Update Profile</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="element_userprofile myaccount" data-category="myaccount">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5>General Settings</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Username <span class="text-danger">*</span></label>
                                                        <input type="text" name="username" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Account Email <span class="text-danger">*</span></label>
                                                        <input type="text" name="email" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-end d-flex justify-content-center mb-4">
                                    <button class="btn btn_primary updateMyAccount">Update Account</button>
                                </div>
                                <div class="col-lg-6 d-none">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5>Recognized IP</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 pt-0">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="me-2">
                                                            <p class="mb-2">192.168.1.0</p>
                                                            <p class="mb-0 text-muted">Region, Province</p>
                                                        </div>
                                                        <div class>
                                                            <div class="text-success d-inline-block me-2">
                                                                <i class="fas fa-circle f-8 me-2"></i>
                                                                Current Active
                                                            </div>
                                                            <a href="#!" class="text-danger"><i class="fa-regular fa-circle-xmark"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="me-2">
                                                            <p class="mb-2">34.398.28.3</p>
                                                            <p class="mb-0 text-muted">Region, Province</p>
                                                        </div>
                                                        <div class>
                                                            <div class="text-muted d-inline-block me-2">
                                                                <i class="fas fa-circle f-8 me-2"></i>
                                                                Active 5 days ago
                                                            </div>
                                                            <a href="#!" class="text-danger"><i class="fa-regular fa-circle-xmark"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 pb-0">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="me-2">
                                                            <p class="mb-2">201.483.48.3</p>
                                                            <p class="mb-0 text-muted">Region, Province</p>
                                                        </div>
                                                        <div class>
                                                            <div class="text-muted d-inline-block me-2">
                                                                <i class="fas fa-circle f-8 me-2"></i>
                                                                Active 1 month ago
                                                            </div>
                                                            <a href="#!" class="text-danger"><i class="fa-regular fa-circle-xmark"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-none">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5>Active Sessions</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 pt-0">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="me-2">
                                                            <p class="mb-2">Mozilla/5.0 (Windows NT 10.0; Win64;
                                                                x64) AppleWebKit/537.36 (KHTML, like Gecko)
                                                                Chrome/112.0.0.0 Safari/537.36</p>
                                                            <p class="mb-0 text-muted">10.0.0.1</p>
                                                        </div>
                                                        <button class="btn1 btn-link-danger">Logout</button>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 pb-0">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="me-2">
                                                            <p class="mb-2">Mozilla/5.0 (Windows NT 10.0; Win64;
                                                                x64) AppleWebKit/537.36 (KHTML, like Gecko)
                                                                Chrome/112.0.0.0 Safari/537.36</p>
                                                            <p class="mb-0 text-muted">192.168.1.0</p>
                                                        </div>
                                                        <button class="btn1 btn-link-danger">Logout</button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="element_userprofile changepassword" data-category="changepassword">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Change Password</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Old Password</label>
                                                <input type="password" class="form-control oldpass" name="oldpass">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">New Password</label>
                                                <input type="password" class="form-control pass1">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control pass2" name="newpass" disabled>
                                            </div>
                                        </div>
                                        <div class="pass-spec col-sm-6">
                                            <h5>New password must contain:</h5>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i>
                                                    At
                                                    least 8 characters</li>
                                                <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i>
                                                    At
                                                    least 1 lower letter (a-z)
                                                </li>
                                                <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i>
                                                    At
                                                    least 1 uppercase letter
                                                    (A-Z)</li>
                                                <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i>
                                                    At
                                                    least 1 number (0-9)</li>
                                                <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i>
                                                    At
                                                    least 1 special characters
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <button class="btn btn_primary" id="updatePassword" disabled>Update Password</button>
                                </div>
                            </div>
                        </div>
                        <div class="element_userprofile deliveryaddress" data-category="deliveryaddress">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>Delivery Addresses</h5><button class="btn btn_primary" data-toggle="modal" data-target="#addnewaddress" id="btnAddressAdd"><i class="fa-solid fa-plus"></i> New
                                        Address</button>
                                </div>
                                <div class="card-body">
                                    <h4><span id="deladdcount">0</span>/5 <small>Available Delivery
                                            Addresses</small></h4>
                                    <hr class="my-3">
                                    <div class="deladdresses" id="deliveryData">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element_userprofile carddetails" data-category="carddetails">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>Credit / Debit Card</h5><button class="btn btn_primary" data-toggle="modal" data-target="#addnewaddress"><i class="fa-solid fa-plus"></i> New
                                        Card</button>
                                </div>
                                <div class="card-body">
                                    <h4><span id="deladdcount">1</span>/5 <small>Available Credit / Debit Card</small></h4>
                                    <hr class="my-3">
                                    <div class="deladdresses">
                                        <div class="p-3 bg-gradient-light  rounded-lg">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <p><span class="fullname">NaN</span> | <span class="phonenumber">091234</span></p>
                                                    <p class="address">Street, Barangay, City, Province, Postal
                                                        Code, Region</p>
                                                    <span class="badge badge-success mr-2">Default</span><span class="badge badge-secondary">Pickup Address</span>
                                                    <hr>
                                                </div>
                                                <div class="d-flex justify-content-end align-items-center col-lg-8">
                                                    <div class="button-group btn-group-vertical d-inline-flex align-items-stretch">
                                                        <button type="button" class="btn1 btn-outline-warning m-1" data-toggle="modal" data-target="#addnewaddress">Edit</button>
                                                        <button type="button" class="btn1 btn-outline-info m-1" disabled>Set
                                                            as Default</button>
                                                        <button type="button" class="btn1 btn-outline-danger m-1" data-toggle="modal" data-target="#deleteadd">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="p-3 bg-gradient-light rounded-lg">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <p><span class="fullname">NaN</span> | <span class="phonenumber">091234</span></p>
                                                    <p class="address">Street, Barangay, City, Province, Postal
                                                        Code, Region</p>
                                                    <hr>
                                                </div>
                                                <div class="d-flex justify-content-end align-items-center col-lg-8">
                                                    <div class="button-group btn-group-vertical d-inline-flex align-items-stretch">
                                                        <button type="button" class="btn1 btn-outline-warning m-1" data-toggle="modal" data-target="#addnewaddress">Edit</button>
                                                        <button type="button" class="btn1 btn-outline-info m-1">Set as
                                                            Default</button>
                                                        <button type="button" class="btn1 btn-outline-danger m-1" data-toggle="modal" data-target="#deleteadd">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- [ Main Content ] end -->
        <!-- footer_section - start
      ================================================== -->
      @include('layout\footer')
        <!-- footer_section - end
      ================================================== -->
    </div>
    <!-- Modal for Delete -->
    <div id="deleteadd" class="modal fade" tabindex="-1" aria-labelledby="addnewaddress" aria-hidden="true">
        <div class="modal-dialog modal-confirm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete this address?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger deleteDelAdd" data-delid="">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modal for Delete -->
    <!-- Modal for Add/Edit New Address -->
    <div class="modal fade" id="addnewaddress" tabindex="-1" aria-labelledby="addnewaddress" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressmodaltitle">Add New Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="delivery_add">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="fullname1" name="fullname">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="contactnumber1" id="contactnumber1">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Region <span class="text-danger">*</span></label>
                                    <select class="form-control" name="region" id="region-select1" required>
                                        <option value="">Select Region</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Province <span class="text-danger">*</span></label>
                                    <select class="form-control" name="province" id="province1" disabled required>
                                        <option value="">Select Province</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">City/Municipality <span class="text-danger">*</span></label>
                                    <select class="form-control" name="city" id="city1" disabled required>
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Barangay <span class="text-danger">*</span></label>
                                    <select class="form-control" name="barangay" id="barangay1" disabled required>
                                        <option value="">Select Barangay</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Postal/Zip Code<span class="text-danger">*</span></label>
                                    <input name="postal" id="postal" class="form-control" required>
                                    <div class="invalid-feedback text-center">
                                        Please enter a valid postal/zip code.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Street Name
                                        <span class="text-danger">*</span></label>
                                    <textarea name="street1" id="street1" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Additional Address Information
                                        <span class="text-danger">*</span></label>
                                    <textarea name="addition_add" id="add_info" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer deladdModalbuttons">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn_primary save_add">Save Address</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modal for Add New Address -->
    <!-- Alert Messages -->
    <!-- <div id="messagealert" style="position: fixed; top: 0; right: 0; margin: 20px; width: 250px; z-index: 9999;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
                <i class="fa-solid fa-circle-check text-success mr-2"></i>
                <strong class="mr-auto">Update Action</strong>
                <small class="text-muted">Just Now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Updated Successfully
            </div>
        </div>
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
                <i class="fa-solid fa-trash-can text-danger mr-2"></i>
                <strong class="mr-auto">Delete Action</strong>
                <small class="text-muted">Just Now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Deleted Successfully
            </div>
        </div>
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
                <i class="fa-solid fa-plus text-success mr-2"></i>
                <strong class="mr-auto">Add Action</strong>
                <small class="text-muted">Just Now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Added Successfully
            </div>
        </div>
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
                <i class="fa-solid fa-circle-xmark mr-2 text-danger"></i>
                <strong class="mr-auto">Action</strong>
                <small class="text-muted">Just Now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                There is and error. Try Again
            </div>
        </div>
    </div> -->
    <!--END Alert Messages  -->
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
    <script src="js/pages_js/userprofile.js"></script>
    <!-- END Script -->
</body>

</html>