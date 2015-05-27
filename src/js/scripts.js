(function( root, $, undefined ) {
  "use strict";

  $(function () {

    $("html").on("click", "#nav-toggle, #nav-open-overlay", function() {
      $("#nav-toggle").toggleClass("close");
      $("body").toggleClass("is-pushed");
    });

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

    //Projects filter labeling and description behavior
    var filterParams = {};
    $("#projects-filter label").click(function(){
      $("#filter-reset").attr("disabled", false);
      $(this).find("i").toggleClass("fa-square-o fa-check-square");
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
      var filterDescription = Array("Nice filtering, now you're only seeing projects that match: ");
      var categories = Object.keys(filterParams);
      $.each(categories, function(index, value){
        console.log(filterParams[value]);
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
    });

    $("#projects-index").on("mixEnd", function(e, state){
      if (state.activeFilter === ".mix") {
        $("#filter-reset").attr("disabled", true);
      }
    });



    var $headerHeight = $("#header-bar").outerHeight();
    var currentTop = $(window).scrollTop();

    if(currentTop > 0) {
      $("#header-bar, .mobile-dropdown").addClass("show");
    }
    // Header hide/show on scroll
    $(window).scroll(
    {
        previousTop: 0
    }, 
    function () {
      // get current distance from top of viewport
        currentTop = $(window).scrollTop();
      // define the header height here
      // if user has scrolled past header, initiate the scroll up/scroll down hide show effect
      if( $(window).scrollTop() > $headerHeight ) {
        if (currentTop < this.previousTop) {
          $("#header-bar, .mobile-dropdown").addClass("show");
        } else {
          $("#header-bar, .mobile-dropdown").removeClass("show");
        }
      } else if($(window).scrollTop() === 0) {
        $("#header-bar, .mobile-dropdown").removeClass("show");
      }
    this.previousTop = currentTop;
});

    var screenWidth = $(window).width();
    if (screenWidth > 768) {

      $(window).on("load", function() {
        var $sidebarHeight = $(".contextual-module").outerHeight();
        var $contentHeight = $(".l-wrapper").outerHeight();
        var $windowHeight = $(window).height();

        if($sidebarHeight < $windowHeight) {
          if($headerHeight + $contentHeight < $windowHeight) {
            $(".contextual-module").outerHeight($contentHeight);
          } else {
            $(".contextual-module").outerHeight($windowHeight - $headerHeight);
          }
          $(document.body).trigger("sticky_kit:recalc");
        }

      });
      $(".contextual-module, .l-container-w-side").stick_in_parent({offset_top: $headerHeight});
    }
    //Mobile Only
      if (isMobile()) {
        // Dropdown for mobile filter
        $(function(){
          $(".dropdown-button").click(function() {
            $(".dropdown-sublist-title").next().hide();
            $(".filter").slideToggle(100);
          });

          $(".dropdown-sublist-title").click(function() {
            $(this).next().slideToggle(100);
          });
        });

        // Mobile Search Bar
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

      }
      else {
      }
 });

} ( this, jQuery ));

function isMobile() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

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

String.prototype.toProperCase = function () {
  return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
};
