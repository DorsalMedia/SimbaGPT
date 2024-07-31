<?php
 
class Admin_model extends CI_Model {

 function __construct() {
        parent::__construct();
        $this->load->library('email');
    }  

 // This is login functioanlity. but this functioanlity source is not in use

    function rydlr_admin_login($username,$password) {

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
        $this->db->where('activation_status','activate');
        $query_new_password_y = $this->db->get();

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $this->db->where('required_password_reset','N');
        $this->db->where('activation_status','activate');
        $query_new_password_n = $this->db->get();

        if($query_admin_credential->num_rows() > 0){
            $query_admin_credential_result = $query_admin_credential->result();
            $user_id = $query_admin_credential_result[0]->id;
            $data = array(
            'admin_username' => $username,
            'admin_password' => $password,
            'admin_id' => $user_id
            );
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
            $this->session->set_userdata('rydlr_admin_login',$data);
            echo json_encode(array('status' =>'new_password'));    
        } else if($query_new_password_n->num_rows() > 0) {

            $query_new_password_n_result = $query_new_password_n->result();
            $user_id = $query_new_password_n_result[0]->id;
            $data = array(
            'admin_username' => $username,
            'admin_password' => $password,
            'admin_id' => $user_id
            );
            $this->session->set_userdata('rydlr_admin_login',$data);
            echo json_encode(array('status' =>1));    
        } 
        else {
            echo json_encode(array('status' =>0));       
        }

    }

    // This is change new password functionality. this functionality is not in use.

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
            $this->session->set_userdata('rydlr_admin_login',$data);
            echo json_encode(array('status' =>1));
        } else {
            echo json_encode(array('status' =>0));
        } 
    } */   

    // This is forgot username functionality this is not in use.

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

    // This is forgot password functionality which is not in use.

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

    // This is get_membershi_detail functionality which is not in use.

    function get_membership_details($user_id) {
        $this->db->select('*');
        $this->db->from('membership');
        $this->db->join('contract', 'contract.membership_id = membership.id'); 
        $this->db->join('users', 'users.id = contract.user_id'); 
        $this->db->join('payment', 'payment.contract_id = contract.id'); 
        $this->db->where('users.id',$user_id);
        $query = $this->db->get();          

        return $query->result_array();
    }

    // This is sed get all campaign details without using user id for admin only. this functionality is in use


    function get_campaign_details() {
        $session = $_SESSION['rydlr_admin_login']; 
        $user_id = $session['admin_id'];
        $this->db->select('*');
        $this->db->from('campaign');
        //$this->db->where('campaign.user_id',$user_id);
        $query = $this->db->get();          
        return $query->result_array();
    }

    // This functioanlity are used to get all contract without user id for admin.

    function get_contract_userid($user_id) {
        $this->db->select('*,contract.id as contract_id');
        $this->db->from('contract');
        $this->db->join('users', 'users.id = contract.user_id'); 
        $this->db->join('membership', 'membership.id = contract.membership_id'); 
        //$this->db->where('users.id',$user_id);
        $query = $this->db->get();          
        return $query->result_array();
    }
 
    // // This functioanlity are used to get all contract without user id for admin.

    function get_contract_userids($user_id) {
        $this->db->select('*');
        $this->db->from('contract');
        $this->db->join('users', 'users.id = contract.user_id'); 
        $this->db->join('membership', 'membership.id = contract.membership_id'); 
        $this->db->order_by("contract.id","desc");
        $this->db->limit(1);
        //$this->db->where('users.id',$user_id);
        $query = $this->db->get();          
        return $query->result_array();
    }

    // This functionality are used to get all contract. but this is not in use
 
    function get_all_contract_userid() {
        $this->db->select('*');
        $this->db->from('contract');
        $this->db->join('users', 'users.id = contract.user_id'); 
        $this->db->join('membership', 'membership.id = contract.membership_id'); 
        $query = $this->db->get();          
        return $query->result_array();
    }

    // This functionality are used to fetch all document based on single contract

    public function get_all_docs($id) {
        $this->db->select('*');
        $this->db->from('contract');
        $this->db->where('id',$id);
        $query = $this->db->get();          
        return $query->result_array();   
    }

    // This functionality are used to get all payment information. but this is not in use

    public function get_all_payment($id) {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('id',$id);
        $query = $this->db->get();          
        return $query->result_array();   
    }

    // This functionality are used to get campaign information. but this is not in use

    function get_campaign_data() {
        $session = $_SESSION['rydlr_admin_login']; 
        $user_id = $session['admin_id'];
        $this->db->select('*');
        //$this->db->from('campaign');
        $this->db->from('campaign');
        $this->db->join('contract','campaign.user_id = contract.user_id');
        //$this->db->where('campaign.user_id',$user_id);
        $query = $this->db->get();          
        return $query->result_array();   
    }

    // This functionality are used to get all active advertisment without any user id for admin only. but this functioanlity is not in use

    function get_advertisement_result() {
        $session = $_SESSION['rydlr_admin_login']; 
        $user_id = $session['admin_id'];
        $this->db->select('*,advertise.id AS advertise_id,advertise.status as ad_status');
        $this->db->from('advertise');
        $this->db->join('campaign', 'advertise.campaign_id = campaign.id'); 
        $this->db->join('users','advertise.user_id = users.id');
        $this->db->where('advertise.status','active');  
        $query = $this->db->get();

        return $query->result_array();   
    }

    // This functionality are used to get all campaign without any user id for admin only. but this functioanlity is in use

    function get_advertisement_campaigns() {
        
        $this->db->select('*');
        $this->db->from('campaign');
        
        $query = $this->db->get();
        
        
        return $query->result_array();   
    }

    // This functionality is used to get contract information. without user id. this is not in use

    function get_contract() {
        $session = $_SESSION['rydlr_admin_login']; 
        $user_id = $session['admin_id'];
        $this->db->select('*');
        $this->db->from('campaign');
        $this->db->join('contract','campaign.user_id = contract.user_id');
        //$this->db->where('campaign.user_id',$user_id);
        $query = $this->db->get();          
        return $query->result_array();
    }

    // This functionality are used to get advertisement count on campaign page. but this is not in use

    function get_advertisement_count() {
        $session = $_SESSION['rydlr_admin_login']; 
        $user_id = $session['admin_id'];
        $this->db->select('*');
        $this->db->from('advertise');
        $this->db->join('campaign', 'advertise.campaign_id = campaign.id'); 
        $this->db->where('campaign.user_id',$user_id);
        $query = $this->db->get();          

        return $query->num_rows();     
    }

    // This functionality are used to get all advertisment detail by id. for admin

    function get_advertisment_details_by_id($id) {
        $this->db->select('*');
        $this->db->from('advertise');
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->result_array();   
    }

    // This functionality are used to search campaign on campaign page. but this is not in use

    function search_campaign($campaign_id,$status) {
        $session = $_SESSION['rydlr_admin_login']; 
        $user_id = $session['admin_id'];
        $this->db->select('*');
        $this->db->from('campaign');
        $this->db->where('campaign.user_id',$user_id);
        if($campaign_id != '0'){
            $this->db->where('campaign.id',$campaign_id);
        }
        if($status != ""){
            $this->db->where('campaign.status',$status);   
        }
        $query = $this->db->get(); 
        return $query->result_array();   
    }

    // This functionality are used update user status. but this is not in use

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

    // This functionality are used to update advertisment detail. but this is not in use.

    function update_advertisement_detail($id, $data) {
        $this->db->where('id',$id);
        $update = $this->db->update('advertise',$data);
        if($update) {
            $response = array('status' =>1);
        } else {
            $response = array('status' =>0);
        }
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

    // in use

    function view_ad_target($id) {
        $this->db->select('*');
        $this->db->from('advertise');
        $this->db->join('campaign','advertise.campaign_id = campaign.id');
        $this->db->where('advertise.id',$id);
        $query = $this->db->get();
        return $query->result_array();
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


}


?>