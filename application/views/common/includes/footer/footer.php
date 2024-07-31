<?php 
//require_once('functions.php');
 $ci =& get_instance(); 
?>

 <!-- <div class="row">
  <br>
    <div class="col-md-3">
    </div>
    <div class="col-md-7">
    <p style="text-align: center;">
      Disclaimer :- By signing in, you are agreeing to the Rydlr<a href="<?php echo base_url();?>files/docs/advertiser_terms.html.pdf"> Terms of Service</a>,<a href="<?php echo base_url();?>files/docs/eula.html.pdf" > End User License Agreement</a> and <a href="<?php echo base_url();?>files/docs/privacy.html.pdf"> Privacy Policy </a>
    </p>
    </div>
    <div class="col-md-2">
    </div>
  </div>  -->
 

<?php

              if(isset($_SESSION['admin_login']))
             {
                  //$this->load->view('common/home');
                  ?>
                  <!-- changes done for Rydlr 15_12_2017 comments (1) document-->
                  <div class="footer_holder"> <div class="row">

                  <div class="col-md-4">
                    <p style="text-align: center;">
                          <a href="<?php echo base_url();?>files/docs/advertiser_terms.html.pdf">Rydlr Terms of Service</a>
                    </p>
                  </div>
                  <div class="col-md-4">
                  <center><p style="text-align: center;">
                        <a href="<?php echo base_url();?>files/docs/eula.html.pdf" > End User License Agreement</a> 
                  </p></center>
                   </div>
                  <div class="col-md-4">
                  <p style="text-align: center;">
                  <a href="<?php echo base_url();?>files/docs/privacy.html.pdf"> Privacy Policy </a>
                  </p>
                  </div>

                  </div>
                </div>
                  <?php

            } 
              else if(isset($_SESSION['rydlr_admin_login'])){ 
          //if($this->session->userdata('rydlr_admin_login')){
           //$this->load->view('common/home');
            ?>
            <!-- changes done for Rydlr 15_12_2017 comments (1) document-->
                  <div class="footer_holder"><div class="row">
                  <div class="row">

                  <div class="col-md-4">
                    <p style="text-align: center;">
                          <a href="<?php echo base_url();?>files/docs/advertiser_terms.html.pdf">Rydlr Terms of Service</a>
                    </p>
                  </div>
                  <div class="col-md-4">
                  <center><p style="text-align: center;">
                        <a href="<?php echo base_url();?>files/docs/eula.html.pdf" > End User License Agreement</a> 
                  </p></center>
                   </div>
                  <div class="col-md-4">
                  <p style="text-align: center;">
                  <a href="<?php echo base_url();?>files/docs/privacy.html.pdf"> Privacy Policy </a>
                  </p>
                  </div>

                  </div>
                </div>
                  <?php
        } else if(isset($_SESSION['enterprise_account'])){
            //$this->load->view('common/home');
            ?>
            <!-- changes done for Rydlr 15_12_2017 comments (1) document-->
                  <div class="footer_holder"> <div class="row">
                   <div class="row">

                  <div class="col-md-4">
                    <p style="text-align: center;">
                          <a href="<?php echo base_url();?>files/docs/advertiser_terms.html.pdf">Rydlr Terms of Service</a>
                    </p>
                  </div>
                  <div class="col-md-4">
                  <center><p style="text-align: center;">
                        <a href="<?php echo base_url();?>files/docs/eula.html.pdf" > End User License Agreement</a> 
                  </p></center>
                   </div>
                  <div class="col-md-4">
                  <p style="text-align: center;">
                  <a href="<?php echo base_url();?>files/docs/privacy.html.pdf"> Privacy Policy </a>
                  </p>
                  </div>

                  </div>
                </div>
                  <?php
        }
        else 
        {
            //redirect('common_admin/view_admin_login'); 
            ?>
            <style>
              a{
                color:white;
              }
              a:hover { 
                          
                          color: blue;
                      }
            </style>
            <div class="row">

              <div class="col-md-12">
                  <!-- <div class="widget-container fluid-height clearfix"> -->

                    <footer class="footer">
                      <div class="col-md-3"></div>
                      <div class="col-md-6"> <br>
                      <center><p style="text-align: center; color: white;">
                Disclaimer :By signing in, you are agreeing to the <a href="<?php echo base_url();?>files/docs/advertiser_terms.html.pdf"> Rydlr Terms of Service</a>,<a href="<?php echo base_url();?>files/docs/eula.html.pdf" > End User License Agreement</a> and <a href="<?php echo base_url();?>files/docs/privacy.html.pdf"> Privacy Policy </a>
                    </p></center>  
                      </div>
                      <div class="col-md-3"> </div>
                    </footer>

                  <!-- </div> -->
              </div>       
            </div>
         <?php
          } 
         ?>
	<div class="style-selector">
      <div class="style-selector-container">
        <h2>
          Layout Style
        </h2>
        <select name="layout"><option value="fluid">Fluid</option><option value="boxed">Boxed</option></select>
        <h2>
          Navigation Style
        </h2>
        <select name="nav" class="selected_id" id="selected_id">          
          <!--<option id="top_side_menu" value="top" > Top </option>-->
          <option id="left_side_menu"  value="left" selected> Left </option> 
         </select>
         <!-- <?php date_default_timezone_set("asia/kolkata"); ?>
         <?php echo date("Y-m-d h:i:s"); ?> -->
        <h2>
          Color Options
        </h2>
        <ul class="color-options clearfix">
          <li>
            <a class="blue" href="javascript:chooseStyle('none', 30)"></a>
          </li>
          <li>
            <a class="green" href="javascript:chooseStyle('green-theme', 30)"></a>
          </li>
          <li>
            <a class="orange" href="javascript:chooseStyle('orange-theme', 30)"></a>
          </li>
          <li>
            <a class="magenta" href="javascript:chooseStyle('magenta-theme', 30)"></a>
          </li>
          <li>
            <a class="gray" href="javascript:chooseStyle('gray-theme', 30)"></a>
          </li>
        </ul>
        <h2>
          Background Patterns
        </h2>
        <ul class="pattern-options clearfix">
          <li>
            <a class="active" href="#" id="bg-1"></a>
          </li>
          <li>
            <a href="#" id="bg-2"></a>
          </li>
          <li>
            <a href="#" id="bg-3"></a>
          </li>
          <li>
            <a href="#" id="bg-4"></a>
          </li>
          <li>
            <a href="#" id="bg-5"></a>
          </li>
        </ul>
        <div class="style-toggle closed">
          <span aria-hidden="true" class="hightop-gear"></span>
        </div>
      </div>
    </div>


				<!-- footer content -->
				<footer>
					<!--<div class="pull-right">
						Myfixer - Admin
					</div>
					<div class="clearfix">
					</div>-->
				</footer>
				<!-- /footer content -->

				<?php echo get_scripts();?>
        <script src="<?php echo base_url();?>assets/javascripts/jquery.cookie.js"></script>

        <script type="text/javascript">

          $(document).ready(function() {
            if($(window).width() > 768){
              // var top = $('#top_side_menu').val();                
              var hash = $.cookie("exptab");
              if(hash == 1){
                $('#selected_id').val('top').trigger('change');
              } else if(hash == 2){
                $('#selected_id').val('left').trigger('change');
              } else {
                $('#selected_id').val('top').trigger('change');
              }

              // var change_color =  $.cookie("color_cok");
              // if(change_color == 'blue'){
              //   $('.blue').trigger('click'); 
              // } else if(change_color == 'green'){
              //   $('.green').trigger('click'); 
              // } else if(change_color == 'orange'){
              //   $('.orange').trigger('click'); 
              // } else if(change_color == 'magenta'){
              //   $('.magenta').trigger('click'); 
              // } else if(change_color == 'gray'){
              //   $('.gray').trigger('click'); 
              // } else {
              //   $('.blue').trigger('click'); 
              // }
              // console.log(change_color);
              $('#selected_id').on('click', function(){
                  if($('#selected_id').val() == 'top'){
                    var hash = $.cookie("exptab", 1);
                    if(exptab=1){
                        //alert(exptab);
                        //alert('session generated');
                    }else{
                        //alert('session not generated');
                    }  
                  } else if($('#selected_id').val() == 'left'){
                    var hash = $.cookie("exptab", 2);
                    if(exptab=2){
                        //alert(exptab);
                        //alert('session generated');
                    }else{
                        //alert('session not generated');
                    }
                  }
                  
              });

            $('.blue').on('click', function(){
                var hash = $.cookie("color_cok", 'blue');
            });  

            $('.green').on('click', function(){
                var hash = $.cookie("color_cok", 'green');
            });  

            $('.orange').on('click', function(){
                var hash = $.cookie("color_cok", 'orange');
            });  

            $('.magenta').on('click', function(){
                var hash = $.cookie("color_cok", 'magenta');
            });  

            $('.gray').on('click', function(){
                var hash = $.cookie("color_cok", 'gray');
            });  

            $('.red').on('click', function(){
                var hash = $.cookie("color_cok", 'red');
            });  
          }  

          

        });

                   
        </script>

			</div>
		</div>

	</body>

<script type="text/javascript">

  /* for tooltip */
  $('[data-toggle="tooltip"]').tooltip();

  /* for preloader */
    $(".preload").fadeOut(10);
    //$('.loader').show();
</script>
</html>
