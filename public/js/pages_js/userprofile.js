setInterval(function () {
  if ($.cookie('user_id') == null) {
      location.replace('login.html')
  }
}, 1000)

// ===== jQuery ======
// deliveryaddress================
function displayDelAdd() {
  let deliveryData = ''
  $.ajax({
      type: "POST",
      url: url + 'api/delivery-address/get-addresses',
      data: {getAdd: 1, userid: userid},
      dataType: 'json',
      success: function (res) {
          $('#deladdcount').text(res.addressCount)
          if(res.addressCount === 5) {
            $('#btnAddressAdd').attr('disabled', true)
          } else {
            $('#btnAddressAdd').attr('disabled', false)
          }
          
          $.each(res.deliveryAdd, function (index, val) {
              let badge = val.status === 'Set' ? `<span class="badge badge-success mr-2">Default</span><span
              class="badge badge-secondary">Pickup Address</span>` : ''
               deliveryData += `<div class="p-3 bg-gradient-light rounded-lg">
              <div class="row">
                  <div class="col-lg-6">
                      <p><span class="fullname">${val.fullname}</span> | <span
                              class="phonenumber">${val.phone_number}</span></p>
                      <p class="address">${val.additionalinfo}, ${val.street}, ${val.barangay}, ${val.city}, ${val.province}, ${val.postalcode}, ${val.region}, ${val.country} </p>
                      ${badge}
                      <hr>
                  </div>
                  <div class="d-flex justify-content-end align-items-center col-lg-6">
                      <div
                          class="button-group btn-group-vertical d-inline-flex align-items-stretch">
                          <button type="button" class="btn1 btn-outline-warning m-1 editAddress" data-delid="${val.deladd_id}">Edit</button>
                          <button type="button" class="btn1 btn-outline-info m-1 setAsDefault" data-delid="${val.deladd_id}" ${val.status === 'Set' ? `disabled` : ''}>Set as
                              Default</button>
                              ${val.status !== 'Set' ? `<button type="button" class="btn1 btn-outline-danger m-1 deletebtnAdd"
                              data-toggle="modal" data-target="#deleteadd" data-delid="${val.deladd_id}">Delete</button>` : ''}
                          
                      </div>
                  </div>
              </div>
              <hr>
          </div>`;
         
          
          })
          
      },
      error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR.responseText)
      },
      complete: function () {
        $(document).ready(function () {
          $('#deliveryData').html(deliveryData)
        })
          let delAddData = $('#deliveryData').children().length
          if(delAddData === 0) {
              let noData = `<div class="row">
              <div class="col-lg-12">
               <h4 class=" d-flex justify-content-center">No Delivery Address</h4>
              </div>
           </div>`
           $('#deliveryData').html(noData)
          }
      }
  });
}
displayDelAdd();

$(document).on('click', '.update_add', function() {
  var delID = $(this).attr('data-delid')
  let formData = new FormData($("#delivery_add")[0]);
  formData.append('updateDelAdd', delID);
  formData.append('userid', userid)
  $.ajax({
    type: "POST",
    url: url + 'api/delivery-address/update-delivery-address',
    data: formData,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(res) {
      displayDelAdd();
      if (res.status == 'success') {
        $("#addnewaddress").modal('hide');
        
        // Show success message
        Swal.fire({
            title: res.message,
            text: 'Delivery Address updated successfully',
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn_secondary'
            }
        });
    } else if (res.status === 'errormax') {
        // Show error message for maximum address limit
        Swal.fire({
            title: res.message,
            text: 'Please remove some existing addresses to add a new one.',
            icon: 'warning',
            showCancelButton: false,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn_primary'
            }
        });
    } else {
        // Show error message for missing or empty required fields
        Swal.fire({
            title: res.message,
            text: 'Please fill in the required fields',
            icon: 'info',
            showCancelButton: false,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn_primary'
            }
        });
    }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseText);
    }
  });
});

$('#addnewaddress').on('hidden.bs.modal', function () {
  $('#addressmodaltitle').text('Add New Address')
  $('.deladdModalbuttons').html(`<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn_primary save_add">Save Address</button>`)
     // Clear the form data and reset select fields
     $("#delivery_add")[0].reset();
     $("#province1").val('').prop('disabled', true);
     $("#city1").val('').prop('disabled', true);
     $("#barangay1").val('').prop('disabled', true);
     $('#postal').removeClass('is-valid')
     $('#province1').append('<option value="1">Select Province</option>').val(1)
     $('#city1').append('<option value="1">Select City</option>').val(1)
     $('#barangay1').append('<option value="1">Select Barangay</option>').val(1)
});
$(document).on('click', '.deletebtnAdd', function () {
  let delID = $(this).attr('data-delid')
  $('.deleteDelAdd').attr('data-delid', delID)
})
$(document).on('click', '.deleteDelAdd', function () {
  let delID = $(this).attr('data-delid')
  $.ajax({
    type: "POST",
    url: url + "api/delivery-address/delete-delivery-address",
    data: {deleteDelAdd: delID, userid: userid},
    success: function (res) {
      $(".userprofile_row").isotope('reloadItems').isotope();
      $('#deleteadd').modal('hide')
      Swal.fire({
        title: 'Delivery Address Deleted',
        text: 'Delivery Address Deleted successfully',
        icon: 'info',
        showCancelButton: false,
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'btn btn_secondary'
        }
    });
    displayDelAdd();
    }
  });
})
// END deladd ====================
// change password ====================
$('#updatePassword').on('click', function () {
  let oldpass = $('.oldpass').val()
  let newpass = $('.pass2').val()
  $.ajax({
    type: "POST",
    url: url + "api/userprofile/change-password",
    data: {changepass: oldpass, newpass: newpass, userid: userid},
    success: function (res) {
      if (res.status === 'success') {
        Swal.fire({
          title: 'Success!',
          text: res.message,
          icon: 'success',
          showCancelButton: false,
          confirmButtonText: 'OK',
          customClass: {
              confirmButton: 'btn btn_secondary'
          }
      }).then(function () {
        $(".pass2").removeClass("is-valid").attr('disabled', true);
        $(".pass1").removeClass("is-valid");
        $('.oldpass, .pass1, .pass2').val('')
        $('#updatePassword').attr('disabled', true)
        $('.pass-spec').html(`<h5>New password must contain:</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i>
                At
                least 8 characters</li>
            <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i>
                At
                least 1 lower letter (a-z)
            </li>
            <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i>
                At
                least 1 uppercase letter
                (A-Z)</li>
            <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i>
                At
                least 1 number (0-9)</li>
            <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i>
                At
                least 1 special characters
            </li>
        </ul>`)
      });
      }else if (res.status === 'error') {
        Swal.fire({
          title: 'Error',
          text: res.message,
          icon: 'error',
          showCancelButton: false,
          confirmButtonText: 'OK',
          customClass: {
              confirmButton: 'btn btn_secondary'
          }
      });
      } else {
        Swal.fire({
          title: 'Incorrect Password',
          text: res.message,
          icon: 'info',
          showCancelButton: false,
          confirmButtonText: 'OK',
          customClass: {
              confirmButton: 'btn btn_secondary'
          }
      });
      }
    },
    error: function (xhr, textStatus, errorThrown) {
      console.log(xhr.responseText)
    }
  });
})
// END changepassword =================

// ===================

var $grid = $(".userprofile_row").isotope({
  itemSelector: ".element_userprofile",
  layoutMode: "fitRows",
  filter: ".profile",
});

$(".userprofile").on("click", "button", function () {
  var filterValue = $(this).attr("data-filter");

  $grid.isotope({ filter: filterValue });
});

$(".userprofile").each(function (i, buttonGroup) {
  var $buttonGroup = $(buttonGroup);

  $buttonGroup.on("click", "button", function () {
    $buttonGroup.find(".active").removeClass("active");
    $(this).addClass("active");
  });
});

//   $('.toast').toast('show')
// =============
$(window).on("load resize", function () {
  if ($(this).width() < 576 || $(this).width() < 991) {
    // Replace 576 with your desired screen size
    $(".button-group").addClass("btn-group");
    $(".button-group").removeClass("btn-group-vertical");
  } else {
    $(".button-group").removeClass("btn-group");
    $(".button-group").addClass("btn-group-vertical");
  }
});

// Password Specification
$(".pass1").keyup(function () {
  let pass = $(this).val();
  let passSpec = $(".pass-spec");
  let listItems = passSpec.find("li");

  let lengthCheck = pass.length >= 8;
  let lowerCheck = /[a-z]/.test(pass);
  let upperCheck = /[A-Z]/.test(pass);
  let numberCheck = /[0-9]/.test(pass);
  let specialCheck = /[$@$!%*?&]/.test(pass);

  listItems
    .eq(0)
    .toggleClass("text-success", lengthCheck)
    .toggleClass("text-danger", !lengthCheck);
  listItems
    .eq(1)
    .toggleClass("text-success", lowerCheck)
    .toggleClass("text-danger", !lowerCheck);
  listItems
    .eq(2)
    .toggleClass("text-success", upperCheck)
    .toggleClass("text-danger", !upperCheck);
  listItems
    .eq(3)
    .toggleClass("text-success", numberCheck)
    .toggleClass("text-danger", !numberCheck);
  listItems
    .eq(4)
    .toggleClass("text-success", specialCheck)
    .toggleClass("text-danger", !specialCheck);

  let allChecks =
    lengthCheck && lowerCheck && upperCheck && numberCheck && specialCheck;
  let feedback = passSpec.find(".invalid-feedback, .valid-feedback");

  feedback
    .toggleClass("text-success", allChecks)
    .toggleClass("text-danger", !allChecks);
  feedback.toggleClass("d-none", pass.length > 0);

  passSpec
    .find(".fa-minus,.fa-check, .fa-xmark")
    .removeClass("fa-check text-success")
    .addClass("fa-xmark");
  passSpec
    .find(".fa-minus,.fa-xmark")
    .eq(0)
    .toggleClass("fa-check text-success", lengthCheck);
  passSpec
    .find(".fa-minus,.fa-xmark")
    .eq(1)
    .toggleClass("fa-check text-success", lowerCheck);
  passSpec
    .find(".fa-minus,.fa-xmark")
    .eq(2)
    .toggleClass("fa-check text-success", upperCheck);
  passSpec
    .find(".fa-minus,.fa-xmark")
    .eq(3)
    .toggleClass("fa-check text-success", numberCheck);
  passSpec
    .find(".fa-minus,.fa-xmark")
    .eq(4)
    .toggleClass("fa-check text-success", specialCheck);

  if (allChecks) {
    $(".pass1").removeClass("is-invalid").addClass("is-valid");
    $(".pass2").prop("disabled", false);
  } else {
    $(".pass1").removeClass("is-valid").addClass("is-invalid");
    $(".pass2").prop("disabled", true);
  }
});
$('.pass2').keyup(function() {
  let pass1 = $('.pass1').val()
  let pass2 = $(this).val()
  if(pass1 === pass2) {
    $(".pass2").removeClass("is-invalid").addClass("is-valid");
    $('#updatePassword').attr('disabled', false)
  } else {
    $(".pass2").removeClass("is-valid").addClass("is-invalid");
    $('#updatePassword').attr('disabled', true)
  }
})
$("#uplfile").on("change", function (e) {
  var reader = new FileReader();

  reader.onload = function (event) {
    $(".user-upload img").attr("src", event.target.result);
  };
  reader.readAsDataURL(e.target.files[0]);
});
$(document).ready(function () {
  document.getElementById("country-select").addEventListener("mousedown", function(event) {
    event.preventDefault();
    this.blur();
    return false;
  });
  const $select = $("#country-select");
$.getJSON(
  "https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-name.json",
  function (countries) {
    Object.keys(countries).forEach(function (key) {
      const $option = $("<option/>", {
        value: countries[key].country,
        text: countries[key].country,
      });
      if (countries[key].country === "Philippines") {
        $option.prop("selected", true);
      }
      $select.append($option);
    });
  }
);
})
// =================================
// get reference to the select elements
const $regionSelect = $("#region-select");
const $provinceSelect = $("#province");
const $citySelect = $("#city");
const $barangaySelect = $("#barangay");

$.getJSON("json/philippinesprovinces.json", function (data) {
  const sortedData = Object.entries(data).sort((a, b) => a[0] - b[0]);

  for (const [key, value] of sortedData) {
    const $option = $("<option/>", {
      value: value.region_name.replace(
        /(region)/i,
        (match) => match.charAt(0).toUpperCase() + match.slice(1).toLowerCase()
      ),
      text: value.region_name.replace(
        /(region)/i,
        (match) => match.charAt(0).toUpperCase() + match.slice(1).toLowerCase()
      ),
    });
    $regionSelect.append($option);
  }
  $('.updateMyAccount').on('click', function () {
    let username = $('input[name="username"]').val()
    let email = $('input[name="email"]').val()
    let updateMyAccount = {updateAcc: 1, user: username, mail: email, userid: userid};
    $.ajax({
      type: "POST",
      url: url + "api/userprofile/update-account",
      data: updateMyAccount,
      success: function (res) {
        if (res.status == 'success') {
          Swal.fire({
            title: 'Success!',
            text: res.message,
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn_secondary'
            }
        })
        }else {
          Swal.fire({
            title: 'No Changes!',
            text: res.message,
            icon: 'info',
            showCancelButton: false,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn_secondary'
            }
        })
        }
        userInfo();
      },
      error: function (xhr, textStatus, errorThrown) {
        console.log(xhr.responseText)
      }
    });
  })
  $(document).on('click', '.setAsDefault', function () {
    let delID = $(this).attr('data-delid')
    $.ajax({
      type: "POST",
      url: url +"api/delivery-address/set-as-default",
      data: {setAsDefault: delID, userid: userid},
      success: function (res) {
        displayDelAdd();
        userInfo()
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText)
      }
    });
  
  })
  function userInfo() {
    
    $.ajax({
      type: "POST",
      url: url + "api/userprofile/get-info",
      data: { getUserInfo: 1, userid: userid },
      success: function (res) {
        let user = res.userinfo[0];
        let delAdd;

        if (res.defaultDeliveryAddress?.length > 0) {
          delAdd = res.defaultDeliveryAddress[0];

          $('.defaultDeliveryAddress').show()
          $('.defStreet').text(delAdd.street)
          $('.defBarangay').text(delAdd.barangay)
          $('.defCity').text(delAdd.city)
          $('.defProvince').text(delAdd.province+'/'+delAdd.region)
          $('.defCode').text(delAdd.postalcode)
          $('.defFullname').text(delAdd.fullname+' | '+delAdd.phone_number)
          $('.defAddInfo').text(delAdd.additionalinfo)
        } else {
          $('.defaultDeliveryAddress').hide()
        }
       

        let profileimg = user.profile_img !== null ? 'profileimg/'+user.profile_img : 'profileimg/default-pic.png';
        let celNo = user.contact_no !== null ? user.contact_no : '(Not Set)';
        let telNo = user.tel_no !== '' && user.tel_no !== null ? `/${user.tel_no}` : '';
        $('input[name="username"]').val(user.username);
        $('input[name="email"]').val(user.email);
        $('input[name="fname"]').val(user.fname);
        $('input[name="lname"]').val(user.lname);
        $('input[name="midname"]').val(user.midname);
        $('input[name="birthdate"]').val(user.birthdate)
        $('select[name="gender"]').val(user.gender)
        $('input[name="suffix"]').val(user.suffix);
        $('#country-select').val(user.country);
        $('input[name="zipcode"]').val(user.postalcode);
        $('#streetName').val(user.street);
        $('input[name="phonenum"]').val(user.contact_no);
        $('input[name="telnum"]').val(user.tel_no);

        var totalInvested = user.total_invested
        var formattedTotalInvested = totalInvested.toLocaleString('en-US').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $('.totalPaid').text('₱' + formattedTotalInvested)
        $('.totalOrders').text(user.orders_count)
        $('.totalWishlist').text(user.wishlist_count)
        $('.profileImg').attr('src', profileimg);
        $('.fullName').text(`${user.fname}${user.midname ? ` ${user.midname} ` : ' '}${user.lname}`)
        $('.uName').text(user.username)
        $('.uzCode').text(user.postalcode)
        $('.uCountry').text(user.country)

        if (user.region || user.province || user.city || user.barangay) {
          $('.uStreet').text(user.street)
          $('.uBarangay').text(user.barangay)
          $('.uCity').text(user.city)
          $('.uProvince').text(user.province+'/'+user.region)
          $regionSelect.val(user.region);
          provinceEdit(user.region, user.province)
          cityEdit(user.region, user.province, user.city)
          barangayEdit(user.region, user.province, user.city, user.barangay)
        } else {
          $('.uStreet').text('(Not Set)')
          $('.uBarangay').text('(Not Set)')
          $('.uCity').text('(Not Set)')
          $('.uProvince').text('(Not Set)')
        }
  
        $('.user-image').attr('src', profileimg);
        $('.profEmail').text(user.email);
        $('.profPhoneNo').html(celNo+telNo);
        $('.profCountry').text(user.country);
        $('.profileFullName').text(user.fname + ' ' + user.lname.charAt(0)+'.')
      },
      error: function (xhr, textStatus, errorThrown) {
        console.log(xhr.responseText);
      },
    });
  }
function resetFileInput() {
    const fileInput = document.getElementById('uplfile');
    fileInput.value = ''; 
}
$(document).on('click','.save_add', function() {
  let formData = new FormData($("#delivery_add")[0]);
  formData.append('addDelAdd', 1);
  formData.append('userid', userid)
  $.ajax({
      type: "POST",
      url: url+'api/delivery-address/add-delivery-address',
      data: formData,
      dataType: 'json',
      contentType: false,
      processData: false,
      success: function (res) {
          if (res.status == 'success') {
              $("#addnewaddress").modal('hide');
              
              // Show success message
              Swal.fire({
                  title: 'Success!',
                  text: 'Delivery Address added successfully',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonText: 'OK',
                  customClass: {
                      confirmButton: 'btn btn_secondary'
                  }
              });
              userInfo();
              displayDelAdd();
          } else if (res.status === 'errormax') {
              // Show error message for maximum address limit
              Swal.fire({
                  title: res.message,
                  text: 'Please remove some existing addresses to add a new one.',
                  icon: 'warning',
                  showCancelButton: false,
                  confirmButtonText: 'OK',
                  customClass: {
                      confirmButton: 'btn btn_primary'
                  }
              });
          } else {
              // Show error message for missing or empty required fields
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
          }
          $(".userprofile_row").isotope('reloadItems').isotope();
      },
      error: function (jqXHR, textStatus, errorThrown) {
          console.log(jqXHR.responseText)
      }
  });
});
  userInfo();
  $("#updateProfile").on("click", function () {
    var formData = new FormData($("#profileInfoField")[0]);
    formData.append('updateProfile', 1)
    formData.append('userid', userid)
    $.ajax({
      type: "POST",
      url: url + "api/userprofile/update-profile",
      data: formData,
      contentType: false,
      processData: false,
      success: function (res) {
        let status = res.status;
        if (status === 'success') {
          profileName()
          Swal.fire({
            title: 'Success',
            text: res.message,
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn_primary'
            }
        });
        } else if (status === 'nochanges') {
          Swal.fire({
            title: 'No Changes',
            text: res.message,
            icon: 'info',
            showCancelButton: false,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn_primary'
            }
        });
        } else {
          Swal.fire({
            title: 'Missing Required Fields',
            text: res.message,
            icon: 'warning',
            showCancelButton: false,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn_primary'
            }
        });
        }
        userInfo();
        resetFileInput()
      },
      error: function (xhr, textStatus, errorThrown) {
        console.log(xhr.responseText)
      }
    });
    
  });
  function provinceEdit(region, province) {
    $provinceSelect.empty();
    $citySelect.empty();
    $barangaySelect.empty();
    if (region != "") {
      $citySelect.prop("disabled", true);
      const option2 = `<option value="">Select City</option>`;
      $citySelect.append(option2);
      $barangaySelect.prop("disabled", true);
      const option3 = `<option value="">Select Barangay</option>`;
      $barangaySelect.append(option3);
      $provinceSelect.prop("disabled", false);
      const selectedRegion = region.toUpperCase();

      for (const [key, value] of sortedData) {
        if (selectedRegion === value.region_name) {
          $.each(value.province_list, function (provinceName) {
            const $option = $("<option/>", {
              value: toTitleCase(provinceName),
              text: toTitleCase(provinceName),
            });
            $provinceSelect.append($option);
          });
        }
      }
      $provinceSelect.val(province)
    } else {
      $provinceSelect.prop("disabled", true);
      const option1 = `<option value="">Select Province</option>`;
      $provinceSelect.append(option1);
      $citySelect.prop("disabled", true);
      const option2 = `<option value="">Select City</option>`;
      $citySelect.append(option2);
      $barangaySelect.prop("disabled", true);
      const option3 = `<option value="">Select Barangay</option>`;
      $barangaySelect.append(option3);
    }
  }
  function cityEdit(region, province, city) {
    $barangaySelect.empty();
    $barangaySelect.prop("disabled", true);
    const option2 = `<option value="">Select Barangay</option>`;
    $barangaySelect.append(option2);
    if (region != "" || province != "") {
      $citySelect.prop("disabled", false);
      $citySelect.empty();
      const selectedProvince = province.toUpperCase();
      for (const [key, value] of sortedData) {
        if (value.province_list[selectedProvince]) {
          $.each(
            value.province_list[selectedProvince].municipality_list,
            function (municipalList) {
              const $option = $("<option/>", {
                value: toTitleCase(municipalList),
                text: toTitleCase(municipalList),
              });
              $citySelect.append($option);
            }
          );
        }
      }
      $citySelect.val(city)
    } else {
      $citySelect.prop("disabled", true);
      const option1 = `<option value="">Select City</option>`;
      $citySelect.append(option1);
    }
  }
  function barangayEdit(region, province, city, barangay) {
    if (
      region != "" ||
      province != "" ||
      city != ""
    ) {
      $barangaySelect.prop("disabled", false);
      $barangaySelect.empty();
      const selectedProvince = province.toUpperCase();
      const selectedCity = city.toUpperCase();
      for (const [key, value] of sortedData) {
        if (value.province_list[selectedProvince]) {
          $.each(
            value.province_list[selectedProvince].municipality_list,
            function (municipalList, data) {
              if (municipalList === selectedCity) {
                $.each(data.barangay_list, function (data, barangay) {
                  const $option = $("<option/>", {
                    value: toTitleCase(barangay),
                    text: toTitleCase(barangay),
                  });
                  $barangaySelect.append($option);
                });
              }
            }
          );
        }
      }
      $barangaySelect.val(barangay)
    }
  }
  $regionSelect.change(() => {
    $provinceSelect.empty();
    $citySelect.empty();
    $barangaySelect.empty();
    if ($regionSelect.val() != "") {
      $citySelect.prop("disabled", true);
      const option2 = `<option value="">Select City</option>`;
      $citySelect.append(option2);
      $barangaySelect.prop("disabled", true);
      const option3 = `<option value="">Select Barangay</option>`;
      $barangaySelect.append(option3);
      $provinceSelect.prop("disabled", false);
      const selectedRegion = $regionSelect.val().toUpperCase();

      for (const [key, value] of sortedData) {
        if (selectedRegion === value.region_name) {
          $.each(value.province_list, function (provinceName) {
            const $option = $("<option/>", {
              value: toTitleCase(provinceName),
              text: toTitleCase(provinceName),
            });
            $provinceSelect.append($option);
          });
        }
      }
    } else {
      $provinceSelect.prop("disabled", true);
      const option1 = `<option value="">Select Province</option>`;
      $provinceSelect.append(option1);
      $citySelect.prop("disabled", true);
      const option2 = `<option value="">Select City</option>`;
      $citySelect.append(option2);
      $barangaySelect.prop("disabled", true);
      const option3 = `<option value="">Select Barangay</option>`;
      $barangaySelect.append(option3);
    }
  });
  $provinceSelect.change(() => {
    $barangaySelect.empty();
    $barangaySelect.prop("disabled", true);
    const option2 = `<option value="">Select Barangay</option>`;
    $barangaySelect.append(option2);
    if ($regionSelect.val() != "" || $provinceSelect.val() != "") {
      $citySelect.prop("disabled", false);
      $citySelect.empty();
      const selectedProvince = $provinceSelect.val().toUpperCase();
      for (const [key, value] of sortedData) {
        if (value.province_list[selectedProvince]) {
          $.each(
            value.province_list[selectedProvince].municipality_list,
            function (municipalList) {
              const $option = $("<option/>", {
                value: toTitleCase(municipalList),
                text: toTitleCase(municipalList),
              });
              $citySelect.append($option);
            }
          );
        }
      }
    } else {
      $citySelect.prop("disabled", true);
      const option1 = `<option value="">Select City</option>`;
      $citySelect.append(option1);
    }
  });
  $citySelect.change(() => {
    if (
      $regionSelect.val() != "" ||
      $provinceSelect.val() != "" ||
      $citySelect.val() != ""
    ) {
      $barangaySelect.prop("disabled", false);
      $barangaySelect.empty();
      const selectedProvince = $provinceSelect.val().toUpperCase();
      const selectedCity = $citySelect.val().toUpperCase();
      for (const [key, value] of sortedData) {
        if (value.province_list[selectedProvince]) {
          $.each(
            value.province_list[selectedProvince].municipality_list,
            function (municipalList, data) {
              if (municipalList === selectedCity) {
                $.each(data.barangay_list, function (data, barangay) {
                  const $option = $("<option/>", {
                    value: toTitleCase(barangay),
                    text: toTitleCase(barangay),
                  });
                  $barangaySelect.append($option);
                });
              }
            }
          );
        }
      }
    }
  });
});
function toTitleCase(str) {
  return str
    .toLowerCase()
    .split(" ")
    .map(function (word) {
      return word.replace(word[0], word[0].toUpperCase());
    })
    .join(" ");
}
// =============================
$('input[name="zipcode"]').on("keyup", function () {
  const zipcodeRegex = /^\d{4}$/;
  const zipcode = $(this).val();

  if (zipcodeRegex.test(zipcode)) {
    // Valid zip code
    $(this).removeClass("is-invalid").addClass("is-valid");
  } else {
    // Invalid zip code
    $(this).removeClass("is-valid").addClass("is-invalid");
  }
});
// =========================================================================================
// =========================================================================================
// get reference to the select elements
const $regionSelect1 = $("#region-select1");
const $provinceSelect1 = $("#province1");
const $citySelect1 = $("#city1");
const $barangaySelect1 = $("#barangay1");

// fetch data from the API
$.getJSON("json/philippinesprovinces.json", function (data) {
// =========================
  $(document).on('click', '.editAddress', function () {
    let delID = $(this).attr('data-delid')
    $('#addressmodaltitle').text('Edit Delivery Address')
    $('.deladdModalbuttons').html(`<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn_primary update_add" data-delid="">Update Address</button>`)
    $.ajax({
      type: "POST",
      url: url + 'api/delivery-address/get-address-for-edit',
      data: {addressEdit: delID, userid: userid},
      success: function (res) {
        let delAdd = res.deliveryAdd[0]
        $('#addnewaddress').modal();
        
        $('.update_add').attr('data-delid', delID)
        $('#fullname1').val(delAdd.fullname)
        $('#contactnumber1').val(delAdd.phone_number)
        
        $('#postal').val(delAdd.postalcode)
        $('#street1').val(delAdd.street)
        $('#add_info').val(delAdd.additionalinfo)

        $regionSelect1.val(delAdd.region);
        provinceEdit(delAdd.region, delAdd.province)
       cityEdit(delAdd.region, delAdd.province, delAdd.city)
       barangayEdit(delAdd.region, delAdd.province, delAdd.city, delAdd.barangay)
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.textStatus)
      }
    });
  })
// ==========================
  const sortedData = Object.entries(data).sort((a, b) => a[0] - b[0]);

  for (const [key, value] of sortedData) {
    const $option = $("<option/>", {
      value: value.region_name.replace(
        /(region)/i,
        (match) => match.charAt(0).toUpperCase() + match.slice(1).toLowerCase()
      ),
      text: value.region_name.replace(
        /(region)/i,
        (match) => match.charAt(0).toUpperCase() + match.slice(1).toLowerCase()
      ),
    });
    $regionSelect1.append($option);
  }

  // Set default values on window loa
  function provinceEdit(region, province) {
    $provinceSelect1.empty();
    $citySelect1.empty();
    $barangaySelect1.empty();
    if (region != "") {
      $citySelect1.prop("disabled", true);
      const option2 = `<option value="">Select City</option>`;
      $citySelect1.append(option2);
      $barangaySelect1.prop("disabled", true);
      const option3 = `<option value="">Select Barangay</option>`;
      $barangaySelect1.append(option3);
      $provinceSelect1.prop("disabled", false);
      const selectedRegion = region.toUpperCase();

      for (const [key, value] of sortedData) {
        if (selectedRegion === value.region_name) {
          $.each(value.province_list, function (provinceName) {
            const $option = $("<option/>", {
              value: toTitleCase(provinceName),
              text: toTitleCase(provinceName),
            });
            $provinceSelect1.append($option);
          });
        }
      }
      $provinceSelect1.val(province)
    } else {
      $provinceSelect1.prop("disabled", true);
      const option1 = `<option value="">Select Province</option>`;
      $provinceSelect1.append(option1);
      $citySelect1.prop("disabled", true);
      const option2 = `<option value="">Select City</option>`;
      $citySelect1.append(option2);
      $barangaySelect1.prop("disabled", true);
      const option3 = `<option value="">Select Barangay</option>`;
      $barangaySelect1.append(option3);
    }
  }
  function cityEdit(region, province, city) {
    $barangaySelect1.empty();
    $barangaySelect1.prop("disabled", true);
    const option2 = `<option value="">Select Barangay</option>`;
    $barangaySelect1.append(option2);
    if (region != "" || province != "") {
      $citySelect1.prop("disabled", false);
      $citySelect1.empty();
      const selectedProvince = province.toUpperCase();
      for (const [key, value] of sortedData) {
        if (value.province_list[selectedProvince]) {
          $.each(
            value.province_list[selectedProvince].municipality_list,
            function (municipalList) {
              const $option = $("<option/>", {
                value: toTitleCase(municipalList),
                text: toTitleCase(municipalList),
              });
              $citySelect1.append($option);
            }
          );
        }
      }
      $citySelect1.val(city)
    } else {
      $citySelect1.prop("disabled", true);
      const option1 = `<option value="">Select City</option>`;
      $citySelect1.append(option1);
    }
  }
  function barangayEdit(region, province, city, barangay) {
    if (
      region != "" ||
      province != "" ||
      city != ""
    ) {
      $barangaySelect1.prop("disabled", false);
      $barangaySelect1.empty();
      const selectedProvince = province.toUpperCase();
      const selectedCity = city.toUpperCase();
      for (const [key, value] of sortedData) {
        if (value.province_list[selectedProvince]) {
          $.each(
            value.province_list[selectedProvince].municipality_list,
            function (municipalList, data) {
              if (municipalList === selectedCity) {
                $.each(data.barangay_list, function (data, barangay) {
                  const $option = $("<option/>", {
                    value: toTitleCase(barangay),
                    text: toTitleCase(barangay),
                  });
                  $barangaySelect1.append($option);
                });
              }
            }
          );
        }
      }
      $barangaySelect1.val(barangay)
    }
  }
  $regionSelect1.change(() => {
    $provinceSelect1.empty();
    $citySelect1.empty();
    $barangaySelect1.empty();
    if ($regionSelect1.val() != "") {
      $citySelect1.prop("disabled", true);
      const option2 = `<option value="">Select City</option>`;
      $citySelect1.append(option2);
      $barangaySelect1.prop("disabled", true);
      const option3 = `<option value="">Select Barangay</option>`;
      $barangaySelect1.append(option3);
      $provinceSelect1.prop("disabled", false);
      const selectedRegion = $regionSelect1.val().toUpperCase();

      for (const [key, value] of sortedData) {
        if (selectedRegion === value.region_name) {
          $.each(value.province_list, function (provinceName) {
            const $option = $("<option/>", {
              value: toTitleCase(provinceName),
              text: toTitleCase(provinceName),
            });
            $provinceSelect1.append($option);
          });
        }
      }
    } else {
      $provinceSelect1.prop("disabled", true);
      const option1 = `<option value="">Select Province</option>`;
      $provinceSelect1.append(option1);
      $citySelect1.prop("disabled", true);
      const option2 = `<option value="">Select City</option>`;
      $citySelect1.append(option2);
      $barangaySelect1.prop("disabled", true);
      const option3 = `<option value="">Select Barangay</option>`;
      $barangaySelect1.append(option3);
    }
  });
  $provinceSelect1.change(() => {
    $barangaySelect1.empty();
    $barangaySelect1.prop("disabled", true);
    const option2 = `<option value="">Select Barangay</option>`;
    $barangaySelect1.append(option2);
    if ($regionSelect1.val() != "" || $provinceSelect1.val() != "") {
      $citySelect1.prop("disabled", false);
      $citySelect1.empty();
      const selectedProvince = $provinceSelect1.val().toUpperCase();
      for (const [key, value] of sortedData) {
        if (value.province_list[selectedProvince]) {
          $.each(
            value.province_list[selectedProvince].municipality_list,
            function (municipalList) {
              const $option = $("<option/>", {
                value: toTitleCase(municipalList),
                text: toTitleCase(municipalList),
              });
              $citySelect1.append($option);
            }
          );
        }
      }
    } else {
      $citySelect1.prop("disabled", true);
      const option1 = `<option value="">Select City</option>`;
      $citySelect1.append(option1);
    }
  });
  $citySelect1.change(() => {
    if (
      $regionSelect1.val() != "" ||
      $provinceSelect1.val() != "" ||
      $citySelect1.val() != ""
    ) {
      $barangaySelect1.prop("disabled", false);
      $barangaySelect1.empty();
      const selectedProvince = $provinceSelect1.val().toUpperCase();
      const selectedCity = $citySelect1.val().toUpperCase();
      for (const [key, value] of sortedData) {
        if (value.province_list[selectedProvince]) {
          $.each(
            value.province_list[selectedProvince].municipality_list,
            function (municipalList, data) {
              if (municipalList === selectedCity) {
                $.each(data.barangay_list, function (data, barangay) {
                  const $option = $("<option/>", {
                    value: toTitleCase(barangay),
                    text: toTitleCase(barangay),
                  });
                  $barangaySelect1.append($option);
                });
              }
            }
          );
        }
      }
    }
  });
});
function toTitleCase(str) {
  return str
    .toLowerCase()
    .split(" ")
    .map(function (word) {
      return word.replace(word[0], word[0].toUpperCase());
    })
    .join(" ");
}
// =============================
$("#postal").on("keyup", function () {
  const zipcodeRegex = /^\d{4}$/;
  const zipcode = $(this).val();

  if (zipcodeRegex.test(zipcode)) {
    // Valid zip code
    $(this).removeClass("is-invalid").addClass("is-valid");
  } else {
    // Invalid zip code
    $(this).removeClass("is-valid").addClass("is-invalid");
  }
});
