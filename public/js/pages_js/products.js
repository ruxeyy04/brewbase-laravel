
var $newItem = '';



// ==================================
// ==================================
var $grid = $('.grid').isotope({
    itemSelector: '.element-item',
    layoutMode: 'fitRows',
    transitionDuration: 0
});
//========================================
const searchParams = new URLSearchParams(window.location.search);
const searchValue = searchParams.get('search');

// =======================================
$.ajax({
    url: url + 'api/products',
    type: 'GET',
    dataType: 'json',
    data: {userid: userid},
    success: function (data) {
        $('<h3 class="text-center">No Result</h3>').remove()
        var category = $('<li><button class="button text-uppercase active" data-filter="*">all</button></li>');
        $.each(data.cat, function (cat, value) {
            var c = "." + value.toLowerCase().replace(/\s+/g, "");
            var button = $('<button class="button text-uppercase" data-filter="' + c + '">' + value + '</button>');
            var listItem = $('<li></li>').append(button);
            category = category.add(listItem);
        });
        $('.cattt').html(category);

        $.each(data.prod, function (prod, value) {
            var isAddedToCart = value.is_added_to_cart;
            var isAddedToWishlist = value.is_added_to_wishlist;
            var wishlistClass = isAddedToWishlist ? "wishlist_btn wishlist_added" : "wishlist_btn";
            var wishlistIcon = isAddedToWishlist ? "fa-solid fa-heart" : "fa-sharp fa-regular fa-heart";
            var cartClass = isAddedToCart ? "btn btn_secondary text-uppercase addtocart" : "btn btn_border border_black text-uppercase addtocart";
            var cartText = isAddedToCart ? "Added to Cart" : "Add to Cart";
            var p_status = value.status == "Available" ? "" : "disabled";
            var c = value.category.toLowerCase().replace(/\s+/g, "");
            $newItem = $('<div class="element-item ' + c + '" data-category="' + c + '">' +
                '<div class="shop_card">' +
                '<a class="'+wishlistClass+'" href="#!" data-prodid="'+value.number+'"><i class="'+wishlistIcon+'"></i></a>' +
                '<a class="item_image" href="productdetails?name='+value.prodname+'"><img src="productimg/' + value.image + '" alt="image_not_found"></a>' +
                '<div class="item_content">' +
                '<h3 class="item_title text-uppercase"><a href="productdetails?name='+value.prodname+'">' + value.prodname + '</a></h3>' +
                '<div class="btns_group">' +
                '<span class="item_price prod_price bg_default_brown">₱ ' + value.price + '</span>' +
                '<button class="'+cartClass+'" href="#!" data-prodid="'+value.number+'" '+ p_status +'>'+cartText+'</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>');
            $grid.append($newItem).isotope('appended', $newItem);
        })
    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.log("AJAX request failed: " + textStatus, errorThrown);
    },
    complete: function () {

        if(searchValue) {
           
            $grid.isotope('remove', $grid.children()).isotope('layout');
            $.ajax({
                url: url + 'api/products',
                type: 'GET',
                data: { search: searchValue, userid: userid },
                success: function (data) {
                    if (data.message !== "None") {
                        $('.shop_filter_grid h3').remove()
                        $.each(data.prod, function (prod, value) {
                            var isAddedToCart = value.is_added_to_cart;
                            var isAddedToWishlist = value.is_added_to_wishlist;
                            var wishlistClass = isAddedToWishlist ? "wishlist_btn wishlist_added" : "wishlist_btn";
                            var wishlistIcon = isAddedToWishlist ? "fa-solid fa-heart" : "fa-sharp fa-regular fa-heart";
                            var cartClass = isAddedToCart ? "btn btn_secondary text-uppercase addtocart" : "btn btn_border border_black text-uppercase addtocart";
                            var cartText = isAddedToCart ? "Added to Cart" : "Add to Cart";
                            var c = value.category.toLowerCase().replace(/\s+/g, "");
                            var p_status = value.status == "Available" ? "" : "disabled";
                            $newItem = $('<div class="element-item ' + c + '" data-category="' + c + '">' +
                                '<div class="shop_card">' +
                                '<a class="'+wishlistClass+'" href="#!" data-prodid="'+value.number+'"><i class="'+wishlistIcon+'"></i></a>' +
                                '<a class="item_image" href="productdetails?name='+value.prodname+'"><img src="productimg/' + value.image + '" alt="image_not_found"></a>' +
                                '<div class="item_content">' +
                                '<h3 class="item_title text-uppercase"><a href="productdetails?name='+value.prodname+'">' + value.prodname + '</a></h3>' +
                                '<div class="btns_group">' +
                                '<span class="item_price prod_price bg_default_brown">₱ ' + value.price + '</span>' +
                                '<button class="'+cartClass+'" href="#!" data-prodid="'+value.number+'" '+ p_status+ '>'+cartText+'</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                            $grid.append($newItem).isotope('appended', $newItem);
                        })
                        filterItems();
                        updatePagination();
                    } else {
                        $('.shop_filter_grid h3').remove()
                        $('.pagination_nav').children().remove();
                        $grid.isotope('remove', $grid.children()).isotope('layout');
                        var $result = $('<h3 class="text-center">No Result</h3>');
                        $('.shop_filter_grid').append($result);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("AJAX request failed: " + textStatus, errorThrown);
                    console.log(jqXHR.responseText)
                },
                complete: function() {
                    $('.shop_filter_bar').hide()
                }
            })
        } 
           
        var prices = [];
        $('.prod_price').each(function () {
            prices.push(parseFloat($(this).text().replace('₱ ', '')));
        });
        var maxPrice = Math.max.apply(null, prices);
        var minPrice = Math.min.apply(null, prices);
        $("#slider-range").slider({
            range: true,
            min: minPrice,
            max: maxPrice,
            values: [minPrice, maxPrice],
            slide: function (event, ui) {
                $("#amount").val("₱ " + ui.values[0] + " - ₱ " + ui.values[1]);
            },
            change: function (event, ui) {

                filterItemsByPrice(ui.values[0], ui.values[1]);
            }
        });


        $("#amount").val("₱ " + $("#slider-range").slider("values", 0) +
            " - ₱ " + $("#slider-range").slider("values", 1));
        var itemsPerPage = 6;
        var currentPage = 1;
        var totalItems = $grid.children().length;
        var totalPages = Math.ceil(totalItems / itemsPerPage);

        function filterItemsByPrice(minPrice, maxPrice) {
            
            $('.shop_filter_grid h3').remove()
            $grid.isotope('remove', $grid.children()).isotope('layout');
            var $preloader = $('<div id="preloader" class="preloader"></div>');
            $('body').append($preloader);
            $preloader.show();
            
            var data = { filterprice: 1, min: minPrice, max: maxPrice, userid: userid };
            $.ajax({
                url: url + 'api/products',
                type: 'GET',
                dataType: 'json',
                data: data,
                success: function (data) {
                    $.each(data.prod, function (prod, value) {
                            var isAddedToCart = value.is_added_to_cart;
                            var isAddedToWishlist = value.is_added_to_wishlist;
                            var wishlistClass = isAddedToWishlist ? "wishlist_btn wishlist_added" : "wishlist_btn";
                            var wishlistIcon = isAddedToWishlist ? "fa-solid fa-heart" : "fa-sharp fa-regular fa-heart";
                            var cartClass = isAddedToCart ? "btn btn_secondary text-uppercase addtocart" : "btn btn_border border_black text-uppercase addtocart";
                            var cartText = isAddedToCart ? "Added to Cart" : "Add to Cart";
                            var c = value.category.toLowerCase().replace(/\s+/g, "");
                            var p_status = value.status == "Available" ? "" : "disabled";
                            $newItem = $('<div class="element-item ' + c + '" data-category="' + c + '">' +
                                '<div class="shop_card">' +
                                '<a class="'+wishlistClass+'" href="#!" data-prodid="'+value.number+'"><i class="'+wishlistIcon+'"></i></a>' +
                                '<a class="item_image" href="productdetails?name='+value.prodname+'"><img src="productimg/' + value.image + '" alt="image_not_found"></a>' +
                                '<div class="item_content">' +
                                '<h3 class="item_title text-uppercase"><a href="productdetails?name='+value.prodname+'">' + value.prodname + '</a></h3>' +
                                '<div class="btns_group">' +
                                '<span class="item_price prod_price bg_default_brown">₱ ' + value.price + '</span>' +
                                '<button class="'+cartClass+'" href="#!" data-prodid="'+value.number+'" '+p_status+'>'+cartText+'</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                            $grid.append($newItem).isotope('appended', $newItem);
                    })
                    $grid.isotope('layout');
                    filterItems();
                    updatePagination();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("AJAX request failed: " + textStatus, errorThrown);
                    console.log(jqXHR.responseText)
                },
                complete: function () {
                    $('#preloader').fadeOut('slow', function () { $(this).remove(); });
                }

            })

        }
        // var activeCategory = $('.filters-button-group button.active').attr('data-filter').toString().replace('.', '')
        // if (activeCategory === '*') {
        //     // If all categories are selected, filter items based on price range
        //     $grid.isotope({
        //         filter: function () {
        //             var itemPrice = $(this).find('.prod_price').text().replace('₱ ', '');
        //             return parseInt(itemPrice) >= minPrice && parseInt(itemPrice) <= maxPrice;
        //         }
        //     });
        // } else {
        //     $grid.isotope({
        //         filter: function () {
        //             var itemPrice = $(this).find('.prod_price').text().replace('₱ ', '');
        //             return $(this).hasClass(activeCategory) && parseInt(itemPrice) >= minPrice && parseInt(itemPrice) <= maxPrice;
        //         }
        //     })
        // }
        // updateItems(activeCategory);
        // ================================
        $('.filters-button-group').on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $('.filters-button-group button').removeClass('active');
            $(this).addClass('active');
            $grid.isotope({ filter: filterValue });
            updateItems(filterValue);
        });

        function updateItems(filterValue) {
            currentPage = 1;
            totalItems = $grid.children(filterValue).length;
            totalPages = Math.ceil(totalItems / itemsPerPage);
            filterItems();
            updatePagination();
        }

        // ================================




        function filterItems() {
            var startIndex = (currentPage - 1) * itemsPerPage;
            var endIndex = startIndex + itemsPerPage - 1;

            // filter items based on current filter value
            var filterValue = $('.filters-button-group button.active').attr('data-filter');
            var $items = $grid.children(filterValue);

            // update totalItems and totalPages based on filtered items
            totalItems = $items.length;
            totalPages = Math.ceil(totalItems / itemsPerPage);

            // set items outside the current page range to display:none
            $items.css('display', 'none');
            $items.slice(startIndex, endIndex + 1).fadeIn(1000).css('display', 'block');
            $grid.isotope('layout');
        }

        filterItems();
        updatePagination();



        function updatePagination() {
            $('.pagination_nav li').removeClass('active');
            $('.pagination_nav li[id="' + currentPage + '"]').addClass('active');

            var startPage, endPage;

            if (totalPages <= 5) {
                startPage = 1;
                endPage = totalPages;
            } else if (currentPage <= 3) {
                startPage = 1;
                endPage = 5;
            } else if (currentPage >= totalPages - 2) {
                startPage = totalPages - 4;
                endPage = totalPages;
            } else {
                startPage = currentPage - 2;
                endPage = currentPage + 2;
            }

            var pageLinks = '', pageLeft = '', pageRight = '';
            if (startPage > 1) {
                pageLinks += '<li class="page ' + 1 + '" id="' + 1 + '"><a href="#!">' + 1 + '</a></li>';
                pageLinks += '<li><a href="#!"><i class="fa-solid fa-ellipsis"></i></a></li>';
            }
            for (var i = startPage; i <= endPage; i++) {
                if (i == currentPage) {
                    pageLinks += '<li class="page ' + i + ' active" id="' + i + '"><a href="#!">' + i + '</a></li>';
                } else {
                    pageLinks += '<li class="page ' + i + '" id="' + i + '"><a href="#!">' + i + '</a></li>';
                }
            }
            if (endPage < totalPages) {
                pageLinks += '<li><a href="#!"><i class="fa-solid fa-ellipsis"></i></a></li>';
                pageLinks += '<li class="page ' + totalPages + '" id="' + totalPages + '"><a href="#!">' + totalPages + '</a></li>';
            }
            if (totalPages !== 1 && pageLinks != '') {
                pageLeft = '<li class="pageleft"><a href="#!"><i class="fa-solid fa-angles-left"></i></a></li>'
                pageRight = '<li class="pageright"><a href="#!"><i class="fa-solid fa-angles-right"></i></a></li>'
            }
            $('.pagination_nav').html(pageLeft + pageLinks + pageRight);
        }

        $('.pagination_nav').on('click', '.pageleft', function () {
            if (currentPage > 1) {
                currentPage--;
                updatePagination();
                filterItems();
            }
        });

        $('.pagination_nav').on('click', '.pageright', function () {
            if (currentPage < totalPages) {
                currentPage++;
                updatePagination();
                filterItems();
            }
        });
        $('.pagination_nav').on('click', '.page', function (event) {
            var page = $(this).attr('id');
            if (page && page != currentPage) {
                currentPage = parseInt(page);
                updatePagination();
                filterItems();
            }
        });


    }
});

// =======================================
