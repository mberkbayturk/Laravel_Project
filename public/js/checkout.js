/*global $*/
$(function () {
    "use strict";

    function validateEmail($email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test($email);
    }

    var cleanError = (function(){
        $(".has_error").removeClass("has_error").css('border', 'solid 2px green');
        $(".error_message").remove();
    });
    
    var showError = (function(Element,Message){
        Element.after( "<p class=\"error_message text-danger\" style=\"padding:0px 20px 3px 0px;font-size:13px\" >"+Message+"</p>" );
        Element.focus();
        Element.addClass("has_error");
        Element.css('border', 'solid 2px red');
    });

    // $(".paypal_btn").click(function (e) {
    //     e.preventDefault();
    //     cleanError();
    //     var fName = $(".fName").val();
    //     var lName = $(".lName").val();
    //     var email = $(".email").val();
    //     var phone = $(".phone").val();
    //     var city = $(".city").val();
    //     var state = $(".state").val();
    //     var country = $(".country").val();
    //     var pincode = $(".pincode").val();
    //     var address1 = $(".address1").val();
    //     var address2 = $(".address2").val();

    //     if (!fName) {showError($(".fName"), "This field is mandatory");}
    //     else if (!lName) {showError($(".lName"), "This field is mandatory");}
    //     else if (!email) {showError($(".email"), "Email field is mandatory");}
    //     else if (!phone) {showError($(".phone"), "Phone field is mandatory");}
    //     else if (!city) {showError($(".city"), "City field is mandatory");}
    //     else if (!state) {showError($(".state"), "State field is mandatory");}
    //     else if (!country) {showError($(".country"), "Country field is mandatory");}
    //     else if (!pincode) {showError($(".pincode"), "Pincode field is mandatory");}
    //     else if (!address1) {showError($(".address1"), "Address 1 field is mandatory");}
    //     else if (!address2) {showError($(".address2"), "Address 2 field is mandatory");}
    //     else {
    //         var data = {
    //             'fName' : fName,
    //             'lName' : lName,
    //             'email' : email,
    //             'phone' : phone,
    //             'city' : city,
    //             'state' : state,
    //             'country' : country,
    //             'pincode' : pincode,
    //             'address1' : address1,
    //             'address2' : address2
    //         };
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    //         $.ajax({
    //             type: "POST",
    //             url: "/proceed_to_pay",
    //             data: data,
    //             success: function (response) {
    //                 alert(response.total_price);
    //             }
    //         });
    //     }
    // });
    
});