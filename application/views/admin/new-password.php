<!DOCTYPE html>
<html>
  <head>
    <title>
      Dorsal Media - Admin Forgot Password
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
          <a href="<?php echo base_url();?>media_admin/admin_login"> Change Password </a>
        </h1>
        <form class="form_change_password" method="post" action="#" autocomplete="off">
          <div class="form-group">
          <?php $session = $_SESSION['admin_login']; $username = $session['username']; ?>
            <input class="form-control" placeholder="Enter new password" name="password" id="password" type="password">
            <input type="hidden" name="username" value="<?php echo $username; ?>">
          </div>
          <br><br>
        </form>
        <div class="social-login clearfix">
          <a class="btn btn-primary" href="<?php echo base_url(); ?>media_admin/view_admin_login"> Cancel </a>
          <a class="btn btn-primary btn_change_password" href="#"> Submit </a>
        </div>
        <p></p>
      </div>
    </div>
    <!-- End Login Screen -->
  </body>



  <script type="text/javascript">
    $('.btn_change_password').on('click', function(){

      $('span.error-box').remove();
      var password = $('form.form_change_password').find('input[name="password"]'); 
      var username = $('form.form_change_password').find('input[name="username"]');  
      var check_valid = 0; 
      if(password.val() == ""){
        password.parents('div.form-group').addClass('has-error');
        $(get_error_msg(password_err)).insertAfter(password);     
        check_valid = 1;
      } else {     
          $('span.error-box').remove();
            $.ajax({
                  type: "POST",       
                  url: base_url+"media_admin/change_new_password/",
                  data:{              
                    password : password.val(),
                    username : username.val()
                  },
                  dataType:"json",            
                  success : function(data) {                       
                  if(data.status == 1) {
                      window.location = base_url+'media_admin/home';
                  } else {
                      window.location = base_url+'media_admin/admin_login';
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