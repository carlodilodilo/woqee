<div id="doctorEditPg" class="container woqee_container">

  <div class="content_doctor_view">

    <!-- Clinic Form Contanier -->
    <div class="general_info_cont">

      <div class="content_header">
        Create Clinic Information
      </div>

      <div class="doctor_profile">
        <?php echo form_open( '/doctor/clinic/'.$clinic_id, array('id' => 'clinic_form') ) ; ?>

        <div class="clinic_label_cont">
          <div class="clinic_label">
            <span>Set this address of this clinic:</span>
          </div>

          <div class="clinic_label">
            <span>Set the schedule of this clinic:</span>
            <br />
            <span>Select the days you hold clinic hours in this specific clinic then set the starting and end time of each day</span>
          </div>

          <div class="clinic_label">
            <span>Set the contact number of your new clinic:</span>
          </div>
        </div>

          <span>Clinic Sched:</span>
          <div class="clr"></div>

          <?php if ( !empty($message) ) : ?>
            <div class="alert alert-danger"><?php echo $message ; ?></div>
          <?php endif ; ?>

          <input name="mon" type="checkbox" <?php echo !empty($clinic_data_days) && in_array( 'mon', $clinic_data_days )  ? 'checked' : '' ; ?> />
          <span class="clinic_days">Every Monday</span>
          <input name="mon_from" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'mon', $clinic_data_days )  ? $clinic_data_days_time['mon']['from'] : '' ; ?>" /> 
          to 
          <input name="mon_to" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'mon', $clinic_data_days )  ? $clinic_data_days_time['mon']['to'] : '' ; ?>" />
          <div class="clr"></div>

          <input name="tue" type="checkbox" <?php echo !empty($clinic_data_days) && in_array( 'tue', $clinic_data_days )  ? 'checked' : '' ; ?> />
          <span class="clinic_days">Every Tuesday</span>
          <input name="tue_from" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'tue', $clinic_data_days )  ? $clinic_data_days_time['tue']['from'] : '' ; ?>" />
          to 
          <input name="tue_to" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'tue', $clinic_data_days )  ? $clinic_data_days_time['tue']['to'] : '' ; ?>" />
          <div class="clr"></div>

          <input name="wed" type="checkbox" <?php echo !empty($clinic_data_days) && in_array( 'wed', $clinic_data_days )  ? 'checked' : '' ; ?> />
          <span class="clinic_days">Every Wednesday</span>
          <input name="wed_from" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'wed', $clinic_data_days )  ? $clinic_data_days_time['wed']['from'] : '' ; ?>" />
          to 
          <input name="wed_to" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'wed', $clinic_data_days )  ? $clinic_data_days_time['wed']['to'] : '' ; ?>" />
          <div class="clr"></div>
  
          <input name="thurs" type="checkbox" <?php echo !empty($clinic_data_days) && in_array( 'thurs', $clinic_data_days )  ? 'checked' : '' ; ?> />
          <span class="clinic_days">Every Thursday</span>
          <input name="thurs_from" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'thurs', $clinic_data_days )  ? $clinic_data_days_time['thurs']['from'] : '' ; ?>" />
          to 
          <input name="thurs_to" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'thurs', $clinic_data_days )  ? $clinic_data_days_time['thurs']['to'] : '' ; ?>" />
          <div class="clr"></div>

          <input type="checkbox" name="fri" <?php echo !empty($clinic_data_days) && in_array( 'fri', $clinic_data_days )  ? 'checked' : '' ; ?> />
          <span class="clinic_days">Every Friday</span>
          <input name="fri_from" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'fri', $clinic_data_days )  ? $clinic_data_days_time['fri']['from'] : '' ; ?>" />
          to 
          <input name="fri_to" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'fri', $clinic_data_days )  ? $clinic_data_days_time['fri']['to'] : '' ; ?>" />
          <div class="clr"></div>

          <input type="checkbox" name="sat" <?php echo !empty($clinic_data_days) && in_array( 'sat', $clinic_data_days )  ? 'checked' : '' ; ?> />
          <span class="clinic_days">Every Saturday</span>
          <input name="sat_from" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'sat', $clinic_data_days )  ? $clinic_data_days_time['sat']['from'] : '' ; ?>" />
          to 
          <input name="sat_to" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'sat', $clinic_data_days )  ? $clinic_data_days_time['sat']['to'] : '' ; ?>" />
          <div class="clr"></div>

          <input type="checkbox" name="sun" <?php echo !empty($clinic_data_days) && in_array( 'sun', $clinic_data_days )  ? 'checked' : '' ; ?> />
          <span class="clinic_days">Every Sunday</span>
          <input name="sun_from" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'sun', $clinic_data_days )  ? $clinic_data_days_time['sun']['to'] : '' ; ?>" />
          to 
          <input name="sun_to" class="clinic_time" type="text" class="form-control" value="<?php echo !empty($clinic_data_days) && in_array( 'sun', $clinic_data_days )  ? $clinic_data_days_time['sun']['to'] : '' ; ?>" />

          <hr />

          <input name="do_address" type="text" class="col-xs-4" placeholder="Address" value="<?php echo !empty($clinic_data) ? $clinic_data['do_address'] : '' ; ?>" />
          <div class="clr"></div>
          <input name="do_number" type="text" class="col-xs-4" placeholder="Number" value="<?php echo !empty($clinic_data) ? $clinic_data['do_number'] : '' ; ?>" />

          <div class="clr"></div>

          <hr />

          <div class="woqee_button clinic_button">Save</div>
        <?php echo form_close() ; ?>
      </div>

    </div>

    <div class="clr"></div>

  </div>

</div>

<link rel="stylesheet" href="/assets/css/jquery.timepicker.css"> 
<script type="text/javascript" src="/assets/js/jquery.timepicker.js"></script>