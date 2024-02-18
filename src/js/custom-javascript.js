// Add your custom JS here.
jQuery(document).ready(function($) {
  $('.share-this').on('click', function(event) {

    var smsElements = document.querySelectorAll('.a2a_s_sms');

	  // Loop through the selected elements
    smsElements.forEach(function(element) {
      console.log('found')
      // Get the parent element of each .a2a_s_sms element
      var parentElement = element.parentElement;

      // Add the class 'sms' to the parent element
      parentElement.classList.add('sms-share');
    });
  });


  // MEGA MENU FOR UNDERSTRAP
 //Center Mode Carousel

 var $navbarToggler = $('.navbar-toggler');
  var $navbarCollapse = $('.navbar-collapse');

  // Initialize a variable to keep track of the collapse state
  var isCollapsed = false;

  // Attach a click event handler to the navbar-toggler
  $navbarToggler.on('click', function() {
    // Toggle the .collapse-open class on the navbar-collapse element
    if (!isCollapsed) {
      $navbarCollapse.addClass('collapse-open').removeClass('collapse-close');
      isCollapsed = true;
    } else {
      $navbarCollapse.addClass('collapse-close').removeClass('collapse-open');
      isCollapsed = false;
    }
  });
 

 var sliderThresh = 20;
 $('.center-mode-carousel').slick({
  centerMode: true,
  slidesToShow: 1,
  dots:true,
  prevArrow: '<span class="prev-arrow"></span>',
  nextArrow: '<span class="next-arrow"></span>',
  appendArrows: '.slick-arrows-container',
  appendDots:'.slick-dots',
  centerPadding: '0px',
  touchThreshold: sliderThresh,
});





      $('.mega-menu-carrot').each(function() {

          $(this).on('click', function(event) {
             
            var submenu = $(this).siblings('.dropdown-pane');
              $('.expanded').css('max-height', '0');
              $('.expanded').css('opacity', '0');
              

            if (submenu.hasClass('expanded')) {
              // If submenu is expanded, collapse it
              submenu.css('max-height', '0');
              submenu.css('opacity', '0');
              submenu.removeClass('expanded');
            } else {
              // Calculate and set the exact max-height
              var exactHeight = submenu[0].scrollHeight + 'px';
              submenu.css('max-height', exactHeight);
              submenu.css('opacity', '1');
              submenu.addClass('expanded');
              return
            }
            $('.expanded').removeClass('expanded');
          });
      });
      

    // adjusts margin for the sticky header  
    function updateMarginTop() {
      var navHeight = $('#main-nav').outerHeight(); // Get the height of #main-nav
      $('.fixed-header-spacer').css('margin-top', navHeight + 'px'); // Set margin-top for .fixed-header-spacer
    }

    updateMarginTop(); // Call on initial load

    // Update on window resize
    $(window).on('resize', function() {
        updateMarginTop();
    });
  


    const accordions = Array.from(document.querySelectorAll('.ac-container'));
    new Accordion(accordions, {
        duration: 250,
    });
    var ua = navigator.userAgent;
    var htmlElement = document.documentElement;
  
    // Check for browsers
    if (/MSIE|Trident/.test(ua)) {
      htmlElement.classList.add('ie');
    } else if (/Chrome\//.test(ua)) {
      htmlElement.classList.add('chrome');
    } else if (/Firefox\//.test(ua)) {
      htmlElement.classList.add('firefox');
    } else if (/Safari\//.test(ua)) {
      htmlElement.classList.add('safari');
    } else if (/Edg\//.test(ua)) {
      htmlElement.classList.add('edge');
    }
  
    // Check for OS
    if (/Windows NT/.test(ua)) {
      htmlElement.classList.add('windows');
    } else if (/Mac OS X/.test(ua)) {
      htmlElement.classList.add('macos');
    } else if (/Linux/.test(ua)) {
      htmlElement.classList.add('linux');
    } else if (/Android/.test(ua)) {
      htmlElement.classList.add('android');
    } else if (/like Mac OS X/.test(ua)) {
      htmlElement.classList.add('ios');
    }
  })

  document.addEventListener('DOMContentLoaded', function() {

    const images = document.querySelectorAll('.wp-block-cover img, .hero--photo img, .icon-grid--icon img, .slick-slide img');
  
    images.forEach(img => {
        // Remove srcset attribute
        img.removeAttribute('srcset');
    });


   
    
    var anchorLinks = document.querySelectorAll('a[href^="#"]');

    // Function to handle anchor link clicks
    function handleAnchorLinkClick(event) {
        event.preventDefault(); // Prevent the default scroll behavior
        var targetId = this.getAttribute('href').substring(1); // Get the target element's ID
        var targetElement = document.getElementById(targetId); // Get the target element
        var navbarHeight = document.querySelector('.navbar').offsetHeight; // Get the navbar height
        var jumpLinksContainer = document.querySelector('.jump-links-container'); // Get the jump-links-container

        var jumpLinksContainerHeight = 0;
        if (jumpLinksContainer) {
            jumpLinksContainerHeight = jumpLinksContainer.offsetHeight; // Get the jump-links-container height
        }

        if (targetElement) {
            var targetPosition = targetElement.offsetTop - navbarHeight - jumpLinksContainerHeight; // Subtract both heights from the target position
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth' // Smooth scrolling animation
            });
        }
    }

    // Add click event listeners to all anchor links
    anchorLinks.forEach(function (link) {
        link.addEventListener('click', handleAnchorLinkClick);
    });

   
  })


