
$( document ).ready(function() {

	$( '.clinic_button' ).on( "click", function(event) {
		$( "#clinic_form" ).submit();
	});

	$('.clinic_time').timepicker({ 'timeFormat': 'g:i a', 'step': 30 });

});