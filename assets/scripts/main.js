/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        var menuIsOpen = false;
        var isAnimating = false;
        var menuAnimationTime = 0.3;
        var navLinks = [];
        var subnavLinks = [];
        var footerNavLinks = [];
        var postItems = [];
        var resetDelay;
        var inactivityTimeout;

          //VIDEO EVENTS

          if($('#post-video').length){
            player = videojs('post-video', {
              "controls": true,
              "preload": "metadata",
              "loop": true
            });
            player.on('mousemove', function(){
              resetDelay();
            });
          }

          resetDelay = function(){
              clearTimeout(inactivityTimeout);
              inactivityTimeout = setTimeout(function(){
                  player.userActive(false);
              }, 750);
          };





          // OBJECT FIT FALLBACK
          if(!Modernizr.objectfit){
            $('.obj-fit').each(function(){
              var container = $(this);
              imgUrl = container.find('img').prop('src');
              if (imgUrl) {
                container.css('background-image', 'url(' + imgUrl + ')');
                container.css('background-size', 'cover');
                container.css('background-position', 'center');
                container.find('picture').css('display', 'none');
              }
            });
          }


          // NAVIGATION

          function disableScroll(){
            $('body').css({'overflow':'hidden'});
            $('body').bind('touchmove', function(e){e.preventDefault();});
          }

          function enableScroll(){
            $(document).unbind('scroll');
            $('body').css({'overflow':'visible'});
          }

          function menuFinishedAnimating(){
            isAnimating = false;
            $('.hamburger').toggleClass('x');
            if(!menuIsOpen){
              $('.navigation').css('display', 'none');
              enableScroll();
            }
          }

          function openNavigation(){
            isAnimating = true;
            menuIsOpen = true;
            $('.navigation').css({
              display: 'block',
              opacity: 0
            });
            $('header .bread-crumb').css('opacity', 0);
            TweenMax.to('header .bread-crumb', 0.3, {autoAlpha: 0});
            TweenMax.to('.navigation', 0.3, {opacity: 1});
            TweenMax.to($('.nav-menus'), 0.3, {opacity: 1, delay: 0.3, onComplete: menuFinishedAnimating});
            disableScroll();
          }

          function closeNavigation(){
            isAnimating = true;
            menuIsOpen = false;
            TweenMax.to('header .bread-crumb', 0.3, {autoAlpha: 1, delay: 0.3});
            TweenMax.to($('.nav-menus'), 0.3, {opacity: 0, });
            TweenMax.to('.navigation', 0.3, {opacity: 0, delay: 0.3, onComplete: menuFinishedAnimating});
          }

          function toggleNavigation(){
            if(!isAnimating){
              if(!menuIsOpen){
                openNavigation();
              }else{
                closeNavigation();
              }
            }
          }

          function focusLink(current, array){
            for(i=0; i<array.length; i++){
              if(array[i] !== current){
               TweenMax.to(array[i], .2, {opacity: 0.5});
              }
            }
          }

          function resetLinks(array){
            for(i=0;i<array.length;i++){
              TweenMax.to(array[i], .2, {opacity: 1, ease: Power3.easeIn});
            }
          }



          $('.hamburger').click(function(){
            toggleNavigation();
          });

          // LINKS ARRAY
          function linksArray(){
            $('.home-primary-nav li').each(function(){
              navLinks.push(this);
            });

            $('.main-navigation-sub-menu li').each(function(){
              subnavLinks.push(this);
            });

            $('footer .nav-item').each(function(){
              footerNavLinks.push(this);
            });

            $('.post-link').each(function(){
              postItems.push(this);
            });

          }


          // LINKS HOVER
          $('.main-navigation-sub-menu li').hover(function(){
            focusLink(this, subnavLinks);
          }, function(){
            resetLinks(subnavLinks);
          });

          $('.home-primary-nav li').hover(function(){
            focusLink(this, navLinks);
          }, function(){
            resetLinks(navLinks);
          });

          $('.post-link').hover(function(){
            TweenLite.to($(this), .2, {opacity: .6});
            //focusLink(this, postItems);
          },function(){
            TweenLite.to($(this), .2, {opacity: 1});
            //resetLinks(postItems);
          });


          var postList = $('.post-list').masonry({
            itemSelector: '.post-item',
            columnWidth: '.grid-sizer',
            percentPosition: true,
            gutter: '.gutter',
            horizontalOrder: true
          });


          // SCROLL REVEAL
          window.sr = new ScrollReveal();

          if($('.r')){
            sr.reveal('.r', {
              scale: 1,
              opacity: 0,
              duration: 500,
              distance: '0px'
            });
          }





          // LAZY LOAD
          $('.lazyload').css('opacity', '0');
          document.addEventListener('lazyloaded', function(e){
            img = $(e.target);
            TweenMax.fromTo(img, 0.5, {opacity: 0}, {opacity: 1, ease: Power4.easeIn});
          });

          $('.first-thumbnail').on('load',function(){
            postList.masonry();
          });







          /* CONTACT EVENTS
          wpcf7:invalid
          wpcf7:spam
          wpcf7:mailsent
          wpcf7:mailfailed
          wpcf7:submit
          */
          $(".wpcf7").on('wpcf7:mailfailed', function(event){
            $('.wpcf7-submit').val('Failed To Send');
          });

          $(".wpcf7").on('wpcf7:mailsent', function(event){
            $('.wpcf7-submit').val('Sent');
            $('.contact-form').css({
              pointerEvents: "none",
            });
            TweenLite.to($('.contact-form'), .4, {opacity: 0.4});
          });






          $(window).load(function(){
            $('body').removeClass('fouc');
            linksArray();

          });

          $(window).resize(function(){

          });

          //$('.jarallax').jarallax();



      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
