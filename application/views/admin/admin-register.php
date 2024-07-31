
<?php
require_once('functions.php');

?> 
<!--Initialize Header section and css files-->
<style type="text/css">
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


<?php echo get_register_header(); ?>
</div>
<div class="container">
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
                echo ($_SESSION['contract_id']); } ?>

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
                                      <img src="https://www.freelancermap.com/images/company_dummy.png">
                                    </div>
                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                                    <center>
                                    <div>
                                      <span class="btn btn-default btn-file"><span class="fileupload-new">Select Logo</span><span class="fileupload-exists pull-left">Change</span><input type="file" name="logo_upload" id="logo_upload"></span><a class="btn btn-default fileupload-exists pull-right" data-dismiss="fileupload" href="#">Remove</a>
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
                              <label for="agency_name">Media Agency Name</label><input class="form-control" name="agency_name" id="agency_name" placeholder="Enter Agency Name" type="text">
                            </div>	
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="agent_name">Agent's Name</label><input class="form-control" name="agent_name" id="agent_name" placeholder="Enter Agent's Name" type="text">
                            </div>
                          </div>
                          <div class="col-md-4" >
                            <div class="form-group">
                              <label for="email">Email</label><input class="form-control" id="email" name="email" placeholder="Enter Email" type="text">
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
                              <label for="username">Username</label><input class="form-control" id="username" name="username" placeholder="Enter Username" type="text" onkeypress="return alpha(event)">
                            </div>
                          </div>
                          <div class="col-md-6" style="clear: both;">
                            <div class="form-group">
                              <label for="password">Password</label><input class="form-control" id="password" name="password" placeholder="8-15 characters" type="password">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="password">Confirm Password</label><input class="form-control" id="password" name="confirm_password" placeholder="Enter Confirm Password" type="password">
                            </div>
                          </div>                        
                         </div> 
                        </form>
                      </div>
                      <div class="tab-pane" id="tab2">
                        <h2>
                          Registration - Step 2 Contract Details
                        </h2>
                        <form role="form" class="form-contract-detail">
                         <div class="col-md-4">
                            <div class="form-group">
                              <label for="name">Contract Title</label><input class="form-control" id="contract_title" name="contract_title" placeholder="Enter Contract Title" type="text" value="">
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
                            <div id="solid-wrapper">
                              <div class="solid-pricing pricing-design-25">
                              <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                  <div class="pricing-container text-center">
                                    <div class="pricing-header text-dark bg-white">
                                        <h2 class="pricing-title ls-1 margin-bottom-0 text-white bg-dark">Starter <br> Plan<br></h2>
                                          <div class="svg-container" style="transform: rotateX(180deg); margin-top: -6px">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="100 0 285 32" enable-background="new 100 0 285 32" xml:space="preserve">
                                            <path fill="#2B2B33" d="M572.103,72.784c-23.361,2.256-24.239-15.963-47.709-15.963c-23.471,0-23.471,16-46.941,16
                                                              c-23.472,0-23.472-16-46.943-16c-23.473,0-23.473,16-46.945,16c-23.472,0-23.472-16-46.942-16c-23.473,0-23.473,16-46.945,16
                                                              c-23.472,0-23.472-16-46.943-16s-23.471,16-46.943,16c-23.473,0-23.473-16-46.945-16c-23.472,0-23.472,16-46.944,16
                                                              c-23.475,0-23.475-16-46.951-16c-23.475,0-24.35,18.213-47.717,15.963C4.983,72.567,16,62.561,16,60.301c0-2.262-16-2.262-16-4.524
                                                              c0-2.261,16-2.261,16-4.521c0-2.262-16-2.262-16-4.523c0-2.263,16-2.263,16-4.526c0-2.263-16-2.263-16-4.525s16-2.263,16-4.525
                                                              S0,30.892,0,28.629c0-2.263,16-2.263,16-4.525c0-2.265-16-2.265-16-4.529c0-2.266,16-2.266,16-4.532S4.976,2.765,7.231,2.547
                                                              C30.593,0.292,31.47,18.51,54.94,18.51c23.471,0,23.471-16,46.941-16c23.472,0,23.472,16,46.944,16s23.472-16,46.944-16
                                                              c23.472,0,23.472,16,46.943,16c23.472,0,23.472-16,46.945-16c23.471,0,23.471,16,46.942,16s23.472-16,46.943-16
                                                              c23.473,0,23.473,16,46.945,16c23.472,0,23.472-16,46.944-16c23.475,0,23.475,16,46.95,16s24.35-18.213,47.717-15.963
                                                              c2.25,0.217-8.767,10.224-8.767,12.483c0,2.262,16,2.262,16,4.524c0,2.261-16,2.261-16,4.521c0,2.262,16,2.262,16,4.524
                                                              c0,2.263-16,2.263-16,4.526s16,2.263,16,4.525s-16,2.263-16,4.526c0,2.262,16,2.262,16,4.524s-16,2.263-16,4.525
                                                              c0,2.265,16,2.265,16,4.529c0,2.267-16.274,3.719-15.874,5.949C564.609,68.09,574.358,72.566,572.103,72.784z"/>
                                                            </svg>
                                                          </div>
                                                        <h1 class="pricing-price ls-1 h-1-big bg-white margin-top-1-5">KSh 12000</h1>
                                                          <div class="svg-container" style="margin-bottom: -6px">
                                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="100 0 285 32" enable-background="new 100 0 285 32" xml:space="preserve"><path fill="#2B2B33" d="M572.103,72.784c-23.361,2.256-24.239-15.963-47.709-15.963c-23.471,0-23.471,16-46.941,16
                                                            c-23.472,0-23.472-16-46.943-16c-23.473,0-23.473,16-46.945,16c-23.472,0-23.472-16-46.942-16c-23.473,0-23.473,16-46.945,16
                                                            c-23.472,0-23.472-16-46.943-16s-23.471,16-46.943,16c-23.473,0-23.473-16-46.945-16c-23.472,0-23.472,16-46.944,16
                                                            c-23.475,0-23.475-16-46.951-16c-23.475,0-24.35,18.213-47.717,15.963C4.983,72.567,16,62.561,16,60.301c0-2.262-16-2.262-16-4.524
                                                            c0-2.261,16-2.261,16-4.521c0-2.262-16-2.262-16-4.523c0-2.263,16-2.263,16-4.526c0-2.263-16-2.263-16-4.525s16-2.263,16-4.525
                                                            S0,30.892,0,28.629c0-2.263,16-2.263,16-4.525c0-2.265-16-2.265-16-4.529c0-2.266,16-2.266,16-4.532S4.976,2.765,7.231,2.547
                                                            C30.593,0.292,31.47,18.51,54.94,18.51c23.471,0,23.471-16,46.941-16c23.472,0,23.472,16,46.944,16s23.472-16,46.944-16
                                                            c23.472,0,23.472,16,46.943,16c23.472,0,23.472-16,46.945-16c23.471,0,23.471,16,46.942,16s23.472-16,46.943-16
                                                            c23.473,0,23.473,16,46.945,16c23.472,0,23.472-16,46.944-16c23.475,0,23.475,16,46.95,16s24.35-18.213,47.717-15.963
                                                            c2.25,0.217-8.767,10.224-8.767,12.483c0,2.262,16,2.262,16,4.524c0,2.261-16,2.261-16,4.521c0,2.262,16,2.262,16,4.524
                                                            c0,2.263-16,2.263-16,4.526s16,2.263,16,4.525s-16,2.263-16,4.526c0,2.262,16,2.262,16,4.524s-16,2.263-16,4.525
                                                            c0,2.265,16,2.265,16,4.529c0,2.267-16.274,3.719-15.874,5.949C564.609,68.09,574.358,72.566,572.103,72.784z"/></svg>
                                                          </div>
                                                        </div>
                                                        <div class="pricing-body bg-white bg-dark">
                                                        <ul class="pricing-list text-center text-white margin-bottom-0 h-7">
                                                          <h4> Ad Space </h4>
                                                            <li>Video or Display (Image) Ads</li>
                                                            <li>1200 views/600 minutes </li>
                                                            <li> 1 view = 30 seconds </li>
                                                            <li>Cost per view = 10</li>
                                                            <br>
                                                          <h4> Features </h4>
                                                          <li>Metro-wide Reach</li>
                                                          <li>Realtime Analytics </li>
                                                          <li> High-value audience </li>
                                                          <li> 2 Call-to-Action Buttons </li>
                                                        </ul>
                                                        </div>
                                                        <div class="pricing-footer text-center text-dark bg-dark">
                                                        <button class="btn btn-md btn-mw-150 border-radius-50 margin-top-1 btn-transparent-white" id="start_select" type="button"><span class="h-7 heading-font ls-1"> Select </span></button>
                                                        </div>
                                                      </div>
                                                    </div>

                                                    <!-- table 2 -->

                                                      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                      <div class="pricing-container text-center">
                                                      <div class="pricing-header text-dark bg-white">
                                                      <p class="pricing-ribbon pricing-ribbon-rectangular pricing-ribbon-folded-1 text-orange bg-orange h-7" style="width: 50%; left: 0; right: 0; margin: auto; top: -12px; border-radius: 0 0 5px 5px"><span class="text-white ls-1">FRESH</span>
                                                      </p>
                                                      <h2 class="pricing-title ls-1 margin-bottom-0 text-white bg-dark-green">Basic<br>Plan <br></h2>
                                                      <div class="svg-container" style="transform: rotateX(180deg); margin-top: -6px">
                                                      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="100 0 285 32" enable-background="new 100 0 285 32" xml:space="preserve"><path fill="#006D26" d="M572.103,72.784c-23.361,2.256-24.239-15.963-47.709-15.963c-23.471,0-23.471,16-46.941,16
                                                      c-23.472,0-23.472-16-46.943-16c-23.473,0-23.473,16-46.945,16c-23.472,0-23.472-16-46.942-16c-23.473,0-23.473,16-46.945,16
                                                      c-23.472,0-23.472-16-46.943-16s-23.471,16-46.943,16c-23.473,0-23.473-16-46.945-16c-23.472,0-23.472,16-46.944,16
                                                      c-23.475,0-23.475-16-46.951-16c-23.475,0-24.35,18.213-47.717,15.963C4.983,72.567,16,62.561,16,60.301c0-2.262-16-2.262-16-4.524
                                                      c0-2.261,16-2.261,16-4.521c0-2.262-16-2.262-16-4.523c0-2.263,16-2.263,16-4.526c0-2.263-16-2.263-16-4.525s16-2.263,16-4.525
                                                      S0,30.892,0,28.629c0-2.263,16-2.263,16-4.525c0-2.265-16-2.265-16-4.529c0-2.266,16-2.266,16-4.532S4.976,2.765,7.231,2.547
                                                      C30.593,0.292,31.47,18.51,54.94,18.51c23.471,0,23.471-16,46.941-16c23.472,0,23.472,16,46.944,16s23.472-16,46.944-16
                                                      c23.472,0,23.472,16,46.943,16c23.472,0,23.472-16,46.945-16c23.471,0,23.471,16,46.942,16s23.472-16,46.943-16
                                                      c23.473,0,23.473,16,46.945,16c23.472,0,23.472-16,46.944-16c23.475,0,23.475,16,46.95,16s24.35-18.213,47.717-15.963
                                                      c2.25,0.217-8.767,10.224-8.767,12.483c0,2.262,16,2.262,16,4.524c0,2.261-16,2.261-16,4.521c0,2.262,16,2.262,16,4.524
                                                      c0,2.263-16,2.263-16,4.526s16,2.263,16,4.525s-16,2.263-16,4.526c0,2.262,16,2.262,16,4.524s-16,2.263-16,4.525
                                                      c0,2.265,16,2.265,16,4.529c0,2.267-16.274,3.719-15.874,5.949C564.609,68.09,574.358,72.566,572.103,72.784z"/></svg></div><h1 class="pricing-price ls-1 h-1-big bg-white margin-top-1-5">KSh 21000</h1><div class="svg-container" style="margin-bottom: -6px"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="100 0 285 32" enable-background="new 100 0 285 32" xml:space="preserve"><path fill="#006D26" d="M572.103,72.784c-23.361,2.256-24.239-15.963-47.709-15.963c-23.471,0-23.471,16-46.941,16
                                                      c-23.472,0-23.472-16-46.943-16c-23.473,0-23.473,16-46.945,16c-23.472,0-23.472-16-46.942-16c-23.473,0-23.473,16-46.945,16
                                                      c-23.472,0-23.472-16-46.943-16s-23.471,16-46.943,16c-23.473,0-23.473-16-46.945-16c-23.472,0-23.472,16-46.944,16
                                                      c-23.475,0-23.475-16-46.951-16c-23.475,0-24.35,18.213-47.717,15.963C4.983,72.567,16,62.561,16,60.301c0-2.262-16-2.262-16-4.524
                                                      c0-2.261,16-2.261,16-4.521c0-2.262-16-2.262-16-4.523c0-2.263,16-2.263,16-4.526c0-2.263-16-2.263-16-4.525s16-2.263,16-4.525
                                                      S0,30.892,0,28.629c0-2.263,16-2.263,16-4.525c0-2.265-16-2.265-16-4.529c0-2.266,16-2.266,16-4.532S4.976,2.765,7.231,2.547
                                                      C30.593,0.292,31.47,18.51,54.94,18.51c23.471,0,23.471-16,46.941-16c23.472,0,23.472,16,46.944,16s23.472-16,46.944-16
                                                      c23.472,0,23.472,16,46.943,16c23.472,0,23.472-16,46.945-16c23.471,0,23.471,16,46.942,16s23.472-16,46.943-16
                                                      c23.473,0,23.473,16,46.945,16c23.472,0,23.472-16,46.944-16c23.475,0,23.475,16,46.95,16s24.35-18.213,47.717-15.963
                                                      c2.25,0.217-8.767,10.224-8.767,12.483c0,2.262,16,2.262,16,4.524c0,2.261-16,2.261-16,4.521c0,2.262,16,2.262,16,4.524
                                                      c0,2.263-16,2.263-16,4.526s16,2.263,16,4.525s-16,2.263-16,4.526c0,2.262,16,2.262,16,4.524s-16,2.263-16,4.525
                                                      c0,2.265,16,2.265,16,4.529c0,2.267-16.274,3.719-15.874,5.949C564.609,68.09,574.358,72.566,572.103,72.784z"/></svg>
                                                      </div>
                                                      </div>
                                                      <div class="pricing-body bg-white bg-dark-green">
                                                      <ul class="pricing-list text-center text-white margin-bottom-0 h-7">
                                                      <h4> Ad Space </h4>
                                                      <li>Video or Display (Image) Ads</li>
                                                      <li>2500 views/1300 minutes </li>
                                                      <li> 1 view = 30 seconds </li>
                                                      <li>Cost per view = 8.4</li>
                                                      <br>
                                                        <h4> Features </h4>
                                                          <li>Get all Starter Plan features</li>
                                                          <li> Target ads by ride category </li>
                                                          <li> Realtime Analytics </li>
                                                          <li> 2 Call-to-Action Buttons </li>
                                                      </ul>
                                                      </div>
                                                      <div class="pricing-footer text-center text-dark bg-dark-green">
                                                        <button class="btn btn-md btn-mw-150 border-radius-50 margin-top-1 btn-transparent-white" id="basic_select" type="button"><span class="h-7 heading-font ls-1">SELECT</span></button>
                                                        </div>
                                                      </div>
                                                      </div>
                                                      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><div class="pricing-container text-center"><div class="pricing-header text-dark bg-white"><h2 class="pricing-title ls-1 margin-bottom-0 text-white bg-danger">Advanced Plan</h2><div class="svg-container" style="transform: rotateX(180deg); margin-top: -6px"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="100 0 285 32" enable-background="new 100 0 285 32" xml:space="preserve"><path fill="#B32B1D" d="M572.103,72.784c-23.361,2.256-24.239-15.963-47.709-15.963c-23.471,0-23.471,16-46.941,16
                                                      c-23.472,0-23.472-16-46.943-16c-23.473,0-23.473,16-46.945,16c-23.472,0-23.472-16-46.942-16c-23.473,0-23.473,16-46.945,16
                                                      c-23.472,0-23.472-16-46.943-16s-23.471,16-46.943,16c-23.473,0-23.473-16-46.945-16c-23.472,0-23.472,16-46.944,16
                                                      c-23.475,0-23.475-16-46.951-16c-23.475,0-24.35,18.213-47.717,15.963C4.983,72.567,16,62.561,16,60.301c0-2.262-16-2.262-16-4.524
                                                      c0-2.261,16-2.261,16-4.521c0-2.262-16-2.262-16-4.523c0-2.263,16-2.263,16-4.526c0-2.263-16-2.263-16-4.525s16-2.263,16-4.525
                                                      S0,30.892,0,28.629c0-2.263,16-2.263,16-4.525c0-2.265-16-2.265-16-4.529c0-2.266,16-2.266,16-4.532S4.976,2.765,7.231,2.547
                                                      C30.593,0.292,31.47,18.51,54.94,18.51c23.471,0,23.471-16,46.941-16c23.472,0,23.472,16,46.944,16s23.472-16,46.944-16
                                                      c23.472,0,23.472,16,46.943,16c23.472,0,23.472-16,46.945-16c23.471,0,23.471,16,46.942,16s23.472-16,46.943-16
                                                      c23.473,0,23.473,16,46.945,16c23.472,0,23.472-16,46.944-16c23.475,0,23.475,16,46.95,16s24.35-18.213,47.717-15.963
                                                      c2.25,0.217-8.767,10.224-8.767,12.483c0,2.262,16,2.262,16,4.524c0,2.261-16,2.261-16,4.521c0,2.262,16,2.262,16,4.524
                                                      c0,2.263-16,2.263-16,4.526s16,2.263,16,4.525s-16,2.263-16,4.526c0,2.262,16,2.262,16,4.524s-16,2.263-16,4.525
                                                      c0,2.265,16,2.265,16,4.529c0,2.267-16.274,3.719-15.874,5.949C564.609,68.09,574.358,72.566,572.103,72.784z"/></svg></div><h1 class="pricing-price ls-1 h-1-big bg-white margin-top-1-5">KSh 42000</h1><div class="svg-container" style="margin-bottom: -6px"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="100 0 285 32" enable-background="new 100 0 285 32" xml:space="preserve"><path fill="#B32B1D" d="M572.103,72.784c-23.361,2.256-24.239-15.963-47.709-15.963c-23.471,0-23.471,16-46.941,16
                                                      c-23.472,0-23.472-16-46.943-16c-23.473,0-23.473,16-46.945,16c-23.472,0-23.472-16-46.942-16c-23.473,0-23.473,16-46.945,16
                                                      c-23.472,0-23.472-16-46.943-16s-23.471,16-46.943,16c-23.473,0-23.473-16-46.945-16c-23.472,0-23.472,16-46.944,16
                                                      c-23.475,0-23.475-16-46.951-16c-23.475,0-24.35,18.213-47.717,15.963C4.983,72.567,16,62.561,16,60.301c0-2.262-16-2.262-16-4.524
                                                      c0-2.261,16-2.261,16-4.521c0-2.262-16-2.262-16-4.523c0-2.263,16-2.263,16-4.526c0-2.263-16-2.263-16-4.525s16-2.263,16-4.525
                                                      S0,30.892,0,28.629c0-2.263,16-2.263,16-4.525c0-2.265-16-2.265-16-4.529c0-2.266,16-2.266,16-4.532S4.976,2.765,7.231,2.547
                                                      C30.593,0.292,31.47,18.51,54.94,18.51c23.471,0,23.471-16,46.941-16c23.472,0,23.472,16,46.944,16s23.472-16,46.944-16
                                                      c23.472,0,23.472,16,46.943,16c23.472,0,23.472-16,46.945-16c23.471,0,23.471,16,46.942,16s23.472-16,46.943-16
                                                      c23.473,0,23.473,16,46.945,16c23.472,0,23.472-16,46.944-16c23.475,0,23.475,16,46.95,16s24.35-18.213,47.717-15.963
                                                      c2.25,0.217-8.767,10.224-8.767,12.483c0,2.262,16,2.262,16,4.524c0,2.261-16,2.261-16,4.521c0,2.262,16,2.262,16,4.524
                                                      c0,2.263-16,2.263-16,4.526s16,2.263,16,4.525s-16,2.263-16,4.526c0,2.262,16,2.262,16,4.524s-16,2.263-16,4.525
                                                      c0,2.265,16,2.265,16,4.529c0,2.267-16.274,3.719-15.874,5.949C564.609,68.09,574.358,72.566,572.103,72.784z"/></svg>
                                                      </div>
                                                      </div>
                                                      <div class="pricing-body bg-white bg-danger">
                                                      <ul class="pricing-list text-center text-white margin-bottom-0 h-7">
                                                      <h4> Ad Space </h4>
                                                      <li>Video or Display (Image) Ads</li>
                                                      <li>6000 views/3000 minutes </li>
                                                      <li> 1 view = 30 seconds </li>
                                                      <li>Cost per view = 7</li>
                                                      <br>
                                                        <h4> Features </h4>
                                                          <li> Get all Basic Plan features</li>
                                                          <li> Target 2 additional categories </li>
                                                          <li> Realtime Analytics</li>
                                                          <li> 2 Call-to-Action Buttons </li>
                                                      </ul>
                                                      </div><div class="pricing-footer text-center text-dark bg-danger">
                                                      <button class="btn btn-md btn-mw-150 border-radius-50 margin-top-1 btn-transparent-white" id="advance_select" type="button"><span class="h-7 heading-font ls-1">SELECT</span></button>
                                                      </div>
                                                      </div>
                                                      </div>
                                                      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><div class="pricing-container text-center"><div class="pricing-header text-dark bg-white"><p class="pricing-ribbon pricing-ribbon-rectangular pricing-ribbon-folded-1 text-dark-purple bg-dark-purple h-7" style="width: 50%; left: 0; right: 0; margin: auto; top: -12px; border-radius: 0 0 5px 5px"><span class="text-white ls-1">HOT ITEM</span></p><h2 class="pricing-title ls-1 margin-bottom-0 text-white bg-sea">Professional Plan</h2><div class="svg-container" style="transform: rotateX(180deg); margin-top: -6px"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="100 0 285 32" enable-background="new 100 0 285 32" xml:space="preserve"><path fill="#1282C3" d="M572.103,72.784c-23.361,2.256-24.239-15.963-47.709-15.963c-23.471,0-23.471,16-46.941,16
                                                      c-23.472,0-23.472-16-46.943-16c-23.473,0-23.473,16-46.945,16c-23.472,0-23.472-16-46.942-16c-23.473,0-23.473,16-46.945,16
                                                      c-23.472,0-23.472-16-46.943-16s-23.471,16-46.943,16c-23.473,0-23.473-16-46.945-16c-23.472,0-23.472,16-46.944,16
                                                      c-23.475,0-23.475-16-46.951-16c-23.475,0-24.35,18.213-47.717,15.963C4.983,72.567,16,62.561,16,60.301c0-2.262-16-2.262-16-4.524
                                                      c0-2.261,16-2.261,16-4.521c0-2.262-16-2.262-16-4.523c0-2.263,16-2.263,16-4.526c0-2.263-16-2.263-16-4.525s16-2.263,16-4.525
                                                      S0,30.892,0,28.629c0-2.263,16-2.263,16-4.525c0-2.265-16-2.265-16-4.529c0-2.266,16-2.266,16-4.532S4.976,2.765,7.231,2.547
                                                      C30.593,0.292,31.47,18.51,54.94,18.51c23.471,0,23.471-16,46.941-16c23.472,0,23.472,16,46.944,16s23.472-16,46.944-16
                                                      c23.472,0,23.472,16,46.943,16c23.472,0,23.472-16,46.945-16c23.471,0,23.471,16,46.942,16s23.472-16,46.943-16
                                                      c23.473,0,23.473,16,46.945,16c23.472,0,23.472-16,46.944-16c23.475,0,23.475,16,46.95,16s24.35-18.213,47.717-15.963
                                                      c2.25,0.217-8.767,10.224-8.767,12.483c0,2.262,16,2.262,16,4.524c0,2.261-16,2.261-16,4.521c0,2.262,16,2.262,16,4.524
                                                      c0,2.263-16,2.263-16,4.526s16,2.263,16,4.525s-16,2.263-16,4.526c0,2.262,16,2.262,16,4.524s-16,2.263-16,4.525
                                                      c0,2.265,16,2.265,16,4.529c0,2.267-16.274,3.719-15.874,5.949C564.609,68.09,574.358,72.566,572.103,72.784z"/></svg></div><h1 class="pricing-price ls-1 h-1-big bg-white margin-top-1-5">KSh 51000</h1><div class="svg-container" style="margin-bottom: -6px"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="100 0 285 32" enable-background="new 100 0 285 32" xml:space="preserve"><path fill="#1282C3" d="M572.103,72.784c-23.361,2.256-24.239-15.963-47.709-15.963c-23.471,0-23.471,16-46.941,16
                                                      c-23.472,0-23.472-16-46.943-16c-23.473,0-23.473,16-46.945,16c-23.472,0-23.472-16-46.942-16c-23.473,0-23.473,16-46.945,16
                                                      c-23.472,0-23.472-16-46.943-16s-23.471,16-46.943,16c-23.473,0-23.473-16-46.945-16c-23.472,0-23.472,16-46.944,16
                                                      c-23.475,0-23.475-16-46.951-16c-23.475,0-24.35,18.213-47.717,15.963C4.983,72.567,16,62.561,16,60.301c0-2.262-16-2.262-16-4.524
                                                      c0-2.261,16-2.261,16-4.521c0-2.262-16-2.262-16-4.523c0-2.263,16-2.263,16-4.526c0-2.263-16-2.263-16-4.525s16-2.263,16-4.525
                                                      S0,30.892,0,28.629c0-2.263,16-2.263,16-4.525c0-2.265-16-2.265-16-4.529c0-2.266,16-2.266,16-4.532S4.976,2.765,7.231,2.547
                                                      C30.593,0.292,31.47,18.51,54.94,18.51c23.471,0,23.471-16,46.941-16c23.472,0,23.472,16,46.944,16s23.472-16,46.944-16
                                                      c23.472,0,23.472,16,46.943,16c23.472,0,23.472-16,46.945-16c23.471,0,23.471,16,46.942,16s23.472-16,46.943-16
                                                      c23.473,0,23.473,16,46.945,16c23.472,0,23.472-16,46.944-16c23.475,0,23.475,16,46.95,16s24.35-18.213,47.717-15.963
                                                      c2.25,0.217-8.767,10.224-8.767,12.483c0,2.262,16,2.262,16,4.524c0,2.261-16,2.261-16,4.521c0,2.262,16,2.262,16,4.524
                                                      c0,2.263-16,2.263-16,4.526s16,2.263,16,4.525s-16,2.263-16,4.526c0,2.262,16,2.262,16,4.524s-16,2.263-16,4.525
                                                      c0,2.265,16,2.265,16,4.529c0,2.267-16.274,3.719-15.874,5.949C564.609,68.09,574.358,72.566,572.103,72.784z"/></svg>
                                                      </div>
                                                      </div>
                                                      <div class="pricing-body bg-white bg-sea">
                                                      <ul class="pricing-list text-center text-white margin-bottom-0 h-7">
                                                        <h4> Ad Space </h4> 
                                                          <li> Video or Display (Image) Ads </li>
                                                          <li> 9000 views/4500 minutes </li>
                                                          <li> 1 view = 30 seconds </li>
                                                          <li> Cost per view = 5.67 </li>
                                                          <br>
                                                        <h4> Features </h4>
                                                          <li> Get all Advanced Plan features</li>
                                                          <li> Account Manager Support </li>
                                                          <li> Multiple User Accounts </li>
                                                          <li> Realtime Analytics </li>
                                                      </ul>
                                                      </div>
                                                      <div class="pricing-footer text-center text-white bg-sea">
                                                      <button class="btn btn-md btn-mw-150 border-radius-50 margin-top-1 btn-transparent-white" id="professional_select" type="button"><span class="h-7 heading-font ls-1">SELECT</span></button></div></div></div>


                                                    <!-- end table 2 -->



                                                  </div>  
                                                </div>
                                              </div>  
                                            </div>  
                            </div>
                            <div class="enterprise_plan" id="enterprise_plan">
                              <div class="col-md-4"></div>
                              <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                <div id="solid-wrapper">
                                <div class="solid-pricing pricing-design-25">
                                <div class="container-fluid">
                                <div class="row">
                                  <div class="pricing-container text-center">
                                    <div class="pricing-header text-dark bg-white">
                                        <h2 class="pricing-title ls-1 margin-bottom-0 text-white bg-dark-green"> Enterprise </h2>
                                          <div class="svg-container" style="transform: rotateX(180deg); margin-top: -6px">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="100 0 285 32" enable-background="new 100 0 285 32" xml:space="preserve"><path fill="#006D26" d="M572.103,72.784c-23.361,2.256-24.239-15.963-47.709-15.963c-23.471,0-23.471,16-46.941,16
                                                      c-23.472,0-23.472-16-46.943-16c-23.473,0-23.473,16-46.945,16c-23.472,0-23.472-16-46.942-16c-23.473,0-23.473,16-46.945,16
                                                      c-23.472,0-23.472-16-46.943-16s-23.471,16-46.943,16c-23.473,0-23.473-16-46.945-16c-23.472,0-23.472,16-46.944,16
                                                      c-23.475,0-23.475-16-46.951-16c-23.475,0-24.35,18.213-47.717,15.963C4.983,72.567,16,62.561,16,60.301c0-2.262-16-2.262-16-4.524
                                                      c0-2.261,16-2.261,16-4.521c0-2.262-16-2.262-16-4.523c0-2.263,16-2.263,16-4.526c0-2.263-16-2.263-16-4.525s16-2.263,16-4.525
                                                      S0,30.892,0,28.629c0-2.263,16-2.263,16-4.525c0-2.265-16-2.265-16-4.529c0-2.266,16-2.266,16-4.532S4.976,2.765,7.231,2.547
                                                      C30.593,0.292,31.47,18.51,54.94,18.51c23.471,0,23.471-16,46.941-16c23.472,0,23.472,16,46.944,16s23.472-16,46.944-16
                                                      c23.472,0,23.472,16,46.943,16c23.472,0,23.472-16,46.945-16c23.471,0,23.471,16,46.942,16s23.472-16,46.943-16
                                                      c23.473,0,23.473,16,46.945,16c23.472,0,23.472-16,46.944-16c23.475,0,23.475,16,46.95,16s24.35-18.213,47.717-15.963
                                                      c2.25,0.217-8.767,10.224-8.767,12.483c0,2.262,16,2.262,16,4.524c0,2.261-16,2.261-16,4.521c0,2.262,16,2.262,16,4.524
                                                      c0,2.263-16,2.263-16,4.526s16,2.263,16,4.525s-16,2.263-16,4.526c0,2.262,16,2.262,16,4.524s-16,2.263-16,4.525
                                                      c0,2.265,16,2.265,16,4.529c0,2.267-16.274,3.719-15.874,5.949C564.609,68.09,574.358,72.566,572.103,72.784z"/></svg>
                                                          </div>
                                                        <h1 class="pricing-price ls-1 h-1-big bg-white margin-top-1-5">FREE 2 WEEK TRIAL</h1>
                                                          <div class="svg-container" style="margin-bottom: -6px">
                                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="100 0 285 32" enable-background="new 100 0 285 32" xml:space="preserve"><path fill="#006D26" d="M572.103,72.784c-23.361,2.256-24.239-15.963-47.709-15.963c-23.471,0-23.471,16-46.941,16
                                                            c-23.472,0-23.472-16-46.943-16c-23.473,0-23.473,16-46.945,16c-23.472,0-23.472-16-46.942-16c-23.473,0-23.473,16-46.945,16
                                                            c-23.472,0-23.472-16-46.943-16s-23.471,16-46.943,16c-23.473,0-23.473-16-46.945-16c-23.472,0-23.472,16-46.944,16
                                                            c-23.475,0-23.475-16-46.951-16c-23.475,0-24.35,18.213-47.717,15.963C4.983,72.567,16,62.561,16,60.301c0-2.262-16-2.262-16-4.524
                                                            c0-2.261,16-2.261,16-4.521c0-2.262-16-2.262-16-4.523c0-2.263,16-2.263,16-4.526c0-2.263-16-2.263-16-4.525s16-2.263,16-4.525
                                                            S0,30.892,0,28.629c0-2.263,16-2.263,16-4.525c0-2.265-16-2.265-16-4.529c0-2.266,16-2.266,16-4.532S4.976,2.765,7.231,2.547
                                                            C30.593,0.292,31.47,18.51,54.94,18.51c23.471,0,23.471-16,46.941-16c23.472,0,23.472,16,46.944,16s23.472-16,46.944-16
                                                            c23.472,0,23.472,16,46.943,16c23.472,0,23.472-16,46.945-16c23.471,0,23.471,16,46.942,16s23.472-16,46.943-16
                                                            c23.473,0,23.473,16,46.945,16c23.472,0,23.472-16,46.944-16c23.475,0,23.475,16,46.95,16s24.35-18.213,47.717-15.963
                                                            c2.25,0.217-8.767,10.224-8.767,12.483c0,2.262,16,2.262,16,4.524c0,2.261-16,2.261-16,4.521c0,2.262,16,2.262,16,4.524
                                                            c0,2.263-16,2.263-16,4.526s16,2.263,16,4.525s-16,2.263-16,4.526c0,2.262,16,2.262,16,4.524s-16,2.263-16,4.525
                                                            c0,2.265,16,2.265,16,4.529c0,2.267-16.274,3.719-15.874,5.949C564.609,68.09,574.358,72.566,572.103,72.784z"/></svg>
                                                          </div>
                                                        </div>
                                                        <div class="pricing-body bg-white bg-dark-green">
                                                        <ul class="pricing-list text-center text-white margin-bottom-0 h-7">
                                                          Rydlr Premier Account
                                                          <h4> Ad Space </h4>
                                                            <li>Video or Display (Image) Ads</li>
                                                            <li> Custom view range </li>
                                                            <br>
                                                          <h4> Features </h4>
                                                          <li>Custom Locations</li>
                                                          <li>Origination/Destination Targeting </li>
                                                          <li> Geo Targeting </li>
                                                          <li> TripIntent Targeting </li>
                                                        </ul>
                                                        </div>
                                                        <div class="pricing-footer text-center text-dark bg-dark-green">
                                                        <button class="btn btn-md btn-mw-150 border-radius-50 margin-top-1 btn-transparent-white" type="button" data-toggle="modal" data-target="#myModal"><span class="h-7 heading-font ls-1"> Contact Us </span></button>
                                                        </div>
                                                      </div>
                                                      </div>
                                                      </div>
                                                      </div>
                                                      </div>
                                                    </div>
                              <div class="col-md-3"></div>

                            </div>
                        


                          <!-- Ending Pricing Table here -->


                        </form>
                      </div>
                      <div class="tab-pane" id="tab3">
                        <h2>
                          Registration - Step 3 Payment
                        </h2>
                        <form role="form" class="form-payment-detail">
                          <div class="form-group">
                          	<label class="control-label">Payment Type</label>
                            <label class="radio" for="option1"><input id="option1" name="payment_type" type="radio" value="manual"><span>Manual Payment to Dorsol Office</span></label>
                            <label class="radio"><input checked="" name="payment_type" type="radio" value="online"><span>Online Payment</span></label>
                          </div>
                          
                        </form>
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
<div class="modal fade left" id="myModal"> 
  <div class="modal-dialog"> 
    <div class="modal-content"> 
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">CONTACT US</h4>
      </div>
      <div class="modal-body">

      <!-- Form Section  -->

        <form class="form-horizontal" role="form" method="post" action="#"> 
          
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
              <label for="human" class="col-sm-3 control-label">
              <span class="required">*</span> Human or Bot:</label> 
              <div class="col-sm-4"> 
                <h3 class="human">Six + 6 = ?</h3> 
                <input type="number" class="form-control" id="human" name="human" placeholder="Enter sum in digits"> 
              </div> 
            </div> 
            <div class="form-group"> 
              <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3"> 
                <button type="button" id="submit" name="submit" class="btn-lg btn-primary">SUBMIT</button> 
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
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
     
     $('#start_select').on('click', function() {
        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Starter Plan - 12000 SH');
     }); 
     $('#basic_select').on('click', function() {
        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Basic Plan  - 21000 SH');
     }); 
     $('#advance_select').on('click', function() {
        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Advanced Plan - 42000 SH');
     }); 
     $('#professional_select').on('click', function() { 
        $('#membership_plan').val('');
        var tst = $('#membership_plan').val('Professional Plan - 51000 SH');
     }); 

  </script>
  <script type="text/javascript">
  $(document).ready(function(){

    var b1 = document.getElementById("start_select");
    var b2 = document.getElementById("basic_select");
    var b3 = document.getElementById("advance_select");
    var b4 = document.getElementById("professional_select");

    b1.onclick = function() {
         b1.style.background = "goldenrod";
         b2.style.background = "";  
         b3.style.background = "";  
         b4.style.background = "";   
    }

    b2.onclick = function() {
         b1.style.background = "";
         b2.style.background = "goldenrod";  
         b3.style.background = "";  
         b4.style.background = "";   
    }

    b3.onclick = function() {
         b1.style.background = "";
         b2.style.background = "";  
         b3.style.background = "goldenrod";  
         b4.style.background = "";   
    }
    b4.onclick = function() {
         b1.style.background = "";
         b2.style.background = "";  
         b3.style.background = "";  
         b4.style.background = "goldenrod";      
    }

  });
    
  </script>