
<!--
 
Summary :- Add new campaign page

-->

<?php
require_once('functions.php');

?>
<!--Initialize Header section and css files-->

<?php echo get_header(); ?>
</div>
      <div class="container main-content">
      <div class="page-title"></div>
		<div class="row">
		  <div class="col-lg-12">

		    <div class="widget-container fluid-height clearfix">
		      <div class="heading">
		        <i class="hightop-charts"></i>Edit Campaign Details
		      </div>
		      <div class="widget-content padded"><br>
		      	<center> <div class="loader"></div> </center>
		        <form  class="form-horizontal update_campaign_details" method="post">
		        <?php

		              $ci =& get_instance(); /*chirag 14-09  */
                      if(isset($_SESSION['admin_login'])){ 
		              $session = $_SESSION['admin_login'];
                      ?>
                      <input type="hidden" name="user_type" id="user_type" value="0" >
                <?php
                      }else{
                      $session = $_SESSION['enterprise_account'];
                      ?>
               		 <input type="hidden" name="user_type" id="user_type" value="2" >
                <?php
                      }
		              $user_id = $session['admin_id'];

		              $ci->db->select('*');
		              $ci->db->from('membership');
		              $ci->db->join('contract', 'contract.membership_id = membership.id'); 
		              $ci->db->join('users', 'users.id = contract.user_id'); 
		              $ci->db->join('payment', 'payment.contract_id = contract.id'); 
		              $ci->db->where('users.id',$user_id);
		              $get_membership_details = $ci->db->get();          
		              $membership_details = $get_membership_details->result_array();
		              foreach($membership_details as $membership_plans) {
			            $plan_name = $membership_plans['plan_name'];
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

		         ?>    


		            <div class="form-group">
									<!--    allow budget value for enterprise user   chirag 15-09 -->
                   <?php  if(isset($_SESSION['enterprise_account'])){
							?>
                   				<input type="hidden" name="plan_values" id="plan_values" value="1000000000">
                    <?php
						}else {
							/* changes done for Client feedback - 1/5 task and $sum_t take from header Balance ( based on budget used ) value */
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
					?>
                    	 <!--<input type="hidden" name="plan_values" id="plan_values" value="<?php echo $sum ;?>">-->
                    	<input type="hidden" name="plan_values" id="plan_values" value="<?php echo $sum_t ;?>">
						
				<?php 
				/* end changes for Client feedback - 1/5 task and $sum_t take from header Balance ( based on budget used ) value */
					}
					?>
            			
                    	
            		</div>	
            	
		          	
		            <label class="control-label col-md-2">Title</label>
		            <div class="form-group">
			            <div class="col-md-7">
			              <input class="form-control" placeholder="Enter Title" type="text" name="campaign_title" value="<?php echo $campaign_data['title'];?>" >
			            </div>
		          	</div>
		          
		            <label class="control-label col-md-2"> Budget ($)</label>
		            <div class="form-group">
			            <div class="col-md-7">
			              <input class="form-control" placeholder="Enter Budget" type="number"  min="1" max="999999999" name="budget" value="<?php echo $campaign_data['budget'];?>" >
			            </div>
		          	</div>
		          <div class="form-group">
			            <label class="control-label col-md-2"> Status </label>
			            <div class="col-md-7">
			              <label class="radio"><input  name="status" type="radio" value="Active" <?php if($campaign_data['status'] == "Active"){ ?> checked="" <?php }else {}?> ><span>Active</span></label>
			              <label class="radio"><input name="status" type="radio" value="Inactive " <?php if($campaign_data['status'] == "Inactive"){ ?> checked ="" <?php }else {}?> ><span>Inactive </span></label>
			            </div>
				    </div>
				    <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_data['id'];?>">
		          <div class="form-group">
		            <label class="control-label col-md-2"></label>
		            <div class="col-md-7">
		              <button class="btn btn-primary update_campaign_detail" type="button">Update</button> 
		              <a href="<?php echo base_url();?>common_admin/view_admin_campaigns"> <button class="btn btn-default-outline" type="button">  Back </button></a>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
	</div>

<?php echo get_footer(); ?>