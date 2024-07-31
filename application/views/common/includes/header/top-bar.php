<?php  //chirag 06/09/17

use PhpMyAdmin\Console;

	$date_val = "2017-09-30";   
	$current_date_val = date('Y-m-d');
?>
<!-- top navigation -->
<style type="text/css">
  .navbar .container-fluid.top-bar .logo {
    /*margin: 0px -180px 0 0;*/
    margin: 7px 0px 0px 0;
  }
  .heading{
    font-size: 12px;
  }
  
 .preload{
  height: 100vh;
    width: 100%;
   /* background: #3BB9FF ;*/
   background: #fff;
    z-index: 999;
    position: absolute;
    text-align: center;
    padding-top: 20%;
    opacity: 0.9;
}
.change_texts{
  font-size: 15px;
    width: 100%;
    text-align: right;
    display: inline-block;
    right: 4px;
        padding-top: 13px;
}
.change_texts:hover{
  color: #007aff;
}
</style>
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
                } else if(isset($_SESSION['enterprise_account'])) {
                  $session = $_SESSION['enterprise_account'];
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
                  } else if(isset($_SESSION['enterprise_account'])) {
                    $session = $_SESSION['enterprise_account'];
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
              } else if(isset($_SESSION['enterprise_account'])) {
                $session = $_SESSION['enterprise_account'];
                $username = $session['admin_username'];
                $user_id = $session['admin_id'];
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
                  <?php }
                   else if(isset($_SESSION['enterprise_account'])) {
                    $session = $_SESSION['enterprise_account'];
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

        <!-- <a class="" href="<?php echo base_url();?>media_admin/home"> <img src="<?php echo base_url();?>assets/images/logo.png" style="width:40%"></a>-->
    
         <a class="logo" href="<?php echo base_url();?>media_admin/home"> <img src="<?php echo base_url();?>assets/images/Rydlr_logo_title.png" style="width:80px;"></a>


         
	         <?php if($current_date_val < $date_val)   //chirag 06/09/17
	               {
                    ?>

   <div class="logo" style="color:#00aeef;margin-top:10px;font-weight:700;">Beta Test</div> 
    <?php } ?>

    <!-- top bar calculation of prices -->
    <!-- this changed for Client feedback - 1/5 -->
     <!-- <form class="navbar-form form-inline col-lg-2 hidden-xs1">
	       <input class="form-control" placeholder="Search" type="text">
      </form>-->
          
         <?php 
           /* this changed for Client feedback - 1/5 */
         /* <div class="col-md-2" style="width: 11%;">
            <div class="heading" >
           
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
              $ci->db->order_by('contract.created_on', 'DESC');
              $ci->db->limit(1);

              $get_membership_details = $ci->db->get();     
              
              $membership_details = $get_membership_details->result_array();

              foreach($membership_details as $membership_plans){
                if($membership_plans['manual_payment_status'] == 'n'){
                  $plan_name = $membership_plans['plan_name'];
                  $plan_val = $membership_plans['plan_value'];
                  if($plan_name == 'Starter Plan'){
                    $plan_val = '120';
                  } else if($plan_name == 'Basic Plan'){
                    $plan_val = '230';
                  } else if($plan_name == 'Advanced Plan'){
                    $plan_val = '540';
                  } else if($plan_name == 'Professional Plan'){
                    $plan_val = '780';
                  }
                  echo "<strong><span class='change_text'> ".$plan_name." : $".$plan_val."  </span></strong>";
                } else {
                  $plan_name = $membership_plans['plan_name'];
                  $plan_val = $membership_plans['plan_value'];
                  if($plan_name == 'Starter Plan'){
                    $plan_val = '120';
                  } else if($plan_name == 'Basic Plan'){
                    $plan_val = '230';
                  } else if($plan_name == 'Advanced Plan'){
                    $plan_val = '540';
                  } else if($plan_name == 'Professional Plan'){
                    $plan_val = '780';
                  }
                  echo "<strong><span class='change_text'>$plan_name : $".$plan_val." </span></strong>";  
                }
              }  
            }  
            //echo $plan_name;
            ?>
              </div>
          </div> */ ?>

         <?php /* <div class="col-md-2" style="width: 18.666667%;"  >
            <div class="heading" >
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
                $ci->db->order_by('contract.created_on', 'DESC');
                $ci->db->limit(1);
                $get_membership_details = $ci->db->get();   
                
                $membership_details = $get_membership_details->result_array();

                foreach($membership_details as $membership_plans){
                    $plan_val = $membership_plans['plan_value'];
                    $plan_name = $membership_plans['plan_name'];
                }

                if($plan_name == 'Starter Plan'){
                    $plan_val = '120';
                  } else if($plan_name == 'Basic Plan'){
                    $plan_val = '230';
                  } else if($plan_name == 'Advanced Plan'){
                    $plan_val = '540';
                  } else if($plan_name == 'Professional Plan'){
                   $plan_val = '780';
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

                // end changes done for Client feedback - 1/5 task
               // echo $total;

               // $sum = $plan_val - $total;

              
                //  $sum = $plan_val - $total;
                $sum  = $total;

                //echo "<span class='change_texts'><strong> Balance (based on budget allocated) : $".$sum."  <strong></span>";
                            echo "<span class='change_texts'><strong> Allocated budget : $".$sum."  <strong></span>";
                }  

              ?>

				

              </div>
          
          </div> */ ?>
          <div class="col-md-2 pull-right " style="width: 18.666667%; display: inline-block;" >
              <div class="heading" >
              <?php
               /* this changed for Client feedback - 1/5 */
                $ci =& get_instance();
               // $session = $_SESSION['admin_login']; 
                if(isset($_SESSION['admin_login'])) {
                  $session = $_SESSION['admin_login'];
                  $user_id = $session['admin_id'];
                   var_dump("user_id",$user_id);
              
                
               // $user_id = $session['admin_id'];

                $ci->db->select('*');
                $ci->db->from('membership');
                $ci->db->join('contract', 'contract.membership_id = membership.id'); 
                $ci->db->join('users', 'users.id = contract.user_id'); 
                $ci->db->join('payment', 'payment.contract_id = contract.id'); 
                $ci->db->where('users.id',$user_id);
                $ci->db->order_by('contract.created_on', 'DESC');
                $ci->db->limit(1);
                $get_membership_details = $ci->db->get();   
                
                $membership_details = $get_membership_details->result_array();

                foreach($membership_details as $membership_plans){
                    $plan_val = $membership_plans['plan_value'];
                    $plan_name = $membership_plans['plan_name'];
                }

                if($plan_name == 'Starter Plan'){
                    $plan_val = '120';
                  } else if($plan_name == 'Basic Plan'){
                    $plan_val = '230';
                  } else if($plan_name == 'Advanced Plan'){
                    $plan_val = '540';
                  } else if($plan_name == 'Professional Plan'){
                   $plan_val = '780';
                }

              $total_t = 0;
                
              $ci->db->select('driver_add_view_update.adImpression_cost,driver_add_view_update.adCount_cost,advertise.spend,advertise.id as advertise_id,campaign.id as campaign_id,driver_add_view_update.id as driver_ad_id');
              $ci->db->from('advertise');
              $ci->db->join('campaign','advertise.campaign_id = campaign.id');
              $ci->db->join('users','users.id = advertise.user_id');
              $ci->db->join('driver_add_view_update','driver_add_view_update.adId = advertise.id');              
              $ci->db->where('campaign.status','Active');
              $ci->db->where('campaign.user_id',$user_id);
              //$this->db->where('advertise.user_id',$user_id);
              $query_data = $ci->db->get();
              $result_data = $query_data->result_array();
              foreach ($result_data as $final_data) {
                      if($final_data['spend'] == "CPV"){
                        $adImpression_cost = 0;
                      }else{
                        $adImpression_cost = $final_data['adImpression_cost'];
                      }

                      if($final_data['spend'] == "CPM"){
                        $adCount_cost = 0;
                      }else{
                        $adCount_cost = $final_data['adCount_cost'];
                      }
                      $total_t += $adImpression_cost + $adCount_cost;

                      
                }

                  $sum_t =$plan_val - round($total_t,2);

            /* end changes done for Client feedback - 1/5 task*/
                //echo "<span class='change_texts'><strong> Balance ( based on budget used ) : $".$sum_t."  <strong></span>";

                 // echo "<span class='change_texts'><strong> Budget Spent : $".round($total_t,2).", Balance : $".$sum_t."  <strong></span>";
            echo "<a href='".base_url()."common_admin/view_admin_contract'><span class='change_texts'><strong> Balance : $".$sum_t."  <strong></span></a>";

                  /* end changed for Client feedback - 1/5*/          
                }  

              ?>

              </div>
          </div>
          
	</div>
   <div class="preload"><img src="<?php echo base_url();?>assets/images/preloader.gif">
</div>

<!--<div class="preload">
<div class="loader">
	
</div>
</div>-->
<!--<div class="preload">
	<img src="http://www.sbif.cl/recursos/sbifweb3/img/throbber_13.gif">

</div>-->

<!-- /top navigation -->