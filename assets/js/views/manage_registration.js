$( document ).ready(function() {

	$( '.alert' ).hide();

	$('#date_event').Zebra_DatePicker({ direction: 1, readonly_element: false });
	$('#start_event').timepicker({ 'timeFormat': 'g:i a', 'step': 30 });
	$('#end_event').timepicker({ 'timeFormat': 'g:i a', 'step': 30 });

	$('.date_event').Zebra_DatePicker({ direction: 1, readonly_element: false });
	$('.start_event').timepicker({ 'timeFormat': 'g:i a', 'step': 30 });
	$('.end_event').timepicker({ 'timeFormat': 'g:i a', 'step': 30 });

	$( "#newEventSubmit" ).on( "click", function(event) {
		var error = false;

		var name_event  = $('#name_event').val();
		var date_event  = $('#date_event').val();
		var start_event = $('#start_event').val();
		var end_event   = $('#end_event').val();

		if( name_event == '' || date_event == '' || 
			start_event == '' || end_event == '' ) {
			$( '.alert' ).html('Fields must not be emptied!');
			$( '.alert' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( !error ) {
			var url = '/event/add'

			$( '#form_holder' ).hide();
			$( '#loading_holder' ).show();

			$.ajax({
				type: "POST",
    	        dataType: 'json',
        	    url: url,
            	data: { name_event: name_event, date_event: date_event, start_event: start_event, end_event: end_event },
             	success: function (data) {
					window.location.replace("/manage/registration/success");
             	}
            }).done(function() {
				$( '#form_holder' ).show();
				$( '#loading_holder' ).hide();
			});
		}
	});

	$( ".editEventSubmit" ).on( "click", function(event) {
		var event_id = $( this ).data('event-id');
		var error = false;

		var name_event  = $('#name_event' + event_id).val();
		var date_event  = $('#date_event' + event_id).val();
		var start_event = $('#start_event' + event_id).val();
		var end_event   = $('#end_event' + event_id).val();

		if( name_event == '' || date_event == '' || 
			start_event == '' || end_event == '' ) {
			$( '.alert' ).html('Fields must not be emptied!');
			$( '.alert' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( !error ) {
			var url = '/event/edit'

			$( '#form_holder' ).hide();
			$( '#loading_holder' ).show();

			$.ajax({
				type: "POST",
    	        dataType: 'json',
        	    url: url,
            	data: { event_id: event_id, name_event: name_event, date_event: date_event, start_event: start_event, end_event: end_event },
             	success: function (data) {
					window.location.replace("/manage/registration/success");
             	}
            }).done(function() {
				$( '#form_holder' ).show();
				$( '#loading_holder' ).hide();
			});
		}
	});

});