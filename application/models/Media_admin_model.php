<?php
 
class Media_admin_model extends CI_Model {

 function __construct() {
        parent::__construct();
        $this->load->library('email');
	}  
	
    function admin_login($username,$password) {
 
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $this->db->where('user_status','1');
        $this->db->where('activation_status','activate');
        $query_admin_credential = $this->db->get();

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $this->db->where('required_password_reset','Y');
        $this->db->where('user_status','0');
        $this->db->where('activation_status','activate');
        $query_new_password_y = $this->db->get();

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $this->db->where('required_password_reset','N');
        $this->db->where('user_status','0');
        $this->db->where('activation_status','activate');
        $query_new_password_n = $this->db->get();

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $this->db->where('required_password_reset','N');
        $this->db->where('user_status','2');
        $this->db->where('activation_status','activate');
        $query_enterprise_account = $this->db->get();

        if($query_admin_credential->num_rows() > 0){
            $query_admin_credential_result = $query_admin_credential->result();
            $user_id = $query_admin_credential_result[0]->id;
            $data = array(
            'admin_username' => $username,
            'admin_password' => $password,
            'admin_id' => $user_id
            );
            // var_dump($data);
            $this->session->set_userdata('rydlr_admin_login',$data);
            echo json_encode(array('status' =>'admin_data'));  
        } 
        else if($query_new_password_y->num_rows() > 0){
            $query_new_password_y_result = $query_new_password_y->result();
            $user_id = $query_new_password_y_result[0]->id;
            
            $data = array(
            'admin_username' => $username,
            'admin_password' => $password,
            'admin_id' => $user_id
            );
            var_dump($data);
            $this->session->set_userdata('admin_login',$data);
            echo json_encode(array('status' =>'new_password'));    
        } else if($query_new_password_n->num_rows() > 0) {

            $query_new_password_n_result = $query_new_password_n->result();
            $user_id = $query_new_password_n_result[0]->id;
            $data = array(
            'admin_username' => $username,
            'admin_password' => $password,
            'admin_id' => $user_id
            );
            $this->session->set_userdata('admin_login',$data);
            echo json_encode(array('status' =>1));    
        } else if($query_enterprise_account->num_rows() > 0){
            $query_enterprise_account_result = $query_enterprise_account->result();
            $user_id = $query_enterprise_account_result[0]->id;
            $data = array(
            'admin_username' => $username,
            'admin_password' => $password,
            'admin_id' => $user_id
            );
            $this->session->set_userdata('enterprise_account',$data);
            echo json_encode(array('status' =>'enterprise_account'));   
        }
        else {
            echo json_encode(array('status' =>0));       
        }

    }

    public function change_new_password($username,$password){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('required_password_reset', 'Y');
        $this->db->where('activation_status','activate');
        $this->db->limit(1);
        $query=$this->db->get();
        if($query->num_rows() > 0){
            $this->db->where('username',$username);
            $this->db->set('password',$password);
            $this->db->set('required_password_reset','N');
            $this->db->update('users');
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));    
        }
    }

    /*    $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $data = array(
            'username' => $username,
            'password' => $password
            );
            $this->session->set_userdata('admin_login',$data);
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        } 
    } */   

    function forgot_admin_username($email,$temp_pwd) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email',$email);
        $this->db->where('activation_status','activate');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $this->db->where('email',$email); 
            $this->db->set('password',md5($temp_pwd));
            $this->db->set('required_password_reset','Y');
            $this->db->update('users');
            return $query->result_array(); 
        } else {
            echo 'fail';
        }
    }

    function forgot_admin_password($username,$temp_pwd) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('activation_status','activate');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $this->db->where('username',$username); 
            $this->db->set('password',md5($temp_pwd));
            $this->db->set('required_password_reset','Y');
            $this->db->update('users');
            return $query->result_array(); 
        } else {
            echo 'fail';
        }
    }

    function get_personal_details($user_id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id',$user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getuserDetails($id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $data = $query->row();
        return $data;
    }

    function get_membership_details($user_id) {
        $this->db->select('*');
        $this->db->from('membership');
        $this->db->join('contract', 'contract.membership_id = membership.id'); 
        $this->db->join('users', 'users.id = contract.user_id'); 
        $this->db->join('payment', 'payment.contract_id = contract.id'); 
        $this->db->where('users.id',$user_id);
        $this->db->order_by('contract.created_on', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();          

        return $query->result_array();
    }
//start hear for campaig 



    function get_campaign_details() {
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

        $this->db->select('*');
        $this->db->from('campaign');
        $this->db->where('campaign.user_id',$user_id);
        $query = $this->db->get();          
        return $query->result_array();
    }



     function get_campaign_data() {
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
        $this->db->select('*');
        $this->db->from('campaign');
        $this->db->where('campaign.user_id',$user_id);
        $this->db->where('status','Active');
        $query = $this->db->get();          
        return $query->result_array();   
    }
    function get_all_campaign_data() {
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
        $this->db->select('*');
        $this->db->from('campaign');
        $this->db->where('campaign.user_id',$user_id);
        //$this->db->where('status','Active');
        $query = $this->db->get();          
        return $query->result_array();   
    }



 function get_advertisement_campaigns() {
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
        
        $this->db->select('*');
        $this->db->from('campaign');
        $this->db->where('campaign.user_id',$user_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result_array();
            foreach($result as $val){ 
                $ary['status'] = $val['status'];
            }
            if($ary['status'] == 'Active') {
//                 $this->db->select('*,advertise.id as ad_id,advertise.status as ad_status');
//                 $this->db->from('advertise');
//                 $this->db->join('campaign','advertise.campaign_id = campaign.id');
//                 $this->db->where('campaign.user_id',$user_id);
//                 $this->db->where('campaign.status','active');
//                 $query_campaign = $this->db->get();   
//                 $quro = $query_campaign->result_array();
//                 $data= array(
//                     'status' => 'active'
//                 );
//                 foreach($quro as $query_result){
//                     $arry['ad_id'] = $query_result['ad_id'];
                    
//                     $this->db->where('id',$query_result['ad_id']);
//                     $update = $this->db->update('advertise',$data);
                    
//                 }   
                
                $this->db->select('*');
                $this->db->from('campaign');
                $this->db->where('campaign.user_id',$user_id);
                $queryc = $this->db->get();
                return $queryc->result_array();
                
            } 
            if($ary['status'] == 'Inactive') {
//                 $this->db->select('*,advertise.id as ad_id,advertise.status as ad_status');
//                 $this->db->from('advertise');
//                 $this->db->join('campaign','advertise.campaign_id = campaign.id');
//                 $this->db->where('campaign.user_id',$user_id);
//                 $this->db->where('campaign.status','inactive');
//                 $query_campaigns = $this->db->get();   
//                 $quros = $query_campaigns->result_array();
//                 $data_chng= array(
//                     'status' => 'inactive'
//                 );
//                 foreach($quros as $query_results){
//                     $arrys['ads_id'] = $query_results['ad_id'];
                    
//                     $this->db->where('id',$query_results['ad_id']);
//                     $updates = $this->db->update('advertise',$data_chng);
                    
//                 }   

                $this->db->select('*');
                $this->db->from('campaign');
                $this->db->where('campaign.user_id',$user_id);
                $querys = $this->db->get();
                return $querys->result_array();
                
            } 

        } else {
            return $query->result_array();   
        }
    }



function search_campaign($campaign_id,$status) {
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
        $response = array();
        $this->db->select('*,campaign.id as campaign_id');
        $this->db->distinct();
        $this->db->from('campaign');
        $this->db->join('contract','contract.user_id = campaign.user_id');
        $this->db->where('campaign.user_id',$user_id);
        $this->db->where('campaign.id',$campaign_id);       
        $this->db->where('status',$status);   
        
        $query = $this->db->get(); 
        
        if($query->num_rows() > 0){
            $query_result = $query->result_array();
            
            foreach($query_result as $result_query){
                // $this->db->select('*');
                // $this->db->from('advertise');
                // $this->db->where('campaign_id',$result_query['campaign_id']);
                // $query_count = $this->db->get();
                // $count = $query_count->result();
                // print_r($count);
                // die();
                $ary['campaign_id'] = $result_query['campaign_id'];
                
                $this->db->select('*');
                $this->db->from('advertise');
                $this->db->where('campaign_id',$result_query['campaign_id']);
                $query = $this->db->get();
                $query_count = $query->num_rows();
                $ary['ads_count'] = $query_count;
            
                $ary['id'] = $result_query['id'];
                $ary['title'] = $result_query['title'];
                $ary['budget'] = $result_query['budget'];
                $ary['ad_spend'] = $this->get_campaign_ad_spend($result_query['campaign_id'],$user_id,$result_query['status']);
                $ary['status'] = $result_query['status'];
                $ary['contract_title'] = $result_query['contract_title'];
                $response[] = $ary;
            }
            
            return $response;   
           // $this->db->select('*');
           // $this->db->from('advertise');
           // $this->db->join('campaign', 'advertise.campaign_id = campaign.id'); 
           // $this->db->where('campaign.user_id',$user_id);
           // $query_count_ad = $this->db->get(); 
           // $query_count_ad_result = $query_count_ad->num_rows();
           // $ary['ad_total'] = $query_count_ad_result;
           // $response = $ary;
        } else {
            $response = '';
            return $response;   
        }

        
    } 
    


    public function search_all_campaign($campaign_id,$status){
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
        
        $this->db->select('*,campaign.id as campaign_id');
        $this->db->distinct();
        $this->db->from('campaign');
        $this->db->join('contract','contract.user_id = campaign.user_id');
        $this->db->where('campaign.user_id',$user_id);
        //if($campaign_id != '0'){
          //  $this->db->where('campaign.id',$campaign_id);
        //}
        if($status != ""){
            $this->db->where('campaign.status',$status);   
        }
        $query = $this->db->get(); 
        $response = array();    
        if($query->num_rows() > 0){
            $query_result = $query->result_array();
            
            foreach($query_result as $result_query){
                // $this->db->select('*');
                // $this->db->from('advertise');
                // $this->db->where('campaign_id',$result_query['campaign_id']);
                // $query_count = $this->db->get();
                // $count = $query_count->result();
                // print_r($count);
                // die();
                $ary['campaign_id'] = $result_query['campaign_id'];
                
                $this->db->select('*');
                $this->db->from('advertise');
                $this->db->where('campaign_id',$result_query['campaign_id']);
                $query = $this->db->get();
               // echo $this->db->last_query();
              //  die();
                $query_count = $query->num_rows();
                $ary['ads_count'] = $query_count;
            
                $ary['id'] = $result_query['id'];
                $ary['title'] = $result_query['title'];
                $ary['budget'] = $result_query['budget'];
                $ary['status'] = $result_query['status'];
                $ary['ad_spend'] = $this->get_campaign_ad_spend($result_query['campaign_id'],$user_id,$result_query['status']);
                $ary['contract_title'] = $result_query['contract_title'];
                $response[] = $ary;
            }
            
           // $this->db->select('*');
            //$this->db->from('advertise');
            ///$this->db->join('campaign', 'advertise.campaign_id = campaign.id'); 
            //$this->db->where('campaign.user_id',$user_id);
           // $query_count_ad = $this->db->get(); 
           // $query_count_ad_result = $query_count_ad->num_rows();
           // $ary['ad_total'] = $query_count_ad_result;
           // $response = $ary;
        //print_r($response);
        //die();
        return $response;       
        } else {
            $response = '';
        return $response;   
        }
        
        
    }
    function get_campaign_ad_spend($campaign_id,$user_id,$status){
        $total_t = 0;
                
              $this->db->select('driver_add_view_update.adImpression_cost,driver_add_view_update.adCount_cost,advertise.spend,advertise.id as advertise_id,campaign.id as campaign_id,driver_add_view_update.id as driver_ad_id');
              $this->db->from('advertise');
              $this->db->join('campaign','advertise.campaign_id = campaign.id');
              $this->db->join('users','users.id = advertise.user_id');
              $this->db->join('driver_add_view_update','driver_add_view_update.adId = advertise.id');
              $this->db->where('campaign.id',$campaign_id);              
              $this->db->where('campaign.status',$status);
              $this->db->where('campaign.user_id',$user_id);
              //$this->db->where('advertise.user_id',$user_id);
              $query_data = $this->db->get();
              $result_data = $query_data->result_array();
              foreach ($result_data as $final_data) {
                      if($final_data['spend'] == "CPV"){
                        $adImpression_cost = 0;
                      }else{
                        $adImpression_cost = $final_data['adImpression_cost'];
                      }

                      if($final_data['spend'] == "CPM"){
                        $adCount_cost = 0;
                      }else{
                        $adCount_cost = $final_data['adCount_cost'];
                      }
                      $total_t += $adImpression_cost + $adCount_cost;

                      
                }
                  $sum_t = round($total_t,2);
                  return $sum_t;

    }
    



























    function get_contract_userid($user_id) {
        $this->db->select('*,contract.id as contract_id');
        $this->db->from('contract');
        $this->db->join('users', 'users.id = contract.user_id'); 
        $this->db->join('membership', 'membership.id = contract.membership_id'); 
        $this->db->where('users.id',$user_id);
        $query = $this->db->get();          
        return $query->result_array();
    }
    
    function get_contract_userids($user_id) {
        $this->db->select('*');
        $this->db->from('contract');
        $this->db->join('users', 'users.id = contract.user_id'); 
        $this->db->join('membership', 'membership.id = contract.membership_id'); 
        $this->db->where('users.id',$user_id);
        $this->db->order_by("contract.id","desc");
        $this->db->limit(1);
        //$this->db->where('users.id',$user_id);
        $query = $this->db->get();          
        return $query->result_array();
    }

    function get_all_contract_userid() {
        $this->db->select('*');
        $this->db->from('contract');
        $this->db->join('users', 'users.id = contract.user_id'); 
        $this->db->join('membership', 'membership.id = contract.membership_id'); 
        $query = $this->db->get();          
        return $query->result_array();
    }

   

    function get_advertisement_result() {
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
        $this->db->select('*,advertise.id AS advertise_id,advertise.status as ad_status');
        $this->db->from('advertise');
        $this->db->join('campaign', 'advertise.campaign_id = campaign.id'); 
        $this->db->join('users','advertise.user_id = users.id');
    	$this->db->where('advertise.status','Active');
        $this->db->where('advertise.user_id',$user_id);
        $query = $this->db->get();	
    	return $query->result_array(); 
       // return $query->result();   
    }
     function get_advertisement_result_total() {
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
        $this->db->select('*,advertise.id AS advertise_id,advertise.status as ad_status');
        $this->db->from('advertise');
        $this->db->join('campaign', 'advertise.campaign_id = campaign.id'); 
        $this->db->join('users','advertise.user_id = users.id');
        $this->db->where('campaign.status','Active');
        $this->db->where('advertise.user_id',$user_id);
        $query = $this->db->get();  
        // $sql = $this->db->last_query();
            //     print_r($sql);
         //        die();
       // return $query->result_array(); 
        return $query->result();   
    }

         
       function get_advertisement_result_totalads($id) {
       // return $id;
          

        $this->db->select_sum('adCount');
        $this->db->from('driver_add_view_update');
        $this->db->where('adId',$id);
     //  $this->db->order_by('adCount', 'ASC');
        $query = $this->db->get();  

       //return $this->db->last_query();

         $yy=  $query->row();
         $val = $yy->adCount;
         return  $val;
      
     }

       function get_advertisement_result_totalImpression($id) {
       // return $id;
          

        $this->db->select_sum('adImpression');
        $this->db->from('driver_add_view_update');
        $this->db->where('adId',$id);
        $query = $this->db->get();  

       //return $this->db->last_query();

         $yy1=  $query->row();
         $val1 = $yy1->adCount;
         return  $val1;
      
     }



       function get_contract() {
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
        $this->db->select('*');
        $this->db->from('contract');
        $this->db->where('user_id',$user_id);
        $query = $this->db->get();          
        return $query->result_array();
    }

    function get_advertisement_count() {
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
        $this->db->select('*');
        $this->db->from('advertise');
        $this->db->join('campaign', 'advertise.campaign_id = campaign.id'); 
        $this->db->where('campaign.user_id',$user_id);
        $query = $this->db->get();          

        return $query->num_rows();     
    }

    function get_advertisment_details_by_id($id) {
        $this->db->select('*');
        $this->db->from('advertise');
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->result_array();   
    }

    
	
    public function search_campaign_analytics($campaign_id,$status,$report_id){ 
         
    if(isset($_SESSION['admin_login'])){  
        $session = $_SESSION['admin_login']; 
        $user_id = $session['admin_id'];
        $this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status, advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title');
        $this->db->from('advertise');
        $this->db->join('campaign','advertise.campaign_id = campaign.id');
       // $this->db->join('driver_add_view_update','advertise.id = driver_add_view_update.adId');

        if($campaign_id!=""){
            $this->db->where('advertise.campaign_id',$campaign_id);    
        }
        if($status != ""){
            $this->db->where('campaign.status',$status);
        }
        $this->db->where('advertise.user_id',$user_id);
        $query = $this->db->get();
        $response = array();
        if($query->num_rows() > 0){
            $query_result = $query->result_array();
            foreach($query_result as $result_query){
                $ary['id'] = $result_query['id'];
                   
                            $this->db->select('status');
                            $this->db->from('campaign');
                            $this->db->where('id',$campaign_id);
                            $query = $this->db->get();
                            $camp_status = $query->row('status');
                            $ary['camp_status'] = $camp_status;
                             //  echo $status;
                             //die();
                            //$campaign_status = $query->row();
                           // $camp_val = $campaign_status->status;
                             //echo $this->db->last_query();
                             //die();



                 if($report_id == 0)
                {


                            $this->db->select_sum('adCount');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $ad_count = $query->row();
                            $val = $ad_count->adCount;
                             if($val == null){
                                $val = 0;
                            }else{
                                $val = $val;
                            }
                            $ary['adviews'] = $val;
                     }

                else if($report_id == 1)
                {   

                            $this->db->select_sum('adImpression');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $ad_Impression = $query->row();
                            $val1 = $ad_Impression->adImpression;
                             if($val1 == null){
                                $val1 = 0;
                            }else{
                                $val1 = $val1;
                            }

                        //  $val1 = "impress";
                            $ary['adviews'] = $val1;
                }
                 else if($report_id == 2)
                {   
                            
                           $this->db->select('sum(adRiderTime*adCount) as duration',FALSE);
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $adDuration = $query->row();
                            //echo $this->db->last_query();
                           // print_r($adDuration);
                            //die();
                            $val2 = $adDuration->duration;
                             if($val2 == null){
                                $val2 = 0;
                            }else{
                                $val2 = $val2;
                            }

                        //  $val1 = "impress";
                            $ary['adviews'] = $val2;
                }
                 else if($report_id == 3)
                {
                            $this->db->select_sum('adImpression_cost');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $ad_Impression_cost = $query->row();
                            $val3 = $ad_Impression_cost->adImpression_cost;
                              if($val3 == null){
                                 $val3 = round(0.00, 2);
                            }else{
                               $val3 = round($val3, 2);
                            }
                   // SELECT (adRiderTime * adCount) FROM `driver_add_view_update` WHERE adId=199
                   // $val3 = "gjgjgjgjjgj";
                            if($result_query['spend'] == "CPV"){
                                $val3 = 0;
                            }
                    $ary['adviews1'] = $val3;

                    $this->db->select_sum('adCount_cost');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $adCount_cost = $query->row();
                            $val4 = $adCount_cost->adCount_cost;
                             if($val4 == null){
                                $val4 = round(0.00, 2);
                            }else{
                                $val4 = round($val4, 2);
                            }
                            if($result_query['spend'] == "CPM"){
                                $val4 = 0;
                            }
                              $ary['adviews2'] = $val4;
                            
                
                    // $this->db->select('sum(adImpression_cost + adCount_cost) as total_cost',FALSE);
                    //         $this->db->from('driver_add_view_update');
                    //         $this->db->where('adId',$result_query['id']);
                    //         $query = $this->db->get();
                    //         $total_cost = $query->row();
                    //         $val5 = $total_cost->total_cost;
                    //         if($val5 == null){
                    //             //$val5 = 0.00;
                    //              $val5 = round(0.00, 2);
                    //         }else{
                    //             //$val5 = $val5;
                    //              $val5 = round($val5, 2);
                    //         }
                            $val5 = $val3 + $val4;
                              $ary['adviews3'] = $val5;



                }
               
                else
                {
                    $val6 = "345";
                     $ary['adviews'] = $val6;
                }
                    
               // $ary['adviews'] = $val;


                $ary['ad_title'] = $result_query['ad_title'];
                $ary['status'] = $result_query['status'];
                $ary['title'] = $result_query['title'];
                $ary['approval_status'] = $result_query['approval_status'];
                $response[] = $ary;

            }

        } else {
            $response = '';
        }

        return $response;
    } else if(isset($_SESSION['enterprise_account'])){
        $session = $_SESSION['enterprise_account']; 
        $user_id = $session['admin_id'];
        $this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status, advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title');
        $this->db->from('advertise');
        $this->db->join('campaign','advertise.campaign_id = campaign.id');
        if($campaign_id!=""){
            $this->db->where('advertise.campaign_id',$campaign_id);    
        }
        if($status != ""){
            $this->db->where('campaign.status',$status);
        }
        $this->db->where('advertise.user_id',$user_id);
        $query = $this->db->get();
        $response = array();
        if($query->num_rows() > 0){
            $query_result = $query->result_array();
            foreach($query_result as $result_query){
                $ary['id'] = $result_query['id'];

                        $this->db->select('status');
                            $this->db->from('campaign');
                            $this->db->where('id',$campaign_id);
                            $query = $this->db->get();
                            $camp_status = $query->row('status');
                            $ary['camp_status'] = $camp_status;



                 if($report_id == 0)
                {

                        $this->db->select_sum('adCount');
                        $this->db->from('driver_add_view_update');
                        $this->db->where('adId',$result_query['id']);
                        $query = $this->db->get();
                        $ad_count = $query->row();
                        $val = $ad_count->adCount;
                         if($val == null){
                            $val = 0;
                        }else{
                            $val = $val;
                        }
                         $ary['adviews'] = $val;

                }

                else if($report_id == 1)
                {
                            $this->db->select_sum('adImpression');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $ad_Impression = $query->row();
                            $val1 = $ad_Impression->adImpression;
                             if($val1 == null){
                                $val1 = 0;
                            }else{
                                $val1 = $val1;
                            }

                        //  $val1 = "impress";
                            $ary['adviews'] = $val1;

                }
                 else if($report_id == 2)
                {   
                            
                           $this->db->select('sum(adRiderTime*adCount) as duration',FALSE);
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $adDuration = $query->row();
                            //echo $this->db->last_query();
                           // print_r($adDuration);
                            //die();
                            $val2 = $adDuration->duration;
                             if($val2 == null){
                                $val2 = 0;
                            }else{
                                $val2 = $val2;
                            }

                        //  $val1 = "impress";
                            $ary['adviews'] = $val2;
                }
                 else if($report_id == 3)
                {
                            $this->db->select_sum('adImpression_cost');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $ad_Impression_cost = $query->row();
                            $val3 = $ad_Impression_cost->adImpression_cost;
                              if($val3 == null){
                                 $val3 = round(0.00, 2);
                            }else{
                               $val3 = round($val3, 2);
                            }
                   // SELECT (adRiderTime * adCount) FROM `driver_add_view_update` WHERE adId=199
                   // $val3 = "gjgjgjgjjgj";
                            if($result_query['spend'] == "CPV"){
                                $val3 = 0;
                            }
                    $ary['adviews1'] = $val3;

                    $this->db->select_sum('adCount_cost');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $adCount_cost = $query->row();
                            $val4 = $adCount_cost->adCount_cost;
                            if($val4 == null){
                                $val4 = round(0.00, 2);
                            }else{
                                $val4 = round($val4, 2);
                            }
                            if($result_query['spend'] == "CPM"){
                                $val4 = 0;
                              
                            }
                        $ary['adviews2'] = $val4;
                    // $this->db->select('sum(adImpression_cost + adCount_cost) as total_cost',FALSE);
                    //         $this->db->from('driver_add_view_update');
                    //         $this->db->where('adId',$result_query['id']);
                    //         $query = $this->db->get();
                    //         $total_cost = $query->row();
                    //         $val5 = $total_cost->total_cost;
                    //           if($val5 == null){
                    //             //$val5 = 0.00;
                    //              $val5 = round(0.00, 2);
                    //         }else{
                    //             //$val5 = $val5;
                    //              $val5 = round($val5, 2);
                    //         }
                            $val5 = $val3 + $val4;
                              $ary['adviews3'] = $val5;



                }
               
                else
                {
                    $val6 = "678";
                     $ary['adviews'] = $val6;
                }


                //$ary['adviews'] = $val;


                $ary['ad_title'] = $result_query['ad_title'];
                $ary['status'] = $result_query['status'];
                $ary['title'] = $result_query['title'];
                $ary['approval_status'] = $result_query['approval_status'];
                $response[] = $ary;
            }
        } else {
            $response = '';
        }

        return $response;
    } else if(isset($_SESSION['rydlr_admin_login'])){
        $session = $_SESSION['rydlr_admin_login']; 
        $user_id = $session['admin_id'];
        $this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status,advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title, users.media_agency_name');
        $this->db->from('advertise');
        $this->db->join('campaign','advertise.campaign_id = campaign.id');
        $this->db->join('users','users.id = advertise.user_id');
        if($campaign_id!=""){
            $this->db->where('advertise.campaign_id',$campaign_id);    
        }
        if($status != ""){
            $this->db->where('campaign.status',$status);
        }
        //$this->db->where('advertise.user_id',$user_id);
        $query = $this->db->get();
        $response = array();
        if($query->num_rows() > 0){
            $query_result = $query->result_array();
            foreach($query_result as $result_query){
                $ary['id'] = $result_query['id'];



                            $this->db->select('status');
                            $this->db->from('campaign');
                            $this->db->where('id',$campaign_id);
                            $query = $this->db->get();
                            $camp_status = $query->row('status');
                            $ary['camp_status'] = $camp_status;


                if($report_id == 0)
                {


                
                        $this->db->select_sum('adCount');
                        $this->db->from('driver_add_view_update');
                        $this->db->where('adId',$result_query['id']);
                        $query = $this->db->get();
                        $ad_count = $query->row();
                        $val = $ad_count->adCount;
                        if($val == null){
                            $val = 0;
                        }else{
                            $val = $val;
                        }
                         $ary['adviews'] = $val;
                }
                else if($report_id == 1)
                {
                            $this->db->select_sum('adImpression');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $ad_Impression = $query->row();
                            $val1 = $ad_Impression->adImpression;
                             if($val1 == null){
                                $val1 = 0;
                            }else{
                                $val1 = $val1;
                            }

                        //  $val1 = "impress";
                            $ary['adviews'] = $val1;
                }
                else if($report_id == 2)
                {   
                            
                           $this->db->select('sum(adRiderTime*adCount) as duration',FALSE);
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $adDuration = $query->row();
                            //echo $this->db->last_query();
                           // print_r($adDuration);
                            //die();
                            $val2 = $adDuration->duration;
                             if($val2 == null){
                                $val2 = 0;
                            }else{
                                $val2 = $val2;
                            }

                        //  $val1 = "impress";
                            $ary['adviews'] = $val2;
                }
                 else if($report_id == 3)
                {
                            $this->db->select_sum('adImpression_cost');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $ad_Impression_cost = $query->row();
                            $val3 = $ad_Impression_cost->adImpression_cost;
                              if($val3 == null){
                                 $val3 = round(0.000000, 2);
                            }else{
                               $val3 = round($val3, 2);
                            }
                   // SELECT (adRiderTime * adCount) FROM `driver_add_view_update` WHERE adId=199
                   // $val3 = "gjgjgjgjjgj";
                            if($result_query['spend'] == "CPV"){
                                $val3 = 0;
                            }
                    $ary['adviews1'] = $val3;

                    $this->db->select_sum('adCount_cost');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $adCount_cost = $query->row();
                            $val4 = $adCount_cost->adCount_cost;
                             if($val4 == null){
                                $val4 = round(0.00000, 2);
                            }else{
                                $val4 = round($val4, 2);
                            }

                            if($result_query['spend'] == "CPM"){
                                $val4 = 0;
                            }
                              $ary['adviews2'] = $val4;
                            
                
                    // $this->db->select('sum(adImpression_cost + adCount_cost) as total_cost',FALSE);
                    //         $this->db->from('driver_add_view_update');
                    //         $this->db->where('adId',$result_query['id']);
                    //         $query = $this->db->get();
                    //         $total_cost = $query->row();
                    //         $val5 = $total_cost->total_cost;
                    //           if($val5 == null){
                    //             //$val5 = 0.00;
                    //              $val5 = round(0.00000, 2);
                    //         }else{
                    //             //$val5 = $val5;
                    //              $val5 = round($val5, 2);
                    //         }
                            $val5 = $val3 + $val4;
                              $ary['adviews3'] = $val5;



                }
               
                else
                {
                    $val6 = "3dfdf";
                     $ary['adviews'] = $val6;
                }

                //$ary['adviews'] = $val;
                
                $ary['ad_title'] = $result_query['ad_title'];
                $ary['status'] = $result_query['status'];
                $ary['title'] = $result_query['title'];
                $ary['approval_status'] = $result_query['approval_status'];
                $ary['media_agency_name'] = $result_query['media_agency_name'];
                $response[] = $ary;
            }
        } else {
            $response = '';
        }

        return $response;
    }

    }

   /* function search_campaign_analytics_all($campaign_id,$status,$report_id){

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
        if($this->session->userdata('rydlr_admin_login')) {
            $this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status, advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title, users.media_agency_name');
            $this->db->from('advertise');
            $this->db->join('campaign','advertise.campaign_id = campaign.id');
            $this->db->join('users','users.id = advertise.user_id');
            if($status != ""){
                $this->db->where('campaign.status',$status);
            }
            //$this->db->where('advertise.user_id',$user_id);
        
            $query = $this->db->get();  
        } else {
            $this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status, advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title');
            $this->db->from('advertise');
            $this->db->join('campaign','advertise.campaign_id = campaign.id');
        //$this->db->join('users','users.id = advertise.user_id');
            if($status != ""){
                $this->db->where('campaign.status',$status);
            }
            $this->db->where('advertise.user_id',$user_id);
        
            $query = $this->db->get();
        }
        $response = array();
        if($query->num_rows() > 0){
            $query_result = $query->result_array();
            foreach($query_result as $result_query){
                $ary['id'] = $result_query['id'];


              if($report_id == 0)
                {

                        $this->db->select_sum('adCount');
                        $this->db->from('driver_add_view_update');
                        $this->db->where('adId',$result_query['id']);
                        $query = $this->db->get();
                        $ad_count = $query->row();
                        $val = $ad_count->adCount;
                        
                        if($val == null){
                            $val = 0;
                        }else{
                            $val = $val;
                        }
                         $ary['adviews'] = $val;
                }
                else if($report_id == 1)
                {
                            $this->db->select_sum('adImpression');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $ad_Impression = $query->row();
                            $val1 = $ad_Impression->adImpression;
                             if($val1 == null){
                                $val1 = 0;
                            }else{
                                $val1 = $val1;
                            }

                        //  $val1 = "impress";
                            $ary['adviews'] = $val1;
                }
                else if($report_id == 2)
                {   
                            
                           $this->db->select('sum(adRiderTime*adCount) as duration',FALSE);
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $adDuration = $query->row();
                            //echo $this->db->last_query();
                           // print_r($adDuration);
                            //die();
                            $val2 = $adDuration->duration;
                             if($val2 == null){
                                $val2 = 0;
                            }else{
                                $val2 = $val2;
                            }

                        //  $val1 = "impress";
                            $ary['adviews'] = $val2;
                }
                else if($report_id == 3)
                {
                            $this->db->select_sum('adImpression_cost');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $ad_Impression_cost = $query->row();
                            $val3 = $ad_Impression_cost->adImpression_cost;
                             if($val3 == null){
                                 $val3 = round(0.00000, 2);
                            }else{
                               $val3 = round($val3, 2);
                            }

                            if($result_query['spend'] == "CPV"){
                                $val3 = 0;
                            }
                   // SELECT (adRiderTime * adCount) FROM `driver_add_view_update` WHERE adId=199
                   // $val3 = "gjgjgjgjjgj";
                    $ary['adviews1'] = $val3;

                    $this->db->select_sum('adCount_cost');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $adCount_cost = $query->row();
                            $val4 = $adCount_cost->adCount_cost;
                             if($val4 == null){
                                $val4 = round(0.000000, 2);
                            }else{
                                $val4 = round($val4, 2);
                            }
                            if($result_query['spend'] == "CPM"){
                                $val4 = 0;
                            }
                              $ary['adviews2'] = $val4;
                
                    // $this->db->select('sum(adImpression_cost + adCount_cost) as total_cost',FALSE);
                    //         $this->db->from('driver_add_view_update');
                    //         $this->db->where('adId',$result_query['id']);
                    //         $query = $this->db->get();
                    //         $total_cost = $query->row();
                    //         $val5 = $total_cost->total_cost;
                    //          if($val5 == null){
                    //             //$val5 = 0.00;
                    //              $val5 = round(0.00000, 2);
                    //         }else{
                    //             //$val5 = $val5;
                    //              $val5 = round($val5, 2);
                    //         }
                              $val5 = $val3 + $val4;
                              $ary['adviews3'] = $val5;



                }
                else
                {
                   // SELECT (adRiderTime * adCount) FROM `driver_add_view_update` WHERE adId=199
                    $val6 = "gjgjgjgjjgj";
                    $ary['adviews'] = $val6;
                }

                //$ary['adviews'] = $val;
                $ary['ad_title'] = $result_query['ad_title'];
                $ary['status'] = $result_query['status'];
                $ary['title'] = $result_query['title'];
                $ary['approval_status'] = $result_query['approval_status'];


                $this->db->select('*');
                $this->db->from('campaign');
                $this->db->where('campaign.user_id',$user_id);
                $this->db->where('title',$ary['title']);
                $query = $this->db->get();
                   
                $result = $query->result_array();
                foreach($result as $val){ 
                    $ary['camp_status'] = $val['status'];
                }
                   
                //echo $this->db->last_query();
               //echo $ary['camp_status'];
                 //die();

                if(isset($result_query['media_agency_name'])){
                    $ary['media_agency_name'] = $result_query['media_agency_name'];
                }
                //$ary['media_agency_name'] = $result_query['media_agency_name'];
                $response[] = $ary;
            }
        } else {
            $response = '';
        }
        return $response;
    }*//* end search_campaign_analytics_all*/

    function search_campaign_analytics_all($campaign_id,$status,$report_id){

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
        if($this->session->userdata('rydlr_admin_login')) {
            $this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status, advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title, users.media_agency_name');
            $this->db->from('advertise');
            $this->db->join('campaign','advertise.campaign_id = campaign.id');
            $this->db->join('users','users.id = advertise.user_id');
            if($status != ""){
                $this->db->where('campaign.status',$status);
            }
            //$this->db->where('advertise.user_id',$user_id);
        
            $query = $this->db->get();  
        } else {
            $this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status, advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title');
            $this->db->from('advertise');
            $this->db->join('campaign','advertise.campaign_id = campaign.id');
        //$this->db->join('users','users.id = advertise.user_id');
            if($status != ""){
                $this->db->where('campaign.status',$status);
            }
            $this->db->where('advertise.user_id',$user_id);
        
            $query = $this->db->get();
        }
        $response = array();
        if($query->num_rows() > 0){
            $query_result = $query->result_array();
            foreach($query_result as $result_query){
                $ary['id'] = $result_query['id'];


              if($report_id == 0)
                {

                        $this->db->select_sum('adCount');
                        $this->db->from('driver_add_view_update');
                        $this->db->where('adId',$result_query['id']);
                        $query = $this->db->get();
                        $ad_count = $query->row();
                        $val = $ad_count->adCount;
                        
                        if($val == null){
                            $val = 0;
                        }else{
                            $val = $val;
                        }
                         $ary['adviews'] = $val;
                }
                else if($report_id == 1)
                {
                            $this->db->select_sum('adImpression');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $ad_Impression = $query->row();
                            $val1 = $ad_Impression->adImpression;
                             if($val1 == null){
                                $val1 = 0;
                            }else{
                                $val1 = $val1;
                            }

                        //  $val1 = "impress";
                            $ary['adviews'] = $val1;
                }
                else if($report_id == 2)
                {   
                            
                           $this->db->select('sum(adRiderTime*adCount) as duration',FALSE);
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $adDuration = $query->row();
                            //echo $this->db->last_query();
                           // print_r($adDuration);
                            //die();
                            $val2 = $adDuration->duration;
                             if($val2 == null){
                                $val2 = 0;
                            }else{
                                $val2 = $val2;
                            }

                        //  $val1 = "impress";
                            $ary['adviews'] = $val2;
                }
                else if($report_id == 3)
                {
                            $this->db->select_sum('adImpression_cost');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $ad_Impression_cost = $query->row();
                            $val3 = $ad_Impression_cost->adImpression_cost;
                             if($val3 == null){
                                 $val3 = round(0.00000, 2);
                            }else{
                               $val3 = round($val3, 2);
                            }

                            if($result_query['spend'] == "CPV"){
                                $val3 = 0;
                            }
                   // SELECT (adRiderTime * adCount) FROM `driver_add_view_update` WHERE adId=199
                   // $val3 = "gjgjgjgjjgj";
                    $ary['adviews1'] = $val3;

                    $this->db->select_sum('adCount_cost');
                            $this->db->from('driver_add_view_update');
                            $this->db->where('adId',$result_query['id']);
                            $query = $this->db->get();
                            $adCount_cost = $query->row();
                            $val4 = $adCount_cost->adCount_cost;
                             if($val4 == null){
                                $val4 = round(0.000000, 2);
                            }else{
                                $val4 = round($val4, 2);
                            }
                            if($result_query['spend'] == "CPM"){
                                $val4 = 0;
                            }
                              $ary['adviews2'] = $val4;
                
                    // $this->db->select('sum(adImpression_cost + adCount_cost) as total_cost',FALSE);
                    //         $this->db->from('driver_add_view_update');
                    //         $this->db->where('adId',$result_query['id']);
                    //         $query = $this->db->get();
                    //         $total_cost = $query->row();
                    //         $val5 = $total_cost->total_cost;
                    //          if($val5 == null){
                    //             //$val5 = 0.00;
                    //              $val5 = round(0.00000, 2);
                    //         }else{
                    //             //$val5 = $val5;
                    //              $val5 = round($val5, 2);
                    //         }
                              $val5 = $val3 + $val4;
                              $ary['adviews3'] = $val5;



                }
                else
                {
                   // SELECT (adRiderTime * adCount) FROM `driver_add_view_update` WHERE adId=199
                    $val6 = "gjgjgjgjjgj";
                    $ary['adviews'] = $val6;
                }

                //$ary['adviews'] = $val;
                $ary['ad_title'] = $result_query['ad_title'];
                $ary['status'] = $result_query['status'];
                $ary['title'] = $result_query['title'];
                $ary['approval_status'] = $result_query['approval_status'];


                $this->db->select('*');
                $this->db->from('campaign');
                $this->db->where('campaign.user_id',$user_id);
                $this->db->where('title',$ary['title']);
                $query = $this->db->get();
                   
                $result = $query->result_array();
                foreach($result as $val){ 
                    $ary['camp_status'] = $val['status'];
                }
                   
                //echo $this->db->last_query();
               //echo $ary['camp_status'];
                 //die();

                if(isset($result_query['media_agency_name'])){
                    $ary['media_agency_name'] = $result_query['media_agency_name'];
                }
                //$ary['media_agency_name'] = $result_query['media_agency_name'];
                $response[] = $ary;
            }
        } else {
            $response = '';
        }
        return $response;
    }/* end search_campaign_analytics_all*/



    public function search_campaign_ads($campaign_id,$status){ 
         

    if(isset($_SESSION['admin_login'])){  
    	$session = $_SESSION['admin_login']; 
        $user_id = $session['admin_id'];
        $this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status, advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title');
        $this->db->from('advertise');
        $this->db->join('campaign','advertise.campaign_id = campaign.id');
       // $this->db->join('driver_add_view_update','advertise.id = driver_add_view_update.adId');

        if($campaign_id!=""){
            $this->db->where('advertise.campaign_id',$campaign_id);    
        }
        if($status != ""){
            $this->db->where('advertise.status',$status);
        }
        $this->db->where('advertise.user_id',$user_id);
        $query = $this->db->get();        
        $response = array();
        if($query->num_rows() > 0){
            $query_result = $query->result_array();
            foreach($query_result as $result_query){
                $ary['id'] = $result_query['id'];
                $ary['ad_title'] = $result_query['ad_title'];
                $ary['status'] = $result_query['status'];
                $ary['spend'] = $result_query['spend'];
                $ary['title'] = $result_query['title'];
                $ary['approval_status'] = $result_query['approval_status'];
                $response[] = $ary;

            }

        } else {
            $response = '';
        }

        return $response;
    } else if(isset($_SESSION['enterprise_account'])){
        $session = $_SESSION['enterprise_account']; 
        $user_id = $session['admin_id'];
        $this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status, advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title');
        $this->db->from('advertise');
        $this->db->join('campaign','advertise.campaign_id = campaign.id');
        if($campaign_id!=""){
            $this->db->where('advertise.campaign_id',$campaign_id);    
        }
        if($status != ""){
            $this->db->where('advertise.status',$status);
        }
    	$this->db->where('advertise.user_id',$user_id);
        $query = $this->db->get();
        $response = array();
        if($query->num_rows() > 0){
            $query_result = $query->result_array();
            foreach($query_result as $result_query){
                $ary['id'] = $result_query['id'];
                $ary['ad_title'] = $result_query['ad_title'];
                $ary['status'] = $result_query['status'];
                $ary['spend'] = $result_query['spend'];
                $ary['title'] = $result_query['title'];
                $ary['approval_status'] = $result_query['approval_status'];
                $response[] = $ary;
            }
        } else {
            $response = '';
        }

        return $response;
    } else if(isset($_SESSION['rydlr_admin_login'])){
    	$session = $_SESSION['rydlr_admin_login']; 
        $user_id = $session['admin_id'];
        $this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status, advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title, users.media_agency_name');
        $this->db->from('advertise');
        $this->db->join('campaign','advertise.campaign_id = campaign.id');
        $this->db->join('users','users.id = advertise.user_id');
        if($campaign_id!=""){
            $this->db->where('advertise.campaign_id',$campaign_id);    
        }
        if($status != ""){
            $this->db->where('advertise.status',$status);
        }
    	//$this->db->where('advertise.user_id',$user_id);
        $query = $this->db->get();
        $response = array();
        if($query->num_rows() > 0){
            $query_result = $query->result_array();
            foreach($query_result as $result_query){
                $ary['id'] = $result_query['id'];    
                $ary['ad_title'] = $result_query['ad_title'];
                $ary['status'] = $result_query['status'];
                $ary['spend'] = $result_query['spend'];
                $ary['title'] = $result_query['title'];
                $ary['approval_status'] = $result_query['approval_status'];
                $ary['media_agency_name'] = $result_query['media_agency_name'];
                $response[] = $ary;
            }
        } else {
            $response = '';
        }

        return $response;
    }

    }

	function search_campaign_ads_all($campaign_id,$status){

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
    	if($this->session->userdata('rydlr_admin_login')) {
        	$this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status, advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title, users.media_agency_name');
        	$this->db->from('advertise');
        	$this->db->join('campaign','advertise.campaign_id = campaign.id');
        	$this->db->join('users','users.id = advertise.user_id');
        	if($status != ""){
            	$this->db->where('advertise.status',$status);
        	}
    		//$this->db->where('advertise.user_id',$user_id);
    	
    		$query = $this->db->get();	
        } else {
    		$this->db->select('advertise.id as id, advertise.ad_title as ad_title, advertise.status as status, advertise.spend as spend, advertise.approval_status as approval_status, campaign.title as title');
        	$this->db->from('advertise');
        	$this->db->join('campaign','advertise.campaign_id = campaign.id');
        //$this->db->join('users','users.id = advertise.user_id');
        	if($status != ""){
            	$this->db->where('advertise.status',$status);
        	}
    		$this->db->where('advertise.user_id',$user_id);
    	
    		$query = $this->db->get();
        }
        $response = array();
        if($query->num_rows() > 0){
            $query_result = $query->result_array();
            foreach($query_result as $result_query){
                $ary['id'] = $result_query['id'];
                $ary['ad_title'] = $result_query['ad_title'];
                $ary['status'] = $result_query['status'];
                $ary['spend'] = $result_query['spend'];
                $ary['title'] = $result_query['title'];
                $ary['approval_status'] = $result_query['approval_status'];
            	if(isset($result_query['media_agency_name'])){
                	$ary['media_agency_name'] = $result_query['media_agency_name'];
                }
                //$ary['media_agency_name'] = $result_query['media_agency_name'];
                $response[] = $ary;
            }
        } else {
            $response = '';
        }
    	return $response;
    }

    function update_link($id) {
        $this->db->set('activation_status','activate');
        $this->db->where('id',$id);
        $update = $this->db->update('users');
        if($update) {
            $response = array('status' =>1);
        } else {
            $response = array('status' =>0);
        }
        return $response;
    }

    function update_advertisement_detail($id, $data) {
        $this->db->where('id',$id);
        $update = $this->db->update('advertise',$data);
    	
        if($update) {
            $response = array('status' =>1);
        } else {
            $response = array('status' =>0);
        }
    }

    function manage_target_ads($ad_area, $id) {
        $this->db->set('ad_area',$ad_area);
        $this->db->where('id',$id);
        $update = $this->db->update('advertise');
        
        if($update) {
            $response = array('status' =>1);
        } else {
            $response = array('status' =>0);
        }
    }


    function view_ad_target($id) {
        $this->db->select('*');
        $this->db->from('advertise');
        $this->db->join('campaign','advertise.campaign_id = campaign.id');
        $this->db->where('advertise.id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function forgot_password($post) {
		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('email',$post['email']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$rand_password = rand();
			$query_pass =  $query->result_array();
			$this->db->set('password',md5($rand_password));
			$this->db->where('id',$query_pass[0]['id']);
			$update = $this->db->update('driver_registration');

			$email = $post['email'];
	        $subject = 'Forgot Password';
	        $message = ' Driver Forgotten Password details :- <br><br> Email Address : '.$email.' <br><br> Temporary password: '.$rand_password.' ';
	        $this->sendemail($email,$subject,$message);   

			$response = array('status' => 1);
		} else {
			$response = array('status' => 0);
		}
		return $response;
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


     /******************************** Dynamic Functuions **************************************/ 
    /*
     * this function insert data in to database tabel on basis of tabel name and data. 
     */
    function insertData($tabel_name, $data) {
        $this->db->insert($tabel_name, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    /*
     * this function delete data from tabel on basis of tabel name and where condition. 
     */
    function deleteData($tabel_name, $where) {
        $this->db->where($where);
        $this->db->delete($tabel_name);
        return $this->db->affected_rows();
    }
    /*
     * this function return required data in array form from given tabel name . 
     */
    function getAllTabelData($select,$from) {
        $this->db->select($select);
        $this->db->from($from);
        $query = $this->db->get();
        return $query->result_array();
    }
    /*
     * this function return required data in array form from given tabel name with order by . 
     */
    function getAllTabelDataOrderBy($select,$from,$orderBy,$order) {
        $this->db->select($select);
        $this->db->from($from);
        $this->db->order_by($orderBy,$order);
        $query = $this->db->get();
        return $query->result_array();
    }
    /*
     * this function return required data in array form from given tabel name and on basis of where condition. 
     */
    function getAllRowDataWithWhere($select,$from,$where) {
        $this->db->select($select);
        $this->db->from($from);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }
    /*
     * this function return required data in array form from given tabel name and on basis of where condition with order by. 
     */
    function getAllRowDataWithWhereOrderBy($select,$from,$where,$orderBy,$order) {
        $this->db->select($select);
        $this->db->from($from);
        $this->db->where($where);
        $this->db->order_by($orderBy,$order);
        $query = $this->db->get();
        return $query->result_array();
    }
    /*
     * this function return required data in array form from given tabel name and on basis of where condition and or_where. 
     */
    function getAllRowDataWithWhereAndOrWhere($select,$from,$where,$orwhere,$orderBy,$order) {
        $this->db->select($select);
        $this->db->from($from);
        $this->db->where($where);
        $this->db->or_where($orwhere);
        $this->db->order_by($orderBy,$order);
        $query = $this->db->get();
        return $query->result_array();
    }
    /*
     * this function return required data in array form from given tabel name and on basis of where condition. 
     */
    function getAllRowDataWithTwoLikes($select,$from,$where1,$where2) {
        $this->db->select($select);
        $this->db->from($from);
        $this->db->where($where1);
        $this->db->where($where2);
        $query = $this->db->get();
        return $query->result_array();
    }
    /*
     * this function return number of rows . 
     */
    function getRowCount($select,$from,$where) {
        $this->db->select($select);
        $this->db->from($from);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->num_rows();
    }
    /*
     * this function return number of rows with limit. 
     */
    function getRowCountWithLimit($select,$from,$where,$limit) {
        $this->db->select($select);
        $this->db->from($from);
        $this->db->where($where);
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->num_rows();
    }
    /*
     * this function return singal row data in form of array . 
     */
    function getAllRowDataWithWhereRowArray($select,$from,$where) {
        $this->db->select($select);
        $this->db->from($from);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();
    }
    /*
     * this function return singal row data in form of object. 
     */
    function getRowDataWithWhere($select,$from,$where) {
        $this->db->select($select);
        $this->db->from($from);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }
    /*
     * this function update data on basis of where condition and tabel name. 
     */
    function updateTabel($fields,$tabel,$where) {
        $this->db->where($where);
        $this->db->update($tabel, $fields);
        return $this->db->affected_rows(); 
    }
    /*
     * this function get data on basis of join of tabel name. 
     */
    function joinTabel($select,$tabel1,$tabel2,$join_where,$join_type,$where,$orderBy,$order) {
        $this->db->select($select);
        $this->db->from($tabel1);
        $this->db->join($tabel2,$join_where,$join_type);
        $this->db->where($where); 
         $this->db->order_by($orderBy,$order);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /*
     * this function get data on basis of join of tabel namewith two where. 
     */
    function joinTabelTwoWhere($select,$tabel1,$tabel2,$join_where,$where1,$where2) {
        $this->db->select($select);
        $this->db->from($tabel1);
        $this->db->join($tabel2,$join_where);
        $this->db->where($where1);
        $this->db->where($where2);
        $query = $this->db->get();
        return $query->result_array();
    }	

    //  created by chirag //
    function get_single_campaign_data($id){

        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('campaign');

        return $query->row_array();
    }
    function change_selected_ad_status($id){
        $this->db->set('status','Inactive');
        $this->db->where('campaign_id',$id);
        $this->db->where('status','Active');
        $query = $this->db->update('advertise');
        return $query;
    }




}


?>