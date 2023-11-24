$(document).ready(function () {

  // #region HEADER

  $(".btn_menu").on("click", function () {

    if ($("body").hasClass("opn_menu")) {

      $("body").removeClass("opn_menu");

      $(".menu").slideUp(400);



      $(".imbtn_n1").removeClass("imbtn_n1_op");

      $(".sb_menu").slideUp(400);



      $(".imbtn_n2").removeClass("imbtn_n2_op");

      $(".sb_menu2").slideUp(400);

    } else {

      $("body").addClass("opn_menu");

      $(".menu").slideDown(400);

    }

  });



  $(document).click(function (event) {

    $target = $(event.target);

    if (

      !$target.closest(".btn_menu, .header").length &&

      $(".sb_menu").is(":visible")

    ) {

      $(".imbtn_n1").removeClass("imbtn_n1_op");

      $(".sb_menu").slideUp(400);

      $(".imbtn_n2").removeClass("imbtn_n2_op");

      $(".sb_menu2").slideUp(400);

    }

  });



  $(".imbtn_n1").on("click", function () {

    if ($(this).hasClass("imbtn_n1_op")) {

      $(".imbtn_n1").removeClass("imbtn_n1_op");

      $(".sb_menu").slideUp(400);



      $(".imbtn_n2").removeClass("imbtn_n2_op");

      $(".sb_menu2").slideUp(400);

    } else {

      $(".imbtn_n2").removeClass("imbtn_n2_op");

      $(".sb_menu2").slideUp(400);

      $(".imbtn_n1").removeClass("imbtn_n1_op");

      $(".sb_menu").slideUp(400);

      $(this).addClass("imbtn_n1_op");

      $(this).siblings(".sb_menu").slideDown(400);

    }

  });

  $(".imbtn_n2").on("click", function () {

    if ($(this).hasClass("imbtn_n2_op")) {

      $(".imbtn_n2").removeClass("imbtn_n2_op");

      $(".sb_menu2").slideUp(400);

    } else {

      $(".imbtn_n2").removeClass("imbtn_n2_op");

      $(".sb_menu2").slideUp(400);

      $(this).addClass("imbtn_n2_op");

      $(this).siblings(".sb_menu2").slideDown(400);

    }

  });

  // #region header fijo

 /*  var stickyOffset = $("body").offset().top + 1;

  $(window).scroll(function () {

    if ($(window).scrollTop() >= stickyOffset) {

      $(".header").addClass("header_fixed");

    } else {

      $(".header").removeClass("header_fixed");

    }

  }); */

  // #endregion

  // #endregion

  // #region slider index 1

  var mySwiper = new Swiper(".swiper-index_p", {

    direction: "horizontal",

      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },

    loop: true,

    on: {

      slideChange: function () {

        tippy.hideAll();

        $(".lk_ptrst_tag").removeClass("active");

      },

    },

    pagination: {

      el: ".swiper-pagination",

      clickable: true,

    },

    navigation: {

      nextEl: ".swiper-button-next",

      prevEl: ".swiper-button-prev",

    },

    breakpoints: {

      1199: {

        direction: "vertical",
        speed: 900,
        autoplay: {
          delay: 4000,
          disableOnInteraction: false,
         },

      },

    },

  });

  // #endregion

  // #region slider ampliacion acc

  var mySwiper = new Swiper(".swiper-acc", {

    direction: "horizontal",

    loop: true,

    pagination: {

      el: ".swiper-pagination_acc",

      clickable: true,

    },

    breakpoints: {

      1199: {

        direction: "horizontal",

      },

    },

  });

  // #endregion

  // #region slider ampliacion motos

  var mySwiper = new Swiper(".swiper-motos", {

    direction: "horizontal",

    loop: false,

    autoHeight: true,

    navigation: {

      nextEl: ".swiper-button-next_m",

      prevEl: ".swiper-button-prev_m",

    },

    pagination: {

      el: ".swiper-pagination_motos",

      clickable: true,

    },

    scrollbar: {

      el: ".swiper-scrollbar",

      hide: false,

    },

    on: {

      slideChange: function () {

        tippy.hideAll();

        $(".lk_ptrst_tag").removeClass("active");

      },

    },

    breakpoints: {

      1199: {

        direction: "horizontal",

      },

    },

  });

  $(".select-color").click(function(event) {
    let index = $(this).data('index');
    $('.select-color').removeClass('active');
    $(this).addClass('active');
    mySwiper.slideTo(index, 1000, false);
  });

  // #endregion

  // #region boton up

  $(".btn_upy").click(function () {

    $("html, body").animate({ scrollTop: 0 }, 800);

    return false;

  });

  // #endregion

  // #region contador

  // jQuery(

  //   '<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>'

  // ).insertAfter(".quantity input");

  // jQuery(".quantity").each(function () {

  //   var spinner = jQuery(this),

  //     input = spinner.find('input[type="number"]'),

  //     btnUp = spinner.find(".quantity-up"),

  //     btnDown = spinner.find(".quantity-down"),

  //     min = input.attr("min"),

  //     max = input.attr("max");



  //   btnUp.click(function () {

  //     var oldValue = parseFloat(input.val());

  //     if (oldValue >= max) {

  //       var newVal = oldValue;

  //     } else {

  //       var newVal = oldValue + 1;

  //     }

  //     spinner.find("input").val(newVal);

  //     spinner.find("input").trigger("change");

  //   });



  //   btnDown.click(function () {

  //     var oldValue = parseFloat(input.val());

  //     if (oldValue <= min) {

  //       var newVal = oldValue;

  //     } else {

  //       var newVal = oldValue - 1;

  //     }

  //     spinner.find("input").val(newVal);

  //     spinner.find("input").trigger("change");

  //   });

  // });

  // #endregion

  // #region tooltip

  tippy("[data-tippy-content]", {

    trigger: "click",

  });



  $(".lk_ptrst_tag").on("click", function () {

    $(this).toggleClass("active");

  });

  // #endregion

  // #region pop up

  $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({

    type: "iframe",

    mainClass: "mfp-fade",

    removalDelay: 160,

    preloader: false,

    fixedContentPos: false,

  });

  // #endregion

  // #region buscador

  $(".icn_lup").on("click", function () {

    if ($("body").hasClass("lp_op")) {

      $("body").removeClass("lp_op");

    } else {

      $("body").addClass("lp_op");      

      $("#input-search").focus();

    }

  });

  $(document).click(function (event) {

    $target = $(event.target);

    if (

      !$target.closest(".icn_lup, .busc_box").length &&

      $(".busc_wrp").is(":visible")

    ) {

      $("body").removeClass("lp_op");

    }

  });

  // #endregion

  // #region tiki btns

  /* var stickyOffsets = 1;

  $(window).scroll(function () {

    if ($(window).scrollTop() >= stickyOffsets) {

      $(".ib1_social").addClass("ib1_social_fixed");

    } else {

      $(".ib1_social").removeClass("ib1_social_fixed");

    }

  }); */



  $(function () {

    if ($(window).width() < 1199) {

      var stickyOffsetw = $(".btn_wtspp").offset().top - 155;

      // alert(stickyOffsetw)

      $(window).scroll(function () {

        if ($(window).scrollTop() >= stickyOffsetw) {

          $(".btn_wtspp").addClass("btn_wtspp_fixed");

        } else {

          $(".btn_wtspp").removeClass("btn_wtspp_fixed");

        }

      });

    }

    if ($(window).width() > 1200) {

      var stickyOffsetw = $(".btn_wtspp").offset().top - 225;

      $(window).scroll(function () {

        if ($(window).scrollTop() >= stickyOffsetw) {

          $(".btn_wtspp").addClass("btn_wtspp_fixed");

        } else {

          $(".btn_wtspp").removeClass("btn_wtspp_fixed");

        }

      });

    }

  });

  // #endregion

  //  #region filtos

  $(".bl_filter").on("click", function () {

    if ($(".bl_filter").hasClass("bl_filter_op")) {

      $(".bl_filter").removeClass("bl_filter_op");

    } else {

      $(".bl_filter").addClass("bl_filter_op");

    }

  });



  $(document).click(function (event) {

    $target = $(event.target);

    if (

      !$target.closest(".bl_filter, .btn_blfilter").length &&

      $(".box_filter").is(":visible")

    ) {

      $(".bl_filter").removeClass("bl_filter_op");

    }

  });

  //  #endregion

});

