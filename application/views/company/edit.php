<div id="doctorEditPg" class="container woqee_container">

  <div class="content_doctor_view">
    <div class="content_header">
      General Information
    </div>

    <div class="doctor_profile">
      <?php echo form_open( '/doctor/edit/', array('id' => 'edit_doctor') ) ; ?>

      <?php if ( !empty($success) ) : ?>
        <?php if ( $success == 'added' ) : ?>
            <div class="alert alert-success">You're Info Succesfully Added</div>
        <?php else : ?>
            <div class="alert alert-success">You're Info Succesfully Updated</div>
        <?php endif ; ?>
      <?php endif ; ?>

      <?php if ( !empty($message) ) : ?>
      <div class="alert alert-danger"><?php echo $message ; ?></div>
      <?php endif ; ?>

      <div class="form-group">
        <div class="col-md-3">
          <input name="fname" type="text" class="detail_form form-control" placeholder="First Name" value="<?php echo $doctorInfo['a_fname'] ; ?>">
        </div>
        <div class="col-md-3">
          <input name="mname" type="text" class="detail_form form-control" placeholder="Middle Name" value="<?php echo $doctorInfo['a_mname'] ; ?>">
        </div>
        <div class="col-md-3">
          <input name="lname" type="text" class="detail_form form-control" placeholder="Last Name" value="<?php echo $doctorInfo['a_lname'] ; ?>">
        </div>

        <div class="clr"></div>

        Change my password

        <div class="clr"></div>

        <div class="col-md-3">
          <input name="password" type="password" class="detail_form form-control" placeholder="New Password">
        </div>

        <div class="col-md-3">
          <input name="repassword" type="password" class="detail_form form-control" placeholder="Repeat New Password">
        </div>

        <div class="clr"></div>

        <div class="col-md-3">
          <div id="specializationCont">
            <?php if( !empty($doctor_specialization) ) : ?>
              <?php foreach( $doctor_specialization as $key => $val ) : ?>
                <input name="specialization[]" type="text" class="detail_form form-control" placeholder="Specialization" value="<?php echo $val['ds_desc'] ; ?>">
              <?php endforeach ; ?>
            <?php else : ?>
              <input name="specialization[]" type="text" class="detail_form form-control" placeholder="Specialization">
            <?php endif ; ?>
          </div>

          <div id="addSpecialization" class="woqee_button">+</div>
        </div>

        <div class="clr"></div>

        <div class="col-md-3">
          <input name="premed" type="text" class="detail_form form-control" placeholder="" value="<?php echo !empty($doctor_detail) ? $doctor_detail['dd_premed'] : '' ; ?>">
          PRE-MED
        </div>
        <div class="col-md-3">
          <input name="medicine" type="text" class="detail_form form-control" placeholder="" value="<?php echo !empty($doctor_detail) ? $doctor_detail['dd_medicine'] : '' ; ?>">
          MEDICINE
        </div>
        <div class="col-md-3">
          <input name="residency" type="text" class="detail_form form-control" placeholder="" value="<?php echo !empty($doctor_detail) ? $doctor_detail['dd_residency'] : '' ; ?>">
          RESIDENCY
        </div>

        <div class="clr"></div>

        <div class="woqee_button doctor_edit">Save</div>

      </div>

      <?php echo form_close() ; ?>
    </div>

    <div class="clr"></div>

    <span class="content_header2">
      Clinic Practices
    </span>

    <span class="content_header2">
      Member Associations
    </span>

    <div class="clr"></div>

    <div class="doctor_profile2">
      <div class="woqee_button">Add a Clinic</div>
    </div>

    <div class="doctor_profile2 doctor_profile3">
      <div data-reveal-id="myAssociation" class="woqee_button">Create Association</div>
    </div>

    <div class="content_header">
      Additional Credential
    </div>

    <div class="doctor_profile">
      Additional Credential
    </div>

    <div class="clr"></div>
  </div>

</div> <!-- /container -->

<div id="myAssociation" class="reveal-modal">
  <div class="manage_info_top">
    Create an Association
  </div>

  <div class="manage_info_form">
    <form class="form-horizontal" role="form">
      <div class="alert alert_assoc alert-danger"></div>
      <div class="alert alert_assoc alert-success"></div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Name*</label>
        <div class="col-sm-10">
          <input id="assoc_name" type="text" class="form-control" placeholder="Name">
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Tagline / Header</label>
        <div class="col-sm-10">
          <textarea id="assoc_tagline" class="form-control" placeholder="Tagline / Header"></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div id="newAssociationSubmit" class="woqee_button">Save</div>
          <button type="submit" class="btn btn-default">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<link rel="stylesheet" href="/assets/css/reveal.css"> 
<script type="text/javascript" src="/assets/js/jquery.reveal.js"></script>