<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BrewBase | In-Charge - Products</title>
    <link rel="shortcut icon" href="{{ asset('/logo/brewbase.ico') }}" />
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/all.min.css') }}" />
    <link href="{{ asset('admin/assets/css/master.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <div id="preloader"></div>
    <div class="wrapper">
        <!-- sidebar navigation component -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="/logo/brewbaselo.png" alt="bootraper logo" class="app-logo">
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('incharge.dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('incharge.products') }}"><i class="fas fa-box-open"></i> Products</a>
                </li>
                <li>
                    <a href="{{ route('incharge.orders') }}"><i class="fas fa-shopping-cart"></i> Orders</a>
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
                    <div class="page-title d-flex justify-content-between">
                        <h3>Products</h3>
                        <button class="btn btn-success mt-3 mb-3" data-toggle="modal" data-target="#addedit"><i
                                class="fas fa-plus"></i> Product</button>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">List of Products</div>
                                <div class="card-body table-responsive">
                                    <p class="card-title"></p>
                                    <table class="table table-hover" id="products" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Price</th>
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
    <style>

    </style>
    <!-- Add/Edit Modal -->
    <div class="modal fade" id="addedit" tabindex="-1" aria-labelledby="addedit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addeditTitle">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addProductForm">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="prodname" class="font-weight-bold">Product Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="prodname"
                                            placeholder="Write title here..." name="prodName">
                                    </div>
                                    <div class="form-group">
                                        <label for="desc" class="font-weight-bold">Product Descrption <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="desc" rows="4" name="prodesc"
                                            placeholder="Write description here..."></textarea>
                                    </div>
                                    <label class="font-weight-bold">Product Image <span
                                            class="text-danger">*</span></label>
                                    <div class="form-product d-flex justify-content-center m-3">
                                        <div class="grid">
                                            <div class="form-element">
                                                <input type="file" id="file-1" name="prodpic" accept="image/*">
                                                <label for="file-1" id="file-1-preview">
                                                    <img id="img-src" src="/../img/insert_img.jpg" alt="">
                                                    <div>
                                                        <span>+</span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 prod_organize">
                                    <h5 class="text-center">Organize</h5>
                                    <div class="form-group">
                                        <label for="prodname" class="font-weight-bold">Category <span
                                                class="text-danger">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            <option value="Milk Tea">Milk Tea</option>
                                            <option value="Frappe">Frappe</option>
                                            <option value="Fruit Tea">Fruit Tea</option>
                                            <option value="Hot Drinks">Hot Drinks</option>
                                            <option value="Cold Drinks">Cold Drinks</option>
                                            <option value="Lemonade">Lemonade</option>
                                            <option value="Soya Drink">Soya Drink</option>
                                            <option value="Soda Pops">Soda Pops</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="date" class="font-weight-bold">Product Date <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="prodDate" class="form-control " id="prodDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="price" class="font-weight-bold">Product Price <span
                                                class="text-danger">*</span></label>
                                        <input type="number" name="prodPrice" class="form-control" step=".01"
                                            placeholder="Price" id="prodPrice">
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="font-weight-bold">Status <span
                                                class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Available">Available</option>
                                            <option value="Not Available">Not Available</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="modal-footer addeditButtons">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary addProd">Add Product</button>
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
    <script src="{{ asset('admin/js/pages_js/products.js') }}"></script>
</body>

</html>