var addons = []
$.ajax({
  type: "POST",
  url: url+"api/addons",
  dataType: "json",
  success: function (res) {
    $.each(res.addons, function (index, data) {
      var addonsObject = {
        text: data.addons_name,
        value: parseInt(data.addonsID),
        selected: false,
      description: "Price: ₱ " + data.addons_price,
      imageSrc: `/addonsimg/${data.addons_img}` 
      }
      addons.push(addonsObject);
    })
  },
  complete: function () {
    $('#addons').ddslick({
      data: addons,
      defaultSelectedIndex:0
  })
  }
});

$(window).on("load resize", function () {
  if ($(this).width() < 503) {
    // Replace 576 with your desired screen size

    $(".quantity_input").addClass("mb-3");
  } else {
    $(".quantity_input").removeClass("mb-3");
  }
});
const toast = Swal.mixin({
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

const searchParams = new URLSearchParams(window.location.search);
const searchValue = searchParams.get('name');

if (!searchValue) {
  window.location.href = `products`;
}
$.ajax({
  type: "POST",
  url: url+"api/product-details",
  data: { name: searchValue, userid: userid },
  dataType: "json",
  success: function (data) {
    var dateObj = new Date(data.prod[0].prod_date);
    $('#product_price').text(data.prod[0].prod_price)
    var status = data.prod[0].status === 'Available' ? `<i class="fa fa-check"></i> Available` : `<i class="fa fa-times text-danger"></i><span class="text-danger">Not Available</span>`
   if(data.prod[0].status === 'Not Available') {
    $('.add_cart').attr('disabled', true)
   }
    $('.product_status').html(status)
    var monthNames = [
      "January", "February", "March", "April", "May", "June", "July",
      "August", "September", "October", "November", "December"
    ];
    var month = monthNames[dateObj.getMonth()];
    var day = dateObj.getDate();
    var year = dateObj.getFullYear();
    var formattedDate = month + " " + day + ", " + year;
    var addons = ''
    $.each(data.addons, function (index, value) {
      addons += `<option value="${value.addonsID}">${value.addons_name}</option>`
    })
    $('#addons_select').html(addons)
    $('.add_cart').attr('data-prodno', data.prod[0].prod_no)
    $('.product_name').text(data.prod[0].prod_name)
    $('.date_text').text('Date: ' + formattedDate)
    $('.category_name').text(data.prod[0].category)
    $('#product_img').attr('src', '/productimg/' + data.prod[0].prod_img);
    $('.product_detail').text(data.prod[0].prod_description)
    var prodid = $('.add_cart').attr('data-prodno')
    if(data.prod[0].prod_no == prodid) {
      
      if(data.prod[0].is_added_to_cart == 1) {
        $('.add_cart').addClass("added_cart").text('ADDED TO CART')
      } else {
        $('.add_cart').removeClass("added_cart").text('ADD TO CART')
      }
      if(data.prod[0].is_added_to_wishlist == 1) {
        $('#add_wishlist').html('<i class="fa-solid fa-heart"></i> Added to Wishlist').addClass('added_wishlist')
      } else {
        $('#add_wishlist').html('<i class="fa-regular fa-heart"></i> Add to Wishlist').removeClass('added_wishlist')
      }
    }
    $.each(data.prod_related, function (index, value) {
      var isAddedToCart = value.is_added_to_cart;
      var isAddedToWishlist = value.is_added_to_wishlist;
      var wishlistClass = isAddedToWishlist ? "wishlist_btn wishlist_added" : "wishlist_btn";
      var wishlistIcon = isAddedToWishlist ? "fa-solid fa-heart" : "fa-sharp fa-regular fa-heart";
    
      var cartClass = isAddedToCart ? "btn btn_secondary text-uppercase addtocart" : "btn btn_border border_black text-uppercase addtocart";
      var cartText = isAddedToCart ? "Added to Cart" : "Add to Cart";
      var p_status = value.status == "Available" ? "" : "disabled";
      var prod_rel = $(`<div class="afford col-lg-4 col-md-6 col-sm-6">
          <div class="shop_card">
            <a class="`+wishlistClass+`" href="#!" data-prodid="`+value.prod_no+`"><i class="`+wishlistIcon+`"></i></a>
            <a class="item_image" href="productdetails?name=${value.prod_name}">
              <img src="productimg/`+ value.prod_img + `" alt="image_not_found">
            </a>
            <div class="item_content">
              <h3 class="item_title text-uppercase">
                <a href="productdetails?name=${value.prod_name}">`+ value.prod_name + `</a>
              </h3>
              <div class="btns_group">
                <span class="item_price bg_default_brown"><i class="fa-solid fa-peso-sign"></i> `+ value.prod_price + `</span>
                <button class="`+cartClass+`" href="#!" data-prodid="`+value.prod_no+`" `+p_status+`>`+cartText+`</button>
              </div>
            </div>
          </div>
        </div>`);
    $('.product_related').append(prod_rel)
    })
   

  },
  error: function (jqXHR, textStatus, errorThrown) {
    console.log(jqXHR.responseText)
    console.log(textStatus, errorThrown)
    location.replace('products')
  }
});
$(document).on('click','.input_number_decrement', function() {
  var input = $(this).siblings('.input_number');
  var value = parseInt(input.val());
  var cart = $(this).closest('tr').attr('data-cartid');
  if (value > 1) {
    input.val(value - 1);

  }
  
});
$(document).on('click', '.input_number_increment', function() {
  var input = $(this).siblings('.input_number');
  var value = parseInt(input.val());
  var cart = $(this).closest('tr').attr('data-cartid');

  input.val(value + 1);


});