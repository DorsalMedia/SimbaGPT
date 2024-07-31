<?php
error_reporting(0);
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
         <div class="head-design">  
          <div class="heading">
            <i class="fa fa-search"></i>Search Campaigns
          </div>
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-7">
              <div class="widget-content padded"><br>
              	<div class="loader"></div>
                <form action="#" class="form_search_campaign form-horizontal">
                  <div class="form-group">
                    <label class="control-label col-md-2"> Campaign </label>
                    <div class="col-md-7">
                      <select class="form-control" class="select_campaign" id="select_campaign">
                        <option value="0"> Select All Campaign </option>
                        <?php foreach($get_all_campaign_data as $datas){ ?> 
                          <option value="<?php echo $datas['id']; ?>"> <?php echo $datas['title']; ?> </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2"> Status </label>
                    <div class="col-md-7">
                      <label class="radio" for="option1"><input id="option1" name="campaign_status" type="radio" value="Active" checked=""><span>Active</span></label>
                      <label class="radio"><input name="campaign_status" type="radio" value="Inactive"><span>Inactive</span></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">  </label>
                    <div class="col-md-7">
                      <button type="button" class="search_campaign_name"> Search </button>
                     
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
                <span class="hightop-charts"></span>Campaign Details<a class="btn btn-sm btn-primary-outline pull-right" href="<?php echo base_url();?>common_admin/view_add_admin_campaign" id=""><i class="fa fa-plus"></i>Add</a>
              </div>
              <div class="widget-content padded clearfix">
                
				<div class="table-responsive">
                <table class="table table-bordered table-striped  tbl_search_campaign" id="datatable-editable">
                  <thead>
                    <th>
                      Campaign Name
                    </th>
                    <th>
                      Budget ($)
                    </th>
                    <th>
                      Ad Spend ($)
                    </th>
                    <th class="hidden-xs">
                      Status
                    </th>
                    <th class="hidden-xs">
                      Total Ads
                    </th>
                    <th class="hidden-xs"> Contract </th>
                    <!--<th width="60"></th>
                    <th width="65"></th>
                    <th width="65"></th>-->
                    <th> Action </th>
                  </thead>                 
                  <tbody class="append_test">                 
                  <?php foreach($get_campaign_data as $data){ ?> 
                  
                 <!--  <input type="hidden" name="campaign_id" id="campaign_id_edit" value="<?php echo $data['campaign_id']; ?>">
                  <input type="hidden" name="campaign_title" id="campaign_title" value="<?php echo $data['title']; ?>">
                  <input type="hidden" name="campaign_budget" id="campaign_budget" value="<?php echo $data['budget']; ?>">
                  <input type="hidden" name="campaign_status" id="campaign_status" value="<?php echo $data['status']; ?>">
                  <input type="hidden" name="campaign_ads_count" id="campaign_ads_count" value="<?php echo $get_advertisement_count; ?>"> -->
                    <tr>
                      <td>
                        <?php echo $data['title']; ?>
                      </td>
                      <td>
                        <?php echo $data['budget']; ?>
                      </td>
                      <td>
                        <?php echo $data['ad_spend']; ?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $data['status']; ?>
                      </td>
                      <td class="hidden-xs">
                      	<?php echo $data['ads_count']; ?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $data['contract_title']; ?>
                      </td>
                      <?php /*
                      chenge for the document asana task
                      <td>
                        <a class="edit_campaign" href="<?php echo base_url();?>common_admin/edit_admin_campaign/<?php echo $data['campaign_id'];?>" ><i class="fa fa-pencil">
                         <!-- <span class="hidden" name="campaign_id" id="campaign_id"> <?php echo $data['campaign_id']; ?> </span> 
                         <span class="hidden" name="campaign_title" id="campaign_title"> <?php echo $data['title']; ?> </span> 
                         <span class="hidden" name="campaign_budget" id="campaign_budget"> <?php echo $data['budget']; ?> </span> 
                         <span class="hidden" name="campaign_status" id="campaign_status"> <?php echo $data['status']; ?> </span>  -->
                         </i> </a>
                      </td>
                      <td>
                        <a class="view_campaign" href="<?php echo base_url();?>common_admin/read_view_admin_campaign/<?php echo $data['campaign_id'];?>"   ><i class="fa fa-eye">
                       <!--  <span class="hidden" name="campaign_id" id="campaign_id"> <?php echo $data['id']; ?> </span> 
                         <span class="hidden" name="campaign_title" id="campaign_title"> <?php echo $data['title']; ?> </span> 
                         <span class="hidden" name="campaign_budget" id="campaign_budget"> <?php echo $data['budget']; ?> </span> 
                         <span class="hidden" name="campaign_status" id="campaign_status"> <?php echo $data['status']; ?> </span>  -->
                        </i></a>
                      </td>
                      <td>
                        <a class="delete_campaign" href="#"><i class="fa fa-trash-o"> <span class="hidden" name="campaign_id" id="deleted_id"> <?php echo $data['campaign_id']; ?> </span>  </i></a>
                      </td>
                      */?>
              <td> 
                <a class="view_campaign" href="<?php echo base_url();?>common_admin/read_view_admin_campaign/<?php echo $data['campaign_id'];?>" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>

                <a class="edit_campaign" href="<?php echo base_url();?>common_admin/edit_admin_campaign/<?php echo $data['campaign_id'];?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </a>
              
               <a class="delete_campaign" href="#" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"> <span class="hidden" name="campaign_id" id="deleted_id"> <?php echo $data['campaign_id']; ?> </span>  </i></a>
              </td>
                    </tr>
                    <?php } ?>  
                  </tbody>
                  
                </table>
              </div>
                
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

	

<?php echo get_footer(); ?>