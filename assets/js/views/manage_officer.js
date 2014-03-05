$( document ).ready(function() {

	$( '.alert' ).hide();

	$( ".removeOfficerButton" ).on( "click", function(event) {
		var officer_id = $( this ).data('officer-id');
		var url = '/company/remove_officer';

		$( '.form_holder' ).hide();
		$( '.loading_holder' ).show();

		$( '#officerCont' + officer_id ).hide();

		$.ajax({
			type: "POST",
	        dataType: 'json',
    	    url: url,
        	data: { officer_id: officer_id },
         	success: function (data) {
         		if(data.success) {
					$( '.alert-success' ).html('Succesfully Removed');
					$( '.alert-success' ).show();
         		}
         	}
        }).done(function() {
			$( '.form_holder' ).hide();
			$( '.loading_holder' ).hide();
		});
	});

	$( "#newOfficerSubmit" ).on( "click", function(event) {
		var error = false;

		var officerEmail = $('#officerEmail').val();
		var officerEmailRepeat = $('#officerEmailRepeat').val();

		if( officerEmail == '' || officerEmailRepeat == '' ) {
			$( '.alert-danger' ).html('Fields must not be emptied!');
			$( '.alert-danger' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
	        return false;
		}

		if( officerEmail != officerEmailRepeat ) { 
			$( '.alert-danger' ).html("Email Doesn't Match!");
			$( '.alert-danger' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
	        return false;
		}

		if( !isValidEmailAddress( officerEmail ) ) { 
			$( '.alert-danger' ).html('Invalid Email!');
			$( '.alert-danger' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
	        return false;
		}

		if( !isValidEmailAddress( officerEmailRepeat ) ) { 
			$( '.alert-danger' ).html('Invalid Email!');
			$( '.alert-danger' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
	        return false;
		}

		if( !error ) {
			var url = '/company/add_officer';

			$( '#form_holder' ).hide();
			$( '#loading_holder' ).show();

			$.ajax({
				type: "POST",
    	        dataType: 'json',
        	    url: url,
            	data: { officerEmail: officerEmail },
             	success: function (data) {
             		if(!data.success) {
						$( '.alert-danger' ).html(data.message);
						$( '.alert-danger' ).show();
             		}

             		if(data.success) {
						$( '.alert-success' ).html('Email Succesfully Sent');
						$( '.alert-success' ).show();

						$('#officerEmail').val('');
						$('#officerEmailRepeat').val('');
             		}
             	}
            }).done(function() {
				$( '#form_holder' ).show();
				$( '#loading_holder' ).hide();
			});
		}
	});

	/* $( "#newOfficerSubmit" ).on( "click", function(event) {
		var error = false;

		var email = $('#email').val();
		var type  = $('#type').val();
		var fname = $('#fname').val();
		var mname = $('#mname').val();
		var lname = $('#lname').val();

		var password   = $('#password').val();
		var repassword = $('#repassword').val();

		if( email == '' || type == '' || 
			fname == '' || lname == '' || password == '' || 
			repassword == '' ) {
			$( '.alert' ).html('Fields must not be emptied!');
			$( '.alert' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( !isValidEmailAddress( email ) ) { 
			$( '.alert' ).html('Invalid Email!');
			$( '.alert' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( password != repassword ) { 
			$( '.alert' ).html("Password and Re-Password Doesn't Match!");
			$( '.alert' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( !error ) {
			var url = '/account/add';

			$( '#form_holder' ).hide();
			$( '#loading_holder' ).show();

			$.ajax({
				type: "POST",
    	        dataType: 'json',
        	    url: url,
            	data: { email: email, type: type, 
            		fname: fname, mname: mname, 
            		lname: lname, password: password },
             	success: function (data) {
             		if(data.success) {
						window.location.replace("/manage/officer/success");
             		}

             		if(!data.success) {
						$( '.alert' ).html(data.message);
						$( '.alert' ).show();
             		}
             	}
            }).done(function() {
				$( '#form_holder' ).show();
				$( '#loading_holder' ).hide();
			});
		}
	});  */

	function isValidEmailAddress(emailAddress) {
	    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	    return pattern.test(emailAddress);
	};

});