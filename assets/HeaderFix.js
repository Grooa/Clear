/**
 * Shows the header on scroll. Nothing fancy.
 */
$(document).ready(function () {
	'use strict';

	var $header = $('header');
	var visible = false;

	// Fixed style messes up management
	if (ip.isManagementState) {
		$header.removeClass('hidden');
		return;
	}

	// Add class to header
	$header.addClass('header-fix hidden');


	function updateMenu() {
		var v = window.scrollY > window.innerHeight / 10;

		// May not need any update
		if (v == visible) {
			return;
		}

		$header[v ? 'removeClass' : 'addClass']('hidden');
		visible = v;
	}

	// Register listener
	window.addEventListener('scroll', updateMenu);

	// Update before scrolling
	updateMenu();
});
