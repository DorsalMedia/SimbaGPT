<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Common_admin extends CI_Controller {

    function __construct() {
        parent::__construct();
    } 

    function CallAPI($method, $url, $data = false){
        $curl = curl_init();
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // Optional Authentication:

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "Beauty_Percent:Beauty@1006");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);   
        return $result;
    }    
        
    public function index(){ 
        $data_array = array('access_work_name' => 'rydlrweb');   

        $url = "http://199.250.208.147/~thegcc5/demo/accessproducts/accessproducts/get_access";
        $method = "POST";

        $make_call = $this->callAPI($method, $url, $data_array);

        $data_value['access'] = json_decode($make_call, true);  


        $this->load->view('common/admin-login',$data_value);
    }    

    public function makeProductpayment($id, $product_name, $price) {
        //try 
        //$product_names = urldecode($product_name);
        //$email = $this->Media_admin_model->getuserDetails($id);

        //if (!empty($email->email)) {
            // $config['business'] = $email->email    
            $product_names = urldecode($product_name);
            $config['business'] = "test306user@gmail.com";
            $config['cpp_header_image'] = ''; //Image header url [750 pixels wide by 90 pixels high]
            $config['return'] = base_url().'Common_admin/success_product_payment/'.$id .'/'.$product_name.'/'.$price;
            $config['cancel_return'] = base_url() . 'common_admin/cancel_product_payment/' . $id;
            //$config['return'] = base_url() . 'aio/' . $email->eoffice_name . '/products/success';
            //$config['cancel_return'] = base_url() . 'aio/' . $email->eoffice_name . '/products/1/error';
            $config['notify_url'] = 'process_payment.php'; //IPN Post
            $config['production'] = false; //Its false by default and will use sandbox 
            $config["invoice"] = rand();//The invoice id
            
            $this->load->library('paypal',$config);
            

            $this->paypal->add(trim($product_names), $price); //First item
            $this->paypal->pay(); //Proccess the payment 

        //} else {
          //  echo "sorry no email found";
       // }
    }

    public function makeProductpayment_profile_page($id,$product_name,$price){

            $product_names = urldecode($product_name);
            $config['business'] = "test306user@gmail.com";
            $config['cpp_header_image'] = ''; //Image header url [750 pixels wide by 90 pixels high]
            //$config['return'] = base_url() . 'common_admin/view_admin_profile/' . $id . '/' . $product_name . '/' . $price;
            $config['return'] = base_url() . 'common_admin/update_profile_payment/' . $id . '/' . $product_name . '/' . $price;
            $config['cancel_return'] = base_url() . 'common_admin/cancel_profile_payment/' . $id;
            //$config['return'] = base_url() . 'aio/' . $email->eoffice_name . '/products/success';
            //$config['cancel_return'] = base_url() . 'aio/' . $email->eoffice_name . '/products/1/error';
            $config['notify_url'] = 'process_payment.php'; //IPN Post
            $config['production'] = false; //Its false by default and will use sandbox 
            $config["invoice"] = rand();//The invoice id
            
            $this->load->library('paypal',$config);
            
            $this->paypal->add(trim($product_names), $price); //First item
            $this->paypal->pay(); //Proccess the payment 

    }

    // update functionality for update profile by specific use

    public function update_profile_payment($id, $product_name, $price){
        // user id for getting contract associated with user
        $user_id = $_SESSION['admin_login']['admin_id'];


        $membership_plan_name = '';
        $membership_plan_value = '';
        if($product_name == 'start_plan'){
            $membership_plan_name .= "Starter Plan";
            $membership_plan_value .= $price;
        } else if($product_name == 'basic_plan'){
            $membership_plan_name .= "Basic Plan";
            $membership_plan_value .= $price;
        } else if($product_name == 'advance_plan'){
            $membership_plan_name .= "Advanced Plan";
            $membership_plan_value .= $price;
        } else if($product_name == 'professional_plan'){
            $membership_plan_name .= "Professional Plan";
            $membership_plan_value .= $price;
        }

        $membership_data = array(
            'plan_name' => $membership_plan_name,
            'plan_value' => $membership_plan_value
        );
        
        $insert_membership = $this->db->insert('membership',$membership_data);
        $insert_membership_id = $this->db->insert_id();

        $this->db->select('*');
        $this->db->from('contract');
        $this->db->where('user_id',$user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        $query_result = $query->result_array();
        foreach($query_result as $get_contract_name){
            $contract_name = $get_contract_name['contract_title'];
        }

        // add new contract record
        $todays_date = date('Y-m-d');

        $date = strtotime('+1 months');

        $calculate_month = date('Y-m-d', $date);
        $data= array(
            'contract_title'=> $contract_name,
            'start_date' => $todays_date,
            'end_date' => $calculate_month,
            'membership_id' => $insert_membership_id,
            'user_id' => $user_id
        );        
        $insert_contract = $this->db->insert('contract',$data);
        $inserted_contract_id = $this->db->insert_id();

        $data_payment = array(
            'contract_id' => $inserted_contract_id,
            'payment_type' => 'online',
            'manual_payment_status' => 'y'
        );
        $insert_payment_status = $this->db->insert('payment',$data_payment);

        $this->db->set('payment_status','paid');
        $this->db->where('id',$user_id);
        $this->db->update('users');

        $this->load->view('common/success_payment_profile');
    }

    public function cancel_profile_payment($id){
        redirect('common_admin/view_admin_profile');
    }

    // load view after payment done in registration step it will redirecting to success payment page.......

    public function success_product_payment($id,$product_name,$price){
        $user_id = $this->session->userdata('users_id');
        $this->db->set('payment_status','paid');
        $this->db->where('id',$user_id);
        $update = $this->db->update('users');

        $data = array(
            'payment_type' => 'online',
            'contract_id' => $this->session->userdata('contract_id'),
            'manual_payment_status' => 'n'
        );
        $insert_payment = $this->Media_admin_model->insertData('payment',$data);
        $session = $_SESSION['admin_login']; 
        $user_id = $session['admin_id'];

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id',$user_id);
        $query = $this->db->get();
        $query_result = $query->result_array();
        foreach ($query_result as $val) {
            $ary['username'] = $val['username'];
            $ary['email'] = $val['email'];
        }   

        $actual_link = base_url()."common_admin/activate_link/".$user_id;
        $subject = "User Registration Activation Email";
        //$message = "<h4><strong> Welcome to Rydlr </strong></h4>";
        //$message = "<h4><strong> Dear ".$ary['username']."</strong></h4>";
        //$message = "<h4><strong> Thanks for your registration </strong></h4>";
        $message = "<h4><strong> Welcome to Rydlr, </strong></h4>  <h4><strong> Dear ".$ary['username'].",</strong></h4> <h4><strong> Thanks for your registration. </strong></h4> Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
        $emails = $ary['email'];   
        $email = array('digital@dorsalmedia.co.ke', 'test306user@gmail.com',$emails);
        $this->sendemail($email,$subject,$message);

         $this->session->unset_userdata('membershi_id');
         $this->session->unset_userdata('users_id');
         $this->session->unset_userdata('contract_id');
    	 $this->session->unset_userdata('admin_login');
        
        $this->load->view('common/admin-register-success');
    }

    // load view cancel payment of product it will redirect to registration page...

    public function cancel_product_payment($id){
        $user_id = $this->session->userdata('users_id');
        $this->db->set('payment_status','unpaid');
        $this->db->where('id',$user_id);
        $update = $this->db->update('users');
        
        $data = array(
            'payment_type' => 'online',
            'contract_id' => $this->session->userdata('contract_id'),
            'manual_payment_status' => 'n'
        );
        $insert_payment = $this->Media_admin_model->insertData('payment',$data);
        $session = $_SESSION['admin_login']; 
        $user_id = $session['admin_id'];

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id',$user_id);
        $query = $this->db->get();
        $query_result = $query->result_array();
        foreach ($query_result as $val) {
            $ary['username'] = $val['username'];
            $ary['email'] = $val['email'];
        }   

        $actual_link = base_url()."common_admin/activate_link/".$user_id;
        $subject = "User Registration Activation Email";
        //$message = "<h4><strong> Welcome to Rydlr </strong></h4>";
        //$message = "<h4><strong> Dear ".$ary['username']."</strong></h4>";
        //$message = "<h4><strong> Thanks for your registration </strong></h4>";
        $message = "<h4><strong> Welcome to Rydlr, </strong></h4>  <h4><strong> Dear ".$ary['username'].",</strong></h4> <h4><strong> Thanks for your registration. </strong></h4> Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
        $emails = $ary['email'];   
        $email = array('digital@dorsalmedia.co.ke', 'test306user@gmail.com',$emails);
        $this->sendemail($email,$subject,$message);
          
         $this->session->unset_userdata('membershi_id');
         $this->session->unset_userdata('users_id');
         $this->session->unset_userdata('contract_id');
    	 $this->session->unset_userdata('admin_login');

        redirect('common_admin/view_admin_register');
    }


    

  
    /*************************************** End Paypal Integration ************************************************/

    /*************************************** load view 404 error page loading ************************************************/
    public function error() {
        $this->load->view('common/error');
    }

    /*************************************** load view login page ************************************************/
    public function view_admin_login() {
        $user_id = $this->session->userdata('users_id');
        $contract_id = $this->session->userdata('contract_id');
        $membership_id = $this->session->userdata('membershi_id');
        if($contract_id != "") {
            $this->Media_admin_model->deleteData('contract', array('id' =>$contract_id));       
            $this->session->unset_userdata('contract_id');    
        }
        if($membership_id!=""){
            $this->Media_admin_model->deleteData('membership', array('id' =>$membership_id));       
            $this->session->unset_userdata('membershi_id');    
        }
        if($user_id != ""){
            $this->Media_admin_model->deleteData('users', array('id' =>$user_id));       
            $this->session->unset_userdata('users_id');
        }

        $data_array = array('access_work_name' => 'rydlrweb');   

        $url = "http://199.250.208.147/~thegcc5/demo/accessproducts/accessproducts/get_access";
        $method = "POST";

        $make_call = $this->callAPI($method, $url, $data_array);

        $data_value['access'] = json_decode($make_call, true);  

        $this->load->view('common/admin-login', $data_value);    
    }

    public function view_new_map() {
        $this->load->view('common/create-new-map');       
    }

    /*************************************** load view dashboard page after login ************************************************/

    public function home() {
        if($this->session->userdata('admin_login')){
           $this->load->view('common/home');
        } else if($this->session->userdata('rydlr_admin_login')){
           $this->load->view('common/home');
        } else if($this->session->userdata('enterprise_account')){
            $this->load->view('common/home');
        }
        else {
            redirect('common_admin/view_admin_login'); 
        }
    }

    /*************************************** load view dashboard page after login but this is not use in admin home ************************************************/

    public function admin_home() {
        if($this->session->userdata('admin_login')){
           $this->load->view('common/admin-home');
        } else if($this->session->userdata('rydlr_admin_login')){
           $this->load->view('common/admin-home');
        } 
        else {
            redirect('common_admin/view_admin_login'); 
        }
    }

    /*************************************** Functionality backend for login page ************************************************/

    public function login_admin() {
        $username = $this->input->post('username'); 
        $password = md5($this->input->post('password'));
        //  var_dump($password);

        $login_credential = $this->Media_admin_model->admin_login($username,$password);
    }

    /***************************************load view for setup new password page  ************************************************/

    public function view_new_password() {
        if($this->session->userdata('admin_login')){
           $this->load->view('common/new-password');
        } else if($this->session->userdata('rydlr_admin_login')){
           $this->load->view('common/new-password');
        } else {
            redirect('common_admin/view_admin_login'); 
        }
    }

    /*************************************** Backend functionality for change new password  ************************************************/

    public function change_new_password() {
        $password = md5($this->input->post('password'));
        $username = $this->input->post('username');
        $this->Media_admin_model->change_new_password($username,$password);
    }

    /*************************************** load view for new registration steps signup page  ************************************************/

    public function view_admin_register() {

        $user_id = $this->session->userdata('users_id');
        $contract_id = $this->session->userdata('contract_id');
        $membership_id = $this->session->userdata('membershi_id');
        if($contract_id != ""){
            $this->Media_admin_model->deleteData('contract', array('id' =>$contract_id));       
            $this->session->unset_userdata('contract_id');    
        }
        if($membership_id!=""){
            $this->Media_admin_model->deleteData('membership', array('id' =>$membership_id));       
            $this->session->unset_userdata('membershi_id');    
        }
        if($user_id != ""){
            $this->Media_admin_model->deleteData('users', array('id' =>$user_id));       
            $this->session->unset_userdata('users_id');
        }
        $this->load->view('common/admin-register');       
    }

    /*************************************** load view forgot username page  ************************************************/

    public function view_forget_username() {
        $this->load->view('common/forget-username');   
    }

    /***************************************load view forgot password page  ************************************************/

    public function view_forgot_password() {
        $this->load->view('common/forget-password');   
    }

    /***************************************load view user profile after login page  ************************************************/

    public function view_admin_profile() {
        if($this->session->userdata('admin_login')){
            $session = $_SESSION['admin_login']; 
            $user_id = $session['admin_id'];
            $where = array('id' => $user_id);
            $data['users_profile_data']  = $this->Media_admin_model->getRowDataWithWhere('*','users',$where);
            $data['get_membership_details'] = $this->Media_admin_model->get_membership_details($user_id);
            $this->load->view('common/admin-profile',$data);      
        }  else if($this->session->userdata('enterprise_account')){
            $session = $_SESSION['enterprise_account']; 
            $user_id = $session['admin_id'];
            $where = array('id' => $user_id);
            $data['users_profile_data']  = $this->Media_admin_model->getRowDataWithWhere('*','users',$where);
            $data['get_membership_details'] = $this->Media_admin_model->get_membership_details($user_id);
            $this->load->view('common/admin-profile',$data);      
        }
        else {
            redirect('common_admin/view_admin_login'); 
        }
    }

    /*************************************** load view all advertisment page by user or by admin  ************************************************/

    public function view_admin_advertisment() {
        if($this->session->userdata('admin_login')){
            $data['get_advertisment_details'] = $this->Media_admin_model->get_advertisement_result();
            $data['get_advertisment_campaigns'] = $this->Media_admin_model->get_advertisement_campaigns();
            $this->load->view('common/admin-advertisement',$data);         
        } else if($this->session->userdata('rydlr_admin_login')){
            $data['get_advertisment_details'] = $this->Admin_model->get_advertisement_result();
            $data['get_advertisment_campaigns'] = $this->Admin_model->get_advertisement_campaigns();
            $this->load->view('common/admin-advertisement',$data);         
        } else if($this->session->userdata('enterprise_account')){          
            $data['get_advertisment_details'] = $this->Media_admin_model->get_advertisement_result();
            $data['get_advertisment_campaigns'] = $this->Media_admin_model->get_advertisement_campaigns();
            $this->load->view('common/admin-advertisement',$data);         
        } 
        else { 
            redirect('common_admin/view_admin_login'); 
        }   
    }

    /*************************************** load view for adding new advertisment page  ************************************************/

    public function view_add_admin_advertisement() {
        if($this->session->userdata('admin_login')){
            $data['get_campaign_title'] = $this->Media_admin_model->get_campaign_details();
            $this->load->view('common/add-admin-advertisement', $data);            
        } else if($this->session->userdata('rydlr_admin_login')){
            $data['get_campaign_title'] = $this->Admin_model->get_campaign_details();
            $this->load->view('common/add-admin-advertisement', $data);            
        } else if($this->session->userdata('enterprise_account')){
            $data['get_campaign_title'] = $this->Media_admin_model->get_campaign_details();
            $this->load->view('common/add-admin-advertisement', $data);            
        } 
        else {
            redirect('common_admin/view_admin_login'); 
        }  
    }

    /*************************************** load view for targetting existing ads  ************************************************/

    public function view_targets(){
        $this->load->view('common/target-advertise');            
    }   

    /*************************************** load view for target new advertisment  ************************************************/
    public function view_target_advertise() {
        $id = $this->uri->segment(3); 
        if($this->session->userdata('admin_login')){
            $campaign_name = $this->input->post('campaign_name');
            $ad_name = $this->input->post('ad_title');
            $data['ad_name'] = $this->Media_admin_model->view_ad_target($id);
            $this->load->view('common/target-advertise',$data);            
            //redirect('common_admin/view_targets',$data); 
        } else if($this->session->userdata('rydlr_admin_login')){
            $campaign_name = $this->input->post('campaign_name');
            $ad_name = $this->input->post('ad_title');
            $data['ad_name'] = $this->Admin_model->view_ad_target($id);
            $this->load->view('common/target-advertise',$data);            
            //redirect('common_admin/view_targets',$data); 
        } else if($this->session->userdata('enterprise_account')){
            $campaign_name = $this->input->post('campaign_name');
            $ad_name = $this->input->post('ad_title');
            $data['ad_name'] = $this->Admin_model->view_ad_target($id);
            $this->load->view('common/target-advertise',$data);            
            //redirect('common_admin/view_targets',$data); 
        } 
        else {
            redirect('common_admin/view_admin_login'); 
        }   
    }

    /*************************************** load view for edit advertisment  ************************************************/

    public function view_edit_admin_advertisement() {
        if($this->session->userdata('admin_login')){
            $id = $this->uri->segment(3);
            $data['get_campaign_title'] = $this->Media_admin_model->get_campaign_details();
            $data['get_advertisment'] = $this->Media_admin_model->get_advertisment_details_by_id($id);
            $this->load->view('common/edit-admin-advertisement',$data);            
        } else if($this->session->userdata('rydlr_admin_login')){
            $id = $this->uri->segment(3);
            $data['get_campaign_title'] = $this->Admin_model->get_campaign_details();
            $data['get_advertisment'] = $this->Admin_model->get_advertisment_details_by_id($id);
            $this->load->view('common/edit-admin-advertisement',$data);            
        } else if($this->session->userdata('enterprise_account')){
            $id = $this->uri->segment(3);
            $data['get_campaign_title'] = $this->Media_admin_model->get_campaign_details();
            $data['get_advertisment'] = $this->Media_admin_model->get_advertisment_details_by_id($id);
            $this->load->view('common/edit-admin-advertisement',$data);            
        } 

        else {
            redirect('common_admin/view_admin_login'); 
        }     
    }

    /*************************************** load view for view single advertisment by id  ************************************************/

    public function view_only_admin_advertisement() {
        if($this->session->userdata('admin_login')){
            $id = $this->uri->segment(3);
            $data['get_campaign_title'] = $this->Media_admin_model->get_campaign_details();
            $data['get_advertisment'] = $this->Media_admin_model->get_advertisment_details_by_id($id);
            $this->load->view('common/view-only-admin-advertisement',$data);            
        } else if($this->session->userdata('rydlr_admin_login')){
            $id = $this->uri->segment(3);
            $data['get_campaign_title'] = $this->Media_admin_model->get_campaign_details();
            $data['get_advertisment'] = $this->Media_admin_model->get_advertisment_details_by_id($id);
            $this->load->view('common/view-only-admin-advertisement',$data);            
        } else if($this->session->userdata('enterprise_account')){
            $id = $this->uri->segment(3);
            $data['get_campaign_title'] = $this->Media_admin_model->get_campaign_details();
            $data['get_advertisment'] = $this->Media_admin_model->get_advertisment_details_by_id($id);
            $this->load->view('common/view-only-admin-advertisement',$data);            
        } 

        else {
            redirect('common_admin/view_admin_login'); 
        }     
    }

    /*************************************** load view for campaign  ************************************************/
 
    public function view_admin_campaigns() {
        if($this->session->userdata('admin_login')){ 
            $campaign_id = "0";
            $status = "Active";
            $data['get_campaign_data'] = $this->Media_admin_model->search_all_campaign($campaign_id,$status);            
            $data['get_all_campaign_data'] = $this->Media_admin_model->get_all_campaign_data();
            $this->load->view('common/admin-campaigns',$data);           
        } else if($this->session->userdata('enterprise_account')) {
            // $data['get_campaign_data'] = $this->Media_admin_model->get_campaign_data();            
            // $data['get_advertisement_count'] = $this->Media_admin_model->get_advertisement_count();
            // $data['get_contract'] = $this->Media_admin_model->get_contract();
            // $this->load->view('common/admin-campaigns',$data); 
            $campaign_id = "0";
            $status = "Active";
            $data['get_campaign_data'] = $this->Media_admin_model->search_all_campaign($campaign_id,$status);            
            $data['get_all_campaign_data'] = $this->Media_admin_model->get_all_campaign_data();
            $this->load->view('common/admin-campaigns',$data);            
        }
        else {
            redirect('common_admin/view_admin_login'); 
        }  
    }

    /*************************************** load view for add campaign  ************************************************/

    public function view_add_admin_campaign() {
        if($this->session->userdata('admin_login')){
            $this->load->view('common/add-admin-campaign');              
        } else if($this->session->userdata('enterprise_account')) {
            $this->load->view('common/add-admin-campaign');              
        } else {
            redirect('common_admin/view_admin_login'); 
        }  
    }
    /*************************************** load view for view campaign  ************************************************/
    public function read_view_admin_campaign(){
        $campaign_id = $this->uri->segment('3');
         if($this->session->userdata('admin_login')){
            $data['campaign_data'] = $this->Media_admin_model->get_single_campaign_data($campaign_id);

            $this->load->view('common/view-admin-campaign',$data);              
        } else if($this->session->userdata('enterprise_account')) {

            $this->load->view('common/view-admin-campaign');              
        } else {
            redirect('common_admin/view_admin_login'); 
        }  
    }
     /*************************************** load view for view campaign  ************************************************/
    public function edit_admin_campaign(){
        $campaign_id = $this->uri->segment('3');
         if($this->session->userdata('admin_login')){
            $data['campaign_data'] = $this->Media_admin_model->get_single_campaign_data($campaign_id);
            $this->load->view('common/edit-admin-campaign',$data);              
        } else if($this->session->userdata('enterprise_account')) {

            $this->load->view('common/edit-admin-campaign');              
        } else {
            redirect('common_admin/view_admin_login'); 
        }  
    }

    /*************************************** load view for contract  ************************************************/

    public function view_admin_contract() { 
        if($this->session->userdata('admin_login')){
            $session = $_SESSION['admin_login']; 
            $user_id = $session['admin_id'];
            $data['get_contract_detail'] = $this->Media_admin_model->get_contract_userid($user_id);
            $data['get_contract_details'] = $this->Media_admin_model->get_contract_userids($user_id);
            $this->load->view('common/admin-contract',$data);                 
        } else if($this->session->userdata('rydlr_admin_login')){
            $session = $_SESSION['rydlr_admin_login']; 
            $user_id = $session['admin_id'];
            $data['get_contract_detail'] = $this->Admin_model->get_contract_userid($user_id);
            $data['get_contract_details'] = $this->Admin_model->get_contract_userids($user_id);

            $this->load->view('common/admin-contract',$data);                 
        } else if($this->session->userdata('enterprise_account')){
            $session = $_SESSION['enterprise_account']; // chirag 14/09/2017
            $user_id = $session['admin_id'];
            $data['get_contract_detail'] = $this->Admin_model->get_contract_userid($user_id);
            $data['get_contract_details'] = $this->Admin_model->get_contract_userids($user_id);

            $this->load->view('common/admin-contract',$data);                 
        } 
        else {
            redirect('common_admin/view_admin_login'); 
        }  
    }


    /*************************************** load view for payment  ************************************************/

    public function view_admin_payment() {
        if($this->session->userdata('admin_login')){
            $this->load->view('common/admin-payment');                    
        } else if($this->session->userdata('rydlr_admin_login')){
            $this->load->view('common/admin-payment');                    
        } else if($this->session->userdata('enterprise_account')){
            $this->load->view('common/admin-payment');                    
        } 
        else {
            redirect('common_admin/view_admin_login'); 
        }  
    }

    /*************************************** load view for payment invoice  ************************************************/

    public function payment_invoice() {
        if($this->session->userdata('admin_login')){
            $this->load->view('common/admin-payment-invoice');                    
        } else if($this->session->userdata('rydlr_admin_login')){
            $this->load->view('common/admin-payment-invoice');                    
        } else if($this->session->userdata('enterprise_account')){
            $this->load->view('common/admin-payment-invoice');                    
        }
        else {
            redirect('common_admin/view_admin_login'); 
        }   
    }



       

    /*************************************** load view for report  ************************************************/


    public function view_admin_report() {
        if($this->session->userdata('admin_login')){
                $data['get_advertisment_campaigns'] = $this->Media_admin_model->get_advertisement_campaigns();
                $hhh =  $this->Media_admin_model->get_advertisement_result_total();
              //  echo "<pre>;";
                //print_r($hhh);
                //die();
                $result_array = $abc = array();
             foreach ($hhh as $value) {
               
                $abc['campaign_name'] = $value->title;
                $abc['ad_status'] = $value->ad_status;
                $abc['camp_status'] = $value->status;
                $abc['ad_name'] = $value->ad_title;
                $abc['adCount'] = $this->Media_admin_model->get_advertisement_result_totalads($value->advertise_id);
   // $abc['adImpression']= $this->Media_admin_model->get_advertisement_result_totalImpression($value->advertise_id);
                $result_array[] = $abc;
             }
             $data['get_advertisment_details'] = $result_array;
          // echo "<pre>";
          // print_r( $data['get_advertisment_details']);
         // die();
            $this->load->view('common/admin-report',$data);                        
        }          
         else if($this->session->userdata('enterprise_account')){
             //$data['get_campaign_data'] = $this->Media_admin_model->get_campaign_data();
              $data['get_advertisment_campaigns'] = $this->Media_admin_model->get_advertisement_campaigns();
             $hhh =  $this->Media_admin_model->get_advertisement_result_total();
               $result_array = $abc = array();
             foreach ($hhh as $value) {
               
                $abc['campaign_name'] = $value->title;
                $abc['ad_name'] = $value->ad_title;
                $abc['ad_count'] = $this->Media_admin_model->get_advertisement_result_totalads($value->advertise_id);
                $result_array[] = $abc;
             }
             $data['get_advertisment_details'] = $result_array;
            
            $this->load->view('common/admin-report',$data);                       
        } 
        else {
            redirect('common_admin/view_admin_login'); 
        }  
    }

    /*************************************** developed functionality for logout and redirect  ************************************************/

    public function logout() {
        $this->session->unset_userdata('admin_login');
        $this->session->unset_userdata('rydlr_admin_login');
        $this->session->unset_userdata('enterprise_account');
        redirect('common_admin/view_admin_login');
    }

    /*************************************** registration first step (index == 1)  ************************************************/
    public function add_personal_details_old() {

        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $allowedExts = array('png', 'PNG', 'jpg','JPG','jpeg','JPEG','gif','GIF');    
        $image_name = $this->input->post('ad_file');

        if($_FILES['file']['error'] == 0 && in_array($extension, $allowedExts)){
            $ext = pathinfo($_FILES["file"]["name"]);
            $image_name = time() . rand(1, 5000) . "." . $ext['extension'];
            $temp = $_FILES["file"]["tmp_name"];
            $upload_dir = dirname($_SERVER["SCRIPT_FILENAME"]) . "/assets/client_logo/";
            move_uploaded_file($temp, $upload_dir . $image_name);
            $data = array(
                'media_agency_name' => $this->input->post('agency_name'),
                'agent_name' => $this->input->post('agent_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'client_logo' => "assets/client_logo/".$image_name
            );
            $users_id = $this->Media_admin_model->insertData('users', $data);
            if($users_id){
                $this->session->set_userdata("users_id", $users_id);
                $data = array(
                'admin_username' => $data['username'],
                'admin_password' => $data['password'],
                'admin_id' => $users_id
                );
                $this->session->set_userdata('admin_login',$data); 

                echo json_encode(array('status' =>1));
            } else {
                echo json_encode(array('status' =>0));
            }
        } else {
             echo json_encode(array('status' =>0));   
        } 
        
    }
    
    public function add_personal_details() {      

        if(isset($_FILES['file'])){
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $allowedExts = array('png', 'PNG', 'jpg','JPG','jpeg','JPEG','gif','GIF');    
        $image_name = $this->input->post('ad_file');

        if($_FILES['file']['error'] == 0 && in_array($extension, $allowedExts)){
            $ext = pathinfo($_FILES["file"]["name"]);
            $image_name = time() . rand(1, 5000) . "." . $ext['extension'];
            $temp = $_FILES["file"]["tmp_name"];
            $upload_dir = dirname($_SERVER["SCRIPT_FILENAME"]) . "/assets/client_logo/";
            move_uploaded_file($temp, $upload_dir . $image_name);
            } else {          
                 //echo json_encode(array('status' =>3));  
                $image_name = "dummy.png";
            }
        }else{
             $image_name = "dummy.png";
        }

            $data = array(
                'media_agency_name' => $this->input->post('agency_name'),
                'agent_name' => $this->input->post('agent_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'client_logo' => "assets/client_logo/".$image_name
            );

           
            $users_id = $this->Media_admin_model->insertData('users', $data);
            if($users_id){
                $this->session->set_userdata("users_id", $users_id);
                $data = array(
                'admin_username' => $data['username'],
                'admin_password' => $data['password'],
                'admin_id' => $users_id
                );
                $this->session->set_userdata('admin_login',$data); 

                echo json_encode(array('status' =>1));
            } else {
                echo json_encode(array('status' =>0));
            }
         
        
    }

    /*************************************** registration second step (index == 2)  ************************************************/

    public function add_contract_details() {
        $user_id = $this->session->userdata('users_id');
        $membership_plan = $this->input->post('membership_plan_id');

        $diff_membership_lan = explode('-', $membership_plan); // explode plan 1 - 50 SH to array [0] plan 1 and [1] 50 SH
        $membership_plan_name = $diff_membership_lan[0];
        $membershi_plan_val = $diff_membership_lan[1];
        $diff_membership_plan_val = explode(' ', $membershi_plan_val); // explode 50 SH ro array [0] 50 and [1] SH i.e:- space after value
        $main_membership_plan = $diff_membership_plan_val[1];
        
        $insert_membership_data = array(
            'plan_name' => $membership_plan_name,
            'plan_value' => $main_membership_plan
        );        
        $insert_membership = $this->Media_admin_model->insertData('membership', $insert_membership_data);
        $this->session->set_userdata("membershi_id", $insert_membership);
        if($insert_membership){
            $data = array(
            'contract_title' => $this->input->post('contract_title'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'user_id' => $user_id,
            'membership_id' => $this->session->userdata('membershi_id')
            );   

            $contract_id = $this->Media_admin_model->insertData('contract', $data);
            $this->session->set_userdata("contract_id", $contract_id);
        }
    }

    /*************************************** registration third step (index == 3)  ************************************************/

    public function add_payment_details() {
        $payment_type = $this->input->post('payment_type');
        $users_details = array(
                'media_agency_name' => $this->input->post('agency_name'),
                'agent_name' => $this->input->post('agent_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
            );

        if($payment_type=='manual'){
            $payment_type = 'n';
        } else {
            $payment_type = 'y';
        }
        $data = array(
            'payment_type' => $this->input->post('payment_type'),
            'contract_id' => $this->session->userdata('contract_id'),
            'manual_payment_status' => $payment_type
        );
        $insert_payment = $this->Media_admin_model->insertData('payment',$data);
        if($insert_payment){

            $session = $_SESSION['admin_login']; 
            $user_id = $session['admin_id'];

            $this->db->set('payment_status','paid'); /* beta view all icon chirag 15/09 */
            $this->db->where('id',$user_id);
            $this->db->update('users');

            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('id',$user_id);
            $query = $this->db->get();
            $query_result = $query->result_array();
            foreach ($query_result as $val) {
                $ary['username'] = $val['username'];
                $ary['email'] = $val['email'];
            }   

            $actual_link = base_url()."common_admin/activate_link/".$user_id;
            $subject = "User Registration Activation Email";
            //$message = "<h4><strong> Welcome to Rydlr </strong></h4>";
            //$message = "<h4><strong> Dear ".$ary['username']."</strong></h4>";
            //$message = "<h4><strong> Thanks for your registration </strong></h4>";
            $message = "<h4><strong> Welcome to Rydlr, </strong></h4>  <h4><strong> Dear ".$ary['username'].",</strong></h4> <h4><strong> Thanks for your registration. </strong></h4> Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
            $emails = $ary['email'];   
            $email = array('digital@dorsalmedia.co.ke', 'test306user@gmail.com',$emails);
            $this->sendemail($email,$subject,$message);
            
            

            $this->session->unset_userdata('membershi_id');
             $this->session->unset_userdata('users_id');
             $this->session->unset_userdata('contract_id');
        	$this->session->unset_userdata('admin_login');

            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        }
    }

    /*************************************** load view for uploading documents  ************************************************/

    public function view_upload_document() {
        $id = $this->uri->segment('3'); 
        $this->load->view('common/upload-document-contract');
    }
    
    /*************************************** load view fetch uploaded documents by id ************************************************/    

    public function view_document_list() {
        $id = $this->uri->segment('3');
        $data['get_all_docs'] = $this->Admin_model->get_all_docs($id); 
        $this->load->view('common/view-contract',$data);   
    }


    public function view_payment_list() {
        $id = $this->uri->segment('3');
        $data['get_all_payment'] = $this->Media_admin_model->get_all_payment($id); 
        $this->load->view('common/view-payment',$data);   
    }

    /*************************************** develop multiple document upload functionality  ************************************************/

    public function upload_multiple_docs() {
        if (isset($_FILES['files']) && !empty($_FILES['files'])) {
            $no_files = count($_FILES["files"]['name']);
            $dest1 = array();
            $all_docs = '';
            for ($i = 0; $i < $no_files; $i++) {
                
                if ($_FILES["files"]["error"][$i] > 0) {
                    echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
                } else {
                    $dest1 = array();
                        $file_img = rand().'_'.$_FILES['files']['name'][$i].'';
                        $file_img_seperate = ''.$_FILES['files']['name'][$i].',';
                        $tmp1 = $_FILES['files']['tmp_name'][$i];
                        $dest1 = "files/docs/$file_img";
                        if($i < $no_files-1){
                            $all_docs .= $dest1 . ',';         
                        }  else {
                            $all_docs .= $dest1 ;         
                        }
                        
                        $upload_dir1 = dirname($_SERVER["SCRIPT_FILENAME"]) ."/files/docs/"; 
                        
                        move_uploaded_file($tmp1, $upload_dir1 . $file_img);

                        //move_uploaded_file($_FILES["files"]["tmp_name"][$i], 'uploads/' . $_FILES["files"]["name"][$i]);
                        //echo 'File successfully uploaded : uploads/' . $_FILES["files"]["name"][$i] . ' ';
                }
            }
                $contract_id = $this->input->post('contract_id');
                $where = array('id' => $contract_id);
                $data = array(
                    'upload_document' => $all_docs
                    );
                $update = $this->Media_admin_model->updateTabel($data,'contract',$where); 
                if($update){
                    echo json_encode(array('status' =>1));
                } else {
                    echo json_encode(array('status' =>0));
                }
        } else {
            echo 'Please choose at least one file';
        }
    }



    public function activate_link() {
        $id = $this->uri->segment('3'); 
        $update_link = $this->Media_admin_model->update_link($id);
        if($update_link['status'] == 1){
            redirect('common_admin/view_admin_login');
        } else {
            redirect('common_admin/view_admin_login');
        }   
    }

        /*************************************** update user profile plans change membership functionality  ************************************************/

    public function update_users_profile() {

        if(isset($_FILES['file'])){
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $allowedExts = array('png', 'PNG', 'jpg','JPG','jpeg','JPEG');    
        $image_name = $this->input->post('ad_file');

        if(!in_array($extension, $allowedExts)){
            echo json_encode(array('status' =>5));
        }


        if($_FILES['file']['error'] == 0 && in_array($extension, $allowedExts)){
            $ext = pathinfo($_FILES["file"]["name"]);
            $image_name = time() . rand(1, 5000) . "." . $ext['extension'];
            $temp = $_FILES["file"]["tmp_name"];

            $upload_dir = dirname($_SERVER["SCRIPT_FILENAME"]) . "/assets/client_logo/";
            move_uploaded_file($temp, $upload_dir . $image_name);
            $client_logo = "assets/client_logo/".$image_name;
            }
        }else{
            $client_logo = $_POST['old_file'];
        }

        $user_id = $this->input->post('user_id');

        $membership_plan = $this->input->post('change_plan');
        
        if($membership_plan != ""){
            $user_id = $this->input->post('user_id');

            $membership_plan = $this->input->post('change_plan');
            $diff_membership_lan = explode('-', $membership_plan); // explode plan 1 - 50 SH to array [0] plan 1 and [1] 50 SH
            $membership_plan_name = $diff_membership_lan[0];
            $membershi_plan_val = $diff_membership_lan[1];
            $diff_membership_plan_val = explode(' ', $membershi_plan_val); // explode 50 SH ro array [0] 50 and [1] SH i.e:- space after value
            $main_membership_plan = $diff_membership_plan_val[1];

            $update_membership_data = array(
                'plan_name' => $membership_plan_name,
                'plan_value' => $main_membership_plan
            );

            //$update_membership = $this->Media_admin_model->insertData('membership', $insert_membership_data);
            $membership_id = $this->input->post('membership_id');

            $this->db->where('id',$membership_id);
            //$update_membership = $this->db->update('membership',$update_membership_data);

            //$where = array('id' => $membership_id);
            //$update_membership = $this->Media_admin_model->updateTabel($update_membership_data,'membership', $where);
            $data = array(
                'media_agency_name' => $this->input->post('media_agency_name'),
                'agent_name' => $this->input->post('agent_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'username' => $this->input->post('username'),
                'client_logo' => $client_logo,
            );
            if($this->input->post('password') && $this->input->post('password') != 'dummypass'){
                $data['password'] = MD5($this->input->post('password'));
            }
            $where = array('id' => $user_id);
            $update = $this->Media_admin_model->updateTabel($data,'users', $where);
            if($update){
                echo json_encode(array('status' =>1));
            } else {
                echo json_encode(array('status' =>0));    
            }
        } else {
            $user_id = $this->input->post('user_id');
            $membership_plan = $this->input->post('change_plan');
            $data = array(
                'media_agency_name' => $this->input->post('media_agency_name'),
                'agent_name' => $this->input->post('agent_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'username' => $this->input->post('username'),
                'client_logo' => $client_logo,
            );
            if($this->input->post('password') && $this->input->post('password') != 'dummypass'){
                $data['password'] = MD5($this->input->post('password'));
            }
            $where = array('id' => $user_id);
            $update = $this->Media_admin_model->updateTabel($data,'users', $where);
            if($update){
                echo json_encode(array('status' =>1));
            } else {
                echo json_encode(array('status' =>0));    
            }
        }        

    }

    /*************************************** developed delete campaign functionality  ************************************************/

    public function delete_campaign_detail() {
        $id = $this->input->post('campaign_id');
        $delete = $this->Media_admin_model->deleteData('campaign', array('id' =>$id));
        if($delete){
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        }
    }

    /*************************************** developed forgot username functionality  ************************************************/

    public function forgot_admin_username() {
        $email = $this->input->post('email');
        $temp_pwd = rand();
        if($email){
            $post_email = $this->Media_admin_model->forgot_admin_username($email, $temp_pwd);
            $get_email = $this->Media_admin_model->forgot_admin_username($email, $temp_pwd);
            $username = $get_email[0]['username'];
            $email_address = $get_email[0]['email'];

            $subject="Your Rydlr Account Information";
            $message="Below are your Rydlr account login details :- <br><br> UserID: $username <br><br> Temporary password: $temp_pwd <br><br> This email was sent as someone who has forgotten their rydlr username entered this email address as their own <br><br> <span style='color:red; margin-top:10px;'> Note :- You will be prompted to re-set your password when you login. </span>";

            $this->sendemails($email_address,$subject,$message);
            echo json_encode($get_email);
        }
    }

    /*************************************** developed forgot password functionality  ************************************************/

    public function forgot_admin_password() {
        $username = $this->input->post('username');
        $temp_pwd = rand();
        if($username){
            $post_email = $this->Media_admin_model->forgot_admin_password($username, $temp_pwd);
            $get_email = $this->Media_admin_model->forgot_admin_password($username, $temp_pwd);
            $email = $get_email[0]['email'];   
            $subject="Your Rydlr Account Information";
            $message="Below are your rydlr account login details :- <br><br>Temporary password: $temp_pwd <br><br> This email was sent as someone who has forgotten their rydlr password entered your rydlr user ID and requested a password re-set. <br><br> <span style='color:red; margin-top:10px;'> Note :- You will be prompted to re-set your password when you login. </span>";

            $this->sendemail($email,$subject,$message);
            echo json_encode($get_email);
        }
    }

    /*************************************** developed add new campaign functionality  ************************************************/

    public function insert_campaign_detail() {

        if($this->session->userdata('admin_login')){
            $session = $_SESSION['admin_login']; 
            $user_id = $session['admin_id'];                    
        } else if($this->session->userdata('rydlr_admin_login')){
            $session = $_SESSION['rydlr_admin_login']; 
            $user_id = $session['admin_id'];
        }  else if($this->session->userdata('enterprise_account')){
            $session = $_SESSION['enterprise_account']; 
            $user_id = $session['admin_id'];
        } 

        $data=array(
            'title' => $this->input->post('campaign_title'),
            'budget' => $this->input->post('budget'),
            'status' => $this->input->post('status'),
            'user_id' => $user_id
            );
   
    
        $campaign = $this->Media_admin_model->insertData('campaign', $data);
        if($campaign){
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));    
        }
    }

    /*************************************** developed add new ads functionality  ************************************************/
    
    public function insert_advertise_detail() {
        
        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            if($this->session->userdata('admin_login')){
                $session = $_SESSION['admin_login']; 
                $user_id = $session['admin_id'];                    
            } else if($this->session->userdata('rydlr_admin_login')){
                $session = $_SESSION['rydlr_admin_login']; 
                $user_id = $session['admin_id'];
            } else if($this->session->userdata('enterprise_account')){
                $session = $_SESSION['enterprise_account']; 
                $user_id = $session['admin_id'];
            } 
            $file = $_FILES['file']['name'];
            $file = preg_replace('/[^A-Za-z0-9.\-]/', '-', $file);  //this line remove spacial cheretors and replase- .
            $tmp = $_FILES['file']['tmp_name'];
            $dest = "files/$file";

            $file_upload_img = $this->input->post('file_image');
            if($file_upload_img != ''){
                $file_img = $_FILES['file_img']['name'];
                $file_img = preg_replace('/[^A-Za-z0-9.\-]/', '-', $file_img);  //this line remove spacial cheretors and replase- .
                $tmp1 = $_FILES['file_img']['tmp_name'];
                $dest1 = "files/images/$file_img";        
                $upload_dir1 = dirname($_SERVER["SCRIPT_FILENAME"]) ."/files/images/"; 
                move_uploaded_file($tmp1, $upload_dir1 . $file_img);
            } else {
                $dest1 = "";
            }
            
            $upload_dir = dirname($_SERVER["SCRIPT_FILENAME"]) ."/files/"; 

            if(move_uploaded_file($tmp, $upload_dir . $file)) {  
                $data = array(
                    'campaign_id' => $this->input->post('campaign_id'),
                    'ad_title' => $this->input->post('ad_title'),
                    'ad_location' => $this->input->post('ad_location'),
                    'ad_file' => $dest,
                    'ad_file_img' => $dest1,
                    'ad_description' => $this->input->post('description'),
                    'status' => $this->input->post('status'),
                    'spend' => $this->input->post('spend'),
                    'user_id' => $user_id,
                    'approval_status' => '0',
                    'video_size' => $this->input->post('video_size'),
                    'video_duration' => $this->input->post('video_duration')                     
                );

                $advertise = $this->Media_admin_model->insertData('advertise', $data);
                if($advertise){
                    echo json_encode(array('status' =>1));
                } else {
                    echo json_encode(array('status' =>0));    
                }
            }
        } 
    }

    /*************************************** developed approve ad functionality by admin ************************************************/

    public function update_approval_status() {
        $approve_id = $this->input->post('approve_id');
        $data = array(
            'approval_status' => '1',
        );
        $where = array('id' => $approve_id);
        $update = $this->Media_admin_model->updateTabel($data,'advertise',$where);
        if($update){
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        }   
    }

    /*************************************** update user profile page contact us popup functionality by users  ************************************************/

    public function update_contact_info() {
        $session = $_SESSION['admin_login'];
        $user_id = $session['admin_id'];   

        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'message' => $this->input->post('message'),
            'user_id' => $user_id
        );

        $insert = $this->Media_admin_model->insertData('contact',$data);
        if($insert){
            $email = array('digital@dorsalmedia.co.ke', 'test306user@gmail.com');

            $subject="New inquiry for Enterprise Plan";
            $message=" <h3> Dear Rydlr Sales, </h3> <h4> You have a new message for Enterprise plan. </h4> Name :- ".$this->input->post('name')." <br><br> Email :- ".$this->input->post('email')." <br><br> Phone :- ".$this->input->post('phone')." <br><br> Message :- ".$this->input->post('message')." <br><br> <h3> Contact immediately and help customer. </h3> thanks, <br> Rydlr WebTeam";

            $this->sendemail($email,$subject,$message);
            echo json_encode(array('status' =>1));
        } else{
            echo json_encode(array('status' =>0));
        }
    }

    /*************************************** update advertise detail functioanlity by user  ************************************************/

    public function update_advertise_detail() {

            if (empty($_FILES['file'])) {
                $file_old_video = $this->input->post('files');
                $file_old_img = $this->input->post('file_imgs');                
            }
            

            $file_upload_img = $this->input->post('file_image');
            if($file_upload_img != ''){
                $file_img = $_FILES['file_img']['name'];
                 $file_img = preg_replace('/[^A-Za-z0-9.\-]/', '-', $file_img);  //this line remove spacial cheretors and replase- .
                $tmp1 = $_FILES['file_img']['tmp_name'];
                $dest1 = "files/images/$file_img";        
                $upload_dir1 = dirname($_SERVER["SCRIPT_FILENAME"]) ."/files/images/"; 
                move_uploaded_file($tmp1, $upload_dir1 . $file_img);
            } else {
                $file_old_img = $this->input->post('file_imgs');
                $dest1 = $file_old_img;
            }

            $file_upload_video = $this->input->post('file_video');
            if($file_upload_video != '') {
                $file = $_FILES['file']['name'];
                $file = preg_replace('/[^A-Za-z0-9.\-]/', '-', $file);  //this line remove spacial cheretors and replase- .
                $tmp = $_FILES['file']['tmp_name'];
                $dest = "files/$file";
                $upload_dir = dirname($_SERVER["SCRIPT_FILENAME"]) ."/files/";     
                move_uploaded_file($tmp, $upload_dir . $file);
            } else {
                $file_old_video = $this->input->post('files');
                $dest = $file_old_video;
            }
            
            $id = $this->input->post('ad_id'); 
            $data = array(
                'campaign_id' => $this->input->post('campaign_id'),
                'ad_title' => $this->input->post('ad_title'),
                'ad_location' => $this->input->post('ad_location'),
                'ad_file' => $dest,
                'ad_file_img' => $dest1,
                'ad_description' => $this->input->post('description'),
                'status' => $this->input->post('status'),
                'spend' => $this->input->post('spend'),
                'video_duration' => $this->input->post('video_duration')
                //'user_id' => $user_id,
            );
            
            $update = $this->Media_admin_model->update_advertisement_detail($id, $data);            
            
            if($update) {
                echo json_encode(array('status' =>1));
            } else {
                echo json_encode(array('status' =>0));    
            }   
            
        //} 
    }

    /******************************** update advertisment detail functioanlity but this function is not in use  **************************************/

    public function update_advertisement_detail() {
        if($this->session->userdata('admin_login')){
            $session = $_SESSION['admin_login']; 
            $user_id = $session['admin_id'];                    
        } else if($this->session->userdata('rydlr_admin_login')){
            $session = $_SESSION['rydlr_admin_login']; 
            $user_id = $session['admin_id'];
        } else if($this->session->userdata('enterprise_account')){
            $session = $_SESSION['enterprise_account']; 
            $user_id = $session['admin_id'];
        } 
        $file = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        $dest = "files/$file";
        $upload_dir = dirname($_SERVER["SCRIPT_FILENAME"]) ."/files/"; 
        if(move_uploaded_file($tmp, $upload_dir . $file)){  
            $data = array(
                'campaign_id' => $this->input->post('campaign_id'),
                'ad_title' => $this->input->post('ad_title'),
                'ad_location' => $this->input->post('ad_location'),
                'ad_file' => $dest,
                'status' => $this->input->post('status'),
                'user_id' => $user_id 
            );
            $advertise = $this->Media_admin_model->insertData('advertise', $data);
            if($advertise){
                echo json_encode(array('status' =>1));
            } else {
                echo json_encode(array('status' =>0));    
            }
        }
    }

    /******************************** delete existing ads functioanlity by user  **************************************/

    function delete_ads() {
        $id = $this->input->post('advertise_id');
        $where = array('id'=> $id);
        $delete = $this->Media_admin_model->deleteData('advertise',$where);
        if($delete){
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        }
    }

    /******************************** delete existing campaign functioanlity by user  **************************************/

    function delete_campaigns() {
        $id = $this->input->post('campaign_id');

        $this->db->select('*');
        $this->db->from('campaign');
        $this->db->join('advertise','campaign.id = advertise.campaign_id');
        $this->db->where('campaign.id',$id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            echo json_encode(array('status' =>0));    
        } else {
            $where = array('id'=> $id);
            $delete = $this->Media_admin_model->deleteData('campaign',$where);
            if($delete){
                echo json_encode(array('status' =>1));
            }
        }
    }

    /******************************** update existing campaign functioanlity by user this function was not in use  **************************************/

    function update_campaign_details() {
        $id= $this->input->post('id'); 
        $confirm = $_POST['confirm'];
        $data = array(
            'title' => $this->input->post('title'),
            'budget' => $this->input->post('budget'),
            'status' => $this->input->post('status'),
        );
      
        $where = array('id'=>$id);
        $update = $this->Media_admin_model->updateTabel($data,'campaign',$where);
        
        if($update){
            if($confirm == "yes"){
                $change_ad_status = $this->Media_admin_model->change_selected_ad_status($id);
            }
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        }
    }

    /***** this is just test email functinality if you feel email is not working than just change email id in this function and run this function  ******/

    function email_test(){
        $email ='mihir@xoomsolutions.com';
        $subject = 'test email';
        $message = 'email testing done';
        $this->sendemail($email,$subject,$message);
        
    }

    /************************* send email main function all function are passing parameter to this function and this will send email **********************/

    function sendemail($email,$subject,$message){
        $this->load->library('email');
        $this->email->from('info@rydlr.com');
        $this->email->subject($subject);
        $this->email->to($email);
        $this->email->set_mailtype("html");
        $this->email->message($message);
        //$this->email->send();
        if($this->email->send()){
            $response = 'email sent';
        } else {
           $response = $this->email->print_debugger();
        }
        echo $response;
    }    

    /************************* send email function for testing other email **********************/

    function sendemails($email_address,$subject,$message){
        $this->load->library('email');
        $this->email->from('info@rydlr.com');
        $this->email->subject($subject);
        $this->email->to($email_address);
        $this->email->set_mailtype("html");
        $this->email->message($message);
        $this->email->send();
        return true;
    }    

    /******************************** update existing campaign functioanlity by user  **************************************/

    public function update_campaign_detail() {
        $campaign_id= $this->input->post('campaign_id');
        $data = array(
            'title' => $this->input->post('campaign_title'),
            'budget' => $this->input->post('budget'),
            'status' => $this->input->post('status'),
            );
        $where = array('id' => $campaign_id);
        $update = $this->Media_admin_model->updateTabel($data,'campaign', $where);
        if($update){
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));    
        }
    }

    /******************************** search campaign by there name and status by user or by admin  **************************************/

    public function search_campaign() {
        $campaign_id = $this->input->post('campaign_id');
        $status =  $this->input->post('campaign_status');


        if($campaign_id == '0'){
            $search = $this->Media_admin_model->search_all_campaign($campaign_id,$status);
            if($search){               
                echo json_encode($search);
            } else {
                echo json_encode($search);
               // echo json_encode(array('status' =>0));
            }
        } else {            
            $search = $this->Media_admin_model->search_campaign($campaign_id,$status);
            if($search){
                echo json_encode($search);
            } else {               
                echo json_encode($search);
                //echo json_encode(array('status' =>0));
            }
        }
        
    }
/*here starts code for analytics serch campaing by mihir*/
public function search_campaign_analytics(){
        $report_id = $this->input->post('report_id');
        $campaign_id = $this->input->post('campaign_id');
        $status =  $this->input->post('campaign_status');
       

        if($campaign_id == '0'){ 
            //$search = $this->Media_admin_model->search_campaign_ads_all($campaign_id,$status,$report_id);              
               
            $search = $this->Media_admin_model->search_campaign_analytics_all($campaign_id,$status,$report_id); 
               
            if($search){
                echo json_encode($search);
            } else {
                echo json_encode(array('status' =>0));
            }
        } else {
            $search = $this->Media_admin_model->search_campaign_analytics($campaign_id,$status,$report_id); 
                  //echo "<pre>";
          // print_r($search);
            //die();           
            if($search){
                    
                echo json_encode($search);
            } else {
                echo json_encode(array('status' =>0));
            }
        }
           
    }
/* end code for serch analytics serch*/






//back up for serch
/*here starts code for analytics serch campaing by mihir*/
/*public function search_campaign_analytics(){
        $report_id = $this->input->post('report_id');
        $campaign_id = $this->input->post('campaign_id');
        $status =  $this->input->post('campaign_status');
        if($campaign_id == '0'){ 
               
            $search = $this->Media_admin_model->search_campaign_ads_all($campaign_id,$status);              
            if($search){
                echo json_encode($search);
            } else {
                echo json_encode(array('status' =>0));
            }
        } else {
            $search = $this->Media_admin_model->search_campaign_ads($campaign_id,$status);        
            if($search){
                    
                echo json_encode($search);
            } else {
                echo json_encode(array('status' =>0));
            }
        }
           
    }*/
/* end code for serch analytics serch*/


















    /******************************** search advertisments by there camopaign name and status by user or by admin  **************************************/

    public function search_campaign_ads(){
        $campaign_id = $this->input->post('campaign_id');
        $status =  $this->input->post('campaign_status');
        if($campaign_id == '0'){            
            $search = $this->Media_admin_model->search_campaign_ads_all($campaign_id,$status);              
            if($search){
                echo json_encode($search);
            } else {
                echo json_encode(array('status' =>0));
            }
        } else {
            $search = $this->Media_admin_model->search_campaign_ads($campaign_id,$status);        
            if($search){                  
                echo json_encode($search);
            } else {
                echo json_encode(array('status' =>0));
            }
        }
           
    }

    /***************** developed update advertisment latitude and lontitude related information functionality  ******************/

    public function manage_target_ad() {
        
        //print_r(json_decode($this->input->post('array_ad'), true));
        $id = $this->input->post('ad_id');
        $data = json_decode(stripslashes($_POST['array_ad']), true);
        $final = '';
        foreach($data as $item){
            $final .= "".$item['lat'].",".$item['lng'].",";
           // insert to db
        }
        $ad_area = rtrim($final, ',');
        
        $update = $this->Media_admin_model->manage_target_ads($ad_area,$id);  
        if($update['status'] == '1'){
            echo json_encode(array('status' =>1));
        }  else {
            echo json_encode(array('status' =>0));
        }
        
    }

    /***************** this function is used to load payapal payment test page and this function is not in use   ******************/

    public function paypal_payment() {
        $this->load->view('common/paypal');
    }

}