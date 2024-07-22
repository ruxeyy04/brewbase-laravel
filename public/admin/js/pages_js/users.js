$(document).on("click", ".notClickable", function (e) {
    e.preventDefault();
});
const Toast = Swal.mixin({
    toast: true,
    position: 'top-right',
    showConfirmButton: false,
    timer: 3000,
  })


var users = $('#dashboard-users').DataTable({
    ajax: {
        url: url + 'api/admin/getUserProfiles',
        dataSrc: 'data'
    },
    columns: [
        { data: '0' },
        { data: '1' },
        { data: '2' },
        { data: '3' },
        { data: '4' },
        { data: '5' },
        { data: '6' }
    ]
});

$(document).on("click", ".a-user", function () {
    let userid = $(this).data("userid");
    userInfo(userid);
});
  
  function userInfo(userid) {
    $.ajax({
      type: "POST",
      url: url + "api/admin/userprofile",
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
        $(".uName").text(user.username);
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
        $(".profEmail").text(user.email);
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

$(document).on('click', '.setRole', function () {
    var role = $(this).data('role');
    var userid = $(this).data('userid')
    $.ajax({
        type: "POST",
        url: url + "api/admin/setRole",
        data: {setRole: userid, role: role},
        dataType: "json",
        success: function (val) {
            Toast.fire({
                icon: 'success',
                title: val.message
            })
            reloadDataTable()
        }
    });
})


function reloadDataTable() {
    users.ajax.reload();
  }