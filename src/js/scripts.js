(function( root, $, undefined ) {
	"use strict";

	$(function () {

		$("[aria-label='Toggle Navigation']").on("click", function() {
			$(this).toggleClass("close");
			$(".l-wrapper, .lines-button").toggleClass("is-pushed");
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

  		  var newWidth = $el.closest(".project-video").width();

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

		//Projects AJAX Filter
		// 	var $filterLink = $(".projects-filter").find("a");
		// 	$(document).on("click", $filterLink, function(e){
		// 		e.preventDefault();

		// 		$.ajax({
		// 			url: stProjectsFilter.ajaxurl,
		// 			type: "post",
		// 			data: {
		// 				action: "projects_filter",
		// 				query_vars: stProjectsFilter.query_vars
		// 			},
		// 			success: function( result ) {
		// 				$("main").find("article").remove();
		// 				$("main").append( result );
		// 			}
		// 		})

		// 	});
		});

} ( this, jQuery ));


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
 
    // loop through each filter group and add active filters to arrays
    
    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = []; // reset arrays
      group.$inputs.each(function(){ 
        $(this).is(":checked") && group.active.push(this.value);
      });
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
    
    //console.log(self.outputString); 
    
    // ^ we can check the console here to take a look at the filter string that is produced
    
    // Send the output string to MixItUp via the "filter" method:
    
	  if(self.$container.mixItUp("isLoaded")){
    	self.$container.mixItUp("filter", self.outputString);
	  }
  }
};