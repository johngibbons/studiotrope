/* jshint devel: true */

(function( root, $, undefined ) {
  "use strict";

  $(function () {

    // JQuery Document Ready


    /**************************************************
      Lazy loading for project images
     **************************************************/

    if ($("img.lazy").length) {
      $("img.lazy").lazyload({
        effect: "fadeIn",
        threshold: 400
      });
    }

    /**************************************************
      Mobile Navigation Sliding Menu
     **************************************************/

    $("html").on("click", "#nav-toggle, #nav-open-overlay", function() {
      $("#nav-toggle").toggleClass("close");
      $("body").toggleClass("is-pushed");
      $("#nav-mobile").toggleClass("is-hidden");
    });

    /**************************************************
      Video Sizing Responsive to Container Size
     **************************************************/

    // Find all embedded content
    var $embeds = $("iframe");

    // Figure out and save aspect ratio for each video
    $embeds.each(function() {

      $(this)
        .data("aspectRatio", this.height / this.width)

        // and remove the hard coded width/height
        .removeAttr("height")
        .removeAttr("width");

    });

    // When the window is resized
    $(window).resize(function() {
      // Resize all videos according to their own aspect ratio
      var windowRatio = $(window).height() / $(window).width();

      $embeds.each(function() {

        var $el = $(this);
        var $container = $el.closest("div");

        if ($el.data("aspectRatio") < windowRatio) {
          $container.css({"width": "auto", "height": "100%" });
          var newHeight = $container.height();

          $el
            .height(newHeight)
            .width(newHeight / $el.data("aspectRatio"));
        } else {
          $container.css({"width": "100%", "height": "auto" });
          var newWidth = $container.width();

          $el
            .width(newWidth)
            .height(newWidth * $el.data("aspectRatio"));

        }

      });

      // Kick off one resize to fix all videos on page load
    }).resize();

    /**************************************************
      Projects Index Filter
     **************************************************/

    if ( $("#projects-filter").length ) {
      checkboxFilter.init("#projects-filter", "#projects-index");
      initFilter("#projects-filter", "#projects-index");

      //Projects Filter
      $("#projects-index").mixItUp({
        animation: {
          enable: false
        },
        callbacks: {
          onMixLoad: function(){
            $(this).mixItUp("setOptions", {
              load: {
                filter: "none"
              },
              animation: {
                enable: true,
                duration: 400,
                effects: "fade stagger(30ms) translateX(10%)",
                easing: "ease",
                reverseOut: true
              },
            });
          }
        },
        controls: {
          enable: false
        }
      });
    }


    /**************************************************
      Single Project Timelapse Module
     **************************************************/
    $(window).on("load", function(){
      if ( $(".timelapse").length ) {
        wipeScroll.init(".timelapse");
      }
    });

    /**************************************************
      Tropers Index Filter
     **************************************************/


    if ( $("#tropers-filter").length ) {

      checkboxFilter.init("#tropers-filter", "#people-index");
      initFilter("#tropers-filter", "#people-index");

      //Tropers Filter
      $("#people-index").mixItUp({
        animation: {
          enable: false
        },
        callbacks: {
          onMixLoad: function(){
            $(this).mixItUp("setOptions", {
              load: {
                filter: "none"
              },
              animation: {
                enable: true,
                duration: 400,
                effects: "fade stagger(30ms) translateX(10%)",
                easing: "ease",
                reverseOut: true
              },
            });
          }
        },
        controls: {
          enable: false
        }
      });

    }


    /**************************************************
      Projects Index Image/Voice Toggle
     **************************************************/

    $("#toggle-voice").on("click", function(){

      $(this).addClass("is-selected");
      $("#toggle-images").removeClass("is-selected");
      $(".project-thumb").addClass("is-hidden");
      $(".project-voice-thumb").removeClass("is-hidden");
      $(".mix h3").addClass("is-dark");

    });

    $("#toggle-images").on("click", function(){

      $(this).addClass("is-selected");
      $("#toggle-voice").removeClass("is-selected");
      $(".project-voice-thumb").addClass("is-hidden");
      $(".project-thumb").removeClass("is-hidden");
      $(".mix h3").removeClass("is-dark");

    });

  /**************************************************
    Project Voice Text Sizing to Fill Container
   **************************************************/

  if ( $(".project-voice-thumb").length ){

    $(".project-voice-thumb").each(function(){

      $(this).textfill({
        maxFontPixels: -1,
        changeLineHeight: true,
      });

    });
  }

  if ($(".project-voice").length){

    $(".project-voice").textfill({
      maxFontPixels: -1,
    });

  }

  /**************************************************
    Troper Name shows on hover
    **************************************************/

  if ( $("#troper-name").length ) {
    $(".troper-thumb").mouseenter(function(){
      $("#troper-name").text($(this).data("troperName")).addClass("is-shown");
    }).mouseleave(function(){
      $("#troper-name").removeClass("is-shown");
    });
  }

    /**************************************************
      Tooltip voice description
      **************************************************/
  
  if ( $("#thumbnail-toggle .tooltip").length ) {
    $("#thumbnail-toggle .fa").on("click", function(){
      $("#thumbnail-toggle .tooltip").toggleClass("is-shown");
    });
  }

    /**************************************************
      Scripts Based on Window Width
     **************************************************/

    var screenWidth = $(window).width();

    if (screenWidth > 768) {

      // Scripts to only apply on Desktop

      /**************************************************
        Resize Sidebar on Load so that it takes up full height
       **************************************************/

      $(window).on("load", function() {

        var $sidebarHeight = $(".contextual-module").outerHeight();
        var $contentHeight = $(".l-wrapper").outerHeight();
        var $windowHeight = $(window).height();

        if($sidebarHeight < $windowHeight) {

          if($headerHeight + $contentHeight < $windowHeight) {
            $(".contextual-module").outerHeight($contentHeight);
          } else {
            $(".contextual-module").outerHeight($windowHeight);
          }

          $(document.body).trigger("sticky_kit:recalc");

        }

      });

      /**************************************************
        Sticky Sidebar
       **************************************************/

      var $headerHeight = $("#header-bar").outerHeight();

      $(".contextual-module").stick_in_parent({offset_top: $headerHeight});

      //fix sticky kit position relative bug
      $(window).scroll(function(){
        $(".is_stuck").closest("div").css("position", "static");
      });

      /**************************************************
        Sticky Profile Picture on Troper Profile
       **************************************************/

      if ( $("#troper-profile-picture").length ) {
        $("#troper-profile-picture").stick_in_parent({offset_top: $headerHeight + 20});
      }

      /**************************************************
        Header Hide on Scroll Down, Show on Scroll Up
       **************************************************/

//      $(window).scroll(
//
//          {
//            previousTop: 0
//          }, 
//
//          function () {
//
//            var currentTop = $(window).scrollTop();
//
//            // If Past Header Hide or Show Header Based on scroll direction
//            if( currentTop > $headerHeight ) {
//
//              if (currentTop < this.previousTop) {
//                // Show header if scroll up
//                $("#header-bar, .mobile-dropdown").addClass("show");
//              } else {
//                // Hide header if scroll down
//                $("#header-bar, .mobile-dropdown").removeClass("show");
//              }
//
//            } else if($(window).scrollTop() === 0) {
//              // Return to absolute positioning once at top of page
//              $("#header-bar, .mobile-dropdown").removeClass("show");
//
//            }
//
//            // Recalculate Previous Scroll Position
//            this.previousTop = currentTop;
//
//          });

      /***********************************************************
        Single Project Page Hide Voice and Show Image as Scroll Down
       ************************************************************/

      var speed = 10.5;
      var imageHeight = $(".featured-image").height();
      var initialOverlayOpacity = $("#voice-heading").find(".overlay").css("opacity");

      $(window).scroll(function(){

        var dist = $(window).scrollTop();
        var textOpacity = (imageHeight - speed * dist) / imageHeight;
        var overlayOpacity = initialOverlayOpacity * (imageHeight - speed * dist) / imageHeight;

        $(".project-voice").css("opacity", textOpacity);
        $("#voice-heading").find(".overlay").css("opacity", overlayOpacity);

      });

      // Prevent JShint from throwing unknown variable errors with GSAP
      /* global TimelineLite: false */
      /* jshint undef: true, unused: false */

      window.onload = function(){




        /***********************************************************
          Custom GSAP animations for The Collective Page
        ************************************************************/

        // Elements to be Animated
        var heading = $("collective-heading");
        var scrollInstr = $("#scrollInstr");
        var studiotropeText = $(".studiotrope-text");
        var pronunciation = $(".pronunciation");
        var definition = $(".definition");
        var firstParagraph = $(".first");
        var studioNames = $(".studio-name");
        var secondParagraph = $(".second");
        var collective = $("#collective");

        // Initialize TimelineLite in a paused state
        var tl = new TimelineLite();

        // Apply animations as user scrolls or clicks on navs in a paused state
        tl.from(heading, 0.3, {autoAlpha: 0})
          .from(studiotropeText, 0.3, {autoAlpha: 0})
          .from(pronunciation, 0.3, {autoAlpha: 0})
          .from(definition, 0.3, {autoAlpha: 0})
          .from(firstParagraph, 0.5, {top: "30rem", autoAlpha:0})
          .from(studioNames, 0.5, {autoAlpha:0} )
          .from(scrollInstr, 0.5, {autoAlpha:0} );

        //Animate based on slides rather than direct scrolling distance
        var lastScrollTop = 0;
        $(window).scroll(function(){
          var st = $(this).scrollTop();
          if (st > lastScrollTop){
            tl.play();
          } else {
            //tl.reverse();
          }
          lastScrollTop = st;
        });
      };

    } else {

      //  For Screens Tablet and Below Width Only

      /***********************************************************
        Mobile Dropdown Menu Functionality
       ************************************************************/

      $(".dropdown-button").click(function() {
        $(".dropdown-sublist-title").next().hide();
        $(".dropdown").slideToggle(100);
      });

      $(".dropdown-sublist-title").click(function() {
        $(this).next().slideToggle(100);
      });

      /***********************************************************
        Mobile Header Search Bar
       ************************************************************/

      var $searchOpen = $("#header-search").find(".search-submit");
      $searchOpen.addClass("open-btn");

      var setOpenEvent = function() {

        $(".open-btn").on("click", function(e) {
          e.preventDefault();
          $("#header-search").toggleClass("open");
          $("#header-search").find("input").focus();
        });

      };

      setOpenEvent();

      $("#header-search").on("click", ".close-btn", function() {
        $("#header-search").removeClass("open");
      });

      $("#header-search").keyup(function(e){
        if(e.which === 13){//Enter key pressed
            $("#header-search").find("form").submit();//Trigger search form submit
        }
      });

      /***********************************************************
        Auto height for mobile slides
       ************************************************************/

      if ($(".section").length) {
        $(".section").css("height", "auto");
        $(".fp-tableCell").css("height", "auto");
      }

      // End of Tablet and Below Screen Size Only
    }

    // End of Document Ready

  });

} ( this, jQuery ));

/***********************************************************
  Functions
 ************************************************************/

/***********************************************************
  Custom Projects Filter using Mixitup Plugin
 ************************************************************/

  var filterParams = {};
  var filterDescription = [];
  var initialDescription = $("#filter-description").text();

  var filterObjects = function() {

    // when filter applied, enable reset
    $("#filter-reset").attr("disabled", false);

    // Check Box for Applied Filters
    $(this).find("i").toggleClass("fa-square-o fa-check-square");

    // Set Up Filter Description Text
    var category = $(this).closest("fieldset").children("legend:first").text();
    var term = $(this).text();

    if(filterParams[category]) {
      if(filterParams[category].indexOf(term) > -1) { // check if value is already in array
        var index = filterParams[category].indexOf(term);
        filterParams[category].splice(index, 1);
      } else {
        filterParams[category].push(term);
      }
    } else {
      filterParams[category] = [term];
    }

    filterDescription = [initialDescription];
    var categories = Object.keys(filterParams);

    $.each(categories, function(index, value){
      if (filterParams[value].length > 0) {
        if (index > 0) {
          filterDescription.push(" and ");
        }
        filterDescription.push(" <span class='category'>" + value.toProperCase() + ": </span><span class='value'>");
        filterDescription.push(filterParams[value].join("</span> or <span class='value'>") + "</span>");
        $("#filter-description").html(filterDescription.join(""));
      } else {
        $("#filter-description").html(filterDescription.join(""));
      }
    });
    $("#filter-description").addClass("is-shown");

  };

  //Projects filter labeling and description behavior

  var initFilter = function(filter, container) {

      var checkedFilterItem = $(filter).find("input:checked + label");
      var uncheckedFilterItem = $(filter).find("input:not([disabled]) + label");
      if( checkedFilterItem.length ) {
        $("#filter-reset").click();
      }

      uncheckedFilterItem.click(filterObjects);

      //If No Filters Are Applied, Reset Disabled, Remove Description

      $(container).on("mixEnd", function(e, state){
        if (state.activeFilter === ".mix") {
          $("#filter-reset").attr("disabled", true);
          $("#filter-description").removeClass("is-shown");
        }
      });

      //Filter Resets Checkboxes, Description

      $("#filter-reset").click(function() {
        filterDescription = [];
        filterParams = {};
        $("#filter-description").removeClass("is-shown");
      });

  };

// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "checkboxFilter".

var checkboxFilter = {

  // Declare any variables we will need as properties of the object

  $filters: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: "",

  // The "init" method will run on document ready and cache any jQuery objects we will need.

  init: function(filter, container){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.

    self.$filters = $(filter);
    self.$reset = $("#filter-reset");
    self.$container = $(container);

    self.$filters.find("fieldset").each(function(){
      self.groups.push({
        $inputs: $(this).find("input"),
        active: [],
        tracker: false
      });
    });

    self.bindHandlers();
  },

  // The "bindHandlers" method will listen for whenever a form value changes. 

  bindHandlers: function(){
    var self = this;

    self.$filters.on("change", function(){
      self.parseFilters();
    });

    self.$reset.on("click", function(e){
      e.preventDefault();
      self.$filters[0].reset();
      $(this).attr("disabled", true);
      self.$filters.find("i").removeClass("fa-check-square").addClass("fa-square-o");
      self.parseFilters();
    });
  },

  // The parseFilters method checks which filters are active in each group:

  parseFilters: function(){
    var self = this;

    var pushActive = function(group){
      group.$inputs.each(function(){ 
        $(this).is(":checked") && group.active.push(this.value);
      });
    };

    // loop through each filter group and add active filters to arrays

    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = []; // reset arrays
      pushActive(group);
      group.active.length && (group.tracker = 0);
    }

    self.concatenate();
  },

  // The "concatenate" method will crawl through each group, concatenating filters as desired:

  concatenate: function(){
    var self = this,
    cache = "",
    crawled = false,
    checkTrackers = function(){
      var done = 0;

      for(var i = 0, group; group = self.groups[i]; i++){
        (group.tracker === false) && done++;
      }

      return (done < self.groups.length);
    },
    crawl = function(){
      for(var i = 0, group; group = self.groups[i]; i++){
        group.active[group.tracker] && (cache += group.active[group.tracker]);

        if(i === self.groups.length - 1){
          self.outputArray.push(cache);
          cache = "";
          updateTrackers();
        }
      }
    },
    updateTrackers = function(){
      for(var i = self.groups.length - 1; i > -1; i--){
        var group = self.groups[i];

        if(group.active[group.tracker + 1]){
          group.tracker++; 
          break;
        } else if(i > 0){
          group.tracker && (group.tracker = 0);
        } else {
          crawled = true;
        }
      }
    };

    self.outputArray = []; // reset output array

    do{
      crawl();
    }
    while(!crawled && checkTrackers());

    self.outputString = self.outputArray.join();

    // If the output string is empty, show all rather than none:

    !self.outputString.length && (self.outputString = "all"); 


    // ^ we can check the console here to take a look at the filter string that is produced

    // Send the output string to MixItUp via the "filter" method:

    if(self.$container.mixItUp("isLoaded")){
      self.$container.mixItUp("filter", self.outputString);
    }
  }
};

/**************************************************
  Timelapse module wiping effect
**************************************************/

var wipeScroll = {
  groups:  [],
  $containers: null,

  // Set up the initial variables
  init: function(containers){
    var self = this;

    self.$containers = $(containers);

    self.$containers.each(function(){
      self.groups.push({
        $container: $(this),
        $imageStack: $(this).find(".image-stack"),
        $images: $(this).find(".image"),
        height: $(this).find(".image").first().height(),
        numImages: $(this).find(".image").length,
      });
    });

    self.setHeights();
    self.stackImages();
    self.addInstructions();
    self.bindHandlers();
  },

  // Set the heights of each container based on image height
  setHeights: function(){
    var self = this;

    self.groups.forEach(function(element){
      element.$container.height(element.height);
      element.$imageStack.height(element.height * element.numImages);
    });
  },

  stackImages: function(){
    var self = this;

    self.groups.forEach(function(element){
      element.$images.each(function(i){
        $(this).css("z-index", element.numImages - i);
      });
    });
  },

  addInstructions: function(){
    var self = this;

    self.groups.forEach(function(element){
      element.$container.find(".overlay").css("z-index", element.numImages + 1);
    });
  },

  bindHandlers: function(){
    var self = this;

    self.groups.forEach(function(element){
      element.$container.on("scroll", function(){
        $(this).find(".overlay").addClass("scrolled");
        var scrollPosition = $(this).scrollTop();
        var slideNumber = Math.floor(scrollPosition / element.height);
        var slideScrollPosition = scrollPosition - slideNumber * element.height;

        element.$images.css("top", scrollPosition);
        element.$images.eq(slideNumber).css("height", element.height - slideScrollPosition);

        scrollPosition <= 0 && ($(this).find(".overlay").removeClass("scrolled"));

        if ( slideNumber > 0 ) {
          element.$images.eq(slideNumber - 1).css("height", 0);
        }

        if ( slideNumber < self.numImages ) {
          element.$images.eq(slideNumber + 1).css("height", element.height);
        }
      });
    });
  },

};

//var timelapseWipe = function(){
//
//  var timelapseContainers = $(".timelapse");
//
//  timelapseContainers.each(function() {
//    var images = $(this).find("img");
//    var imageHeight = images.first().height();
//    var imageNumber = images.length;
//
//    $(this).height(imageHeight);
//
//    var scrollContainer = $(this).find(".image-stack");
//    scrollContainer.height(imageHeight * imageNumber);
//
//    var imageWrappers = $(this).find(".image");
//    var i = imageNumber;
//    imageWrappers.each(function(){
//      $(this).css("z-index", i);
//      i--;
//    });
//
//    $(this).on("scroll", function(){
//      var scrollPosition = $(this).scrollTop();
//      var slideNumber = Math.floor(scrollPosition / imageHeight);
//      var slideScrollPosition = scrollPosition - slideNumber * imageHeight;
//
//      imageWrappers.css("top", scrollPosition);
//      imageWrappers.eq(slideNumber).css("height", imageHeight - slideScrollPosition);
//      if(slideNumber > 0) {
//        imageWrappers.eq(slideNumber - 1).css("height", 0);
//      }
//      if(slideNumber < imageNumber) {
//        imageWrappers.eq(slideNumber + 1).css("height", imageHeight);
//      }
//    });
//  });
//
//};
//
/***********************************************************
  Make All Words Start With an Uppercase Letter
 ************************************************************/

String.prototype.toProperCase = function () {
  return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
};


