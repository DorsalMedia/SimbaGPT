
<!--

Summary :- after registration paypal payment redirect to this success page

-->

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

  .design_footer {
    color: white !important;
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
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-container fluid-height">

        </div>
      </div>
    </div>
</div>          

<?php echo get_footer(); ?>
<script type="text/javascript">
          swal({ 
                title: "Congratulation!",
                text: "Your Rydlr account activation link has been sent to your email",
                type: "success" 
                },
                function(){
                    alert('ok');
                }); 
                $('.swal2-confirm').click(function(){
                      window.location.href = base_url+'common_admin/view_admin_login';
          });
</script>
