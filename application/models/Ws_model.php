<?php  
 
class Ws_model extends CI_Model {

 	function __construct() {
        parent::__construct();
        $this->load->library('email');
	}  
 
    
	function driver_registration_model($data) {

		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('email',$data['email']);
		$query_email = $this->db->get();

		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('username',$data['username']);
		$query_username = $this->db->get();
    
    	$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('mobile',$data['mobile']);
		$query_mobile = $this->db->get();	
		
		if($query_email->num_rows() > 0 && $query_username->num_rows() > 0){
			$response = array("status" => 11);
			return $response;
		}
		else if($query_email->num_rows() > 0){
			$response = array("status" => 0);
			return $response;
		} 
    	else if($query_mobile ->num_rows() > 0){
			$response = array("status" => 12);
			return $response;	
		}
    
		else if($query_username->num_rows() > 0){
			$response = array("status" => 2);
			return $response;
		}
		else if($query_email->num_rows() < 1 && $query_username->num_rows() < 1) {
			$data =array(
				'name' => $this->input->post('first_last_name'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
			);
			$result = $this->db->insert('driver_registration',$data);
        	$insert_id = $this->db->insert_id();

        	$this->db->select('*');
        	$this->db->from('driver_registration');
        	$this->db->where('id',$insert_id);
        	$query = $this->db->get();
        	$query_result = $query->result_array();
        	$query_results = array();
        	foreach($query_result as $result_query){
        		$ary['driver_id'] = $result_query['id'];
        		$ary['name'] = $result_query['name'];
        		$ary['email'] = $result_query['email'];
        		$ary['mobile'] = $result_query['mobile'];
        		$ary['username'] = $result_query['username'];
        		$ary['password'] = $result_query['password'];

        		$query_results[] = $ary;
        	}


	        $response = array("status" => 1,"result" => $query_results);	        	
        	return $response;
		}	
		
	  	//echo json_encode($response);
	}

	function login_driver($data) {	
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		
		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$query_result = $query->result_array();
			$query_results = array();
        	foreach($query_result as $result_query){
        		$ary['driver_id'] = $result_query['id'];
        		$ary['name'] = $result_query['name'];
        		$ary['email'] = $result_query['email'];
        		$ary['mobile'] = $result_query['mobile'];
        		$ary['username'] = $result_query['username'];
        		$ary['password'] = $result_query['password'];

        		$query_results[] = $ary;
        	}
			$response = array("status" => 1,"result" =>$query_results);
			return $response;
		} else {
			$response = array("status" => 0);
			return $response;
		}		
	}
	
	function update_driver_password(){
		$driver_id = $_POST['driver_id'];
		$password = md5($_POST['new_password']);

		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('id',$driver_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$this->db->set('password',$password);
			$this->db->where('id',$driver_id);
			$update = $this->db->update('driver_registration');
			if($update == true){
				$response = array('status' => 1, 'result' => array('password' => $password));
			}else{
				$response = array('status' => 0);
			}
		}else{
			$response = array('status' => 2);
		}
		return $response;
	}
	
	function register_rider($data,$otp) {
		//$otp = rand();

		$data = array(
			'select_company' => $this->input->post('select_company'),
			'name' => $this->input->post('name'),
			'start_location' => $this->input->post('start_location'),
			'end_location' => $this->input->post('end_location'),
			'start_lat' => $this->input->post('start_lat'),
			'start_long' => $this->input->post('start_long'),
			'end_lat' => $this->input->post('end_lat'),
			'end_long' => $this->input->post('end_long'),
			'mobile_number' => $this->input->post('mobile_number'),
			'otp_status' => $otp,			
		);	
		$result = $this->db->insert('riders_detail',$data);
        $insert_id = $this->db->insert_id();
        /* make otp after insert if condition that of fail to send otp given mobile number than delete that entry from database */        

        if($insert_id) {
        $trip_data = array(
    		'select_company' => $this->input->post('select_company'),
    		'start_location' => $this->input->post('start_location'),
			'end_location' => $this->input->post('end_location'),
			'start_lat' => $this->input->post('start_lat'),
			'start_long' => $this->input->post('start_long'),
			'end_lat' => $this->input->post('end_lat'),
			'end_long' => $this->input->post('end_long'),
			'driver_id' => $this->input->post('driver_id'),
			'rider_id' => $insert_id,
        );
        $result = $this->db->insert('trip_details',$trip_data);	
        $this->db->select('riders_detail.id as rider_id, trip_details.id as trip_id, riders_detail.name,riders_detail.start_location,riders_detail.end_location,riders_detail.start_lat,riders_detail.start_long,riders_detail.end_lat,riders_detail.end_long,riders_detail.mobile_number,riders_detail.otp_status');
        $this->db->from('riders_detail');
        $this->db->join('trip_details','riders_detail.id = trip_details.rider_id');
        $this->db->where('riders_detail.id',$insert_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $arr = [];
        foreach($query_result as $rider){
                $arr = $rider;
        }
        $response = array("status" => 1,'result' => $arr);
        
		return $response;
        } else {
        	$response = array("status" => 0);
			return $response;
        }
	}


	function otp_verification($data) {

		$this->db->select('trip_details.rider_id');
		$this->db->from('driver_registration');
		$this->db->join('trip_details','trip_details.driver_id = driver_registration.id');
		$this->db->where('trip_started','y');
		$this->db->where('trip_complete','n');
		$this->db->where('driver_registration.mobile',$data['mobile_number']);
		$query_get_driver = $this->db->get();
		if($query_get_driver->num_rows() > 0){
			$query_get_driver_result = $query_get_driver->result_array();
		
			$rider_id = '';
			foreach($query_get_driver_result as $get_driver){
				$rider_id += $get_driver['rider_id'];
			}

			$this->db->select('*');
			$this->db->from('riders_detail');
			$this->db->where('id',$rider_id);
			$this->db->where('otp_status',$data['otp']);
			$query_verify = $this->db->get();
			if($query_verify->num_rows() > 0){
				$response = array("status" => 1);
				return $response;
			} else {
				$response = array("status" => 0);
				return $response;
			}
		} else {
			$response = array("status" => 2);
			return $response;
		}
		
		
		/*$this->db->select('*');
		$this->db->from('riders_detail');
		$this->db->where('mobile_number',$data['mobile_number']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$this->db->select('*');
			$this->db->from('riders_detail');
			$this->db->where('mobile_number',$data['mobile_number']);
			$this->db->where('otp_status',$data['otp']);
			$query_verify = $this->db->get();
			if($query_verify->num_rows() > 0){
				$response = array("status" => 1);
				return $response;
			} else {
				$response = array("status" => 0);
				return $response;
			}
		} else {
			$response = array("status" => 2);
			return $response;
		} */
	}

	function get_ad_description($id) {
    
		$this->db->select('*');
		$this->db->from('advertise');
		$this->db->where('id',$id);
		$query = $this->db->get();
   
		$response_result = $query->result_array();
		
		if($response_result){
			$response = array("status" => 1,"result"=>$response_result);
			return $response;
		} else {
			$response = array("status" => 0);
			return $response;	
		}
	}

	function get_sync_advertise_old() {
		$this->db->select('*');
		$this->db->from('advertise');
		$this->db->where('status','Active');
		$this->db->where('approval_status','1');
		$this->db->where('sync','0');
		$query = $this->db->get();
		$response_result = $query->result_array();
		return $response_result;
	}
	// get sync advertise for each driver
	function get_sync_advertise_driver($driver_id) {
		$this->db->select('id');
		$this->db->where('status','Active');
		$this->db->where('approval_status','1');
		$query = $this->db->get('advertise');
		$response_result = $query->result();
		$count = $query->num_rows();
		if($count = 0){
			$response = array("data_status" => "0");
		}else{		
			$result = $id = array();
			foreach ($response_result as $value) {			
				$id[] = $value->id;
				$result=$id;
			}
			$ad_id = $result;

			$this->db->select('*');
			$this->db->where_in('ad_id',$ad_id);
			$this->db->where('driver_id',$driver_id);
			$query2 = $this->db->get('driver_advertise');
			$data = $query2->result_array();
			$data_count = count($data);
			if($data_count == 0){
				$sync_data = $data_val = array();
				foreach ($response_result as $value) {
					$data_val['ad_id'] = $value->id;
					$data_val['driver_id'] = $driver_id;
					$data_val['sync'] = "0";
					$sync_data[] = $data_val;
				}
				$insert = $this->db->insert_batch('driver_advertise',$sync_data);
				$this->db->select('*,driver_advertise.id as driver_advertise_id,advertise.id as advertise_id');
				$this->db->from('driver_advertise');
				$this->db->where('driver_advertise.driver_id',$driver_id);
				$this->db->where('driver_advertise.sync','0');
				$this->db->join('advertise','advertise.id = driver_advertise.ad_id');
				$query = $this->db->get();
				$response = $query->result_array();

				//print_r($response);
				//die();
			}else{
				//print_r($data);
				$present_result = $p_id = array();
				foreach ($data as $value) {			
					$p_id[] = $value['ad_id'];
					$present_result=$p_id;
				}
				$present_ad_id = $present_result;				
				$filtered_ad_id = array_diff($ad_id,$present_ad_id);
					
					if(!empty($filtered_ad_id)){
						$sync_data = $data_val = array();
						foreach ($filtered_ad_id as $value) {
							$data_val['ad_id'] = $value;
							$data_val['driver_id'] = $driver_id;
							$data_val['sync'] = "0";
							$sync_data[] = $data_val;
						}
						$insert = $this->db->insert_batch('driver_advertise',$sync_data);
					}		
					$this->db->select('*,driver_advertise.id as driver_advertise_id,advertise.id as advertise_id');
					$this->db->from('driver_advertise');
					$this->db->where('driver_advertise.driver_id',$driver_id);
					$this->db->where('driver_advertise.sync','0');
					$this->db->join('advertise','advertise.id = driver_advertise.ad_id');
					$query = $this->db->get();
					$response = $query->result_array();
					//print_r($response);			
				
			}		
		}

		return $response;
	}

	function get_current_advertise() {
		
		$this->db->select('*');
		$this->db->from('riders_detail');		
		$query_advertise = $this->db->get();
		$query_advertise_result = $query_advertise->result_array();
		$response = array();
		foreach($query_advertise_result as $query_get_start_end_lat_long){
			$ary['start_lat'] = $query_get_start_end_lat_long['start_lat'];
			$ary['start_long'] = $query_get_start_end_lat_long['start_long'];
			$ary['end_lat'] = $query_get_start_end_lat_long['end_lat'];
			$ary['end_long'] = $query_get_start_end_lat_long['end_long'];
		}

		$rider_start_lat = $query_get_start_end_lat_long['start_lat'];
		$rider_start_long = $query_get_start_end_lat_long['start_long'];
		$rider_end_lat = $query_get_start_end_lat_long['end_lat'];
		$rider_end_long = $query_get_start_end_lat_long['end_long'];

        $this->db->select('*');
        $this->db->from('advertise');
        $this->db->where('status','Active');
        $this->db->where('approval_status','1');
        $this->db->where('sync','1');
        $this->db->where('start_lat >=',$rider_start_lat);
        $this->db->where('end_lat <=',$rider_end_lat);
        $this->db->where('start_long >=',$rider_start_long);
        $this->db->where('end_long <=',$rider_end_long);
        $this->db->order_by('start_lat, start_long ASC');
        $query_data = $this->db->get();
        return $query_data->result_array();
        
	}

	function get_current_advertise_fixed_old() { // no location based
        $this->db->select('*');
        $this->db->from('advertise');
        $this->db->where('status','Active');
        $this->db->where('approval_status','1');
        $this->db->where('sync','1');        
        $query_data = $this->db->get();
        return $query_data->result_array();
	}
	function get_current_advertise_fixed_driver($driver_id) { // no location based

		$this->db->select('*,driver_advertise.id as driver_advertise_id,advertise.id as advertise_id');
		$this->db->from('driver_advertise');
		$this->db->where('driver_advertise.driver_id',$driver_id);
		$this->db->where('driver_advertise.sync','1');
		$this->db->join('advertise','advertise.id = driver_advertise.ad_id');                
        $query_data = $this->db->get();
        return $query_data->result_array();
	}

	function update_sync_advertise_old($id) {

		$this->db->select('*');
		$this->db->from('advertise');
		$this->db->where('sync','1');
		$this->db->where('id',$id);
		$query_sync = $this->db->get();
		
		if($query_sync->num_rows() > 0) {
			$response = array("status" => 2);
			return $response;
		} else {
			$this->db->set('sync','1');
			$this->db->where('id',$id);
			$update = $this->db->update('advertise');
			if($update) {
				$response = array("status" => 1);
			} else {
				$response = array("status" => 0);
			}
			return $response;
		}

	}
	//new function 12/12/17
	function update_sync_advertise_driver($ad_id,$driver_id) {

		$this->db->select('*');
		$this->db->from('driver_advertise');
		$this->db->where('sync','1');
		$this->db->where('ad_id',$ad_id);
		$this->db->where('driver_id',$driver_id);
		$query_sync = $this->db->get();
		
		if($query_sync->num_rows() > 0) {
			$response = array("status" => 2);
			return $response;
		} else {
			$this->db->set('sync','1');
			$this->db->where('ad_id',$ad_id);
			$this->db->where('driver_id',$driver_id);
			$update = $this->db->update('driver_advertise');
			if($update) {
				$response = array("status" => 1);
			} else {
				$response = array("status" => 0);
			}
			return $response;
		}

	}
// new function 07/09/17
	function reset_sync_advertise_old($id) {

		$this->db->select('*');
		$this->db->from('advertise');
		$this->db->where('sync','0');
		$this->db->where('id',$id);
		$query_sync = $this->db->get();
		
		if($query_sync->num_rows() > 0) {
			$response = array("status" => 2);
			return $response;
		} else {
			$this->db->set('sync','0');
			$this->db->where('id',$id);
			$update = $this->db->update('advertise');
			if($update) {
				$response = array("status" => 1);
			} else {
				$response = array("status" => 0);
			}
			return $response;
		}

	}

	//new function 12/12/17.
	function reset_sync_advertise_driver($ad_id,$driver_id) {

		$this->db->select('*');
		$this->db->from('driver_advertise');
		$this->db->where('sync','0');
		$this->db->where('ad_id',$ad_id);
		$this->db->where('driver_id',$driver_id);
		$query_sync = $this->db->get();
		
		if($query_sync->num_rows() > 0) {
			$response = array("status" => 2);
			return $response;
		} else {
			$this->db->set('sync','0');
			$this->db->where('ad_id',$ad_id);
			$this->db->where('driver_id',$driver_id);
			$update = $this->db->update('driver_advertise');
			if($update == true) {
				$response = array("status" => 1);
			} else {
				$response = array("status" => 0);
			}
			return $response;
		}

	}

	function start_trip($trip_id) {
		$this->db->select('*');
		$this->db->from('trip_details');
		$this->db->where('id',$trip_id);
		$query_driver = $this->db->get();

		if($query_driver->num_rows() == 0) {
			$response = array("status" => '3');	
		} else {

			$query_valid_trip_result = $query_driver->result_array();
			$value = $query_valid_trip_result[0]['trip_start_time'];
			if($value == '0000-00-00 00:00:00'){
				$update = $this->db->query("UPDATE `trip_details` SET `trip_started` = 'y', `trip_start_time` = CURRENT_TIMESTAMP WHERE `id` = '$trip_id'");
			}else {
				$update = $this->db->query("UPDATE `trip_details` SET `trip_started` = 'y' WHERE `id` = '$trip_id'");
			}	
		
			// $this->db->set('trip_started','y');
			// $this->db->set('trip_start_time',CURRENT_TIMESTAMP);
			// $this->db->where('id',$trip_id);
			// $update = $this->db->update('trip_details');
			if($update) {
				$response = array("status" => '1','result'=>$trip_id);
			} else {
				$response = array("status" => 0);
			}	
		}
		
		return $response;
	}

	function stop_trip($trip_id) {

		$this->db->select('*');
		$this->db->from('trip_details');
		$this->db->where('id',$trip_id);
		$query_valid_trip = $this->db->get();
		if($query_valid_trip->num_rows() == 0){
			$response = array("status" => '2');
		} else {
			$query_valid_trip_result = $query_valid_trip->result_array();
			$value = $query_valid_trip_result[0]['trip_complete_time'];
			if($value == '0000-00-00 00:00:00'){
				$update = $this->db->query("UPDATE `trip_details` SET `trip_complete` = 'y', `trip_complete_time` = CURRENT_TIMESTAMP WHERE `id` = '$trip_id'");
				$this->db->select('*');
				$this->db->from('trip_details');
				$this->db->where('id',$trip_id);
				$query_get = $this->db->get();
				$query_get_result = $query_get->result_array();

				$get_total_ads = [];
				foreach($query_get_result as $result_get){
					$get_total_ads['trip_start_time'] = $result_get['trip_start_time'];
					$get_total_ads['trip_complete_time'] = $result_get['trip_complete_time'];
				}

				$found_defference = $this->db->query("SELECT TIMEDIFF('".$get_total_ads['trip_complete_time']."', '".$get_total_ads['trip_start_time']."') AS days");
				
				$result = $found_defference->result_array();
				// $main_value = 0;
				// for($i=0; $i<=1;$i++){
				// 	$main_value = $result[0];
				// }
				$comma_separated = implode("", $result[0]);

				$days = $comma_separated;
				$update1 = $this->db->query("UPDATE `trip_details` SET  `trip_duration` = '$days' WHERE `id` = '$trip_id'");

			}else {
			    
			    $this->db->select('*');
				$this->db->from('trip_details');
				$this->db->where('id',$trip_id);
				$query_get = $this->db->get();
				$query_get_result = $query_get->result_array();

				$get_total_ads = [];
				foreach($query_get_result as $result_get){
					$get_total_ads['trip_start_time'] = $result_get['trip_start_time'];
					$get_total_ads['trip_complete_time'] = $result_get['trip_complete_time'];
				}

				$found_defference = $this->db->query("SELECT TIMEDIFF('".$get_total_ads['trip_complete_time']."', '".$get_total_ads['trip_start_time']."') AS days");
				
				$result = $found_defference->result_array();
				// $main_value = 0;
				// for($i=0; $i<=1;$i++){
				// 	$main_value = $result[0];
				// }
				$comma_separated = implode("", $result[0]);

				$days = $comma_separated;
			    //------------------chirag 28-06-2018---------------------    
			    
				$update = $this->db->query("UPDATE `trip_details` SET `trip_complete` = 'y', `trip_duration` = '$days' WHERE `id` = '$trip_id'");
			}			
			
			if($update) {
				$this->db->select('*');
				$this->db->from('trip_details');
				$this->db->where('id',$trip_id);
				$query = $this->db->get();
				$query_result = $query->result_array();
				$total_ads = '';
				foreach($query_result as $result){
					$total_ads .= $result['total_ads_played'];
				}
				$response = array("status" => 1,'result'=>$total_ads);
			} else {
				$response = array("status" => 0);
			}
		}

		
		return $response;

	}

	function last_trip_details($data){
		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('id',$data['driver_id']);
		$query_driver = $this->db->get();

		$this->db->select('*');
		$this->db->from('trip_details');
		$this->db->where('driver_id',$data['driver_id']);
		$this->db->where('trip_complete','y');
		$query_trip = $this->db->get();


		if($query_driver->num_rows() == 0) {
			$response = array("status" => '2');	
		} else if($query_trip->num_rows() == 0) {
			$response = array("status" => '3');	
		} else {
			$this->db->select('*');
			$this->db->from('trip_details');
			// $this->db->join('adview_rider','trip_details.id = adview_rider.trip_id');
			$this->db->where('driver_id',$data['driver_id']);
			$this->db->where('trip_complete','y');
			$this->db->order_by('trip_start_time','DESC');
			$this->db->limit(1);
			$query= $this->db->get();

			$query_result = $query->result();
			$ary = [];
			foreach($query_result as $results) {
				
				$s_time = date("H:i:s",strtotime($results->trip_start_time));
				$c_time = date("H:i:s",strtotime($results->trip_complete_time));
				$diff_time = ( strtotime($results->trip_complete_time) - strtotime($results->trip_start_time) );
				$ary['trip_id'] = $results->id;
				$ary['driver_id'] = $results->driver_id;
				$ary['rider_id'] = $results->rider_id;
				$ary['trip_started'] = $results->trip_started;
				$ary['trip_complete'] = $results->trip_complete;
				$ary['total_ads_played'] = $results->total_ads_played;
				$ary['start_location'] = $results->start_location;
				$ary['end_location'] = $results->end_location;
				$ary['start_lat'] = $results->start_lat;
				$ary['start_long'] = $results->start_long;
				$ary['end_lat'] = $results->end_lat;
				$ary['end_long'] = $results->end_long;
				$ary['select_company'] = $results->select_company;
				$ary['trip_start_time'] = date("H:i:s",strtotime($results->trip_start_time));
				$ary['trip_start_date'] = date("Y/m/d",strtotime($results->trip_start_time));
				$ary['trip_complete_time'] = date("H:i:s",strtotime($results->trip_complete_time));
				$ary['trip_complete_date'] = date("Y/m/d",strtotime($results->trip_complete_time));
				$ary['trip_duration'] = $diff_time;
				$ary['total_ads_duration'] = $this->total_ads_duration($results->id);
				
			}
			
			$response = array("status" => '1',"result" => $ary);	
		}
		return $response;
	}
	function total_ads_duration($id){

		$this->db->select_sum('adRiderTime');
		$this->db->from('driver_add_view_update');
		$this->db->where('trip_id',$id);
		$query = $this->db->get();
		$result = $query->row('adRiderTime');
		if($result == null){
			$result = 0;
		}else{
			$result = $result;
		}
		return $result;
		
	}


	function update_view_ad($data) {
		$ad_id = $data['ad_id'];
		$trip_id = $data['trip_id'];
		$this->db->select('*');
		$this->db->from('trip_details');
		$this->db->where('id',$data['trip_id']);
		$query_trip = $this->db->get();

		$this->db->select('*');
		$this->db->from('advertise');
		$this->db->where('status','active');
		$this->db->where('approval_status','1');
		$this->db->where('id',$data['ad_id']);
		$query_ads = $this->db->get();

		$this->db->select('*');
		$this->db->from('trip_details');
		$this->db->where('trip_complete_time !=','0000-00-00');		
		$this->db->where('id',$trip_id);
		$query_trip_complete = $this->db->get();

		$this->db->select('*');
		$this->db->from('adview_rider');
		$this->db->where('trip_id',$trip_id);		
		$this->db->where('ad_id',$ad_id);
		$query_trip_update = $this->db->get();

		$this->db->select('*');
		$this->db->from('trip_details');
		$this->db->where('trip_start_time','0000-00-00 00:00:00');
		$this->db->where('trip_details.id',$trip_id);		
		$query_trip_update_err = $this->db->get();

		
		if($query_trip->num_rows() == 0 && $query_ads->num_rows() == 0) {
			$response = array("status" => '4');	
		} else if($query_trip_update_err->num_rows() > 0) {
			$response = array("status" => '7');	
		} else if($query_trip_update->num_rows() > 0) {
			$response = array("status" => '6');	
				// $update = $this->db->query("UPDATE `adview_rider` SET  `ad_view_status` = 'y', `ad_view_time` = CURRENT_TIMESTAMP,`trip_id` = '$trip_id' WHERE `id` = '$ad_id'");
		} else if($query_trip->num_rows() == 0) {
			$response = array("status" => '2');	
		} else if($query_ads->num_rows() == 0) {
			$response = array("status" => '3');	
		} else if($query_trip_complete->num_rows() > 0) {
			$response = array("status" => '5');	
		} else if($query_trip_update_err->num_rows() <= 0) {
			$datas = array(
				'trip_id' => $data['trip_id'],
				'ad_id' => $data['ad_id'],
			);
			// $insert_id = $this->db->insert('adview_rider',$datas);
			// if($insert_id){
				$ad_id = $data['ad_id'];
				$trip_id = $data['trip_id'];

				// $update = $this->db->query("UPDATE `adview_rider` SET  `ad_view_status` = 'y', `ad_view_time` = CURRENT_TIMESTAMP,`trip_id` = '$trip_id' WHERE `id` = '$ad_id'");

				$insert = $this->db->query("INSERT into `adview_rider` (trip_id,ad_id,ad_view_status,ad_view_time) VALUES ('$trip_id','$ad_id','y',CURRENT_TIMESTAMP)");				
				if($insert){
					$response = array("status" => '1');	
				} else {
					$response = array("status" => '0');	
				}
			// }
			return $response;
		}

		return $response;
	}

	function get_already_viewed_ads($trip_id) {

		$this->db->select('*');
		$this->db->from('trip_details');		
		$this->db->where('id',$trip_id);
		$query_trip = $this->db->get();


		$this->db->select('*');
		$this->db->from('adview_rider');
		$this->db->where('ad_view_status','y');
		$this->db->where('ad_send_status','y');
		$this->db->where('trip_id',$trip_id);
		$query_rider = $this->db->get();

		$this->db->select('*');
		$this->db->from('trip_details');
		$this->db->where('trip_complete_time !=','0000-00-00 00:00:00');		
		$this->db->where('id',$trip_id);
		$query_trip_complete = $this->db->get();

		$this->db->select('*');
		$this->db->from('trip_details');
		$this->db->where('trip_start_time','0000-00-00 00:00:00');
		$this->db->where('trip_details.id',$trip_id);		
		$query_trip_update = $this->db->get();
		
		if($query_trip->num_rows() == '0'){	
			$response = array("status" => '2');	
		}  
		else if($query_trip_complete->num_rows() > 0){
			$response = array("status" => '6');	
		} else if($query_trip_update->num_rows() > 0){
			$response = array("status" => '7');	
		} 
		// else if($query_rider->num_rows() > '0') {
		//  	$response = array("status" => '3');	
		// }
		  else {

			$this->db->set('ad_send_status','y');
			$this->db->where('trip_id',$trip_id);
			$update = $this->db->update('adview_rider');

			$this->db->select('advertise.id as ad_id,adview_rider.id as trip_id,ad_view_time,trip_start_time');
			$this->db->from('advertise');
			$this->db->join('adview_rider','adview_rider.ad_id = advertise.id');
			$this->db->join('trip_details','adview_rider.trip_id = trip_details.id');
			$this->db->where('ad_view_status','y');
			$this->db->where('ad_send_status','y');
			$this->db->where('trip_id',$trip_id);
			$query_ads_trip = $this->db->get();	

			if($query_ads_trip->num_rows() > 0) {
				$query_ads_trip_result = $query_ads_trip->result_array();
				
				$status = 'y';
				
				$trip_start_time = '';
				

				if($update){
					foreach($query_ads_trip_result as $result) {
						$ad_id[]= $result['ad_id'];
						$ad_view_time = $result['ad_view_time'];
						$trip_start_time = $result['trip_start_time'];
						$query = $this->db->query("SELECT TIMEDIFF('".$ad_view_time."', '".$trip_start_time."') AS ad_view_duration");

						$query_result = $query->result_array();
						foreach($query_result as $result) {
							$newr[] = $result;
						}
						
						// $ary = [];
						// foreach($query_result as $results) {
						//  	$ary['ad_time'] = $results['days'];
						//  }
						
						// // $query = $this->db->query('UPDATE advertise SET ad_send_status = y WHERE id IN ('.$ad_id.')');
						// // echo $this->db->last_query();
						// $response = array("status" => '1','result'=> $ary);	
						// print_r($ary);

					}					
					$response = array("status" => '1','result'=> $newr);	
					
				}
					
				 else {
					$response = array("status" => '0');	
				}
				

			} else {
				$response = array("status" => '4');	
			}
			return $response;
		}
		return $response;
	}


	function check_tablet_status($driver_id) {
		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('id',$driver_id);
		$query = $this->db->get();

		if($query->num_rows() == '0') {
			$response = array("status" => '0');
		} else {
			$this->db->select('*');
			$this->db->from('driver_registration');
			$this->db->where('id',$driver_id);
			$query_driver = $this->db->get();			
			$query_driver_result = $query_driver->result();

			$ary = [];
			foreach($query_driver_result as $results) {				
				$ary['tablet_status'] = $results->tablet_status;				
			}

			$response = array("status" => '1',"result" => $ary);
		}
		return $response;
	} 

	function make_tablet_on($driver_id) {
		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('id',$driver_id);
		$query = $this->db->get();

		if($query->num_rows() == '0') {
			$response = array("status" => '0');
		} else {
			$this->db->set('tablet_status','1');
			$this->db->where('id',$driver_id);
			$update = $this->db->update('driver_registration');
			$response = array("status" => '1');
		}
		return $response;	
	}

	function make_tablet_off($driver_id) {
		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('id',$driver_id);
		$query = $this->db->get();

		if($query->num_rows() == '0') {
			$response = array("status" => '0');
		} else {
			$this->db->set('tablet_status','0');
			$this->db->where('id',$driver_id);
			$update = $this->db->update('driver_registration');
			$response = array("status" => '1');
		}
		return $response;	
	}
		
	///////////////////////////// Edited by chirag ////////////////////////////////
	function get_trip_status($data){

			$this->db->select('*');
			$this->db->from('trip_details');
			$this->db->where('driver_id',$data['driver_id']);
			$this->db->where('trip_started',"y");
			$this->db->where('trip_complete',"n");
			$query = $this->db->get();			
			if($query->num_rows()>0){
				$result = $query->result();            
				$response  = array("status" => 1,"result"=>$result);
			}else
			{
				$response  = array("status" => 0);
			}
			return $response;

	}
	 function get_mobileno($id){
     			$this->db->select('riders_detail.mobile_number as mobile_number,riders_detail.name as rider_name');
        		$this->db->from('riders_detail');
       			$this->db->where('riders_detail.id', $id);
        		$get = $this->db->get();
        		$result=$get->row_array();        		
        		
        		return $result;
     }
	
	public function forgot_password($post) {
		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('email',$post['email']);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$rand_password = mt_rand(100000, 999999);
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
			$this->db->select('*');
			$this->db->from('driver_registration');
			$this->db->where('username',$post['email']);
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$rand_password = mt_rand(100000, 999999);
				$query_pass =  $query->result_array();
				$this->db->set('password',md5($rand_password));
				$this->db->where('id',$query_pass[0]['id']);
				$update = $this->db->update('driver_registration');

				$email = $query_pass[0]['email'];
		        $subject = 'Forgot Password';
		        $message = ' Driver Forgotten Password details :- <br><br> Email Address : '.$email.' <br><br> Temporary password: '.$rand_password.' ';
		        $this->sendemail($email,$subject,$message);   

				$response = array('status' => 1);
			} else {
				$response = array('status' => 0);	
			}
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
	
// This function is created to update ad views. Driver / Tablet app sends data to update ad views. 
 // for each trip, multiple ad data will come in array 
function driver_add_view_update_model_old($driver_id,$rider_id,$trip_id,$adIdes_id,$adCompleteFlages,$adImpressionFlages,$moreInfoClickedFlages,$moreInfoSubmitFlages,$adActualTimees,$adRiderTimees,$adImpressiones,$adCountes){
//driver_add_view_update_model($post) {
			//$adId=implode(',',$this->input->post('adId'));
			//$adCompleteFlag=implode(',',$this->input->post('adCompleteFlag'));
			//$adImpressionFlag=implode(',',$this->input->post('adImpressionFlag'));
			$this->load->helper('date');
			$data =array(
				'driver_id' => $driver_id, // $this->input->post('driver_id'),
				'rider_id' => $rider_id, //$this->input->post('rider_id'),
				'trip_id' => $trip_id,//$this->input->post('trip_id'),
				'created_date' => date('Y-m-d H:i:s',now()),  

				//'start_date' => date('Y-m-d H:i:s',strtotime($this->input->post('start_date'))) // $created_date,//$this->input->post('created_date'),
				'adId' => $adIdes_id,//$this->input->post('adId'),
				//'phone' => $phone
				'adCompleteFlag' => $adCompleteFlages,//$this->input->post('adCompleteFlag'),
				'adImpressionFlag' => $adImpressionFlages,//$this->input->post('adImpressionFlag'),
				'moreInfoClickedFlag' => $moreInfoClickedFlages,//$this->input->post('moreInfoClickedFlag'),
				'moreInfoSubmitFlag' => $moreInfoSubmitFlages, //$this->input->post('moreInfoSubmitFlag'),
				'adActualTime' => $adActualTimees,//$this->input->post('adActualTime'),
				'adRiderTime' => $adRiderTimees,//$this->input->post('adRiderTime'),
				'adImpression' => $adImpressiones, //$this->input->post('adImpression'),
				'adCount' => $adCountes //$this->input->post('adCount')
				
			);
			// print_r($data);
			// die();

		
				
					$result = $this->db->insert('driver_add_view_update',$data);
					$response = array("status" => 1,"result" => $query_results);
        			return $response;
		}	
		
	  	//echo json_encode($response);
	

	



function driver_add_view_update_model($driver_id,$rider_id,$trip_id,$add_no,$ad_com_flag,$ad_Impr_Flag,$more_Info_Click_Flag, $more_Info_Sub_Flag,$adActualTimees,$ad_Rider_Timees,$ad_Impressiones,$ad_Countes,$adImpression_cost,$adCount_cost,$adViews_Earnings){
//driver_add_view_update_model($post) {
			//$adId=implode(',',$this->input->post('adId'));
			//$adCompleteFlag=implode(',',$this->input->post('adCompleteFlag'));
			//$adImpressionFlag=implode(',',$this->input->post('adImpressionFlag'));	
			$this->load->helper('date');
			$data =array(
				'driver_id' => $driver_id, // $this->input->post('driver_id'),
				'rider_id' => $rider_id, //$this->input->post('rider_id'),
				'trip_id' => $trip_id,//$this->input->post('trip_id'),
				'created_date' => date('Y-m-d H:i:s',now()),  

				//'start_date' => date('Y-m-d H:i:s',strtotime($this->input->post('start_date'))) // $created_date,//$this->input->post('created_date'),
				'adId' =>$add_no ,//$this->input->post('adId'),
				//'phone' => $phone
				'adCompleteFlag' => $ad_com_flag,//$this->input->post('adCompleteFlag'),
				'adImpressionFlag' => $ad_Impr_Flag,//$this->input->post('adImpressionFlag'),
				'moreInfoClickedFlag' => $more_Info_Click_Flag,//$this->input->post('moreInfoClickedFlag'),
				'moreInfoSubmitFlag' =>  $more_Info_Sub_Flag, //$this->input->post('moreInfoSubmitFlag'),
				'adActualTime' => $adActualTimees,//$this->input->post('adActualTime'),
				'adRiderTime' => $ad_Rider_Timees,//$this->input->post('adRiderTime'),
				'adImpression' => $ad_Impressiones, //$this->input->post('adImpression'),
				'adCount' =>$ad_Countes, //$this->input->post('adCount')
				'adImpression_cost' => $adImpression_cost,
				'adCount_cost' => $adCount_cost,
				'adViews_Earnings' => $adViews_Earnings
				//'adImpression_cost' => $adImpression_cost,
				//'adCount_cost' => $adCount_cost
				
			);
			// print_r($data);
			// die();

		
				
					$result = $this->db->insert('driver_add_view_update',$data);
				//	$response = array("status" => 1,"result" => $query_results);
        			return $result;
		}	
		
	  	//echo json_encode($response);
	//above function clear here.


	function Get_Trip_Data($data){
		//SELECT sum(adCount) FROM `driver_add_view_update` WHERE driver_id = "4"
		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('id',$data['driver_id']);
		$query_driver = $this->db->get();

		$this->db->select('*');
		$this->db->from('trip_details');
		$this->db->where('driver_id',$data['driver_id']);
		$this->db->where('trip_complete','y');
		$query_trip = $this->db->get();


		if($query_driver->num_rows() == 0) {
			$response = array("status" => '2');	
		} else if($query_trip->num_rows() == 0) {

			$all_value = array(
								'adCount' =>"0",
								'totaltripduration' =>"00:00:00",
								'totaltrips' =>"0"
								);
			$response = array("status" => '3',"result" => $all_value);	
		} else {
                $today_trips = $query_trip->result_array();
                $trip_ids = array();
				foreach($today_trips as $trip){
					$trip_ids[] = $trip['id'];
				}        

			//this qury for totalads from driver_ad_view_update tabel.
		$this->db->select_sum('adCount');
		$this->db->from('driver_add_view_update');
		$this->db->where('driver_id',$data['driver_id']);
		$this->db->where_in('trip_id',$trip_ids);
		$query = $this->db->get();
		if($query->num_rows() == 0){ 
			$query_adtotal = 0;
		}
		else
		{

			 $query_adtotal = $query->row('adCount');
			//$query_adtotal = $query->num_rows();
		}

				
		//this qury for total trip count from trip_datails.
			$this->db->select('*');
			$this->db->from('trip_details');
			$this->db->where('driver_id',$data['driver_id']);
			$this->db->where('trip_complete','y');
			$query= $this->db->get();
			$total= $query->num_rows();
			//$totaltrip =$total->result();
			
			//this qury for total trip duration 
			
			//select('*, SEC_TO_TIME(SUM(TIME_TO_SEC(`duration`))) AS timeSum ');
		$this->db->select('SEC_TO_TIME(SUM(TIME_TO_SEC(`trip_duration`))) AS totaltripduration ');
		$this->db->from('trip_details');
		$this->db->where('driver_id',$data['driver_id']);
		$this->db->where('trip_complete','y');
		$query = $this->db->get();
		$query_total_trip_duration = $query->row('totaltripduration');
		//  $sql = $this->db->last_query();
                  //   print_r();
                   //   die();

		//for total ad duration
		$this->db->select_sum('adRiderTime');
		$this->db->from('driver_add_view_update');
		$this->db->where('driver_id',$data['driver_id']);
		$this->db->where_in('trip_id',$trip_ids);
		$query_ads_duration = $this->db->get();
		$total_ads_duration = $query_ads_duration->row('adRiderTime');
		if($total_ads_duration == null){
			$total_ads_duration = 0;
		}else{
			$total_ads_duration = $total_ads_duration;
		}
		

			$all_value = array(
								'adCount' =>$query_adtotal,
								'totaltripduration' =>$query_total_trip_duration,
								'totaltrips' =>(string)$total,
								'total_ads_duration' => $total_ads_duration
								);

			
			//$response = array("status" => '1',"result" => $query_adtotal);
			$response = array("status" => '1',"result" => $all_value);
		
		}
		return $response;
	}

	//new function for get duration
	function get_total_ads_duration($driver_id){
		$this->db->select_sum('adRiderTime');
		$this->db->from('driver_add_view_update');
		$this->db->where('driver_id',$driver_id);
		$query = $this->db->get();
		$result = $query->row('adRiderTime');
		if($result == null){
			$result = 0;
		}else{
			$result = $result;
		}
		return $result;

	}
	function get_lifetime_impression($driver_id){
		$this->db->select_sum('adImpression');
		$this->db->from('driver_add_view_update');
		$this->db->where('driver_id',$driver_id);
		$query = $this->db->get();
		$result = $query->row('adImpression');
		if($result == null){
			$result = 0;
		}else{
			$result = $result;
		}
		return $result;

	}

	function get_trip_log($driver_id){

		$this->db->select('*');
		$this->db->where('driver_id',$driver_id);
		$this->db->order_by('trip_complete_time','DESC');
		$query = $this->db->get('trip_details');
		$result = $query->result();
		$count = count($result);
		if($count = 0){
			$response = array("status" => '0', "message" => 'No trip data found for this driver');
		}else{

			$result_array = $ary = array();
			foreach ($result as $data) {				
				$ary['trip_id'] = $data->id;
				$ary['destination'] = $data->end_location;
				$ary['datetime'] = $data->trip_complete_time;
				$ary['ad_duration'] = $this->get_adduration_play($data->id);
				$ary['payment_status'] = "held";
				$result_array[] = $ary;
			}
			$response = array("status" => '1', "result" => $result_array);
			
		}
		return $response;
	}
	function get_adduration_play($trip_id){
		$this->db->select_sum('adRiderTime');
		$this->db->from('driver_add_view_update');
		$this->db->where('trip_id',$trip_id);
		$query = $this->db->get();
		$result = $query->row('adRiderTime');
		if($result == null){
			$result = 0;
		}else{
			$result = $result;
		}
		return $result;
	}
	function driver_earning_monthwise(){
		$driver_id = $_POST['driver_id'];
        $month = $_POST['month'];
        $year = $_POST['year'];

        $this->db->select('*');
        $this->db->where('driver_id',$driver_id);       
        $query3 = $this->db->get('trip_details'); 
        $result3 = $query3->result();
        
         
        if(empty($result3) ){          	
        	$response = array("status" => '0');
       	}else{ 

        $this->db->select('*');
        $this->db->where('driver_id',$driver_id);
        $this->db->where('MONTH(trip_complete_time)',"$month");
        $this->db->where('YEAR(trip_complete_time)',"$year");
        $this->db->order_by('trip_complete_time','ASC');
        $query = $this->db->get('trip_details');       
        $result = $query->result();
        $count = count($result);
		if($count == 0){
			$response = array("status" => '2');
        	}else{

      		$result_array = $ary = array();
        	$count_1 = 0;
        	 
        foreach ($result as $data) {
        	if($count_1 != 0){
        		$curr_date = date("d",strtotime($data->trip_complete_time));
        		if($curr_date == $prev_date){
        		// echo "cmp1";
        		// echo "<br>";
        		$arr_date = $curr_date;
        		$arr_duration += $this->get_adduration_play($data->id);
        		// echo $count_1;
        		// echo $arr_date;
        		// echo "<br>";
        		// echo $arr_duration;
        		// echo "<br>";
        		$prev_date = $curr_date;
        		$ary[$arr_date] = $arr_duration;
        		}else{
        			$arr_date = date("d",strtotime($data->trip_complete_time));
        			$arr_duration = $this->get_adduration_play($data->id);
        			$ary[$arr_date] = $arr_duration;
        			$prev_date = $arr_date;
    			// echo "cmp2";
    			// echo "<br>";
       //  		echo $count_1;
       //  		echo $arr_date;
       //  		echo "<br>";
       //  		echo $arr_duration;
       //  		echo "<br>";
        		}
        	}else{
	        	$arr_date = date("d",strtotime($data->trip_complete_time));
	        	$arr_duration = $this->get_adduration_play($data->id);
        		//$result_array[] = $ary;
        		$ary[$arr_date] = $arr_duration;
        		$prev_date = $arr_date;
        		// echo "cmp3";
        		// echo "<br>";
        		// echo $count_1;
        		// echo $arr_date;
        		// echo "<br>";
        		// echo $arr_duration;
        		// echo "<br>";
        		}

        		

        		$count_1++;
        		$result_array = $ary;
        	}
        	// print_r($result_array);
        	// die();
        	
        	$response = array("status" => '1', "result" => $result_array);
        }

      }    

        return $response;
	}

	public function get_company_ride_data_old($driver_id, $company_name){  

		$this->db->select('driver_id');
		$this->db->where('driver_id',$driver_id);
		$this->db->where('trip_complete','y');
		$query2 = $this->db->get('trip_details');
		$result2 = $query2->result();
		$count_2 = count($result2);
		if($count_2 <= 0){
			return array('status' => 3);
			die();
		}


		$this->db->select('driver_id');
		$this->db->where('driver_id',$driver_id);
		$this->db->where('select_company',$company_name);
		$query1 = $this->db->get('trip_details');
		$result1 = $query1->result();
		$total_trip = $query1->num_rows(); 
		
		
		$this->db->select_sum('driver_add_view_update.adRiderTime');
		$this->db->select_sum('driver_add_view_update.adCount');
		$this->db->select('SEC_TO_TIME(SUM(TIME_TO_SEC(`trip_duration`))) AS totaltripduration ');
		$this->db->from('trip_details');
		$this->db->join('driver_add_view_update','driver_add_view_update.driver_id = trip_details.driver_id');
		$this->db->where('select_company',$company_name);
		$this->db->where('trip_details.trip_complete','y');
		$this->db->where('trip_details.driver_id',$driver_id);  
		$query = $this->db->get();

		
		$t_time = $query->row('totaltripduration');
		if($t_time == null || $t_time == ""){
			$t_time = "00:00:00";
		}

		$total_ride_time = $query->row('adRiderTime');
		$total_ad_played = $query->row('adCount');
		$total_trip_duration = $this->getSecondsFromHMS($t_time);
		

		 if($total_ride_time == null){
		 	$total_ride_time = 0;
		 }
		 if($total_ad_played == null){
		 	$total_ad_played = 0;
		 }
		 // if($total_trip_duration == null){
		 // 	$total_trip_duration = 0;
		 // }

		$result = array(
							'total_ride_time' => $total_ride_time,
							'total_ads_played' => $total_ad_played,
							'total_trip_duration' => $total_trip_duration,
							'total_trip' => $total_trip
						);

		
		return array('status' => 1, 'result' => $result);
	}
	
	
	public function get_company_ride_data($driver_id, $company_name){ //chirag new test function 23-06-2018

		$this->db->select('driver_id,id');
		$this->db->where('driver_id',$driver_id);
		$this->db->where('select_company',$company_name);
		$this->db->where('trip_complete','y');
		$query1 = $this->db->get('trip_details');
		$result1 = $query1->result();
		$total_trip = $query1->num_rows();
        if($total_trip <= 0){
			return array('status' => 3);
			die();
		}
        
        //echo "Total Trip = ".$total_trip;
        $trip_ids = array();
        foreach($result1 as $ret){
            $trip_ids[] = $ret->id;
        }
        
                
        $this->db->select('SEC_TO_TIME(SUM(TIME_TO_SEC(`trip_duration`))) AS totaltripduration ');
		$this->db->where('driver_id',$driver_id);
		$this->db->where('select_company',$company_name);
		$this->db->where('trip_complete','y');
		$query2 = $this->db->get('trip_details');
		
	    //$result2 = $query2->row();
		//print_r($result2);
		
		
		$t_time = $query2->row('totaltripduration');
		if($t_time == null || $t_time == ""){
			$t_time = "00:00:00";
		}
		
		
      
		
		$this->db->select_sum('driver_add_view_update.adRiderTime');
		$this->db->select_sum('driver_add_view_update.adCount');
		$this->db->select_sum('driver_add_view_update.adImpression');
		$this->db->select_sum('driver_add_view_update.adImpression_cost');
		$this->db->select_sum('driver_add_view_update.adCount_cost');
		$this->db->from('driver_add_view_update');
		$this->db->join('trip_details','trip_details.id = driver_add_view_update.trip_id');
		$this->db->where('trip_details.select_company',$company_name);
		$this->db->where_in('trip_id',$trip_ids);
		$this->db->where('trip_details.driver_id',$driver_id);
		//$this->db->where('trip_details.driver_id',$driver_id);
		//$this->db->group_by('driver_add_view_update.id');
		$query = $this->db->get();
       
		

		$total_ride_time = $query->row('adRiderTime');
		$total_ad_played = $query->row('adCount');
		$total_impression_played = $query->row('adImpression');
		$total_ads_cost = $query->row('adCount_cost');
		$total_impression_cost = $query->row('adImpression_cost');
		$total_trip_duration = $this->getSecondsFromHMS($t_time);
	
		

		 if($total_ride_time == null){
		 	$total_ride_time = 0;
		 }
		 if($total_ad_played == null){
		 	$total_ad_played = 0;
		 }
		 if($total_impression_played == null){
		 	$total_impression_played = 0;
		 }
		 if($total_ads_cost == null){
		 	$total_ads_cost = 0;
		 }
		 if($total_impression_cost == null){
		 	$total_impression_cost = 0;
		 }
		 // if($total_trip_duration == null){
		 // 	$total_trip_duration = 0;
		 // }

		$result = array(
							'total_ride_time' => $total_ride_time,
							'total_ads_played' => $total_ad_played,
							'total_impression_played' => $total_impression_played,
							'total_ads_cost' => round($total_ads_cost,2),
							'total_impression_cost' => round($total_impression_cost,3),
							'total_trip_duration' => $total_trip_duration,
							'total_trip' => $total_trip
						);
        
		
		return array('status' => 1, 'result' => $result);
	}
	
	
	
	function getSecondsFromHMS($time) {
	    $timeArr = array_reverse(explode(":", $time));    
	    $seconds = 0;
	    foreach ($timeArr as $key => $value) {
	        if ($key > 2)
	            break;
	        $seconds += pow(60, $key) * $value;
	    }
	    return $seconds;
	}

	function get_driver_payments($driver_id){
		$this->db->select('*');
        $this->db->where('driver_id',$driver_id);       
        $query = $this->db->get('trip_details'); 
        $result = $query->result();
        if(empty($result) ){          	
        	$response = array("status" => '0');
       	}else{ 

       		$this->db->select('driver_id,trip_id');
       		$this->db->where('driver_id',$driver_id);
       		$this->db->distinct('trip_id');
       		$query1 = $this->db->get('driver_add_view_update');

       		 $result1 = $query1 ->result_array();
       		 
       		 if(empty($result1)){
       		 	$response = array("status" => '2');
       		 }else{
       		 $result_array = $name = array();

       		 foreach($result1 as $value){

       		 	$name ['driver_id']  = $value['driver_id'];
       		 	$name['trip_id'] = $value['trip_id'];
       		 	$name['total_erning'] = $this->get_total_erning($value['trip_id'],$value['driver_id']);
       		 	$name['trip_destination'] = $this->get_destination($value['trip_id']);
       		 	$name['trip_complete_time'] = $this->get_trip_complete_time($value['trip_id']);
       		 	$result_array[] = $name;

       		 }      		
       			$response = array('status' => '1', 'result' => $result_array);
       		}
       	}
       	return $response;
	}
	function get_total_erning($trip_id,$driver_id){
		$this->db->select_sum('adViews_Earnings');
		$this->db->where('driver_id',$driver_id);
		$this->db->where('trip_id',$trip_id);
		$query = $this->db->get('driver_add_view_update');

		return $query->row('adViews_Earnings');
	}
	function get_destination($trip_id){
		$this->db->select('*');
		$this->db->where('id',$trip_id);
		$query = $this->db->get('trip_details');
		return $query->row('end_location');	
	}
	function get_trip_complete_time($trip_id){
		$this->db->select('*');
		$this->db->where('id',$trip_id);
		$query = $this->db->get('trip_details');
		return $query->row('trip_complete_time');	

	}



	//get trip data today function
	function Get_Trip_Data_Today($data){
		$driver_id = $data['driver_id'];		
		$curr_date = date('Y-m-d');
		// $driver_id = "15";		
		// $curr_date = "2018-04-11";

		$this->db->select('*');
		$this->db->from('driver_registration');
		$this->db->where('id',$driver_id);
		$query_driver = $this->db->get();


		
		$query_trip = $this->db->query("SELECT * FROM `trip_details` WHERE `driver_id` = '$driver_id' AND DATE(`trip_complete_time`) = '$curr_date' AND `trip_complete` = 'y' ");
        // echo $this->db->last_query();
        // die();
		if($query_driver->num_rows() == 0) {
			$response = array("status" => '2');	
		} else if($query_trip->num_rows() == 0) {

			$all_value = array(
								'adCount' =>"0",
								'totaltripduration' =>"00:00:00",
								'totaltrips' =>"0",
								'total_ads_duration' => "0"
								);
			$response = array("status" => '3',"result" => $all_value);	
		} else {

			$today_trips = $query_trip->result_array();
			$trip_ids = array();
				foreach($today_trips as $trip){
					$trip_ids[] = $trip['id'];
				}

			$this->db->select_sum('adCount');
			$this->db->select_sum('adRiderTime');
			$this->db->from('driver_add_view_update');
			$this->db->where('driver_id',$driver_id);
			$this->db->where_in('trip_id',$trip_ids);
			$query = $this->db->get();
// 			echo $this->db->last_query();
// 			die();
			if($query->row('adCount') == null || $query->row('adCount') == ""){ 
				$query_adtotal = 0;
			}
			else
			{
			 	$query_adtotal = $query->row('adCount');				
			}

			$total_trips = $query_trip->num_rows();

			
			$trip_duration_query = $this->db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`trip_duration`))) AS totaltripduration FROM `trip_details` WHERE `driver_id` = '$driver_id' AND DATE(`trip_complete_time`) = '$curr_date' AND `trip_complete` = 'y' ");
            
            // echo $this->db->last_query();
            // die();
			$query_total_trip_duration = $trip_duration_query->row('totaltripduration');

			if($query->row('adRiderTime') == null || $query->row('adRiderTime') == ""){ 
				$total_ads_duration = 0;
			}
			else
			{
			 	$total_ads_duration = $query->row('adRiderTime');				
			}
			
			if($query_total_trip_duration == null || $query_total_trip_duration == ""){
			    $query_total_trip_duration = "00:00:00";
			}

				$all_value = array(
								'adCount' =>$query_adtotal,
								'totaltripduration' =>$query_total_trip_duration,
								'totaltrips' =>(string)$total_trips,
								'total_ads_duration' => $total_ads_duration
								);

			
			
			$response = array("status" => '1',"result" => $all_value);
	

		}
		
		return $response;
	}


	


} 
/*$insert_id = $this->db->insert_id();

        	$this->db->select('*');
        	$this->db->from('driver_registration');
        	$this->db->where('id',$insert_id);
        	$query = $this->db->get();
        	$query_result = $query->result_array();
        	$query_results = array();
        	foreach($query_result as $result_query){
        		$ary['driver_id'] = $result_query['id'];
        		$ary['name'] = $result_query['name'];
        		$ary['email'] = $result_query['email'];
        		$ary['mobile'] = $result_query['mobile'];
        		$ary['username'] = $result_query['username'];
        		$ary['password'] = $result_query['password'];

        		$query_results[] = $ary;
        	}*/
