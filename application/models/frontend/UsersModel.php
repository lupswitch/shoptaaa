<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class UsersModel extends CI_Model
	{
		
		function __construct(){
			//Call the Model constructor
			parent::__construct();
		}
		
		/****************************************************************************
			* Description	: 	Function is use for check frontend user is exist or not
			* Developer		:	PS
			* Date			:	03-April-2017
		****************************************************************************/
		
		public function LoginConfirmation()
		{
			
			$this->db->where('userType','user');
			$this->db->where('is_active',1);
			$this->db->where('email',$this->input->post('email'));
			$this->db->where('password',md5(md5($this->input->post('password'))));
			$query = $this->db->get('Registration');
			$result = $query->result_array();
			
			if(!empty($result)){
				return $result[0];
				}else{
				return $result;
			}
			
		}

		/****************************************************************************
			* Description	: 	Function is use for display profile
			* Developer		:	Puneet singh
			* Date			:	18-April-2017
		****************************************************************************/
		
		public function fetchCurrentUserProfile($userID)
		{
			$this->db->select("*");
			$this->db->from('Registration');
			$this->db->where('userType','user');
			$this->db->where('user_id',$userID);
			$query = $this->db->get();
			$result = $query->result();
			
			if(!empty($result)){
				return $result[0];
				}else{
				return $result;
			}
		}
		
		
		/****UpdateBillingAddress****************************************************************************
			* Description	: 	Function is use for signup
			* Developer		:	Puneet singh
			* Date			:	21-April-2017
		****************************************************************************/
		public function signup($data)
		{
			
			$this->db->insert('Registration', $data);
			$insert_id = $this->db->insert_id();
			
			if(!empty($insert_id))
			{
				$this->db->select('*');
				$this->db->from('Registration');
				$this->db->where('userType','user');
				$this->db->where('is_active',1);
				$this->db->where(array('user_id'=>$insert_id));
				$query = $this->db->get();
				$result = $query->result_array();
				
				
				if(!empty($result))
				{
					return $result[0];
				}
				else
				{
					return false;
				}
				
			}
			else
			{
				return false;
			}
			
		}
		
		
		/****************************************************************************
			* Description	: 	Function is use for Forgot password
			* Developer		:	Puneet singh
			* Date			:	24-April-2017
		****************************************************************************/
		
		public function ForgotPassword($email){
			
			$this->db->select('*');
			$this->db->from('Registration');
			$this->db->where('is_active',1);	
			$this->db->where('email', $email);
			$query = $this->db->get();
			$result = $query->result_array();
			
			if(!empty($result))
			{
				$pass_token = $this->rand_string('20');
				$data = array('password_token' => $pass_token);
				
				$this->db->where('email',$email);
				$this->db->update('Registration',$data);
				
				$result[0]['password_token'] = $data['password_token'];
				return 	$result[0];
			
			}
			else
			{
				
				return false;
				
			}
			
			
		}
		
		
		/****************************************************************************
			* Description	: 	Function is use for generate password token 
			* Developer		:	Puneet singh
			* Date			:	24-April-2017
		****************************************************************************/
		public function rand_string( $length )
		{
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			
			$size = strlen( $chars );
			$str = '';
			for( $i = 0; $i < $length; $i++ )
			{
				$str .= $chars[ rand( 0, $size - 1 ) ];
			}
			
			return $str;
		}
	

		/****************************************************************************
			* Description	: 	Function is use for set new password 
			* Developer		:	Puneet singh
			* Date			:	24-April-2017
		****************************************************************************/
		
		public function ResetPassword($uid, $passtoken)
		{
			
			$NewArray = array(
							'password' => md5(md5($this->input->post('new_passwords'))),
							'password_token' => '',
						);
						
			$this->db->where('`Registration`.`user_id`',$uid);
			return	$this->db->update('Registration',$NewArray);
		
		}
		
		
		/****************************************************************************
			* Description	: 	Function is use for Validate Password Reset Request
			* Developer		:	Puneet singh
			* Date			:	04-may-2017
		****************************************************************************/
		public function ValidatePasswordResetRequest($passtoken)
		{
			
			$this->db->select('*');
			$this->db->from('Registration');
			$this->db->where('password_token', $passtoken);
			$query = $this->db->get();
			$result = $query->result_array();
			
			if(!empty($result))
			{
				return $result[0];
			}else{
				return $result;
			}
				
		}
		
		
		
		/****************************************************************************
			* Description	: 	Function is use for update my address
			* Developer		:	Puneet singh
			* Date			:	05-May-2017
		****************************************************************************/
		
		public function UpdateBillingAddress($data)
		{
			
			
			$this->db->select('*');
			$this->db->from('MyAddress');
			$this->db->where('addr_uid',$GLOBALS['currentUserId']);
			$query = $this->db->get();
			$result = $query->result_array();
			if(!empty($result))
			{
				$this->db->where('addr_uid',$GLOBALS['currentUserId']);
				return $this->db->update('MyAddress',$data);
			}
			else{
			$this->db->insert('MyAddress', $data);
			
			}
		
			
		}

     public function GetAllCountry () {	
     	   $this->db->select('*');
			$this->db->from('countries');
			$query = $this->db->get();
	     return $result = $query->result_array();
  
     
     }	
		
		public function GetUserStatus($uid){


			$this->db->select('*');
			$this->db->from('Registration');
			$this->db->where('is_active',1);	
            $this->db->where(array('user_id'=>$uid));
				$query = $this->db->get();
				$result = $query->result_array();
				
				
				if(!empty($result))
				{
					return $result[0];
				}
				else
				{
					return false;
				}   

		}
		
		
		
	}					