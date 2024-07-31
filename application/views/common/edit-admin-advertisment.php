
<!--

Summary :- edit advertisment dummy page 2. page not in use

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
      	max-height: 66px;
      	border: 2px dotted white;
      	border-radius: 20px;
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
		        <i class="fa fa-user"></i>Add Ad Details
		      </div>
		      <div class="widget-content padded"><br>
		        <form accept-charset="utf-8" action="#" class="form-horizontal form_edit_advertise" enctype="multipart/form-data">
		            <label class="control-label col-md-2">Campaign</label>
		            <div class="form-group">
		            <div class="col-md-7">
		              <select class="form-control" name="campaign_id" id="campaign_id">
		              	  <option value="0">Select Campaign</option>	
		              	  	<?php foreach($get_campaign_title as $campaign_title) { ?>
		              	  		<option value="<?php echo $campaign_title['id']; ?>"><?php echo $campaign_title['title']; ?></option>	
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
		              <input class="form-control" placeholder="Enter Ad Title" type="text" name="ad_title">
		            </div>
		          </div>
		         <!-- <label class="control-label col-md-2">Ad Location</label>
		          <div class="form-group">  
		            <div class="col-md-7">
		              <select class="form-control" name="ad_location" id="ad_location">
		              	  <option value="0">Select Location</option>	
			              <option value="Location 1">Location 1</option>
			              <option value="Location 2">Location 2</option>
			              <option value="Location 3">Location 3</option>
				      </select>
				      <div class="form-group">
				      	<input type="hidden" name="location_err">
				      </div>
		            </div>
		          </div> -->
		         <!-- <label class="control-label col-md-2"></label>
		          <div class="form-group">  
		            <div class="col-md-7">
		              <div class="widget-container">
			              <div class="heading">
			                <i class="fa fa-map-marker"></i>Interactive global map<i class="fa fa-plus pull-right"></i><i class="fa fa-refresh pull-right"></i>
			              </div>
			              <div class="widget-content">
			                <div class="map" id="vmap" style="height: 200px;"></div>
			              </div>
			            </div>
		            </div>
		          </div> -->

		          <!-- Start google maps api  -->

		         <!-- <label class="control-label col-md-2"></label>
		          <div class="form-group">  
		            <div class="col-md-7">
		               <div class="pac-card" id="pac-card">
					      <div>
					        <div id="title">
					          Autocomplete search
					        </div>
					        <div id="type-selector" class="pac-controls">
					          <input type="radio" name="type" id="changetype-all" checked="checked">
					          <label for="changetype-all">All</label>

					          <input type="radio" name="type" id="changetype-establishment">
					          <label for="changetype-establishment">Establishments</label>

					          <input type="radio" name="type" id="changetype-address">
					          <label for="changetype-address">Addresses</label>

					          <input type="radio" name="type" id="changetype-geocode">
					          <label for="changetype-geocode">Geocodes</label>
					        </div>
					        <div id="strict-bounds-selector" class="pac-controls">
					          <input type="checkbox" id="use-strict-bounds" value="">
					          <label for="use-strict-bounds">Strict Bounds</label>
					        </div>
					      </div>
					      <div id="pac-container">
					        <input id="pac-input" type="text"
					            placeholder="Enter a location">
					      </div>
					    </div>
					    <div id="map"></div>
					    <div id="infowindow-content">
					      <img src="" width="16" height="16" id="place-icon">
					      <span id="place-name"  class="title"></span><br>
					      <span id="place-address"></span>
					    </div>
		            </div>
		          </div> -->


		          <!-- End google maps api -->
		          
		            <label class="control-label col-md-2">Ad File (Video/banner)</label>



		            <div class="form-group">
		            	<div class="col-md-7" style="">
		            		<img src="<?php echo base_url()?>assets/images/fileupload_bg.jpg" style="background: black; opacity: 1px; width: 100%; height: 420px;">
				            <div class="video-player">
									<div id="data-vid" class="large-8 columns">
									</div>
				            </div><br><br>

				            <div id="preview" class="image-player">
				            	<img class="cls" src="<?php  ?>">
							</div>
				            <div class="col-md-6">
				            	<label style="font-size: 18px;"><strong> choose video file :- </strong> </label> <input type="file" id="the-video-file-field" name="video_file" accept="video/*">
				            </div>
				            <div class="col-md-6">
				            	<label style="font-size: 18px;"><strong> choose image file :- </strong> </label> <input type="file" id="the-photo-file-field" name="image_file" accept="image/*">
				            </div>
				            <input type="hidden" name="file_err">
		            	</div>
		          	</div>
		          <div class="form-group">
			            <label class="control-label col-md-2"> Status </label>
			            <div class="col-md-7">
			              <label class="radio-inline"><input name="status" type="radio" checked="" value="active"><span>Active</span></label>
			              <label class="radio-inline"><input name="status" type="radio" value="inactive"><span>Inactive </span></label>
			            </div>
				  </div>
		          <div class="form-group">
		            <label class="control-label col-md-2"></label>
		            <div class="col-md-7">
		              <button class="btn btn-primary edit_advertise" type="button">Submit</button> 
		              <a href="<?php echo base_url();?>common_admin/view_admin_advertisment"> <button class="btn btn-default-outline" type="button">  Cancel </button></a>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
	</div>




<?php echo get_footer(); ?>