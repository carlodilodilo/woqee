$( document ).ready(function() {

	$( '.alert' ).hide();

	$( "#completeRegister" ).on( "click", function(event) {
		var error = false;

		var cp_id = $('#cp_id').val();

		var fname = $('#fname').val();
		var mname = $('#mname').val();
		var lname = $('#lname').val();

		var password   = $('#password').val();
		var repassword = $('#repassword').val();

		if( fname == '' || lname == '' || password == '' || 
			repassword == '' ) {
			$( '.alert' ).html('Fields must not be emptied!');
			$( '.alert-danger' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( password != repassword ) { 
			$( '.alert' ).html("Password and Re-Password Doesn't Match!");
			$( '.alert-danger' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( !error ) {
			var url = '/company/completion';

			$( '#form_holder' ).hide();
			$( '#loading_holder' ).show();

			$.ajax({
				type: "POST",
    	        dataType: 'json',
        	    url: url,
            	data: { cp_id: cp_id, fname: fname, mname: mname, 
            		lname: lname, password: password },
             	success: function (data) {
					$( '#success_holder' ).show();
					$( '#loading_holder' ).hide();
             	}
            }).done(function() {
				$( '#form_holder' ).hide();
				$( '#loading_holder' ).hide();
			});
		}
	});

	function isValidEmailAddress(emailAddress) {
	    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	    return pattern.test(emailAddress);
	};

});