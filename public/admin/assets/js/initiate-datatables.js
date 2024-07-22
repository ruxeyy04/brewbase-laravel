// Initiate datatables in roles, tables, users page
(function () {
  "use strict";
  $("#dataTables-example").DataTable({
    responsive: true,
    // pageLength: 20,
    // lengthChange: true,
    searching: true,
    ordering: true,
  });
  $("#dashboard-users").DataTable({
    responsive: true,
    searching: true,
    ordering: true,
  });


  // $('#addProductForm').submit(function(event) {
  //     event.preventDefault();
  //     var formData = $(this).serialize();
  //     $.ajax({
  //         url: 'api/products.php',
  //         type: 'POST',
  //         data: formData,
  //         success: function(response) {
  //             table.ajax.reload();
  //             $('#addProductModal').modal('hide');
  //         },
  //         error: function(xhr, status, error) {
  //             console.log(xhr.responseText);
  //         }
  //     });
  // });
})();
