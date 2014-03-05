$( document ).ready(function() {

	$( "#manage_doctor" ).on( "click", function(event) {
		window.location.replace("/manage/doctor/");
	});

	$( "#manage_doctors" ).on( "click", function(event) {
		window.location.replace("/manage/doctors/");
	});

	$( "#manage_registration" ).on( "click", function(event) {
		window.location.replace("/manage/registration/");
	});

	$( "#manage_officer" ).on( "click", function(event) {
		window.location.replace("/manage/officer/");
	});

	$( ".woqee_button.cancel" ).on( "click", function(event) {
		$('.myModal').trigger('reveal:close')
	});

});