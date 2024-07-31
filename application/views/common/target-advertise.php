

<!--

summary : view target advertisement page

-->

<?php
require_once('functions.php');

?>
<!--Initialize Header section and css files-->

<style type="text/css">
  #map {
        height: 70%;
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
      #target {
        width: 345px;
      }
    .modal-dialog1{
        position: relative;
        right: auto;
        left: 0%;
        width: 100%;
        padding-top: 30px;
        padding-bottom: 30px;
    }
    .modal-body {
      position: relative !important;
      padding: 0px !important;
    }
</style>



<?php echo get_header(); ?>
</div>
      <div class="container-fluid main-content">
      <div class="page-title"></div>
      <div class="widget-container fluid-height clearfix">
      <div class="row">
              <div class="loader"> </div>
              <!--<div class="col-md-4"></div>-->
              <div class="col-md-12">
              <div class="widget-content"><br>
                <form action="#" class="form-horizontal" style="text-align: center; margin-bottom: 0px;">
                  <img src="<?php echo base_url();?>assets/images/target.png" style="width: 30%"><br><br>
                  <?php 
                  foreach($ad_name as $ad_data) {
                  ?>
                  <div class="col-md-3 col-md-offset-3">
                    <label class="control-label col-md-7" style="font-weight: bold;"> Campaign Name :- </label>
                    <div class="col-md-5">
                     <label class="" style="padding-top:7px;"> <?php echo $ad_data['title']; ?>  </label>
                    </div>

                  </div>
                  
                  <div class="col-md-3">
                    <label class="control-label col-md-7" style="font-weight: bold;"> Ad Name :- </label>
                    <div class="col-md-5">
                      <label class="" style="padding-top:7px;"> <?php echo $ad_data['ad_title']; ?> </label>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="row">
                  <div class="">
                    <input type="hidden" name="encode_data" id="encode_data" style="width: 100%;">
                  </div>

                  <div class="">
                    <div class="hidden">  <button type="button" id="submit" name="submit" class="btn-sm btn-primary apply_target_ad" onclick="ad_within_rider_path()" > Validate </button> </div>
                  </div>

                  <div class="">
                    <input type="hidden" name="encode_datas" id="encode_datas" style="width: 100%;">

                  </div>

                  <div class="">
                    <input type="hidden" name="encode_data_m" id="encode_data_m" style="width: 100%;">
                  </div>

                  <input type="hidden" id="advertise_id" name="advertise_id" value="<?php echo $this->uri->segment(3); ?>">
                  <div class="form-group col-md-9">
                    <input type="hidden" name="encode_datas_ml" id="encode_datas_ml" style="width: 100%;">
                    <input type="hidden" name="" id="lat_value" >
                    <input type="hidden" name="" id="long_value" >
                  </div>

                  <?php  

                  $lat1 = '';
                    $lat2 = '';
                    $lat3 = '';
                    $lat4 = '';

                    $lng1 = '';
                    $lng2 = '';
                    $lng3 = '';
                    $lng4 = '';

                  $id = $this->uri->segment(3); 
                  $this->db->select('*');
                  $this->db->from('advertise');
                  $this->db->where('id',$id);
                  $query = $this->db->get();

                  if($query->num_rows() == '0'){
                    $lat1 = '';
                    $lat2 = '';
                    $lat3 = '';
                    $lat4 = '';

                    $lng1 = '';
                    $lng2 = '';
                    $lng3 = '';
                    $lng4 = '';
                  } else {
                    $query_result = $query->result_array();
                 
                    $value= '';
                    $var_value = [];
                    $response = array();
                    

                    foreach ($query_result as $val) {
                      $explode = explode(",", $val['ad_area']);
                    }
                    for($i=0; $i<count($explode); $i++){
                     // $value .='{'.$explode[$i].'},';
                      // $value =$explode[$i]; 
                      // array_push($var_value,$value);
                    if($explode[$i] == ''){
                      $lat1 = '';
                    $lat2 = '';
                    $lat3 = '';
                    $lat4 = '';

                    $lng1 = '';
                    $lng2 = '';
                    $lng3 = '';
                    $lng4 = '';
                    } else {
                      if(!$explode[0]) {
                        $lat1 = $explode[0];
                      } else {
                        $lat1 = $explode[0];
                      }
                        
                        $lat2 = $explode[2];
                        $lat3 = $explode[4];
                      if(isset($explode[6])) {
                        $lat4 = $explode[6];
                      }
                      

                        $lng1 = $explode[1];
                        $lng2 = $explode[3];
                      if(isset($explode[5])) {
                        $lng3 = $explode[5];
                      }
                        
                      if(isset($explode[7])) {
                         $lng4 = $explode[7];
                      }
                       
                    }

                    }

                    }                        
                    ?>      
                  

                  
                    <!-- <?php echo $value; ?>  -->
                    <input type="hidden" name="" id="lat1" value="<?php echo $lat1; ?>">
                    <input type="hidden" name="" id="lat2" value="<?php echo $lat2; ?>">
                    <input type="hidden" name="" id="lat3" value="<?php echo $lat3; ?>">
                    <input type="hidden" name="" id="lat4" value="<?php echo $lat4; ?>">

                    <input type="hidden" name="" id="lng1" value="<?php echo $lng1; ?>">
                    <input type="hidden" name="" id="lng2" value="<?php echo $lng2; ?>">
                    <input type="hidden" name="" id="lng3" value="<?php echo $lng3; ?>">
                    <input type="hidden" name="" id="lng4" value="<?php echo $lng4; ?>">

                  
                  <!-- <?php echo json_encode(array_values($other_value));  ?> -->
                  </div>
                  <!-- <input type="text" name="ad_area" id="ad_area" value="<?php echo $value; ?>"> -->
                  <div class="form-group col-md-12" style="margin-bottom: 0px;">
                   <p style="float: left;margin-top: 10px;display: inline-block;"><span style="font-weight: 900;font-size: 16px;">Note</span> : Click on the map to select ad targeting area. Please provide 5 points(clicks) and click "Apply" button to complete selection.</p>
                   <!--<button type="button" id="submit" name="submit" class="btn-lg btn-primary apply_target_ad_by_jquery" onclick="apply_target_ad()" > Apply </button>-->
                   <div class="pull-right">
                    <button type="button"  style="padding: 5px 16px; margin-right: 10px;" id="submit" name="submit" class="btn-lg btn-primary apply_target_ad_by_jquery" onclick="apply_target_ad()" > Apply </button>
                    <a href="<?php echo base_url(); ?>common_admin/view_admin_advertisment"><button type="button" style="padding: 5px 16px;" class="btn-lg btn-primary"> Back </button></a>
                  </div>
                  </div>

                </form>
                </div>
              </div>
             <!--<div class="col-md-2">
             
             </div>-->
        </div>

    		<div class="row" style="margin-top: 0px;">
    		  <div class="col-lg-12">
    		    <div class="widget-container fluid-height clearfix">		      	  
    		      <div class="container-fluid main-content">
                <div class="pac-card" id="pac-card" style="display: none;">
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
    		      <!-- Data table ending here -->

    		    </div>
    		  </div>
    		</div>
        <div class="col-md-12">
        <div class="col-md-5"></div>
        <div class="col-md-4">
          
        </div>
        <div class="col-md-2"></div>
        </div>
        </div>
	</div>



<?php echo get_footer(); ?>
<script type="text/javascript">
    $(document).ready(function(){

        $('.span_id').on('click', function(){
          text = $(this).closest('td').find('span#ading_id').text();
          var campaign_name = $(this).closest('td').find('span#campaign_title').text();
          var ad_title = $(this).closest('td').find('span#ads_title').text();
          $('#txt_ad_name').text(ad_title);
          $('#txt_campaign_name').text(campaign_name);
        });
    });

</script>     
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyxloxQJOEsrXbKVBDIPSuxb0RDJE58Ek&libraries=places&callback=initMap&libraries=geometry&sensor=false"
        async defer></script>  
<!-- <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false"></script> -->


<script type="text/javascript">
      
      

      var highlight_area = [];
      
      
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -1.28333, lng: 36.81667},
          zoom: 5
        });

        var poly = new google.maps.Polyline({
          strokeColor: '#000000',
          strokeOpacity: 1,
          strokeWeight: 3,
          map: map
        });        
        // Add a listener for the click event
        google.maps.event.addListener(map, 'click', function(event) {
          addLatLngToPoly(event.latLng, poly);
        });
        
       

        x = [highlight_area];        
        apply_target_ad(x);        

        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }

      /**
       * Handles click events on a map, and adds a new point to the Polyline.
       * Updates the encoding text area with the path's encoded values.
       */

      var global_variable = 0;
      var maximum_lat = 0;
      var maximum_long = 0;
      var bermudaTriangle = '';  
      var map_clear = 0;
       function apply_target_ad(x) {

         
         
         // highlight_area.push(arr_value);
         // console.log(highlight_area);
          // global_variable = '0';    

          var triangleCoords = [];
          // var lat1 = -1.2665861288032;
          // [{"lat":-1.2676158452083304,"lng":36.90908432006836},
          // {"lat":-1.3288832226055762,"lng":36.80591583251953},
          // {"lat":-1.2784278426751117,"lng":36.67339324951172},
          // {"lat":-1.241529570963064,"lng":36.76248550415039}]

       

          var lat1 = parseFloat(document.getElementById('lat1').value);
          var lng1 = parseFloat(document.getElementById('lng1').value);

          var lat2 = parseFloat(document.getElementById('lat2').value);
          var lng2 = parseFloat(document.getElementById('lng2').value);

          var lat3 = parseFloat(document.getElementById('lat3').value);
          var lng3 = parseFloat(document.getElementById('lng3').value);

          var lat4 = parseFloat(document.getElementById('lat4').value);
          var lng4 = parseFloat(document.getElementById('lng4').value);


          var highlight_area = [
           {lat:lat1,lng:lng1},
           {lat:lat2,lng:lng2},
           {lat:lat3,lng:lng3},
           {lat:lat4,lng:lng4}
         ];

         console.log(highlight_area);
        
          

          var x = highlight_area;
          
          for(var index in x) {
           if (x.hasOwnProperty(index)) {
               var value = x[index];
               // var lat = value['lat'];
               // var lng = value['lng'];
               triangleCoords.push(value);              
           }
        }

        triangleCoords = highlight_area;

        

        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -1.28333, lng: 36.81667},
          zoom: 13
        });
        
          bermudaTriangle = new google.maps.Polygon({
            paths: triangleCoords,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 3,
            fillColor: '#FF0000',
            fillOpacity: 0.35
          });
          bermudaTriangle.setMap(map);  
          console.log(bermudaTriangle.getPath());
          // if(bermudaTriangle.getPath().length > 5){
          //    bermudaTriangle.setMap(null);
          //    google.maps.event.clearListeners(map, 'bounds_changed');
          // }

         var poly = new google.maps.Polyline({
          strokeColor: '#000000',
          strokeOpacity: 1,
          strokeWeight: 3,
          map: map
        });        
        // Add a listener for the click event
        google.maps.event.addListener(map, 'click', function(event) {
          addLatLngToPoly(event.latLng, poly);
        }); 

          
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
        });

        alert('okkk') ;   

        
       }


      function addLatLngToPoly(latLng, poly) {
        var path = poly.getPath();
        path.push(latLng);
        
        highlight_area.push(latLng);

        if(global_variable == '0'){
          //clear map   
          bermudaTriangle.setMap(null);
          highlight_area = [];
          document.getElementById('encode_data').value = latLng;  
          global_variable++;
        } else { 
          document.getElementById('encode_datas').value = latLng;  
          global_variable++;
        } 
         console.log(global_variable);
        var ltln = latLng;  
        var splitstr = ltln.toString().split(",");
        //console.log('lat :' +splitstr[0]+ '');
        //console.log('long :' +splitstr[1]+ '');
        var first_value = splitstr[0];
        var second_value = splitstr[1];
        if(global_variable == '1'){
          
          maximum_lat = first_value;
          maximum_long = second_value; 
          console.log(maximum_lat); 
          console.log(maximum_long); 
        }

        else {
          
          if(maximum_lat < first_value){
          maximum_lat = first_value; 
          console.log(maximum_lat); 
          }        
          if(maximum_long < second_value){
            maximum_long = second_value;
            console.log(maximum_long);
          }  
        }

        
        
      
      document.getElementById('encode_data_m').value = maximum_lat;  
      document.getElementById('encode_datas_ml').value = maximum_long;    
        // Update the text field to display the polyline encodings
        /* var encodeString = google.maps.geometry.encoding.encodePath(path);
        if (encodeString) {
          document.getElementById('encoded-polyline').value = encodeString;
        } */
      }


      function ad_within_rider_path() {
        var latLng = new google.maps.LatLng(19.774,-80.190);

        var ltln = latLng;  
        var splitstr = ltln.toString().split(",");
        //console.log('lat :' +splitstr[0]+ '');
        //console.log('long :' +splitstr[1]+ '');
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 25.774, lng: -80.190},
          zoom: 13
        });

        var triangleCoords = [
          {lat: 25.774, lng: -80.190},
          {lat: 18.466, lng: -66.118},
          {lat: 32.321, lng: -64.757},
          {lat: 22.321, lng: -54.757}
        ];

         bermudaTriangle = new google.maps.Polygon({
            paths: triangleCoords,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 3,
            fillColor: '#FF0000',
            fillOpacity: 0.35
          });

         bermudaTriangle.setMap(map); 

         google.maps.event.addListener(map, 'click', function(event) {
          //addLatLngToPoly(event.latLng, poly);
          var lat_Lng = document.getElementById('encode_data').value = event.latLng;
          console.log('latLng '+lat_Lng+'');
          var isWithinPolygon = google.maps.geometry.poly.containsLocation(lat_Lng, bermudaTriangle);
          console.log(isWithinPolygon);
        });  

        

      }


      function ad_within_rider_path_db() {
        var latLng = new google.maps.LatLng(19.774,-80.190);

        var ltln = latLng;  
        var splitstr = ltln.toString().split(",");
        //console.log('lat :' +splitstr[0]+ '');
        //console.log('long :' +splitstr[1]+ '');
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 25.774, lng: -80.190},
          zoom: 13
        });

        var triangleCoords = [
          {lat: 25.774, lng: -80.190},
          {lat: 18.466, lng: -66.118},
          {lat: 32.321, lng: -64.757},
          {lat: 22.321, lng: -54.757}
        ];

         bermudaTriangle = new google.maps.Polygon({
            paths: triangleCoords,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 3,
            fillColor: '#FF0000',
            fillOpacity: 0.35
          });

         bermudaTriangle.setMap(map); 

         google.maps.event.addListener(map, 'click', function(event) {
          //addLatLngToPoly(event.latLng, poly);
          var lat_Lng = document.getElementById('encode_data').value = event.latLng;
          console.log('latLng '+lat_Lng+'');
          var isWithinPolygon = google.maps.geometry.poly.containsLocation(lat_Lng, bermudaTriangle);
          console.log(isWithinPolygon);
        });  

          

      }

    $(document).ready(function(){      

      $('.apply_target_ad_by_jquery').on('click', function(){
        
        var array_ad = JSON.stringify(highlight_area);
        var ad_id = $('#advertise_id').val();
        if(global_variable < 5){    
        global_variable = '0';      
          swal(
            'Oops...',
            'Please select minimum 5 area',
            'error'
          );
          return false;
        }
        if(global_variable > 5){          
          global_variable = '0';
          swal(
            'Oops...',
            'Please select maximum 5 area',
            'error'
          );
          return false;
        } 
        else {
          $('.loader').show();  
          $.ajax({
            type: "POST",        
            url: base_url+"common_admin/manage_target_ad/",
            data:{
              array_ad : array_ad,
              ad_id : ad_id
            },
            dataType:"text",            
                   success : function(data) { 
                    $('.loader').hide();          
                    if(data){
                      swal({ 
                            title: "Congratulation!",
                            text: "Ad Targeted success fully",
                            type: "success" 
                            },
                            function(){
                                alert('ok');
                            }); 
                            $('.swal2-confirm').click(function(){
                                  location.reload();
                            });
                    } else {
                      alert('ok');
                    }                                                   
                   }
             }); 
        }

      });
    });      

  /*    function apply_target_ad(poly){
          var path = poly.getPath();
          // Because path is an MVCArray, we can simply append a new coordinate
          // and it will automatically appear
          var latLng = document.getElementById('encode_data').value;
          path.push(latLng);
          console.log(latLng);
      } */


        // Add a listener for the click event
        


      
    </script>
     
