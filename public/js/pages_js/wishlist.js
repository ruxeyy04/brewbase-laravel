setInterval(function () {
  if ($.cookie('user_id') == null) {
      location.replace('login')
  }
}, 1000)
let wishlistItem = ''
// Add sorting to each column
$("table th").click(function () {
  $(this).on("selectstart", false);
  if (!$(this).is(':contains("Add to Cart")')) {
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
  }
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

let displayWishlist = () => {
  $.ajax({
    url: url + "api/wishlist",
    method: "GET",
    data: {userid: userid},
    success: function(val) {
      $.each(val.wishlists, function(ind, val) {
        
        var dateString = val.created_at;
        var formattedDate = moment(dateString).format("MMMM D, YYYY h:mmA");
        wishlistItem += `<tr class="wow fadeInUp" data-wow-delay=".1s">
          <td>
              <div class="wishlisttable_product_item">
                  <div class="item_image" style="width: 70px;">
                      <img src="productimg/${val.prod_img}" alt="${val.prod_name}">
                  </div>
                  <button type="button" class="remove_btn" data-wishlistid="${val.wishlist_id}"><i class="fa fa-times"></i></button>
                  <h3 class="item_title">${val.prod_name}</h3>
              </div>
          </td>
          <td><span class="price_text1">₱ ${val.prod_price}</span></td>
          <td><span class="price_text2">${formattedDate}</span></td>
          <td><span class="price_text2">${val.status}</span></td>
          <td><button class="btn btn_primary p-3 addtoCart" data-wishlistid="${val.wishlist_id}" data-prodno="${val.prod_no}" ${val.status === 'Not Available' ? 'disabled':''}><i class="fa-solid fa-cart-plus" style="font-size: 1.5rem;"></i></button></td>
        </tr>`;
      });
      $('#wishlistData').html(wishlistItem);
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
  
}

displayWishlist()
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
$(document).on('click', '.addtoCart', function () {
  let wishlist = $(this)
  let wishlistId = wishlist.data('wishlistid')
  let prodno = wishlist.data('prodno')
  var row = $(this).closest('tr');
  $.ajax({
    type: "POST",
    url: url + "api/wishlist/move-to-cart",
    data: {addCart: wishlistId, prod_no: prodno, userid: userid},
    success: function (res) {
      if (res.status === 'success') {
        row.slideUp('fast', function() {
          row.remove();
        });
        toast.fire({
          icon: "success",
          title: res.message,
        });
        checkAddtoCart()
      } else {
        toast.fire({
          icon: "warning",
          title: res.message,
        });
      }
    },
    error: function (xhr, textStatus, errorThrown) {
      console.log(xhr.responseText)
      toast.fire({
        icon: "error",
        title: "There is an Error",
      });
    }
  });
})
$(document).on('click', '.remove_btn', function (){
  let wishlist = $(this)
  let wishlistId = wishlist.data('wishlistid')
  var row = $(this).closest('tr');
        $.ajax({
          type: "POST",
          url: url + "api/wishlist/delete-item",
          data: {delwishlistItem: wishlistId},
          success: function (res) {
            row.slideUp('fast', function() {
              row.remove();
            });
          }
        });

})