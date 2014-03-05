$( document ).ready(function() {

	$( '.alert' ).hide();

	$( "#newDoctorSubmit" ).on( "click", function(event) {
		var error = false;

		var doctorEmail = $('#doctorEmail').val();
		var doctorEmailRepeat = $('#doctorEmailRepeat').val();

		if( doctorEmail == '' || doctorEmailRepeat == '' ) {
			$( '.alert' ).html('Fields must not be emptied!');
			$( '.alert' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( $('#doctorEmail').val() != $('#doctorEmailRepeat').val() ) { 
			$( '.alert' ).html("Email Doesn't Match!");
			$( '.alert' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( !isValidEmailAddress( $('#doctorEmail').val() ) ) { 
			$( '.alert' ).html('Invalid Email!');
			$( '.alert' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( !isValidEmailAddress( $('#doctorEmailRepeat').val() ) ) { 
			$( '.alert' ).html('Invalid Email!');
			$( '.alert' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( !error ) {
			var url = '/manage/invite_doctor'

			$( '#form_holder' ).hide();
			$( '#loading_holder' ).show();

			$.ajax({
				type: "POST",
    	        dataType: 'json',
        	    url: url,
            	data: { doctorEmail: doctorEmail },
             	success: function (data) {
	      			$( '.alert-success' ).html('Email Successfully Sent!');
					$( '.alert-success' ).show();
             	}
            }).done(function() {
				$( '#form_holder' ).show();
				$( '#loading_holder' ).hide();
			});
		}
	});

	function isValidEmailAddress(emailAddress) {
	    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	    return pattern.test(emailAddress);
	};

});