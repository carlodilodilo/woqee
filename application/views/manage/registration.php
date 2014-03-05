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
    <div id="manage_registration" class="manage_info_content no_bottom_border active">
      <span class="single"><a href="/manage/registration">Registration Period Manager</a></span>
    </div>
    <?php endif ; ?>
  </div>

  <div class="manage_info_cont2">
    <div class="manage_info_top">
      Manage Company Registration Periods
    </div>

    <?php if( !empty($eventMessage) ) : ?>
      <div class="alert alert-success" style="margin: 50px 0 0 0; display: block !important;">
        <?php if ( $eventMessage == 'edit' ) : ?>
          Event Successfully Updated
        <?php else : ?>
          Event Successfully Added
        <?php endif ; ?>
      </div>
    <?php endif; ?>

    <div class="manage_info_form event_manager">
      <div data-reveal-id="myModal" id="newDoctorSubmit" class="woqee_button">Create New</div>

      &nbsp;&nbsp;Add a new Registration Period
    </div>

    <?php if ( !empty($company_events) ) : ?>
    <?php foreach ( $company_events as $key => $val ) : ?>
    <div class="event_cont top_border">
      <div class="title"><?php echo $val['e_name'] ; ?></div>
      <div><?php echo date( 'F j, Y', strtotime($val['e_date']) ) ; ?></div>
      <div>
        <?php echo date( 'g:i A', strtotime($val['e_start']) ) ; ?> - <?php echo date( 'g:i A', strtotime($val['e_end']) ) ; ?></div>
      <div class="change" data-reveal-id="editEvent<?php echo $val['e_id'] ; ?>">Change</div>
    </div>

      <div  id="editEvent<?php echo $val['e_id'] ; ?>" class="reveal-modal myModal officerModal">
        <div class="manage_info_top">
          Create Registration Period
        </div>

        <div class="manage_info_form">
          <form class="form-horizontal" role="form">
            <div class="alert alert-danger"></div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Name of Event</label>
              <div class="col-sm-10">
                <input value="<?php echo $val['e_name'] ; ?>" id="name_event<?php echo $val['e_id'] ; ?>" type="text" class="form-control" id="inputEmail3" placeholder="Name of Event">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Date of Event</label>
              <div class="col-sm-10">
                <input value="<?php echo date( 'F j, Y', strtotime($val['e_date']) ) ; ?>" id="date_event<?php echo $val['e_id'] ; ?>" type="text" class="date_event form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Start Time</label>
              <div class="col-sm-10">
                <input value="<?php echo date( 'g:i A', strtotime($val['e_start']) ) ; ?>" id="start_event<?php echo $val['e_id'] ; ?>" type="text" class="start_event form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">End Time</label>
              <div class="col-sm-10">
                <input value="<?php echo date( 'g:i A', strtotime($val['e_end']) ) ; ?>" id="end_event<?php echo $val['e_id'] ; ?>" type="text" class="end_event form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div data-event-id="<?php echo $val['e_id'] ; ?>" class="editEventSubmit woqee_button">Save</div>
                <div class="woqee_button cancel">Cancel</div>
              </div>
            </div>
          </form>
        </div>
      </div>
    <?php endforeach ; ?>
    <?php endif ; ?>

  </div>

</div> <!-- /container -->

<div id="myModal" class="reveal-modal myModal">
  <div class="manage_info_top">
    Create Registration Period
  </div>

  <div class="manage_info_form">
    <form class="form-horizontal" role="form">
      <div class="alert alert-danger"></div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Name of Event</label>
        <div class="col-sm-10">
          <input id="name_event" type="text" class="form-control" id="inputEmail3" placeholder="Name of Event">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Date of Event</label>
        <div class="col-sm-10">
          <input id="date_event" type="text" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Start Time</label>
        <div class="col-sm-10">
          <input id="start_event" type="text" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">End Time</label>
        <div class="col-sm-10">
          <input id="end_event" type="text" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div id="newEventSubmit" class="woqee_button">Save</div>
          <div class="woqee_button cancel">Cancel</div>
        </div>
      </div>
    </form>
  </div>
</div>

<link rel="stylesheet" href="/assets/css/reveal.css"> 
<link rel="stylesheet" href="/assets/css/jquery.timepicker.css"> 
<link rel="stylesheet" href="/assets/css/default.css"> 
<script type="text/javascript" src="/assets/js/jquery.reveal.js"></script>
<script type="text/javascript" src="/assets/js/jquery.timepicker.js"></script>
<script type="text/javascript" src="/assets/js/zebra_datepicker.js"></script>