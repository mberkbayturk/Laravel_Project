/*global $*/
$(function () {
    "use strict";
    loadCart();
    loadWishlist();

    $(window).scroll(function () {
      if ($(window).scrollTop() >= 200) {
        $('.scrollUp').fadeIn(500);
      } else {
        $('.scrollUp').fadeOut(500);
      }
    });
    // $('.navbar .nav-link[data-scroll]').click(function (e) {
    //     e.preventDefault();
    //     $('html,body').animate({
    //         scrollTop: $('.' + $(this).data('scroll')).offset().top - 70
    //     }, 900);
    // });

    // $('footer .links a').click(function (e) {
    //     e.preventDefault();
    //     $('html,body').animate({
    //         scrollTop: $('#' + $(this).data('scroll')).offset().top - 70
    //     }, 900);
    // });

    $(".typed").typed({
      strings: ["Arrivals", "Trending", "Collections"],
      // Optionally use an HTML element to grab strings from (must wrap each string in a <p>)
      stringsElement: null,
      // typing speed
      typeSpeed: 30,
      // time before typing starts
      startDelay: 0,
      // backspacing speed
      backSpeed: 0,
      // time before backspacing
      backDelay: 1200,
      // loop
      loop: true,
      // false = infinite
      loopCount: 'infinite',
      // show cursor
      showCursor: false,
      // character for cursor
      cursorChar: "|",
      // attribute to type (null == text)
      attr: null,
      // either html or text
      contentType: 'html',
      // call when done callback function
      callback: function() {},
      // starting callback function before each string
      preStringTyped: function() {},
      //callback for every typed string
      onStringTyped: function() {},
      // callback for reset
      resetCallback: function() {}
    });

    // scroll up
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 200) {
          $('.scroll_up').fadeIn(500);
        } else {
          $('.scroll_up').fadeOut(500);
        }
    });
    $('.scrollUp').click(function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });

    $("#products").owlCarousel({
        loop: true,
        margin: 15,
        nav: true,
        dots: false,
        rtl: true,
        autoplaySpeed: 1400,
        autoplay: true,
        navSpeed: 2000,
        navText: [
          '<i class="fas fa-chevron-right"></i> Next',
          'Previous <i class="fas fa-chevron-left"></i>',
        ],
        responsive: {
          0: {
            items: 2,
          },
          600: {
            items: 2,
          },
          1000: {
            items: 4,
          },
        },
    });
    $("#categories").owlCarousel({
        loop: true,
        margin: 15,
        nav: true,
        dots: false,
        rtl: true,
        autoplaySpeed: 1400,
        autoplay: true,
        navSpeed: 2000,
        navText: [
          '<i class="fas fa-chevron-right"></i> Next',
          'Previous <i class="fas fa-chevron-left"></i>',
        ],
        responsive: {
          0: {
            items: 2,
          },
          600: {
            items: 2,
          },
          1000: {
            items: 4,
          },
        },
    });
    $("#testimonials").owlCarousel({
        loop: true,
        margin: 15,
        nav: true,
        dots: false,
        rtl: true,
        center:true,
        autoplaySpeed: 1400,
        autoplay: true,
        navSpeed: 2000,
        navText: [
          '<i class="fas fa-chevron-right"></i> Next',
          'Previous <i class="fas fa-chevron-left"></i>',
        ],
        responsive: {
          0: {
            items: 1,
          },
          600: {
            items: 2,
          },
          1000: {
            items: 3,
          },
        },
    });

    function loadCart() {
      $.ajax({
        type: "GET",
        url: "/load-cart-data",
        success: function (response) {
          $('.cart-count').text(response.count);
          // console.log(response.count);
        }
      });
    }
    function loadWishlist() {
      $.ajax({
        type: "GET",
        url: "/load-wishlist-data",
        success: function (response) {
          $('.wishlist-count').text(response.count);
          // console.log(response.count);
        }
      });
    }

    $(document).on('click','.add_to_cart',function(e){
      e.preventDefault();
      var product_id = $(this).closest('.product_data').find('.product_id').val();
      var product_qty = $(this).closest('.product_data').find('.input-qty').val();
      var url = $(this).attr('href');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        method: "POST",
        url: url,
        data: {
          'product_id' : product_id,
          'product_qty' : product_qty,
          'dataType': 'json',
        },
        success: function (response) {
          swal("",response.add,"success");
          loadCart();
        }
      });
    });

    $(document).on('click','.delete_cart_item',function(e){
      e.preventDefault();
      var product_id = $(this).closest('.product_data').find('.product_id').val();
      var url = $(this).attr('href');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        method: "POST",
        url: url,
        data: {
          'product_id' : product_id,
          'dataType': 'json',
        },
        success: function (response) {
          loadCart();
          swal("",response.add,"success").then(function () {
            // window.location.reload();
            $('.cart-section').load(location.href + ' .cart-section');
          });
        }
      });
    });

    $(document).on('click','.increment-btn',function(e){
      e.preventDefault();
      var increment_btn = $(this).closest('.product_data').find('.input-qty').val();
      var productQty = $(this).closest('.product_data').find('.productQty').val();
      
      var value = parseInt(increment_btn,10);
      value = isNaN(value) ? 0 : value;
      if(value < 10) {
        value++;
        $(this).closest('.product_data').find('.input-qty').val(value);
      }
      if(productQty < value) {
        swal("","Product quantity less than this number");
      }
    });

    $(document).on('click','.decrement-btn',function(e){
      e.preventDefault();
      var decrement_btn = $(this).closest('.product_data').find('.input-qty').val();
      var value = parseInt(decrement_btn,10);
      value = isNaN(value) ? 0 : value;
      if(value > 1) {
        value--;
        $(this).closest('.product_data').find('.input-qty').val(value);
      }
    });

    $(document).on('click','.change_qty',function(e){
      e.preventDefault();
      var product_id = $(this).closest('.product_data').find('.product_id').val();
      var product_qty = $(this).closest('.product_data').find('.input-qty').val();
      var url = $('.update_qty').attr('href');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        method: "POST",
        url: url,
        data: {
          'product_id' : product_id,
          'product_qty' : product_qty,
          'dataType': 'json',
        },
        success: function (response) {
          swal("",response.add,"success").then(function () {
            // window.location.reload();
            $('.cart-section').load(location.href + ' .cart-section');
          });
          // window.location.reload();
        }
      });
    });

    $(document).on('click','.add_to_wishlist',function(e){
      e.preventDefault();
      var product_id = $(this).closest('.product_data').find('.product_id').val();
      var url = $(this).attr('href');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        method: "POST",
        url: url,
        data: {
          'product_id' : product_id,
          'dataType': 'json',
        },
        success: function (response) {
          swal("",response.add,"success");
          loadWishlist();
        }
      });
    });
    
    $(document).on('click','.delete_wishlist_item',function(e){
      e.preventDefault();
      var product_id = $(this).closest('.product_data').find('.product_id').val();
      var url = $(this).attr('href');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        method: "POST",
        url: url,
        data: {
          'product_id' : product_id,
          'dataType': 'json',
        },
        success: function (response) {
          loadWishlist();
          swal("",response.add,"success").then(function () {
            // window.location.reload();
            $('.wishlist-section').load(location.href + ' .wishlist-section');
          });
        }
      });
    });

    $('[data-toggle="tooltip"]').tooltip();
    
    $('.zoom-image img').click(function(event){
      var ix = $(this).offset().left;
      var iy = $(this).offset().top;
      console.log(ix + '-' + iy);
      
        var mx = event.pageX;
        var my = event.pageY;
      console.log(mx + '-' + my);
    })
  
    $(window).width(function(){
      if($(window).width() >= 820) {
        $('.zoom-image img').hover(function(){
  
          var img = $(this).attr('src');
      
          $(this).after("<div class='hover-image' style='background-image: url(" + img + "); background-size: 1200px;'></div>");
      
          $(this).mousemove(function(event){
      
            // Mouse Position
            var mx = event.pageX;
            var my = event.pageY;
      
            // Image Position
            var ix = $(this).offset().left;
            var iy = $(this).offset().top;
      
            // Mouse Position Relavtive to Image
            var x = mx - ( ix );
            var y = my - ( iy );
      
            // Image Height and Width
            var w = $(this).width();
            var h = $(this).height();
      
            // Mouse Position Relative to Image, in %
            var xp = ( -x / w ) * -100;
            var yp = ( -y / h ) * -100;
      
            $(this).parent().find('.hover-image').attr('style',
      
            "background-image: url(" + img + "); background-size: 1200px; background-repeat: no-repeat; background-position: " + xp + "% " + yp + "%; top: " + y + "px; left: " + x + "px;");
      
          });
      
        }, function(){
      
          $(this).parent().find('.hover-image').remove();
      
        });
      }
    });

    // loading
    $(window).ready(function () {
      $('.loading-overlay').delay(4000).fadeOut(2000);
    });
});
