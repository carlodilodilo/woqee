<div id="doctorEditPg" class="container woqee_container">

  <div>
  	My Association
  	<br />

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
              </div>
            </div>
          <?php endif ; ?>
          <?php endforeach ; ?>
        </div>

  </div>

</div> <!-- /container -->