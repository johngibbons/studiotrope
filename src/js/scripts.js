(function( root, $, undefined ) {
	"use strict";

	$(function () {

		$("button").attr("aria-label", "Toggle Navigation").on("click", function() {
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
	});

} ( this, jQuery ));

