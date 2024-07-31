<?php   
defined('BASEPATH') OR exit('No direct script access allowed');

 require_once(APPPATH.'libraries/Africastalking.php');
 require_once(APPPATH.'libraries/Africastalking_payment.php');
    
class Ws_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Ws_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');        
    }   
     
  
    function driver_registration() {
        $response = array();
        $this->form_validation->set_rules('first_last_name', 'First and Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $register_driver = $this->Ws_model->driver_registration_model($post);
            if($register_driver['status'] == '11'){
                $response = array("status" => 0, "message" => 'Email and Username already exists');
            } else if($register_driver['status'] == '0'){
                $response = array("status" => 0, "message" => 'Email already exists');
            } else if($register_driver['status'] == '12'){
                $response = array("status" => 0, "message" => 'Mobile already exists');
            } else if($register_driver['status'] == '2'){
                $response = array("status" => 0, "message" => 'Username already exists');
            } else if($register_driver['status'] == '1'){
                $response = array("status" => 1, "message" => 'driver are registered now',"result" => $register_driver['result']);
            }
            return $this->sendResponse($response);  
        } 
    }

    function driver_login() {
        $response = array();
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $login_driver = $this->Ws_model->login_driver($post);
            if($login_driver['status'] == '1'){
                $response = array("status" => 1, "message" => 'driver login successfully','result' => $login_driver['result']);
            } else {
                $response = array("status" => 0, "message" => 'Invalid Username and Password');
            }
            return $this->sendResponse($response);  
        }
    }

	function update_driver_password(){
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else{
            $update = $this->Ws_model->update_driver_password();
            if($update['status'] == 1){
                $response = array("status" => 1, "message" => 'Password updated successfully.','result' => $update['result']);
            }elseif($update['status'] == 2){
                $response = array("status" => 0, "message" => 'Driver Id Not exists.');
            }else{
                $response = array("status" => 0, "message" => 'Password not updated.');
            }
            return $this->sendResponse($response);
        }
    }

    function rider_registration() {
        $response = array();
        $this->form_validation->set_rules('select_company', 'Select company', 'trim|required');
        $this->form_validation->set_rules('name', 'Password', 'trim|required');
        $this->form_validation->set_rules('start_location', 'Start Location', 'trim|required');
        $this->form_validation->set_rules('end_location', 'End Location', 'trim|required');
        $this->form_validation->set_rules('start_lat', 'Start Lat', 'trim|required');
        $this->form_validation->set_rules('start_long', 'Start Long', 'trim|required');
        $this->form_validation->set_rules('end_lat', 'End Lat', 'trim|required');
        $this->form_validation->set_rules('end_long', 'End Long', 'trim|required');
        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required');
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim');

        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $digits_needed=5;

            $otp=''; // set up a blank string

            $count=0;

            while ( $count < $digits_needed ) {
                $random_digit = mt_rand(0, 6);
                
                $otp .= $random_digit;
                $count++;
            }


            $recipients = "+254".$post['mobile_number']."";
            $RiderName = $_POST['name'];
            // $message    = "Curious to know what's hot at your destination? Enter ".$otp." on the tablet screen and interact with your favorite brands. RYDLR, Got You Moving";
       // $message = "Hi there".$post['name'].", ENTER ".$otp." on the TABLET SCREEN to ENJOY DISPLAY from YOUR FAVORITE BRANDS during YOUR RIDE. RYDLR, GOT YOU MOVING!";
            //OTP message update from client----07/12/2017...
            $message = "" .$RiderName.", Welcome to Rydlr display network. Enter ".$otp." on the tablet screen during your trip and enjoy hyperlocal content tailored just for you! T&C apply. https://goo.gl/A6bhJv";

            // $Africastalking1   = new Africastalking();

            // $test = $Africastalking1->sendSMS($recipients, $message); 
            // if($test == '1'){
            //     $register_rider = $this->Ws_model->register_rider($post,$otp);            
        
            //     if($register_rider['status'] == '1') {                    
            //         $response = array("status" => 1, "message" => 'rider are ready for ride now','result'=> $register_rider['result']);
            //     } else {
            //         $response = array("status" => 0, "message" => 'sorry ride are not able to ride');
            //     }
            // } else {
            //   $response = array("status" => 0, "message" => 'Please enter valid mobile number');    
            // }  
            //change by chirag 30-07-2018 
            $register_rider = $this->Ws_model->register_rider($post,$otp);            
        
            if($register_rider['status'] == '1') {                    
                $response = array("status" => 1, "message" => 'rider are ready for ride now','result'=> $register_rider['result']);
            } else {
                $response = array("status" => 0, "message" => 'sorry ride are not able to ride');
            }
            return $this->sendResponse($response);  
        }
    }

    // public function sendPayments() {
    //     $Africastalking1   = new Africastalking_payment();
    //     $productName = "Product1";
    //     $phoneNumber = "+254729306047";
    //     $currencyCode = "KES";
    //     $amount = 10.50;
        
    //     $test = $Africastalking1->sendPayment($productName,$phoneNumber,$currencyCode,$amount);
    // }

    function verify_otp() {
        $response = array();
        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required');
        $this->form_validation->set_rules('otp', 'OTP', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $verify_otp = $this->Ws_model->otp_verification($post);
            if($verify_otp['status'] == '1') {
                $response = array("status" => 1, "message" => 'OTP is successfully verified. Please proceed to next step');
            } else if($verify_otp['status'] == '2') {
                $response = array("status" => 0, "message" => 'This is not your registered mobile number. Please enter registered mobile number');
            } else {
                $response = array("status" => 0, "message" => 'Please enter correct OTP');
            }
            return $this->sendResponse($response);  
        }
    }

    function more_information_description() {
        $response = array();
        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('ad_id', 'Ad ID', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            

            $get_ad_description = $this->Ws_model->get_ad_description($post['ad_id']);
        	
            $descrition_value = '';
            if($get_ad_description['status'] == '1'){
            $descrition_value.= $get_ad_description['result'][0]['ad_description'];   

            $send_description = $descrition_value;
            
            if($send_description == ''){
                $send_description .= 'test description';
            }
            
            if($post['name'] == ''){
                $rider_name = '';
            }else{
                $rider_name = $post['name'];
            }

                if($post['mobile_number'] && $post['email']){
                    $email = $post['email'];
                    $ad_title = $get_ad_description['result'][0]['ad_title'];
                    $subject = "Your requested information for ".$ad_title." by id";
                    $message = "Hi there ".$rider_name.", ".$send_description."<br><br> Thank you,<br>Rydlr Team";
                    $send_email = $this->sendemail($email,$subject,$message);   

                    $recipients = "+254".$post['mobile_number']."";
                    $Africastalking1   = new Africastalking();
                    //$message = "Hi there ".$rider_name.", ".$send_description."<br><br> Thank you,<br>Rydlr Team";
                    
                    //$message = "Hi there ".$rider_name.", " .$send_description. " Thank you,Rydlr Team"; //chirag 05/09/2017
                    $message = $ad_title." says : ".$send_description.""; //chirag 30/04/2018

                    $test = $Africastalking1->sendSMS($recipients, $message); 
                    if($test == '1'){
                        $response = array('status' =>1,'message' => 'More information is sent to your mobile number '.$recipients.' and email address '.$email.''); 
                    } else {
                        $response = array("status" => 0, "message" => 'Please enter valid mobile number');    
                    }

                }
                else if ($post['mobile_number']) {
                    $recipients = "+254".$post['mobile_number']."";
                    $ad_title = $get_ad_description['result'][0]['ad_title'];
                   // $message = "Hi there ".$rider_name.", " .$send_description. " Thank you,Rydlr Team"; //chirag 05/09/2017
                     $message = $ad_title." says : ".$send_description.""; //chirag 30/04/2018
                    $Africastalking1   = new Africastalking();

                    $test = $Africastalking1->sendSMS($recipients, $message); 
                    if($test == '1'){
                        $response = array('status' =>1,'message' => 'More information is sent to your mobile number '.$recipients.''); 
                    } else {
                        $response = array("status" => 0, "message" => 'Please enter valid mobile number');    
                    }
                } else if ($post['email']) {
                    $email = $post['email'];
                    $ad_title = $get_ad_description['result'][0]['ad_title'];
                    $subject = "Your requested information for ".$ad_title." by id";
                    $message = "Hi there ".$rider_name.", ".$send_description."<br><br> Thank you,<br>Rydlr Team";
                    $send_email = $this->sendemail($email,$subject,$message);   
                    
                    if($send_email['status'] == '1'){
                        $response = array('status' =>1,'message' => 'More information is sent to your email address '.$email.''); 
                    } else {
                        $response = array('status' =>0,'message' => 'Please enter valid email address'); 
                    }
                }
                
                //$response = array('status' =>1,'message' => 'More information is sent to your email address '.$email.''); 
            } else {
                $response = array('status' =>0,'message' => 'Please enter correct Ad Id');
            }
            return $this->sendResponse($response); 
        }
    }

    function get_sync_ads_old() {
        $get_not_sync_ads = $this->Ws_model->get_sync_advertise();
        $response_arr = array();
        foreach($get_not_sync_ads as $get_latest_ad) {
            $ary['id'] = $get_latest_ad['id'];
            $ary['ad_title'] = $get_latest_ad['ad_title'];
            $ary['ad_file'] = base_url().$get_latest_ad['ad_file'];
            $ary['ad_file_img'] = base_url().$get_latest_ad['ad_file_img'];
            $ary['approval_status'] = $get_latest_ad['approval_status'];
            $ary['status'] = $get_latest_ad['status'];
            $ary['sync'] = $get_latest_ad['sync'];
            $ary['file_size'] = $get_latest_ad['video_size'];
            $response_arr[] = $ary;
        }
        if($response_arr){
            $response = array('status' =>1,'result' => $response_arr); 
        } else {
            $response = array('status' =>0,'message' => 'sorry no ad found'); 
        }
        return $this->sendResponse($response);
    }
    // get sync ads data for driver updated by chirag trivedi
    function get_sync_ads_driver() {

         $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        }else{

            $driver_id = $_POST['driver_id'];
            $get_not_sync_ads = $this->Ws_model->get_sync_advertise_driver($driver_id);

            if(isset($get_not_sync_ads['data_status'])){
                $response = array('status' =>0,'message' => 'sorry no ad found'); 

            }else{

                    $response_arr = $ary = array();
                    foreach($get_not_sync_ads as $get_latest_ad) {
                        $ary['id'] = $get_latest_ad['ad_id'];
                        $ary['ad_title'] = $get_latest_ad['ad_title'];
                        $ary['ad_file'] = base_url().$get_latest_ad['ad_file'];
                        $ary['ad_file_img'] = base_url().$get_latest_ad['ad_file_img'];
                        $ary['approval_status'] = $get_latest_ad['approval_status'];
                        $ary['status'] = $get_latest_ad['status'];
                        $ary['sync'] = $get_latest_ad['sync'];
                        $ary['file_size'] = $get_latest_ad['video_size'];
                        $response_arr[] = $ary;
                    }
                    if($response_arr){
                        $response = array('status' =>1,'result' => $response_arr); 
                    } else {
                        $response = array('status' =>0,'message' => 'sorry no ad found'); 
                    }
              
            }
           
              return $this->sendResponse($response);       
       
        }
    }

    function update_sync_ad_old () {
        $response = array();
        $this->form_validation->set_rules('ad_id', 'Ad ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $this->db->select('*');
            $this->db->from('advertise');
            $this->db->where('id',$post['ad_id']);
            $query=$this->db->get();
            if($query->num_rows() > 0) {
                $update_ads = $this->Ws_model->update_sync_advertise($post['ad_id']);
                if($update_ads['status'] == '1'){
                    $response = array('status' =>1,'result' => 'Ad sync successfully'); 
                } else if($update_ads['status'] == '2'){
                    $response = array('status' =>0,'result' => 'Ad already sync'); 
                } else {
                    $response = array('status' =>0,'result' => 'Please enter correct ad id'); 
                }
            } else {
                $response = array('status' => 0,'result' => 'Ad id not exists');     
            }
            
            return $this->sendResponse($response);
        }
    }

    // update sync ad for each driver updated by chirag trivedi
    function update_sync_ad_driver() {
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $this->form_validation->set_rules('ad_id', 'Ad ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $driver_id = $_POST['driver_id'];
            $ad_id = $_POST['ad_id'];

            $this->db->select('*');
            $this->db->from('driver_advertise');
            $this->db->where('ad_id',$ad_id);
            $this->db->where('driver_id',$driver_id);
            $query=$this->db->get();
            if($query->num_rows() > 0) {
                $update_ads = $this->Ws_model->update_sync_advertise_driver($ad_id,$driver_id);
                if($update_ads['status'] == '1'){
                    $response = array('status' =>1,'result' => 'Ad sync successfully'); 
                } else if($update_ads['status'] == '2'){
                    $response = array('status' =>0,'result' => 'Ad already sync'); 
                } else {
                    $response = array('status' =>0,'result' => 'Please enter correct ad id'); 
                }
            } else {
                $response = array('status' => 0,'result' => 'Ad id not exists');     
            }
            
            return $this->sendResponse($response);
        }
    }
// new function 07/09/17
function reset_sync_ad_old () {
        $response = array();
        $this->form_validation->set_rules('ad_id', 'Ad ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $this->db->select('*');
            $this->db->from('advertise');
            $this->db->where('id',$post['ad_id']);
            $query=$this->db->get();
            if($query->num_rows() > 0) {
                $update_ads = $this->Ws_model->reset_sync_advertise($post['ad_id']);
                if($update_ads['status'] == '1'){
                    $response = array('status' =>1,'result' => 'Ad sync successfully'); 
                } else if($update_ads['status'] == '2'){
                    $response = array('status' =>0,'result' => 'Ad already sync'); 
                } else {
                    $response = array('status' =>0,'result' => 'Please enter correct ad id'); 
                }
            } else {
                $response = array('status' => 0,'result' => 'Ad id not exists');     
            }
            
            return $this->sendResponse($response);
        }
    }
    // new ws for reset sync for driver 12/12/17.
    function reset_sync_ad_driver() {
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $this->form_validation->set_rules('ad_id', 'Ad ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $driver_id = $_POST['driver_id'];
            $ad_id = $_POST['ad_id'];

            $this->db->select('*');
            $this->db->from('driver_advertise');
            $this->db->where('ad_id',$ad_id);
            $this->db->where('driver_id',$driver_id);
            $query=$this->db->get();
            if($query->num_rows() > 0) {
                $update_ads = $this->Ws_model->reset_sync_advertise_driver($ad_id,$driver_id);
                if($update_ads['status'] == '1'){
                    $response = array('status' =>1,'result' => 'Ad sync successfully'); 
                } else if($update_ads['status'] == '2'){
                    $response = array('status' =>0,'result' => 'Ad already sync'); 
                } else {
                    $response = array('status' =>0,'result' => 'Please enter correct ad id'); 
                }
            } else {
                $response = array('status' => 0,'result' => 'Ad id not exists');     
            }
            
            return $this->sendResponse($response);
        }
    }


    function get_current_ad_schedule() {
        $get_current_ads = $this->Ws_model->get_current_advertise();
        $play_no = 1;
        $response_arr = array();
        foreach($get_current_ads as $get_latest_ad) {
            $ary['id'] = $get_latest_ad['id'];
            $ary['ad_title'] = $get_latest_ad['ad_title'];
            if($get_latest_ad['ad_file'] == ''){
                $ary['ad_file'] = '';   
            } else {
                $ary['ad_file'] = base_url().$get_latest_ad['ad_file'];    
            }
            if($get_latest_ad['ad_file_img'] == ''){
                $ary['ad_file_img'] = '';
            } else {
                $ary['ad_file_img'] = base_url().$get_latest_ad['ad_file_img'];    
            }
            
            $ary['approval_status'] = $get_latest_ad['approval_status'];
            $ary['status'] = $get_latest_ad['status'];
            $ary['sync'] = $get_latest_ad['sync'];
            $ary['play_number'] = ''.$play_no++.'';
            $ary['file_size'] = $get_latest_ad['video_size'];
            $response_arr[] = $ary;
        } 
        if($response_arr){
            $response = array('status' =>1,'result' => $response_arr); 
        } else {
            $response = array('status' =>0,'message' => 'sorry no ad found'); 
        }
        return $this->sendResponse($response);
    } 

    function get_current_ad_schedule_fixed_old() {  // no location based ads
        $get_current_ads = $this->Ws_model->get_current_advertise_fixed();
        $play_no = 1;
        $response_arr = array();
        foreach($get_current_ads as $get_latest_ad) {
            $ary['id'] = $get_latest_ad['id'];
            $ary['ad_title'] = $get_latest_ad['ad_title'];
            if($get_latest_ad['ad_file'] == ''){
                $ary['ad_file'] = '';   
            } else {
                $ary['ad_file'] = base_url().$get_latest_ad['ad_file'];    
            }
            if($get_latest_ad['ad_file_img'] == ''){
                $ary['ad_file_img'] = '';
            } else {
                $ary['ad_file_img'] = base_url().$get_latest_ad['ad_file_img'];    
            }
            
            $ary['approval_status'] = $get_latest_ad['approval_status'];
            $ary['status'] = $get_latest_ad['status'];
            $ary['sync'] = $get_latest_ad['sync'];
            $ary['play_number'] = ''.$play_no++.'';
            $ary['file_size'] = $get_latest_ad['video_size'];
            $response_arr[] = $ary;
        } 
        if($response_arr){
            $response = array('status' =>1,'result' => $response_arr); 
        } else {
            $response = array('status' =>0,'message' => 'sorry no ad found'); 
        }
        return $this->sendResponse($response);
    }

    //new WS for get current sd schedule fixed for each driver
    function get_current_ad_schedule_fixed_driver() {  // no location based ads
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        }else{

            $driver_id = $_POST['driver_id'];
            $get_current_ads = $this->Ws_model->get_current_advertise_fixed_driver($driver_id);
            $play_no = 1;
            $response_arr = array();
            foreach($get_current_ads as $get_latest_ad) {
                $ary['id'] = $get_latest_ad['ad_id'];
                $ary['ad_title'] = $get_latest_ad['ad_title'];
                if($get_latest_ad['ad_file'] == ''){
                    $ary['ad_file'] = '';   
                } else {
                    $ary['ad_file'] = base_url().$get_latest_ad['ad_file'];    
                }
                if($get_latest_ad['ad_file_img'] == ''){
                    $ary['ad_file_img'] = '';
                } else {
                    $ary['ad_file_img'] = base_url().$get_latest_ad['ad_file_img'];    
                }
                
                $ary['approval_status'] = $get_latest_ad['approval_status'];
                $ary['status'] = $get_latest_ad['status'];
                $ary['sync'] = $get_latest_ad['sync'];
                $ary['play_number'] = ''.$play_no++.'';
                $ary['file_size'] = $get_latest_ad['video_size'];
                $ary['video_duration'] = $get_latest_ad['video_duration'];
                $response_arr[] = $ary;
            } 

            $total_ad_duration = $this->Ws_model->get_total_ads_duration($driver_id);
            $lifetime_impression = $this->Ws_model->get_lifetime_impression($driver_id);
            if($response_arr){
                $response = array('status' =>1,'result' => $response_arr, 'total_ad_duration' => $total_ad_duration, 'lifetime_impression' => $lifetime_impression); 
            } else {
                $response = array('status' =>0,'message' => 'sorry no ad found'); 
            }
            return $this->sendResponse($response);
        }
    }

    public function trip_start() {
        $response = array();
        $this->form_validation->set_rules('trip_id', 'Trip ID', 'trim');

        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $insert= $this->Ws_model->start_trip($post['trip_id']);
            if($insert['status'] == '1') {
                $response = array("status" => 1, "trip_id" => $insert['result']);
            } else if($insert['status'] == '3') {
                $response = array("status" => 0, "message" => 'Incorrect Trip Id');   
            } else {
                $response = array("status" => 0, "message" => 'failed to insert a trip');    
            }
            return $this->sendResponse($response);
        }
    }

    public function trip_stop() {
        $response = array();
        $this->form_validation->set_rules('trip_id', 'Trip ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $stop_trip = $this->Ws_model->stop_trip($post['trip_id']);
            if($stop_trip['status'] == '1'){
                $response = array("status" => 1, "total_ads_played" => $stop_trip['result']);
            } else if($stop_trip['status'] == '2'){
                $response = array("status" => 0, "message" => 'incorrect trip id');
            } else {
                $response = array("status" => 0, "message" => 'failed to insert a trip');    
            }
            return $this->sendResponse($response);

        }
    }

    public function last_trip_details() {
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $check_exist = $this->Ws_model->last_trip_details($post);
            if($check_exist['status'] == '2') {
                $response = array("status" => 0, "message" => 'Incorrect Driver Id');   
            } else if($check_exist['status'] == '3'){

                $ary_data = array();
                $ary_data["trip_start_time"] = "00:00:00";
                $ary_data["trip_complete_time"] = "00:00:00";
                $ary_data["trip_duration"] = "00:00:00";

                $response = array("status" => 1, "message" => 'There is no driver data.', "result" => $ary_data);   
            } else if($check_exist['status'] == '1'){
                $response = array("status" => 1, "message" => 'Last trip data found successfully.', "result" => $check_exist['result']);   
            }
            return $this->sendResponse($response);
        }

    }

    public function update_view_ads() {
        $response = array();
        $this->form_validation->set_rules('trip_id', 'Trip ID', 'trim|required');
        $this->form_validation->set_rules('ad_id', 'Ad ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $update_view_ad = $this->Ws_model->update_view_ad($post);
            if($update_view_ad['status'] == '4') {
                $response = array("status" => 0, "message" => 'Incorrect Trip_id and Ad_id');   
            } else if($update_view_ad['status'] == '7') {
                $response = array("status" => 0, "message" => 'Trip not started');
            } else if($update_view_ad['status'] == '3') {
                $response = array("status" => 0, "message" => 'Incorrect Ad_id');
            } else if($update_view_ad['status'] == '2') {
                $response = array("status" => 0, "message" => 'Incorrect Trip ID');
            } else if($update_view_ad['status'] == '1') {
                $response = array("status" => 1, "message" => 'success');
            } else if($update_view_ad['status'] == '5') {
                $response = array("status" => 0, "message" => 'Sorry the trip has already been completed');
            } else if($update_view_ad['status'] == '0') {
                $response = array("status" => 0, "message" => 'failed to update');
            } else if($update_view_ad['status'] == '6') {
                $response = array("status" => 1, "message" => 'Sorry the trip has already been exists');
            } 
            return $this->sendResponse($response);
        }   
    }

    public function get_already_viewed_ads() {
        $response = array();
        $this->form_validation->set_rules('trip_id', 'Trip ID', 'trim|required');        
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $get_viewed_ads = $this->Ws_model->get_already_viewed_ads($post['trip_id']);
            if($get_viewed_ads['status'] == '1'){
                $response = array("status" => 1, "result" => $get_viewed_ads['result']);
            } else if($get_viewed_ads['status'] == '7') {
                $response = array("status" => 0, "message" => 'Trip not started');
            } else if($get_viewed_ads['status'] == '2') {
                $response = array("status" => 0, "message" => 'Incorrect Trip_id');
            } 
            // else if($get_viewed_ads['status'] == '3') {
            //     $response = array("status" => 0, "message" => 'Ad already sent');
            // }
             else if($get_viewed_ads['status'] == '4') {
                $response = array("status" => 0, "message" => 'Incorrect Trip_id');
            } else if($get_viewed_ads['status'] == '6') {
                $response = array("status" => 0, "message" => 'Sorry the trip has already been completed');
            }
            return $this->sendResponse($response);
        }
    }


    public function check_tablet_status() {
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');        
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $check_tablet_status = $this->Ws_model->check_tablet_status($post['driver_id']);
            if($check_tablet_status['status'] == '1'){
                $response = array("status" => 1, "result" => $check_tablet_status['result']);
            } else {
                 $response = array("status" => 0, "message" => 'Incorrect driver_id');   
            }

        }
        return $this->sendResponse($response);
    }

    public function make_tablet_on() {
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');        
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $make_tablet_on = $this->Ws_model->make_tablet_on($post['driver_id']);
            if($make_tablet_on['status'] == '1'){
                $response = array("status" => 1, "message" => "success");
            } else {
                 $response = array("status" => 0, "message" => 'Incorrect driver_id');   
            }

        }
        return $this->sendResponse($response);   
    }
    
    function forgot_password() {
        $response = array();
        $this->form_validation->set_rules('email', 'Email or Username', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $verify_otp = $this->Ws_model->forgot_password($post);
            if($verify_otp['status'] == '1') {
                $response = array("status" => 1, "message" => 'Password sent to your registered email id');
            } else if($verify_otp['status'] == '0') {
                $response = array("status" => 0, "message" => 'Incorrect username or email id');
            } 
            return $this->sendResponse($response);  
        }   
    }

    public function make_tablet_off() {
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');        
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $make_tablet_off = $this->Ws_model->make_tablet_off($post['driver_id']);
            if($make_tablet_off['status'] == '1'){
                $response = array("status" => 1, "message" => "success");
            } else {
                 $response = array("status" => 0, "message" => 'Incorrect driver_id');   
            }
        }
        return $this->sendResponse($response);  
    }

    function send_sms() {

        // $this->load->library('Africastalking');

        $digits_needed=5;

        $random_number=''; // set up a blank string

        $count=0;

        while ( $count < $digits_needed ) {
            $random_digit = mt_rand(0, 6);
            
            $random_number .= $random_digit;
            $count++;
        }

        $recipients = "+254729306047";

        // $message    = "Curious to know what's hot at your destination? Enter ".$random_number." on the tablet screen and interact with your favorite brands. RYDLR, Got You Moving";
        $message    = "Hello this is Message test";

        // $params = array(
        //         "recipients" => $recipients,
        //         "message" => $message
        // );

        // $this->load->library("Africastalking",$params);

        // $this->load->library('Africastalking');   

        // $this->Africastalking->sendMessage($recipients, $message);
        // $this->Africastalking->sendSMS($recipients, $message);

        $Africastalking1   = new Africastalking();

        //$Africastalking1->sendSMS($recipients, $message);
        $test = $Africastalking1->sendSMS($recipients, $message); 
        print_r($test);
    }

    function sending_email_test() {
        $email = 'sumit@xoomsolutions.com';
        $subject = 'mail work test';
        $message = 'Hello your email is working or not !!';
        $this->sendemail($email,$subject,$message);   
    }
    //////////////////////////////  Edit By Chirag  ////////////////////////////

    function GetTripStatus(){
                 
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');        
        $post = $this->input->post();
       
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else{
            $get_trip_status = $this->Ws_model->get_trip_status($post);
          
             if($get_trip_status['status'] == 1 ){
             $result = $get_trip_status['result'];          
            
             $result_array = $data = array();
            foreach ($result as $value){
                $data['id'] = $value->id;
                $data['driver_id'] = $value->driver_id;
                $data['rider_id'] = $value->rider_id;            
                $data['trip_started'] = $value->trip_started;
                $data['trip_complete'] = $value->trip_complete;
                $data['total_ads_played'] = $value->total_ads_played;
                $data['start_location'] = $value->start_location;
                $data['end_location'] = $value->end_location;
                $data['start_lat'] = $value->start_lat;
                $data['start_long'] = $value->start_long;
                $data['end_lat'] = $value->end_lat;
                $data['end_long'] = $value->end_long;
                $data['select_company'] = $value->select_company;
                $data['trip_start_time'] = $value->trip_start_time;
                $data['trip_complete_time'] = $value->trip_complete_time;
                $data['trip_duration'] = $value->trip_duration;
                $data['rider_email'] = " "; 
                $mobile_number = $this->Ws_model->get_mobileno($data['rider_id']);                
                $rider_name = $this->Ws_model->get_mobileno($data['rider_id']);                
                $data['rider_mobile'] = $mobile_number['mobile_number'];
                $data['rider_name'] = $rider_name['rider_name'];
                $result_array[] = $data; 
            }
            $data['result'] = $result_array;
                
                $response = array('status'=>1 ,"trip_started"=> 'yes',"result"=>$data['result']);

             }else{
                $response = array('status'=>0 ,"trip_started"=> 'no');
             }

                return $this->sendResponse($response);  
        }
    }

    function sendemail($email,$subject,$message){
        $this->load->library('email');        
        //$this->email->from('sumit@xoomsolutions.com');
        $this->email->from('sumit@xoomsolutions.com');
        $this->email->subject($subject);
        $this->email->to($email);
        $this->email->set_mailtype("html");
        $this->email->message($message);
        //$this->email->send();
        if($this->email->send()){
            $response = array("status"=> 1);
        }else {
            $response = array("status"=> 0);
        }
        
         return $response;
    
    }    

    

//this function is for insert data with multipal array.but one filed is not valid then hole array is not updated in dataase so its not consider hear the new function are created .
      /* public function ad_view_update_old() {
        $response=array();
        $post=$this->input->post();
        //$this->form_validation->set_rules('coach_id','Coach ID','trim|required');
            
            $this->form_validation->set_rules('driver_id','driver_id','trim|required');
            $this->form_validation->set_rules('rider_id','rider id','trim|required');
            $this->form_validation->set_rules('trip_id','trip id','trim|required');
           // $this->form_validation->set_rules('created_date','created date','trim|required');
            $this->form_validation->set_rules('adId','ad Id','trim|required');
            $this->form_validation->set_rules('adCompleteFlag','adComplete Flag','trim|required');
            $this->form_validation->set_rules('adImpressionFlag','adImpression Flag','trim|required');
            $this->form_validation->set_rules('moreInfoClickedFlag','moreInfoClicked Flag','trim|required');
            $this->form_validation->set_rules('moreInfoSubmitFlag','moreInfoSubmit Flag','trim|required');
            $this->form_validation->set_rules('adActualTime','adActual Time','trim|required');
            $this->form_validation->set_rules('adRiderTime','adRider Time','trim|required');
            $this->form_validation->set_rules('adImpression','ad Impression','trim|required');
            $this->form_validation->set_rules('adCount','ad Count','trim|required');


             
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } 
            else
             {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
             }
            return $this->sendResponse($response);
        } 
        else 
         {

            $driver_id = $post['driver_id'];
             $this->db->select('*');
        $this->db->from('driver_registration');
        $this->db->where('id',$post['driver_id']);
        $query = $this->db->get();

            
        if(!($query->num_rows() >= 1))
        {
                
                 $response = array("status" => 0, "message" => 'Driver id not found. Ad views are not updated');
        }
          else
          {
           
            $rider_id = $post['rider_id'];
             $this->db->select('*');
        $this->db->from('riders_detail');
        $this->db->where('id',$post['rider_id']);
        $query = $this->db->get();

            
        if(!($query->num_rows() >= 1))
        {
               
                 $response = array("status" => 0, "message" => 'rider id not found. Ad views are not updated');
        }
         else
         {  
            $trip_id = $post['trip_id'];
            $this->db->select('*');
        $this->db->from('driver_add_view_update');
        $this->db->where('trip_id',$post['trip_id']);
        $query = $this->db->get();

            
        if($query->num_rows() >= 1)
        {
                
                 $response = array("status" => 0, "message" => 'trip_id already exists. Ad views are not updated');
        }

        else {

           
            //$insert_flag = '0' ;
          //  $count_error = '0' ;
         
           // $created_date = $post['created_date'];

            $adId = $post['adId'];
           // $count_single_adId = count($adId);

            $adId_arr = $adId;
            $adIdes_id = explode(",", $adId_arr);
           // print_r()  $count_adId;
            //  exit();
            $count_adId = count($adIdes_id);
              //echo  $count_adId;
              //exit();  
           
            $adCompleteFlag = $post['adCompleteFlag']; 
            $adCompleteFlag_arr = $adCompleteFlag;
            $adCompleteFlages = explode(",", $adCompleteFlag_arr);
            $count_adCompleteFlag = count($adCompleteFlages);
            //print_r($count_adCompleteFlag);
            //die();
                     foreach($adCompleteFlages as $value){
                        
                        if($value != '0' && $value != '1')
                        {
                            

                            //$count_error = 0 + 1;
                            $response = array("status" => 0, "message" => 'adCompleteFlag must be 0 or 1. Ad views are not updated.');
                            //break;
                             return $this->sendResponse($response); 
                        }
                        //$insert_flag ;
                    }
                   
              

            $adImpressionFlag = $post['adImpressionFlag'];
           
            $adImpressionFlag_arr = $adImpressionFlag;
            $adImpressionFlages = explode(",", $adImpressionFlag_arr);
            $count_adImpressionFlag = count($adImpressionFlages);
                foreach($adImpressionFlages as $value){
                        if($value != '0' && $value != '1')
                        {
                            //$check_flag = false;
                            $response = array("status" => 0, "message" => 'adImpressionFlag must be 0 or 1. Ad views are not updated.');
                            //break;
                             return $this->sendResponse($response); 
                        }
                    }


          
            $moreInfoClickedFlag = $post['moreInfoClickedFlag'];
           
            $moreInfoClickedFlag_arr = $moreInfoClickedFlag;
            $moreInfoClickedFlages = explode(",", $moreInfoClickedFlag_arr);
            $count_moreInfoClickedFlag = count($moreInfoClickedFlages);
           foreach($moreInfoClickedFlages as $value){
                        if($value != '0' && $value != '1')
                        {
                            //$check_flag = false;
                            $response = array("status" => 0, "message" => 'moreInfoClickedFlag must be 0 or 1. Ad views are not updated.');
                            //break;
                             return $this->sendResponse($response); 
                        }
                    }
         
            $moreInfoSubmitFlag = $post['moreInfoSubmitFlag'];
           
            $moreInfoSubmitFlag_arr = $moreInfoSubmitFlag;
            $moreInfoSubmitFlages = explode(",", $moreInfoSubmitFlag_arr);
             $count_moreInfoSubmitFlag = count($moreInfoSubmitFlages);
            foreach($moreInfoSubmitFlages as $value){
                        if($value != '0' && $value != '1')
                        {
                            //$check_flag = false;
                            $response = array("status" => 0, "message" => 'moreInfoSubmitFlag must be 0 or 1. Ad views are not updated.');
                            //break;
                             return $this->sendResponse($response); 
                        }
                    }
           
            $adActualTime = $post['adActualTime'];

            $count_adActualTime = count($adActualTime);
            $adActualTime_arr = $adActualTime;
            $adActualTimees = explode(",", $adActualTime_arr);
            $count_adActualTime = count($adActualTimees);
        
            foreach($adActualTimees as $value) 
            {
                 
                if($value < 0)
                 {

                    $response = array("status" => 0, "message" => 'adActualTime  must be 0 or higher. Ad views are not updated.');
                    return $this->sendResponse($response); 
                 }   
            
                  
             }
                        
            

            $adRiderTime = $post['adRiderTime'];
            
            $adRiderTime_arr = $adRiderTime;
            $adRiderTimees = explode(",", $adRiderTime_arr);
            $count_adRiderTime = count($adRiderTimees);
            //Rider Time <= Actual Time * Ad count
            foreach($adRiderTimees as $value) 
            {
                  //  print_r($value);
                   // die();
                if($value < 0)
                 {

                    $response = array("status" => 0, "message" => 'adRiderTime  must be 0 or higher. Ad views are not updated.');
                    return $this->sendResponse($response); 
                 }   
            
                  
             }
          

            $adImpression = $post['adImpression'];
            $count_adImpression = count($adImpression);
            $adImpression_arr = $adImpression;
            $adImpressiones = explode(",", $adImpression_arr);
            $count_adImpression = count($adImpressiones);
                foreach($adImpressiones as $value) 
            {
                 
                if($value < 0)
                 {

                    $response = array("status" => 0, "message" => 'adImpression  must be 0 or higher .Ad views are not updated.');
                    return $this->sendResponse($response); 
                 }   
            
                  
             }
         

            $adCount = $post['adCount'];
            
            $adCount_arr = $adCount;
            $adCountes = explode(",", $adCount_arr); 
            $count_adCount = count($adCountes);
            //Rider Time <= Actual Time * Ad count
             foreach($adCountes as $value) 
            {
                 
                if($value < 0)
                 {

                    $response = array("status" => 0, "message" => 'adCount  must be 0 or higher .Ad views are not updated.');
                    return $this->sendResponse($response); 
                 }   
            
                  
             }
                
                //Rider Time <= Actual Time * Ad count
                $total = array();
                foreach ($adActualTimees as $key=>$price) {
                       $total[] = $price *$adCountes[$key];
                }
                if(!($adRiderTimees <= $total))
                    {
                        $response = array("status" => 0, "message" => 'adRiderTime should be less than or equal to adActualTime. Ad views are not updated.');
                        return $this->sendResponse($response);
                    }
                //print_r($total);
                //exit();
             

                //$multiply =  ($adActualTimees * $adCountes);
                    
                    
                    

                        if (!($count_adId == $count_adCompleteFlag ))
                         {  
                            //echo "count_adCompleteFlag not match";
                             $response = array("status" => 0, "message" => 'Ads views are not updated.');

                             //['status'] == '0';
                         }
                         else if (!($count_adId == $count_adImpressionFlag))
                         {  
                            $response = array("status" => 0, "message" => 'Ads views are not updated.');
                         }
                        else if (!($count_adId == $count_moreInfoClickedFlag ))
                         {  
                           $response = array("status" => 0, "message" => 'Ads views are not updated.');
                         }
                        else if (!($count_adId == $count_moreInfoSubmitFlag ))
                         {  
                            $response = array("status" => 0, "message" => 'Ads views are not updated.');
                         }
                         else if (!($count_adId == $count_adActualTime ))
                         {  
                            $response = array("status" => 0, "message" => 'Ads views are not updated.');
                         }
                         else if (!($count_adId == $count_adRiderTime ))
                         {  
                            $response = array("status" => 0, "message" => 'Ads views are not updated.');
                         }
                         else if (!($count_adId == $count_adImpression ))
                         {  
                            $response = array("status" => 0, "message" => 'Ads views are not updated.');
                         }
                         else if (!($count_adId == $count_adCount ))
                         {  
                            $response = array("status" => 0, "message" => 'Ads views are not updated.');
                         }
                       


                         else
                         {

            if(count($adIdes_id) > 1) {                
                for($a=0,$b=0,$c=0,$d=0,$e=0,$f=0,$g=0,$h=0,$i=0;
                 $a<=count($adIdes_id)-1, 
                 $b<=count($adCompleteFlages)-1,
                 $c<=count($adImpressionFlages)-1,
                 $d<=count($moreInfoClickedFlages)-1,
                 $e<=count($moreInfoSubmitFlages)-1,
                 $f<=count($adActualTimees)-1,
                 $g<=count($adRiderTimees)-1,
                 $h<=count($adImpressiones)-1,
                 $i<=count($adCountes)-1; $a++,$b++,$c++,$d++,$e++,$f++,$g++,$h++,$i++) {
            $driver_add_view_update = $this->Ws_model->driver_add_view_update_model($driver_id,$rider_id,$trip_id,$adIdes_id[$a],$adCompleteFlages[$b],$adImpressionFlages[$c],$moreInfoClickedFlages[$d],$moreInfoSubmitFlages[$e],$adActualTimees[$f],$adRiderTimees[$g],$adImpressiones[$h],$adCountes[$i]);
                }
            } else {
                $driver_add_view_update = $this->Ws_model->driver_add_view_update_model($driver_id,$rider_id,$trip_id,$adId,$adCompleteFlag,$adImpressionFlag,$moreInfoClickedFlag,$moreInfoSubmitFlag,$adActualTime,$adRiderTime,$adImpression,$adCount);
            }






        

        //   $driver_add_view_update = $this->Ws_model->driver_add_view_update_model($post);
            //$register_driver = $this->Ws_model->driver_registration_model($post);
              if($driver_add_view_update['status'] == '1'){
                $response = array("status" => 1, "message" => 'Ads views are updated.');
            }
        }
    }//when ststus is 0 put hear }
          }//driver id  
      }//rider id
            return $this->sendResponse($response);  
        } 



            

                   
        
    }
/*
===================================end of the function ad_view_update=================================================================================
*/
    
    

    
    
    
/*
==========================new()
*/  
  public function ad_view_update() {
        $response=array();
        $post=$this->input->post();
        //$this->form_validation->set_rules('coach_id','Coach ID','trim|required');
           
        $this->form_validation->set_rules('driver_id','driver_id','trim|required');
        $this->form_validation->set_rules('rider_id','rider id','trim|required');
        $this->form_validation->set_rules('trip_id','trip id','trim|required');
       // $this->form_validation->set_rules('created_date','created date','trim|required');
        $this->form_validation->set_rules('adId','ad Id','trim|required');
        $this->form_validation->set_rules('adCompleteFlag','adComplete Flag','trim|required');
        $this->form_validation->set_rules('adImpressionFlag','adImpression Flag','trim|required');
        $this->form_validation->set_rules('moreInfoClickedFlag','moreInfoClicked Flag','trim|required');
        $this->form_validation->set_rules('moreInfoSubmitFlag','moreInfoSubmit Flag','trim|required');
        $this->form_validation->set_rules('adActualTime','adActual Time','trim|required');
        $this->form_validation->set_rules('adRiderTime','adRider Time','trim|required');
        $this->form_validation->set_rules('adImpression','ad Impression','trim|required');
        $this->form_validation->set_rules('adCount','ad Count','trim|required');

             
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } 
            else
             {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
             }
            return $this->sendResponse($response);
        } 
        else{

        $driver_id = $post['driver_id'];
        $this->db->select('*');
        $this->db->from('driver_registration');
        $this->db->where('id',$post['driver_id']);
        $query = $this->db->get();
            
        if(!($query->num_rows() >= 1)){                
             $response = array("status" => 0, "message" => 'Driver id not found. Ad views are not updated');
             return $this->sendResponse($response); 
        }
          
           
        $rider_id = $post['rider_id'];
        $this->db->select('*');
        $this->db->from('riders_detail');
        $this->db->where('id',$post['rider_id']);
        $query = $this->db->get();            
        if(!($query->num_rows() >= 1)) {               
             $response = array("status" => 0, "message" => 'rider id not found. Ad views are not updated');
             return $this->sendResponse($response); 
        }
          
        $trip_id = $post['trip_id'];
        $this->db->select('*');
        $this->db->from('trip_details');
        $this->db->where('id',$post['trip_id']);
        $query = $this->db->get();
            
        if(!($query->num_rows() >= 1)){                
             $response = array("status" => 0, "message" => 'trip id not found. Ad views are not updated');
             return $this->sendResponse($response); 
        }

       
           
            //$insert_flag = '0' ;
            //$count_error = '0' ;
         
           // $created_date = $post['created_date'];

            $adId = $post['adId'];
            $adId_arr = $adId;
            $adIdes_id = explode(",", $adId_arr);
            $count_adId = count($adIdes_id);
           
            $adCompleteFlag = $post['adCompleteFlag']; 
            $adCompleteFlag_arr = $adCompleteFlag;
            $adCompleteFlages = explode(",", $adCompleteFlag_arr);
            $count_adCompleteFlag = count($adCompleteFlages);
            
            $adImpressionFlag = $post['adImpressionFlag'];
            $adImpressionFlag_arr = $adImpressionFlag;
            $adImpressionFlages = explode(",", $adImpressionFlag_arr);
            $count_adImpressionFlag = count($adImpressionFlages);
               
            $moreInfoClickedFlag = $post['moreInfoClickedFlag'];
            $moreInfoClickedFlag_arr = $moreInfoClickedFlag;
            $moreInfoClickedFlages = explode(",", $moreInfoClickedFlag_arr);
            $count_moreInfoClickedFlag = count($moreInfoClickedFlages);
         
            $moreInfoSubmitFlag = $post['moreInfoSubmitFlag'];
            $moreInfoSubmitFlag_arr = $moreInfoSubmitFlag;
            $moreInfoSubmitFlages = explode(",", $moreInfoSubmitFlag_arr);
            $count_moreInfoSubmitFlag = count($moreInfoSubmitFlages);
            
            $adActualTime = $post['adActualTime'];
            $count_adActualTime = count($adActualTime);
            $adActualTime_arr = $adActualTime;
            $adActualTimees = explode(",", $adActualTime_arr);
            $count_adActualTime = count($adActualTimees);
        
            $adRiderTime = $post['adRiderTime'];
            $adRiderTime_arr = $adRiderTime;
            $adRiderTimees = explode(",", $adRiderTime_arr);
            $count_adRiderTime = count($adRiderTimees);
            //Rider Time <= Actual Time * Ad count
        
            $adImpression = $post['adImpression'];
            $count_adImpression = count($adImpression);
            $adImpression_arr = $adImpression;
            $adImpressiones = explode(",", $adImpression_arr);
            $count_adImpression = count($adImpressiones);
                
            $adCount = $post['adCount'];    
            $adCount_arr = $adCount;
            $adCountes = explode(",", $adCount_arr); 
            $count_adCount = count($adCountes);
            
                            
                //validate count for all flags.

           if (!($count_adId == $count_adCompleteFlag ))
             {  
                //echo "count_adCompleteFlag not match";
                 $response = array("status" => 0, "message" => 'Ads views are not updated.');
                 return $this->sendResponse($response); 
                 //['status'] == '0';
             }
             else if (!($count_adId == $count_adImpressionFlag))
             {  
                $response = array("status" => 0, "message" => 'Ads views are not updated.');
                return $this->sendResponse($response); 
             }
            else if (!($count_adId == $count_moreInfoClickedFlag ))
             {  
               $response = array("status" => 0, "message" => 'Ads views are not updated.');
               return $this->sendResponse($response); 
             }
            else if (!($count_adId == $count_moreInfoSubmitFlag ))
             {  
                $response = array("status" => 0, "message" => 'Ads views are not updated.');
                return $this->sendResponse($response); 
             }
             else if (!($count_adId == $count_adActualTime ))
             {  
                $response = array("status" => 0, "message" => 'Ads views are not updated.');
                return $this->sendResponse($response); 
             }
             else if (!($count_adId == $count_adRiderTime ))
             {  
                $response = array("status" => 0, "message" => 'Ads views are not updated.');
                return $this->sendResponse($response); 
             }
             else if (!($count_adId == $count_adImpression ))
             {  
                $response = array("status" => 0, "message" => 'Ads views are not updated.');
                return $this->sendResponse($response); 
             }
             else if (!($count_adId == $count_adCount ))
             {  
                $response = array("status" => 0, "message" => 'Ads views are not updated.');
                return $this->sendResponse($response); 
             }
             
           $error_flag = 0;
           $invalid_count = 0;
                //all variabels for 0 index.
            for($a=0;$a<=count($adIdes_id)-1;$a++) {
                    //tack 0 index value for all variabels
                   // $adId = $post['adId'];
                    $add_no = $adIdes_id[$a];
                    //print_r($add_no);
                    //die();
                    $ad_com_flag = $adCompleteFlages[$a];
                    $ad_Impr_Flag=$adImpressionFlages[$a];
                    $more_Info_Click_Flag=$moreInfoClickedFlages[$a];
                    $more_Info_Sub_Flag=$moreInfoSubmitFlages[$a];
                    $ad_Actual_Time=$adActualTimees[$a];
                    $ad_Rider_Timees=$adRiderTimees[$a];
                    $ad_Impressiones=$adImpressiones[$a];
                    $ad_Countes=$adCountes[$a];
                     
                      //complit flag validation.
                    $this->db->select('*');
                    $this->db->from('advertise');
                    $this->db->where('id',$add_no);
                    $query = $this->db->get();
                       
                     // $sql = $this->db->last_query();
                     //print_r($query);
                    //  die();
                   
                         if(!($query->num_rows() >= 1)){
                                $msg .= "Ad id = '$add_no' views not updated due to invalid data - adid"; 
                                $error_flag = 1; 
                        }
                        //if addId not exiest in tabel than error flag = 1
                         else if($ad_com_flag != 0 && $ad_com_flag != 1)
                        {
                           
                            $msg .= "Ad id = '$add_no' views not updated due to invalid data - adCompleteFlag."; 
                             $error_flag = 1; 
                             
                        }  
                        else if($ad_Impr_Flag != 0 && $ad_Impr_Flag != 1)
                        {
                            $msg .= "Ad id = '$add_no' views not updated due to invalid data - adImpressionFlag."; 
                             $error_flag = 1; 
                            
                        }
                       else  if($more_Info_Click_Flag != 0 && $more_Info_Click_Flag != 1)
                        {
                            $msg .= "Ad id = '$add_no' views not updated due to invalid data - moreInfoClickedFlag."; 
                             $error_flag = 1; 
                            
                        }
                        
                       else if($more_Info_Sub_Flag != 0 && $more_Info_Sub_Flag != 1)
                        {
                            $msg .= "Ad id = '$add_no' views not updated due to invalid data - moreInfoSubmitFlag."; 
                             $error_flag = 1; 
                            
                        }
                         else if($ad_Actual_Time < 0)
                        {
                            $msg .= "Ad id = '$add_no' views not updated due to invalid data - adActualTime."; 
                             $error_flag = 1; 
                            
                            
                        } 
                      else  if($ad_Rider_Timees < 0)
                        {
                            $msg .= "Ad id = '$add_no' views not updated due to invalid data - adRiderTime ."; 
                             $error_flag = 1; 
                            
                        } 

                       else if($ad_Impressiones < 0)
                        {
                            $msg .= "Ad id = '$add_no' views not updated due to invalid data - adImpression."; 
                             $error_flag =1;                            
                            
                        } 
                       else  if($ad_Countes < 0)
                        {
                            $msg .= "Ad id = '$add_no' views not updated due to invalid data - adCount."; 
                             $error_flag =1; 
                                                        
                        } 
                       else{ //Rider Time <= Actual Time * Ad count
                        $total=($ad_Actual_Time*$ad_Countes);
                       // print_r($total);
                       // die();
                        if($ad_Rider_Timees > $total)
                        {
                            $msg .= "Ad id = '$add_no' views not updated due to invalid data - adRiderTime vs adActualTime."; 
                             $error_flag =1; 
                            
                        }
                    }    
                        if($error_flag == 1)
                        {

                               // $msg .= "Ad id = '$add_no' views not updated due to invalid data."; 
                                $error_flag = 0 ;
                                $invalid_count += 1;
                          }

                       else
                        {
                            //cost related update....
                             $adImpression_cost = $ad_Impressiones*0.032;
                            $adCount_cost = $ad_Countes*0.09;
                            $min = $ad_Rider_Timees / 60;
                            //$adViews_Earnings = $min*3;
                       		$adViews_Earnings = $min*0.7; //chirag 28-08-2018
                            //insert record in the database.
                            $driver_add_view_update = 
                            $this->Ws_model->driver_add_view_update_model
                            ($driver_id,$rider_id,$trip_id,$add_no,$ad_com_flag,$ad_Impr_Flag,$more_Info_Click_Flag,
                                $more_Info_Sub_Flag,$ad_Actual_Time,$ad_Rider_Timees,$ad_Impressiones,$ad_Countes,$adImpression_cost,$adCount_cost,$adViews_Earnings);
                              $msg .= "Ad id ='$add_no' views updated."; 
                              $error_flag = 0;
                        }
                       
                       
                }
                $invalid = array(
                                'notinsertedadcount' =>(string) $invalid_count,
                                //'totaltripduration' =>$query_total_trip_duration,
                                //'totaltrip' =>$total
                                );

                if($invalid_count==$count_adId)
                {
                   $response = array("status" => 0,"message" => $msg ,"result" => $invalid); 
                 //  return $this->sendResponse($response); 
                
                }
                else
                {
                    
                    $response = array("status" => 1,"message" => $msg,"result" =>$invalid);
                    //$response = array("status" => 1,"message" => $msg,"result" =>$invalid_count);
                    //return $this->sendResponse($response); 
                }
                return $this->sendResponse($response); 
            }
                
               // print_r($error_flag);
               // die();

          }

//end the above function................................


    public function get_trip_data() {
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $check_exist = $this->Ws_model->Get_Trip_Data($post);

            //print_r($check_exist);
            //die();


            if($check_exist['status'] == '2') {
                $response = array("status" => 0, "message" => 'Incorrect Driver Id');   
            } else if($check_exist['status'] == '3'){
                $response = array("status" => 0, "message" => 'There is no driver data.',"result" => $check_exist['result']);   
            } else if($check_exist['status'] == '1'){
                //$response = array("status" => 1, "result" => $check_exist['result']);
                  $response = array("status" => 1,"message" => 'driver data found successfully', "result" => $check_exist['result']);
                  //$response = array("status" => 1, "result" => $check_exist['result'],"result1"=>$check_exist['result2'],"totaltrip"=>$check_exist['totaltrip']);
               // print_r($response);
               // die();   
            }
            return $this->sendResponse($response);
        }

    }
    public function trip_log(){
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $driver_id = $_POST['driver_id'];

            $success = $this->Ws_model->get_trip_log($driver_id);
            if($success['status'] == 0){
                $response = array("status" => 0, "message" => 'No trip data found for this driver');
            }else{
                $response = array("status" => 1, "message" => "Trip data is sent successfully", "result" => $success['result']);
            }

            return $this->sendResponse($response);
        }

    }
    public function driver_earning_monthwise(){
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $this->form_validation->set_rules('month', 'Month', 'trim|required');
        $this->form_validation->set_rules('year', 'Year', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        }else{   

            $driver_id = $_POST['driver_id'];
            $month = $_POST['month'];
            $year = $_POST['year'];         

            $success = $this->Ws_model->driver_earning_monthwise();            
             if($success['status'] == 0){
                $response = array("status" => 0, "message" => 'No trip data found for this driver Id');
            }else if($success['status'] == 2){
                $response = array("status" => 0, "message" => 'trip data not available');
            }else{
                $response = array("status" => 1, "message" => "Earning data is sent successfully", "month"=>$month, "year" => $year, "result" => $success['result']);
            }

            return $this->sendResponse($response);

        }


    }
    public function company_ride_data(){
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');

        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        }else{
            $driver_id = $_POST['driver_id'];
            $company_name = trim($_POST['company_name']);

            $company_data = $this->Ws_model->get_company_ride_data($driver_id, $company_name);

            // echo $company_data['status'];
            // die();

            if($company_data['status'] == 2){
                $response = array("status" => 0, "message" => 'This Company name not exists' );
            }else if($company_data['status'] == 3){
                $response = array("status" => 0, "message" => 'This Driver Id not exists');
            }else{
               
                    $response = array("status" => 1, "message" => 'Company ride time found successfully', "result" => $company_data['result']);
                
            }

            return $this->sendResponse($response);
        }

    }
    public function Get_Driver_Payments(){
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        }else{ 

            $driver_id = $_POST['driver_id'];
            $payment_data = $this->Ws_model->get_driver_payments($driver_id);
            if($payment_data['status'] == 0){
                $response = array("status" => 0, "message" => 'No trip data found for this driver Id');
                echo "no data found";
            }else if($payment_data['status'] == 2){
                $response = array("status" => 0, "message" => 'No trip found for this driver Id');
            }else{
                $response = array("status" => 1, "message" => "success", "result" => $payment_data['result']);
            }
            return $this->sendResponse($response);
        }

    }

    //this function wil be get today completed trip data
    public function get_trip_data_today() {
        $response = array();
        $this->form_validation->set_rules('driver_id', 'Driver ID', 'trim|required');
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            if (empty($post)) {
                $response = array("status" => 0, "message" => 'Please provide all parameters');
            } else {
                $response = array("status" => 0, "message" => trim(validation_errors(' ', ' ')));
            }
            return $this->sendResponse($response);
        } else {
            $check_exist = $this->Ws_model->Get_Trip_Data_Today($post);
            if($check_exist['status'] == '2') {
                $response = array("status" => 0, "message" => 'Incorrect Driver Id');   
            } else if($check_exist['status'] == '3'){
                $response = array("status" => 0, "message" => 'There is no driver data.',"result" => $check_exist['result']);   
            } else if($check_exist['status'] == '1'){
                //$response = array("status" => 1, "result" => $check_exist['result']);
                  $response = array("status" => 1,"message" => 'driver data found successfully', "result" => $check_exist['result']);
                  //$response = array("status" => 1, "result" => $check_exist['result'],"result1"=>$check_exist['result2'],"totaltrip"=>$check_exist['totaltrip']);
               // print_r($response);
               // die();   
            }
            return $this->sendResponse($response);
        }

    }






    private function sendResponse($response) {
        header('Content-type: application/json');
        return(print json_encode($response));
        //return json_encode($response);
    }







}
         

                        
/*
                  
            $driver_add_view_update = $this->Ws_model->driver_add_view_update_model($driver_id,$rider_id,$trip_id,$adIdes_id[$a],$adCompleteFlages[$b],$adImpressionFlages[$c],$moreInfoClickedFlages[$d],$moreInfoSubmitFlages[$e],$adActualTimees[$f],$adRiderTimees[$g],$adImpressiones[$h],$adCountes[$i]);
                
             
                $driver_add_view_update = $this->Ws_model->driver_add_view_update_model($driver_id,$rider_id,$trip_id,$adId,$adCompleteFlag,$adImpressionFlag,$moreInfoClickedFlag,$moreInfoSubmitFlag,$adActualTime,$adRiderTime,$adImpression,$adCount);
        
*/