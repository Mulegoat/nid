/*
 * Bones Scripts File
 * Author: Marco Terrinoni
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/

/*
 * IE8 ployfill for GetComputed Style (for Responsive Script below)
 * If you don't want to support IE8, you can just remove this.
*/
if (!window.getComputedStyle) {
  window.getComputedStyle = function(el, pseudo) {
    this.el = el;
    this.getPropertyValue = function(prop) {
      var re = /(\-([a-z]){1})/g;
      if (prop == 'float') prop = 'styleFloat';
      if (re.test(prop)) {
        prop = prop.replace(re, function () {
          return arguments[2].toUpperCase();
        });
      }
      return el.currentStyle[prop] ? el.currentStyle[prop] : null;
    }
    return this;
  }
}

/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return {width:x,height:y}
}
// setting the viewport width
var viewport = updateViewportDimensions();

/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
	viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
	if (viewport.width >= 768) {
		$('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',$(this).attr('data-gravatar'));
  });
	}
} // end function


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();

  // FluidVids Script

  (function initFluidVideos( window, document, undefined ) {

    /*
     * Grab all iframes on the page or return
     */
    var iframes = document.getElementsByTagName( 'iframe' );

    /*
     * Loop through the iframes array
     */
    for ( var i = 0; i < iframes.length; i++ ) {

      var iframe = iframes[i],

      /*
         * RegExp, extend this if you need more players
         */
      players = /www.youtube.com|player.vimeo.com/;

      /*
       * If the RegExp pattern exists within the current iframe
       */
      if ( iframe.src.search( players ) > 0 ) {

        /*
         * Calculate the video ratio based on the iframe's w/h dimensions
         */
        var videoRatio        = ( iframe.height / iframe.width ) * 100;

        /*
         * Replace the iframe's dimensions and position
         * the iframe absolute, this is the trick to emulate
         * the video ratio
         */
        iframe.style.position = 'absolute';
        iframe.style.top      = '0';
        iframe.style.left     = '0';
        iframe.width          = '100%';
        iframe.height         = '100%';

        /*
         * Wrap the iframe in a new <div> which uses a
         * dynamically fetched padding-top property based
         * on the video's w/h dimensions
         */
        var wrap              = document.createElement( 'div' );
        wrap.className        = 'fluid-vids';
        wrap.style.width      = '100%';
        wrap.style.position   = 'relative';
        wrap.style.paddingTop = videoRatio + '%';

        /*
         * Add the iframe inside our newly created <div>
         */
        var iframeParent      = iframe.parentNode;
        iframeParent.insertBefore( wrap, iframe );
        wrap.appendChild( iframe );

      }

    }

  })( window, document );



  //init Menu

  (function initMobileMenu() {
      var $menu = $('nav#menu');

      //  Toggle menu
      $('.icon-menu').click(function( e ) {
          $menu.trigger( $menu.hasClass( 'mm-opened' ) ? 'close.mm' : 'open.mm' );
          e.preventDefault();
      });

      //  Create the menu
      $menu.mmenu({
          zposition:"next",
          transitionDuration: 400,
          slidingSubmenus: false
      });

  })();

  // FitVids
  // (function resizeVideo() {

  //   $(".rsContent").fitVids();

  // })();



  //Scroll To Function For Blog Posts

  (function scrollContent() {

      $('#scroll-link').click(function () {
         $('body,html').animate({
          scrollTop: $("#articleBody").offset().top
         }, 800);

      });

  })();

  enquire
  .register('screen and (min-width: 300px)', {
      setup: function(){
          console.log("handler 300up matched");
      },
      match : function () {
          console.log("handler 320up matched");

      }
  })
  .register('screen and (min-width: 768px)', {
      setup: function(){

      },
      match : function () {
          console.log("handler 768up matched");

            //Section Scroll
            (function sectionScroll (){
                var scrollSection = 1;

                  $("a.prevSection").click(function(e){
                    e.preventDefault();
                    if(scrollSection < 20){
                      scrollSection++;
                    }
                    TweenLite.to(window, 1, {scrollTo:{y:$(".section-" + scrollSection).offset().top-100}, ease:Power2.easeOut});
                  });

                  $("a.nextSection").click(function(e){
                    e.preventDefault();
                    if(scrollSection > 1){
                      scrollSection--;
                      TweenLite.to(window, 1, {scrollTo:{y:$(".section-" + scrollSection).offset().top-100}, ease:Power2.easeOut});
                    }
                  });
            })();


        //Masonry Layout
        (function masonryLayout(){

            var $container = $('#portfolio-projects');

             $container.imagesLoaded(function() {
                  $container.isotope({
                    // options
                    animationEngine: 'jquery',
                    layoutMode: 'sloppyMasonry',
                    itemSelector : '.item-project'
                  });
              });

            $(window).smartresize(function() {
              $('#portfolio-projects').isotope('reLayout');
              console.log("Masonry Resized");
            });

        })();

      }
  })
  .register('screen and (min-width:1240px)',{
      setup: function(){


      },
      match : function () {
          console.log("handler 1240up matched");

          //Section Scroll
          (function sectionScroll (){
              var scrollSection = 1;

                $("a.prevSection").click(function(e){
                  e.preventDefault();
                  if(scrollSection < 20){
                    scrollSection++;
                  }
                  TweenLite.to(window, 1, {scrollTo:{y:$(".section-" + scrollSection).offset().top-0}, ease:Power2.easeOut});
                });

                $("a.nextSection").click(function(e){
                  e.preventDefault();
                  if(scrollSection > 1){
                    scrollSection--;
                    TweenLite.to(window, 1, {scrollTo:{y:$(".section-" + scrollSection).offset().top-0}, ease:Power2.easeOut});
                  }
                });
          })();


        /* Set Home Page Intro Div to 100% of Window */
          (function resizeHeroContent(){
              var column_height = $("html").height();
              column_height = column_height - 0; // 80 is the header height
              column_height = column_height + "px";
              $("#heroContent_desktop").css("height",column_height);
              $("#heroSlider").css("height",column_height);
              $(".fullScreenBG").css("height",column_height);
          })();


          (function animateInOutCopy() {

              var $openCopy        =   $('.openContent'),
                  $closeCopy       =   $('.closeContent'),
                  $copyContainer   =   $('#copyContainer'),
                  $rsContent       =   $('.rsContent');


              $openCopy.click(function(e) {
                  e.preventDefault();
                    $(".openContent").addClass("is--hidden");
                    $(".openContent").removeClass("is--active");
                    $(".closeContent").addClass("is--active");
                    $(".closeContent").removeClass("is--hidden");
                    // slide copy in
                    TweenLite.to($copyContainer, 0.25, {right:"0%", ease:Power2.easeOut});
                    TweenLite.to($rsContent, 0.4, {opacity:"0.10", delay:0.2, ease:Power2.easeOut});
                    console.log("Copy Inview");
              });

              $closeCopy.click(function(e) {
                  e.preventDefault();
                    $(".closeContent").addClass("is--hidden");
                    $(".closeContent").removeClass("is--active");
                    $(".openContent").addClass("is--active");
                    $(".openContent").removeClass("is--hidden");
                    // slide copy out
                    TweenLite.to($copyContainer, 0.25, {right:"-50%", ease:Power2.easeOut});
                    TweenLite.to($rsContent, 0.4, {opacity:"1", delay:0.2, ease:Power2.easeOut});
                    console.log("Copy Hidden");
              });

              //Check for clicks outside the parent element to close copy container
              $(document).on('click', function(event) {
                if (!$(event.target).closest('#copyContainer').length) {
                    $(".closeContent").addClass("is--hidden");
                    $(".closeContent").removeClass("is--active");
                    $(".openContent").addClass("is--active");
                    $(".openContent").removeClass("is--hidden");
                    TweenLite.to($copyContainer, 0.25, {right:"-50%", ease:Power2.easeOut});
                    TweenLite.to($rsContent, 0.4, {opacity:"1", delay:0.2, ease:Power2.easeOut});
                    console.log("Copy Hidden");
                }
              });

          })();

          (function animateScrollNavLabels(){

              $(".scrollNav__list__item").hover(
                function() {
                  TweenLite.to($(this).find(".scrollNav__list__item__label"), 0.25, {css: {right:50, 'opacity' : 1, 'z-index':9}, ease:Quad.easeOut});
                  console.log("Label Active");
                },
                function() {
                  TweenLite.to($(this).find(".scrollNav__list__item__label"), 0.25, {css: {right:5, 'opacity' : 0, 'z-index': 6}, ease:Quad.easeOut});
                  console.log("Label Hidden");
                }
              );
          })();

          (function addClassTo(){
            $(".box-container").addClass("scroll-pane");
          })();

          (function initScrollPane(){

            $('.scroll-pane').each(
              function()
              {
                $(this).jScrollPane(
                  {
                    autoReinitialise: true,
                    showArrows:true,
                    verticalDragMinHeight: 80,
                    verticalDragMaxHeight: 200
                  }
                );
                var api = $(this).data('jsp');
                var throttleTimeout;
                $(window).bind(
                  'resize',
                  function()
                  {
                    // IE fires multiple resize events while you are dragging the browser window which
                    // causes it to crash if you try to update the scrollpane on every one. So we need
                    // to throttle it to fire a maximum of once every 50 milliseconds...
                    if (!throttleTimeout) {
                      throttleTimeout = setTimeout(
                        function()
                        {
                          api.reinitialise();
                          throttleTimeout = null;
                        },
                        50
                      );
                    }
                  }
                );
              }
            );

          })();

      }
  })
  .register('screen and (min-width: 320px) and (max-width: 1030px)', {
      match : function () {
          console.log("global small devices matched");

          //Remove Following elements from DOM
          (function removeFromDOM(){
            $("div").remove("#locationMap");
            $(".box-container").removeClass("scroll-pane");
          })();


      },
      unmatch : function(){

      }
  });

}); /* end of as page load scripts */
