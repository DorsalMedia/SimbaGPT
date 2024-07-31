
<?php
require_once('admin-functions.php');

?>
<!--Initialize Header section and css files-->
<?php echo get_header(); ?>
</div>
      <div class="container-fluid main-content">
      <div class="page-title"></div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
         <div class="head-design">  
          <div class="heading">
            <i class="fa fa-search"></i>Search Campaigns
          </div>
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-7">
              <div class="widget-content padded"><br>
                <form action="#" class="form_search_campaign form-horizontal">
                  <div class="form-group">
                    <label class="control-label col-md-2"> Campaign </label>
                    <div class="col-md-7">
                      <select class="form-control" class="select_campaign" id="select_campaign">
                        <option value="0"> Select Campaign </option>
                        <?php foreach($get_campaign_data as $data){ ?> 
                          <option value="<?php echo $data['id']; ?>"> <?php echo $data['title']; ?> </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2"> Status </label>
                    <div class="col-md-7">
                      <label class="radio" for="option1"><input id="option1" name="campaign_status" type="radio" value="active"><span>Active</span></label>
                      <label class="radio"><input checked="" name="campaign_status" type="radio" value="inactive"><span>Inactive</span></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">  </label>
                    <div class="col-md-7">
                     <!--  <button type="button" class="search_campaign_name"> Search </button> -->
                     <button type="button" class=""> Search </button>
                    </div>
                  </div>
                  
                </form>
                </div>
              </div>
             <div class="col-md-2"></div>
              </div>
            </div>
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
                <span class="hightop-charts"></span>Campaign Details<a class="btn btn-sm btn-primary-outline pull-right" href="<?php echo base_url();?>admin/view_add_admin_campaign" id=""><i class="fa fa-plus"></i>Add</a>
              </div>
              <div class="widget-content padded clearfix">
                

                <table class="table table-bordered table-striped  tbl_search_campaign" id="datatable-editable">
                  <thead>
                    <th>
                      Campaign Name
                    </th>
                    <th>
                      Budget (SH)
                    </th>
                    <th class="hidden-xs">
                      Status
                    </th>
                    <th class="hidden-xs">
                      Total Ads
                    </th>
                    <th class="hidden-xs"> Contract </th>
                    <th width="60"></th>
                    <th width="65"></th>
                    <th width="65"></th>
                  </thead>
                  
                  <tbody class="append_test">
                  
                  <?php foreach($get_campaign_data as $data){ ?> 
                  <input type="hidden" name="campaign_id" id="campaign_id_edit" value="<?php echo $data['id']; ?>">
                  <input type="hidden" name="campaign_title" id="campaign_title" value="<?php echo $data['title']; ?>">
                  <input type="hidden" name="campaign_budget" id="campaign_budget" value="<?php echo $data['budget']; ?>">
                  <input type="hidden" name="campaign_status" id="campaign_status" value="<?php echo $data['status']; ?>">
                  <input type="hidden" name="campaign_ads_count" id="campaign_ads_count" value="<?php echo $get_advertisement_count; ?>">
                    <tr>
                      <td>
                        <?php echo $data['title']; ?>
                      </td>
                      <td>
                        <?php echo $data['budget']; ?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $data['status']; ?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $get_advertisement_count;  ?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $data['contract_title'];  ?>
                      </td>
                      <td>
                        <a class="edit_campaign" href="#" data-toggle="modal" data-target="#myModal1"  ><i class="fa fa-pencil">
                         <span class="hidden" name="campaign_id" id="campaign_id"> <?php echo $data['id']; ?> </span> 
                         <span class="hidden" name="campaign_title" id="campaign_title"> <?php echo $data['title']; ?> </span> 
                         <span class="hidden" name="campaign_budget" id="campaign_budget"> <?php echo $data['budget']; ?> </span> 
                         <span class="hidden" name="campaign_status" id="campaign_status"> <?php echo $data['status']; ?> </span> 
                         </i> </a>
                      </td>
                      <td>
                        <a class="" href="#"><i class="fa fa-eye"></i></a>
                      </td>
                      <td>
                        <a class="delete_campaign" href="#"><i class="fa fa-trash-o"> <span class="hidden" name="campaign_id" id="deleted_id"> <?php echo $data['id']; ?> </span>  </i></a>
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
    </div>
  </div>

  <div class="modal fade left" id="myModal1"> 
  <div class="modal-dialog"> 
    <div class="modal-content"> 
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Campaign</h4>
      </div>
      <div class="modal-body">

      <!-- Form Section  -->

        <form class="form-horizontal update_campaign_details" role="form" method="post" action="#">
            <?php

                  $ci =& get_instance();
                  $session = $_SESSION['rydlr_admin_login']; 
                  
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
                  <input type="hidden" name="plan_values" id="plan_values" value="<?php echo $sum ;?>">
                </div>  
            
            <label class="control-label col-md-2">Title</label>
                <div class="form-group">
                  <div class="col-md-7">
                    <input class="form-control" placeholder="Enter Title" type="text" name="campaign_title">
                  </div>
                </div>
              <input type="hidden" name="campaign_id" id="campaign_id">
                <label class="control-label col-md-2"> Budget </label>
                <div class="form-group">
                  <div class="col-md-7">
                    <input class="form-control" placeholder="Enter Budget" type="text" name="budget">
                  </div>
                </div>

              <input class="form-control" placeholder="Enter Budget" type="hidden" name="statuss">  
              <div class="form-group">
                  <label class="control-label col-md-2"> Status </label>
                  <div class="col-md-7">
                    <label class="radio"><input name="status" class="active" id="active" type="radio" value="active"> <span> Active </span> </label>
                    <label class="radio"><input name="status" class="inactive" id="inactive" type="radio" value="inactive" > <span> Inactive </span> </label>
                  </div>
              </div>
          <!--  <div class="form-group"> 
              <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3"> 
                <button type="button" id="submit" name="submit" class="update_campaign_detail btn-lg btn-primary"> UPDATE </button> 
              </div> 
            </div>  -->
        </form>
<!--end Form-->



      <!-- End Form  Section -->

      <!--INSERT CONTACT FORM HERE-->

      </div>
      <!-- <div class="modal-footer"> 
        <div class="col-xs-10 pull-left text-left text-muted"> 
        <small><strong>Privacy Policy:</strong>
        Lorem ipsum dolor sit amet consectetur adipiscing elit. 
        Mauris vitae libero lacus, vel hendrerit nisi! Maecenas quis 
        velit nisl, volutpat viverra felis. Vestibulum luctus mauris 
        sed sem dapibus luctus.</small> 
        </div> 
        <button class="btn-sm close" type="button" data-dismiss="modal">Close</button> 
      </div> -->
      <div class="modal-footer">
        <button type="button" id="submit" name="submit" class="update_campaign_detail btn-lg btn-primary"> UPDATE </button> 
         <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      </div> 
    </div> 
  </div> 
</div>

<?php echo get_footer(); ?>