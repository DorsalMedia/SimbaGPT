

<!--

summary : payment success redirected page. this is not in use

-->

<?php
require_once('functions.php');
?> 

<?php echo get_header(); ?>
</div>
    <div class="container main-content">
      <div class="page-title"></div>
    		<div class="row">
    		  <div class="col-lg-12">
    		    <div class="widget-container fluid-height clearfix">
    		      <div class="heading">

              </div>
          </div>
        </div>
      </div>
    </div>        

<?php echo get_footer(); ?>
<script type="text/javascript">
          swal({ 
                title: "Congratulation!",
                text: "Your Rydlr account activation link has been sent to your email",
                type: "success",
                allowOutsideClick: false 
                },
                function(){
                    alert('ok');
                }); 
                $('.swal2-confirm').click(function(){
                  window.location.href = base_url+'common_admin/view_admin_profile';
          });
</script>    


