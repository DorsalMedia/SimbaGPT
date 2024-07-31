
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
		        <i class="fa fa-fw fa-edit"></i>Current Contract
		      </div>
			      <div class="row">
			      	<div class="col-md-3"></div>
			      	<div class="col-md-7">
			      	<div class="widget-content padded"><br>
              <?php foreach($get_contract_details as $get_contract_detail_by_id) { ?>
			        	<form action="#" class="form-horizontal">
				          <div class="form-group">
                    <label class="control-label col-md-2">Start Date</label>
                    <div class="col-md-5">
                      <input class="form-control datepicker" type="text" placeholder="Enter Start Date" value="<?php echo $get_contract_detail_by_id['start_date']; ?>" disabled>
                    </div>
                  </div>
				          <div class="form-group">
                    <label class="control-label col-md-2">End Date</label>
                    <div class="col-md-5">
                      <input class="form-control datepicker" type="text" placeholder="Enter End Date" value="<?php echo $get_contract_detail_by_id['end_date']; ?>" disabled>
                    </div>
                  </div>
				          <div class="form-group">
				            <label class="control-label col-md-2"> Contract Value (SH)</label>
				            <div class="col-md-5">
				              <input class="form-control" type="text" placeholder="10000" value="<?php echo $get_contract_detail_by_id['plan_value'] ?>" disabled>
				            </div>
				          </div>
			        	</form>
              <?php } ?>  
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
                <i class="fa fa-fw fa-edit"></i>All Contract
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="datatable-editable">
                  <thead>
                    <th>
                      Contract Name
                    </th>
                    <th>
                      Value (SH)
                    </th>
                    <th class="hidden-xs">
                      Status
                    </th>
                    <th class="hidden-xs">
                      Start Date
                    </th>
                    <th class="hidden-xs">
                      End Date
                    </th>
                    <th class="hidden"> </th>
                    <th class="hidden"> </th>
                    <th width="75"> Action </th>
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
                        Active
                      </td>
                      <td class="hidden-xs">
                        <?php echo $details['start_date']; ?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $details['end_date']; ?>
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="#"><i class="fa fa-eye"></i></a>
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

<?php echo get_footer(); ?>