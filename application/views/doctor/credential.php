<div id="doctorEditPg" class="container woqee_container">

  <div class="content_doctor_view">

    <!-- Clinic Form Contanier -->
    <div class="general_info_cont">

      <div class="content_header">
        Create Clinic Information
      </div>

      <div class="doctor_profile">
        <?php echo form_open( '/doctor/credential/'.$credential_id, array('id' => 'edit_credential') ) ; ?>

          <?php if ( !empty($message) ) : ?>
            <?php echo $message ; ?>
          <?php endif ; ?>

          <input name="credential_submit" type="hidden" value="1" />

          <div class="clinic_label_cont">
            <input name="dc_title" type="text" class="col-xs-4" placeholder="Title/Name" value="<?php echo !empty($credential_data) ? $credential_data['dc_title'] : '' ; ?>" />
            <div class="clr"></div>
            <input name="dc_year" type="text" class="col-xs-4" placeholder="Year" value="<?php echo !empty($credential_data) ? $credential_data['dc_year'] : '' ; ?>" />
            <div class="clr"></div>
            <input name="dc_description" type="text" class="col-xs-4" placeholder="Description" value="<?php echo !empty($credential_data) ? $credential_data['dc_description'] : '' ; ?>" />
          </div>

          <div class="clr"></div>

          <div class="woqee_button credential_button">Save</div>
          <div class="woqee_button cancel" onclick="window.location = '/doctor/edit/';">Cancel</div>
        <?php echo form_close() ; ?>
      </div>

    </div>

    <div class="clr"></div>

  </div>

</div>