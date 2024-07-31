
<!--

Summary :- view payment listing

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
         <div class="head-design"> 
		      <div class="heading">
		        $ Current Payment
		      </div>

			      <div class="row">
			      	<div class="col-md-3"></div>
			      	<div class="col-md-7">
              <span style="font-weight: bold; font-size: 600; color:red"> Note : This section will be available in next phase. One sample data is shown in the table for reference. </span>
			      	<div class="widget-content padded"><br>

			        	<form action="#" class="form-horizontal">
				          <div class="form-group">
                    <label class="control-label col-md-3">Contract Name</label>
                    <div class="col-md-5">
                      <input class="form-control" placeholder="Enter Contract Name" type="text">
                    </div>
                  </div>
				          <div class="form-group">
                    <label class="control-label col-md-3">Payment Amount ($)</label>
                    <div class="col-md-5">
                      <input class="form-control" placeholder="Enter Payment Amount" type="text">
                    </div>
                  </div>
				          <div class="form-group">
				            <label class="control-label col-md-3"> Payment Date </label>
				            <div class="col-md-5">
				              <input class="form-control datepicker" type="text" placeholder="Enter Payment Date">
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
                $ Payment History
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="datatable-editable">
                  <thead>
                    <th>
                      Contract Name
                    </th>
                    <th>
                      Value ($)
                    </th>
                    <th class="hidden-xs">
                      Payment Date
                    </th>
                    <th class="hidden-xs">
                      Type
                    </th>
                    <th class="hidden">s </th>
                    <th class="hidden"></th>
                    <th width="150"> View Invoice </th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        AB Deviliers
                      </td>
                      <td>
                        100
                      </td>
                      <td class="hidden-xs">
                        11/1/17
                      </td>
                      <td class="hidden-xs">
                        Online
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <!-- <tr>
                      <td>
                        John Smith
                      </td>
                      <td>
                        120
                      </td>
                      <td class="hidden-xs">
                        11/1/16
                      </td>
                      <td class="hidden-xs">
                        Manual
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Albie Morkel
                      </td>
                      <td>
                        45
                      </td>
                      <td class="hidden-xs">
                        14/1/17
                      </td>
                      <td class="hidden-xs">
                        Manual
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Morne Morkel
                      </td>
                      <td>
                        60
                      </td>
                      <td class="hidden-xs">
                        11/1/16
                      </td>
                      <td class="hidden-xs">
                        Manual
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Glenn Maxwell
                      </td>
                      <td>
                        78
                      </td>
                      <td class="hidden-xs">
                        11/5/17
                      </td>
                      <td class="hidden-xs">
                        Online
                      </td>
                      <td class="hidden">
                        40
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        George Bailey
                      </td>
                      <td>
                        20
                      </td>
                      <td class="hidden-xs">
                        11/6/17
                      </td>
                      <td class="hidden-xs">
                        Manual
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Steve Smith
                      </td>
                      <td>
                        90
                      </td>
                      <td class="hidden-xs">
                        11/8/17
                      </td>
                      <td class="hidden-xs">
                        Online
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Mehendra Singh Dhoni
                      </td>
                      <td>
                        300
                      </td>
                      <td class="hidden-xs">
                        25/1/17
                      </td>
                      <td class="hidden-xs">
                        Online
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        J P Duminy
                      </td>
                      <td>
                        120
                      </td>
                      <td class="hidden-xs">
                        11/8/17
                      </td>
                      <td class="hidden-xs">
                        Manual
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Shaun Marsh
                      </td>
                      <td>
                        80
                      </td>
                      <td class="hidden-xs">
                        1/1/17
                      </td>
                      <td class="hidden-xs">
                        Online
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        David Miller
                      </td>
                      <td>
                        80
                      </td>
                      <td class="hidden-xs">
                        11/4/17
                      </td>
                      <td class="hidden-xs">
                        Manual
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Hashim Amla
                      </td>
                      <td>
                        90
                      </td>
                      <td class="hidden-xs">
                        19/1/17
                      </td>
                      <td class="hidden-xs">
                        Manual
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        John Botha
                      </td>
                      <td>
                        65
                      </td>
                      <td class="hidden-xs">
                        22/1/17
                      </td>
                      <td class="hidden-xs">
                        Manual
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Chris Gayle
                      </td>
                      <td>
                        100
                      </td>
                      <td class="hidden-xs">
                        11/10/17
                      </td>
                      <td class="hidden-xs">
                        Online
                      </td>
                      <td class="hidden">
                        15
                      </td>
                      <td class="hidden">
                        <a class="edit-row" href="#"><i class="fa fa-pencil"></i></a>
                      </td>
                      <td>
                        <a class="" href="<?php echo base_url() ?>common_admin/payment_invoice"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr> -->
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