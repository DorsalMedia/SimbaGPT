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
      	/*max-width: 425px;
      	max-height: 69px;
      	border: 2px dotted white;
      	border-radius: 20px;
      	width: 425px;
      	height: auto;*/
     max-width: 425px;
    max-height: 57px;
    border-radius: 15px;
    width: 408px;
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
		            <label class="control-label col-md-2" style="margin-top:25px;">Ad Title</label>
		          <div class="form-group">  
		            <div class="col-md-7">
		            	<label style="font-size:14px;" class="pull-right"><span id="count_input"></span> characters remaining </label>
		              <input class="form-control" maxlength="10" placeholder="Enter Ad Title" type="text" name="ad_title" id="ad_title" value="<?php echo $advertisment_details['ad_title']; ?>">
		            </div>
		          </div>
		     
		          
		            <label class="control-label col-md-2">Ad File (Video/banner)</label>

		            <div class="form-group">
		            	<div class="col-md-7" style="">
		            		<!-- <img src="<?php echo base_url()?>assets/images/add_video_here.png" style="background: black; opacity: 1px; width: 101%;"> -->
		            		<img class="ad_benner_image_bg" src="<?php echo base_url()?>assets/images/fileupload_bg.jpg" style="background: black; opacity: 1px; width: 100%; height: 420px;">
				            
				            <div class="video-player">
									<!-- <div id="data-vid" class="large-8 columns"> -->
										<?php
												$_FILES['file']['tmp_name'] = $advertisment_details['ad_file'];
												
												$filename1 = $_FILES['file']['tmp_name'];
												//$filename = $_FILES['file']['name'];
												
												$explode_some = explode(".",$filename1);
												
												$explode_some1 =  $explode_some[1];
												
												if($explode_some1 == "png"){ ?>
													<div id="data-vid" class="large-8 columns">
														<img src="<?php echo base_url($advertisment_details['ad_file']); ?>" style="/*position: absolute;top: 38px;left: 10%;width: 540px;height: 320px;border: 0px solid black;border-radius: 20px;*/position: absolute;top: 0px;left: 0%;width: 521px;/*height: 268px;*/height:auto;border: 0px solid black;border-radius: 15px;" >		
													</div>
												<?php } else if($explode_some1 == "PNG"){ ?>
													<div id="data-vid" class="large-8 columns">
													<img src="<?php echo base_url($advertisment_details['ad_file']); ?>" style="/*position: absolute;top: 38px;left: 10%;width: 540px;height: 320px;border: 0px solid black;border-radius: 20px;*/position: absolute;top: 0px;left: 0%;width: 521px;/*height: 268px;*/height:auto;border: 0px solid black;border-radius: 15px;" >		
													</div>
												<?php } else if($explode_some1 == "jpg"){ ?>
													<div id="data-vid" class="large-8 columns">
													<img src="<?php echo base_url($advertisment_details['ad_file']); ?>" style="/*position: absolute;top: 38px;left: 10%;width: 540px;height: 320px;border: 0px solid black;border-radius: 20px;*/position: absolute;top: 0px;left: 0%;width: 521px;/*height: 268px;*/height:auto;border: 0px solid black;border-radius: 15px;" >		
													</div>
												<?php } else if($explode_some1 == 'jpeg'){ ?>
													<div id="data-vid" class="large-8 columns">
													<img src="<?php echo base_url($advertisment_details['ad_file']); ?>" style="/*position: absolute;top: 38px;left: 10%;width: 540px;height: 320px;border: 0px solid black;border-radius: 20px;*/position: absolute;top: 0px;left: 0%;width: 521px;/*height: 268px;*/height:auto;border: 0px solid black;border-radius: 15px;" >		
													</div>
												<?php } else if($explode_some1 == "mp4"){ ?>
												<div id="data-vid" class="large-8 columns">
													<video style="/*position:absolute; top:38px; left:10%; width:540px; height:auto; border:1px solid black; border-radius:20px;*/position: absolute;top: 0px;left: 0%;width: 521px;/*height: 268px;*/height:auto;border: 0px solid black;border-radius: 15px;" controls>
														<source id="vid-source" src="<?php echo base_url($advertisment_details['ad_file']); ?>" type="video/mp4">
													</video>
												</div>
									<?php } ?> 	 
									
				            </div><br><br>

				            
			            	<div id="preview" class="image-player">
			            	<?php if($advertisment_details['ad_file_img'] == "") { ?>
			            		<img class="cls" src="<?php echo base_url();?>files/images/dummy_banner.jpg">
			            	<?php	} else {  ?>
			            		<img class="cls" src="<?php echo base_url() ?><?php echo $advertisment_details['ad_file_img'] ?>">
			            	<?php } ?>	

							</div>
			            	<label>	Note:- File name for ad or banner should not contain any special characters.Max file size of 30 MB is allowed. </label>
				            <div class="col-md-6">
				            	<label style="font-size: 18px;"><strong> Choose Ad File : </strong> </label> <input type="file" id="the-video-file-field" name="video_file" accept=".mp4, .mov, .jpg, .png, .jpeg" value="<?php echo $advertisment_details['ad_file'] ?>"><br>

				            	<label> Current Ad File : <?php if($advertisment_details['ad_file'] != ""){$ad_files = explode('/', $advertisment_details['ad_file']); echo $ad_files[1]; } else {echo "";} ?> </label>
				            	<!-- echo $advertisment_details['ad_file'] -->

				            	<label> Video/Image files allowed <br> (.mp4,.mpeg-2, .jpg, .png, .jpeg) </label> <br>
                              <input type="hidden" name="fetch_file_name" id="fetch_file_name" value="<?php echo $advertisment_details['ad_file'] ?>">		
							  <input type="hidden" name="file_err">
			            		<br><p id="demo" style="color: red"></p>		
				            </div>
				            <div class="col-md-6">
				            	<label style="font-size: 18px;"><strong> Choose Banner File : </strong> </label> <input type="file" id="the-photo-file-field" name="image_file" accept="image/*"> <br>

				            	<label> Current Banner File : <?php if($advertisment_details['ad_file_img'] != ""){$banner_img = explode('/',$advertisment_details['ad_file_img']);  echo $banner_img[2]; } else {echo '';} ?> </label>

				            	<label>Image files allowed <br> (.jpg, .png, .jpeg ) </label> <br>
                            <input type="hidden" name="banner_file_err">
                            <input type="hidden" name="banner_file" id="banner_file" value="<?php echo $advertisment_details['ad_file_img'] ?>">		
				            </div>

				            <input type="hidden" name="fetch_video_data" id="fetch_video_data" value="<?php echo $advertisment_details['ad_file']; ?>">
				            <input type="hidden" name="fetch_image_data" id="fetch_image_data" value="<?php echo $advertisment_details['ad_file_img']; ?>">
				            
				             <input type="hidden" name="f_du" id="f_du" value="<?php echo $advertisment_details['video_duration'];?>">

		            	</div>
		          	</div>

		          	  <div class="form-group">
			            <label class="control-label col-md-2" style="margin-top:15px;"> Ad Description </label>
				            <div class="col-md-7">
				            <label style="font-size:14px;" class="pull-right"><span id="count"></span> characters remaining </label>
				              <textarea name="description" rows="4" maxlength="140" required class="form-control" id="ad_description"  placeholder="Enter Ad Description"> <?php echo $advertisment_details['ad_description']; ?> </textarea>
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
				            <label class="control-label col-md-2"> Spend </label>
				            <div class="col-md-7">
				            <?php 
				            if($advertisment_details['spend'] == "CPM") 
				            	{ $CPM = "checked"; $CPV = ""; }
				            else if($advertisment_details['spend'] == "CPV")
				            	{ $CPV = "checked"; $CPM = ""; } ?>
				              <label class="radio-inline"><input name="spend" type="radio" value="CPM" <?php echo $CPM; ?>><span>CPM (Impression Cost)</span></label>
				              <label class="radio-inline"><input name="spend" type="radio" value="CPV" <?php echo $CPV; ?> ><span>CPV (View cost)  </span></label>
				            
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
			              <button class="btn btn-primary edit_advertise" id="i_submit" type="button">Submit</button> 
			              <a href="<?php echo base_url();?>common_admin/view_admin_advertisment"> <button class="btn btn-default-outline" type="button">  Cancel </button></a>
			            </div>
			          </div>
		          <?php } ?>
		        </form>
		         <audio id="audio"></audio>
		      </div>
		    </div>
		  </div>
		</div>
	</div>


<?php echo get_footer(); ?>
<script type="text/javascript">
  	$(document).ready(function(){
  		$('.hide_progress').hide();
  	});	
</script>
<script type="text/javascript">

/*$('textarea').trigger('keyup');

maxCharacters = 160;

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










