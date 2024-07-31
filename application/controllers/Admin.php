<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
    }    
 

    public function view_admin_login() {
        $user_id = $this->session->userdata('users_id');
        $contract_id = $this->session->userdata('contract_id');
        $membership_id = $this->session->userdata('membershi_id');
        if($contract_id != ""){
            $this->Admin_model->deleteData('contract', array('id' =>$contract_id));       
            $this->session->unset_userdata('contract_id');    
        }
        if($membership_id!=""){
            $this->Admin_model->deleteData('membership', array('id' =>$membership_id));       
            $this->session->unset_userdata('membershi_id');    
        }
        if($user_id != ""){
            $this->Admin_model->deleteData('users', array('id' =>$user_id));       
            $this->session->unset_userdata('users_id');
        }
        $this->load->view('common/admin-login');   
    }

    public function home() {
        if($this->session->userdata('rydlr_admin_login')){
           $this->load->view('common/home');
        } else {
            redirect('admin/view_admin_login'); 
        }
    }
    public function admin_home() {
        if($this->session->userdata('rydlr_admin_login')){
           $this->load->view('common/admin-home');
        } else {
            redirect('admin/view_admin_login'); 
        }
    }

    public function login_admin() {
        $username = $this->input->post('username'); 
        $password = md5($this->input->post('password'));

        $login_credential = $this->Admin_model->rydlr_admin_login($username,$password);
    }

    public function view_new_password() {
        if($this->session->userdata('rydlr_admin_login')){
           $this->load->view('common/new-password');
        } else {
            redirect('admin/view_admin_login'); 
        }
    }

    public function change_new_password() {
        $password = md5($this->input->post('password'));
        $username = $this->input->post('username');
        $this->Admin_model->change_new_password($username,$password);
    }

    public function view_admin_register() {
        $user_id = $this->session->userdata('users_id');
        $contract_id = $this->session->userdata('contract_id');
        $membership_id = $this->session->userdata('membershi_id');
        if($contract_id != ""){
            $this->Admin_model->deleteData('contract', array('id' =>$contract_id));       
            $this->session->unset_userdata('contract_id');    
        }
        if($membership_id!=""){
            $this->Admin_model->deleteData('membership', array('id' =>$membership_id));       
            $this->session->unset_userdata('membershi_id');    
        }
        if($user_id != ""){
            $this->Admin_model->deleteData('users', array('id' =>$user_id));       
            $this->session->unset_userdata('users_id');
        }
        $this->load->view('common/admin-register');   
    }

    public function view_forget_username() {
        $this->load->view('common/forget-username');   
    }

    public function view_forgot_password() {
        $this->load->view('common/forget-password');   
    }

    public function view_admin_profile() {
        if($this->session->userdata('rydlr_admin_login')){
            $session = $_SESSION['rydlr_admin_login']; 
            $user_id = $session['admin_id'];
            $where = array('id' => $user_id);
            $data['users_profile_data']  = $this->Admin_model->getRowDataWithWhere('*','users',$where);
            $data['get_membership_details'] = $this->Admin_model->get_membership_details($user_id);
            $this->load->view('common/admin-profile',$data);      
        } else {
            redirect('admin/view_admin_login'); 
        }
    }

    public function view_admin_advertisment() {
        if($this->session->userdata('rydlr_admin_login')){
            $data['get_advertisment_details'] = $this->Admin_model->get_advertisement_result();
            $data['get_advertisment_campaigns'] = $this->Admin_model->get_advertisement_campaigns();
            $this->load->view('common/admin-advertisement',$data);         
        } else { 
            redirect('admin/view_admin_login'); 
        }   
    }

    public function view_add_admin_advertisement() {
        if($this->session->userdata('rydlr_admin_login')){
            $data['get_campaign_title'] = $this->Admin_model->get_campaign_details();
            $data['get_advertisment_campaigns'] = $this->Admin_model->get_advertisement_campaigns();
            $this->load->view('common/add-admin-advertisement', $data);            
        } else {
            redirect('admin/view_admin_login'); 
        }  
    }
    public function view_targets(){
        $this->load->view('common/target-advertise');            
    }   
    public function view_target_advertise() {
        if($this->session->userdata('rydlr_admin_login')){
            $campaign_name = $this->input->post('campaign_name');
            $ad_name = $this->input->post('ad_title');
            $this->load->view('common/target-advertise');            
            //redirect('admin/view_targets',$data); 
        } else {
            redirect('admin/view_admin_login'); 
        }   
    }

    public function view_edit_admin_advertisement() {
        if($this->session->userdata('rydlr_admin_login')){
            $id = $this->uri->segment(3);
            $data['get_campaign_title'] = $this->Admin_model->get_campaign_details();
            $data['get_advertisment'] = $this->Admin_model->get_advertisment_details_by_id($id);
            $this->load->view('common/edit-admin-advertisement',$data);            
        } else {
            redirect('admin/view_admin_login'); 
        }     
    }
 
    public function view_admin_campaigns() {
        if($this->session->userdata('rydlr_admin_login')){
            $data['get_campaign_data'] = $this->Admin_model->get_campaign_data();            
            $data['get_advertisement_count'] = $this->Admin_model->get_advertisement_count();
            //$data['get_contract'] = $this->Admin_model->get_contract();
            $this->load->view('common/admin-campaigns',$data);           
        } else {
            redirect('admin/view_admin_login'); 
        }  
    }

    public function view_add_admin_campaign() {
        if($this->session->userdata('rydlr_admin_login')){
            $this->load->view('common/add-admin-campaign');              
        } else {
            redirect('admin/view_admin_login'); 
        }  
    }

    public function view_admin_contract() { 
        if($this->session->userdata('rydlr_admin_login')){
            $session = $_SESSION['rydlr_admin_login']; 
            $user_id = $session['admin_id'];
            $data['get_contract_details'] = $this->Admin_model->get_contract_userids($user_id);
            $data['get_contract_detail'] = $this->Admin_model->get_contract_userid($user_id);

            $this->load->view('common/admin-contract',$data);                 
        } else {
            redirect('admin/view_admin_login'); 
        }  
    }

    public function view_admin_payment() {
        if($this->session->userdata('rydlr_admin_login')){
            $this->load->view('common/admin-payment');                    
        } else {
            redirect('admin/view_admin_login'); 
        }  
    }

    public function payment_invoice() {
        if($this->session->userdata('rydlr_admin_login')){
            $this->load->view('common/admin-payment-invoice');                    
        } else {
            redirect('admin/view_admin_login'); 
        }   
    }

    public function view_admin_report() {
        if($this->session->userdata('rydlr_admin_login')){
            $this->load->view('common/admin-report');                       
        } else {
            redirect('admin/view_admin_login'); 
        }  
    }

    public function logout() {
        $this->session->unset_userdata('rydlr_admin_login');
        redirect('admin/view_admin_login');
    }
    public function add_personal_details() {

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
            $users_id = $this->Admin_model->insertData('users', $data);
            if($users_id){
                $this->session->set_userdata("users_id", $users_id);
                $data = array(
                'admin_username' => $data['username'],
                'admin_password' => $data['password'],
                'admin_id' => $users_id
                );
                $this->session->set_userdata('rydlr_admin_login',$data); 

                echo json_encode(array('status' =>1));
            } else {
                echo json_encode(array('status' =>0));
            }
        } else {
             echo json_encode(array('status' =>0));   
        } 
        

      /*  if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            $file = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];
            $dest = "assets/client_logo/$file";
            $upload_dir = dirname($_SERVER["SCRIPT_FILENAME"]) ."/assets/client_logo/"; 
            if(move_uploaded_file($tmp, $upload_dir . $file)){  
                $data = array(
                    'media_agency_name' => $this->input->post('agency_name'),
                    'agent_name' => $this->input->post('agent_name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'username' => $this->input->post('username'),
                    'password' => md5($this->input->post('password')),
                    'client_logo' => $dest
                );
                $users_id = $this->Admin_model->insertData('users', $data);
                $this->session->set_userdata("users_id", $users_id);
            }
        } */


       /* $data = array(
            'media_agency_name' => $this->input->post('media_agency_name'),
            'agent_name' => $this->input->post('agent_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))
        ); */
        
        /* if($insert){
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        } */
    }

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

        $insert_membership = $this->Admin_model->insertData('membership', $insert_membership_data);
        $this->session->set_userdata("membershi_id", $insert_membership);
        if($insert_membership){
            $data = array(
            'contract_title' => $this->input->post('contract_title'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'user_id' => $user_id,
            'membership_id' => $this->session->userdata('membershi_id')
            );   

            $contract_id = $this->Admin_model->insertData('contract', $data);
            $this->session->set_userdata("contract_id", $contract_id);
        }
    }

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
        $insert_payment = $this->Admin_model->insertData('payment',$data);
        if($insert_payment){
            $this->session->unset_userdata('membershi_id');
            $this->session->unset_userdata('users_id');
            $this->session->unset_userdata('contract_id');

            $session = $_SESSION['rydlr_admin_login']; 
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

            $actual_link = base_url()."admin/activate_link/".$user_id;
            $subject = "User Registration Activation Email";
            //$message = "<h4><strong> Welcome to Rydlr </strong></h4>";
            //$message = "<h4><strong> Dear ".$ary['username']."</strong></h4>";
            //$message = "<h4><strong> Thanks for your registration </strong></h4>";
            $message = "<h4><strong> Welcome to Rydlr, </strong></h4>  <h4><strong> Dear ".$ary['username'].",</strong></h4> <h4><strong> Thanks for your registration. </strong></h4> Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
            $email = $ary['email'];   

            $this->sendemail($email,$subject,$message);
            
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        }
    }

    public function activate_link() {
        $id = $this->uri->segment('3'); 
        $update_link = $this->Admin_model->update_link($id);
        if($update_link['status'] == 1){
            redirect('admin/home');
        } else {
            redirect('admin/view_admin_login');
        }   
    }

    public function update_users_profile() {
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

            //$update_membership = $this->Admin_model->insertData('membership', $insert_membership_data);
            $membership_id = $this->input->post('membership_id');

            $this->db->where('id',$membership_id);
            $update_membership = $this->db->update('membership',$update_membership_data);

            //$where = array('id' => $membership_id);
            //$update_membership = $this->Admin_model->updateTabel($update_membership_data,'membership', $where);
            $data = array(
                'media_agency_name' => $this->input->post('media_agency_name'),
                'agent_name' => $this->input->post('agent_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'username' => $this->input->post('username'),
            );
            if($this->input->post('password') && $this->input->post('password') != 'dummypass'){
                $data['password'] = MD5($this->input->post('password'));
            }
            $where = array('id' => $user_id);
            $update = $this->Admin_model->updateTabel($data,'users', $where);
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
            );
            if($this->input->post('password') && $this->input->post('password') != 'dummypass'){
                $data['password'] = MD5($this->input->post('password'));
            }
            $where = array('id' => $user_id);
            $update = $this->Admin_model->updateTabel($data,'users', $where);
            if($update){
                echo json_encode(array('status' =>1));
            } else {
                echo json_encode(array('status' =>0));    
            }
        }

        

    }

    public function delete_campaign_detail() {
        $id = $this->input->post('campaign_id');
        $delete = $this->Admin_model->deleteData('campaign', array('id' =>$id));
        if($delete){
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        }
    }

    public function forgot_admin_username() {
        $email = $this->input->post('email');
        $temp_pwd = rand();
        if($email){
            $post_email = $this->Admin_model->forgot_admin_username($email, $temp_pwd);
            $get_email = $this->Admin_model->forgot_admin_username($email, $temp_pwd);
            $username = $get_email[0]['username'];
            $email_address = $get_email[0]['email'];

            $subject="Your Rydlr Account Information";
            $message="Below are your Rydlr account login details :- <br><br> UserID: $username <br><br> Temporary password: $temp_pwd <br><br> This email was sent as someone who has forgotten their rydlr username entered this email address as their own <br><br> <span style='color:red; margin-top:10px;'> Note :- You will be prompted to re-set your password when you login. </span>";

            $this->sendemails($email_address,$subject,$message);
            echo json_encode($get_email);
        }
    }

    public function forgot_admin_password() {
        $username = $this->input->post('username');
        $temp_pwd = rand();
        if($username){
            $post_email = $this->Admin_model->forgot_admin_password($username, $temp_pwd);
            $get_email = $this->Admin_model->forgot_admin_password($username, $temp_pwd);
            $email = $get_email[0]['email'];   
            $subject="Your Rydlr Account Information";
            $message="Below are your rydlr account login details :- <br><br>Temporary password: $temp_pwd <br><br> This email was sent as someone who has forgotten their rydlr password entered your rydlr user ID and requested a password re-set. <br><br> <span style='color:red; margin-top:10px;'> Note :- You will be prompted to re-set your password when you login. </span>";

            $this->sendemail($email,$subject,$message);
            echo json_encode($get_email);
        }
    }

    public function insert_campaign_detail() {
        $session = $_SESSION['rydlr_admin_login']; 
        $user_id = $session['admin_id'];
        $data=array(
            'title' => $this->input->post('campaign_title'),
            'budget' => $this->input->post('budget'),
            'status' => $this->input->post('status'),
            'user_id' => $user_id
            );
        $campaign = $this->Admin_model->insertData('campaign', $data);
        if($campaign){
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));    
        }
    }
//sources checking 
    public function insert_advertise_detail() {

        if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            $session = $_SESSION['rydlr_admin_login']; 
            $user_id = $session['admin_id'];
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

                $advertise = $this->Admin_model->insertData('advertise', $data);
                if($advertise){
                    echo json_encode(array('status' =>1));
                } else {
                    echo json_encode(array('status' =>0));    
                }
            }
        } 
    }

    public function update_advertise_detail() {

        if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            $session = $_SESSION['rydlr_admin_login']; 
            $user_id = $session['admin_id'];
            $file = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];
            $dest = "files/$file";
            $upload_dir = dirname($_SERVER["SCRIPT_FILENAME"]) ."/files/"; 
            if(move_uploaded_file($tmp, $upload_dir . $file)){ 
                $id = $this->input->post('ad_id'); 
                $data = array(
                    'campaign_id' => $this->input->post('campaign_id'),
                    'ad_title' => $this->input->post('ad_title'),
                    'ad_location' => $this->input->post('ad_location'),
                    'ad_file' => $dest,
                    'status' => $this->input->post('status'),
                    'user_id' => $user_id,
                );
                $update = $this->Admin_model->update_advertisement_detail($id, $data);
                if($update) {
                    echo json_encode(array('status' =>1));
                } else {
                    echo json_encode(array('status' =>0));    
                }   
            }
        } 
    }


    public function update_advertisement_detail() {
        $session = $_SESSION['rydlr_admin_login']; 
        $user_id = $session['admin_id'];
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
            $advertise = $this->Admin_model->insertData('advertise', $data);
            if($advertise){
                echo json_encode(array('status' =>1));
            } else {
                echo json_encode(array('status' =>0));    
            }
        }
    }

    function delete_ads() {
        $id = $this->input->post('advertise_id');
        $where = array('id'=> $id);
        $delete = $this->Admin_model->deleteData('advertise',$where);
        if($delete){
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        }
    }

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
            $delete = $this->Admin_model->deleteData('campaign',$where);
            if($delete){
                echo json_encode(array('status' =>1));
            }
        }
    }

    function update_campaign_details() {
        $id= $this->input->post('id');
        $data = array(
            'title' => $this->input->post('title'),
            'budget' => $this->input->post('budget'),
            'status' => $this->input->post('status'),
        );
        $where = array('id'=>$id);
        $update = $this->Admin_model->updateTabel($data,'campaign',$where);
        if($update){

            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        }
    }

    function sendemail($email,$subject,$message){
        $this->load->library('email');
        $this->email->from('sumit@xoomsolutions.com');
        $this->email->subject($subject);
        $this->email->to($email);
        $this->email->set_mailtype("html");
        $this->email->message($message);
        $this->email->send();
        return true;
    }    
    function sendemails($email_address,$subject,$message){
        $this->load->library('email');
        $this->email->from('sumit@xoomsolutions.com');
        $this->email->subject($subject);
        $this->email->to($email_address);
        $this->email->set_mailtype("html");
        $this->email->message($message);
        $this->email->send();
        return true;
    }    


    public function update_campaign_detail() {
        $campaign_id= $this->input->post('campaign_id');
        $data = array(
            'title' => $this->input->post('campaign_title'),
            'budget' => $this->input->post('budget'),
            'status' => $this->input->post('status'),
            );
        $where = array('id' => $campaign_id);
        $update = $this->Admin_model->updateTabel($data,'campaign', $where);
        if($update){
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));    
        }
    }

    public function search_campaign() {
        $campaign_id = $this->input->post('campaign_id');
        $status =  $this->input->post('campaign_status');

        $search = $this->Admin_model->search_campaign($campaign_id,$status);
        if($search){
            echo json_encode($search);
        } else {
            echo json_encode(array('status' =>0));
        }
    }
}