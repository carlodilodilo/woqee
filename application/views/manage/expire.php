<style>
  body {
    background-color: #FFF;
  }
</style>

<div id="manageDoctorPg" class="container woqee_container2">

  <div class="manage_info_cont">
    <div class="manage_info_top">
      <div class="manage_info_img">
        <img src="/assets/images/admin/<?php echo $admin_info['a_photo'] ; ?>" />
      </div>
      <span>
        <?php echo $admin_info['a_fname'] ; ?>
        <?php echo $admin_info['a_mname'] ; ?>
        <?php echo $admin_info['a_lname'] ; ?>
      </span>
    </div>

    <div class="manage_info_company">
      <span><?php echo $company_info['company_name'] ; ?></span>
      <p><?php echo $admin_info['at_desc'] ; ?></p>
    </div>

    <div class="manage_info_content_mini">
      <span>
        <a href="/manage/doctor"><?php echo $company_info['company_total_doctors'] ; ?></a>
      </span>
      <p>Registered Doctors</p>
    </div>

    <div class="manage_info_content_mini no_left_border">
      <span><?php echo $company_info['company_total_ioc'] ; ?></span>
      <p>Officers and Admins</p>
    </div>

    <div class="manage_info_content">
      <span class="single"><a href="/manage/doctor">Doctor Registration</a></span>
    </div>

    <?php if ( $admin_info['a_type'] == '1' ) : ?>
    <div id="manage_registration" class="manage_info_content no_bottom_border active">
      <span class="single"><a href="/manage/registration">Registration Period Manager</a></span>
    </div>
    <?php endif ; ?>
  </div>

  <div class="manage_info_cont2">
    <div class="manage_info_expire">
      <div>
        Registration is Currently Closed
        <br />
        Next opening 6 days, 23:26:11 away
      </div>
    </div>
  </div>

</div> <!-- /container -->