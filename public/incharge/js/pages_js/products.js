


const Toast = Swal.mixin({
  toast: true,
  position: 'top-right',
  iconColor: 'white',
  customClass: {
      popup: 'colored-toast'
  },
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true
})


$(document).on('click', '.addProd', function() {
    var formData = new FormData($("#addProductForm")[0]);
    formData.append('addProd', 1);
    
    $.ajax({
      type: "POST",
      url: url + "api/products.php",
      data: formData,
      dataType: "json",  // Corrected typo from "dataTpe" to "dataType"
      contentType: false,
      processData: false,
      success: function(res) {
        if (res.status === 'success') {
          Swal.fire({
            title: res.title,
            text: res.message,
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
          }).then(function() {
            $("#addProductForm")[0].reset();
            $('#img-src').attr('src', '/../img/insert_img.jpg')
            $("#file-1-preview div").html("<span>+</span>");
            reloadDataTable();
          });
        } else {
          Swal.fire({
            title: res.title,
            text: res.message,
            icon: 'warning',
            showCancelButton: false,
            confirmButtonText: 'OK',
          });
        }
      },
      error: function(xhr, text, error) {
        console.log(xhr.responseText);
      }
    });
  });
  var table = $('#products').DataTable({
    "ajax": {
      "url": url+"api/products.php",
      "type": "GET",
      "dataType": "json",
      "dataSrc": "data"
    },
    "columns": [
      { "data": "0" },
      { "data": "1",width: "200px" },
      { "data": "2" },
      { "data": "3",width: "200px" },
      { "data": "4" },
      { "data": "5" },
      { "data": "6" },
      { "data": "7" }
    ]
  });
  let globprodIDupt;
  $(document).on('click', '.updateProd', function () {
    let prodid = $(this).data('prodid')
    globprodIDupt = prodid
    $.ajax({
      type: "POST",
      url: url+ "api/products.php",
      data: {updateProd: prodid},
      dataType: "json",
      success: function (res) {
        let val = res.prod
        $('#prodname').val(val.prod_name)
        $('#desc').val(val.prod_description)
        $('#img-src').attr('src', '/../productimg/'+val.prod_img)
        $('#category').val(val.category)
        $('#prodDate').val(val.prod_date)
        $('#prodPrice').val(val.prod_price)
        $('#status').val(val.status)
        $('#addeditTitle').text('Edit Product')
        $('.addProd').replaceWith('<button type="button" class="btn btn-warning updateProd1">Update Product</button>');

      },
      error: function (xhr, text, error) {
        console.log(xhr.responseText)
      },
      complete: function () {
        $('#addedit').modal('show')
      }
    });
  })
$(document).on('click','.updateProd1', function () {
  var formData = new FormData($("#addProductForm")[0]);
  formData.append('update_Prod', globprodIDupt);
  $.ajax({
    type: "POST",
    url: url+"api/products.php",
    data: formData,
    dataType: "json",
    contentType: false,
      processData: false,
    success: function (res) {
      if (res.status === 'success') {
        Swal.fire({
          title: res.title,
          text: res.message,
          icon: 'success',
          showCancelButton: false,
          confirmButtonText: 'OK',
        }).then(function() {
          resetFileInput();
          reloadDataTable();
        });
      } else {
        Swal.fire({
          title: res.title,
          text: res.message,
          icon: 'warning',
          showCancelButton: false,
          confirmButtonText: 'OK',
        });
      }
    },
    error: function (xhr,text,error) {
      console.log(xhr.responseText)
    }
  });
})
  $('#addedit').on('hidden.bs.modal', function () {
    $("#addProductForm")[0].reset();
    $('#img-src').attr('src', '/../img/insert_img.jpg')
    $("#file-1-preview div").html("<span>+</span>");
    $('#addeditTitle').text('Add Product')
    $('.updateProd1').replaceWith('<button type="button" class="btn btn-primary addProd">Add Product</button>');
  })
  $(document).on('click', '.setProd', function () {
    let prodid = $(this).data('prodid')
    let status = $(this).data('status')
    if (status === 'Available') {
      setProd(status, prodid)
    } else {
      setProd(status, prodid)
    }
  })
  $(document).on('click', '.delProd', function () {
    let prodid = $(this).data('prodid')
    showDeleteConfirmation(prodid)
  })
  // Reload the DataTable
  function reloadDataTable() {
    table.ajax.reload();
  }
function setProd(stat,prod) {
  $.ajax({
    type: "POST",
    url: url+"api/products.php",
    data: {status_prod: stat, prodid: prod},
    dataType: "json",
    success: function (res) {
      if (res.status === 'success') {
        reloadDataTable() 
        Toast.fire({
          icon: res.icon,
          title: res.message
      })
      } else {
        Swal.fire({
          title: res.title,
          text: res.message,
          icon: 'warning',
          showCancelButton: false,
          confirmButtonText: 'OK',
        });
      }
    },
    error: function (xhr, text, error) {
      console.log(xhr.responseText)
    }
  });
}
  
function showDeleteConfirmation(prodid) {
  let id = prodid
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
              type: "POST",
              url: url+"api/products.php",
              data: {delProd: id},
              dataType: "json",
              success: function (res) {
                Swal.fire(
                  'Deleted!',
                  'Product Deleted Successfully.',
                  'success'
              )
              reloadDataTable();
              },
              error: function (xhr,text,error) {
                console.log(xhr.responseText)
              }
            });
        }
    })
}
function previewBeforeUpload(id) {
    $("#" + id).on("change", function (e) {
        if (e.target.files.length == 0) {
            return;
        }
        let file = e.target.files[0];
        let url = URL.createObjectURL(file);
        $("#" + id + "-preview div").text(file.name);
        $("#" + id + "-preview img").attr("src", url);
    });
}
function resetFileInput() {
  const fileInput = document.getElementById('file-1');
  fileInput.value = ''; 
}
previewBeforeUpload("file-1");
