<!DOCTYPE html>
<html>
  <head>
    <!--Dorsal Media - Admin Login-->
    <title>
      Rydlr - Admin Login
    </title>
    <!-- Header css start -->
    <style type="text/css">
      .loader {
          position: fixed;
          left: 50%;    
          border: 16px solid #f3f3f3;
          border-radius: 50%;
          border-top: 16px solid #3BB9FF !important;
          border-bottom: 16px solid #3BB9FF !important;
          width: 70px;
          height: 70px;
          -webkit-animation: spin 2s linear infinite;
          animation: spin 2s linear infinite;
          z-index: 100;
          display: none;
      }

      .footer {
        position: relative !important;                
        width: 100% !important;  
        color: blue !important;      
      }    

      @media(max-width:767px){
        .footer {
          position: absolute !important;                
          width: 100% !important;  
          color: blue !important;      
        } 
      }
     /*body.login1 .login-container {
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 40px;
      box-shadow: 0 0 50px rgba(0, 0, 0, 0.2);
      padding: 30px;
      margin-top: 10%;
      margin-bottom: 15px;
      width: 380px;
      height: auto;
      text-align: center;
      position: relative;
      top: 100%;
      left: 40%;
      opacity: 0;
      -webkit-transition: all 1s 0.5s;
      -moz-transition: all 1s 0.5s;
      transition: all 1s 0.5s;
    }*/

      @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    </style>

    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/stylesheets/hightop-font.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
    <!-- Header css end -->

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

    <!-- Footer Script Start -->


   <script src="<?php echo base_url(); ?>assets/javascripts/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/raphael.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.mousewheel.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.vmap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.vmap.sampledata.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.bootstrap.wizard.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/fullcalendar.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/gcal.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/datatable-editable.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.easy-pie-chart.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/excanvas.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.isotope.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/custom.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/modernizr.custom.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/select2.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/styleswitcher.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/wysiwyg.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/bootstrap-fileupload.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/bootstrap-timepicker.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/bootstrap-colorpicker.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/daterange-picker.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/date.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/morris.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/skycons.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/fitvids.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/main.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/respond.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/validation_message.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/javascripts/post_get_data.js" type="text/javascript"></script>
    <script type="text/javascript">
      function get_error_msg(msg){
        return '<span class="text-danger error-box">'+msg+'</span>';
      }  
      var base_url = "<?php echo base_url() ?>";
    </script>
    
  <!-- Footer Script End -->  

  </head>
  <body class="login1">
    <!-- Login Screen -->
  <div class="row">  
    <div class="login-wrapper">
      <div class="login-container">
         
        <div class="ladda"></div>
        <h1>
          <a href="<?php echo base_url();?>common_admin/view_admin_login"><img src="<?php echo base_url();?>assets/images/Rydlr_full_logo.png" style="width:70px;"></a>
        </h1>
       
        	<form class="form_admin_login" method="post" action="#" autocomplete="off">
        	<div class="loader"></div>
          	<div class="form-group">
            	<input class="form-control" placeholder="Username" id="username" name="username" type="text" >
            	<!-- onkeypress="return alpha(event)"> -->
          	</div>
          <div class="form-group">
            <input class="form-control" placeholder="Password" name="password" id="password" type="password">
            <input class="admin_login" id="admin_login" type="button" value="&#xf054;"> 
            <input type="hidden" name="access" value="<?php echo $access['status'];?>">
          </div>
          <div class="form-options clearfix">
            <a class="pull-right" href="<?php echo base_url(); ?>common_admin/view_forgot_password">Forgot Password?</a>
            <div class="text-left">
             <!-- <label class="checkbox"><input type="checkbox"><span>Remember me</span></label> -->
             <a class="pull-left" href="<?php echo base_url(); ?>common_admin/view_forget_username">Forgot Username?</a>
            </div> 
          </div>
        </form>
        <p class="signup">
          Don't have an account yet ? <a href="<?php echo base_url();?>common_admin/view_admin_register">Sign up now</a> 
        </p> 
        
        <?php
      
        ?>    

      </div>

    </div>
	<!-- this section chang the footer license agreements  -->
  <!--  <div class="row">
  <br>
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
    <p style="color: white;text-align: center">
      Disclaimer :- By signing in, you are agreeing to the Rydlr Terms of Service,<br>
      <a href="<?php echo base_url();?>files/docs/eula.html.pdf" > End User License Agreement</a> and <a href="<?php echo base_url();?>files/docs/privacy.html.pdf"> Privacy Policy. </a>
    </p>
    </div>
    <div class="col-md-2">
    </div>
  </div>  -->

  <div class="row">

    <div class="col-md-12">
        <!-- <div class="widget-container fluid-height clearfix"> -->

          <footer class="footer">
            
            <div class="col-md-3"></div>
            <div class="col-md-6"> <br>

            <center>
            <style>
              #s{
                color:white;
              }
              #s:hover { 
                          
                          color: blue;
                      }
            </style>
             <p style="color: white;text-align: center">
      Disclaimer : By signing in, you are agreeing to the <a id="s" href="<?php echo base_url();?>files/docs/advertiser_terms.html.pdf">Rydlr Terms of Service</a>,
      <a id="s" href="<?php echo base_url();?>files/docs/eula.html.pdf" > End User License Agreement</a> and <a id="s" href="<?php echo base_url();?>files/docs/privacy.html.pdf"> Privacy Policy. </a>
    </p>
             <!-- <a href="<?php echo base_url();?>files/docs/advertiser_terms.html.pdf" class="design_footer" style="color: !important;">  Terms of service</a>-->
              &nbsp; &nbsp; &nbsp; &nbsp; 
              <!--<a href="<?php echo base_url();?>files/docs/Rydlr_Beta_Test_Agreemnet.pdf" class="design_footer" style="color:  !important;"> Beta Test Agreement. </a>-->
            </center>  
            </div>
            <div class="col-md-3"> 
            </div>
          </footer>
        <!-- </div> -->
    </div>       
  </div>

<!--    <footer class="footer">
            <center>
              <a href="<?php echo base_url();?>files/docs/SUBSCRIPTION_AGREEMENT_AND_FREE_TRIAL_TERMS.pdf" style="color: white !important;"> Terms and Privacy Policy </a>
              &nbsp; &nbsp; &nbsp; &nbsp; 
              <a href="<?php echo base_url();?>files/docs/Rydlr_Beta_Test_Agreemnet.pdf" style="color: white !important;"> Beta Test Agreement. </a>
            </center>  
            
    </footer>  -->

  </div>      


    <!-- End Login Screen -->
  </body>

  <script type="text/javascript">
    $(document).bind('keypress', function(e) {
            if(e.keyCode==13){
                 $('#admin_login').trigger('click');
             }
    });

    $('.admin_login').on('click', function(){

      $('span.error-box').remove();
      var username = $('form.form_admin_login').find('input[name="username"]');   
      var password = $('form.form_admin_login').find('input[name="password"]');
      

      var check_valid = 0; 
      if(username.val() == '' || password.val()==''){
          if(username.val() == ''){
            username.parents('div.form-group').addClass('has-error');
            $(get_error_msg(username_err)).insertAfter(username);
            check_valid = 1;
          }
          if(password.val() == ''){
            password.parents('div.form-group').addClass('has-error');
            $(get_error_msg(password_err)).insertAfter(password);
            check_valid = 1;
          }
          

        } 
        else {     
          $('span.error-box').remove();
          $('.loader').show();
            $.ajax({
                  type: "POST",       
                  url: base_url+"common_admin/login_admin/",
                  data:{              
                    username:username.val(),
                    password:password.val()
                  },            	  
                  dataType:"json",            
                  success : function(data) {
                   $('.loader').hide(); 
                   if(data.status == 'new_password'){
                      window.location = base_url+"common_admin/view_new_password";
                   } else if(data.status == 1) {
                      window.location = base_url+"common_admin/home";
                   } else if(data.status == 'admin_data'){
                      window.location = base_url+"common_admin/home";
                   } else if(data.status == 'enterprise_account') {
                      window.location = base_url+"common_admin/home";
                   } 
                   else {
                      password.parents('div.form-group').addClass('has-error');
                      $(get_error_msg(invalid_login_credential)).insertAfter(password);
                      check_valid = 1;
                   }           
                 }
            });    
          }
          if(check_valid == 1){
            return false;
          } 
  });



  </script>
</html>