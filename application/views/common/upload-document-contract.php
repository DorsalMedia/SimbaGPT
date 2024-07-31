
<!--

summary : view uploaded document list contract action click

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
		    <div class="loader"> </div>
		      <form class="form_update_multiple_docs" action="" method="POST">
		    	<center> <h1> Upload Multiple Document </h1> <br><br>
			    	<input type="file" id="multiFiles" name="files[]" multiple="multiple"/> <br><br>

			    	<?php $id = $this->uri->segment(3); ?>
			    	<input type="hidden" name="contract_id" id="contract_id" value="<?php echo $id; ?>">
					<button id="upload_multiple_docs" type="button"> Upload </button> &nbsp; &nbsp;
					<a href="<?php echo base_url() ?>common_admin/view_admin_contract"><button id="upload_multiple_docs" type="button"> Cancel </button>
					 <br><br>
				</center>
			  </form>		
		    </div>
		  </div>  
		</div>
	</div>	


<?php echo get_footer(); ?>