<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AdminUserModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();		
			$this->load->model('webservices/PushnotificationModel');

		}
		
		/*****************************************************************************
			*	Description : Method is used to check details are in tbl or not
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 27th-March-2016	
		******************************************************************************/	
		
		function loggedIn($LoginData){
			//	pr($LoginData); die(); 
			$this->db->select('*');
			$this->db->from('Registration');
			$where = "  ( `email` ='".$LoginData['email']."' OR   `userName`='".$LoginData['email']."'  ) AND password='".md5(md5($LoginData['password']))."' AND is_active='1' AND `userType`='admin' ";
			
			$this->db->where($where);
			$query = $this->db->get();
			$rtnData = $query->result();	
			/* pr($rtnData); die();  */
			if(!empty($rtnData)){
				//	$this->SetUser_OnLine_LastLogin($rtnData[0]->user_id);
				return 	$rtnData[0];
				
				}else{
				return $rtnData;
			}
		}
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		/*****************************************************************************
			*	Description : Method is used to set user Online value
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 27-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		function SetUser_OnLine_LastLogin($UserId){
			$updateUseronline = array ('last_login'=> strtotime(date('Y-m-d H:i:s')));
			$this->db->where('user_id',$UserId);
			$this->db->update('Registration',$updateUseronline);
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		
		/*****************************************************************************
			*	Description : Method is used to fetch all customer users only
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function getAllCustomers(){
			
			$this->db->select("*");
			$this->db->from('Registration');
			$this->db->where('userType','user');
			$this->db->order_by('registerAt','DESC');
			$query = $this->db->get();
			
			return $rtnCustomerData = $query->result();	
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		/*****************************************************************************
			*	Description : '@CreateUser' is used to Update User based on  passed id
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 29-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function CreateUser($UserData){
			$rntData	= $this->db->insert('Registration', $UserData);
			return  $rntData;
		}	
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		
		/*****************************************************************************
			*	Description : Method is used to fetch all customer users only
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function getAllStaff(){
			
			$this->db->select("*");
			$this->db->from('Registration');
			$this->db->where('userType','staff');
			$this->db->order_by('registerAt','DESC');
			$query = $this->db->get();
			
			return $rtnStaffData = $query->result();	
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		/*****************************************************************************
			*	Description : Method is used Delete a Single record 
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function DeleteUser($uid){
			
          
			$this->db->select("*");
			$this->db->from('Registration');
			$this->db->where('user_id',$uid);
			$query = $this->db->get();
			$rtnStaffData = $query->result_array();
		

			if($rtnStaffData[0]['deviceId'] !='')
			{

			$message = "User Deleted";
		    $this->PushnotificationModel->send_notifications2($rtnStaffData[0]['deviceId'], $message);	
			}
			
			$this->db->where('user_id',$uid);
			return 	$query = $this->db->delete('Registration'); 
			
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		
		
		/*****************************************************************************
			*	Description : '@UpdateUser' is used to Update User based on  passed id
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 29-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function UpdateUser($uId, $UserData){
			$this->db->where('user_id',$uId);
		    $rntData = $this->db->update('Registration', $UserData);
			
			return $rntData;
			
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		/*****************************************************************************
			*	Description : '@GetSingleUser' is @return single cat record based on Id
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 29-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		
		public function GetSingleUser($uId){
			$this->db->select("*");
			$this->db->from('Registration');
			$this->db->where('user_id',$uId);
			$query = $this->db->get();
			$rtnUserData = $query->result();
			
			if(!empty($rtnUserData)){
				return $rtnUserData[0];
				}else{
				return $rtnUserData;
			}
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		/*****************************************************************************
			*	Description : Method is used to fetch Admin prfole
			*	Developer   : Puneet Singh
			*	DOC			: 18-April-2017
		******************************************************************************/	
		
		public function getAdminProfile($uid){
			
			$this->db->select("*");
			$this->db->from('Registration');
			$this->db->where('userType','admin');
			$this->db->where('user_id',$uid);
			$query = $this->db->get();
			$result = $query->result();
			
			if(!empty($result)){
				return $result[0];
				}else{
				return $result;
			}
			
		} 
		
		
		
			/*****************************************************************************
			*	Description : Method is used to fetch all Delivery boys only
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function getAllDeliveryBoys(){
			
			$this->db->select("*");
			$this->db->from('Registration');
			$this->db->where('userType','deliveryboy');
			$this->db->order_by('registerAt','DESC');
			$query = $this->db->get();
			
			return $rtnStaffData = $query->result();	
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
	
		
		
	}	