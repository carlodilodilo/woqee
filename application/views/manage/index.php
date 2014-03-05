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

    <div id="manage_doctor" class="manage_info_content active">
      <span class="single"><a href="/manage/doctor">Doctor Registration</a></span>
    </div>

    <?php if ( $admin_info['a_type'] == '1' ) : ?>
    <div id="manage_registration" class="manage_info_content no_bottom_border">
      <span class="single"><a href="/manage/registration">Registration Period Manager</a></span>
    </div>
    <?php endif ; ?>
  </div>

  <div class="manage_info_cont2">

    <?php if ( 1 || !empty($current_event) ) : ?>

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
        <img src="/assets/images/logo.png" />
        <h4>Registration is Currently Closed</h4>

        <?php if( !empty($upcoming_events) ) : ?>
          <?php 
            $event_time = $upcoming_events['e_date'] . $upcoming_events['e_start'] ;

            $datetime1 = new DateTime();
            $datetime2 = new DateTime( $event_time );
            $interval = $datetime1->diff($datetime2);
            $next_event = $interval->format('%a days, %h:%i:%S');
          ?>
          <h4>Next opening <span><?php echo $next_event ; ?></span> away</h4>
        <?php endif ; ?>
    </div>    

    <?php endif ; ?>

    <div class="manage_info_top top_border">
      <span class="title">
        Pending Registrations
      </span>
      <span class="content">
        Time Left
      </span>
    </div>

    <?php if ( !empty($doctors_registrations) ) : ?>
    <?php foreach ( $doctors_registrations as $key => $val ) : ?>
      <div class="manage_info_content bottom_border">
        <div class="title">
          <?php echo $val['dr_email'] ; ?>
        </div>
        <div class="status pending">
          <?php if ( $val['dr_status'] == 'pending' ) : ?>
            Pending Acceptance
          <?php else : ?>
            <?php echo $val['dr_dateupdated'] ; ?>
          <?php endif ; ?>
        </div>

        <span class="content">

          <?php if ( $val['dr_status'] == 'pending' ) : ?>
            <?php 
              $time_expiration = date( "M d Y H:i:s", strtotime( $val['dr_dateadded'] . ' + 3 hours' ) );

              $datetime1 = new DateTime();
              $datetime2 = new DateTime( $time_expiration );
              $interval = $datetime1->diff($datetime2);
              $time_left = $interval->format('%h:%i:%S');

              if ( $datetime1 > $datetime2 ) {
                $time_left = "Expired";
              }

              echo $time_left;
            ?>
          <?php else : ?>
            Registered
          <?php endif ; ?>
        </span>
      </div>
    <?php endforeach ; ?>
    <?php endif ; ?>

  </div>

</div> <!-- /container -->