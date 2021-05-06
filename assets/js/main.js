jQuery(function ($) {
	'use strict';
	/* global jQuery */

	$(window).on('htl_window_coupon_applied', function() {
		var input_classes = $('#hotelier-uncode-hidden-btn-classes');

		if (input_classes.length > 0) {
			var classes = input_classes.val();

			$('.reservation-table__room-remove').addClass(classes);
			$('.coupon-form').find('button').addClass(classes);
		}
	});
});
