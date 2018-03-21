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


          //VIDEO EVENTS
          $('.home-primary-nav').css('opacity', '0');
          $('#ambient-video').each(function(){
            var player = videojs('ambient-video');
            player.on('play', function () {
              TweenMax.fromTo('.home-primary-nav', 0.5, {opacity: 0, y: 20}, {opacity: 1, y:0});
            });
          });

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


          //NAVIGATION

          function menuFinishedAnimating(){
            isAnimating = false;
            $('.hamburger').toggleClass('x');
            if(!menuIsOpen){
              $('.navigation').css('display', 'none');
            }
          }
          function openNavigation(){
            isAnimating = true;
            menuIsOpen = true;
            $('.navigation').css({
              display: 'block',
              opacity: 0
            });

            TweenMax.to('.navigation', 0.3, {opacity: 0.98});
            TweenMax.to($('.nav-menus'), 0.3, {opacity: 1, delay: 0.3, onComplete: menuFinishedAnimating});
          }
          function closeNavigation(){
            isAnimating = true;
            menuIsOpen = false;
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


          $('.hamburger').click(function(){
            toggleNavigation();
          });
          //LINKS ARRAY
          $('.main-navigation-sub-menu li').each(function(){
            navLinks.push(this);
          });

          $('main-navigation-links li').hover(function(){

          }, function(){

          });


          $('.post-list').masonry({
            itemSelector: '.post-item',
            columnWidth: '.grid-sizer',
            percentPosition: true,
            gutter: '.gutter'
          });



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
