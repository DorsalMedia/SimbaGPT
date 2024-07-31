<?php

?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

	<title> Rydlr </title>
	<!-- Fevicon -->
	<!-- Start Header Css Import -->

    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/hightop-font.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/isotope.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/fullcalendar.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/wizard.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/select2.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/morris.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/datepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/timepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/colorpicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/bootstrap-switch.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/bootstrap-editable.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/daterange-picker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/typeahead.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/summernote.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/ladda-themeless.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/social-buttons.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/jquery.fileupload-ui.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/dropzone.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/nestable.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/pygments.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/custom.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/stylesheets/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/pricing/fonts/icon-fonts.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/pricing/css/solid-pricing.css" type="text/css">

    <style type="text/css">
    /*.loader {
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
      }*/
        .content {
              padding: 20px;
              min-height: 100%;
              margin: 0 auto -50px;
            }
            .footer,
            .push {                
                height: 50px;
            }
            .change_text {
                position: absolute;
                padding-top: 10px;
              }
              .change_texts {
                position: absolute;
                padding-top: 10px;
              }
              .heading {
                  background: rgba(255, 255, 255, 0.94);
                  color: #3BB9FF !important;
                  font-size: 14px;
                  width: 100%;
                  font-weight: 400;
                  margin: 0;
              }
    .dataTable th {
    color: #007aff;
    cursor: pointer;
    position: relative;
}
    </style>
   
	<script src="<?php echo base_url();?>assets/javascripts/sweetalert2.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/javascripts/canvasjs.min.js" type="text/javascript"></script>

    <script type="text/javascript">
      var base_url = '<?php echo base_url(); ?>';
    </script>

  
    </head>
   
