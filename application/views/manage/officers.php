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

    <div id="manage_officer" class="manage_info_content_mini no_left_border active">
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
    <div class="manage_info_top">
      <?php echo $company_info['company_name'] ; ?> Officers
    </div>

    <?php if( $success == 'success' ) : ?>
      <div class="alert alert-success" style="margin: 40px 0 0 0; display: block !important;">Company Admin Succesfully Created.</div>
    <?php endif; ?>

    <?php if ( $admin_info['a_type'] == '1' ) : ?>
    <div class="manage_info_form event_manager">
      <div data-reveal-id="myModal" class="woqee_button">Add Officer</div>

      &nbsp;&nbsp;Add a new company officer for <?php echo $company_info['company_name'] ; ?>
    </div>
    <?php endif ; ?>

    <div class="top_border">
    </div>

    <?php if ( !empty($compay_officers) ) : ?>
    <?php foreach ( $compay_officers as $key => $val ) : ?>

    <div id="officerCont<?php echo $val['a_id'] ; ?>" class="officer_cont <?php echo ( $key == 0 ) ? 'top_border' : '' ?>">
      <?php $a_photo =  !empty($val['a_photo']) ? $val['a_photo'] : 'default_doctor.png' ; ?>
      <img src="/assets/images/phpthumb.php?zc=1&amp;q=100&amp;h=80&amp;w=80&amp;far=1&amp;src=admin/<?php echo $a_photo ; ?>" />

      <div class="title">
          <?php echo $val['a_fname'] ; ?>&nbsp;
          <?php echo ( !empty($val['a_mname']) ) ? $val['a_mname'].'&nbsp;' : '' ; ?>
          <?php echo $val['a_lname'] ; ?>
      </div>
      <div>
        <?php if ( $val['a_type'] == '1' ) : ?>
          Company Administator
        <?php else : ?>
          Company Officer
        <?php endif ; ?>
      </div>

      <?php if ( $admin_info['a_type'] == '1' && $val['a_id'] != $admin_info['a_id'] ) : ?>
        <div class="message" data-reveal-id="removeOfficer<?php echo $val['a_id'] ; ?>" data-id="<?php echo $val['a_id'] ; ?>">Remove</div>
      <?php endif ; ?>
    </div>

    <div id="removeOfficer<?php echo $val['a_id'] ; ?>" class="myModal reveal-modal">
      <div class="manage_info_top">
        Remove Company Officer
      </div>

      <div class="manage_info_form removeOfficer">

        <div class="alert alert-success"></div>

        <div class="loading_holder" style="display: none;">
          <img src="/assets/images/ajax_loading.gif" />
        </div>

        <div class="form_holder">
          <form class="form-horizontal" role="form">
            <div class="alert alert-danger"></div>

            <div class="form-group">
              Are you sure you want to remove 
              <b>
                <?php echo $val['a_fname'] ; ?>&nbsp;<?php echo ( !empty($val['a_mname']) ) ? $val['a_mname'].'&nbsp;' : '' ; ?><?php echo $val['a_lname'] ; ?>
              </b>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div data-officer-id="<?php echo $val['a_id'] ; ?>" class="removeOfficerButton woqee_button">Confirm</div>
                <div class="woqee_button cancel">Cancel</div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach ; ?>
    <?php endif ; ?>

  </div>

</div> <!-- /container -->

<div id="myModal" class="reveal-modal myModal">
  <div class="manage_info_top">
    Create Company Admin/Officer
  </div>

  <div class="manage_info_form">

    <div id="loading_holder" style="display: none;">
      <img src="/assets/images/ajax_loading.gif" />
    </div>

    <div id="form_holder">
      <form class="form-horizontal" role="form">
        <div class="alert alert-danger"></div>
        <div class="alert alert-success"></div>

        <input id="officerEmail" name="email" type="email" class="whole_block form-control" placeholder="Officer's Email Address" required>
        <input id="officerEmailRepeat" name="email2" type="email" class="whole_block form-control" placeholder="Repeat Officer's Email Address" required>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div id="newOfficerSubmit" class="woqee_button">Confirm</div>
            <div class="woqee_button cancel">Cancel</div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<link rel="stylesheet" href="/assets/css/reveal.css"> 
<script type="text/javascript" src="/assets/js/jquery.reveal.js"></script>