
<?php
require_once('admin-functions.php');

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
		        <i class="hightop-charts"></i>Add Campaign Details
		      </div>
		      <div class="widget-content padded"><br>
		        <form action="#" class="form-horizontal form_add_campaign_details">
		          
		          
		            <label class="control-label col-md-2">Title</label>
		            <div class="form-group">
			            <div class="col-md-7">
			              <input class="form-control" placeholder="Enter Title" type="text" name="campaign_title">
			            </div>
		          	</div>
		          
		            <label class="control-label col-md-2"> Budget </label>
		            <div class="form-group">
			            <div class="col-md-7">
			              <input class="form-control" placeholder="Enter Budget" type="number" name="budget">
			            </div>
		          	</div>
		          <div class="form-group">
			            <label class="control-label col-md-2"> Status </label>
			            <div class="col-md-7">
			              <label class="radio"><input name="status" type="radio" value="active"><span>Active</span></label>
			              <label class="radio"><input checked="" name="status" type="radio" value="inactive"><span>Inactive </span></label>
			            </div>
				    </div>
		          <div class="form-group">
		            <label class="control-label col-md-2"></label>
		            <div class="col-md-7">
		              <button class="btn btn-primary add_campaign_details" type="button">Submit</button> 
		              <a href="<?php echo base_url();?>admin/view_admin_campaigns"> <button class="btn btn-default-outline" type="button">  Cancel </button></a>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
	</div>

<?php echo get_footer(); ?>