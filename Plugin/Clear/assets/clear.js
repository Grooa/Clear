
(function ($) {
	$('.ipWidget-Accordion .trigger').on('click', function (event) {
		event.preventDefault();
		$(event.target).parent().toggleClass('expanded');

	});
})(jQuery);
