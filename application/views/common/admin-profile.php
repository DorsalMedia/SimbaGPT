
<!--

Summary :- view user profile page

-->

<?php
require_once('functions.php');
?> 
<!--Initialize Header section and css files-->
<style type="text/css">
  	.modal-dialog1{
  		position: relative;
  	    right: auto;
  	    left: 10%;
  	    width: 80%;
  	    padding-top: 30px;
  	    padding-bottom: 30px;
    }
    .btn-lg.round {
      border-radius: 24px !important;
      width: 15% !important;
    }
    
</style>
<script type="text/javascript">
      function local() {
        document.getElementById('local').style.display='block';
        document.getElementById('enterprise_plan').style.display='none';
      }
      function enterprise_plan() {
        document.getElementById('local').style.display='none';
        document.getElementById('enterprise_plan').style.display='block';
      } 

      function afterload(){
        local();
      }

      window.onload=function(){
        afterload();
    };

</script>
<?php echo get_header(); ?>
</div>
      <div class="container main-content">
      <div class="page-title"></div>
		<div class="row">
		  <div class="col-lg-12">
		    <div class="widget-container fluid-height clearfix">
		      <div class="heading">
		        <i class="fa fa-user"></i>My Profile
		        <div class="pull-right">
		        <?php foreach ($get_membership_details as $membership_plans) { 
                $plan_name = $membership_plans['plan_name'];
                $plan_val = $membership_plans['plan_value'];
                if($plan_name == 'Starter Plan'){
                    $plan_val = '12000';
                  } else if($plan_name == 'Basic Plan'){
                    $plan_val = '21000';
                  } else if($plan_name == 'Advanced Plan'){
                    $plan_val = '42000';
                  } else if($plan_name == 'Professional Plan'){
                    $plan_val = '51000';
                  }
		        /*	if($membership_plans['manual_payment_status'] == 'n'){
		        		$plan_name = $membership_plans['plan_name'];
                echo $plan_name;
			        	$plan_val = $membership_plans['plan_value'];
			        	echo "Unpaid (manual payment to dorsal office) <br> <span class='change_text'> Membership ".$plan_name." - ".$plan_val." SH </span>";
		        	} else {
		        		$plan_name = $membership_plans['plan_name'];
		        		$plan_val = $membership_plans['plan_value'];
		        		echo "Paid Membership $plan_name -- $plan_val SH";	
		        	} */
		        	
		         ?> 
             <input type="hidden" name="membership_id" id="pln_value" value="<?php echo $plan_val; ?>">  
		         <input type="hidden" name="membership_id" id="membership_id" value="<?php echo $membership_plans['membership_id']; ?>">  
		         <?php } ?>
		        <br><br>
            <!-- <?php  
              
              //  if(isset($this->session->userdata('admin_login'))){
              //   $user_id = $_SESSION['admin_login']['admin_id'];
              //   $this->db->select('*');
              //   $this->db->from('users');
              //   $this->db->where('id',$user_id);
              //   $query_get_user = $this->db->get();
              //   $query_result_users = $query_get_user->result_array();  
              //   foreach($query_result_users as $get_enterprise_users){
                  
              //   }
              // }
              // $this->db->select('*');
              // $this->db->from('users');
              // $query = $this->db->get();
              // $query_result = $query->result_array();

            ?> -->
            <?php if(isset($_SESSION['admin_login'])) { ?>

		        <center>
		        	<button type="button" class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModal" > Change Membership </button>
		        </center>
            <?php } else if(isset($_SESSION['enterprise_account'])){ ?>
            <center>
              <button type="button" class="btn btn-primary" > Buy Credits </button>
            </center>
            <?php  } ?>


		        </div>
		      </div>
		      <div class="widget-content padded"><br><br>
          <div class="loader"> </div>
		        <form action="#" class="form-horizontal update_user_profile">
		        <input type="hidden" name="membership_plan" id="membership_plan" value="">
		        <div class="form-group">
                <label class="control-label col-md-2">Profile Picture</label>
                <div class="col-md-3">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="display_img_profile  ">                      
                      <div class="fileupload-new img-thumbnail" style="width: 150px; height: 120px;">                       
                        <!-- <img id="responsive_img" name ="upload_logo" src="https://www.freelancermap.com/images/company_dummy.png">
                      <img id="upload_logos" name ="upload_logos" src=""> -->
                        <?php  
                            $image = $users_profile_data->client_logo;

                          if(isset($image)){

                            ?>
                            <img id="responsive_img" name ="upload_logo" src="<?php echo base_url().$image; ?>">  
                            <input type="hidden" name="old-image" id="old-image" value="<?= $image ?>"   >
                            <!-- <img id="upload_logos" name ="upload_logos" src="https://www.freelancermap.com/images/company_dummy.png"> -->
                        <?php  } else {
                        ?>
                          <img id="responsive_img" name ="upload_logo" src="https://www.freelancermap.com/images/company_dummy.png">
                          <!-- <img id="upload_logos" name ="upload_logos" src=""> -->
                        <?php } ?>

                      </div>
                      <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 150px; max-height: 120px; min-height: 120px;">
                      </div>
                      <div>                       
                          <?php 
                            if(isset($image)){ ?>
                            <span class="btn btn-default btn-file"><span class="fileupload-new" style="padding: 0px 26px;" >Change Logo</span><span class="fileupload-exists">Change</span>
                            <input type="file" name="new_file" id="new-image" accept=".png, .jpg, .jpeg" value="">
                            
                           <?php } else {
                          ?>
                          <span class="btn btn-default btn-file"><span class="fileupload-new" style="padding: 0px 26px;" >Select Logo</span><span class="fileupload-exists">Change</span>
                          <input type="file" name="new_file" id="new-image" accept=".png, .jpg, .jpeg">
                          <?php } ?>                          
                          </span><a class="btn btn-danger fileupload-exists" data-dismiss="fileupload" href="#" style="margin-left: 5px;" >Remove</a>
                        </div>                                       
                      </div>
                    </div>
                    <label style="color: red"><i>Note:Allowed file types .jpg, .jpeg, .png</i></label>
                </div>                
              </div>
              <div class="form-group">
                <center><input type="hidden" name="logo_upload_err"></center>
              </div>




              <div class="form-group">
		            <label class="control-label col-md-2">Media Agency Name</label>
		            <div class="col-md-7">
		              <input class="form-control" placeholder="Enter Media Agency Name" type="text" name="agency_name" value="<?php echo $users_profile_data->media_agency_name; ?>">
		            </div>
                <?php if(isset($_SESSION['admin_login'])) { ?>
		            <?php $session = $_SESSION['admin_login']; $user_id = $session['admin_id']; ?>
                <?php } ?>
                <?php if(isset($_SESSION['enterprise_account'])) { ?>
                <?php $session = $_SESSION['enterprise_account']; $user_id = $session['admin_id']; ?>
                <?php } ?>


		            <input class="form-control" placeholder="Enter Media Agency Name" type="hidden" name="user_id" value="<?php echo $user_id; ?>">
		          </div>
		          <div class="form-group">
		            <label class="control-label col-md-2">Agent's Name</label>
		            <div class="col-md-7">
		              <input class="form-control" placeholder="Enter Agent's Name" type="text" name="agent_name" value="<?php echo $users_profile_data->agent_name; ?>">
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-md-2">Email</label>
		            <div class="col-md-7">
		              <input class="form-control" placeholder="Enter Email" type="text" name="email" value="<?php echo $users_profile_data->email; ?>">
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-md-2">Phone</label>
		            <div class="col-md-7">
		              <input class="form-control" placeholder="Enter Phone Number" type="text" id="phone" maxlength="9" name="phone" value="<?php echo $users_profile_data->phone; ?>">
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-md-2">Username</label>
		            <div class="col-md-7">
		              <input class="form-control" placeholder="Enter Username" type="text" name="username" value="<?php echo $users_profile_data->username; ?>" >
                  <!-- onkeypress="return alpha(event)" -->
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-md-2">Password</label>
		            <div class="col-md-7">
		              <input class="form-control" placeholder="Enter Password" type="password" name="password" value="dummypass">
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-md-2">Confirm Password</label>
		            <div class="col-md-7">
		              <input class="form-control" placeholder="Enter Confirm Password" type="password" name="confirm_password" value="dummypass">
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-md-2"></label>
		            <div class="col-md-7">
		              <button class="btn btn-primary update_profile" type="button">Update</button> 
		              <a href="<?php echo base_url();?>common_admin/home"> <button class="btn btn-default-outline" type="button">  Cancel </button></a>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
	</div>

	      <!-- Bootstrap Popup contact form modal -->

      <!--Begin Modal Window--> 
<div class="col-md-12">
<div class="modal fade left" id="myModal"> 
  <div class="modal-dialog1"> 
    <div class="modal-content"> 
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Change Your Plan </h4>
      </div>
      <div class="modal-body">
      						<div class="plan_section" style="clear: both;">
                              <center>
                                   <button class="btn btn-lg round btn-primary" type="button" onclick="local()"> Local </button>
                                   <button class="btn btn-lg round btn-primary" type="button" id="enterprise_click" onclick="enterprise_plan()"> Enterprise Plan</button>
                              </center>
                            </div>	
     <!-- Starting Pricing Table here -->
                          <div class="local" id="local">
                            <div class="row pricing-table">
                              <div class="col-sm-3">
                                <div class="widget-container fluid-height list green">
                                  <div class="widget-content padded text-center">
                                    <h1>
                                      Starter Plan
                                    </h1>
                                    <h2>
                                      $<span id="span_start_plan" style="font-size: 46px; font-weight: 300px"></span><span>/month</span>
                                    </h2>
                                    <a class="btn btn-block btn-default" type="button" id="start_select"> Select </a>
                                  </div> 
                                  <div>
                                    <center>
                                      <h3> Ad Space </h3>
                                    </center>
                                  </div>
                                  <ul>
                                    <li>
                                      Video or Display (Image) Ads
                                    </li>
                                    <li>
                                      1200 views/600 minutes
                                    </li>
                                    <li>
                                      1 view = 30 seconds
                                    </li>
                                    <li>
                                      Cost per view = 10
                                    </li>
                                    <li></li>
                                  </ul>
                                  <div>
                                    <center>
                                      <h3> Features </h3>
                                    </center>
                                  </div>
                                  <ul>
                                    <li>
                                      City-Wide Reach 
                                    </li>
                                    <li>
                                      Realtime Analytics
                                    </li>
                                    <li>
                                      High-value audience
                                    </li>
                                    <li>
                                      3 Call-to-Action Buttons
                                    </li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="widget-container fluid-height list orange">
                                  <div class="widget-content padded text-center">
                                    <h1>
                                      Basic Plan
                                    </h1>
                                    <h2>
                                      $<span id="span_basic_plan" style="font-size: 46px; font-weight: 300px"></span><span>/month</span>
                                    </h2>
                                    <a class="btn btn-block btn-default" type="button" id="basic_select"> Select </a>
                                  </div>
                                  <div>
                                    <center>
                                      <h3> Ad Space </h3>
                                    </center>
                                  </div>
                                  <ul>
                                    <li>
                                      Video or Display (Image) Ads
                                    </li>
                                    <li>
                                      2400 views/1200 minutes
                                    </li>
                                    <li>
                                      1 view = 30 seconds
                                    </li>
                                    <li>
                                      Cost per view = 8.4
                                    </li>
                                    <li></li>
                                  </ul>
                                  <div>
                                    <center>
                                      <h3> Features </h3>
                                    </center>
                                  </div>
                                  <ul>
                                    <li>
                                      Starter pack features
                                    </li>
                                    <li>
                                      10 call to action
                                    </li>
                                    <li>
                                      Real time analytics
                                    </li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="widget-container fluid-height list blue">
                                  <div class="widget-content padded text-center">
                                    <h1>
                                      Advanced Plan
                                    </h1>
                                    <h2>
                                      $<span id="span_advance_plan" style="font-size: 46px; font-weight: 300px"></span><span>/month</span>                   
                                    </h2>
                                    <a class="btn btn-block btn-default" type="button" id="advance_select"> Select </a>
                                  </div>
                                  <div>
                                    <center>
                                      <h3> Ad Space </h3>
                                    </center>
                                  </div>
                                  <ul>
                                    <li>
                                      Video or Display (Image) Ads
                                    </li>
                                    <li>
                                      6000 views/3000 minutes
                                    </li>
                                    <li>
                                      1 view = 30 seconds
                                    </li>
                                    <li>
                                      Cost per view = 7
                                    </li>
                                    <li></li>
                                  </ul>
                                  <div>
                                    <center>
                                      <h3> Features </h3>
                                    </center>
                                  </div>
                                  <ul>
                                    <li>
                                      Basic Pack features
                                    </li>
                                    <li>
                                      Unlimited CTA
                                    </li>
                                    <li>
                                      SafariX AdTargeting Technology
                                    </li>
                                    
                                  </ul>
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="widget-container fluid-height list red">
                                  <div class="widget-content padded text-center">
                                    <h1>
                                      Professional Plan
                                    </h1>
                                    <h2>
                                      $<span id="span_professional_plan" style="font-size: 46px; font-weight: 300px"></span><span>/month</span>
                                    </h2>
                                    <a class="btn btn-block btn-default" type="button" id="professional_select"> Select </a>
                                  </div>
                                  <div>
                                    <center>
                                      <h3> Ad Space </h3>
                                    </center>
                                  </div>
                                  <ul>
                                    <li>
                                      Video or Display (Image) Ads
                                    </li>
                                    <li>
                                      9000 views/4500 minutes
                                    </li>
                                    <li>
                                      1 view = 30 seconds
                                    </li>
                                    <li>
                                      Cost per view = 5.67
                                    </li>
                                    <li></li>
                                  </ul>
                                  <div>
                                    <center>
                                      <h3> Features </h3>
                                    </center>
                                  </div>
                                  <ul>
                                    <li>
                                      Advanced Pack features
                                    </li>
                                    <li>
                                      SafariX AdTargeting Technologyt
                                    </li>
                                    <li>
                                      Multiple user accounts
                                    </li>
                                    <li>
                                      Account manager support
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <!-- Add button for update payment membership plans -->
                              <div class="form-group">
                                <div class="col-sm-offset-5">  <br><br>   
                                    <button type="button" id="pay_now" class="btn btn-success"> Pay Now </button>
                                </div>
                              </div>
                            
                            <!-- End of payment updation membership plans  -->
                            </div>

                            <div class="enterprise_plan" id="enterprise_plan">
                              <div class="col-md-4"></div>
                            <div class="row pricing-table">
                              
                              <div class="col-sm-4 col-md-4">
                                <div class="widget-container fluid-height list red">
                                  <div class="widget-content padded text-center">
                                    <h1>
                                      Enterprise
                                    </h1>
                                    <h2>
                                      FREE 2 WEEK TRIAL
                                    </h2>
                                    <a class="btn btn-block btn-default" type="button" id="enterprise_select" data-toggle="modal" data-target="#myModal1"> CONTACT US </a>

                                  </div>
                                  <div>
                                    <center>
                                      <h5> Rydlr Premier Account </h5>
                                      <h3> Ad Space </h3>
                                    </center>
                                  </div>
                                  <ul>
                                    <li>
                                      Video or Display (Image) Ads
                                    </li>
                                    <li>
                                      Custom view range
                                    </li>
                                    <li></li>
                                  </ul>
                                  <div>
                                    <center>
                                      <h3> Features </h3>
                                    </center>
                                  </div>
                                  <ul>
                                    <li>
                                      Custom Locations
                                    </li>
                                    <li>
                                      Origination/Destination Targeting
                                    </li>
                                    <li>
                                      Geo Targeting
                                    </li>
                                    <li>
                                      TripIntent Targeting
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>  
                            <!-- Second plan table changes-->

                          <center>
                           <div id="form_starter_plan" style="display: none;">

                                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="starter_form">
                                  <!-- Identify your business so that you can collect the payments. -->
                                  <input type="hidden" name="business" value="sumit@xoomsolutions.com">

                                  <!-- Specify a Subscribe button. -->
                                  <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                  <!-- Identify the subscription. -->
                                  <input type="hidden" name="item_name" value="start_plan">
                                  <input type="hidden" name="item_number" value="DIG Weekly">


                                  <input type="hidden" name="currency_code" value="USD">
                                  <input type="hidden" name="a1" value="0">
                                  <input type="hidden" name="p1" value="7">
                                  <input type="hidden" name="t1" value="D">

                                  <!-- Set the terms of the regular subscription. -->
                                  <input type="hidden" name="currency_code" value="USD">
                                  <input type="hidden" name="a3" id="started_plan" value="12000.00">
                                  <input type="hidden" name="p3" value="1">
                                  <input type="hidden" name="t3" value="M">

                                  <!-- Set recurring payments until canceled. -->
                                  <input type="hidden" name="src" value="1">

                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/update_profile_payment/1/start_plan/12000">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/update_profile_payment/1/start_plan/12000">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">

                                  <!-- Display the payment button. -->
                                  <input type="image" name="submit"
                                  src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_subscribe_113x26.png"
                                  alt="Subscribe">
                                  <img alt="" width="1" height="1"
                                  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                                </form> 

                                <!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" id="starter_form">
                                  <input type="hidden" name="cmd" value="_s-xclick">
                                  <input type="hidden" name="hosted_button_id" value="ECFQM2AMMKFKC">
                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/success_product_payment/1/start_plan/12000">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/success_product_payment/1/start_plan/12000">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">
                                  <table>
                                   <tr><td><input type="hidden" name="on0" value="Select Starter Plan">Select Starter Plan</td></tr><tr><td><input type="text" name="os0" maxlength="200"></td></tr>
                                  </table>
                                  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </form>     -->                            
                           </div>         
                           <div id="form_basic_plan" style="display: none;">

                                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="basic_form">
                                  <!-- Identify your business so that you can collect the payments. -->
                                  <input type="hidden" name="business" value="sumit@xoomsolutions.com">

                                  <!-- Specify a Subscribe button. -->
                                  <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                  <!-- Identify the subscription. -->
                                  <input type="hidden" name="item_name" value="basic_plan">
                                  <input type="hidden" name="item_number" value="DIG Weekly">


                                  <input type="hidden" name="currency_code" value="USD">
                                  <input type="hidden" name="a1" id="chang_one_month_value_basic" value="0">
                                  <input type="hidden" name="p1" id="chang_one_month_days_number_basic" value="7">
                                  <input type="hidden" name="t1" id="chang_one_month_days_basic" value="D">

                                  <!-- Set the terms of the regular subscription. -->
                                  <input type="hidden" name="currency_code" value="USD">
                                  <input type="hidden" name="a3" id="basiced_plan" value="21000.00">
                                  <input type="hidden" name="p3" value="1">
                                  <input type="hidden" name="t3" value="M">

                                  <!-- Set recurring payments until canceled. -->
                                  <input type="hidden" name="src" value="1">

                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/update_profile_payment/1/basic_plan/21000">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/update_profile_payment/1/basic_plan/21000">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">

                                  <!-- Display the payment button. -->
                                  <input type="image" name="submit"
                                  src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_subscribe_113x26.png"
                                  alt="Subscribe">
                                  <img alt="" width="1" height="1"
                                  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                                </form>


                               <!--  <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" id="basic_form">
                                  <input type="hidden" name="cmd" value="_s-xclick">
                                  <input type="hidden" name="hosted_button_id" value="PHATBHXMQWU7Y">    
                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/success_product_payment/1/basic_plan/21000">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/success_product_payment/1/basic_plan/21000">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">
                                  <table>
                                  <tr><td><input type="hidden" name="on0" value="Enter Basic Plan">Enter Basic Plan</td></tr><tr><td><input type="text" name="os0" maxlength="200"></td></tr>
                                  </table>
                                  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </form> -->
                           </div>
                           <div id="form_advance_plan" style="display: none;">

                                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="advance_form">
                                  <!-- Identify your business so that you can collect the payments. -->
                                  <input type="hidden" name="business" value="sumit@xoomsolutions.com">

                                  <!-- Specify a Subscribe button. -->
                                  <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                  <!-- Identify the subscription. -->
                                  <input type="hidden" name="item_name" value="advance_plan">
                                  <input type="hidden" name="item_number" value="DIG Weekly">


                                  <input type="hidden" name="currency_code" value="USD">
                                  <input type="hidden" name="a1" id="chang_one_month_value_advance" value="0">
                                  <input type="hidden" name="p1" id="chang_one_month_days_number_advance" value="14">
                                  <input type="hidden" name="t1" id="chang_one_month_days_advance" value="D">

                                  <!-- Set the terms of the regular subscription. -->
                                  <input type="hidden" name="currency_code" value="USD">
                                  <input type="hidden" name="a3" id="advanced_plan" value="42000.00">
                                  <input type="hidden" name="p3" value="1">
                                  <input type="hidden" name="t3" value="M">

                                  <!-- Set recurring payments until canceled. -->
                                  <input type="hidden" name="src" value="1">

                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/update_profile_payment/1/advance_plan/42000">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/update_profile_payment/1/advance_plan/42000">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">

                                  <!-- Display the payment button. -->
                                  <input type="image" name="submit"
                                  src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_subscribe_113x26.png"
                                  alt="Subscribe">
                                  <img alt="" width="1" height="1"
                                  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                                </form>

                                <!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" id="advance_form">
                                  <input type="hidden" name="cmd" value="_s-xclick">
                                  <input type="hidden" name="hosted_button_id" value="TFKYUAVBFW3S6">
                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/success_product_payment/1/advance_plan/42000">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/success_product_payment/1/advance_plan/42000">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">
                                  <table>
                                  <tr><td><input type="hidden" name="on0" value="Enter Advance Plans">Enter Advance Plans</td></tr><tr><td><input type="text" name="os0" maxlength="200"></td></tr>
                                  </table>
                                  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </form> -->
                           </div>
                           <div id="form_professional_plan" style="display: none;">


                                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="professional_form">
                                  <!-- Identify your business so that you can collect the payments. -->
                                  <input type="hidden" name="business" value="sumit@xoomsolutions.com">

                                  <!-- Specify a Subscribe button. -->
                                  <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                  <!-- Identify the subscription. -->
                                  <input type="hidden" name="item_name" value="professional_plan">
                                  <input type="hidden" name="item_number" value="DIG Weekly">


                                  <input type="hidden" name="currency_code" value="USD">
                                  <input type="hidden" name="a1" id="chang_one_month_value_professional" value="0">
                                  <input type="hidden" name="p1" id="chang_one_month_days_number_professional" value="14">
                                  <input type="hidden" name="t1" id="chang_one_month_days_professional" value="D">

                                  <!-- Set the terms of the regular subscription. -->
                                  <input type="hidden" name="currency_code" value="USD">
                                  <input type="hidden" name="a3" id="professionaled_plan" value="51000.00">
                                  <input type="hidden" name="p3" value="1">
                                  <input type="hidden" name="t3" value="M">

                                  <!-- Set recurring payments until canceled. -->
                                  <input type="hidden" name="src" value="1">

                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/update_profile_payment/1/professional_plan/12000">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/update_profile_payment/1/professional_plan/12000">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">

                                  <!-- Display the payment button. -->
                                  <input type="image" name="submit"
                                  src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_subscribe_113x26.png"
                                  alt="Subscribe">
                                  <img alt="" width="1" height="1"
                                  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                                </form>


                                <!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" id="professional_form">
                                  <input type="hidden" name="cmd" value="_s-xclick">
                                  <input type="hidden" name="hosted_button_id" value="ARZTYZHJS7QME">
                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/success_product_payment/1/professional_plan/51000">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/success_product_payment/1/professional_plan/51000">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">
                                  <table>
                                  <tr><td><input type="hidden" name="on0" value="Enter Professional Plan">Enter Professional Plan</td></tr><tr><td><input type="text" name="os0" maxlength="200"></td></tr>
                                  </table>
                                  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </form> -->
                           </div>
                         </center>


                            <!-- end of second plan table -->



      <!-- End Form  Section -->

      <!--INSERT CONTACT FORM HERE-->

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

      <!--Begin Modal Window--> 
      <!--Begin Modal Window--> 
<div class="modal fade left" id="myModal1"> 
  <div class="modal-dialog"> 
    <div class="modal-content"> 
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">CONTACT US</h4>
      </div>
      <div class="modal-body">

      <!-- Form Section  -->
      <div class="loader"> </div>

        <form class="form-horizontal form_contact_us" role="form" method="post" action="#"> 
          
            <div class="form-group"> 
            <label for="name" class="col-sm-3 control-label">
            <span class="required">*</span> Name:</label> 
              <div class="col-sm-9"> 
                <input type="text" class="form-control" id="name" name="name" placeholder="First & Last" required> 
              </div> 
            </div> 
            <div class="form-group"> 
            <label for="email" class="col-sm-3 control-label">
            <span class="required">*</span> Email: </label> 
              <div class="col-sm-9"> 
                <input type="email" class="form-control" id="email" name="email" placeholder="you@domain.com" required> 
              </div> 
            </div> 
            <div class="form-group"> 
              <label for="message" class="col-sm-3 control-label">
              <span class="required">*</span> Message:</label> 
            <div class="col-sm-9"> 
              <textarea name="message" rows="4" required class="form-control" id="message" placeholder="Comments"></textarea> 
            </div> 
            </div> 
            <div class="form-group"> 
            <label for="message" class="col-sm-3 control-label">
              <span class="required"></span></label> 
            <div class="col-sm-9"> 
              <input type="hidden" name="msg_er" id="msg_er" value="sss">
            </div>               
            </div>
            <div class="form-group"> 
              <label for="human" class="col-sm-3 control-label">
              <span class="required">*</span> Phone:</label> 
              <div class="col-sm-9"> 
                <input class="form-control" id="phone_number" name="phone" minlength="9" maxlength="9" type="text"  placeholder="Enter phone number"> 
              </div> 
            </div> 
            
        </form>
<!--end Form-->



      <!-- End Form  Section -->

      <!--INSERT CONTACT FORM HERE-->

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
          <button type="button" id="submit" name="submit" class="btn-lg btn-primary update_contact_info" id="enterprise_select"> SUBMIT </button> 
      </div> 
    </div> 
  </div> 
</div>


</div>
<?php echo get_footer(); ?>
<style type="text/css">
  .display_img_profile{
      border: 1px solid; 
      border-radius: 20px;
      border-color: #CCD0D7;
      padding:  15px 11px 19px 20px;
      width: 200px;
    }
    .btn-danger:hover, .btn-danger.active {
      background: #999999;
      color: #ffffff;
      border-color: #999999;
    }
    .btn-danger, .btn-danger.disabled, .btn-danger[disabled] {
      background: #999999;
      border-color: #999999;
      color: white;
    }
    .btn-default, .btn-default.disabled, .btn-default[disabled] {
      background: #007aff;
      border-color: #bbbbbb;
      color: white;
    }
    .btn-default:hover, .btn-default.active {
        background: #007aff;
        color: white;
        border-color: #bbbbbb;
    }
</style>
<script type="text/javascript">
     

      $('#span_start_plan').text(amount_starter_plan);
      $('#span_basic_plan').text(amount_basic_plan);
      $('#span_advance_plan').text(amount_advance_plan);
      $('#span_professional_plan').text(amount_professional_plan);

     $('#pay_now').on('click', function() {
        
        var plan_txt = $('.change_text').text();
        var plan_value = $('#pln_value').val();
        if(plan_txt == 'Starter Plan - '+amount_starter_plan+' SH' || plan_txt == 'Starter Plan  - '+amount_starter_plan+' SH'){
          if(plan_value == amount_starter_plan){
              swal("Sorry", "The plan is already selected","warning");
          } else if(plan_value != amount_starter_plan){
              var new_paid_value = amount_starter_plan - plan_value;
              if(new_paid_value < 0){
                  swal("Sorry", "You can not downgrade your plan. Select plan which is higner than current plan and enjoy more features","warning");
              } else {
                  $('#started_plan').val(new_paid_value);
                  swal({
                    title: 'Are you sure?',
                    text: "You want to change the plan!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                    }).then(function () {

                      // swal(
                      //   'Deleted!',
                      //   'Your file has been deleted.',
                      //   'success'
                      // )
                      $('#starter_form').find('input[type=image]').trigger('click');

                      //window.location.href=base_url+"common_admin/makeProductpayment_profile_page/1/start_plan/"+new_paid_value+"";
                      //swal('Product name is: Start plan the new paid value is '+new_paid_value+' and old value is '+plan_value+'');
                    })
                }
          }
        }
        if(plan_txt == 'Basic Plan  - '+amount_basic_plan+' SH' || plan_txt == 'Basic Plan   - '+amount_basic_plan+' SH'){
        //if(plan_txt == 'Basic Plan  - '+amount_basic_plan+' SH' || plan_txt == 'Basic Plan   -- '+amount_basic_plan+' SH'){
          if(plan_value == amount_basic_plan){
              swal("Sorry", "The plan is already selected","warning");
          } else if(plan_value != amount_basic_plan){
              var new_paid_value = amount_basic_plan - plan_value;
              if(new_paid_value < 0){
                swal("Sorry", "You can not downgrade your plan. Select plan which is higner than current plan and enjoy more features","warning");
              } else {                
                $('#basiced_plan').val(amount_basic_plan);
                swal({
                  title: 'Are you sure?',
                  text: "You want to change the plan!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, change it!'
                  }).then(function () {
                    // swal(
                    //   'Deleted!',
                    //   'Your file has been deleted.',
                    //   'success'
                    // )
                    $('#basic_form').find('input[type=image]').trigger('click');
                    //window.location.href=base_url+"common_admin/makeProductpayment_profile_page/1/basic_plan/"+new_paid_value+"";
                  })
              }
          }
        }
        if(plan_txt == 'Advanced Plan - '+amount_advance_plan+' SH' || plan_txt == 'Advanced Plan  - '+amount_advance_plan+' SH'){
          if(plan_value == amount_advance_plan){
              swal("Sorry", "The plan is already selected","warning");
          } else if(plan_value != amount_advance_plan){
              var new_paid_value = amount_advance_plan - plan_value;
              
              if(new_paid_value < 0){
                swal("Sorry", "You can not downgrade your plan. Select plan which is higner than current plan and enjoy more features","warning");
              } else {
                
                $('#advanced_plan').val(amount_advance_plan);
                swal({
                  title: 'Are you sure?',
                  text: "You want to change the plan!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, change it!'
                  }).then(function () {
                    // swal(
                    //   'Deleted!',
                    //   'Your file has been deleted.',
                    //   'success'
                    // )
                    $('#advance_form').find('input[type=image]').trigger('click');
                    //window.location.href=base_url+"common_admin/makeProductpayment_profile_page/1/advance_plan/"+new_paid_value+"";
                  })
              }
          }
        }
        if(plan_txt == 'Professional Plan - '+amount_professional_plan+' SH' || plan_txt == 'Professional Plan  - '+amount_professional_plan+' SH'){          
          if(plan_value == amount_professional_plan){
              swal("Sorry", "The plan is already selected","warning");
          } else if(plan_value != amount_professional_plan){
              var new_paid_value = amount_professional_plan - plan_value;
              if(new_paid_value < 0){
                swal("Sorry", "You can not downgrade your plan. Select plan which is higner than current plan and enjoy more features","warning");
              } else {
                $('#professional_plan').val(amount_professional_plan);

                //$('#professional_plan').val(new_paid_value);
                swal({
                  title: 'Are you sure?',
                  text: "You want to change the plan!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, change it!'
                  }).then(function () {
                    // swal(
                    //   'Deleted!',
                    //   'Your file has been deleted.',
                    //   'success'
                    // )
                    $('#professional_form').find('input[type=image]').trigger('click');
                    //window.location.href=base_url+"common_admin/makeProductpayment_profile_page/1/professional_plan/"+amount_starter_plan+"";
                  })
              }
          }
        } 
        
     });
     $('#start_select').on('click', function() {
        var plan_txt = $('.change_text').text();
        var plan_value = $('#pln_value').val();
        var new_paid_value = amount_starter_plan - plan_value;

        $('#chang_one_month_value').val(new_paid_value);
        $('#chang_one_month_days_number').val('1');
        $('#chang_one_month_days').val('M');

        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Starter Plan - '+amount_starter_plan+' SH');
        var replace_value = "Starter Plan - "+amount_starter_plan+" SH";
        $('.change_text').text(replace_value);
        //$('#myModal').modal('hide');
     }); 
     $('#basic_select').on('click', function() {

        var plan_txt = $('.change_text').text();
        var plan_value = $('#pln_value').val();
        var new_paid_value = amount_basic_plan - plan_value;
        
        $('#chang_one_month_value_basic').val(new_paid_value);
        $('#chang_one_month_days_number_basic').val('1');
        $('#chang_one_month_days_basic').val('M');

        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Basic Plan  - '+amount_basic_plan+' SH');
        var replace_value = "Basic Plan  - "+amount_basic_plan+" SH";
        $('.change_text').text(replace_value);
        //$('#myModal').modal('hide');
     }); 
     $('#advance_select').on('click', function() {

        var plan_txt = $('.change_text').text();
        var plan_value = $('#pln_value').val();
        var new_paid_value = amount_advance_plan - plan_value;
        
        var chng = $('#chang_one_month_value_advance').val(new_paid_value);
        var mnth = $('#chang_one_month_days_number_advance').val('1');
        var day = $('#chang_one_month_days_advance').val('M');

        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Advanced Plan - '+amount_advance_plan+' SH');
        var replace_value = "Advanced Plan - "+amount_advance_plan+" SH";
        $('.change_text').text(replace_value);
        //$('#myModal').modal('hide');
     }); 
     $('#professional_select').on('click', function() {

        var plan_txt = $('.change_text').text();
        var plan_value = $('#pln_value').val();
        var new_paid_value = amount_professional_plan - plan_value;
        
        $('#chang_one_month_value_professional').val(new_paid_value);
        $('#chang_one_month_days_number_professional').val('1');
        $('#chang_one_month_days_professional').val('M');

        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Professional Plan - '+amount_professional_plan+' SH');
        var replace_value = "Professional Plan - "+amount_professional_plan+" SH";
        $('.change_text').text(replace_value);
       // $('#myModal').modal('hide');
     }); 

  </script>
  <script type="text/javascript">
  $(document).ready(function(){

    var b1 = document.getElementById("start_select");
    var b2 = document.getElementById("basic_select");
    var b3 = document.getElementById("advance_select");
    var b4 = document.getElementById("professional_select");
    var b5 = document.getElementById("enterprise_select");
    var plan_value = $('#pln_value').val();
    
    var replace_value1 = amount_starter_plan;
    var replace_value2 = amount_basic_plan;
    var replace_value3 = amount_advance_plan;
    var replace_value4 = amount_professional_plan;
    var replace_value5 = "0";

    if(plan_value == replace_value1){
        b1.style.background = "goldenrod";
        b2.style.background = "";  
        b3.style.background = "";  
        b4.style.background = "";   
        b5.style.background = "";   
    } else if(plan_value == replace_value2){
        b1.style.background = "";
        b2.style.background = "goldenrod";  
        b3.style.background = "";  
        b4.style.background = "";   
        b5.style.background = "";   
    } else if(plan_value == replace_value3) {
        b1.style.background = "";
        b2.style.background = "";  
        b3.style.background = "goldenrod";  
        b4.style.background = "";   
        b5.style.background = "";   
    } else if(plan_value == replace_value4) {
        b1.style.background = "";
        b2.style.background = "";  
        b3.style.background = "";  
        b4.style.background = "goldenrod";   
        b5.style.background = "";   
    } else if(plan_value == replace_value5) {

        b1.style.background = "";
        b2.style.background = "";  
        b3.style.background = "";  
        b4.style.background = "";   
        b5.style.background = "goldenrod";   
    }

    b1.onclick = function() {
         b1.style.background = "goldenrod";
         b2.style.background = "";  
         b3.style.background = "";  
         b4.style.background = "";
         b5.style.background = "";   
    }

    b2.onclick = function() {
         b1.style.background = "";
         b2.style.background = "goldenrod";  
         b3.style.background = "";  
         b4.style.background = "";
         b5.style.background = "";   
    }

    b3.onclick = function() {
         b1.style.background = "";
         b2.style.background = "";  
         b3.style.background = "goldenrod";  
         b4.style.background = "";   
         b5.style.background = "";
    }
    b4.onclick = function() {
         b1.style.background = "";
         b2.style.background = "";  
         b3.style.background = "";  
         b4.style.background = "goldenrod";    
         b5.style.background = "";        
    }
    b5.onclick = function() {
         b1.style.background = "";
         b2.style.background = "";  
         b3.style.background = "";  
         b4.style.background = "";      
         b5.style.background = "goldenrod";      
    }

  });
    
  </script>