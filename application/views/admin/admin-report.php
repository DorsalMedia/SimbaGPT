
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
		          <i class="glyphicon glyphicon-usd"></i>Search Report
		      </div>
			      <div class="row">
			      	<div class="col-md-3"></div>
			      	<div class="col-md-7">
			      	<div class="widget-content padded"><br>
			        	<form action="#" class="form-horizontal">
				          <div class="form-group">
				            <label class="control-label col-md-2"> Select Report </label>
				            <div class="col-md-7">
				              <select class="form-control">
					              <option value="Campaign 1">Impression</option>
					              <option value="Campaign 2">Duration</option>
					              <option value="Campaign 3">Budget</option>
				              </select>
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="control-label col-md-2"> Select Campaign </label>
				            <div class="col-md-7">
				              <select class="form-control">
					              <option value="City 1">Campaign 1</option>
					              <option value="City 2">Campaign 2</option>
					              <option value="City 3">Campaign 3</option>
				              </select>
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="control-label col-md-2"> Status </label>
				            <div class="col-md-7">
				              <label class="radio-inline"><input name="optionsRadios2" type="radio" value="active"><span>Active</span></label>
				              <label class="radio-inline"><input checked="" name="optionsRadios2" type="radio" value="inactive"><span>Inactive </span></label>
				            </div>
				          </div>
			        	</form>
			      	  </div>
			        </div>
			       <div class="col-md-2"></div>
		      	  </div>
            </div> 
		      	  <!-- Data table section starting from here -->
		      <div class="container main-content">
       <!-- <div class="page-title">
          <h1>
            Editable DataTables
          </h1>
        </div> -->
        <!-- DataTables Example -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              
              <div class="col-lg-6">
                  
                    <div class="heading">
                      <i class="fa fa-bar-chart-o"></i>Ad Views
                    </div>
                    <div class="widget-content padded text-center">
                      <div id="composite-chart-1">
                        Loading...
                      </div>
                    </div>
                
              </div>
              <div class="col-lg-6">
              <div class="widget-content padded clearfix">
                <table class="table table-bordered">
                  <thead>
                    <th>
                      Ad Name
                    </th>
                    <th>
                      View
                    </th>
                    
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        Ad 1
                      </td>
                      <td>
                        30
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Ad 2
                      </td>
                      <td>
                        50
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Ad 3
                      </td>
                      <td>
                        70
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Ad 4
                      </td>
                      <td>
                        80
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Ad 5
                      </td>
                      <td>
                        80
                      </td>
                    </tr>
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