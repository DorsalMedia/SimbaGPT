<?php

?>
<!-- top navigation -->

	<div class="container-fluid top-bar">
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
            <!--  <li class="dropdown notifications hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="hightop-flag"></span>
                  <div class="sr-only">
                    Notifications
                  </div>
                  <p class="counter">
                    4
                  </p>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      New user added: Jane Smith
                    </p></a>
                    
                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      Sales targets available
                    </p></a>
                    
                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      New performance metric added
                    </p></a>
                    
                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      New growth data available
                    </p></a>
                    
                  </li>
                </ul>
              </li>
              <li class="dropdown messages hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="hightop-envelope"></span>
                  <div class="sr-only">
                    Messages
                  </div>
                  <p class="counter">
                    3
                  </p>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <img width="34" height="34" src="<?php echo base_url(); ?>assets/images/avatar-male2.png" />Could we meet today? I wanted...</a>
                  </li>
                  <li><a href="#">
                    <img width="34" height="34" src="<?php echo base_url(); ?>assets/images/avatar-female.png" />Important data needs your analysis...</a>
                  </li>
                  <li><a href="#">
                    <img width="34" height="34" src="<?php echo base_url(); ?>assets/images/avatar-male2.png" />Buy Se7en today, it's a great theme...</a>
                  </li>
                </ul> -->
              </li>
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <?php

                $ci =& get_instance();
                $session = $_SESSION['rydlr_admin_login']; 
                $user_id = $session['admin_id'];
                $class = $ci->db->query("SELECT * FROM users WHERE id='".$user_id."'");
                $class = $class->result_array();
                 foreach($class as $row){
                    ?>
                <img width="34" height="34" src="<?php
                 if($row['client_logo']!="") {
                  echo base_url($row['client_logo']); 
                  } else
                   { echo base_url('assets/images/avatar-male.jpg'); } ?>" /> <?php $session = $_SESSION['rydlr_admin_login']; $username = $session['admin_username']; $user_id = $session['admin_id']; echo ''.$username. ''; ?> <b class="caret"></b></a>
              <?php } ?>

                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url();?>media_admin/view_admin_profile">
                    <i class="fa fa-user"></i>My Account</a>
                  </li>
                  <!-- <li><a href="#">
                    <i class="fa fa-gear"></i>Account Settings</a>
                  </li> -->
                  <li><a href="<?php echo base_url();?>media_admin/logout">
                    <i class="fa fa-sign-out"></i>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" href="<?php echo base_url();?>media_admin/home"><img src="<?php echo base_url();?>assets/images/logo.png" style="width:40%"></a>
	        <form class="navbar-form form-inline col-lg-2 hidden-xs">
	        <input class="form-control" placeholder="Search" type="text">
	        </form>
	</div>


<!-- /top navigation -->