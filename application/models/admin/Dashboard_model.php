<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model 
{
	public function __construct()
    {
        parent::__construct();
    }
	/*
    public function disk_totalspace($dir = DIRECTORY_SEPARATOR)
    {
        return disk_total_space($dir);
    }


    public function disk_freespace($dir = DIRECTORY_SEPARATOR)
    {
        return disk_free_space($dir);
    }


    public function disk_usespace($dir = DIRECTORY_SEPARATOR)
    {
        return $this->disk_totalspace($dir) - $this->disk_freespace($dir);
    }


    public function disk_freepercent($dir = DIRECTORY_SEPARATOR, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }

        return round(($this->disk_freespace($dir) * 100) / $this->disk_totalspace($dir), 0).$unit;
    }


    public function disk_usepercent($dir = DIRECTORY_SEPARATOR, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }

        return round(($this->disk_usespace($dir) * 100) / $this->disk_totalspace($dir), 0).$unit;
    }


    public function memory_usage()
    {
        return memory_get_usage();
    }


    public function memory_peak_usage($real = TRUE)
    {
        if ($real)
        {
            return memory_get_peak_usage(TRUE);
        }
        else
        {
            return memory_get_peak_usage(FALSE);
        }
    }


    public function memory_usepercent($real = TRUE, $display_unit = FALSE)
    {
        if ($display_unit === FALSE)
        {
            $unit = NULL;
        }
        else
        {
            $unit = ' %';
        }

        return round(($this->memory_usage() * 100) / $this->memory_peak_usage($real), 0).$unit;
    }
	*/
	
/*****************************************************************************
*	Description : Method return Get all users 
*	Developer	:	Manish Kumar Pathak
*	DOC			: 27th-March-2017	
******************************************************************************/	
	
	public function GetAllUsers(){
		
		$this->db->select('Registration.*');
			$this->db->from('Registration');
			$this->db->where('`Registration`.`is_active`','1');
			$this->db->where('`Registration`.`userType`','user');
			$this->db->order_by('`Registration`.`user_id`', 'ASC');
			$query = $this->db->get();
		return	$rtnCodeData = $query->result_array();	
			
	}
	
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */

/*****************************************************************************
*	Description : Method return Get all users 
*	Developer	:	Manish Kumar Pathak
*	DOC			: 28th-March-2017	
******************************************************************************/	
	
	public function get_Total_Customers(){
		
		$this->db->select('Count(*) AS   TotalCustomers');
			$this->db->from('Registration');
			$this->db->where('`Registration`.`userType`','user');
			$this->db->group_by('`userType`');
			$query = $this->db->get();
		$rtnCodeData = $query->result_array();	
		
		if($rtnCodeData){
			return $rtnCodeData[0]['TotalCustomers'];
		}else{
			return $rtnCodeData;
		}
		
			
	}
	
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */	

	
/*****************************************************************************
*	Description : Method return Get all Products count 
*	Developer	:	Manish Kumar Pathak
*	DOC			: 28th-March-2017	
******************************************************************************/	
	
	public function get_Total_Products(){
		
		$this->db->select('Count(*) AS   TotalProducts');
			$this->db->from('Product');
			//$this->db->group_by('`userType`');
			$query = $this->db->get();
		$rtnProData = $query->result_array();	
		
		if($rtnProData){
			return $rtnProData[0]['TotalProducts'];
		}else{
			return $rtnProData;
		}
		
			
	}
	
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */	

	
	
	
	
	
	
	
	
	
}
