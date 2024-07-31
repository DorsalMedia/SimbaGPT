<?php

 $ci =& get_instance(); 
 if($ci->session->userdata('admin_login')){
    $user_id = $_SESSION['admin_login']['admin_id'];
    $ci =& get_instance();
    $ci->db->select('*');
    $ci->db->from('users');
    $ci->db->where('id',$user_id);
    $ci->db->where('payment_status','unpaid');
    $query = $ci->db->get();
    
    if($query->num_rows() > 0){ ?>        
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav target-active">            
              <li class="home">
                <a class="" href="<?php echo base_url(); ?>common_admin/home"><span aria-hidden="true" class="hightop-home"></span>Dashboard</a>
              </li>
              <li class="profile">
                <a href="<?php echo base_url(); ?>common_admin/view_admin_profile"><span aria-hidden="true" class="glyphicon glyphicon-user"></span>Profile</a>
              </li>
            </ul>
          </div>
        </div>
    <?php } else { ?>

  <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav target-active">
            
              <li class="home">
                <a class="" href="<?php echo base_url(); ?>common_admin/home"><span aria-hidden="true" class="hightop-home"></span>Dashboard</a>
              </li>
              
              <li class="campaigns">
                <a href="<?php echo base_url();?>common_admin/view_admin_campaigns"><span aria-hidden="true" class="hightop-charts"></span> Campaigns </a>
              </li>
              
              <li class="ads">
              <a href="<?php echo base_url();?>common_admin/view_admin_advertisment"><span aria-hidden="true" class="fa fa-fw fa-bullhorn"></span>Ads</a>
              </li>
              
              <li class="analytics">
              <a href="<?php echo base_url();?>common_admin/view_admin_report"><span aria-hidden="true" class="fa fa-file"></span>Analytics </a>
              </li>
              
              <!-- contract=Subscription changes and make submenu of profile done for Rydlr 15_12_2017 comments (1) document-->
             <!-- <li class="payment">
              <a href="<?php echo base_url();?>common_admin/view_admin_payment"><span aria-hidden="true" class="glyphicon glyphicon-usd"></span>Payment</a>
              </li>-->
              <!-- contract=Subscription changes done for Rydlr 15_12_2017 comments (1) document-->
              <!--<li class="contract">
              <a href="<?php echo base_url();?>common_admin/view_admin_contract"><span aria-hidden="true" class="fa fa-fw fa-edit"></span> Subscription </a>
              </li>-->
              
              <li class="dropdown">
                <a data-toggle="dropdown"><!--<span aria-hidden="true" class="glyphicon glyphicon-user">--><i class="fa fa-user" style="font-size: 28px;vertical-align: middle;margin-right: 16px;"></i></span>My Account<i class="fa fa-chevron-down down_arrow"></i></a>
                 <!-- make submenu of profile changes done for Rydlr 15_12_2017 comments (1) document-->
                <ul class="dropdown-menu">
                
                <li class="profile">
                <a href="<?php echo base_url(); ?>common_admin/view_admin_profile"><span aria-hidden="true" class="glyphicon glyphicon-user submenu_icon"></span>Profile</a>
              </li>
             
              <li class="contract">
              <a href="<?php echo base_url();?>common_admin/view_admin_contract"><span aria-hidden="true" class="fa fa-fw fa-edit submenu_icon" style="font-size: 16px;margin-right: 6px;"></span>Subscription</a>
              </li>

                  <li class="payment">
              <a href="<?php echo base_url();?>common_admin/view_admin_payment"><span aria-hidden="true" class="glyphicon glyphicon-usd submenu_icon"></span>Payment</a>
              </li>
         
                </ul>



              </li>
              
              
            <!--  <li><a href="gallery.html">
                <span aria-hidden="true" class="hightop-gallery"></span>Gallery</a>
              </li> -->
            </ul>
          </div>
    </div>
	<?php  }
 	}  if($ci->session->userdata('enterprise_account')){ ?>

  <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav target-active">
            
              <li class="home">
                <a class="" href="<?php echo base_url(); ?>common_admin/home"><span aria-hidden="true" class="hightop-home"></span>Dashboard</a>
              </li>
              
              <li class="campaigns">
                <a href="<?php echo base_url();?>common_admin/view_admin_campaigns"><span aria-hidden="true" class="hightop-charts"></span> Campaigns </a>
              </li>
              
              <li class="ads">
              <a href="<?php echo base_url();?>common_admin/view_admin_advertisment"><span aria-hidden="true" class="fa fa-fw fa-bullhorn"></span>Ads</a>
              </li>
              
              <li class="analytics">
              <a href="<?php echo base_url();?>common_admin/view_admin_report"><span aria-hidden="true" class="fa fa-file"></span>Analytics </a>
              </li>

              <!-- contract=Subscription changes and make submenu of profile done for Rydlr 15_12_2017 comments (1) document-->
              
             <!-- <li class="payment">
              <a href="<?php echo base_url();?>common_admin/view_admin_payment"><span aria-hidden="true" class="glyphicon glyphicon-usd"></span>Payment</a>
              </li>
              
              <li class="contract">
              <a href="<?php echo base_url();?>common_admin/view_admin_contract"><span aria-hidden="true" class="fa fa-fw fa-edit"></span> Subscription </a>
              </li>-->
              
              <li class="dropdown">
                <a data-toggle="dropdown"><!--<span aria-hidden="true" class="glyphicon glyphicon-user"></span>--><i class="fa fa-user" style="font-size: 28px;vertical-align: middle;margin-right: 16px;"></i>My Account <i class="fa fa-chevron-down down_arrow"></i></a>
                 <!-- make submenu of profile changes done for Rydlr 15_12_2017 comments (1) document-->
                <ul class="dropdown-menu">
                 <li class="profile">
                <a href="<?php echo base_url(); ?>common_admin/view_admin_profile"><span aria-hidden="true" class="glyphicon glyphicon-user submenu_icon"></span>Profile</a>
              </li>
              
             
              <li class="contract">
              <a href="<?php echo base_url();?>common_admin/view_admin_contract"><span aria-hidden="true" class="fa fa-fw fa-edit submenu_icon" style="font-size: 16px;margin-right: 6px;"></span>Subscription </a>
              </li>
        
                  <li class="payment">
              <a href="<?php echo base_url();?>common_admin/view_admin_payment"><span aria-hidden="true" class="glyphicon glyphicon-usd submenu_icon"></span>Payment</a>
              </li>
                </ul>
              </li>
              
              
            <!--  <li><a href="gallery.html">
                <span aria-hidden="true" class="hightop-gallery"></span>Gallery</a>
              </li> -->
            </ul>
          </div>
    </div>


 <?php } ?>

<?php
  if($ci->session->userdata('rydlr_admin_login')){ ?>
      <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav target-active">            
              <li class="home">
                <a class="" href="<?php echo base_url(); ?>common_admin/home"><span aria-hidden="true" class="hightop-home"></span>Dashboard</a>
              </li>
              <li class="ads">
                <a href="<?php echo base_url();?>common_admin/view_admin_advertisment"><span aria-hidden="true" class="fa fa-fw fa-bullhorn"></span>Ads</a>
              </li>
              <li class="payment">
                <a href="<?php echo base_url();?>common_admin/view_admin_payment"><span aria-hidden="true" class="glyphicon glyphicon-usd"></span>Payment</a>
              </li>
              <!-- contract=Subscription changes done for Rydlr 15_12_2017 comments (1) document-->
              <li class="contract">
                <a href="<?php echo base_url();?>common_admin/view_admin_contract"><span aria-hidden="true" class="fa fa-fw fa-edit"></span> Subscription </a>
              </li>
            </ul>
          </div>
        </div>
<?php }
 

?>