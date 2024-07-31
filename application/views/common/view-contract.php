
<!--

summary : view all documents for contract list

-->

<?php
require_once('functions.php');

?>
<!--Initialize Header section and css files-->
<style type="text/css">
	
	.preview-container {
	  border: 1px solid #eee;
	  height: 300px;
	  width: 300px;
	}
	.heading1 {
		background: #007aff;
		color: white;
	}

</style>
<?php echo get_header(); ?>
</div>

	<div class="container-fluid main-content">
      <div class="page-title"></div>
		<div class="row">
		  <div class="col-lg-12">
		    <div class="widget-container fluid-height clearfix">
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
		                <i class="fa fa-fw fa-edit"></i>All Subscriptions
		              </div>
		            <div class="heading">  
		              <?php foreach($get_all_docs as $details) {  ?>	
		              	<center> Documents for Subscription : <?php echo $details['contract_title']; ?> </center>
		              <?php } ?>
		            </div>  

		              <div class="widget-content padded clearfix">
		                <table class="table table-bordered table-striped" id="">
		                <?php foreach($get_all_docs as $details) {  ?>		                    
		                    <?php 
		                        	$upload_docs_file = $details['upload_document']; 
		                        	if($upload_docs_file){
		                        			$expldme = explode(',', '');	 
		                        	} 
			                      	$expldme = explode(',', $upload_docs_file);	 

			                      	for($i= 0; $i<=count($expldme)-2; $i++) {

		                    ?>
		                <?php } ?>    
		                  <thead class="heading1">
		                    <th>
                            <?php if(isset($expldme)){ ?>
		                    <?php if($expldme[0] == '') { echo '';} else {  ?>
		                    <?php $explode_txt = $expldme[0]; $expldme1 = explode('/', $explode_txt);	echo '<div class="heading1">'.$expldme1[2].'</div>'; ?>
		                    <?php } } ?>
                            
                            
		                    </th>
		                    <th>
							<?php if(!isset($expldme)){ ?>
		                    <?php if($expldme[0] != '') { echo ''; } else {  ?>
		                    <?php $explode_txt = $expldme[1]; $expldme1 = explode('/', $explode_txt);	echo '<div class="heading1">'.$expldme1[2].'</div>'; ?>	
		                    <?php } } ?>
                            
		                    </th>
		                  </thead>
		                  <?php }  ?>
		                  <tbody>
		                    <?php foreach($get_all_docs as $details) {  ?>		                    
		                    <?php 
		                        	$upload_docs_file = $details['upload_document']; 
			                      	 $expldme = explode(',', $upload_docs_file);	 
			                      	 for($i= 0; $i<=count($expldme)-3; $i++){
			                      	 
		                    ?>
		                    <tr>
		                      <?php } ?>
			                  <?php 
			                        	$upload_docs_file = $details['upload_document']; 
				                      	 $expldme = explode(',', $upload_docs_file);	 
				                      	 for($i= 0; $i<=count($expldme)-1; $i++){
				                      	 if($i >= 2){
				                      	 	$explode_txt = $expldme[$i]; $expldme1 = explode('/', $explode_txt);
				                      	 	echo '<thead class="heading1"><th><div class="heading1"> '.$expldme1[$i].'</div> </th><th></th></thead><tr>';
				                      	 }
			                    ?>	  

		                      <td style="width: 40%;">
		                      <?php if($expldme[0] == ''){echo '<center> <h2> Sorry no File Uploaded</h2> <center>'; } else { ?>
							    <object data="<?php echo base_url().$expldme[$i]; ?>" style="width: 100%; height: 600px;" >
								    <embed src="<?php echo base_url().$expldme[$i]; ?>" />
								</object>
							  <?php } ?>	
		                      </td>
		                      <?php }  ?>
		                      <?php } ?>
		                    </tr>
		                  </tbody>
		                  
		                </table>
		              </div>
		            </div>
		          </div>
		        </div> 
		        <!-- end DataTables Example -->
		      </div>
		    </div>
		  </div>  
		</div>
	</div>	


<?php echo get_footer(); ?>