<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class UserfeedModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		
		/****************************************************************************
			Description		:	Function use for store user feed in Userfeed table
			Developer		:	Puneet Singh
			Doc				:	15/April/2017
		****************************************************************************/
		
		public function AddUserFeedData($feed)
		{
			return $RetnNewPro = $this->db->insert('UserFeedback', $feed);
		}
		
		/* <<<<< end here >>>>>>> */
		
	}