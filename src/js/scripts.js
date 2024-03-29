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

    if ($("span.lazy").length) {
      $("span.lazy").lazyload({ });
      $("span.lazy").lazyload({
        event: "filter",
      });
    }

    if ($("div.lazy").length) {
      $("div.lazy").lazyload({ });
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
    if ($("iframe").length && $(".l-container-w-side").length) {
      var $embeds = $("iframe");
      var $fluidEl;
      if ($(".l-container-w-side").length) {
        $fluidEl = $(".l-container-w-side");
      } else {
        $fluidEl = $("body");
      }

      // Figure out and save aspect ratio for each video
      $embeds.each(function() {

        $(this)
          .data("aspectRatio", $(this).attr("height") / $(this).attr("width"))
          // and remove the hard coded width/height
          .removeAttr("height")
          .removeAttr("width");

      });

      // When the window is resized
      $(window).resize(function() {
        // Resize all videos according to their own aspect ratio
        var newWidth = $fluidEl.width();

        $embeds.each(function() {

          var $el = $(this);
          $el
            .width(newWidth)
            .height(newWidth * $el.data("aspectRatio"));

        });

        // Kick off one resize to fix all videos on page load
      }).resize();
    }

    /**************************************************
      Video Sizing Full Screen for Home Page
     **************************************************/

      // Find all embedded content
      if ($("#home-hero").length) {
        var $video = $("iframe");

        var videoAspect = $video.attr("height") / $video.attr("width");

        $video
          .removeAttr("height")
          .removeAttr("width");


        // When the window is resized
        $(window).resize(function() {
          // Resize all videos according to their own aspect ratio
          var windowAspectRatio = $(window).height() / $(window).width();
          if (windowAspectRatio < videoAspect) {
            // Window wider than video
            var newWidth = $(window).width();

            $video
              .width(newWidth)
              .height(newWidth * videoAspect);
          } else {
            // Window taller than video
            var newHeight = $(window).height();

            $video
              .width(newHeight / videoAspect)
              .height(newHeight);
          }


          // Kick off one resize to fix all videos on page load
        }).resize();

      }

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
        new WipeScroll(".timelapse");
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
    Project Content Filter
   **************************************************/

  if ( $(".js-filter").length ){
    new ProjectContentFilter();
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

    /***********************************************************
      Single Project Page Hide Voice and Show Image as Scroll Down
      ************************************************************/

    if ($("#voice-heading").length) {
      var headerHeight = $("#header-bar").outerHeight();
      var fromTop = $("#voice-heading").offset().top;
      var fromHeader = fromTop - headerHeight - 20;

      $(window).scroll(function(){
        var scrolled = $(window).scrollTop();
        if ( fromHeader <= scrolled ) {
          $("#voice-heading").find(".overlay").addClass("is-hidden");
        } else {
          $("#voice-heading").find(".overlay").removeClass("is-hidden");
        }
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
      self.lazyloadThumbs();
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
  lazyloadThumbs: function(){
    $("span.lazy").trigger("filter");
  },

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

var WipeScroll = function(containers){
  this.containers = containers;
  this.groups = [];
  this.setContainers(containers);
  this.setHeights();
  this.stackImages();
  this.addInstructions();
  this.bindHandlers();
};

(function() {
  this.setContainers = function(containers){
    var self = this;
    self.$containers = $(containers);

    self.$containers.each(function(){
      self.groups.push({
        $container: $(this),
        $scrollContainer: $(this).find(".scroll-container"),
        $dummyContent: $(this).find(".dummy-content"),
        $imageStack: $(this).find(".image-stack"),
        $images: $(this).find(".image"),
        height: $(this).find("img").first().height(),
        aspect: $(this).find("img").first().height() / $(this).find("img").first().width(),
        numImages: $(this).find(".image").length,
      });
    });
  };

  this.setHeights = function(){
    var self = this;

    self.groups.forEach(function(element){
      element.$container.height(element.height);
      element.$scrollContainer.height(element.height);
      element.$dummyContent.height(element.height * element.numImages);
    });
  };

  this.stackImages = function(){
    var self = this;

    self.groups.forEach(function(element){
      element.$images.each(function(i){
        $(this).css("z-index", element.numImages - i);
      });
    });
  };

  this.addInstructions = function(){
    var self = this;

    self.groups.forEach(function(element){
      element.$scrollContainer.css("z-index", element.numImages + 1);
    });
  };

  this.updateScroll = function(el){
    var $container = el.$container;
    $container.find(".overlay").addClass("scrolled");
    var scrollPosition = el.$scrollContainer.scrollTop();
    var slideNumber = Math.floor(scrollPosition / el.height);
    var slideScrollPosition = scrollPosition - slideNumber * el.height;

    el.$images.eq(slideNumber).css("height", el.height - slideScrollPosition);

    scrollPosition <= 0 && ($container.find(".overlay").removeClass("scrolled"));

    if ( slideNumber > 0 ) {
      el.$images.eq(slideNumber - 1).css("height", 0);
    }

    if ( slideNumber < el.numImages ) {
      el.$images.eq(slideNumber + 1).css("height", el.height);
    }

  };

  this.bindHandlers = function(){
    var self = this;

    self.groups.forEach(function(el){
      el.$scrollContainer.on("scroll", function(){
        self.updateScroll(el);
      });
    });

    $(window).resize(function(){
      self.setContainers(self.containers);
      self.setHeights();
    });
  };
}).call(WipeScroll.prototype);

/***********************************************************
  Make All Words Start With an Uppercase Letter
 ************************************************************/

String.prototype.toProperCase = function () {
  return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
};



function ProjectContentFilter(){
  this.filters = $(".js-filter");
  this.labels = this.filters.find("label");

  this.bindHandlers();
}

(function() {
  this.bindHandlers = function(){
    var self = this;
    this.filters.on("change", "input", function(){
      self.syncForms(this);
      self.formatLabels();
      self.filterContent();
      self.scrollToTop();
    });
  };

  this.syncForms = function(el){
    this.studio = $(el).val();
    this.selected = this.filters.find("input[value=" + this.studio + "]");
    this.selected.prop("checked", true);
  };

  this.formatLabels = function(){
    this.labels.removeClass("selected");
    var selectedLabels = this.selected.closest("label");
    selectedLabels.addClass("selected");
  };

  this.filterContent = function(){
    var content = $(".l-content-module");
    content.removeClass("is-hidden");
    content.not($("." + this.studio)).addClass("is-hidden");
  };

  this.scrollToTop = function(){
    var self = this;
    var headerHeight = $("#header-bar").height();
    $("html, body").animate({
        scrollTop: (self.filters.first().offset(headerHeight).top )
    }, 500);
  };
}).call(ProjectContentFilter.prototype);
