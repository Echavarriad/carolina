(function () {
  "use strict";

  var DULCY = DULCY || {};
  DULCY.var = {};
  DULCY.var.window = jQuery(window);

  var $j = jQuery.noConflict();

  DULCY.page = {
    init: function () {
      $j("._search>button").click(function () {
        $j("._search-box").addClass("_Searching");
      });

      $j(document).click(function (e) {
        if ($j(e.target).is("#_search-box_container")) {
          $j("._search-box").removeClass("_Searching");
        }
      });

      $j("button.close_search").click(function () {
        $j("._search-box").removeClass("_Searching");
      });

      $j("li.hasLinks>a").click(function (e) {
        if ($j(window).width() < 1025) {
          e.preventDefault();
          if (!$j(this).hasClass("_activeLinks")) {
            $j(".category_links").slideUp(400);
            $j("li.hasLinks>a").removeClass("_activeLinks");
            $j(this).addClass("_activeLinks");
            $j(this).next(".category_links").slideDown(400);
          } else {
            $j(this).removeClass("_activeLinks");
            $j(this).next(".category_links").slideUp(400);
          }
        }
      });

      $j("button.show_menu").click(function () {
        $j(this).toggleClass("_on");
        $j("._navigation").slideToggle(400);
        $j("html, body").toggleClass("__no-scroll");
      });

      $j("._options>button.toggler").click(function (e) {
        e.preventDefault();
        $j(this).next("._options-content").fadeToggle(400);
      });

      $j("._share>button").click(function (e) {
        e.preventDefault();
        $j(this).next("._share-content").toggleClass("show");
      });

      $j('ul._categories-content>li>button').click(function () {
        if (!$j(this).hasClass('_cat-active')) {
          $j(this).addClass('_cat-active');
          $j(this).next('._links').slideDown(400);
          $j(this).next('.price_field').slideDown(400);
        } else {
          $j(this).removeClass('_cat-active');
          $j(this).next('._links').slideUp(400);
          $j(this).next('.price_field').slideUp(400);
        }
      });

      $j('button._filter-toggler').click(function () {
        $j('.products_filter').toggleClass('_onShow');
        $j("html, body").toggleClass("__no-scroll");
      });

      $j('span.close_filters').click(function () {
        $j('.products_filter').removeClass('_onShow');
        $j("html, body").removeClass("__no-scroll");
      });

      $j('.product_data--info_itm ._toggler').click(function () {
        if (!$j(this).hasClass('_info-active')) {
          $j(this).addClass('_info-active');
          $j(this).next('._content').slideDown(400);
        } else {
          $j(this).removeClass('_info-active');
          $j(this).next('._content').slideUp(400);
        }
      });

      $j('.question_itm ._toggler').click(function () {
        if (!$j(this).hasClass('_question-active')) {
          $j('.question_itm ._toggler').removeClass('_question-active');
          $j('._content').slideUp(400)
          $j(this).addClass('_question-active');
          $j(this).next('._content').slideDown(400);
        } else {
          $j(this).removeClass('_question-active');
          $j(this).next('._content').slideUp(400);
        }
      });

      $j('.acc_order--itm_head button.more_content').click(function () {
        $j(this).toggleClass('__On');
        $j(this).parent().next('.acc_order--itm_content').slideToggle(300);
      })
    },
  };

  DULCY.onReady = {
    init: function () {
      if ($j(window).width() > 1024) {
        $j("._brand").width(function () {
          return $j("._right-items").innerWidth();
        });
      }

      $j(document).scrollTop() > 0
        ? $j("header").addClass("__fixed")
        : $j("header").removeClass("__fixed");

      $j(document).scroll(function () {
        $j(this).scrollTop() > 0
          ? $j("header").addClass("__fixed")
          : $j("header").removeClass("__fixed");
      });

      let lastScrollTop = 0;
      $j(document).scroll(function () {
        let s = $j(this).scrollTop(),
          h = $j("header").innerHeight();
        if (s > lastScrollTop) {
          if (s > 100) {
            $j("header").css({
              top: `-${h}px`,
            });
          }
        } else {
          $j("header").css({
            top: "0",
          });
        }
        lastScrollTop = s;
      });

      if ($j(".main_banner--products_cnt").length) {
        const productsBanner = new Swiper(".main_banner--products_cnt", {
          slidesPerView: 1,
          loop: true,
          speed: 800,
          autoplay: {
            delay: 6000,
            disableOnInteraction: false,
          },
          pagination: {
            el: ".main_banner--pagination",
            clickable: true,
          },
        });
      }

      if ($j('.product .product_images').length) {
        // const productGalleryThumbs = new Swiper('.product_images--thumbs', {
        //   centeredSlidesBounds: true,
        //   slidesPerView: 3,
        //   watchOverflow: true,
        //   watchSlidesVisibility: true,
        //   watchSlidesProgress: true,
        //   spaceBetween: 14,
        //   breakpoints: {
        //     0: {
        //       direction: 'horizontal',
        //     },
        //     1280: {
        //       direction: 'vertical',
        //     }
        //   }
        // });

        // const productGallery = new Swiper('.product_images--view', {
        //   slidesPerView: 1,
        //   spaceBetween: 14,
        //   loop: true,
        //   speed: 800,
        //   thumbs: {
        //     swiper: productGalleryThumbs
        //   }
        // });

        // $j('.change-gallery').change(function(e){
        //   let index= $j('.change-gallery option:selected').data('index');
        //   console.log(index)
        //   productGallery.slideTo(index, 1000, false);
        // })
      }

      if ($j('.blog_images').length) {
        const blogGalleryThumbs = new Swiper('.blog_images--thumbs', {
          centeredSlidesBounds: true,
          watchOverflow: true,
          watchSlidesVisibility: true,
          watchSlidesProgress: true,
          spaceBetween: 14,
          breakpoints: {
            0: {
              direction: 'horizontal',
              slidesPerView: 4,
            },
            1280: {
              direction: 'vertical',
              slidesPerView: 6,
            }
          }
        });

        const blogGallery = new Swiper('.blog_images--view', {
          slidesPerView: 1,
          spaceBetween: 14,
          loop: true,
          speed: 800,
          thumbs: {
            swiper: blogGalleryThumbs
          }
        });
      }

      Fancybox.bind("[data-fancybox]", {});

      DULCY.page.init();
    },
  };

  DULCY.onLoad = {
    init: function () { },
  };

  $j(function () {
    DULCY.onReady.init();
  });

  $j(window).on("load", DULCY.onLoad.init);
})();
