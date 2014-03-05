<div id="doctorEditPg" class="container woqee_container">

  <div class="content_doctor_view">
    <div class="manage_info_top">
        Registration - <?php echo $doctor_registration['dr_email'] ; ?>
    </div>

    <div class="doctor_profile">
      <?php if ( $exist ) : ?>
        You are already registered - <?php echo $doctor_registration['dr_email'] ; ?>
        <a href="/">Login</a>
      <?php else : ?>
        <div id="success_holder" style="display: none;">
          You are already registered - <?php echo $doctor_registration['dr_email'] ; ?>
          <a href="/">Login</a>
        </div>

        <div id="loading_holder" style="display: none;">
          <img src="/assets/images/ajax_loading.gif" />
        </div>

        <div id="form_holder">

          <div class="alert alert-danger"></div>
          <div class="alert alert-success"></div>

          <input id="dr_id" type="hidden" value="<?php echo $doctor_registration['dr_id'] ; ?>">

          <div class="form-group">
            <div class="col-md-3">
              <input id="fname" name="fname" type="text" class="form-control" placeholder="First Name">
            </div>
            <div class="col-md-3">
              <input id="mname" name="mname" type="text" class="form-control" placeholder="Middle Name">
            </div>
            <div class="col-md-3">
              <input id="lname" name="lname" type="text" class="form-control" placeholder="Last Name">
            </div>
          </div>
   
          <div class="form-group">
            <div class="col-md-3">
              <input id="password" name="password" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="col-md-3">
              <input id="repassword" name="repassword" type="password" class="form-control" placeholder="Repeat Password">
            </div>
          </div>
          <div id="completeRegister" class="woqee_button">Submit</div>
        </div>
      <?php endif ; ?>
    </div>

  </div>

</div> <!-- /container -->