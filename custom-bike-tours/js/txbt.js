jQuery(document).ready(function () {
    jQuery(".rental").click(function () {
        jQuery(".page-culinary").hide();
        jQuery(".page-assistance").hide();
        jQuery(".page-rentals").toggle();
    });
    jQuery(".cul").click(function () {
        jQuery(".page-assistance").hide();
        jQuery(".page-rentals").hide();
        jQuery(".page-culinary").toggle();
    });
    jQuery(".assistance").click(function () {
        jQuery(".page-rentals").hide();
        jQuery(".page-culinary").hide();
        jQuery(".page-assistance").toggle();
    });
    jQuery("#custom").click(function () {
        jQuery("#custom-tour-form").toggle();
    });
});


jQuery(function ($) {

	var datepickerInArgs = {
		minDate: 1,
		defaultDate: 0,
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
		onClose: function( dateText, inst ) {
			var d = $.datepicker.parseDate( inst.settings.dateFormat, dateText );
			d.setDate( d.getDate() + 1 );
			$( '.date-out input' )
				.val( $.datepicker.formatDate( inst.settings.dateFormat, d ) )
				.datepicker( 'option', {
				minDate: $.datepicker.formatDate( inst.settings.dateFormat, d )
			});
		}
	},
	datepickerOutArgs = {
		minDate: 'd',
		defaultDate: 'd',
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: false,
	};

	/**
	 * Reset datepicker fields with new arguments.
	 */
	function changeDatepickerArgs() {
		$( '.date-in input, .date-out input' ).datepicker( 'destroy' );

		$( '.date-in input' ).datepicker( datepickerInArgs );
		$( '.date-out input' ).datepicker( datepickerOutArgs );
	}

	$( document ).on( 'gform_post_render', changeDatepickerArgs );
});

//Thanks to Gary Jones https://github.com/garyjones for the code reveiew (and subsequent rewrite)