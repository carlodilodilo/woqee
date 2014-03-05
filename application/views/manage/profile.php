<style>
  body {
    background-color: #FFF;
  }
</style>

<div id="manageDoctorPg" class="container woqee_container2">

  <div class="manage_info_cont">
    <div class="manage_info_top">
      <div class="manage_info_img">
        <img src="/assets/images/phpthumb.php?zc=1&amp;q=100&amp;h=55&amp;w=55&amp;far=1&amp;src=admin/<?php echo $admin_info['a_photo'] ; ?>" />
      </div>
      <span>
        <?php echo $admin_info['a_fname'] ; ?>
        <?php echo $admin_info['a_mname'] ; ?>
        <?php echo $admin_info['a_lname'] ; ?>
        &nbsp;<a href="/manage/profile" class="clr glyphicon glyphicon-pencil"></a>
      </span>
    </div>

    <div class="manage_info_company">
      <span><?php echo $company_info['company_name'] ; ?></span>
      <p><?php echo $admin_info['at_desc'] ; ?></p>
    </div>

    <div id="manage_doctors" class="manage_info_content_mini">
      <span>
        <a href="/manage/doctors"><?php echo $company_info['company_total_doctors'] ; ?></a>
      </span>
      <p>Registered Doctors</p>
    </div>

    <div id="manage_officer" class="manage_info_content_mini no_left_border">
      <span>
        <a href="/manage/officer"><?php echo $company_info['company_total_ioc'] ; ?></a>
      </span>
      <p>Officers and Admins</p>
    </div>

    <div id="manage_doctor" class="manage_info_content">
      <span class="single"><a href="/manage/doctor">Doctor Registration</a></span>
    </div>

    <?php if ( $admin_info['a_type'] == '1' ) : ?>
    <div id="manage_registration" class="manage_info_content no_bottom_border">
      <span class="single"><a href="/manage/registration">Registration Period Manager</a></span>
    </div>
    <?php endif ; ?>
  </div>

  <div class="manage_info_cont2">

    <?php if ( !empty($current_event) ) : ?>

    <div class="manage_info_top">
      Registration is Open
    </div>

    <div class="manage_info_form">

      <div id="loading_holder" style="display: none;">
        <img src="/assets/images/ajax_loading.gif" />
      </div>

      <div id="form_holder">
        <div class="alert alert-danger"></div>
        <div class="alert alert-success"></div>

        <input id="doctorEmail" name="email" type="email" class="form-control" placeholder="Doctor's Email Address" required>
        <input id="doctorEmailRepeat" name="email2" type="email" class="form-control" placeholder="Repeat Doctor's Email Address" required>

        <div id="newDoctorSubmit" class="woqee_button">Submit</div>

        <p>The registration must be authenticated through email within 3 hours after it has been submitted.</p>
      </div>
    </div>

    <?php else : ?>

    <div class="manage_info_form expired_event">

    <div class="doctor_profile">
        <div id="loading_holder" style="display: none;">
          <img src="/assets/images/ajax_loading.gif" />
        </div>

        <div id="form_holder" class="edit_admin_info">

          <?php if( !empty($success) ) : ?>
            <div class="alert alert-danger"></div>
          <?php endif ; ?>

          <?php if( !empty($success) ) : ?>
            <div class="alert alert-success"></div>
          <?php endif ; ?>

          <div class="form-group">
            <?php echo $admin_info['a_email'] ; ?>
          </div>

          <div class="form-group">
            <div class="admin_info_img">
              <img src="/assets/images/phpthumb.php?zc=1&amp;q=100&amp;h=75&amp;w=75&amp;far=1&amp;src=admin/<?php echo $admin_info['a_photo'] ; ?>" />
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-4">
              <input value="<?php echo $admin_info['a_fname'] ; ?>" id="fname" name="fname" type="text" class="form-control" placeholder="First Name">
            </div>
            <div class="col-md-4">
              <input value="<?php echo $admin_info['a_mname'] ; ?>" id="mname" name="mname" type="text" class="form-control" placeholder="Middle Name">
            </div>
            <div class="col-md-4">
              <input value="<?php echo $admin_info['a_lname'] ; ?>" id="lname" name="lname" type="text" class="form-control" placeholder="Last Name">
            </div>
          </div>
   
          <div class="form-group">
            <div class="col-md-12">
              <input id="password" name="password" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="col-md-12">
              <input id="repassword" name="repassword" type="password" class="form-control" placeholder="Repeat Password">
            </div>
          </div>

          <div class="clr"></div>

          <div id="completeRegister" class="woqee_button">Submit</div>
        </div>
      </div>

    <?php endif ; ?>

  </div>

</div> <!-- /container -->