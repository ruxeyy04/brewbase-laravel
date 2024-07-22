
setInterval(function () {
    if ($.cookie('user_id') == null) {
        location.replace('/login')
    }
  }, 1000)
function urlLink() {
    let urlLink = "http://127.0.0.1:8000/"
    return urlLink
  }
  let url = urlLink()
  var userid = ''
  if ($.cookie('user_id')) {
    userid = $.cookie('user_id')
  }

    $(window).on('resize', function () {
        if ($(window).width() <= 768) {
            $('#sidebar, #body').addClass('active');
        }
    });
    if ($(window).width() <= 768) {
        $('#sidebar, #body').addClass('active');
    }

    var redirectPerformed = false;

    function roleType() {
        if (redirectPerformed) {
            return; // Exit the function if redirect has already been performed
        }
    
        $.ajax({
            url: url + "api/userinfo",
            method: "POST",
            data: {userid: userid},
            dataType: "json",
            success: function(data) {
              let user = data.userinfo[0];
              if (user.usertype === 'Admin') {
                if (!window.location.pathname.includes('/brewbase-staff/admin')) {
                  location.replace('/brewbase-staff/admin');
                  redirectPerformed = true;
                }
              } else if (user.usertype === 'In-Charge') {
                if (!window.location.pathname.includes('/brewbase-staff/incharge')) {
                  location.replace('/brewbase-staff/incharge');
                  redirectPerformed = true;
                }
              } else {
                if (window.location.pathname !== '/') {
                  location.replace('/');
                  redirectPerformed = true;
                }
              }
              $('#fullname').text(user.fname + ' ' + user.lname);
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            },
            complete: function () {
                $("#preloader").fadeOut("slow", function() {
                    $(this).remove();
                  });
            }
          })
          
        
    }
    
   
        roleType();
   
    
    $(document).on("click", ".logout", function () {
        $.removeCookie("user_id", { path: '/' });
        window.location.href = "/";
    })

        // $.get("http://geolocation-db.com/json/", function (data) {
        //   var location = data.city + ", " + data.state;
        //   $.ajax({
        //     url: "http://localhost/api/login.php",
        //     type: "POST",
        //     dataType: "json",
        //     data: {
        //       logout: 1,
        //       ip: data.IPv4,
        //       location: location,
        //       user_id: $.cookie("user_id"),
        //     },
        //     success: function (data) {
                
        //     },
        //     error: function (jqXHR, textStatus, errorThrown) {
        //       console.log(jqXHR.responseText);
        //       console.log("AJAX request failed: " + textStatus, errorThrown);
        //     },
        //     complete: function () {
                
        //     },
        //   });
        // }, "json");
 