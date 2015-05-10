(function( root, $, undefined ) {
	"use strict";

	$(function () {
		$("button").attr("aria-label", "Toggle Navigation").on("click", function() {
			$(this).toggleClass("close");
			$(".l-wrapper, .lines-button").toggleClass("is-pushed");
		});
	});

} ( this, jQuery ));