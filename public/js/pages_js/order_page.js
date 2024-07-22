
setInterval(function () {
  if ($.cookie('user_id') == null) {
      location.replace('login')
  }
}, 1000)
$(window).on("load resize", function () {
    if ($(this).width() < 783) { // Replace 576 with your desired screen size
        $(".order_date").removeClass("text-right");
    } else {
        $(".order_date").addClass("text-right");
    }
});

$(".ordercat").on("click", "button", function () {
    var filterValue = $(this).attr("data-filter");

    $grid.isotope({ filter: filterValue });
});

$(".ordercat").each(function (i, buttonGroup) {
    var $buttonGroup = $(buttonGroup);

    $buttonGroup.on("click", "button", function () {
        $buttonGroup.find(".active").removeClass("active");
        $(this).addClass("active");
    });
});

var $grid = $(".myorder_row").isotope({
    itemSelector: ".element-order",
    layoutMode: "fitRows"
});
let displayOrders = () => {
    $.ajax({
      url: url + 'api/orders',
      dataType: 'json',
      data: {userid: userid},
      success: function (response) {
        const orders = response.orders;
        orders.forEach(function (order) {
          let orderId = order.order_id;
          const orderDate = new Date(order.order_date).toLocaleString('en-US', { 
            month: 'long',
            day: 'numeric',
            year: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            hour12: true
          });
          
          const orderStatus = order.status;
          let orderStat;
          const lowercaseStatus = orderStatus.toLowerCase().replace(/\s/g, '');
          let textcolor;

            switch (order.status) {
            case 'Pending':
                textcolor = 'text-info';
                orderStat = 'Pending';
                break;
            case "Order Confirmed":
                  $(".step:eq(0), .step:eq(1)").addClass("active");
                  textcolor = "text-info";
                  orderStat = "Order Confirmed";
                break;
            case 'On the Way':
                textcolor = 'text-warning';
                orderStat = 'On the Way';
                break;
            case 'To Receive':
                textcolor = 'text-primary';
                orderStat = 'Ready to Recieve';
                break;
            case 'Completed':
                textcolor = 'text-success';
                orderStat = 'Delivered';
                break;
            case 'Cancelled':
                textcolor = 'text-danger';
                orderStat = 'Cancelled';
                break;
            default:
                textcolor = '';
                orderStat = '';
            }

          const items = order.items;
          
          const $newItem = $(`
            <div class="element-order ${lowercaseStatus} wow fadeIn" data-wow-delay=".1s" data-category="${lowercaseStatus}">
              <div class="row">
                <div class="col-lg-7 col-md-4">
                  <h6>Order Number: ${orderId}</h6>
                </div>
                <div class="order_date col-lg-5 col-md-8 text-right">
                  <p class="font-weight-bold">Date/Time: ${orderDate} |
                    <span class="${textcolor} d-inline-block d-lg-inline">${orderStat}</span>
                  </p>
                </div>
              </div>
              <hr class="mt-0">
          `);
          
          items.forEach(function (item) {
            const prodImg = item.prod_img;
            const prodName = item.prod_name;
            const quantity = item.quantity;
            const prodPrice = item.prod_price;
            const addonsPrice = item.addonsPrice;
            const totalAmount = item.totalAmount;
            const addonsName = item.addons_name;
            const $itemElement = $(`
              <div class="row">
                <div class="col-lg-4">
                  <div class="order_product_item d-flex align-items-center">
                    <div class="item_image mr-2" style="width: 70px;" onclick="location.assign('productdetails?name=${prodName}')">
                      <img class="img-thumbnail" src="productimg/${prodImg}" alt="image_not_found">
                    </div>
                    <div class="item_details d-flex flex-column">
                      <h3 class="item_title mb-0">${prodName}</h3>
                      <p class="add_on mt-2 mb-0">Add-ons: ${addonsName}</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 d-flex justify-content-between align-items-center">
                  <div class="price_quantity d-flex flex-column align-items-start justify-content-center">
                    <p class="m-0">Product Price: <i class="fa-solid fa-peso-sign"></i>${prodPrice}</p>
                    <p class="m-0">Add-ons: <i class="fa-solid fa-peso-sign"></i>${addonsPrice}</p>
                    <p class="m-0">Quantity: ${quantity}</p>
                  </div>
                  <div class="order_item_price">
                    <strong class="item_price">
                      <i class="fa-solid fa-peso-sign"></i>${totalAmount}
                    </strong>
                  </div>
                </div>
                <div class="col-12">
                  <hr>
                </div>
              </div>
            `);
            
            $newItem.append($itemElement);
          });
          
          const orderTotal = order.total_amount;
          
          const $totalPriceElement = $(`
            <div class="row">
              <div class="col">
                <div class="order_total_price text-right">
                  <p class="d-inline-block">Order Total:</p>
                  <strong class="item_price d-inline-block">
                    <i class="fa-solid fa-peso-sign"></i>${orderTotal}
                  </strong>
                </div>
              </div>
            </div>
          `);
          
          $newItem.append($totalPriceElement);
          
          const $btnGroupElement = $(`
          <div class="row">
            <div class="col-12">
              <div class="order_btn_group float-right">
                ${orderStatus === 'Pending' ? `<button class="btn btn_secondary cancelOrder" data-orderid="${orderId}">Cancel</button>` :
                orderStatus === 'Completed' || orderStatus === 'Cancelled' ? '<button class="btn btn_secondary" onclick="location.assign(\'products\')">Order Again</button>' :
                orderStatus === 'To Receive' ? `<button class="btn btn_secondary orderConfirm" data-orderid="${orderId}")">Order Confirm</button>` : ''}
                <button class="btn btn_primary" onclick="location.assign('orderdetails?orderid=${orderId}')">Details</button>
              </div>
            </div>
          </div>
        `);

        
          
          $newItem.append($btnGroupElement);
          
          $(".myorder_row").append($newItem);
        });
        
        $(".myorder_row").isotope('reloadItems').isotope();
      }
    });
  };
  
  displayOrders()
// $('.loadMore').on('click', function () {
//     var thiss = $(this)
//     $(this).hide()
//     $('#loading').append('<li class="loaders"><div class="loading"></div></li>')
//     setInterval(function () {
//         $('.loaders').remove()
//         thiss.show()
//     }, 1000)
// })


$(document).on('click', '.cancelOrder', function() {
  Swal.fire({
    title: 'Confirmation',
    text: 'Are you sure you want to cancel the order?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, Cancel',
    cancelButtonText: 'No, Keep Order',
    customClass: {
      confirmButton: 'btn btn_primary',
      cancelButton: 'btn btn_secondary'
    }
  }).then((result) => {
    if (result.isConfirmed) {
      // Perform cancel operation
      const orderId = $(this).data('orderid');
      $.ajax({
        type: "POST",
        url: url + "api/orders/cancel",
        data: {orderCancel: orderId},
        success: function (res) {
          if (res.status === 'success') {
              $grid.empty();
              displayOrders()
              $(".myorder_row").isotope('reloadItems').isotope();
              Swal.fire({
                title: 'Cancelled',
                text: 'The order has been cancelled.',
                icon: 'success',
                customClass: {
                  confirmButton: 'btn btn_primary'
                }
              });
          } else {
            $grid.empty();
              displayOrders()
              $(".myorder_row").isotope('reloadItems').isotope();
            Swal.fire({
              title: res.title,
              text: res.message,
              icon: 'info',
              customClass: {
                confirmButton: 'btn btn_secondary'
              }
            });
          }
        },
        error: function (xhr, textStatus, error) {
          console.log(xhr.responseText)
        }
      });

    }
  });
});


$(document).on('click', '.orderConfirm', function() {
  Swal.fire({
    title: 'Confirmation',
    text: 'Are you sure you want to confirm the order?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, Confirm',
    cancelButtonText: 'No, Cancel',
    customClass: {
      confirmButton: 'btn btn_primary',
      cancelButton: 'btn btn_secondary'
    }
  }).then((result) => {
    if (result.isConfirmed) {
      const orderId = $(this).data('orderid');
      console.log(orderId)

      $.ajax({
        type: "POST",
        url: url + "api/orders/confirm",
        data: {orderConfirm: orderId},
        success: function (res) {
          if (res.status === 'success') {
              $grid.empty();
              displayOrders()
              $(".myorder_row").isotope('reloadItems').isotope();
              Swal.fire({
                title: 'Confirmed',
                text: 'The order has been confirmed.',
                icon: 'success',
                customClass: {
                  confirmButton: 'btn btn_primary'
                }
              });
          } else {
            Swal.fire({
              title: 'Error',
              text: res.message,
              icon: 'warning',
              customClass: {
                confirmButton: 'btn btn_secondary'
              }
            });
          }
        }
      });
      
    }
  });
});
