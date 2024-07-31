
<!--

Summary :- edit advertisment back up page. in application not in use

-->

<?php
require_once('functions.php');

?>
<!--Initialize Header section and css files-->

<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }

      img.cls {
      	max-width: 425px;
      	max-height: 69px;
      	border: 2px dotted white;
      	border-radius: 20px;
        width: 425px;
      	height: auto;
      }
    </style>
    
<?php echo get_header(); ?>

</div>
      <div class="container main-content">
      <div class="page-title"></div>
		<div class="row">
		  <div class="col-lg-12">
		    <div class="widget-container fluid-height clearfix">
		      <div class="heading">
		        <i class="fa fa-user"></i>Edit Ad Details
		      </div>
		      <div class="widget-content padded"><br>
		      <center> <div class="loader"></div> </center>
		        <form accept-charset="utf-8" action="#" class="form-horizontal form_edit_advertise" enctype="multipart/form-data">
		        <?php foreach($get_advertisment as $advertisment_details) { ?>

		        	<input type="hidden" name="advertise_id" value="<?php echo $advertisment_details['id']; ?>">
		            <label class="control-label col-md-2">Campaign</label>
		            <div class="form-group">
		            <div class="col-md-7">
		              <select class="form-control" name="campaign_id" id="campaign_id">
		              	  <option value="0">Select Campaign</option>	
		              	  	<?php foreach($get_campaign_title as $campaign_title) { 
		              	  	?>
		              	  	<?php $select = "selected"; ?>
		              	  	<option value="<?php echo $campaign_title['id'];?>"
		              	  	<?php if($advertisment_details['campaign_id'] == $campaign_title['id']) {
		              	  	 echo $select; }
		              	  	?> > 
		              	  	<?php echo $campaign_title['title']; ?></option>	
		              	  	<?php } ?>
				      </select>
				      <div class="form-group">
				      	<input type="hidden" name="campaign_err">
				      </div>
		            </div>
		          </div>
		            <label class="control-label col-md-2">Ad Title</label>
		          <div class="form-group">  
		            <div class="col-md-7">
		              <input class="form-control" placeholder="Enter Ad Title" type="text" name="ad_title" value="<?php echo $advertisment_details['ad_title']; ?>">
		            </div>
		          </div>
		     
		          
		            <label class="control-label col-md-2">Ad File (Video/banner)</label>

		            <div class="form-group">
		            	<div class="col-md-7" style="">
		            		<!-- <img src="<?php echo base_url()?>assets/images/add_video_here.png" style="background: black; opacity: 1px; width: 101%;"> -->
		            		<img src="<?php echo base_url()?>assets/images/fileupload_bg.jpg" style="background: black; opacity: 1px; width: 100%; height: 420px;">
				            <div class="video-player">
									<div id="data-vid" class="large-8 columns">

										<div id="data-vid" class="large-8 columns">
										<video style="position:absolute; top:38px; left:10%; width:540px; height:auto; border:1px solid black; border-radius:20px;" controls>
											<source id="vid-source" src="<?php echo base_url($advertisment_details['ad_file']); ?>" type="video/mp4">
										</video>
									</div>

									</div>
				            </div><br><br>

				            
			            	<div id="preview" class="image-player">
			            	<?php if($advertisment_details['ad_file_img'] == "") { ?>
			            		<img class="cls" src="<?php echo base_url();?>files/images/dummy_banner.jpg">
			            	<?php	} else {  ?>
			            		<img class="cls" src="<?php echo base_url() ?><?php echo $advertisment_details['ad_file_img'] ?>">
			            	<?php } ?>	

							</div>
				            <div class="col-md-6">
				            	<label style="font-size: 18px;"><strong> choose video file :- </strong> </label> <input type="file" id="the-video-file-field" name="video_file" accept=".png, .jpg, .jpeg, .mp4, .mov, .avi" value="<?php echo $advertisment_details['ad_file'] ?>">
				            </div>
				            <div class="col-md-6">
				            	<label style="font-size: 18px;"><strong> choose image file :- </strong> </label> <input type="file" id="the-photo-file-field" name="image_file" accept="image/*">
				            </div>

				            <input type="hidden" name="fetch_video_data" id="fetch_video_data" value="<?php echo $advertisment_details['ad_file']; ?>">
				            <input type="hidden" name="fetch_image_data" id="fetch_image_data" value="<?php echo $advertisment_details['ad_file_img']; ?>">
				            <input type="hidden" name="file_err">


		            	</div>
		          	</div>

		          	  <div class="form-group">
			            <label class="control-label col-md-2"> Ad Description </label>
				            <div class="col-md-7">
				              <textarea name="description" rows="4" required="" class="form-control"  placeholder="Description"> <?php echo $advertisment_details['ad_description']; ?> </textarea>
				            </div>
				      </div>
				      <div class="form-group">
			            <label class="control-label col-md-2"> </label>
				            <div class="col-md-7">
				              <input type="hidden" name="description_err" id="description_err">
				            </div>
				      </div>
			          <div class="form-group">
				            <label class="control-label col-md-2"> Status </label>
				            <div class="col-md-7">
				            <?php 
				            if($advertisment_details['status'] == "Active") 
				            	{ $active = "checked"; $inactive = ""; }
				            else if($advertisment_details['status'] == "Inactive")
				            	{ $inactive = "checked"; $active = ""; } ?>
				              <label class="radio-inline"><input name="status" type="radio" value="Active" <?php echo $active; ?>><span>Active</span></label>
				              <label class="radio-inline"><input name="status" type="radio" value="Inactive" <?php echo $inactive; ?> ><span>Inactive </span></label>
				            
				            </div>
					  </div>
			          <div class="form-group">
			            <label class="control-label col-md-2"></label>
			            <div class="col-md-7">
			              <button class="btn btn-primary edit_advertise" type="button">Submit</button> 
			              <a href="<?php echo base_url();?>common_admin/view_admin_advertisment"> <button class="btn btn-default-outline" type="button">  Cancel </button></a>
			            </div>
			          </div>
		          <?php } ?>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
	</div>


<?php echo get_footer(); ?>