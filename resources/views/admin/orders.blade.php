<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BrewBase | Admin - Orders</title>
    <link rel="shortcut icon" href="{{ asset('/logo/brewbase.ico') }}" />
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/all.min.css') }}" />
    <link href="{{ asset('admin/assets/css/master.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <div id="preloader"></div>
      <div class="modal fade" id="orderDetails" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="background: #f2f2f2;">
                <div class="container orderdetailContaner">
                    <div class="ordetail_header border-bottom">
                        <div class="ordernum">
                            <span>ORDER #: </span>
                            <span class="m-1">|</span>
                            <span class="font-weight-bold text-info">PENDING</span>
                        </div>

                    </div>
                    <div class="order_sec">
                       
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
                                    <h6>Total</h6><span class="font-weight-bold"
                                        style="font-size: 20px; color: black;">₱<span class="totalAmount"></span></span>
                                </div>
                                <hr>
                                <p class="m-0">Paid on <span class="paymentMethod"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="userProfile" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">User Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="background: #f2f2f2;">
                <div class="row">
                    <div class="col-lg-4 col-xxl-3">
                        <div class="card mb-4">
                            <div class="card-body position-relative">
                                <div class="text-center mt-3">
                                    <div class="chat-avtar d-inline-flex mx-auto wid-100">
                                        <img class="rounded-circle profileImg" src="/profileimg/default-pic.png" alt="User image">
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
                                    <div
                                        class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                        <i class="fa-solid fa-envelope"></i>
                                        <p class="mb-0 profEmail"></p>
                                    </div>
                                    <div
                                        class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                        <i class="fa fa-phone"></i>
                                        <p class="mb-0 profPhoneNo"></p>
                                    </div>
                                    <div
                                        class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
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
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <div class="wrapper">
        <!-- sidebar navigation component -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="/logo/brewbaselo.png" alt="bootraper logo" class="app-logo">
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('admin.products') }}"><i class="fas fa-box-open"></i> Products</a>
                </li>
                <li>
                    <a href="{{ route('admin.orders') }}"><i class="fas fa-shopping-cart"></i> Orders</a>
                </li>
                <li>
                    <a href="{{ route('admin.transactions') }}"><i class="fas fa-dollar-sign"></i> Transactions</a>
                </li>
                <li>
                    <a href="{{ route('admin.user') }}"><i class="fas fa-user-tie"></i> User</a>
                </li>

                <li>
                    <a href="/userprofile"><i class="fas fa-cog"></i>Profile Settings</a>
                </li>
                <li>
                    <a href="/"><i class="fas fa-home"></i>Home</a>
                </li>
            </ul>
        </nav>
        <!-- end of sidebar component -->
        <div id="body">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button type="button" id="sidebarCollapse" class="btn1 btn-light">
                    <i class="fa fa-bars"></i><span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav2" class="nav-link dropdown-toggle text-secondary"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> <span id="fullname"></span> <i style="font-size: .8em;"
                                        class="fa fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="/userprofile.html" class="dropdown-item"><i class="fa fa-address-card"></i>
                                                Profile</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li class="logout"><a href="#!" class="dropdown-item"><i class="fa fa-sign-out-alt"></i>
                                                Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end of navbar navigation -->
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Orders</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">List of Orders</div>
                                <div class="card-body table-responsive">
                                    <p class="card-title"></p>
                                    <table class="table table-hover" id="order_list" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Order#</th>
                                                <th>Total</th>
                                                <th>Customer</th>
                                                <th>Order Status</th>
                                                <th>Total Items</th>
                                                <th>Payment Method</th>
                                                <th>Date</th>
                                                <th>In-Charge</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/js/jquery.cookie.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    <script src="{{ asset('admin/js/pages_js/orders.js') }}"></script>
</body>

</html>