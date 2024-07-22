setInterval(function () {
    if ($.cookie('user_id') == null) {
        location.replace('login')
    }
}, 1000)
function cartList() {
    var addons = [];
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
            imageSrc: `/addonsimg/${data.addons_img}`,
          };
          addons.push(addonsObject);
        });
      },
      complete: function () {
        $.ajax({
          type: "GET",
          url: url+"api/cart",
          dataType: "json",
          data: {userid: userid},
          success: function (data) {
            var cart = "";
            $.each(data.cart, function (index, value) {
              var dateString = value.created_at;
              var formattedDate = moment(dateString).format("MMMM D, YYYY h:mmA");
              cart += `<tr data-cartid="${value.cart_id}">
                      <td>
                          <div class="carttable_product_item" data-cartid="${value.cart_id}">
                              <div class="item_image" style="width: 70px;">
                                  <img src="productimg/${value.prod_img}"
                                      alt="${value.prod_name}">
                              </div>
                              <button type="button" class="remove_btn cartrmvBtn" data-cartid="${value.cart_id}"><i
                                      class="fa fa-times"></i></button>
                              <h3 class="item_title" onclick="location.assign('productdetails.html?name=${value.prod_name}')">${value.prod_name}</h3>
                          </div>
                      </td>
                      <td><span class="price_text1">₱ ${value.prod_price}</span></td>
                      <td>
                          <div class="quantity_input d-flex justify-content-center">
                              <form action="#">
                                  <button type="button" class="input_number_decrement"><i
                                          class="fa-sharp fa-solid fa-minus"></i></button>
                                  <input class="input_number" type="text" value="${value.quantity}" readonly>
                                  <button type="button" class="input_number_increment"><i
                                          class="fa-solid fa-plus"></i></button>
                              </form>
                          </div>
                      </td>
                      <td>
                      <select class="addons" data-cartid="${value.cart_id}">
                      </select>
                      </td>
                      <td><span class="price_text2">${formattedDate}</span></td>
                      <td><span class="price_text2">₱ ${value.total_price}</span></td>
                  </tr>`;
              $(document).ready(function () {
                var isInitialLoad = true;
                var ddslickElement = $(`.addons[data-cartid="${value.cart_id}"]`);
                ddslickElement.ddslick({
                  data: addons,
                  defaultSelectedIndex: value.addonsID,
                  onSelected: function (selectedData) {
                    var cartId = ddslickElement.attr("data-cartid");
                    var selectedValue = selectedData.selectedData.value;
                    if (!isInitialLoad) {
                      $('body').append('<div id="ajaxLoad"></div>')
                    $.ajax({
                        type: "POST",
                        url: url+"api/cart/update-addons",
                        data: {addonsID: selectedValue, cartID: cartId},
                        dataType: "json",
                        success: function (res) {
                            cartList();
                            window.checkAddtoCart();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR.responseText)
                        },
                        complete: function () {
                          $("#ajaxLoad").fadeOut("slow", function () {
                            $(this).remove();
                          });
                        }
                    });
                    }
                    isInitialLoad = false;
                  },
                });
              });
            });
            $(".totalprice").html(`₱ ${data.totalAmount}`);
            $(".cart_data").html(cart);
          },
          complete: function () {
            var cart_data = $(".cart_data tr").length;
            if (cart_data == 0) {
              $(".cart_data")
                .html(`<tr class="justify-content-center wow fadeInUp" data-wow-delay=".1s">
                      <td><h5 class="text-center">No Items</h5></td>
                  </tr>`);
              $("#cartTotalitems").hide();
              $("#cartBtnCheckout").html(
                `<a class="btn btn_primary text-uppercase" href="products">Browse Product</a>`
              );
            }
          },
        });
      },
    });
  }
  
  cartList();
  // ========== cart page
      // Increment quantity
      $(document).on('click', '.input_number_increment', function() {
        var input = $(this).siblings('.input_number');
        var value = parseInt(input.val());
        var cart = $(this).closest('tr').attr('data-cartid');
      
        input.val(value + 1);
      
        updateCartItemQuantity(cart, value + 1);
      });
      
      function updateCartItemQuantity(cartId, quantity) {
        $('body').append('<div id="ajaxLoad"></div>')
        $.ajax({
          type: "POST",
          url: url+"api/cart/update-quantity",
          data: { crtQuant: quantity, cartid: cartId },
          success: function (res) {
            checkAddtoCart();
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
          },
          complete: function () {
            $("#ajaxLoad").fadeOut("slow", function () {
              $(this).remove();
            });
            cartList();
            checkAddtoCart();
          }
        });
      }
      

      $(document).on('click','.input_number_decrement', function() {
        var input = $(this).siblings('.input_number');
        var value = parseInt(input.val());
        var cart = $(this).closest('tr').attr('data-cartid');
        if (value > 1) {
          input.val(value - 1);
          updateCartItemQuantity(cart, value - 1);
        }
        
      });

     
      $(document).on('click', '.cartrmvBtn', function() {
        var row = $(this).closest('tr');
        
        let cartID = $(this).attr('data-cartid')
        $.ajax({
          type: "POST",
          url: url+"api/cart/delete",
          data: {delcartItem: cartID},
          success: function (response) {
            row.slideUp('fast', function() {
              row.remove();
              cartList();
              checkAddtoCart();
            });
            
           
          }
        });
      });
// ==========