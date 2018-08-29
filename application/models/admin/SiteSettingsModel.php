<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SiteSettingsModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		
		/****************************************************************************
			Description		:	Function use for get social all links 
			Developer		:	Puneet Singh
			Doc				:	07/April/2017
		****************************************************************************/
		
		public function GetSocialLinks(){
			
			$this->db->select('*');
			$this->db->from('SiteOptions');
			$this->db->Where('optionType','socialSetting');
			$query =$this->db->get();
			$result =  $query->result();
			
			if(!empty($result)){
				
				$NewArray = array();
				
				foreach($result as $val){
					$NewArray[$val->optionKey] =  Array
					(
					'optionValue' => $val->optionValue,
					'optionName' => $val->optionName,
					'optionId' => $val->optionId,
					);
				}
				
				return $NewArray;
				
			}
			else
			{
				return $result;
			}
		}	
		
		/****************************************************************************
			Description		:	Function use for update social links 
			Developer		:	Puneet Singh
			Doc				:	07/April/2017
		****************************************************************************/
		
		public function UpdateSocialLinks($optionkey,$optvalue){
			
			$udateDate = array('optionValue' => $optvalue);
			
			$this->db->where('optionKey',$optionkey);
			return $this->db->update('SiteOptions',$udateDate);
			
		}
		
		
		/****************************************************************************
			Description		:	Function use for Get siteoption data
			Developer		:	Puneet Singh
			Doc				:	10/April/2017
		****************************************************************************/
		
		public function GetSiteoptionData(){
			
			$this->db->select('*');
			$this->db->from('SiteOptions');
			$this->db->Where('optionType','siteOption');
			$query =$this->db->get();
			$result =  $query->result();
			
			if(!empty($result)){
				
				$NewArray = array();
				
				foreach($result as $val){
					$NewArray[$val->optionKey] =  Array
					(
						'optionValue' => $val->optionValue,
						'optionName' => $val->optionName,
						'optionId' => $val->optionId,
					);
				}
				
				return $NewArray;
				
			}
			else
			{
				return $result;
			}
		}
		
		
		
		/****************************************************************************
			Description		:	Function use for update Site option
			Developer		:	Puneet Singh
			Doc				:	10/April/2017
		****************************************************************************/
		
		public function UpdateSiteoptionData($optionkey,$optvalue){
			
			$udateDate = array('optionValue' => $optvalue);
			
			$this->db->where('optionKey',$optionkey);
			return $this->db->update('SiteOptions',$udateDate);
			
		}
		
		/****************************************************************************
			Description		:	Function use for update Site option
			Developer		:	Puneet Singh
			Doc				:	10/April/2017
		****************************************************************************/
		
		public function GetOptionData($OptionType){
			
			$this->db->select('*');
			$this->db->from('SiteOptions');
			$this->db->Where('optionType',$OptionType);
			$query =$this->db->get();
			$result =  $query->result();
			
			if(!empty($result)){
				
				$NewArray = array();
				
				foreach($result as $val){
					$NewArray[$val->optionKey] =  Array
					(
						'optionValue' => $val->optionValue,
						'optionName' => $val->optionName,
						'optionId' => $val->optionId,
					);
				}
				
				return $NewArray;
				
			}
			else
			{
				return $result;
			}
			
		}
		
		
		/****************************************************************************
			Description		:	Function use for get contact info data
			Developer		:	Puneet Singh
			Doc				:	15/April/2017
		****************************************************************************/
		public function GetContactInfoData(){
			
			$this->db->select('*');
			$this->db->from('SiteOptions');
			$this->db->Where('optionType','siteContactinfo');
			$query =$this->db->get();
			$result =  $query->result();
			
			if(!empty($result)){
				
				$NewArray = array();
				
				foreach($result as $val){
					$NewArray[$val->optionKey] =  Array
					(
						'optionValue' => $val->optionValue,
						'optionName' => $val->optionName,
						'optionId' => $val->optionId,
					);
				}
				
				return $NewArray;
				
			}
			else
			{
				return $result;
			}
		}
		
		
		/****************************************************************************
			Description		:	Function use for update Contact Us Info
			Developer		:	Puneet Singh
			Doc				:	15/April/2017
		****************************************************************************/
		
		public function UpdateContactUsInfo($optionkey,$optvalue){
			
			$udateDate = array('optionValue' => $optvalue);
			
			$this->db->where('optionKey',$optionkey);
			return $this->db->update('SiteOptions',$udateDate);
			
		}

/****************************************************************************
			Description		:	Function use for update Out of Stock Pro
			Developer		:	Harish Chander
			Doc				:	13/June/2017
		****************************************************************************/

       public function UpdateOutofStockProduct($optionkey,$optvalue)

       {
            $udateDate = array('optionValue' => $optvalue);
			$this->db->where('optionKey',$optionkey);
			return $this->db->update('SiteOptions',$udateDate);





       }

     public function GetOUtofStockData(){
			
			$this->db->select('*');
			$this->db->from('SiteOptions');
			$this->db->Where('optionType','productSettings');
			$query =$this->db->get();
			$result =  $query->result();
			
			if(!empty($result)){
				
				$NewArray = array();
				
				foreach($result as $val){
					$NewArray[$val->optionKey] =  Array
					(
						'optionValue' => $val->optionValue,
						'optionName' => $val->optionName,
						'optionId' => $val->optionId,
					);
				}
				
				return $NewArray;
				
			}
			else
			{
				return $result;
			}
			
		}

 


		
	}			