/* jshint devel: true */

(function( root, $, undefined ) {
  "use strict";

  $(function () {

    // JQuery Document Ready

    /**************************************************
      Mobile Navigation Sliding Menu
     **************************************************/

    $("html").on("click", "#nav-toggle, #nav-open-overlay", function() {
      $("#nav-toggle").toggleClass("close");
      $("body").toggleClass("is-pushed");
    });

    /**************************************************
      Video Sizing Responsive to Container Size
     **************************************************/

    // Find all videos
    var $allVideos = $("iframe");

    // Figure out and save aspect ratio for each video
    $allVideos.each(function() {

      $(this)
        .data("aspectRatio", this.height / this.width)

        // and remove the hard coded width/height
        .removeAttr("height")
        .removeAttr("width");

    });

    // When the window is resized
    $(window).resize(function() {
      // Resize all videos according to their own aspect ratio
      $allVideos.each(function() {

        var $el = $(this);
        var newWidth = $el.closest(".video").width();

        $el
          .width(newWidth)
          .height(newWidth * $el.data("aspectRatio"));

      });

      // Kick off one resize to fix all videos on page load
    }).resize();

    /**************************************************
      Projects Index Filter Functionality
     **************************************************/

    checkboxFilter.init();

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

    var filterParams = {};
    var filterDescription = [];

    var filterProjects = function() {
    
        // When Filter Applied, Enable Reset
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

        filterDescription = ["Nice filtering, now you're only seeing projects that match: "];
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
    };

    //Projects filter labeling and description behavior

    if($("#projects-filter").length) {

      $("#projects-filter input:not([disabled]) + label").click(filterProjects);

      //If No Filters Are Applied, Reset Disabled, Remove Description

      $("#projects-index").on("mixEnd", function(e, state){
        if (state.activeFilter === ".mix") {
          $("#filter-reset").attr("disabled", true);
          $("#filter-description").html("");
        }
      });

      //Filter Resets Checkboxes, Description

      $("#filter-reset").click(function() {
        $("#projects-filter i").removeClass("fa-check-square").addClass("fa-square-o");
        $(this).attr("disabled", true);
        filterDescription = [];
        filterParams = {};
        $("#filter-description").html("");
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

  /***********************************************************
    Resize Text Based on Container Size
   ************************************************************/

  $.fn.resizeText = function () {
    var width = $(this).innerWidth();
    var height = $(this).innerHeight();
    var html =  $(this).html();
    var newElem = $("<div>", {
      html: html,
      style: "display: inline-block;overflow:hidden;font-size:0.1em;padding:0;margin:0;border:0;outline:0"
    });

    $(this).html(newElem);
    $.resizeText.increaseSize(1, 0.5, newElem, width, height);

    $(window).resize(function () {
      if ($.resizeText.interval) {
        clearTimeout($.resizeText.interval)

        $.resizeText.interval = setTimeout(function () {
          elem.html(elem.find("div.createdResizeObject").first().html());
          elem.resizeText();
        }, 300);
      }
    });
  };

  $.resizeText = {
    increaseSize: function (increment, start, newElem, width, height) {
      var fontSize = start;

      while (newElem.outerHeight() < height) {
        fontSize += increment;
        newElem.css("font-size", fontSize + "rem");
      }

      if (newElem.outerWidth() > width || newElem.outerHeight() > height) {
        fontSize -= increment;
        newElem.css("font-size", fontSize + "rem");
        if (increment > 0.1) {
          $.resizeText.increaseSize(increment / 10, fontSize, newElem, width, height);
        }
      }
    }
  };


  /**************************************************
    Project Voice Text Sizing to Fill Container
   **************************************************/

  if ($(".project-voice-thumb").length){

    $(".project-voice-thumb").each(function(){

      $(this).resizeText();

    });
  }

  if ($(".project-voice").length){

      $(".project-voice").resizeText();

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

      /**************************************************
        Header Hide on Scroll Down, Show on Scroll Up
       **************************************************/

      $(window).scroll(

          {
            previousTop: 0
          }, 

          function () {

            var currentTop = $(window).scrollTop();

            // If Past Header Hide or Show Header Based on scroll direction
            if( currentTop > $headerHeight ) {

              if (currentTop < this.previousTop) {
                // Show header if scroll up
                $("#header-bar, .mobile-dropdown").addClass("show");
              } else {
                // Hide header if scroll down
                $("#header-bar, .mobile-dropdown").removeClass("show");
              }

            } else if($(window).scrollTop() === 0) {
              // Return to absolute positioning once at top of page
              $("#header-bar, .mobile-dropdown").removeClass("show");

            }

            // Recalculate Previous Scroll Position
            this.previousTop = currentTop;

          });

      /***********************************************************
        Single Project Page Hide Voice and Show Image as Scroll Down
       ************************************************************/

      var speed = 2.5;
      var imageHeight = $(".featured-image").height();
      var initialOverlayOpacity = $("#voice-heading").find(".overlay").css("opacity");

      $(window).scroll(function(){

        var dist = $(window).scrollTop();
        var textOpacity = (imageHeight - speed * dist) / imageHeight;
        var overlayOpacity = initialOverlayOpacity * (imageHeight - speed * dist) / imageHeight;

        $(".project-voice").css("opacity", textOpacity);
        $("#voice-heading").find(".overlay").css("opacity", overlayOpacity);

      });

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

      // End of Tablet and Below Screen Size Only
    }

    // End of Document Ready

  });

} ( this, jQuery ));

// Prevent JShint from throwing unknown variable errors with GSAP

/* jshint undef: true, unused: false */
/* global TimelineLite: false */

window.onload = function(){



  /***********************************************************
    Custom GSAP animations for The Collective Page
   ************************************************************/

  // Elements to be Animated
  var scrollInstr = $("#scrollInstr");
  var studiotropeText = $(".studiotrope-text");
  var pronunciation = $(".pronunciation");
  var definition = $(".definition");
  var firstParagraph = $(".first");
  var studioNames = $(".studio-name");
  var secondParagraph = $(".second");
  var collective = $("#collective");
  var architecture = $("#architecture");
  var graphics = $("#graphic-design");
  var interiors = $("#interiors");

  // Initialize TimelineLite in a paused state
  var tl = new TimelineLite({paused: true});

  // Apply animations as user scrolls or clicks on navs in a paused state
  tl.to(scrollInstr, 0.3, {left: "20rem", autoAlpha: 0})
    .from(studiotropeText, 0.3, {left: "20rem", autoAlpha: 0})
    .from(pronunciation, 0.3, {left: "20rem", autoAlpha: 0})
    .from(definition, 0.3, {left: "20rem", autoAlpha:0})
    .addLabel("collective")
    .addPause()
    .from(firstParagraph, 0.3, {top: "30rem", autoAlpha:0})
    .staggerFrom(studioNames, 1, {top: "30rem", autoAlpha:0}, 0.25)
    .from(secondParagraph, 1, {autoAlpha:0}, "+=0.5")
    .addPause()
    .to(collective, 0.3, {left: "20rem", autoAlpha: 0})
    .call(changeSlide, ["collective"])
    .addLabel("architecture")
    .call(changeSlide, ["architecture"])
    .from(architecture, 0.3, {left: "-20rem", autoAlpha: 0}, "+=0.75")
    .addPause()
    .call(changeSlide, ["architecture"])
    .to(architecture, 0.3, {left: "20rem", autoAlpha: 0})
    .addLabel("graphics")
    .call(changeSlide, ["graphics"])
    .from(graphics, 0.3, {left: "-20rem", autoAlpha: 0}, "+=0.75")
    .addPause()
    .call(changeSlide, ["graphics"])
    .to(graphics, 0.3, {left: "20rem", autoAlpha: 0})
    .addLabel("interiors")
    .call(changeSlide, ["interiors"])
    .from(interiors, 0.3, {left: "-20rem", autoAlpha: 0}, "+=0.75");

  var $window = $(window);
  var windowHeight = $window.height();
  var scrollTop = $window.scrollTop();

  //Animate based on amount scrolled directly
  $window.on("resize", function(){
    windowHeight = $window.height();
  }).resize();

  $window.on("scroll", function() {
    scrollTop = $(window).scrollTop();
    // var scrollPercent = (scrollTop) / (documentHeight - windowHeight);

    //tl.progress(scrollPercent).pause()
  });

  //Animate based on slides rather than direct scrolling distance
  var lastScrollTop = 0;
  $(window).scroll(function(){
    var st = $(this).scrollTop();
    if (st > lastScrollTop){
      tl.play();
    } else {
      tl.reverse();
    }
    lastScrollTop = st;
  });

  //Show current slide on sidebar navigation
  function changeSlide(slide) {
    var slideSelector = "." + slide + "-link";
    $("li").removeClass("current");
    $(slideSelector).addClass("current");
  }

  //Sidebar slide navigation functionality
  $("body").on("click", ".slide-link", function(){
    var s = ($(this).attr("class"));
    var n = s.indexOf("-");
    s = s.substring(0, n);
    changeSlide(s);
    tl.play(s);
  });

};
/***********************************************************
  Functions
 ************************************************************/

/***********************************************************
  Custom Projects Filter using Mixitup Plugin
 ************************************************************/

// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "checkboxFilter".

var checkboxFilter = {

  // Declare any variables we will need as properties of the object

  $filters: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: "",

  // The "init" method will run on document ready and cache any jQuery objects we will need.

  init: function(){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.

    self.$filters = $("#projects-filter");
    self.$reset = $("#filter-reset");
    self.$container = $("#projects-index");

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

/***********************************************************
  Make All Words Start With an Uppercase Letter
 ************************************************************/

String.prototype.toProperCase = function () {
  return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
};


