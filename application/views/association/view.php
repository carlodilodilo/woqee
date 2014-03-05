<!-- <img src="/assets/images/Mockups5.jpg" /> -->

<div id="doctorViewPg" class="container woqee_container">

  <div class="content_doctor_view">

    <br />

    <a href="/doctor/edit/" class="edit_link">Edit</a>

    <div class="doctor_profile">
      Woqee Feed
    </div>
    <div class="doctor_profile">
      Events
    </div>
    <div class="doctor_profile">
      <?php echo $assoc_info['assc_name'] ; ?> 

      <?php 
        $total_member = count($association_members) ; 
        $total_member = ($total_member > 1 ) ? $total_member . ' members' : $total_member . ' member' ;
      ?>

      ( <?php echo $total_member ; ?> )
    </div>

    <hr />

    <h4><?php echo $assoc_info['assc_tagline'] ; ?></h4>

    <br />

    <p><?php echo $assoc_info['assc_description'] ; ?></p>

    <h4>Officers ( <?php echo count($association_admins) ; ?> )</h4>

    <?php foreach ( $association_admins as $association_admin ) : ?>
      <a href="/doctor/view/<?php echo $association_admin['a_id']; ?>"><?php echo $association_admin['a_fname'] ; ?> <?php echo $association_admin['a_lname'] ; ?></a>

      <br />

      <?php foreach ( $doctor_specializations[$association_admin['d_id']] as $doctor_specialization ) : ?>
        <?php echo $doctor_specialization['ds_desc'] ; ?>
      <?php endforeach ; ?>
    <?php endforeach ; ?>

    <h4>Members ( <?php echo count($association_members) ; ?> )</h4>

    <?php foreach ( $association_members as $association_member ) : ?>
      <a href="/doctor/view/<?php echo $association_member['a_id']; ?>"><?php echo $association_member['a_fname'] ; ?> <?php echo $association_member['a_lname'] ; ?></a>

      <br />

      <?php foreach ( $doctor_specializations[$association_member['asscd_did']] as $doctor_specialization ) : ?>
        <?php echo $doctor_specialization['ds_desc'] ; ?>
      <?php endforeach ; ?>
    <?php endforeach ; ?>


  </div>

</div> <!-- /container -->