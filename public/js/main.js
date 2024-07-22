function urlLink() {
    let urlLink = "http://127.0.0.1:8000/";
    return urlLink;
}
let url = urlLink();
// function encrypt(message) {
//   var key = "brewbase@1922@0411RxPSK1";
//   var encryptedMessage = "";
//   var length = message.length;

//   for (var i = 0; i < length; i++) {
//     encryptedMessage += String.fromCharCode(
//       message.charCodeAt(i) + key.charCodeAt(i % key.length)
//     );
//   }

//   return btoa(encryptedMessage);
// }

// function decrypt(message) {
//   var key = "brewbase@1922@0411RxPSK1";
//   message = atob(message);
//   var decryptedMessage = "";
//   var length = message.length;

//   for (var i = 0; i < length; i++) {
//     decryptedMessage += String.fromCharCode(
//       message.charCodeAt(i) - key.charCodeAt(i % key.length)
//     );
//   }

//   return decryptedMessage;
// }
var userid = "";
if ($.cookie("user_id")) {
    userid = $.cookie("user_id");
}
function checkAddtoCart() {
    if (userid !== "") {
        $.ajax({
            url: url + "api/cart",
            method: "GET",
            data: { userid: userid },
            success: function (data) {
                var cartItemCount = data.cartCount;
                $(".cartCounter").html(
                    `<small class="cart_counter">${cartItemCount}</small>`
                );
                var cartItems = "";
                cartItems += `<h2 class="heading_title text-uppercase">Cart Items - <span>${cartItemCount}</span></h2>`;
                if (data.cart.length === 0) {
                    cartItems += '<h5 class="text-center">No Items</h5>';
                    cartItems += `<div class="total_price text-uppercase">
                      <span>Sub Total:</span>
                      <span><i class="fa-solid fa-peso-sign"></i>0.00</span>
                  </div>`;
                } else {
                    $.each(data.cart, function (index, value) {
                        cartItems += `<div class="cart_items_list m-1">
          <div class="cart_item">
              <div class="item_image">
                  <img src="/productimg/${value.prod_img}" alt="${value.prod_name}" width="70" height="70">
              </div>
              <div class="item_content">
                  <h4 class="item_title">
                    ${value.prod_name}
                  </h4>
                  <span class="item_price"><i class="fa-solid fa-peso-sign"></i><span class="valueProdPrice">${value.total_price}</span></span>
                  <button type="button" class="remove_btn cart_remove_item" data-cartid="${value.cart_id}" data-prodid="${value.prod_no}"><i class="fa fa-times"></i></button>
              </div>
          </div>
        </div>`;
                    });
                    cartItems += `<div class="total_price text-uppercase">
                      <span>Sub Total:</span>
                      <span><i class="fa-solid fa-peso-sign"></i><span class="valueSubTotal">${data.totalAmount}</span></span>
                  </div>`;
                }

                $(".cart_items").html(cartItems);
            },
            error: function (xhr, status, error) {
                // Handle error here
            },
            complete: function () {
                $("#preloader").fadeOut("slow", function () {
                    $(this).remove();
                });
            },
        });
    } else {
        $("#preloader").fadeOut("slow", function () {
            $(this).remove();
        });
    }
}
profileName();
function profileName() {
    if (userid !== "") {
        $.ajax({
            url: url + "api/userinfo",
            type: "POST",
            data: { userid: userid },
            dataType: "json",
            success: function (data) {
                let user = data.userinfo[0];
                var fullname = user.fname + " " + user.lname;
                $(".profile_name").text(fullname);
            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            },
        });
    }
}
function roleType() {
    if (userid !== "") {
        $.ajax({
            url: url + "api/userinfo",
            type: "POST",
            data: { userid: userid },
            dataType: "json",
            success: function (data) {
                let user = data.userinfo[0];
                let navitem;
                if (user.usertype === "Customer") {
                    navitem = "";
                } else if (user.usertype === "Admin") {
                    navitem = `<li class="nav-item">
                        <a class="nav-link" href="brewbase-staff/admin/">
                          <i class="fa-solid fa-lock mr-2"></i> Admin
                        </a>
                    </li>`;
                } else {
                    navitem = `<li class="nav-item">
                        <a class="nav-link" href="brewbase-staff/incharge/">
                          <i class="fa-brands fa-uncharted mr-2"></i> In-Charge
                        </a>
                    </li>`;
                }
                $(".main_menu_list").append(navitem);
            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            },
        });
    }
}
(function ($) {
    "use strict";

    // ===========================================
    // var alertShown = false;
    // setInterval(function() {
    //   $.get("http://ip-api.com/json", function(data) {
    //     var location = data.city + ", " + data.regionName
    //     var ipadd = data.query;
    //     $.ajax({
    //       type: "POST",
    //       url: "/api/check_ip.php",
    //       data: {ip: ipadd, verify: 1},
    //       dataType: "json",
    //       success: function (data) {
    //         if(data.status === 'NoIP' && !alertShown) {
    //           Swal.fire({
    //             title: 'IP Address Not Recognized',
    //             text: 'Your IP address has been removed from the recognized IP list. Please log in again.',
    //             icon: 'warning',
    //             confirmButtonText: 'OK'
    //           }).then(function() {
    //             $.removeCookie('user_id')
    //             window.location.href = '/login'
    //           });
    //           alertShown = true;
    //         } else if(data.status === 'IPRecognized') {
    //           alertShown = false;
    //         }
    //       }
    //     });
    //   });
    // }, 3000);
    $(document).on("click", ".cart_remove_item", function () {
        var thisremove = $(this);
        var cartId = thisremove.data("cartid");
        $.ajax({
            type: "POST",
            url: url + "api/cart/delete",
            data: { delcartItem: cartId },
            dataType: "json",
            success: function (response) {
                var cartCount = parseInt($(".cart_counter").text());
                cartCount--;
                $(".cart_counter").html(cartCount);
                var cartItem = thisremove.closest(".cart_items_list");

                var prodId = thisremove.data("prodid");
                var itemPrice = parseFloat(
                    thisremove
                        .closest(".cart_item")
                        .find(".valueProdPrice")
                        .text()
                );
                // Get the current sub total value
                var subTotal = parseFloat($(".valueSubTotal").text());
                // Subtract the item price from the sub total
                var newSubTotal = subTotal - itemPrice;
                // Update the sub total value in the DOM
                $(".valueSubTotal").text(newSubTotal.toFixed(2));

                var cartItems = "";
                cartItem.animate({ opacity: 0, height: 0 }, 300, function () {
                    cartItem.remove();
                    var itemCount = $(".cart_items_list").length;
                    if (itemCount === 0) {
                        cartItems += `<h2 class="heading_title text-uppercase">Cart Items - <span>0</span></h2>`;
                        cartItems += '<h5 class="text-center">No Items</h5>';
                        cartItems += `<div class="total_price text-uppercase">
                      <span>Sub Total:</span>
                      <span><i class="fa-solid fa-peso-sign"></i>0.00</span>
                  </div>`;
                        $(".cart_items").html(cartItems);
                    }

                    var subTotal = 0;
                    $(".cart_items_list").each(function () {
                        subTotal += parseFloat(
                            thisremove.find(".item_price").text().substring(1)
                        );
                    });
                    $('button.add_cart[data-prodno="' + prodId + '"]')
                        .removeClass("added_cart")
                        .text("ADD TO CART");
                    var addToCartBtn = $(
                        'button.addtocart[data-prodid="' + prodId + '"]'
                    );
                    if (addToCartBtn.length) {
                        addToCartBtn
                            .removeClass("btn_secondary")
                            .addClass("btn_border border_black")
                            .text("Add to Cart");
                    }
                    $(".heading_title span").text(itemCount);
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                console.log(jqXHR.responseText);
            },
        });
        // $('tr[data-cartid="' + cartId + '"]').slideUp('fast', function() {
        //   $(this).remove();

        // });
        if (typeof cartList === "function") {
            cartList();
        }
    });

    $(".swal2-confirm")
        .addClass("btn btn_primary")
        .removeClass("swal2-confirm swal2-styled");

    // ===========================================
    const toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
    const toast1 = Swal.mixin({
        toast: true,
        position: "bottom",
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: false,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
    // ===================================================

    checkAddtoCart();
    // =====product details=======================
    $(".add_cart").on("click", function () {
        var prodid = $(".add_cart").attr("data-prodno");
        var cart = $(this);
        var quantity =
            $(".quantity_val").val() != null ? $(".quantity_val").val() : 1;
        var add_ons = $("#addons").data("ddslick").selectedData.value;
        if ($.cookie("user_id") != null) {
            if (cart.hasClass("added_cart")) {
                $.ajax({
                    type: "POST",
                    url: url + "api/cart/remove",
                    data: {
                        product_id: prodid,
                        delcart: 1,
                        userid: $.cookie("user_id"),
                        quant: quantity,
                        addons: add_ons,
                    },
                    success: function (data) {
                        var cartCount = parseInt($(".cart_counter").text());
                        cartCount--;
                        $(".cart_counter").html(cartCount);
                        if (data.status === true) {
                            toast1.fire({
                                icon: "info",
                                title: "Removed to Cart",
                            });
                            checkAddtoCart();
                        } else {
                            toast1.fire({
                                icon: "error",
                                title: "There is an Error",
                            });
                        }
                        cart.text("ADD TO CART").removeClass("added_cart");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    },
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: url + "api/cart/add",
                    data: {
                        product_id: prodid,
                        cart: 1,
                        userid: $.cookie("user_id"),
                        quant: quantity,
                        addons: add_ons,
                    },
                    success: function (data) {
                        var cartCount = parseInt($(".cart_counter").text());
                        cartCount++;
                        $(".cart_counter").html(cartCount);
                        if (data.status === true) {
                            toast1.fire({
                                icon: "success",
                                title: "Added to Cart",
                            });
                            checkAddtoCart();
                        } else {
                            toast1.fire({
                                icon: "error",
                                title: "There is an Error",
                            });
                        }
                        cart.text("ADDED TO CART").addClass("added_cart");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    },
                });
            }
        } else {
            location.replace("login");
        }
    });
    $("#add_wishlist").on("click", function () {
        var id = $(".add_cart").attr("data-prodno");
        var wish_id = $(this);
        if ($.cookie("user_id") != null) {
            if (wish_id.hasClass("added_wishlist")) {
                $.ajax({
                    type: "POST",
                    url: url + "api/wishlist/remove",
                    data: {
                        product_id: id,
                        delwishlist: 1,
                        userid: $.cookie("user_id"),
                    },
                    success: function (data) {
                        if (data.status === true) {
                            toast1.fire({
                                icon: "info",
                                title: "Removed to Wishlist",
                            });
                        } else {
                            toast1.fire({
                                icon: "error",
                                title: "There is an Error",
                            });
                        }
                        wish_id
                            .html(
                                '<i class="fa-regular fa-heart"></i> Add to Wishlist'
                            )
                            .removeClass("added_wishlist");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    },
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: url + "api/wishlist/add",
                    data: {
                        product_id: id,
                        wishlist: 1,
                        userid: $.cookie("user_id"),
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.status === true) {
                            toast1.fire({
                                icon: "success",
                                title: "Added to Wishlist",
                            });
                        } else {
                            toast1.fire({
                                icon: "error",
                                title: "There is an Error",
                            });
                        }
                        wish_id
                            .html(
                                '<i class="fa-solid fa-heart"></i> Added to Wishlist'
                            )
                            .addClass("added_wishlist");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    },
                });
            }
        } else {
            location.replace("login");
        }
    });
    // ===============================
    $(document).on("click", ".addtocart", function () {
        var selectC = $(this);
        var quantity = 1;
        var add_ons = 0;
        if ($.cookie("user_id") != null) {
            var prodid = $(this).attr("data-prodid");
            if ($(this).hasClass("btn_secondary")) {
                $.ajax({
                    type: "POST",
                    url: url + "api/cart/remove",
                    data: {
                        product_id: prodid,
                        delcart: 1,
                        userid: $.cookie("user_id"),
                        quant: quantity,
                        addons: add_ons,
                    },
                    success: function (data) {
                        var cartCount = parseInt($(".cart_counter").text());
                        cartCount--;
                        $(".cart_counter").html(cartCount);
                        if (data.status === true) {
                            toast1.fire({
                                icon: "info",
                                title: "Removed to Cart",
                            });
                            checkAddtoCart();
                        } else {
                            toast1.fire({
                                icon: "error",
                                title: "There is an Error",
                            });
                        }
                        selectC
                            .removeClass("btn_secondary")
                            .addClass("btn_border border_black")
                            .html("Add to Cart");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    },
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: url + "api/cart/add",
                    data: {
                        product_id: prodid,
                        cart: 1,
                        userid: $.cookie("user_id"),
                        quant: quantity,
                        addons: add_ons,
                    },
                    success: function (data) {
                        var cartCount = parseInt($(".cart_counter").text());
                        cartCount++;
                        $(".cart_counter").html(cartCount);
                        if (data.status === true) {
                            toast1.fire({
                                icon: "success",
                                title: "Added to Cart",
                            });
                            checkAddtoCart();
                        } else {
                            toast1.fire({
                                icon: "error",
                                title: "There is an Error",
                            });
                        }
                        selectC
                            .removeClass("btn_border border_black")
                            .addClass("btn_secondary")
                            .html("Added to Cart");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    },
                });
            }
        } else {
            window.location.href = "login";
        }
    });

    $(document).on("click", ".wishlist_btn", function () {
        var selectW = $(this);
        if ($.cookie("user_id") != null) {
            var prodid = $(this).attr("data-prodid");
            if ($(this).hasClass("wishlist_added")) {
                $.ajax({
                    type: "POST",
                    url: url + "api/wishlist/remove",
                    data: {
                        product_id: prodid,
                        delwishlist: 1,
                        userid: $.cookie("user_id"),
                    },
                    success: function (data) {
                        if (data.status === true) {
                            toast1.fire({
                                icon: "info",
                                title: "Removed to Wishlist",
                            });
                        } else {
                            toast1.fire({
                                icon: "error",
                                title: "There is an Error",
                            });
                        }
                        selectW
                            .html('<i class="far fa-heart"></i>')
                            .removeClass("wishlist_added");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    },
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: url + "api/wishlist/add",
                    data: {
                        product_id: prodid,
                        wishlist: 1,
                        userid: $.cookie("user_id"),
                    },
                    success: function (data) {
                        if (data.status === true) {
                            toast1.fire({
                                icon: "success",
                                title: "Added to Wishlist",
                            });
                        } else {
                            toast1.fire({
                                icon: "error",
                                title: "There is an Error",
                            });
                        }
                        selectW
                            .html('<i class="fa-solid fa-heart"></i>')
                            .addClass("wishlist_added");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        console.log(jqXHR.responseText);
                    },
                });
            }
        } else {
            window.location.href = "login";
        }
    });
    // ========================quantity

    // ==================================
    // ================================================
    // Function to check internet connection
    function checkInternetConnection() {
        if (!navigator.onLine) {
            toast.fire({
                icon: "error",
                title: "No internet connection",
            });
        } else {
            toast.fire({
                icon: "success",
                title: "Internet connection restored",
            });
        }
    }

    // Event listeners for online and offline events
    window.addEventListener("offline", checkInternetConnection);
    window.addEventListener("online", checkInternetConnection);

    // back to top - start
    // --------------------------------------------------
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $(".backtotop:hidden").stop(true, true).fadeIn();
        } else {
            $(".backtotop").stop(true, true).fadeOut();
        }
    });
    $(function () {
        $(".scroll").on("click", function () {
            $("html,body").animate({ scrollTop: 0 }, "slow");
            return false;
        });
    });
    // back to top - end
    // --------------------------------------------------
    // preloader - start
    // --------------------------------------------------

    // preloader - end
    // --------------------------------------------------

    // sticky header - start
    // --------------------------------------------------
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 120) {
            $(".header_section").addClass("sticky");
        } else {
            $(".header_section").removeClass("sticky");
        }
    });
    // sticky header - end
    // --------------------------------------------------
    // main slider - start
    // --------------------------------------------------
    $(".main_slider").slick({
        dots: true,
        fade: true,
        arrows: true,
        infinite: true,
        autoplay: true,
        slidesToShow: 1,
        autoplaySpeed: 6000,
        prevArrow: ".main_left_arrow",
        nextArrow: ".main_right_arrow",
    });

    $(".main_slider").on("init", function (e, slick) {
        var $firstAnimatingElements = $("div.slider_item:first-child").find(
            "[data-animation]"
        );
        doAnimations($firstAnimatingElements);
    });
    $(".main_slider").on(
        "beforeChange",
        function (e, slick, currentSlide, nextSlide) {
            var $animatingElements = $(
                'div.slider_item[data-slick-index="' + nextSlide + '"]'
            ).find("[data-animation]");
            doAnimations($animatingElements);
        }
    );
    var slideCount = null;

    $(".main_slider").on("init", function (event, slick) {
        slideCount = slick.slideCount;
        setSlideCount();
        setCurrentSlideNumber(slick.currentSlide);
    });
    $(".main_slider").on(
        "beforeChange",
        function (event, slick, currentSlide, nextSlide) {
            setCurrentSlideNumber(nextSlide);
        }
    );

    function setSlideCount() {
        var $el = $(".slide_count_wrap").find(".total");
        if (slideCount < 10) {
            $el.text("0" + slideCount);
        } else {
            $el.text(slideCount);
        }
    }

    function setCurrentSlideNumber(currentSlide) {
        var $el = $(".slide_count_wrap").find(".current");
        $el.text(currentSlide + 1);
    }

    function doAnimations(elements) {
        var animationEndEvents =
            "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
        elements.each(function () {
            var $this = $(this);
            var $animationDelay = $this.data("delay");
            var $animationType = "animated " + $this.data("animation");
            $this.css({
                "animation-delay": $animationDelay,
                "-webkit-animation-delay": $animationDelay,
            });
            $this.addClass($animationType).one(animationEndEvents, function () {
                $this.removeClass($animationType);
            });
        });
    }

    var $timer = 6000;
    function progressBar() {
        $(".slick-progress").find("span").removeAttr("style");
        $(".slick-progress").find("span").removeClass("active");
        setTimeout(function () {
            $(".slick-progress")
                .find("span")
                .css("transition-duration", $timer / 1000 + "s")
                .addClass("active");
        }, 100);
    }

    progressBar();
    $(".main_slider").on("beforeChange", function (e, slick) {
        progressBar();
    });
    // main slider - end
    // --------------------------------------------------
    // main search btn - start
    // --------------------------------------------------
    $(".main_search_btn").on("click", function () {
        $(".main_search_btn > i").toggleClass("fa-circle-xmark");
    });
    // main search btn - end
    // --------------------------------------------------
    $(document).on("click", ".logout", function () {
        $.removeCookie("user_id");
        window.location.href = "login";
        // $.get("http://geolocation-db.com/json/", function (data) {
        //   var location = data.city + ", " + data.state;
        //   $.ajax({
        //     url: url + "api/login.php",
        //     type: "POST",
        //     dataType: "json",
        //     data: {
        //       logout: 1,
        //       ip: data.IPv4,
        //       location: location,
        //       user_id: $.cookie("user_id"),
        //     },
        //     success: function (data) {},
        //     error: function (jqXHR, textStatus, errorThrown) {
        //       console.log(jqXHR.responseText);
        //       console.log("AJAX request failed: " + textStatus, errorThrown);
        //     },
        //     complete: function () {
        //       $.removeCookie("user_id");
        //       window.location.href = "login";
        //     },
        //   });
        // }, "json");
    });
    profileName();
    roleType();

    // menu button - start
    // --------------------------------------------------
    //   $(document).ready(function () {
    //     $.when(
    //       $.ajax({ url: url + "layout/footer.html", crossDomain: true, dataType: 'html' }),
    //       $.ajax({ url: url + "layout/cart_sidebar.html", crossDomain: true, dataType: 'html' }),
    //       $.ajax({ url: url + "layout/user_sidebar.html", crossDomain: true, dataType: 'html' }),
    //       $.ajax({ url: url + "layout/navbar.html", crossDomain: true, dataType: 'html' })
    //     )
    //       .done(function (footerData, cartData, userData, navbarData) {
    //         $(".footer_section").html(footerData[0]);
    //         $(".cart_sidebar").html(cartData[0]);
    //         $(".user_sidebar").html(userData[0]);
    //         $(".header_section").html(navbarData[0]);

    //       })
    //       .fail(function () {
    //         console.log("Error loading HTML files");
    //       })
    //       .always(function () {
    //           if (window.location.href.indexOf('checkout.html') > -1) {
    //           $('.cart_sidebar ').remove();
    //           $('.cart_btn').prop('disabled', true);
    //         }
    //         $(".close_btn, .cart_sidebar_overlay, .user_sidebar_overlay").on(
    //           "click",
    //           function () {
    //             $(".cart_sidebar").removeClass("active");
    //             $(".cart_sidebar_overlay").fadeOut("slow", function () {
    //               $(this).removeClass("active");
    //             });
    //             $(".user_sidebar").removeClass("active");
    //             $(".user_sidebar_overlay").fadeOut("slow", function () {
    //               $(this).removeClass("active");
    //             });
    //           }
    //         );

    //         $(".cart_btn").on("click", function () {
    //           if ($.cookie("user_id") == null) {
    //             location.assign("/login");
    //           } else {
    //             $(".cart_sidebar").addClass("active");
    //             $(".cart_sidebar_overlay").fadeIn("fast", function () {
    //               $(this).addClass("active");
    //             });
    //           }
    //         });
    //         $(".user_btn").on("click", function () {
    //           if ($.cookie("user_id") == null) {
    //             location.assign("/login");
    //           } else {

    //             $(".user_sidebar").addClass("active");
    //             $(".user_sidebar_overlay").fadeIn("fast", function () {
    //               $(this).addClass("active");
    //             });
    //           }
    //         });
    //         var currentPath = window.location.pathname.replace("/", "");
    //         $(".main_menu_list a").each(function () {
    //           // get the link URL
    //           var linkUrl = $(this).attr("href");

    //           if (!currentPath) {
    //             currentPath = "/";
    //           }
    //           if (linkUrl === currentPath) {
    //             $(this).parent("li").addClass("active");
    //             $(this).closest(".dropdown").addClass("active");
    //           }
    //         });
    //         profileName();
    //         roleType();
    //       });
    //   });
    // menu button - end
    if (window.location.href.indexOf("checkout.html") > -1) {
        $(".cart_sidebar ").remove();
        $(".cart_btn").prop("disabled", true);
    }
    $(".close_btn, .cart_sidebar_overlay, .user_sidebar_overlay").on(
        "click",
        function () {
            $(".cart_sidebar").removeClass("active");
            $(".cart_sidebar_overlay").fadeOut("slow", function () {
                $(this).removeClass("active");
            });
            $(".user_sidebar").removeClass("active");
            $(".user_sidebar_overlay").fadeOut("slow", function () {
                $(this).removeClass("active");
            });
        }
    );

    $(".cart_btn").on("click", function () {
        if ($.cookie("user_id") == null) {
            location.assign("login");
        } else {
            $(".cart_sidebar").addClass("active");
            $(".cart_sidebar_overlay").fadeIn("fast", function () {
                $(this).addClass("active");
            });
        }
    });
    $(".user_btn").on("click", function () {
        if ($.cookie("user_id") == null) {
            location.assign("login");
        } else {
            $(".user_sidebar").addClass("active");
            $(".user_sidebar_overlay").fadeIn("fast", function () {
                $(this).addClass("active");
            });
        }
    });
    var currentPath = window.location.pathname.replace("/", "");
    $(".main_menu_list a").each(function () {
        // get the link URL
        var linkUrl = $(this).attr("href");

        if (!currentPath) {
            currentPath = "/";
        }
        if (linkUrl === currentPath) {
            $(this).parent("li").addClass("active");
            $(this).closest(".dropdown").addClass("active");
        }
    });

    // --------------------------------------------------
    var proddname = [];
    $.ajax({
        url: url + "api/products",
        type: "GET",
        dataType: "json",
        success: function (data) {
            $.each(data.prod, function (prod, value) {
                proddname.push(value.prodname);
            });
        },
    });
    $(document).on("input", "#searchInput", function () {
        var input = $("#searchInput");
        input.autocomplete({
            source: function (request, response) {
                var results = $.ui.autocomplete.filter(proddname, request.term);
                response(results.slice(0, 10));
            },
        });
    });
    $(document).on("submit", "#searchBar", function (e) {
        e.preventDefault();
        var searchVal = $("#searchInput").val();
        if (searchVal) {
            window.location.href = `products?search=${searchVal}`;
        } else {
            window.location.href = `products`;
        }
    });
    // wow js - start
    // --------------------------------------------------
    var wow = new WOW({
        animateClass: "animated",
        offset: 100,
        mobile: true,
        duration: 1000,
    });
    wow.init();
    // wow js - end

    // main search btn - start
    // --------------------------------------------------
    $(window).on("load", function () {
        $(".main_search_btn").on("click", function () {
            $(".main_search_btn > i").toggleClass("fa-times");
        });
    });
    // main search btn - end
    // --------------------------------------------------
    // Cart Page JS
    // Add sorting to each column
    $(".cart_table_html th").click(function (e) {
        $(this).on("selectstart", false);
        var table = $(this).parents("table").eq(0);
        var rows = table
            .find("tr:gt(0)")
            .toArray()
            .sort(compare($(this).index()));
        var header = $(this);
        header.addClass("sorted");

        header.siblings().removeClass("sorted");
        if (header.hasClass("asc")) {
            $("table th").find("i").remove();
            header.removeClass("asc");
            header.addClass("desc");
            header.append('<i class="ml-2 fa-solid fa-sort-up"></i>');
            rows = rows.reverse();
        } else {
            header.removeClass("desc");
            $("table th").find("i").remove();
            header.append('<i class="ml-2 fa-solid fa-sort-down"></i>');
            header.addClass("asc");
        }
        for (var i = 0; i < rows.length; i++) {
            table.append(rows[i]);
        }

        rows.forEach(function (item, index) {
            var delay = (index + 1) * 50;
            $(item)
                .find("td")
                .css("opacity", "0")
                .delay(delay)
                .animate({ opacity: "1" }, 300);
        });
    });

    // Compare function to sort table rows
    function compare(index) {
        return function (a, b) {
            var valA = getCellValue(a, index);
            var valB = getCellValue(b, index);
            return $.isNumeric(valA) && $.isNumeric(valB)
                ? valA - valB
                : valA.toString().localeCompare(valB);
        };
    }

    // Get cell value
    function getCellValue(row, index) {
        return $(row).children("td").eq(index).text();
    }
    // END Card Page JS
    // START Checkout Page
    $(".direct_bank_transfer, .cash_on_delivery, .checkout_form_footer").hide();
    $("#direct, #cod").click(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            if ($(this).attr("id") == "direct") {
                $(".direct_bank_transfer, .checkout_form_footer").fadeOut();
            } else {
                $(".cash_on_delivery ,.checkout_form_footer").fadeOut();
            }
        } else {
            $(this).addClass("active");
            if ($(this).attr("id") == "direct") {
                $(".direct_bank_transfer, .checkout_form_footer").fadeIn(
                    "slow"
                );
                $("#cod").removeClass("active");
                $("#place_order").prop("disabled", true);
                $(".cash_on_delivery").hide();
            } else {
                $(".cash_on_delivery, .checkout_form_footer").fadeIn("slow");
                $("#direct").removeClass("active");
                $(".direct_bank_transfer").hide();
                $("#place_order").prop("disabled", false);
            }
        }
    });

    // =============================
    $(".direct_transfer").on("input", function () {
        var cardNumber = $("#card_number").val();
        var expDate = $("#card_exp").val();
        var cvCode = $("input[name=cv_code]").val();
        var cardOwner = $("input[name=card_owner]").val();

        if (
            cardNumber.length == 19 &&
            expDate.length == 5 &&
            cvCode.length == 3 &&
            cardOwner.length > 0
        ) {
            $("#place_order").prop("disabled", false);
        } else {
            $("#place_order").prop("disabled", true);
        }
    });
    //For Card Number formatted input
    $("#card_number").on("keyup", function (e) {
        if (this.value == this.lastValue) return;
        var caretPosition = this.selectionStart;
        var sanitizedValue = this.value.replace(/[^0-9]/gi, "");
        var parts = [];

        for (var i = 0, len = sanitizedValue.length; i < len; i += 4) {
            parts.push(sanitizedValue.substring(i, i + 4));
        }
        for (var i = caretPosition - 1; i >= 0; i--) {
            var c = this.value[i];
            if (c < "0" || c > "9") {
                caretPosition--;
            }
        }
        caretPosition += Math.floor(caretPosition / 4);

        this.value = this.lastValue = parts.join("-");
        this.selectionStart = this.selectionEnd = caretPosition;
    });

    //For Date formatted input
    $("#card_exp").on("keyup", function (e) {
        if (this.value == this.lastValue) return;
        var caretPosition = this.selectionStart;
        var sanitizedValue = this.value.replace(/[^0-9]/gi, "");
        var parts = [];

        for (var i = 0, len = sanitizedValue.length; i < len; i += 2) {
            parts.push(sanitizedValue.substring(i, i + 2));
        }
        for (var i = caretPosition - 1; i >= 0; i--) {
            var c = this.value[i];
            if (c < "0" || c > "9") {
                caretPosition--;
            }
        }
        caretPosition += Math.floor(caretPosition / 2);

        this.value = this.lastValue = parts.join("/");
        this.selectionStart = this.selectionEnd = caretPosition;
    });
    // END Checkout Page
})(jQuery);
