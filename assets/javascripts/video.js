//check if browser supports file api and filereader features
if (window.File && window.FileReader && window.FileList && window.Blob) {
	
   //this is not completely neccesary, just a nice function I found to make the file size format friendlier
	//http://stackoverflow.com/questions/10420352/converting-file-size-in-bytes-to-human-readable
	function humanFileSize(bytes, si) {
	    var thresh = si ? 1000 : 1024;
	    if(bytes < thresh) return bytes + ' B';
	    var units = si ? ['kB','MB','GB','TB','PB','EB','ZB','YB'] : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
	    var u = -1;
	    do {
	        bytes /= thresh;
	        ++u;
	    } while(bytes >= thresh);
	    return bytes.toFixed(1)+' '+units[u];
	}


  //this function is called when the input loads an image
	function renderImage(file){
		var reader = new FileReader();
		reader.onload = function(event){
			the_url = event.target.result
      //of course using a template library like handlebars.js is a better solution than just inserting a string
			$('#preview').html("<img class='cls' src='"+the_url+"' />")
			$('#name').html(file.name)
			$('#size').html(humanFileSize(file.size, "MB"))
			$('#type').html(file.type)
		}
    
    //when the file is read it triggers the onload event above.
		reader.readAsDataURL(file);
	}

  
  //this function is called when the input loads a video
	function renderVideo(file){
		var reader = new FileReader();
		reader.onload = function(event){
		
		the_url = event.target.result
      //of course using a template library like handlebars.js is a better solution than just inserting a string
      // $('#data-vid').html(
      // 	"<video style='position:absolute; top:38px; left:10%; width:540px; height:320px; border:0px solid black; border-radius:20px;'autoplay='autoplay'oplay' controls poster="+the_url+"><source id='vid-source' src='"+the_url+"' type='video/mp4'> <source id='vid-source' src='"+the_url+"' type='video/quicktime'> <source id='vid-source' src='"+the_url+"' type='video/ogg'><source id='vid-source' src='"+the_url+"' type='video/webm' /> <source id='vid-source' src='"+the_url+"' type='video/avi' /> </video> ")

      $('#data-vid').html('<video id="my-video" style="position: absolute;top: 0px;left: 0%;width: 521px;height: 268px;border: 0px solid black;border-radius: 15px;" class="video-js" controls autoplay="autoplay" poster="'+the_url+'" data-setup="{}"><source src="'+the_url+'" type="video/mp4"><source src="'+the_url+'" type="video/webm"><source src="'+the_url+'" type="video/mp4" /><p class="vjs-no-js"><a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>  </p></video>')

      	$('#name-vid').html(file.name)
			$('#size-vid').html(humanFileSize(file.size, "MB"))
			$('#type-vid').html(file.type)
		// $('.hide_progress').hide()	
		}
    
    //when the file is read it triggers the onload event above.
		reader.readAsDataURL(file);
		// $('.hide_progress').show();		

		return 1;
	}

  

  //watch for change on the 
	$( "#the-photo-file-field" ).change(function() {
		console.log("photo file has been chosen")
		//grab the first image in the fileList
		//in this example we are only loading one file.
    //alert();
		console.log(this.files[0].size)
		renderImage(this.files[0])
    	$('#banner_file').val(this.files[0].name);

	});
  
	$( "#the-video-file-field" ).change(function() {
        // alert('yes');
		//$('.hide_progress').show();			
		console.log("video file has been chosen")
		//grab the first image in the fileList
		//in this example we are only loading one file.
		var split_txt = this.files[0].name.split('.');
		var _size = this.files[0].size;
		
		//var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
        //i=0;while(_size>900){_size/=1024;i++;}
        //var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];

       //$('#video_upload_size').val(exactSize);
    $('#video_upload_size').val(_size);
    $('#fetch_file_name').val(this.files[0].name);

		if(split_txt[1] == 'avi'){	
			swal("Error Playing!", "Please upload the file in mp4 format. You can use online video converter for any file format to mp4.", "error");			
		}
		else if(split_txt[1] == 'mov'){
			swal("Error Playing!", "Please upload the file in mp4 format. You can use online video converter for any file format to mp4. ", "error");			
		}
		
		var status = 0;
		console.log(this.files[0].size)
		console.log(this.files[0].name);
		// start
		status = renderVideo(this.files[0])				
	});

} else {

  alert('The File APIs are not fully supported in this browser.');

}



$(document).ready(function(){
 
  $(".video-player").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
       // $("h1").text("Drag here");
       document.getElementById("invalid_file_type_error").innerHTML = "";
       if($('#data-vid').children().length > 0){
       $(".video-player").removeClass("drag_video");
       $(".video-player h1").css("display","none");

       }


     //  if($('#data-vid').children().length < 1){
     	else{
      $("#data-vid").css("display","none");
       $(".video-player").addClass("drag_video");
       $(".video-player h1").css("display","block");
       }
      // $(".drag_image_only").css("display","block");
    //  $("#preview").css("background", "#fff");
     // $("#preview h1").css("display", "block");
    // }
    //else{
     //	$(".drag_image_only").css("display","block");
    // }
       
    });

    $(".video-player").on("drop", function(e) { 
    	e.preventDefault(); 
    	e.stopPropagation(); 
    });

   
    // Drag enter
    $('.video-player').on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(".video-player h1").css("text-align","center");
        $(".video-player h1").text("Drop");
    });
  
   // Drag over
    $('.video-player').on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
      $(".video-player h1").css("text-align","center");;
        $(".video-player h1").text("Drop");

    });

  /*  $('.video-player').on('dragleave', function (e) {
        e.stopPropagation();
        e.preventDefault();
     // $(".video-player h1").css("text-align","center");;
       // $(".video-player h1").text("Drop");
      // $("#data-vid").css("display","block");
       $(".video-player").removeClass("drag_video");


    });*/
   
    // Drop
    $('.video-player').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();
         
       //$(".drag_image_only").css("display","none");
     //  $("#preview").css("background", "transparent");
     // $("#preview h1").css("display", "none");
       $(".video-player").removeClass("drag_video");
       $(".video-player h1").css("display","none");

        //$("h1").text("Upload");
        
      // var file = e.originalEvent.dataTransfer.files;
       var file = e.originalEvent.dataTransfer.files;
       var filetype = file[0].type;
        var filesize = file[0].size;
        //alert(filetype);
       // var fileType = file["type"];
        //alert(filesize);
        var ValidImageTypes = ["image/jpeg", "image/jpg", "image/png", "video/mp4", "video/mpeg-2"];
        if(filesize <= 31457280){
if ($.inArray(filetype, ValidImageTypes) !== -1) {
    $("#data-vid").css("display","block");
     $('#the-video-file-field').prop('files', e.originalEvent.dataTransfer.files);
     $('#the-video-file-field').trigger('change');
}
    else{
    	$(".video-player").removeClass("drag_video");
       $(".video-player h1").css("display","none");
        
        //document.getElementById("invalid_file_type_error").innerHTML = "Drop invalid files"; 
        swal("Video/Image files allowed (.mp4,.mpeg-2, .jpg, .png, .jpeg)");
    // alert();
    }
     }
     else{
     	//alert();
     	$(".video-player").removeClass("drag_video");
        $(".video-player h1").css("display","none");
     //	document.getElementById("invalid_file_type_error").innerHTML = "Drop invalid files";
     swal("Video/Image files allowed (.mp4,.mpeg-2, .jpg, .png, .jpeg)");
     }

      

        //var fd = new FormData();

       // alert(fd.append('file', file[0]));
       //alert(file);

        //uploadData(fd);
    });

 });
/* only image drag */


    $(document).ready(function(){
    
    //alert();

     // Drag enter
 /* $('.image-player').on('dragenter', function(e) {
        e.stopPropagation();
        e.preventDefault();
 //alert();
        //$(".video-player h1").css("text-align","center");
        $("#preview").css("background","#fff");
        $("#preview h1").css("display","block");
        $("#preview h1").text("Drop");
       // $(".video-player").removeClass("drag_video");
    });

  $(".image-player").on("drop", function(e) { 
  alert()
      e.preventDefault(); 
      e.stopPropagation(); 
    });

  // Drop
    $('.image-player').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();
     
     alert();
     $('#the-photo-file-field').prop('files', e.originalEvent.dataTransfer.files);
     $('#the-photo-file-field').trigger('change');

       
    });*/

   
  $(".image-player").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
        document.getElementById("invalid_file_type_error").innerHTML = "";
       $("#preview").css("background","#fff");
        $("#preview h1").css("display","block");
        $("#preview h1").text("Drop");
       
    });

    $(".image-player").on("drop", function(e) { 
      e.preventDefault(); 
      e.stopPropagation(); 
    });

   
    // Drag enter
    $('.image-player').on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();

       // $("#preview").css("background","#fff");
        $("#preview h1").css("display","block");
        $("#preview h1").text("Drop");
       // $(".video-player h1").css("text-align","center");;
       // $(".video-player h1").text("Drop");
    });
  
   // Drag over
    $('.image-player').on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
        //$("#preview").css("background","#fff");
        $("#preview h1").css("display","block");
        $("#preview h1").text("Drop");
      //$(".video-player h1").css("text-align","center");;
      //  $(".video-player h1").text("Drop");

    });

    /*$('.image-player').on('dragleave', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("#preview").css("background","transparent");
        $("#preview h1").css("display","none");
        //$("#preview h1").text("Drop");
     // $(".video-player h1").css("text-align","center");;
       // $(".video-player h1").text("Drop");
      // $(".video-player").removeClass("drag_video");

    });*/
   
    // Drop
    $('.image-player').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();
         
        var file = e.originalEvent.dataTransfer.files;
        var filetype = file[0].type;
        var filesize = file[0].size;
       // alert(filess);
       // var fileType = file["type"];
       // alert(fileType);
        var ValidImageTypes = ["image/jpeg", "image/jpg", "image/png"];
        if(filesize <= 31457280){
if ($.inArray(filetype, ValidImageTypes) !== -1) {
     $('#the-photo-file-field').prop('files', e.originalEvent.dataTransfer.files);
     $('#the-photo-file-field').trigger('change');
}
    else{
    	$("#preview").css("background","transparent");
        $("#preview h1").css("display","none");
        swal("Image files allowed (.jpg, .png, .jpeg )");
       // document.getElementById("invalid_file_type_error").innerHTML = "Drop invalid files"; 

    // alert();
    }
     }
     else{
     	//alert();
     	$("#preview").css("background","transparent");
        $("#preview h1").css("display","none");
     	//document.getElementById("invalid_file_type_error").innerHTML = "Drop invalid files";
      swal("Image files allowed (.jpg, .png, .jpeg )");
     }

      
    });



    });


    $(document).ready(function(){
     var width = $(window).width();
     // alert(width);
     /* if(width > 1440){
           
            $("#data-vid video").css({"width": "521px", "top": "5px"});
      }*/


    });