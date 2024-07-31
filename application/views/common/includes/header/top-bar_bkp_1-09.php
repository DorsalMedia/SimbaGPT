<?php

?>
<!-- top navigation -->
	<div class="container-fluid top-bar">




          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <?php

                $ci =& get_instance();

                //$session = $_SESSION['admin_login'];
                if(isset($_SESSION['admin_login'])) {
                  $session = $_SESSION['admin_login'];
                  $user_id = $session['admin_id'];
                } else if(isset($_SESSION['rydlr_admin_login'])) {
                  $session = $_SESSION['rydlr_admin_login'];
                  $user_id = $session['admin_id'];
                } 
                $class = $ci->db->query("SELECT * FROM users WHERE id='".$user_id."'");
                $class = $class->result_array();
                 foreach($class as $row){
                    ?>
                <img width="34" height="34" src="<?php
                 if($row['client_logo']!="") {
                  echo base_url($row['client_logo']); 
                  } else
                   { echo base_url('assets/images/avatar-male.jpg'); 
                   } ?>" /> <?php 
                   if(isset($_SESSION['admin_login'])){
                    $session = $_SESSION['admin_login'];
                    $username = $session['admin_username'];
                    $user_id = $session['admin_id'];
                  } else if(isset($_SESSION['rydlr_admin_login'])) {
                    $session = $_SESSION['rydlr_admin_login'];
                    $username = $session['admin_username'];
                    $user_id = $session['admin_id'];
                  } 
                  echo ''.$username. ''; ?> <b class="caret"></b></a>
              <?php } ?>

              <?php 
              if(isset($_SESSION['admin_login'])){
                $session = $_SESSION['admin_login'];
                $username = $session['admin_username'];
              } else if(isset($_SESSION['rydlr_admin_login'])) {
                $session = $_SESSION['rydlr_admin_login'];
                $username = $session['admin_username'];
              }
              //$session = $_SESSION['admin_login'];
              ?>
                <ul class="dropdown-menu">
                 <?php 
                   if(isset($_SESSION['admin_login'])) {
                    $session = $_SESSION['admin_login'];
                    $user_id = $session['admin_id'];
                 ?>
                  <li><a href="<?php echo base_url();?>common_admin/view_admin_profile">
                    <i class="fa fa-user"></i>My Account</a>
                  </li>
                  <?php } ?>                  
                  <li><a href="<?php echo base_url();?>common_admin/logout">
                    <i class="fa fa-sign-out"></i>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> &nbsp; &nbsp; &nbsp;
          <a class="logo" href="<?php echo base_url();?>media_admin/home"> <img src="<?php echo base_url();?>assets/images/logo.png" style="width:40%"> </a>
	        <form class="navbar-form form-inline col-lg-2 hidden-xs1">
	         <input class="form-control" placeholder="Search" type="text">
	        </form>
          
          <div class="col-md-2">
            <div class="heading">
            <?php

              $ci =& get_instance();
              //$session = $_SESSION['admin_login']; 
              if(isset($_SESSION['admin_login'])) {
                $session = $_SESSION['admin_login'];
                $user_id = $session['admin_id'];
              

              $ci->db->select('*');
              $ci->db->from('membership');
              $ci->db->join('contract', 'contract.membership_id = membership.id'); 
              $ci->db->join('users', 'users.id = contract.user_id'); 
              $ci->db->join('payment', 'payment.contract_id = contract.id'); 
              $ci->db->where('users.id',$user_id);
              $get_membership_details = $ci->db->get();          
              $membership_details = $get_membership_details->result_array();
              foreach($membership_details as $membership_plans){
                  if($membership_plans['manual_payment_status'] == 'n'){
                  $plan_name = $membership_plans['plan_name'];
                  $plan_val = $membership_plans['plan_value'];
                  echo "<span class='change_text'> <strong> ".$plan_name." - ".$plan_val." SH  </strong> </span>";
                } else {
                  $plan_name = $membership_plans['plan_name'];
                  $plan_val = $membership_plans['plan_value'];
                  echo "<span class='change_text'> <strong> $plan_name -- $plan_val SH </strong> </span>";  
                }
              }  
            }  
            ?>
              </div>
          </div>
          <div class="col-md-3">
            <div class="heading">
              <?php

                $ci =& get_instance();
               // $session = $_SESSION['admin_login']; 
                if(isset($_SESSION['admin_login'])) {
                  $session = $_SESSION['admin_login'];
                  $user_id = $session['admin_id'];
              
                
               // $user_id = $session['admin_id'];

                $ci->db->select('*');
                $ci->db->from('membership');
                $ci->db->join('contract', 'contract.membership_id = membership.id'); 
                $ci->db->join('users', 'users.id = contract.user_id'); 
                $ci->db->join('payment', 'payment.contract_id = contract.id'); 
                $ci->db->where('users.id',$user_id);
                $get_membership_details = $ci->db->get();   
                
                $membership_details = $get_membership_details->result_array();
                
                foreach($membership_details as $membership_plans){
                    $plan_val = $membership_plans['plan_value'];
                }

                $total = 0;
                $ci->db->select('*');
                $ci->db->from('campaign');
                $ci->db->where('user_id',$user_id); 
                $ci->db->where('status','active'); 
                $get_campaign_budget = $ci->db->get();   
                $campaign_details = $get_campaign_budget->result_array();

                foreach($campaign_details as $campaign_budget){
                    $total += $campaign_budget['budget'];
                }
                //echo $total;

                $sum = $plan_val - $total;
                echo "<span class='change_texts'><strong> Current Balance - ".$sum." SH <strong></span>";
                            
                }  

              ?>



              </div>
            </div>
          
	</div>


<!-- /top navigation -->