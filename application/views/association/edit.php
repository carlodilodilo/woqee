<div id="doctorEditPg" class="container woqee_container">

  <div class="content_doctor_view">


    <!-- General Information Contanier -->
    <div class="general_info_cont">

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

          <div style="width: 100%; height: auto; min-height: 170px;">
            <div class="basic_image">
            </div>

            <div class="basic_profile">

              <div class="form-group">
                <div class="col-md-4">
                  <input name="fname" type="text" class="detail_form form-control" placeholder="First Name" value="<?php echo $doctorInfo['a_fname'] ; ?>">
                </div>
                <div class="col-md-3">
                  <input name="mname" type="text" class="detail_form form-control" placeholder="Middle Name" value="<?php echo $doctorInfo['a_mname'] ; ?>">
                </div>
                <div class="col-md-4">
                  <input name="lname" type="text" class="detail_form form-control" placeholder="Last Name" value="<?php echo $doctorInfo['a_lname'] ; ?>">
                </div>

                <div class="clr"></div>

                <div class="col-md-5">
                  Change my password
                </div>

                <div class="clr"></div>

                <div class="col-md-5">
                  <input name="password" type="password" class="detail_form form-control" placeholder="New Password">
                </div>

                <div class="col-md-5">
                  <input name="repassword" type="password" class="detail_form form-control" placeholder="Repeat New Password">
                </div>

                <div class="clr"></div>

                <div id="specializationCont">

                  <?php if( !empty($doctor_specialization) ) : ?>
                    <?php foreach( $doctor_specialization as $key => $val ) : ?>
                      <div class="col-md-3"><input name="specialization[]" type="text" class="detail_form form-control" placeholder="Specialization" value="<?php echo $val['ds_desc'] ; ?>"></div>
                    <?php endforeach ; ?>
                  <?php else : ?>
                    <div class="col-md-3"><input name="specialization[]" type="text" class="detail_form form-control" placeholder="Specialization"></div>
                  <?php endif ; ?>

                </div>

                <div class="col-md-3"><div id="addSpecialization" class="woqee_button">+</div></div>
              </div>

            </div>
          </div>

          <div style="width: 100%; height: 130px;">
              <div class="clr"></div>

              <div class="col-md-4">
                <input name="premed" type="text" class="detail_form form-control" placeholder="" value="<?php echo !empty($doctor_detail) ? $doctor_detail['dd_premed'] : '' ; ?>">
                <div class="degree_info">PRE-MED</div>
              </div>
              <div class="col-md-4">
                <input name="medicine" type="text" class="detail_form form-control" placeholder="" value="<?php echo !empty($doctor_detail) ? $doctor_detail['dd_medicine'] : '' ; ?>">
                <div class="degree_info">MEDICINE</div>
              </div>
              <div class="col-md-4">
                <input name="residency" type="text" class="detail_form form-control" placeholder="" value="<?php echo !empty($doctor_detail) ? $doctor_detail['dd_residency'] : '' ; ?>">
                <div class="degree_info">RESIDENCY</div>
              </div>

              <div class="clr"></div>
              <br />

              <div class="woqee_button doctor_edit">Save</div>
          </div>

        <?php echo form_close() ; ?>
      </div>
    </div>

    <div class="clr"></div>

    <!-- Clinic and Associations Container -->
    <div class="clinic_assoc_cont">

      <span class="content_header2">
        Clinic Practices
      </span>

      <span class="content_header2">
        Member Associations
      </span>

      <div class="clr"></div>

      <div class="doctor_profile2">
        <a name="clinics"></a>

        <br />

        <div id="add_clinic" class="woqee_button">Add a Clinic</div>

        <?php if( !empty($doctor_clinics) ) : ?>
          <?php foreach( $doctor_clinics as $doctor_clinic ) : ?>

            <hr />

            <?php echo $doctor_clinic['do_address'] ; ?>

            <br />

            <?php if( !empty($doctor_clinic['days']) ) : ?>
              <?php foreach( $doctor_clinic['days'] as $days ) : ?>
                <?php echo $days['dod_day'] ; ?>: <?php echo $days['dod_from'] ; ?> - <?php echo $days['dod_to'] ; ?>
                <br />
              <?php endforeach ; ?>
            <?php endif ; ?>

            <?php echo $doctor_clinic['do_number'] ; ?>

            <br />

            <a href="/doctor/clinic/<?php echo $doctor_clinic['do_id'] ; ?>">edit</a>
            |
            <a href="/doctor/clinic/<?php echo $doctor_clinic['do_id'] ; ?>/del">remove</a>
          <?php endforeach ; ?>
        <?php endif ; ?>

      </div>

      <div class="doctor_profile2 doctor_profile3">
        <br />
        <div data-reveal-id="myAssociation" class="woqee_button">Create Association</div>

        <div class="assoc_list">
          <?php foreach ( $doctors_association as $key => $val ) : ?>
            <?php if ( !empty( $val['assc_name'] ) ) : ?>
            <div id="associationCont<?php echo $val['assc_id'] ; ?>" class="assoc_cont">
              <div class="assoc_img">
                <img src="/assets/images/phpthumb.php?zc=1&amp;q=100&amp;h=55&amp;w=55&amp;far=1&amp;src=admin/sample.gif" />
              </div>

              <div class="assoc_info">
                <a href="/association/view/<?php echo $val['assc_id'] ; ?>"><?php echo $val['assc_name'] ; ?></a>
                <div class="clr"></div>
                <span class="member_count">
                  <?php 
                    $total_member = count($association_members[$val['assc_id']]) ; 
                    $total_member = ($total_member > 1 ) ? $total_member . ' members' : $total_member . ' member' ;
                  ?>
                  <?php echo $total_member ; ?>
                </span>
                <div class="remove_assoc" data-reveal-id="removeAssociation<?php echo $val['assc_id'] ; ?>" data-id="<?php echo $val['assc_id'] ; ?>">Remove</div>
              </div>

              <div id="removeAssociation<?php echo $val['assc_id'] ; ?>" class="myModal reveal-modal">
                <div class="manage_info_top">
                  Remove Association
                </div>

                <div class="manage_info_form removeAssociation">

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
                          <?php echo $val['assc_name'] ; ?>
                        </b>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div data-association-id="<?php echo $val['assc_id'] ; ?>" class="removeAssociationButton woqee_button">Confirm</div>
                          <div class="woqee_button cancel">Cancel</div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          <?php endif ; ?>
          <?php endforeach ; ?>
        </div>
      </div>
    </div>

    <div class="clr"></div>

    <!-- Credential Container -->
    <div class="credential_cont">
      <div class="content_header">
        Additional Credential
      </div>

      <a name="credentials"></a>

      <div class="doctor_profile">
        <div id="add_credential" class="woqee_button">Add Credential</div>
      </div>

      <?php foreach( $doctor_credentials as $doctor_credential ) : ?>
        <?php echo $doctor_credential['dc_title'] ; ?>
        <?php echo $doctor_credential['dc_year'] ; ?>
        <?php echo $doctor_credential['dc_description'] ; ?>
        <br />

        <a href="/doctor/credential/<?php echo $doctor_credential['dc_id'] ; ?>">edit</a>
        |
        <a href="/doctor/credential/<?php echo $doctor_credential['dc_id'] ; ?>/del">remove</a>

        <br />
        <br />
      <?php endforeach ; ?>

    </div>

    <div class="clr"></div>
  </div>

</div> <!-- /container -->

<div id="myAssociation" class="reveal-modal myModal">
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
          <div class="woqee_button cancel">Cancel</div>
        </div>
      </div>
    </form>
  </div>
</div>

<link rel="stylesheet" href="/assets/css/reveal.css"> 
<script type="text/javascript" src="/assets/js/jquery.reveal.js"></script>