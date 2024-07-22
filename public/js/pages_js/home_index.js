
$.ajax({
  url: url+'api/products',
  type: 'GET',
  dataType: 'json',
  data: {userid: userid},
  success: function (data) {
    $.each(data.new, function (index, value) {
      var isAddedToCart = value.is_added_to_cart;
      var isAddedToWishlist = value.is_added_to_wishlist;
      var wishlistClass = isAddedToWishlist ? "wishlist_btn wishlist_added" : "wishlist_btn";
      var wishlistIcon = isAddedToWishlist ? "fa-solid fa-heart" : "fa-sharp fa-regular fa-heart";
    
      var cartClass = isAddedToCart ? "btn btn_secondary text-uppercase addtocart" : "btn btn_border border_black text-uppercase addtocart";
      var cartText = isAddedToCart ? "Added to Cart" : "Add to Cart";
      var p_status = value.status == "Available" ? "" : "disabled";
      var $affordpro = $(`<div class="afford col-lg-4 col-md-6 col-sm-6">
          <div class="shop_card">
            <a class="`+wishlistClass+`" href="#!" data-prodid="`+value.number+`"><i class="`+wishlistIcon+`"></i></a>
            <a class="item_image" href="productdetails?name=`+value.prodname+`">
              <img src="productimg/`+ value.image + `" alt="image_not_found">
            </a>
            <div class="item_content">
              <h3 class="item_title text-uppercase">
                <a href="productdetails?name=`+value.prodname+`">`+ value.prodname + `</a>
              </h3>
              <div class="btns_group">
                <span class="item_price bg_default_brown"><i class="fa-solid fa-peso-sign"></i> `+ value.price + `</span>
                <button class="`+cartClass+`" href="#!" data-prodid="`+value.number+`" `+p_status+`>`+cartText+`</button>
              </div>
            </div>
          </div>
        </div>`);
      $('.affordabledrink').append($affordpro)
    })
    
  },
  complete: function () {
    var itemsPerPage = 6;

    var $container = $('.affordabledrink');
    var $items = $container.find('.afford');
    $items.slice(itemsPerPage).hide();

    var numPages = Math.ceil($items.length / itemsPerPage);
    var $pagination = $('.pagination_nav1');
    if (numPages !== 1) {
      $pagination.append(`<li><a href="#!" class="pleft"><i class="fa-solid fa-angles-left"></i></a></li>`)
    }
    for (var i = 1; i <= numPages; i++) {
      if (i === 1) {
        var $link = $('<li class="active"><a href="#!" class="nump">' + i + '</a></li>');
      } else {
        var $link = $('<li><a href="#!"  class="nump">' + i + '</a></li>');
      }
      $pagination.append($link);
    }
    if (numPages !== 1) {
      $pagination.append(`<li><a href="#!" class="pright"><i class="fa-solid fa-angles-right"></i></a></li>`)
    }
    $pagination.on('click', '.pleft', function (e) {
      e.preventDefault();

      var $current = $pagination.find('.active');
      var pageNum = parseInt($current.find('.nump').text()) - 1;

      if (pageNum < 1) {
        pageNum = numPages;
      }

      $current.removeClass('active');
      $pagination.find('.nump').filter(function () {
        return $(this).text() === pageNum.toString();
      }).parent().addClass('active');

      $items.hide();
      var startIndex = (pageNum - 1) * itemsPerPage;
      var endIndex = startIndex + itemsPerPage;
      $items.slice(startIndex, endIndex).fadeIn('slow');
    });
    $pagination.on('click', '.pright', function (e) {
      e.preventDefault();

      var $current = $pagination.find('.active');
      var pageNum = parseInt($current.find('.nump').text()) + 1;

      if (pageNum > numPages) {
        pageNum = 1;
      }
      $current.removeClass('active');
      $pagination.find('.nump').filter(function () {
        return $(this).text() === pageNum.toString();
      }).parent().addClass('active');

      $items.hide();
      var startIndex = (pageNum - 1) * itemsPerPage;
      var endIndex = startIndex + itemsPerPage;
      $items.slice(startIndex, endIndex).fadeIn('slow');
    });
    $pagination.on('click', '.nump', function (e) {
      e.preventDefault();

      var $link = $(this);
      var pageNum = $link.text();

      $pagination.find('.active').removeClass('active');
      $link.parent().addClass('active');

      $items.hide();
      var startIndex = (pageNum - 1) * itemsPerPage;
      var endIndex = startIndex + itemsPerPage;
      $items.slice(startIndex, endIndex).fadeIn('slow');
    });

  }
})

var $grid = $('.grid').isotope({
  itemSelector: '.element-item',
  layoutMode: 'fitRows',
  transitionDuration: 0 
});
// =======================================

var category = '', $newItem = '';
$.ajax({
  url: url + 'api/products',
  type: 'GET',
  dataType: 'json',
  success: function (data) {
    category += '<li><button class="button text-uppercase active" data-filter="*">all</button></li>'
    $.each(data.cat, function (cat, value) {
      var c = "." + value.toLowerCase().replace(/\s+/g, "");
      category += '<li><button class="button text-uppercase" data-filter="' + c + '">' + value + '</button></li>'
    })
    $('.cattt').html(category)
    $.each(data.prod, function (prod, value) {
      var c = value.category.toLowerCase().replace(/\s+/g, "");
      var $newItem = $('<div class="element-item ' + c + ' data-category="' + c + '">' +
        '<div class="recipe_item">' +
        '<div class="content_col">' +
        '<a class="item_image" href="productdetails?name='+value.prodname+'" style="width: 120px;"><img src="productimg/' + value.image + '" alt="image_not_found"></a>' +
        '<div class="item_content">' +
        '<h3 class="item_title text-uppercase">' +
        '<a href="productdetails?name='+value.prodname+'">' + value.prodname + '</a>' +
        '</h3>' +
        '<p class="mb-0">' + value.description + '</p>' +
        '</div>' +
        '</div>' +
        '<div class="content_col">' +
        '<strong class="item_price">' +
        '<sub><i class="fa-solid fa-peso-sign"></i></sub>' + value.price +
        '</strong>' +
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
    // initialize pagination
    var itemsPerPage = 5;
    var currentPage = 1;
    var totalItems = $grid.children().length;
    var totalPages = Math.ceil(totalItems / itemsPerPage);

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

