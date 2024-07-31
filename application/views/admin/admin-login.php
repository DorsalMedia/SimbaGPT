<!DOCTYPE html>
<html>
  <head>
    <title>
      Dorsal Media - Admin Login
    </title>
    <!-- Header css start -->

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
    <div class="login-wrapper">
      <div class="login-container">
        <div class="ladda"></div>
        <h1>
          <a href="<?php echo base_url();?>media_admin/view_admin_login"><img src="<?php echo base_url();?>assets/images/logo.png" style="width:60%"></a>
        </h1>
        <form class="form_admin_login" method="post" action="#" autocomplete="off">
          <div class="form-group">
            <input class="form-control" placeholder="Username" id="username" name="username" type="text" onkeypress="return alpha(event)">
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Password" name="password" id="password" type="password">
            <input class="admin_login" id="admin_login" type="button" value="&#xf054;"> 
          </div>
          <div class="form-options clearfix">
            <a class="pull-right" href="<?php echo base_url(); ?>media_admin/view_forgot_password">Forgot Password?</a>
            <div class="text-left">
             <!-- <label class="checkbox"><input type="checkbox"><span>Remember me</span></label> -->
             <a class="pull-left" href="<?php echo base_url(); ?>media_admin/view_forget_username">Forgot Username?</a>
            </div> 
          </div>
        </form>
       <!-- <div class="social-login clearfix">
          <a class="btn btn-primary pull-left facebook" href="index-2.html"><i class="fa fa-facebook"></i>Facebook login</a><a class="btn btn-primary pull-right twitter" href="index-2.html"><i class="fa fa-twitter"></i>Twitter login</a>
        </div> -->
        <p class="signup">
          Don't have an account yet ? <a href="<?php echo base_url();?>media_admin/view_admin_register">Sign up now</a>
        </p>
      </div>
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
          }if(password.val() == ''){
            password.parents('div.form-group').addClass('has-error');
            $(get_error_msg(password_err)).insertAfter(password);
            check_valid = 1;
          }
        } 
        else {     
          $('span.error-box').remove();
            $.ajax({
                  type: "POST",       
                  url: base_url+"media_admin/login_admin/",
                  data:{              
                    username:username.val(),
                    password:password.val()
                  },
                  dataType:"json",            
                  success : function(data) { 
                   if(data.status == 'new_password'){
                      window.location = base_url+"media_admin/view_new_password";
                   } else if(data.status == 1) {
                      window.location = base_url+"media_admin/home";
                   } else if(data.status == 'admin_data'){
                      window.location = base_url+"admin/admin_home";
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