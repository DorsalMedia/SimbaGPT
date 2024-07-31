
<!--

Summary :- view registration 3 steps
<
-->

<?php
require_once('functions.php');
 
?> 
<!--Initialize Header section and css files-->
<style type="text/css">
body.sidebar-nav {
   padding: 60px 0 0 0px !important; 
}
  .style-selector .style-selector-container .style-toggle {
    position: absolute;
    right: 100%;
    top: -1px;
    background: white;
    border-radius: 5px 0 0 5px;
    width: 48px;
    height: 46px;
    text-align: center;
    border: 1px solid #dddddd;
    border-right: 0;
    cursor: pointer;
    display: none;
  } 
  .btn-lg.round {
    border-radius: 24px !important;
    width: 15% !important;
  }
 
  .design_footer {
    color: white !important;
  }

  .pricing-table [class^="col-"] .widget-container h1, .pricing-table [class*="col-"] .widget-container h1 {
    text-transform: uppercase !important;
    font-size: 16px !important;
    color: #666666 !important;
    font-weight: 400 !important;
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
<?php  //chirag 06/09/17
	$date_val = "2017-09-30";   
	$current_date_val = date('Y-m-d');
?>

<?php echo get_register_header(); ?>
</div>
<div class="container" style="margin-top: 15px;">
        <!-- <div class="page-title">
          <h1>
            Advanced Forms
          </h1>
        </div> -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height">
              <!-- <div class="heading">
                <i class="fa fa-edit"></i>Form Wizard
              </div> -->
              <?php if(!empty($_SESSION['users_id'])){
                echo ($_SESSION['users_id']); } ?>
                <?php if(!empty($_SESSION['contract_id'])){
                echo ($_SESSION['contract_id']); } 

                 
                ?>
               
              <div class="widget-content">
                <div class="wizard" id="wizard">
                  <div class="padded">
                    <ul class="wizard-nav">
                      <li>
                        <a data-toggle="tab" href="#tab1">1</a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab2">2 </a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab3">3</a>
                      </li>
                    </ul>
                    <div class="progress progress-striped active">
                      <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" class="progress-bar" role="progressbar"></div>
                    </div>
                    <div class="tab-content">
                      <div class="tab-pane" id="tab1">
                      <form role="form" class="form-personal-detail">
                      <?php 
                        if(isset($get_personal_details)){
                          print_r($get_personal_details[0]['email']);  
                        }
                        
                      ?>
                       <div class="col-md-12">
                        <div class="col-md-6">
                          <h2>
                            Registration - Step 1 Personal Details
                           </h2>
                         </div> 
                         <div class="col-md-4">
                            <span class="pull-right">
                              <div class="form-group">
                                <div class="col-md-12">
                                <center><h4> Company logo </h4></center>
                                  <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 75px;">
                                    <?php  
                                      if(isset($get_personal_details)){

                                        ?>
                                        <img id="responsive_img" name ="upload_logo" src="<?php echo base_url().$get_personal_details[0]['client_logo'] ?>">  
                                        <img id="upload_logos" name ="upload_logos" src="https://www.freelancermap.com/images/company_dummy.png">
                                    <?php  } else {
                                    ?>
                                      <img id="responsive_img" name ="upload_logo" src="https://www.freelancermap.com/images/company_dummy.png">
                                      <img id="upload_logos" name ="upload_logos" src="">
                                    <?php } ?>  
                                    </div>
                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                                    <center>
                                    <div>
                                      <span class="btn btn-default btn-file"><span class="fileupload-new">Select Logo</span><span class="fileupload-exists pull-left">Change</span>
                                      <?php 
                                        if(isset($get_personal_details)){ ?>
                                        <input type="file" name="logo_upload" id="logo_upload" value="<?php echo $get_personal_details[0]['client_logo'];?>" accept=".png, .jpg, .jpeg">
                                        
                                       <?php } else {
                                      ?>
                                      <input type="file" name="logo_upload" id="logo_upload" accept=".png, .jpg, .jpeg">
                                      <?php } ?>
                                      </span><a class="btn btn-default fileupload-exists pull-right" data-dismiss="fileupload" href="#">Remove</a>
                                    </div></center>
                                    <div class="form-group">
                                      <center><input type="hidden" name="logo_upload_err"></center>
                                    </div>
                                  </div>
                                </div>
                              </div>
                             </span> 
                          </div>
                        </div>  
                        <div class="container" style="clear: both;">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="agency_name">Media Agency Name</label>
                              <input class="form-control" name="agency_name" id="agency_name" placeholder="Enter Agency Name" type="text">
                            </div>	
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="agent_name">Agent's Name</label>
                              <input class="form-control" name="agent_name" id="agent_name" placeholder="Enter Agent's Name" type="text">
                            </div>
                          </div>
                          <div class="col-md-4" >
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input class="form-control" id="email" name="email" placeholder="Enter Email" type="text">
                            </div>
                          </div>
                          <div class="col-md-6" style="clear: both;">
                             <div class="form-group">   
                              <label for="phone">Phone</label>
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">+254</span>
                                 <input class="form-control" id="phone" minlength="9" maxlength="9" name="phone" placeholder="Enter Phone Number" type="text" aria-describedby="basic-addon1"> 
                              </div>
                              <div class="form-error">
                                <input type="hidden" name="mobile_err" id="mobile_err">
                              </div>
                            </div>
                          </div>  
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="username">Username</label>
                              <input class="form-control" id="username" name="username" placeholder="Enter Username" type="text" >
                              <!-- onkeypress="return alpha(event)" -->
                            </div>
                          </div>
                          <div class="col-md-6" style="clear: both;">
                            <div class="form-group">
                              <label for="password">Password</label>
                              <input class="form-control" id="password" name="password" placeholder="8-15 characters" type="password">
                            </div>
                          </div> 
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="password">Confirm Password</label>
                              <input class="form-control" id="password" name="confirm_password" placeholder="Enter Confirm Password" type="password">
                            </div>
                          </div>                        
                         </div> 
                        </form>
                      </div>
                      <div class="tab-pane" id="tab2">
                        <h2>
                         <!-- Registration - Step 2 Contract Details-->
                         Registration - Step 2 Subscription Details
                        </h2>
                        <form role="form" class="form-contract-detail">
                         <div class="col-md-4">
                            <div class="form-group">
                              <label for="name">Subscription Title</label><input class="form-control" id="contract_title" name="contract_title" placeholder="Enter Subscription Title" type="text" value="">
                            </div>
                          </div>
                          <!--
                           <div class="col-md-3">
                            <div class="form-group">
                              <label for="country">Membership Plan</label>
                              <select class="form-control" name="membership_plan" id="membership_plan">
                                <option value="0">  Select Plan  </option>
                                <option value="Starter Plan - 12000 SH">  Starter Plan - 12000 SH </option>
                                <option value="Basic Plan  - 21000 SH"> Basic Plan  - 21000 SH </option>
                                <option value="Advanced Plan - 42000 SH"> Advanced Plan - 42000 SH </option>
                                <option value="Professional Plan - 51000 SH"> Professional Plan - 51000 SH </option>
                              </select>
                              <input type="hidden" name="membership_plans_err">
                            </div>
                          </div> -->
                          <input type="hidden" name="membership_plan" id="membership_plan" value="">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="country">Start Date</label><input class="form-control datepicker" id="start_date" name="start_date" placeholder="Enter Start Date" type="text" value=" <?php date_default_timezone_set('Asia/Kolkata'); echo Date('Y-m-d'); ?>" disabled>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="country">End Date</label><input class="form-control datepicker" placeholder="Enter End Date" id="end_date" name="end_date" type="text" value="<?php date_default_timezone_set('Asia/Kolkata'); echo Date('Y-m-d', strtotime('+1 months')); ?>" disabled>
                            </div>
                          </div>

                          <!-- Design radio buttons bootstraps -->
                            <div class="plan_section" style="clear: both;">
                              <center>
                                   <button class="btn btn-lg round btn-primary" type="button" onclick="local()"> Local </button>
                                   <button class="btn btn-lg round btn-primary" type="button" onclick="enterprise_plan()"> Enterprise Plan</button>
                              </center>
                            </div>


                          <!-- End radio buttons design bootstrap -->


                          <!-- Starting Pricing Table here -->
                          <div class="local" id="local">
                            <div class="row pricing-table">
                              <div class="col-sm-3">
                                <center>  <h4> <strong> No trial period </strong> </h4>  </center>
                                <div class="widget-container fluid-height list green">
                                  <div class="widget-content padded text-center">
                                    <h1>
                                     <strong> Starter Plan </strong>
                                    </h1>
                                    <h2>
                                      $<span id="span_start_plan" style="font-size: 46px; font-weight: 300px"></span><span>/month</span>
                                    </h2>
                                    <button class="btn btn-block btn-default" type="button" id="start_select"> Select </button>
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
                                <center> <h4> <strong> 7 days trial period </strong> </h4> </center>
                                <div class="widget-container fluid-height list orange">
                                  <div class="widget-content padded text-center">
                                    <h1>
                                      Basic Plan
                                    </h1>
                                    <h2>
                                      $<span id="span_basic_plan" style="font-size: 46px; font-weight: 300px"></span><span>/month</span>
                                    </h2>
                                    <button class="btn btn-block btn-default" type="button" id="basic_select"> Select </button>
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
                                      Realtime Analytics
                                    </li>
<!--                                     <li>                                      
                                    </li> -->
                                  </ul>
                                </div>
                              </div>
                              <div class="col-sm-3">
                               <center> <h4> <strong> 14 days trial period </strong> </h4> </center>
                                <div class="widget-container fluid-height list blue">
                                  <div class="widget-content padded text-center">
                                    <h1>
                                      Advanced Plan
                                    </h1>
                                    <h2>
                                      $<span id="span_advance_plan" style="font-size: 46px; font-weight: 300px"></span><span>/month</span>                   
                                    </h2>
                                    <button class="btn btn-block btn-default" type="button" id="advance_select"> Select </button>
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
                                <center> <h4> <strong> 14 days trial period </strong></h4> </center>
                                <div class="widget-container fluid-height list red">
                                  <div class="widget-content padded text-center">
                                    <h1>
                                      Professional Plan
                                    </h1>
                                    <h2>
                                      $<span id="span_professional_plan" style="font-size: 46px; font-weight: 300px"></span><span>/month</span>
                                    </h2>
                                    <button class="btn btn-block btn-default" type="button" id="professional_select"> Select </button>
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
                                      SafariX AdTargeting Technology
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
                                    <a class="btn btn-block btn-default" href="#" type="button" id="enterprise_select" data-toggle="modal" data-target="#myModal1"> CONTACT US </a>
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
                          <!-- Ending Pricing Table here -->
                        </form>
                        <!-- <div style="display:;"> <br><br> -->
                          <!--  <form method="post" class="form-horizontal" role="form" action="<?= base_url() ?>common_admin/create_payment_with_paypal">  
                              
                                <fieldset>
                                    <input title="item_name" name="item_name" id="item_name" type="hidden" value="basic plan">
                                    <input title="item_number" name="item_number" id="item_number" type="hidden" value="23412">
                                    <input title="item_description" name="item_description" id="item_description" type="hidden" value="slected basic plan">
                                    <input title="item_tax" name="item_tax" type="hidden" id="item_tax" value="1">
                                    <input title="item_price" name="item_price" id="item_price" type="hidden" value="6000">
                                    <input title="details_tax" name="details_tax" id="details_tax" type="hidden" value="6000">
                                    <input title="details_subtotal" name="details_subtotal" id="details_subtotal" type="hidden" value="6000">

                                    <div class="form-group">
                                        <div class="col-sm-offset-5">
                                            <button  type="submit"  class="btn btn-success">Pay Now</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                          </div>  -->                          

                      </div>
                      <div class="tab-pane" id="tab3">
                        <h2>
                          Registration - Step 3 Payment
                        </h2>
                        <form role="form" class="form-payment-detail">
                        <div class="loader"></div>
                          <div class="form-group">
                          	<label class="control-label">Payment Type</label>
                          <?php if($current_date_val > $date_val)   //chirag 06/09/17
							{
                          ?>
                            <label class="radio" for="option1"><input id="option1" name="payment_type" type="radio" value="manual"><span>Manual Payment to Dorsol Office</span></label>
                            <label class="radio"><input checked="" name="payment_type" type="radio" value="online"><span>Online Payment</span></label>
                          <?php } else { ?>
                          <label class="radio" for="option1"><input id="option1" name="payment_type" type="radio" value="manual"><span>BETA TEST  ( Valid up to 30 Sept 2017 )</span></label>                         
                          <?php } ?>
                          </div>
                          
                        </form>

                        <center>
                           <div id="form_starter_plan" style="display: none;">
                                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" id="starter_form">
                                  <input type="hidden" name="cmd" value="_s-xclick">
                                  <input type="hidden" name="hosted_button_id" value="ECFQM2AMMKFKC">
                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/success_product_payment/1/start_plan/120">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/success_product_payment/1/start_plan/120">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">
                                  <table>
                                   <tr><td><input type="hidden" name="on0" value="Select Starter Plan">Select Starter Plan</td></tr><tr><td><input type="text" name="os0" maxlength="200"></td></tr>
                                  </table>
                                  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </form>                                
                           </div>         
                           <div id="form_basic_plan" style="display: none;">
                                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" id="basic_form">
                                  <input type="hidden" name="cmd" value="_s-xclick">
                                  <input type="hidden" name="hosted_button_id" value="PHATBHXMQWU7Y">    
                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/success_product_payment/1/basic_plan/230">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/success_product_payment/1/basic_plan/230">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">
                                  <table>
                                  <tr><td><input type="hidden" name="on0" value="Enter Basic Plan">Enter Basic Plan</td></tr><tr><td><input type="text" name="os0" maxlength="200"></td></tr>
                                  </table>
                                  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </form>
                           </div>
                           <div id="form_advance_plan" style="display: none;">
                                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" id="advance_form">
                                  <input type="hidden" name="cmd" value="_s-xclick">
                                  <input type="hidden" name="hosted_button_id" value="TFKYUAVBFW3S6">
                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/success_product_payment/1/advance_plan/540">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/success_product_payment/1/advance_plan/540">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">
                                  <table>
                                  <tr><td><input type="hidden" name="on0" value="Enter Advance Plans">Enter Advance Plans</td></tr><tr><td><input type="text" name="os0" maxlength="200"></td></tr>
                                  </table>
                                  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </form>
                           </div>
                           <div id="form_professional_plan" style="display: none;">
                                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" id="professional_form">
                                  <input type="hidden" name="cmd" value="_s-xclick">
                                  <input type="hidden" name="hosted_button_id" value="ARZTYZHJS7QME">
                                  <input type="hidden" name="notify_url" value="<?php echo base_url()?>common_admin/success_product_payment/1/professional_plan/780">
                                  <input type="hidden" name="return" value="<?php echo base_url()?>common_admin/success_product_payment/1/professional_plan/780">
                                  <input type="hidden" name="_notify-synch:cmd" value="_notify-synch">
                                  <table>
                                  <tr><td><input type="hidden" name="on0" value="Enter Professional Plan">Enter Professional Plan</td></tr><tr><td><input type="text" name="os0" maxlength="200"></td></tr>
                                  </table>
                                  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </form>
                           </div>
                         </center>

                      </div>
                    </div>
                  </div>
                  <div class="pager">
                    <div class="btn btn-default-outline btn-previous">
                      <i class="fa fa-long-arrow-left"></i>Back
                    </div>
                     <div class="btn btn-primary-outline btn-next">
                       Continue  <i class="fa fa-long-arrow-right"></i> 
                    </div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>


      <!-- Bootstrap Popup contact form modal -->

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
      <div class="loader"></div>

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



      <!-- End Bootstrap popup modal -->
  <!--  <option value="Starter Plan - 12000 SH">  Starter Plan - 12000 SH </option>
    <option value="Basic Plan  - 21000 SH"> Basic Plan  - 21000 SH </option>
    <option value="Advanced Plan - 42000 SH"> Advanced Plan - 42000 SH </option>
    <option value="Professional Plan - 51000 SH"> Professional Plan - 51000 SH </option> -->

<?php echo get_footer(); ?>
 <script type="text/javascript">


      $('#span_start_plan').text(amount_starter_plan);
      $('#span_basic_plan').text(amount_basic_plan);
      $('#span_advance_plan').text(amount_advance_plan);
      $('#span_professional_plan').text(amount_professional_plan);

    $( document ).ready(function() {
        $('#no_plan_selection').show();
        $('#show_start_plan').hide();
        $('#show_basic_plan').hide();
        $('#show_advance_plan').hide();
        $('#show_professional_plan').hide();
    })
     
     // $('#start_select').on('click', function() {
     //    $('#membership_plan').val('');
     //    var tst = $('#membership_plan').val('Starter Plan - 12000 SH');
     // }); 
     // $('#basic_select').on('click', function() {
     //    $('#membership_plan').val('');
     //    var tst = $('#membership_plan').val('Basic Plan  - 21000 SH');
     // }); 
     // $('#advance_select').on('click', function() {
     //    $('#membership_plan').val('');
     //    var tst = $('#membership_plan').val('Advanced Plan - 42000 SH');
     // }); 
     // $('#professional_select').on('click', function() { 
     //    $('#membership_plan').val('');
     //    var tst = $('#membership_plan').val('Professional Plan - 51000 SH');
     // }); 

     $('#start_select').on('click', function() {

        $('#no_plan_selection').hide();
        $('#show_start_plan').show();
        $('#show_basic_plan').hide();
        $('#show_advance_plan').hide();
        $('#show_professional_plan').hide();
        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Starter Plan - '+amount_starter_plan+' SH');
        var tst1 = $('#item_name').val('Starter Plan');
        var tst2 = $('#item_number').val('1');
     }); 
     $('#basic_select').on('click', function() {

        $('#no_plan_selection').hide();
        $('#show_start_plan').hide();
        $('#show_basic_plan').show();
        $('#show_advance_plan').hide();
        $('#show_professional_plan').hide();
        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Basic Plan  - '+amount_basic_plan+' SH');
        var tst1 = $('#item_name').val('Basic Plan');
        var tst2 = $('#item_number').val('2');
     }); 
     $('#advance_select').on('click', function() {

        $('#no_plan_selection').hide();
        $('#show_start_plan').hide();
        $('#show_basic_plan').hide();
        $('#show_advance_plan').show();
        $('#show_professional_plan').hide();
        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Advanced Plan - '+amount_advance_plan+' SH');
        var tst1 = $('#item_name').val('Advanced Plan');
        var tst2 = $('#item_number').val('3');
     }); 
     $('#professional_select').on('click', function() { 

        $('#no_plan_selection').hide();
        $('#show_start_plan').hide();
        $('#show_basic_plan').hide();
        $('#show_advance_plan').hide();
        $('#show_professional_plan').show();
        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Professional Plan - '+amount_professional_plan+' SH');
        var tst1 = $('#item_name').val('Professional Plan');
        var tst2 = $('#item_number').val('4');
     }); 
     
     $('#paynow').on('click', function() {
        sweetAlert("Please Select Membership Plan!...", "", "error");
        if(contract_title == ''){
          contract_title.parents('div.form-group').addClass('has-error');
          $(get_error_msg(contract_title_err)).insertAfter(contract_title);     
          check_valid = 1;
          return false;   
        }
     });

  </script>
  <script type="text/javascript">
  $(document).ready(function(){
    
    var b1 = document.getElementById("start_select");
    var b2 = document.getElementById("basic_select");
    var b3 = document.getElementById("advance_select");
    var b4 = document.getElementById("professional_select");
    var b5 = document.getElementById("enterprise_select");

    var hash = $.cookie("color_cok");

    if(hash == 'green'){
         b1.style.background = "goldenrod";    
         var tst = $('#membership_plan').val('Starter Plan - '+amount_starter_plan+' SH');
    }
    if(hash == 'orange'){
      b2.style.background = "goldenrod";  
      var tst = $('#membership_plan').val('Basic Plan  - '+amount_basic_plan+' SH');
    }
    if(hash == 'blue'){
      b3.style.background = "goldenrod"; 
      var tst = $('#membership_plan').val('Advanced Plan - '+amount_advance_plan+' SH');
    }
    if(hash == 'red'){
      b4.style.background = "goldenrod";  
      var tst = $('#membership_plan').val('Professional Plan - '+amount_professional_plan+' SH');
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