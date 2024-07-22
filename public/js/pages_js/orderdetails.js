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

var urlParams = new URLSearchParams(window.location.search);
const orderid = urlParams.get("orderid");

let orderDetails = () => {
    $.ajax({
        type: "GET",
        url: url + "api/orderdetails",
        data: { orderid: orderid },
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
                    var lastFourDigits = cardNumber.substr(
                        cardNumber.length - 4
                    );
                    maskedCardNumber = "**** **** **** " + lastFourDigits;
                } else {
                    maskedCardNumber = "Card number not available";
                }

                const receivedDate = new Date(
                    order.received_date
                ).toLocaleString("en-US", {
                    month: "long",
                    day: "numeric",
                    year: "numeric",
                    hour: "numeric",
                    minute: "numeric",
                    hour12: true,
                });
                const orderDate = new Date(order.order_date).toLocaleString(
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
                let orderInfo;
                switch (order.status) {
                    case "Pending":
                        $(".step:eq(0)").addClass("active");
                        textcolor = "text-info";
                        orderStat = "Pending";
                        orderInfo = "Your order is currently being processed.";
                        break;
                    case "Order Confirmed":
                        $(".step:eq(0), .step:eq(1)").addClass("active");
                        orderStat = "Order Confirmed";
                        orderInfo = "Your order has been confirmed.";
                        textcolor = "text-info";
                        break;
                    case "On the Way":
                        $(".step:eq(0), .step:eq(1), .step:eq(2)").addClass(
                            "active"
                        );
                        textcolor = "text-warning";
                        orderStat = "On the Way";
                        orderInfo =
                            "Your order is en route and will be delivered to you shortly.";
                        break;
                    case "To Receive":
                        $(
                            ".step:eq(0), .step:eq(1), .step:eq(2), .step:eq(3)"
                        ).addClass("active");
                        textcolor = "text-primary";
                        orderStat = "Ready to Receive";
                        orderInfo =
                            "Your order is prepared and ready for you to receive.";
                        break;
                    case "Completed":
                        $(
                            ".step:eq(0), .step:eq(1), .step:eq(2), .step:eq(3)"
                        ).addClass("active");
                        textcolor = "text-success";
                        orderStat = "Delivered";
                        orderInfo =
                            "Order has been delivered on " + receivedDate;
                        break;
                    case "Cancelled":
                        textcolor = "text-danger";
                        orderStat = "Cancelled";
                        orderInfo = "Order has been cancelled";
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
                $("#orderInfo").text(orderInfo);
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
                    const trackItem = $(`<li class="col-md-4">
            <figure class="itemside mb-3">
                <div class="aside"><img src="productimg/${item.prod_img}" class="img-sm border" style="width: 72px; height: 72px;"></div>
                <figcaption class="info align-self-center">
                  <p class="title">${item.prod_name}</p> <span class="text-muted"><i class="fa-solid fa-peso-sign"></i>${item.totalAmount} </span>
                </figcaption>
              </figure>
          </li>`);

                    const itemElement = $(`<div class="row">
            <div class="col-lg-4">
                <div class="order_product_item d-flex align-items-center">
                    <div class="item_image mr-2" style="width: 70px;"
                        onclick="location.assign('productdetails?name=${item.prod_name}')">
                        <img class="img-thumbnail" src="productimg/${item.prod_img}"
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
                    $(".track_item").append(trackItem);
                    $(".order_sec").append(itemElement);
                });
            } else {
                location.replace("order");
            }
        },
        complete: function () {},
    });
};
orderDetails();

// setInterval(function () {
//   if ($.cookie('user_id') == null) {
//       location.replace('login')
//   }
//   syncOrder()
// }, 1000)

let syncOrder = () => {
    $.ajax({
        type: "GET",
        url: url + "api/orderdetails",
        data: { orderid: orderid },
        dataType: "json",
        success: function (res) {
            if (res.status !== "error") {
                const order = res.orders[0];

                const receivedDate = new Date(
                    order.received_date
                ).toLocaleString("en-US", {
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
                let orderInfo;

                switch (order.status) {
                    case "Pending":
                        $(".step:eq(0)").addClass("active");
                        textcolor = "text-info";
                        orderStat = "Pending";
                        orderInfo = "Your order is currently being processed.";
                        break;
                    case "Order Confirmed":
                        $(".step:eq(0), .step:eq(1)").addClass("active");
                        orderStat = "Order Confirmed";
                        orderInfo = "Your order has been confirmed.";
                        textcolor = "text-info";
                        break;
                    case "On the Way":
                        $(".step:eq(0), .step:eq(1), .step:eq(2)").addClass(
                            "active"
                        );
                        textcolor = "text-warning";
                        orderStat = "On the Way";
                        orderInfo =
                            "Your order is en route and will be delivered to you shortly.";
                        break;
                    case "To Receive":
                        $(
                            ".step:eq(0), .step:eq(1), .step:eq(2), .step:eq(3)"
                        ).addClass("active");
                        textcolor = "text-primary";
                        orderStat = "Ready to Receive";
                        orderInfo =
                            "Your order is prepared and ready for you to receive.";
                        break;
                    case "Completed":
                        $(
                            ".step:eq(0), .step:eq(1), .step:eq(2), .step:eq(3)"
                        ).addClass("active");
                        textcolor = "text-success";
                        orderStat = "Delivered";
                        orderInfo =
                            "Order has been delivered on " + receivedDate;
                        break;
                    case "Cancelled":
                        textcolor = "text-danger";
                        orderStat = "Cancelled";
                        orderInfo = "Order has been cancelled";
                        break;
                    default:
                        textcolor = "";
                        orderStat = "";
                }
                $(".ordernum").html(`<span>ORDER #: ${order.order_id}</span>
        <span class="m-1">|</span>
        <span class="font-weight-bold ${textcolor}">${orderStat.toUpperCase()}</span>`);
                $("#orderInfo").text(orderInfo);
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
            } else {
                location.replace("order");
            }
        },
        complete: function () {},
    });
};

// const orderChannel = "orders";

// Echo.channel(orderChannel).listen("OrderDetailsUpdated", (event) => {
//     // Update the UI with the new order details
//     syncOrder();
// });
