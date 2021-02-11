import 'konami/konami.js';
import 'js-cookie/src/js.cookie.js';
import 'responsive-tabs/js/jquery.responsiveTabs.min.js';
import 'slick-carousel/slick/slick.min.js';
import 'jquery.mmenu/dist/jquery.mmenu.all.js';
import '@fancyapps/fancybox/dist/jquery.fancybox.min.js';
import 'what-input/dist/what-input.min.js';
//import Cookies from 'js-cookie'

export default {
  init() {

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
    $('.hero-slideshow').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      fade: true,
      autoplay: true,
      autoplaySpeed: 7000,
      prevArrow:"<button type='button' class='slick-prev slick-arrow'><icon class='icon-arr-l'></icon></button>",
      nextArrow:"<button type='button' class='slick-next slick-right'><icon class='icon-arr-r'></icon></button>",
    });
    $('.hero-slideshow').on('beforeChange', function(event, slick, currentSlide){
      if ($('.slide'+currentSlide+ ' video').length != ''){
        $('.slide'+currentSlide+ ' .video')[0].currentTime = 0;
      }
    });

    $('.hero-slideshow').on('afterChange', function(event, slick, currentSlide){
      if ($('.slide'+currentSlide+ ' video').length != ''){
        $('.hero-slideshow').slick('slickPause');
        $('.slide'+currentSlide+ ' .video')[0].play();

        $('.slide'+currentSlide+ ' .video').on('ended',function(){
          //$('.sshow').slick('slickPlay');
          $('.hero-slideshow').slick('slickNext');
        });
      } else {
        $('.hero-slideshow').slick('slickPlay');
      }
    });

    $(".slide .video-slide").on("ended", function() {
      alert("Video Finished");
    });


    // testimonials
    $('.testimonial-slideshow').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      arrows: false,
      dots: false,
      fade: true,
      autoplay: true,
      autoplaySpeed: 12000,
      prevArrow: '<button class="slick-arrow slick-prev" tabindex="0" aria-label="Jump to Previous Slide"><icon class="icon-back-arrow"></icon></button>',
      nextArrow: '<button class="slick-arrow slick-next" tabindex="0" aria-label="Jump to Next Slide"><icon class="icon-forward-arrow"></icon></button>',
    }).on('beforeChange', function(event, slick, currentSlide, nextSlide){
      $(this).find('.slick-slide[data-slick-index="'+nextSlide+'"] .cont').removeClass('fadeOutDown').addClass('fadeInDown');
      $(this).find('.slick-slide[data-slick-index="'+currentSlide+'"] .cont').removeClass('fadeInDown').addClass('fadeOutDown');
    });

    $( ".ubermenu-submenu-align-full_width" ).wrapInner(function() {
      return "<div class='minwidth-container'></div>";
    });

    //menu active class
    $(".main-nav li.menu-item-has-children, .main-nav li.menu-item-has-children ul.submenu li a, .main-nav li.menu-item-has-children ul.submenu li ul.submenu li a").hover(
      function () {
        var $this = $(this),
          timer = $this.data("timer") || 0;

        clearTimeout(timer);
        $this.addClass("activated");

        timer = setTimeout(function() {
          $this.addClass("activated");
        }, 0);

        $this.data("timer", timer);
      },
      function () {
        var $this = $(this),
          timer = $this.data("timer") || 0;

        clearTimeout(timer);
        timer = setTimeout(function() {
          $this.removeClass("activated");
        }, 100);

        $this.data("timer", timer);
      }
    );

    $('.generic-slideshow').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      arrows: true,
      dots: false,
      fade: true,
      autoplay: false,
      autoplaySpeed: 8000,
      prevArrow: '<button class="slick-arrow slick-prev" tabindex="0" aria-label="Jump to Previous Slide"><icon class="icon-arr-l"></icon></button>',
      nextArrow: '<button class="slick-arrow slick-next" tabindex="0" aria-label="Jump to Next Slide"><icon class="icon-arr-r"></icon></button>',
    }).on('beforeChange', function(event, slick, currentSlide, nextSlide){
      $(this).find('.slick-slide[data-slick-index="'+nextSlide+'"] .cont').removeClass('fadeOutDown').addClass('fadeInDown');
      $(this).find('.slick-slide[data-slick-index="'+currentSlide+'"] .cont').removeClass('fadeInDown').addClass('fadeOutDown');
    });

    // faqs
    if($(".toggle .toggle-title").hasClass('active') ){
      $(".toggle .toggle-title.active").closest('.toggle').find('.toggle-inner').show();
    }

    $(".toggle .toggle-title").click(function(){
      if($(this).hasClass('active')){
        $(this).removeClass("active").closest('.toggle').find('.toggle-inner').slideUp(200);
      } else {
        $(this).addClass("active").closest('.toggle').find('.toggle-inner').slideDown(200);
      }
    });

    // fancybox
    $('[data-fancybox]').fancybox({
      loop: true,
      //toolbar: false,
      infobar: false,
      buttons: [
        "close",
      ],
    });

    //konami to clear cookies
    const pressed = [];
    const clearCache = 'clear';

    window.addEventListener('keyup', (e) =>{
      //console.log(e.key);
      pressed.push(e.key);
      pressed.splice(clearCache.length -1, pressed.length - clearCache.length);

      if(pressed.join('').includes(clearCache)){
        //Cookies.remove('videod');
        location.reload();
      }
      //console.log(pressed);
    });


    //Mmenu
    var $menu = $("#menu").mmenu({
       // options
       "slidingSubmenus": true,
       "navbar": "",
       "extensions": [
          "fx-menu-zoom",
          "fx-panels-zoom",
          "position-right",
       ],
    });
    var $icon = $("#my-icon");
    var API = $menu.data( "mmenu" );

    $icon.on( "click", function() {
       API.open();
    });

    API.bind( "open:finish", function() {
       setTimeout(function() {
          $icon.addClass( "is-active" );
       }, 100);
    });
    API.bind( "close:finish", function() {
       setTimeout(function() {
          $icon.removeClass( "is-active" );
       }, 100);
    });

    var isTouch = ('ontouchstart' in document.documentElement);
    if (isTouch ) {
      $('body').addClass('is-touch');
    }


    //compliancy
		$('.add-aria, h1, h2, h3, h4, p, ul li, ol li, img').attr('tabindex', '0');
		$('nav ul li, .brand, .brand img, .breadcrumbs a, .breadcrumbs span').attr('tabindex', '-1');
  },
};
