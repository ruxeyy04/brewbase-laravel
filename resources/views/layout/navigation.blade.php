<!-- _navigation.blade.php -->

<div class="col-lg-10 col-md-7 col-7">
    <nav class="main_menu navbar navbar-expand-lg">
        <button class="mobile_menu_btn navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu_dropdown" aria-controls="main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse main_menu_inner" id="main_menu_dropdown">
            <ul class="main_menu_list ul_li">
                <li>
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="dropdown">
                    <a class="nav-link" href="#" id="about_submenu" role="button" data-toggle="dropdown" aria-expanded="false">About</a>
                    <ul class="submenu dropdown-menu" aria-labelledby="about_submenu">
                        <li><a href="about">About Us</a></li>
                        <li><a href="aboutme">About Me</a></li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link" href="products">Products</a>
                </li>
                <li>
                    <a class="nav-link" href="contact">Contact us</a>
                </li>
            </ul>
        </div>

        <ul class="header_btns_group ul_li_right">
            <li>
                <button type="button" class="main_search_btn" data-toggle="collapse" data-target="#main_search_collapse" aria-expanded="false" aria-controls="main_search_collapse">
                    <i class="fa fa-search"></i>
                </button>
            </li>
            <li>
                <button type="button" class="cart_btn">
                    <i class="fa fa-shopping-bag"></i>
                    <div class="cartCounter"></div>
                </button>
            </li>
            <li>
                <button type="button" class="user_btn">
                    <i class="fa fa-user"></i>
                </button>
            </li>
            <li></li>
        </ul>

    </nav>
</div>