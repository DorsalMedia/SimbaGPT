
<!--

Summary :- View advertisment listing and delete advertisment

-->

<?php
require_once('functions.php');

?>
<!--Initialize Header section and css files-->

<style type="text/css">
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
         z-index: 2000;
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
</style>



<?php echo get_header(); ?>
</div>
      <div class="container-fluid main-content">
      <div class="page-title"></div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          
          <div class="head-design">
          <div class="heading">
            <i class="fa fa-search"></i>Search Ads
          </div>
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-7">
              <div class="widget-content padded"><br>
                <form action="#" class="form-horizontal form_search_campaign_advertise">
                
                  <div class="form-group">
                    <label class="control-label col-md-2"> Campaign </label>
                    <div class="col-md-7">
                      <select class="form-control" id="select_campaign_advertise">
                        <option value="0"> Select All Campaign </option>
                        <?php foreach($get_advertisment_campaigns as $data) {  ?>
                          <option value="<?php echo $data['id']; ?>"> <?php echo $data['title']; ?> </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <!--
                  <div class="form-group">
                    <label class="control-label col-md-2"> Ad Location </label>
                    <div class="col-md-7">
                      <select class="form-control">
                        <option value="0"> Select Ad Location </option>
                        <?php foreach($get_advertisment_details as $data) { if($data['ad_location'] == "undefined") { echo ''; ?>
                          <?php } else { ?>
                          <option value="<?php echo $data['ad_location']; ?>"> <?php echo $data['ad_location']; ?> </option>
                          <?php } ?>
                        <?php } ?>  
                      </select>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label class="control-label col-md-2"> Ad Status </label>
                    <div class="col-md-7">
                      <label class="radio-inline"><input name="campaign_status" type="radio" value="Active" checked><span>Active</span></label>
                      <label class="radio-inline"><input name="campaign_status" type="radio" value="Inactive"><span>Inactive </span></label>
                    </div>
                  </div>
                        
                        <?php if(isset($_SESSION['admin_login'])){ ?>
                  <div class="form-group">
                    <label class="control-label col-md-2">  </label>
                    <div class="col-md-7">
                     <!--  <button type="button" class="search_campaign_name"> Search </button> -->
                     <button type="button" class="search_advertisements"> Search </button>
                    </div>
                  </div>
                  <?php } else if(isset($_SESSION['enterprise_account'])){ ?>                
                  <div class="form-group">
                    <label class="control-label col-md-2">  </label>
                    <div class="col-md-7">
                     <!--  <button type="button" class="search_campaign_name"> Search </button> -->
                     <button type="button" class="search_advertisements"> Search </button>
                    </div>
                  </div>
                <?php } else if(isset($_SESSION['rydlr_admin_login'])){ ?>
                  <div class="form-group">
                    <label class="control-label col-md-2">  </label>
                    <div class="col-md-7">
                     <!--  <button type="button" class="search_campaign_name"> Search </button> -->
                     <button type="button" class="search_advertisements_for_admin"> Search </button>
                    </div>
                  </div>
                <?php } ?>
                
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
                <i class="fa fa-fw fa-bullhorn"></i>Ads Details<a class="btn btn-sm btn-primary-outline pull-right" href="<?php echo base_url();?>common_admin/view_add_admin_advertisement" id=""><i class="fa fa-plus"></i>Add</a>
              </div>
              <div class="widget-content padded clearfix">
              <div class="loader"></div>
                <form class="advertise_remove">
                <div class="table-responsive">
                <table class="table table-bordered table-striped" id="datatable-editable">
                  <thead>
                     <?php if(isset($_SESSION['rydlr_admin_login'])) { ?> 
                    <th>
                      Media Agency Name
                    </th>
                    <?php } ?>
                    <th>
                      Ad Name
                    </th>
                    <th>
                      Campaign Name
                    </th>
                    <th class="hidden-xs">
                      Status
                    </th>
                    <th class="hidden-xs">
                      Spend
                    </th>
                    <th class="hidden-xs">
                      Approval Status
                    </th>
                    <?php if(isset($_SESSION['rydlr_admin_login'])) { ?>
                    <th> Approve </th>
                    <?php } ?>
                    <!--<th> View </th>
                    <th> Edit </th>
                    <th> Delete </th>
                    <th> Target ads </th>-->
                    <th> Action </th>
                  
                  </thead>
                  <tbody>
                  <?php foreach($get_advertisment_details as $data) {  ?>
                  
                    <tr>
                      <?php if(isset($_SESSION['rydlr_admin_login'])) { ?> 
                      <td>
                        <?php echo $data['media_agency_name']; ?> 
                      </td>
                      <?php } ?>
                      <td>
                        <?php echo $data['ad_title']; ?> 
                      </td>
                      <td>
                        <?php echo $data['title']; ?> 
                      </td>                      
                      <td class="hidden-xs">
                        <?php 
                        if($data['ad_status'] == "Active"){
                          echo "Active";
                        } else if($data['ad_status'] == "Inactive"){
                          echo "Inactive";
                        } 
                         ?>
                      </td> 
                      <td class="hidden-xs">
                        <?php 
                        if($data['spend'] == "CPM"){
                          echo "CPM";
                        } else if($data['spend'] == "CPV"){
                          echo "CPV";
                        } 
                         ?>
                      </td>                      
                      <td class="hidden-xs">
                        <?php 
                        if($data['approval_status'] == '0') { 
                          echo '<span class="label label-warning">Approval Pending</span>';
                          } else {
                          echo '<span class="label label-success">Approved</span>' ;
                        } ?> 
                      </td>

                      <?php /*<?php if(isset($_SESSION['rydlr_admin_login'])) { ?> 
                        <?php if($data['approval_status'] == '0') {  ?>
                        <td>
                          <a class="approve_status" herf="#"> <i class="fa fa-fw fa-thumbs-up"> <span class="hidden" name="approve_id" id="approve_id"> <?php echo $data['advertise_id']; ?> </span> </i> </a>
                        </td>  
                         <?php } else { ?>
                        <td>
                        <?php echo ''; ?> 
                        </td> 
                        <?php } ?>
                      <?php } ?> 
            
                      <td>
                          <a href="<?php echo base_url();?>common_admin/view_only_admin_advertisement/<?php echo $data['advertise_id']; ?>"><i class="fa fa-eye"></i></a>
                        </td>
                      <!-- start action icons -->
                      
                       <!-- changes done for Rydlr 15_12_2017 comments (1) document-->
                        <?php //if($data['approval_status'] == '0') {  ?>

                         <?php if($data['approval_status'] == '0' //|| $data['approval_status'] == '1') {  ?>

                        <td>
                          <a href="<?php echo base_url();?>common_admin/view_edit_admin_advertisement/<?php echo $data['advertise_id']; ?>"><i class="fa fa-pencil"></i></a>
                        </td>
                        <td>
                        <a class="delete_advertise" href="#"><i class="fa fa-trash-o"> <span class="hidden" name="ad_id" id="ad_id"> <?php echo $data['advertise_id']; ?> </span> </i></a>
                        </td>
                        <td>
                          <a class="span_id" href="<?php echo base_url() ?>common_admin/view_target_advertise/<?php echo $data['advertise_id']; ?>"><i class="fa fa-sitemap"> <span class="hidden" id="ading_id"> <?php echo $data['advertise_id']; ?> </span> <span class="hidden" id="campaign_title"> <?php echo $data['title']; ?> </span> <span class="hidden" id="ads_title"> <?php echo $data['ad_title']; ?> </span> </i> </a>
                        </td>
                      <?php } else if(isset($_SESSION['rydlr_admin_login'])){ ?>
                         <td>
                          <a href="<?php echo base_url();?>common_admin/view_edit_admin_advertisement/<?php echo $data['advertise_id']; ?>"><i class="fa fa-pencil"></i></a>
                        </td>
                        <td>
                        <a class="delete_advertise" href="#"><i class="fa fa-trash-o"> <span class="hidden" name="ad_id" id="ad_id"> <?php echo $data['advertise_id']; ?> </span> </i></a>
                        </td>
                        <td>
                          <a class="span_id" href="<?php echo base_url() ?>common_admin/view_target_advertise/<?php echo $data['advertise_id']; ?>"><i class="fa fa-sitemap"> <span class="hidden" id="ading_id"> <?php echo $data['advertise_id']; ?> </span> <span class="hidden" id="campaign_title"> <?php echo $data['title']; ?> </span> <span class="hidden" id="ads_title"> <?php echo $data['ad_title']; ?> </span> </i> </a>
                        </td>
                        <?php } else { ?> */?>
                         
                        <?php if(isset($_SESSION['rydlr_admin_login'])) { ?> 
                        <?php if($data['approval_status'] == '0') {  ?>
                        <td>
                          <a class="approve_status" herf="#"> <i class="fa fa-fw fa-thumbs-up" data-toggle="tooltip" data-placement="top" title="Approve" style="cursor: pointer;"> <span class="hidden" name="approve_id" id="approve_id"> <?php echo $data['advertise_id']; ?> </span> </i> </a>
                        </td>  
                         <?php } else { ?>
                        <td>
                        <?php echo ''; ?> 
                        </td> 
                        <?php } ?>
                      <?php } ?> 
            
                      <td>
                          <a href="<?php echo base_url();?>common_admin/view_only_admin_advertisement/<?php echo $data['advertise_id']; ?>" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                       
                      <!-- start action icons -->
                      
                       <!-- changes done for Rydlr 15_12_2017 comments (1) document-->
                        <?php 
                          if(isset($_SESSION['rydlr_admin_login'])){
                         ?>
                        <a href="<?php echo base_url();?>common_admin/view_edit_admin_advertisement/<?php echo $data['advertise_id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                       
                        <a class="delete_advertise" href="#" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"> <span class="hidden" name="ad_id" id="ad_id"> <?php echo $data['advertise_id']; ?> </span> </i></a>
                       
                        
                        <a class="span_id" href="<?php echo base_url() ?>common_admin/view_target_advertise/<?php echo $data['advertise_id']; ?>" data-toggle="tooltip" data-placement="top" title="Target ads"><i class="fa fa-sitemap"> <span class="hidden" id="ading_id"> <?php echo $data['advertise_id']; ?> </span> <span class="hidden" id="campaign_title"> <?php echo $data['title']; ?> </span> <span class="hidden" id="ads_title"> <?php echo $data['ad_title']; ?> </span> </i> </a>



                        <?php }else { ?>

                        <?php if($data['approval_status'] == '0' || $data['approval_status'] == '1') {  

                          if($data['approval_status'] == '0') {
                        ?>

                        
                        <a href="<?php echo base_url();?>common_admin/view_edit_admin_advertisement/<?php echo $data['advertise_id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                        
                      
                        <a class="delete_advertise" href="#" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"> <span class="hidden" name="ad_id" id="ad_id"> <?php echo $data['advertise_id']; ?> </span> </i></a>
                       
                      
                         <a class="span_id" href="<?php echo base_url() ?>common_admin/view_target_advertise/<?php echo $data['advertise_id']; ?>" data-toggle="tooltip" data-placement="top" title="Target Ads"><i class="fa fa-sitemap"> <span class="hidden" id="ading_id"> <?php echo $data['advertise_id']; ?> </span> <span class="hidden" id="campaign_title"> <?php echo $data['title']; ?> </span> <span class="hidden" id="ads_title"> <?php echo $data['ad_title']; ?> </span> </i> </a>

                       <?php } else{ ?>

                       <a class="span_id" href="<?php echo base_url() ?>common_admin/view_target_advertise/<?php echo $data['advertise_id']; ?>" data-toggle="tooltip" data-placement="top" title="Target Ads"><i class="fa fa-sitemap"> <span class="hidden" id="ading_id"> <?php echo $data['advertise_id']; ?> </span> <span class="hidden" id="campaign_title"> <?php echo $data['title']; ?> </span> <span class="hidden" id="ads_title"> <?php echo $data['ad_title']; ?> </span> </i> </a>
                       <?php }?>
                        </td>
                      <?php } else { ?>



                       
                       
                      <?php }
                          }
                      ?>  

                      <!-- end action icons -->


                    </tr>

                  <?php } ?>
                    
                  </tbody>
                </table>
                </div>
                </form>
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

        <!--Begin Modal Window--> 
<div class="modal fade left" id="myModal"> 
  <div class="modal-dialog1"> 
    <div class="modal-content"> 
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <!-- <h4 class="modal-title">TARGET Ads</h4> -->
      </div>
      <div class="modal-body">

      <!-- Form Section  -->
            <div class="col-md-12">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <img src="<?php echo base_url();?>assets/images/target.png" style="width: 70%"><br><br>
              </div>
              <div class="col-md-4"></div>    
            </div>
            <div class="col-md-12" style="clear: both;">
              <div class="col-md-4"></div>
              <div class="col-md-1">
                <label> Campaign Name </label>
              </div>
              <div class="col-md-4">
                <label id="txt_campaign_name">  </label>
              </div>    
            </div>
            <div class="col-md-12" style="clear: both;"><br>
              <div class="col-md-4"></div>
              <div class="col-md-1">
                <label> Ads Name : </label>
              </div>
              <div class="col-md-4">
                <label id="txt_ad_name"> </label>
              </div>    
            </div>
            <!-- Map Started -->
            <div class="col-md-12" style="clear: both;"><br>
              
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
            <!-- Map Ended --> 
            <div class="col-md-12">
            <div class="col-md-5"></div>
              <div class="col-md-1">
                <div class="form-group"> 
                  <div class=""> <br>
                    <button type="button" id="submit" name="submit" class="btn-lg btn-primary"> Apply </button> 
                  </div> 
                </div> 
              </div>
            </div>
      </div>
      <!-- <div class="modal-footer"> 
        <div class="col-xs-10 pull-left text-left text-muted"> 
        <small><strong>Privacy Policy:</strong>
        Lorem ipsum dolor sit amet consectetur adipiscing elit. 
        Mauris vitae libero lacus, vel hendrerit nisi! Maecenas quis 
        velit nisl, volutpat viverra felis. Vestibulum luctus mauris 
        sed sem dapibus luctus.</small> 
        </div> 
        <button class="btn-sm close" type="button" data-dismiss="modal">Close</button> 
      </div> -->
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> 
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

          $.ajax({
            type: "POST",        
            url: base_url+"common_admin/view_target_advertise/",
            data:{
              campaign_name : campaign_name,
              ad_title : ad_title
            },
            dataType:"JSON",            
            cache:false,
                   success : function(data) { 
                    //window.location.href=base_url+'common_admin/view_target_advertise';
                  }
          });
          $('#txt_ad_name').text(ad_title);
          $('#txt_campaign_name').text(campaign_name);
        });
      });



</script>     
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyxloxQJOEsrXbKVBDIPSuxb0RDJE58Ek&libraries=places&callback=initMap"
        async defer></script> 
<script type="text/javascript">
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example: -->
      // <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyxloxQJOEsrXbKVBDIPSuxb0RDJE58Ek&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
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
      }
      
    </script>
     