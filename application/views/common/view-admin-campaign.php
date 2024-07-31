
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
		        <i class="hightop-charts"></i>View Campaign Details
		      </div>
		      <div class="widget-content padded"><br>
		      	<center> <div class="loader"></div> </center>
		        <form action="#" class="form-horizontal form_add_campaign_details">
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
					?>
                    	 <input type="hidden" name="plan_values" id="plan_values" value="<?php echo $sum ;?>">
						
				<?php 
					}
					?>
            			
                    	
            		</div>	
            	
		          	
		            <label class="control-label col-md-2">Title</label>
		            <div class="form-group">
			            <div class="col-md-7">
			              <input class="form-control" placeholder="Enter Title" type="text" name="campaign_title" value="<?php echo $campaign_data['title'];?>" readonly>
			            </div>
		          	</div>
		          
		            <label class="control-label col-md-2"> Budget ($)</label>
		            <div class="form-group">
			            <div class="col-md-7">
			              <input class="form-control" placeholder="Enter Budget" type="number"  min="1" max="999999999" name="budget" value="<?php echo $campaign_data['budget'];?>" readonly>
			            </div>
		          	</div>
		          <div class="form-group">
			            <label class="control-label col-md-2"> Status </label>
			            <div class="col-md-7">
			              <label class="radio"><input  name="status" type="radio" value="active" <?php if($campaign_data['status'] == "Active"){ ?> checked="" <?php }else {}?> disabled><span>Active</span></label>
			              <label class="radio"><input name="status" type="radio" value="Inactive " <?php if($campaign_data['status'] == "Inactive"){ ?> checked ="" <?php }else {}?> disabled><span>Inactive </span></label>
			            </div>
				    </div>
		          <div class="form-group">
		            <label class="control-label col-md-2"></label>
		            <div class="col-md-7">
		              <!-- <button class="btn btn-primary add_campaign_details" type="button">Submit</button>  -->
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