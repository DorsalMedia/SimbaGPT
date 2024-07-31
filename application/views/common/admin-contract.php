
<!--

Summary :- view contract page

-->

<?php
require_once('functions.php');

?>
<!--Initialize Header section and css files-->
<?php echo get_header(); ?>
</div>
      <div class="container-fluid main-content">
      <div class="page-title"></div>
		<div class="row">
		  <div class="col-lg-12">
		    <div class="widget-container fluid-height clearfix">
		     <!--<div class="head-design"> 
          <div class="heading">
		        <i class="fa fa-fw fa-edit"></i>Current Subscription
		      </div>
			      <div class="row">
			      	
			      	<div class="col-md-5 col-md-offset-1">
			      	<div class="widget-content padded"><br>
              <?php foreach($get_contract_details as $get_contract_detail_by_id) { ?>
			        	<form action="#" class="form-horizontal">
				          <div class="form-group">
                    <label class="control-label col-md-4">Start Date</label>
                    <div class="col-md-8">
                      <input class="form-control datepicker" type="text" placeholder="Enter Start Date" value="<?php echo $get_contract_detail_by_id['start_date']; ?>" disabled>
                    </div>
                  </div>
				          <div class="form-group">
                    <label class="control-label col-md-4">End Date</label>
                    <div class="col-md-8">
                      <input class="form-control datepicker" type="text" placeholder="Enter End Date" value="<?php echo $get_contract_detail_by_id['end_date']; ?>" disabled>
                    </div>
                  </div>
				          <div class="form-group">
				            <label class="control-label col-md-4"> Subscription Value ($)</label>
				            <div class="col-md-8">
				              <input class="form-control" type="text" placeholder="10000" value="<?php echo $get_contract_detail_by_id['plan_value'] ?>" disabled>
				            </div>
				          </div>
			        	</form>
              <?php } ?>  
			      	  </div>
			        </div>-->

              

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

                /* end changes done for Client feedback - 1/5 task*/
               // echo $total;

               // $sum = $plan_val - $total;

              
                //  $sum = $plan_val - $total;
                $sum  = $total;

                //echo "<span class='change_texts'><strong> Balance (based on budget allocated) : $".$sum."  <strong></span>";
                           // echo "<span class='change_texts'><strong> Allocated budget : $".$sum."  <strong></span>";
                
               

               $ci =& get_instance();
               // $session = $_SESSION['admin_login']; 
                //if(isset($_SESSION['admin_login'])) {
                 // $session = $_SESSION['admin_login'];
                 // $user_id = $session['admin_id'];
              
                
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
                            
              //  } 
                  ?>
               <div class="head-design"> 
          <div class="heading">
            <i class="fa fa-fw fa-edit"></i>Current Subscription
          </div>
            <div class="row">
              
              <div class="col-md-5 col-md-offset-1">
              <div class="widget-content padded"><br>
              <?php foreach($get_contract_details as $get_contract_detail_by_id) { ?>
                <form action="#" class="form-horizontal">
                  <div class="form-group">
                    <label class="control-label col-md-4">Start Date</label>
                    <div class="col-md-8">
                      <input class="form-control datepicker" type="text" placeholder="Enter Start Date" value="<?php echo $get_contract_detail_by_id['start_date']; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">End Date</label>
                    <div class="col-md-8">
                      <input class="form-control datepicker" type="text" placeholder="Enter End Date" value="<?php echo $get_contract_detail_by_id['end_date']; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4"> Subscription Value ($)</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" placeholder="10000" value="<?php echo $get_contract_detail_by_id['plan_value'] ?>" disabled>
                    </div>
                  </div>
                </form>
              <?php } ?>  
                </div>
              </div>





            <div class="col-md-5">
             <div class="widget-content padded"><br>
             
                <form action="#" class="form-horizontal">
                  <div class="form-group">
                    <label class="control-label col-md-4">Allocated Budget ($)</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" placeholder="Enter Start Date" value="<?php echo $sum; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Spent Budget ($)</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" placeholder="Enter End Date" value="<?php echo round($total_t,2); ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4"> Balance ($)</label>
                    <div class="col-md-8">
                <input class="form-control" type="text" placeholder="10000" value="<?php echo $sum_t; ?>" disabled>
                    </div>
                  </div>
                </form>
            
                </div>
                </div>

                 </div><!--end row--> 
            </div>  <!--head-design-->
          <?php   } 

            ?>



               
                 
                 



             
			       
		      	 
		      	  <!-- Data table section starting from here -->
		      <div class="container-fluid main-content">
       <!-- <div class="page-title">
          <h1>
            Editable DataTables
          </h1>
        </div> -->
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
             <!-- <i class="fa fa-fw fa-bullhorn"></i>Ads Details<a class="btn btn-sm btn-primary-outline pull-right" href="http://www.google.com" id="add-row"><i class="fa fa-plus"></i>Add</a> -->
                <i class="fa fa-fw fa-edit"></i>All Subscriptions
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="datatable-editable">
                  <thead>
                    <th>
                      Subscription Name
                    </th>
                    <th>
                      Value ($)
                    </th>
                    <th class="hidden-xs">
                      Media Agency Name 
                    </th>
                    <th class="hidden-xs">
                      Start Date
                    </th>
                    <th class="hidden-xs">
                      End Date
                    </th>
                    <th class="hidden-xs">
                      Upload Status
                    </th>
                    <th class="hidden"> </th>
                    <?php if(isset($_SESSION['rydlr_admin_login'])) { ?>
                    <th width="75" style="text-align: center;"> Upload Document  </th>
                    <?php } ?>

                    <th width="75" style="text-align: center;"> Action </th>
                  </thead>
                  
                  <tbody>
                    <?php foreach($get_contract_detail as $details) {  ?>
                    <tr>
                      <td>
                        <?php echo $details['contract_title']; ?>
                      </td>
                      <td>
                        <?php echo $details['plan_value']; ?> 
                      </td>
                      <td class="hidden-xs">
                        <?php echo $details['media_agency_name']; ?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $details['start_date']; ?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $details['end_date']; ?>
                      </td>
                      <td class="hidden-xs">
                        <?php  
                          if($details['upload_document'] == ''){
                           echo '<span class="label label-warning">Pending</span>';;
                          } else {
                           echo '<span class="label label-success">Uploaded</span>';;
                          } 
                        ?>
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <?php if(isset($_SESSION['rydlr_admin_login'])) { ?>
                      <td style="text-align: center;">
                        <a class="" href="<?php echo base_url();?>common_admin/view_upload_document/<?php echo $details['contract_id']; ?>" data-toggle="tooltip" data-placement="top" title="Upload"><i class="fa fa-fw fa-upload"></i></a>
                      </td>
                      <?php } ?>
                      <td style="text-align: center;">
                       <?php 
                       if($details['upload_document'] == ''){ }else {
                        ?>
                        <a class="" href="<?php echo base_url();?>common_admin/view_document_list/<?php echo $details['contract_id']; ?>" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php } ?>  
                  </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- end DataTables Example -->
      </div>
		      <!-- Data table ending here -->

		    </div>
		  </div>
		</div><!--end row-->
	</div>

<?php echo get_footer(); ?>