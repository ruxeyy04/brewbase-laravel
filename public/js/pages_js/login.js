$(document).ready(function () {
    if ($.cookie("user_id")) {
        window.location.href = "index.html";
    }
});

$(".password").hide();
$(".checkuser").click(function (e) {
    e.preventDefault();
    var user = $('input[name="username"]').val();

    // Show spinner and change button text
    $(".checkuser").html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
    );

    // Check if password field is visible
    if ($(".password").is(":visible")) {
        var password = $('input[name="password"]').val();
        var data = { check: user, password: password };
    } else {
        var data = { check: user };
    }

    // Send AJAX request
    $.ajax({
        url: url + "api/login",
        type: "POST",
        data: data,
        success: function (response) {
            if (response.status === "fail") {
                $('input[name="username"]')
                    .addClass("is-invalid")
                    .removeClass("is-valid");
                $(".checkuser").html("next");
                $(".password").slideUp();
            } else {
                $('input[name="username"]')
                    .removeClass("is-invalid")
                    .addClass("is-valid")
                    .prop("disabled", true);
                $(".password").slideDown();
                $(".checkuser").html("login");
            }

            // Check if response.status1 is defined and not null
            if (
                typeof response.status1 !== "undefined" &&
                response.status1 !== null
            ) {
                if (response.status1 === "failpass") {
                    $('input[name="password"]')
                        .addClass("is-invalid")
                        .removeClass("is-valid");
                } else {
                    $('input[name="password"]')
                        .removeClass("is-invalid")
                        .addClass("is-valid");
                    // Assuming response.token contains the bearer token value
                    $.cookie("user_id", response.userid, {
                        expires: 1,
                        path: '/',
                    });
                    $.cookie("bearer_token", response.token, {
                        expires: 1,
                        path: '/',
                    });
                    Swal.fire({
                        icon: "success",
                        title: "Logged In Successfully",
                        showConfirmButton: false,
                        timer: 2500,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: function () {
                            setTimeout(function () {
                                window.location.href = "/";
                            }, 2500);
                        },
                    });
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("AJAX request failed: " + textStatus, errorThrown);
        },
        complete: function () {
            // Code to execute when the AJAX request completes, regardless of success or failure
        },
    });
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
// ======================================
// Password Validation
$(".pass-spec").hide();
$(".pass1").focus(function () {
    $(".pass-spec").removeClass("d-none").addClass("d-flex").slideDown();
});
$(".pass2").keyup(function () {
    $(".pass-validation").removeClass("d-none");
    let checkpass = $(".pass-validation").find("p");
    if ($(".pass1").val() != $(".pass2").val()) {
        $(".pass2").removeClass("is-valid").addClass("is-invalid");
        checkpass.eq(0).removeClass("d-none");
        checkpass.eq(1).addClass("d-none");
    } else {
        $(".pass2").removeClass("is-invalid").addClass("is-valid");
        checkpass.eq(1).removeClass("d-none");
        checkpass.eq(0).addClass("d-none");
    }
});
// ===============================
// Checking all inputs are not empty
$(".register input").on("keyup", function () {
    var empty = false;
    $(".register input").each(function () {
        if (
            $(this).val() == "" ||
            $(".pass1").val() != $(".pass2").val() ||
            !$(".username").hasClass("is-valid") ||
            !$(".email").hasClass("is-valid")
        ) {
            empty = true;
        }
    });

    if (empty) {
        $(".signup").prop("disabled", true);
    } else {
        $(".signup").prop("disabled", false);
    }
});
// ===================================
// Toggle Password
$(".toggle-password").click(function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).prev("input"));
    if (input.attr("type") === "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
// ===================
$("input[name=user]").keyup(function () {
    var username = $(this).val();
    if (username === "") {
        $("input[name=user]").removeClass("is-valid").addClass("is-invalid");
        $(".uva").text("");
        $(".uin").text("Please enter a username.");
        return;
    }
    $.ajax({
        type: "POST",
        url: url + "api/checkUser",
        data: { checkuser: 1, user: username },
        success: function (data) {
            if (data.userstat === true) {
                $("input[name=user]")
                    .addClass("is-invalid")
                    .removeClass("is-valid");
                $(".uva").text("");
                $(".uin").text("The username is already used.");
            } else {
                $("input[name=user]")
                    .addClass("is-valid")
                    .removeClass("is-invalid");
                $(".uva").text("Username is available.");
                $(".uin").text("");
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        },
    });
});

$("input[name=email]").on("input", function () {
    var email = $(this).val();
    if (email === "") {
        $("input[name=email]").removeClass("is-valid").addClass("is-invalid");
        $(".eva").text(""); // Clear the valid feedback message
        $(".ein").text("Please enter an email."); // Update the invalid feedback message
        return;
    }
    if (!isValidEmail(email)) {
        $("input[name=email]").removeClass("is-valid").addClass("is-invalid");
        $(".eva").text(""); // Clear the valid feedback message
        $(".ein").text("Please enter a valid email."); // Update the invalid feedback message
        return;
    }
    $.ajax({
        type: "POST",
        url: url + "api/checkUser",
        data: { checkuser: 1, email: email },
        success: function (data) {
            if (data.userstat === true) {
                $("input[name=email]")
                    .addClass("is-invalid")
                    .removeClass("is-valid");
                $(".eva").text(""); // Clear the valid feedback message
                $(".ein").text("The email is already used.");
            } else {
                $("input[name=email]")
                    .addClass("is-valid")
                    .removeClass("is-invalid");
                $(".eva").text("Email is available.");
                $(".ein").text(""); // Clear the invalid feedback message
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        },
    });
});

function isValidEmail(email) {
    // Email validation regex pattern
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

// $('.register').submit(function (e) {
//     e.preventDefault();
//     var formData = new FormData(this);
//     $.ajax({
//         type: 'POST',
//         url: url+'api/registration.php',
//         data: formData,
//         dataType: 'json',
//         contentType: false,
//         processData: false,
//         success: function (data) {
//             if(data.status === 'success') {

//                 Swal.fire({
//                     title: 'Success!',
//                     text: 'User Registered Successfully',
//                     icon: 'success',
//                     showCancelButton: false,
//                     confirmButtonText: 'OK'
//                 }).then(function() {
//                     $('#reg')[0].reset();
//                     $('input[name=email]').removeClass('is-valid')
//                     $('input[name=user]').removeClass('is-valid')
//                     $('.pass1').removeClass('is-valid')
//                     $('.pass2').removeClass('is-valid')
//                     $('.pass-spec').addClass("d-none").removeClass("d-flex").slideUp();
//                     $('.pass-validation').addClass('d-none')
//                     $('.pass-spec').html(`<div class="col-sm-6 mb-4">
//                     <h5 class="text-center">Password must contain:</h5>
//                     <ul class="list-group">
//                         <!-- <i class="fa-solid fa-check"></i> -->
//                         <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
//                             least 8 characters</li>
//                         <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
//                             least 1 lower letter (a-z)
//                         </li>
//                         <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
//                             least 1 uppercase letter
//                             (A-Z)</li>
//                         <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
//                             least 1 number (0-9)</li>
//                         <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
//                             least 1 special characters
//                         </li>
//                     </ul>
//                 </div>`)
//                     $('.signup').prop('disabled', true);
//                     $('.pass2').prop('disabled', true);
//                     $('#registrationModal').modal('hide')
//                 });
//                 $(".swal2-confirm").removeClass("swal2-confirm swal2-styled").addClass("btn btn_primary");
//             }
//         },
//         error: function (xhr, status, error) {
//             console.log(xhr.responseText);
//         }
//     })
// })

$("#reg").submit(function (e) {
    e.preventDefault();

    // Get CSRF token value
    var csrf_token = $('meta[name="csrf-token"]').attr("content");

    $.ajax({
        type: "POST",
        url: "api/register", // Update the URL based on your route
        data: $("#reg").serialize(),
        headers: {
            "X-CSRF-TOKEN": csrf_token,
        },
        success: function (response) {
            Swal.fire({
                title: "Success!",
                text: "User Registered Successfully",
                icon: "success",
                showCancelButton: false,
                confirmButtonText: "OK",
            }).then(function () {
                $("#reg")[0].reset();
                $("input[name=email]").removeClass("is-valid");
                $("input[name=user]").removeClass("is-valid");
                $(".pass1").removeClass("is-valid");
                $(".pass2").removeClass("is-valid");
                $(".pass-spec")
                    .addClass("d-none")
                    .removeClass("d-flex")
                    .slideUp();
                $(".pass-validation").addClass("d-none");
                $(".pass-spec").html(`<div class="col-sm-6 mb-4">
                <h5 class="text-center">Password must contain:</h5>
                <ul class="list-group">
                    <!-- <i class="fa-solid fa-check"></i> -->
                    <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
                        least 8 characters</li>
                    <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
                        least 1 lower letter (a-z)
                    </li>
                    <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
                        least 1 uppercase letter
                        (A-Z)</li>
                    <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
                        least 1 number (0-9)</li>
                    <li class="list-group-item"><i class="fa-solid fa-minus mr-2"></i> At
                        least 1 special characters
                    </li>
                </ul>
            </div>`);
                $(".signup").prop("disabled", true);
                $(".pass2").prop("disabled", true);
                $("#registrationModal").modal("hide");
            });
            $(".swal2-confirm")
                .removeClass("swal2-confirm swal2-styled")
                .addClass("btn btn_primary");
        },
        error: function (error) {
            // Handle error if registration fails
            console.log(error);
        },
    });
});
