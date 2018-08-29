<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class FBUser extends CI_Model{
	function __construct() {
		$this->tableName = 'Registration';
		$this->primaryKey = 'user_id';
	}
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
			
			
			
			$userID = $prevResult['user_id'];
		}else{
			$data['registerAt'] = date("Y-m-d H:i:s");
			$data['modifiedAt'] = strtotime(date("Y-m-d H:i:s"));
			
			$insert = $this->db->insert('`Registration`',$data);
			$userID = $this->db->insert_id();
		}

		return $userID?$userID:FALSE;
    }
}
