<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SocialLoginUsers extends CI_Model{
	function __construct() {
		
		parent::__construct();
		$this->tableName = 'Registration';
		$this->primaryKey = 'user_id';
	}
	

	
/**************************************************************************************
* Description	: 	'@checkFacebookUserAuth' is use for check_user data of FB for Login and signup
* Developer		:	Er.Parwinder Singh
* Date			:	25th-April-2017
**************************************************************************************/
		
		public function checkFacebookUserAuth($data = array()){
		
		$this->db->select('user_id');
		$this->db->from('`Registration`');
		
		$whereCon = " ( `email` ='".$data['email']."'  OR ( `oauth_provider` = '".$data['oauth_provider']."' AND `oauth_uid`= '".$data['oauth_uid']."' ) )  ";
		
		 /*$this->db->where(array('oauth_provider'=> $data['oauth_provider'],'oauth_uid'=>$data['oauth_uid'])); */
		$this->db->where($whereCon);
			$prevQuery = $this->db->get();
			$prevCheck = $prevQuery->num_rows();
		
		if($prevCheck > 0){
			$prevResult = $prevQuery->row_array();
				unset($data['email']);
				unset($data['oauth_provider']);
		
			
			$data['modifiedAt'] = strtotime(date("Y-m-d H:i:s"));
			
			$update = $this->db->update('`Registration`',$data,array('user_id'=>$prevResult['user_id']));
			
			if($update == true){
				return	$retbData =	$this->GetUserDeatil($prevResult['user_id']);
			}else{
				return false;
			}
			
			
		}else{
			
			$data['registerAt'] = date("Y-m-d H:i:s");
			$data['modifiedAt'] = strtotime(date("Y-m-d H:i:s"));
			
			$insert = $this->db->insert('`Registration`',$data);
			$userID = $this->db->insert_id();
			
			if(!empty($userID)){
				return	$retbData =	$this->GetUserDeatil($userID);
			}else{
				return FALSE;
			}
			
		}

	}
	
	
	
		function GetUserDeatil($uid){
			
			$this->db->select("*");
			$this->db->from('Registration');
			$this->db->where('user_id',$uid);
			$query = $this->db->get();
			$result = $query->result_array();
			
			if(!empty($result)){
				return $result[0];
			}else{
				return FALSE;
			}
		}
		
		
}
