$(document).on("click", ".notClickable", function (e) {
  e.preventDefault();
});
const Toast = Swal.mixin({
  toast: true,
  position: 'top-right',
  showConfirmButton: false,
  timer: 3000,
})

// Initialize DataTable
var orders = $("#order_list").DataTable({
  ajax: {
    url: url+"api/orders.php",
    type: "GET",
    dataSrc: "data",
  },
  columns: [
    { data: "order_id",  orderable: false }, 
    { data: "amount" },
    {
      data: "customer",
      render: function (data, type, row) {
        return (
          '<a class="d-flex align-items-center a-user" href="#!" data-userid="' +
          row.userid +
          '">' +
          '<div class="avatar"><img class="rounded-circle" src="' +
          row.profile_img +
          '" alt=""></div>' +
          '<h6 class="mb-0 ml-3">' +
          data +
          "</h6></a>"
        );
      },
    },
    {
      data: "status",
      render: function (data, type, row) {
        var statusClass = "";
        let icon = "";
        if (data === "Pending") {
          statusClass = "badge-status-info";
        } else if (data === "Completed") {
          statusClass = "badge-status-success";
        } else if (data === "Cancelled") {
          statusClass = "badge-status-danger";
        } else if (data === "On the Way") {
          statusClass = "badge-status-warning";
        } else if (data === "To Receive") {
          statusClass = "badge-status-primary";
        } else {
          statusClass = "badge-status-info";
        }
        if (data === "Pending") {
          icon = "fas fa-clock";
        } else if (data === "Completed") {
          icon = "fa-solid fa-check-to-slot";
        } else if (data === "Cancelled") {
          icon = "fa-regular fa-circle-xmark";
        } else if (data === "On the Way") {
          icon = "fa-solid fa-motorcycle";
        } else if (data === "To Receive") {
          icon = "fa-solid fa-box-archive";
        } else if (data === "Order Confirmed") {
          icon = "fa-regular fa-circle-check";
        }
        return (
          '<span class="badge badge-status fs--2 ' +
          statusClass +
          '"><span class="badge-label">' +
          data +
          ' <i class="'+icon+'"></i></span></span>'
        );
      },
    },
    { data: "total_items" },
    { data: "payment_method" },
    { data: "order_date" },
    { data: "prepared_by" },
    { data: "action" },
  ],
   order: [] // Disable initial sorting
});
function decrypt(message) {
  var key = "brewbase@1922@0411RxPSK1";
  message = atob(message);
  var decryptedMessage = "";
  var length = message.length;

  for (var i = 0; i < length; i++) {
    decryptedMessage += String.fromCharCode(
      message.charCodeAt(i) - key.charCodeAt(i % key.length)
    );
  }

  return decryptedMessage;
}

$(window).on("load resize", function () {
  if ($(this).width() < 767) {
    // Replace 576 with your desired screen size
    $(".cCejjr").addClass("m-0");
    $(".cCejjr").removeClass("ml-0");
  } else {
    $(".cCejjr").removeClass("m-0");
    $(".cCejjr").addClass("ml-0");
  }
});

let orderDetails = (order_id) => {
  $.ajax({
    type: "GET",
    url: url+"api/orders.php",
    data: { orderid: order_id, getOrderDetail: 1 },
    dataType: "json",
    success: function (res) {
      if (res.status !== "error") {
        const order = res.orders[0];
        const items = order.items;
        const pay = order.payment;
        const card = order.card_details;

        var maskedCardNumber;

        if (card && card.card_number && card.card_number.length > 0) {
          var cardNumber = card.card_number;
          var lastFourDigits = cardNumber.substr(cardNumber.length - 4);
          maskedCardNumber = "**** **** **** " + lastFourDigits;
        } else {
          maskedCardNumber = "Card number not available";
        }

        const receivedDate = new Date(order.received_date).toLocaleString(
          "en-US",
          {
            month: "long",
            day: "numeric",
            year: "numeric",
            hour: "numeric",
            minute: "numeric",
            hour12: true,
          }
        );
        const orderDate = new Date(order.order_date).toLocaleString("en-US", {
          month: "long",
          day: "numeric",
          year: "numeric",
          hour: "numeric",
          minute: "numeric",
          hour12: true,
        });
        const estTime = new Date(order.order_date);
        estTime.setHours(estTime.getHours() + 1);

        const estDateTime = estTime.toLocaleString("en-US", {
          month: "long",
          day: "numeric",
          year: "numeric",
          hour: "numeric",
          minute: "numeric",
          hour12: true,
        });
        let orderStat;
        let textcolor;
        switch (order.status) {
          case "Pending":
            $(".step:eq(0)").addClass("active");
            textcolor = "text-info";
            orderStat = "Pending";
            break;
          case "Order Confirmed":
            $(".step:eq(0), .step:eq(1)").addClass("active");
            orderStat = "Order Confirmed";
            textcolor = "text-info";
            break;
          case "On the Way":
            $(".step:eq(0), .step:eq(1), .step:eq(2)").addClass("active");
            textcolor = "text-warning";
            orderStat = "On the Way";
            break;
          case "To Receive":
            $(".step:eq(0), .step:eq(1), .step:eq(2), .step:eq(3)").addClass(
              "active"
            );
            textcolor = "text-primary";
            orderStat = "Ready to Receive";
            break;
          case "Completed":
            $(".step:eq(0), .step:eq(1), .step:eq(2), .step:eq(3)").addClass(
              "active"
            );
            textcolor = "text-success";
            orderStat = "Delivered";
            break;
          case "Cancelled":
            textcolor = "text-danger";
            orderStat = "Cancelled";
            break;
          default:
            textcolor = "";
            orderStat = "";
        }

        $(".status").text(orderStat);
        $("#estTime").text(estDateTime);
        $(".prepared").text(
          `${
            order.prepared_by == 0
              ? "Currently being processed."
              : order.prepared_by
          }`
        );
        if (orderStat === "Cancelled") {
          $(".prepared").remove();
        }
        $(".order_del_add")
          .html(`<p class="font-weight-bolder ">${pay.fullname} | ${pay.phone_number} </p>
              <p class="address">${pay.additionalinfo}, ${pay.street}, ${pay.barangay}, ${pay.city}, ${pay.province} ${pay.region}, ${pay.postalcode} ${pay.country}</p>
              <span class="badge badge-success mr-2">Default</span><span
                  class="badge badge-secondary">Pickup Address</span>`);
        $(".paymentMethod").text(pay.payment_method);
        $(".orderDate").text(orderDate);
        $(".orderID").text(order.order_id);
        $(".subTotal").append(`
              <span>Subtotal(${order.totalItems} Item${
          order.totalItems !== 1 ? "s" : ""
        }): </span><span class="font-weight-bold">₱${
          order.totalprodPrice
        }</span>`);
        if (pay.payment_method !== "Cash on Delivery") {
          $(".vjkrto").append(`<div class="cCejjr row ml-0">
                  <div class="order_del_add col-md-12">
                      <p class="font-weight-bolder">Direct Bank Transfer</p>
                      <p class="address"><i class="fa-solid fa-credit-card"></i> ${maskedCardNumber}</p>
                  </div>
              </div>`);
        }

        $(".totalAmount").text(order.total_amount);
        $(".addonsTotal").text(order.totalAddons);
        $(".ordernum").html(`<span>ORDER #: ${order.order_id}</span>
                      <span class="m-1">|</span>
                      <span class="font-weight-bold ${textcolor}">${orderStat.toUpperCase()}</span>`);
        items.forEach((item) => {
          const itemElement = $(`<div class="row">
                  <div class="col-lg-4">
                      <div class="order_product_item d-flex align-items-center">
                          <div class="item_image mr-2" style="width: 70px;"
                              onclick="location.assign('productdetails.html?name=${item.prod_name}')">
                              <img class="img-thumbnail" src="/productimg/${item.prod_img}"
                                  alt="image_not_found">
                          </div>
                          <div class="item_details d-flex flex-column">
                              <h3 class="item_title mb-0">${item.prod_name}</h3>
                              <p class="add_on mt-2 mb-0">Add-ons: ${item.addons_name}</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-8 d-flex justify-content-between align-items-center">
                      <div class="price_quantity d-flex flex-column align-items-start justify-content-center">
                          <p class="m-0">Product Price: <i class="fa-solid fa-peso-sign"></i>${item.prod_price}</p>
                          <p class="m-0">Add-ons: <i class="fa-solid fa-peso-sign"></i>${item.addonsPrice}</p>
                          <p class="m-0">Quantity: ${item.quantity}</p>
                      </div>
                      <div class="order_item_price">
                          <strong class="item_price">
                              <i class="fa-solid fa-peso-sign"></i>${item.totalAmount}
                          </strong>
                      </div>
                  </div>
                  <div class="col-12">
                      <hr>
                  </div>
              </div>`);
          $(".order_sec").append(itemElement);
        });
      } else {
        location.replace("order.html");
      }
    },
    error: function (xhr, text, error) {
      console.log(xhr.responseText);
    },
    complete: function () {
      $("#orderDetails").modal("show");
    },
  });
};
$(document).on("click", ".orderDetail", function () {
  let order_id = $(this).data("orderid");
  orderDetails(order_id);
});

$("#orderDetails").on("hidden.bs.modal", function () {
  $(
    ".orderdetailContaner"
  ).html(`                    <div class="ordetail_header border-bottom">
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
</div>`);
});

$(document).on("click", ".a-user", function () {
  let userid = $(this).data("userid");
  userInfo(userid);
});

function userInfo(userid) {
  $.ajax({
    type: "POST",
    url: url + "api/userprofile.php",
    data: { getUserInfo: userid },
    success: function (res) {
      let user = res.userinfo[0];
      let delAdd;

      if (res.defaultDeliveryAddress?.length > 0) {
        delAdd = res.defaultDeliveryAddress[0];

        $(".defaultDeliveryAddress").show();
        $(".defStreet").text(delAdd.street);
        $(".defBarangay").text(delAdd.barangay);
        $(".defCity").text(delAdd.city);
        $(".defProvince").text(delAdd.province + "/" + delAdd.region);
        $(".defCode").text(delAdd.postalcode);
        $(".defFullname").text(delAdd.fullname + " | " + delAdd.phone_number);
        $(".defAddInfo").text(delAdd.additionalinfo);
      } else {
        $(".defaultDeliveryAddress").hide();
      }

      let profileimg =
        user.profile_img !== null
          ? "/profileimg/" + user.profile_img
          : "/profileimg/default-pic.png";
      let celNo = user.contact_no !== null ? user.contact_no : "(Not Set)";
      let telNo =
        user.tel_no !== "" && user.tel_no !== null ? `/${user.tel_no}` : "";

      var totalInvested = user.total_invested;
      var formattedTotalInvested = totalInvested
        .toLocaleString("en-US")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      $(".totalPaid").text("₱" + formattedTotalInvested);
      $(".totalOrders").text(user.orders_count);
      $(".totalWishlist").text(user.wishlist_count);
      $(".profileImg").attr("src", profileimg);
      $(".fullName").text(
        `${user.fname}${user.midname ? ` ${user.midname} ` : " "}${user.lname}`
      );
      $(".uName").text(decrypt(user.username));
      $(".uzCode").text(user.postalcode);
      $(".uCountry").text(user.country);

      if (user.region || user.province || user.city || user.barangay) {
        $(".uStreet").text(user.street);
        $(".uBarangay").text(user.barangay);
        $(".uCity").text(user.city);
        $(".uProvince").text(user.province + "/" + user.region);
      } else {
        $(".uStreet").text("(Not Set)");
        $(".uBarangay").text("(Not Set)");
        $(".uCity").text("(Not Set)");
        $(".uProvince").text("(Not Set)");
      }

      $(".user-image").attr("src", profileimg);
      $(".profEmail").text(decrypt(user.email));
      $(".profPhoneNo").html(celNo + telNo);
      $(".profCountry").text(user.country);
      $(".profileFullName").text(user.fname + " " + user.lname.charAt(0) + ".");
    },
    error: function (xhr, textStatus, errorThrown) {
      console.log(xhr.responseText);
    },
    complete: function () {
      $("#userProfile").modal();
    },
  });
}

function incName(callback) {
  $.ajax({
    url: url + "/api/userinfo.php",
    method: "POST",
    data: {userid: userid},
    dataType: "json",
    success: function(data) {
      let user = data.userinfo[0];
      var name = user.fname + ' ' + user.lname;
      callback(name);
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
  
}

incName(function(name) {
  $(document).on('click','.updateStat ', function () {
    let orderid = $(this).data('orderid')
    let stat = $(this).data('status')
    let sta;
    if (stat === 'Order Confirmed') {
      sta = 'Order Confirmed'
    } else if(stat === 'On the Way'){
      sta = 'On the Way'
    } else if(stat === 'To Receive') {
      sta = 'To Receive'
    } else if (stat === 'Cancel') {
      sta = 'Cancelled'
    }
    upStat(orderid, sta, name)
  })
});

let upStat = (ordid, stat, name) => {
  $.ajax({
    type: "POST",
    url: url + "api/orders.php",
    data: {updateOrder: ordid, status: stat, name: name},
    dataType: "json",
    success: function (val) {
      console.log(val)
      Toast.fire({
        icon: 'success',
        title: val.message
    })
    reloadDataTable()
    },
    error: function (xhr, text, error) {
      console.log(xhr.responseText)
    } 
  });
}

function reloadDataTable() {
  orders.ajax.reload();
}