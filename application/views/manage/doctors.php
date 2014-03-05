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

    <div id="manage_doctors" class="manage_info_content_mini active">
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
    <div class="manage_info_top">
      Doctors Registered by <?php echo $company_info['company_name'] ; ?>
    </div>

    <div class="manage_info_form event_manager">
      <div class="form-group">
        <div class="col-sm-10">
          <input style="text-align: left; margin-left: 100px;" id="search_doctor" type="text" class="form-control" placeholder="Seach for a Doctor">
        </div>
      </div>
    </div>

    <div class="doctors_holder">

      <?php foreach ( $company_doctors as $company_doctor ) : ?>
      <a target="_blank" href="/doctor/view/<?php echo strtolower($company_doctor['a_lname']); ?>">
        <div class="doctors_cont">
          <?php $a_photo =  !empty($company_doctor['a_photo']) ? $company_doctor['a_photo'] : 'default_doctor.png' ; ?>
          <img src="/assets/images/phpthumb.php?zc=1&amp;q=100&amp;h=92&amp;w=100&amp;far=1&amp;src=admin/<?php echo $a_photo ; ?>" />
          <div class="surename">
            <?php echo $company_doctor['a_lname'] ; ?>
          </div>
        </div>
      </a>
      <?php endforeach ; ?>

    </div>

    <div class="top_border">
    </div>

    <?php if ( !empty($compay_officers) ) : ?>
    <?php foreach ( $compay_officers as $key => $val ) : ?>

    <div class="officer_cont <?php echo ( $key == 0 ) ? 'top_border' : '' ?>">
      <img src="/assets/images/phpthumb.php?zc=1&amp;q=100&amp;h=80&amp;w=80&amp;far=1&amp;src=admin/<?php echo $val['a_photo'] ; ?>" />

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
      <div class="message" data-id="<?php echo $val['a_id'] ; ?>">Message</div>
    </div>

    <?php endforeach ; ?>
    <?php endif ; ?>

  </div>

</div> <!-- /container -->

<div id="myModal" class="reveal-modal">
  <div class="manage_info_top">
    Create Company Admin/Officer
  </div>

  <div class="manage_info_form">
    <form class="form-horizontal" role="form">
      <div class="alert alert-danger"></div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input id="email" type="text" class="form-control" placeholder="Email">
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Admin Type</label>
        <div class="col-sm-10">
          <select id="type" class="form-control">
            <option value="1">Admin</option>
            <option value="2">Officer</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
        <div class="col-sm-10">
          <input id="fname" type="text" class="form-control" placeholder="First Name">
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Middle Name</label>
        <div class="col-sm-10">
          <input id="mname" type="text" class="form-control" placeholder="Middle Name">
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
        <div class="col-sm-10">
          <input id="lname" type="text" class="form-control" placeholder="Last Name">
        </div>
      </div>

      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
          <input id="password" type="password" class="form-control">
        </div>
      </div>

      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Re-Password</label>
        <div class="col-sm-10">
          <input id="repassword" type="password" class="form-control">
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div id="newOfficerSubmit" class="woqee_button">Save</div>
          <button type="submit" class="btn btn-default">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<link rel="stylesheet" href="/assets/css/reveal.css"> 
<script type="text/javascript" src="/assets/js/jquery.reveal.js"></script>