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
      	width: 425px;
      	height: auto;
      }


    </style>

    <link href="http://vjs.zencdn.net/6.2.4/video-js.css" rel="stylesheet">

  <!-- If you'd like to support IE8 -->
  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
 <!-- <script src="<?php echo base_url();?>assets/javascripts/video_size_validations.js"></script>-->

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
		      <center> <div class="loader"></div> </center>
		        <form accept-charset="utf-8" action="#" class="form-horizontal form_add_advertise" enctype="multipart/form-data">
		        	<div class="row">
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
		            <label class="control-label col-md-2" style="margin-top:25px;">Ad Title</label>
		          <div class="form-group">  

		            <div class="col-md-7">
		            	<label style="font-size:14px;" class="pull-right"><span id="count_input"></span> characters remaining </label>
		              <input class="form-control" id="ad_title" maxlength="10" placeholder="Enter Ad Title" type="text" name="ad_title">
		            </div>
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
		           <input type="hidden" name="video_upload_size" id="video_upload_size" value="">
		            <label class="control-label col-md-2">Ad File (Video/banner)</label>
		            <div class="form-group">
		            	<div class="col-md-7" style="">
		            		<!-- <img src="<?php echo base_url()?>assets/images/add_video_here.png" style="background: black; opacity: 1px; width: 101%;"> -->
		            		<img class="ad_benner_image_bg" src="<?php echo base_url()?>assets/images/fileupload_bg.jpg" style="background: black; opacity: 1px; width: 100%; height: 420px;">
				            <div class="video-player">
				        <h1 style="display: none;margin: 17% 20%;font-size: 24px;">Drag and Drop Video/Image files</h1>
									<div id="data-vid" class="large-8 columns">
									
									</div>
				            </div><br><br>

				            
			            	<div id="preview" class="image-player" style="text-align: center;">
			            		<!--<div class="drag_image_only">-->
			            			
			            			<h1 style="display: none;"> Drag and Drop Image files  </h1>

			            		<!--</div>-->
							</div>
							<p id="invalid_file_type_error" style="color: red;"></p>
							<label>	Note:- File name for ad or banner should not contain any special characters.Max file size of 30 MB is allowed. </label>
				            <div class="col-md-6">
				            	<label style="font-size: 18px;"><strong> Choose Ad File : </strong> </label> <input type="file" id="the-video-file-field" name="video_file" accept=".mp4,.mov, .jpg, .png, jpeg" > <br> <label> Video/Image files allowed <br> (.mp4,.mpeg-2, .jpg, .png, .jpeg) </label>
                            <br> <input type="hidden" name="file_err">
                              <br> <input type="hidden" name="file_err_size">
                              <input type="hidden" name="f_du" id="f_du">
                            <br><p id="demo" style="color: red"></p>
				            </div>
				            <div class="col-md-6">
				            	<label style="font-size: 18px;"><strong> Choose Banner File : </strong> </label> <input type="file" id="the-photo-file-field" name="image_file" accept=".jpg, .png, .jpeg"> <br> <label>Image files allowed <br> (.jpg, .png, .jpeg ) </label> <br>
                            <input type="hidden" name="image_file_err">
                             <!--name="image_file"-->
				            </div>
								
				        
		            	</div>		            	
		          	</div>	
		          
	                	

		          	<div class="form-group">
			            <label class="control-label col-md-2" style="margin-top:15px;"> Ad Description </label>
			            <div class="col-md-7">
			            
						  <label style="font-size:14px;" class="pull-right"><span id="count"></span> characters remaining </label>
						
			              <textarea name="description" maxlength="140" rows="4" required id="ad_description" class="form-control" placeholder="Enter Ad Description"></textarea>
			             <label> Note : Above information will be sent to rider on tablet when more information is requested by rider. </label>
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
				              <label class="radio-inline"><input name="status" type="radio" checked="" value="active"><span>Active</span></label>
				              <label class="radio-inline"><input name="status" type="radio" value="inactive"><span>Inactive </span></label>
				            </div>
					  </div>
					  <div class="form-group">
				            <label class="control-label col-md-2"> Spend </label>
				            <div class="col-md-7">
				              <label class="radio-inline"><input name="spend" type="radio" checked="" value="CPM"><span>CPM (Impression Cost)</span></label>
				              <label class="radio-inline"><input name="spend" type="radio" value="CPV"><span>CPV (View cost) </span></label>
				            </div>
					  </div>

					 <div class="form-group hide_progress">
			          	<label class="control-label col-md-2"></label>
			          	<div class="col-md-7" style="">
				          	<div class="progress progress-striped active chq">
			                      <div class="progress-bar" style="width: 1%"></div>
			                </div>     
		                </div>
	                </div> 
				  
		          <div class="form-group">
		            <label class="control-label col-md-2"></label>
		            <div class="col-md-7">
		              <button class="btn btn-primary add_advertise" id="i_submit" type="button">Submit</button> 
		              <a href="<?php echo base_url();?>common_admin/view_admin_advertisment"> <button class="btn btn-default-outline" type="button">  Cancel </button></a>
		            </div>
		          </div>
		        </form>
		        <audio id="audio"></audio>
		      </div>
		    </div>
		  </div>
		</div>
	</div>



<script src="http://vjs.zencdn.net/6.2.4/video.js"></script>
  <!--<script src="<?php /*echo base_url();*/?>assets/javascripts/video.js"></script>-->

<?php echo get_footer(); ?>
<script type="text/javascript">
  	$(document).ready(function(){
  		$('.hide_progress').hide();
  	});	
</script>

<script type="text/javascript">
/*maxCharacters = 160;

	$('#count').text(maxCharacters);

	$('textarea').bind('keyup keydown', function() {
	    var count = $('#count');
	    var characters = $(this).val().length;

	    if (characters > maxCharacters) {
	        count.addClass('over');
	    } else {
	        count.removeClass('over');
	    }

	    count.text(maxCharacters - characters);
	});
	
	$('textarea#ad_description').keypress(function(e) {        
        if (this.value.length >= 160) {
            e.preventDefault();
        } 
    });*/

/* changes for new document */

    var maxLength = 140;
    $('#count').text(maxLength);
$('#ad_description').keyup(function() {
  var textlen = maxLength - $(this).val().length;

  $('#count').text(textlen);
});

maxLength_input_title = 10;
$('#count_input').text(maxLength_input_title);
$('#ad_title').keyup(function(e) {
	//alert($(this).val().length);
  var textlen = maxLength_input_title - $(this).val().length;

  $('#count_input').text(textlen);

/*if ($(this).val().length > maxLength_input_title) {
	e.preventDefault();
       $(this).val($(this).val().substr(0, maxLength_input_title));    
           
        }*/


});


  /*$("textarea#ad_description").bind("paste", function(e){
    // access the clipboard using the api
    if (this.value.length >= 160) {
            e.preventDefault();
            this.value = this.value.substring(0, 160);
        } 
} );*/


  /*  $(document).ready(function(){
   $('#ad_title').bind('keyup', function(){

     var ad_title_char = ("#ad_title").val();

    // alert(ad_title_char);




   });


    });*/


    /* for drag and drop */
      // preventing page from redirecting



</script>

<script>
// Code to get duration of audio /video file before upload - from: http://coursesweb.net/

//register canplaythrough event to #audio element to can get duration
var f_duration =0;  //store duration
document.getElementById('audio').addEventListener('canplaythrough', function(e){
  //add duration in the input field #f_du
  f_duration = Math.round(e.currentTarget.duration);
  document.getElementById('f_du').value = f_duration;
  URL.revokeObjectURL(obUrl);
});

//when select a file, create an ObjectURL with the file and add it in the #audio element
var obUrl;
document.getElementById('the-video-file-field').addEventListener('change', function(e){
  var file = e.currentTarget.files[0];
  //check file extension for audio/video type
  if(file.name.match(/\.(avi|mp3|mp4|mpeg|ogg)$/i)){
    obUrl = URL.createObjectURL(file);
    document.getElementById('audio').setAttribute('src', obUrl);
  }
});
</script>