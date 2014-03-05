$( document ).ready(function() {

	$( '.alert' ).hide();

	$( "#datepicker" ).datepicker({ 
		changeMonth: true,
	    changeYear: true,
		yearRange: "-115:-18",
	    maxDate: "-18Y",
	    minDate: "-115Y"
	});

	$( "#addSpecialization" ).on( "click", function(event) {
		$( "#specializationCont" ).append( '<div class="col-md-3"><input name="specialization[]" type="text" class="form-control" placeholder="Specialization"></div>' );
	});

	$('.detail_form').keypress(function(e) {
        if(e.which == 13) {
            $( "#edit_doctor" ).submit();
        }
    });

	$( '.doctor_edit' ).on( "click", function(event) {
		$( "#edit_doctor" ).submit();
	});

	$( "#add_clinic" ).on( "click", function(event) {
		window.location.replace("/doctor/clinic/");
	});

	$( "#add_credential" ).on( "click", function(event) {
		window.location.replace("/doctor/credential/");
	});

	$( '.alert_assoc' ).hide();

	$( "#newAssociationSubmit" ).on( "click", function(event) {
		var error = false;

		var assoc_name = $('#assoc_name').val();
		var assoc_tagline = $('#assoc_tagline').val();

		if( assoc_name == '' ) {
			$( '.alert.alert_assoc' ).html('Name must not be emptied!');
			$( '.alert.alert_assoc' ).show();

			error = true;
	        event.preventDefault();
	        event.stopPropagation();
		}

		if( !error ) {
			var url = '/association/add'

			$( '#form_holder' ).hide();
			$( '#loading_holder' ).show();

			$.ajax({
				type: "POST",
    	        dataType: 'json',
        	    url: url,
            	data: { assoc_name: assoc_name, assoc_tagline: assoc_tagline },
             	success: function (data) {
					$('#assoc_name').val('');
					$('#assoc_tagline').val('');

	      			$( '.alert-success.alert_assoc' ).html('Association Successfully Created!');
					$( '.alert-success.alert_assoc' ).show();
             	}
            }).done(function() {
				$( '#form_holder' ).show();
				$( '#loading_holder' ).hide();
			});
		}
	});

	$( ".removeAssociationButton" ).on( "click", function(event) {
		var association_id = $( this ).data('association-id');
		var url = '/association/remove_association';

		$( '.removeAssociation .form_holder' ).hide();
		$( '.removeAssociation .loading_holder' ).show();

		$( '#associationCont' + association_id ).hide();

		$.ajax({
			type: "POST",
	        dataType: 'json',
    	    url: url,
        	data: { association_id: association_id },
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

});