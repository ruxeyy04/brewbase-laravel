setInterval(function () {
  if ($.cookie('user_id') == null) {
      location.replace('login')
  }
}, 1000)

function appendPreloader() {
  var preloaderContent = '<div id="preloader"></div>';
  $(preloaderContent)
    .appendTo('body')
    .fadeIn('slow');
}

function removePreloader() {
  $("#preloader").fadeOut("slow", function () {
    $(this).remove();
  });
}

let checkoutItemCheck = () => {

  $.ajax({
    url: url + "api/cart",
    method: "GET",
    dataType: "json",
    data: {userid: userid},
    success: function(res) {
      $.each(res.cart, function(index, val) {
        let cartItem = `<div class="row">
              <div class="col-lg-4">
                  <div class="order_product_item d-flex align-items-center">
                      <div class="item_image mr-2" style="width: 70px;" onclick="location.assign('productdetails?name=${val.prod_name}')">
                          <img class="img-thumbnail" src="productimg/${val.prod_img}" alt="Product Image">
                      </div>
                      <div class="item_details d-flex flex-column">
                          <h3 class="item_title mb-0">${val.prod_name}</h3>
                          <p class="add_on mt-2 mb-0">Add-ons: ${val.addons_name}</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-8 d-flex justify-content-between align-items-center">
                  <div class="price_quantity d-flex flex-column align-items-start justify-content-center">
                      <p class="m-0">Product Price: <i class="fa-solid fa-peso-sign"></i>${val.prod_price}</p>
                      <p class="m-0">Add-ons: <i class="fa-solid fa-peso-sign"></i>${val.addons_price}</p>
                      <p class="m-0">Quantity: ${val.quantity}</p>
                  </div>
                  <div class="order_item_price">
                      <strong class="item_price">
                          <i class="fa-solid fa-peso-sign"></i>${val.total_price}
                      </strong>
                  </div>
              </div>
              <div class="col-12">
                  <hr>
              </div>
          </div>`;
  
        $(".checkout_items").append(cartItem);
      });
      let totalSummary = `<h6>Total Summary</h6>
          <hr>
          <div class="row m-0 d-flex justify-content-between">
              <span>Subtotal(${res.cartCount} Item${res.cartCount != 1 ? 's' : ''}): </span><span class="font-weight-bold">₱${res.totalProduct}</span>
          </div>
          <div class="row m-0 d-flex justify-content-between">
              <span>Add-ons: </span><span class="font-weight-bold">₱${res.totalAddons}</span>
          </div>
          <div class="row m-0 d-flex justify-content-between">
              <span>Delivery Fee:</span><span class="font-weight-bold">₱0.00</span>
          </div>
          <hr>`;
      $(".total_price").html(`<strong>Total</strong> ₱${res.totalAmount}`);
      $(".totalsummary").html(totalSummary);
      $('.prodTotal').text(res.totalProduct);
      $('.addonsTotal').text(res.totalAddons);
      $('.totalAmount').text(res.totalAmount);
      if (res.totalAmount === null) {
        location.replace('/products');
      }
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
  
};
let checkDeliveryAddress = () => {
  $.ajax({
    type: "POST",
    url: url + "api/userprofile/get-info",
    data: { getUserInfo: 1, userid: userid },
    dataType: "json",
    success: function (val) {
      if (val.defaultDeliveryAddress?.length > 0) {
        delAdd = val.defaultDeliveryAddress[0];
        let delAddress = `<p class="font-weight-bolder ">${delAdd.fullname} | ${delAdd.phone_number} </p>
                <p class="address">${delAdd.additionalinfo}, ${delAdd.street}, ${delAdd.barangay}, ${delAdd.city}, ${delAdd.province} ${delAdd.region}, ${delAdd.postalcode} ${delAdd.country}</p>
                <span class="badge badge-success mr-2">Default</span><span
                    class="badge badge-secondary">Pickup Address</span>
                <br>
                <button class="btn btn_secondary"
                    onclick="location.replace('userprofile')">Change Address</button>`;
        let addressforDelivery = `<p class="font-weight-bolder">${delAdd.fullname} | ${delAdd.phone_number}</p>
                    <p class="address">${delAdd.additionalinfo}, ${delAdd.street}, ${delAdd.barangay}, ${delAdd.city}, ${delAdd.province} ${delAdd.region}, ${delAdd.postalcode} ${delAdd.country}</p>`;
        $(".order_del_add").append(addressforDelivery);
        $(".checkout_address").append(delAddress);
      } else {
        $(".checkout_address").hide();
        Swal.fire({
          title: "Cannot Order",
          text: "Add or Set a default delivery address first",
          icon: "warning",
          showCancelButton: false,
          confirmButtonText: "OK",
          customClass: {
            confirmButton: "btn btn_primary",
          },
        }).then((result) => {
          // Check if the Swal dialog was closed (not canceled)
          if (result.dismiss !== "cancel") {
            // Redirect to another link
            location.replace("/userprofile");
          }
        });
      }
    },
  });
};
checkDeliveryAddress();
checkoutItemCheck();

$("#place_order").click(function () {
  var activeListItem = $(".checkout_steps_nav li.active");
  if (activeListItem.length > 0) {
    var activeItemId = activeListItem.attr("id");
    if (activeItemId === 'cod') {
      appendPreloader()
      $.ajax({
        type: "POST",
        url: url + "api/checkout/cod",
        data: {cod: 1, userid: userid},
        success: function (res) {
          $('#orderNo').text(res.orderid)
        },
        error: function (xhr, textStatus, errorThrown) {
          console.log(xhr, textStatus, errorThrown)
        },
        complete: function () {
          removePreloader()
          $('#ordersuccess').modal('show')
        }
      });
    } else {
      appendPreloader()
      var cardNumber = $('#card_number').val();
      var expDate = $('#card_exp').val();
      var cvCode = $('[name="cv_code"]').val();
      var cardOwner = $('[name="card_owner"]').val();
      let cardData = {card_number: cardNumber, exp_date: expDate, cv_code: cvCode, card_owner: cardOwner, directbank: 1, userid: userid};
        $.ajax({
          type: "POST",
          url: url+"api/checkout/direct-bank",
          data: cardData,
          dataType: "json",
          success: function (res) {
            console.log(res)
            if(res.status ==='success') {
              $('#orderNo').text(res.orderid)
            } else if (res.status ==='empty'){
              Swal.fire({
                title: 'Missing or Empty Required Fields',
                text: 'Please fill in the required fields',
                icon: 'info',
                showCancelButton: false,
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn_primary'
                }
            });
            } else {
              Swal.fire({
                title: 'There is an Error',
                text: 'Please try again',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn_primary'
                }
            });
            }
          },
          error: function (xhr, textStatus, errorThrown) {
            console.log(xhr.responseText, textStatus, errorThrown)
          },
          complete: function () {
            $('#ordersuccess').modal('show')
            removePreloader()
          }
        });
        console.log('direct');
    }
  } else {
    Swal.fire({
        title: 'No Payment Method',
        text: 'Select Payment Method First before order',
        icon: 'warning',
        showCancelButton: false,
        confirmButtonText: 'OK',
        customClass: {
          confirmButton: 'btn btn_primary',
          popup: 'swal2-popup',
          content: 'swal2-styled' 
        }
      });
      
  }
});
$('#ordersuccess').on('hidden.bs.modal', function () {
  location.replace('order')
})