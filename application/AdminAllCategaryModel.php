<?php
class AdminAllCategaryModel extends CI_Model

	{
	function __construct()
		{
		parent::__construct();
		$this->load->model('webservices/CommonFormate');
		}

	function getAllCategary()
		{
			

			//$query = $this->db->query("SELECT * FROM Categary ORDER BY c_id DESC");
			$query = $this->db->query("SELECT * FROM Categary");
			$categaryData = $query->result_array();
		
			//$categaryData = $this->_clean_input_data($str);
		
			$this->db->select('*');
			$this->db->from('WelcomeImage');
			//$this->db->order_by('id','DESC');
			$query = $this->db->get();
			$WelcomeImageData = $query->result_array();
			return $categary = array(
				'WelcomeImage' => $WelcomeImageData,
				'categaryData' => $categaryData
			);
		}
	function _clean_input_data($str)
		{
			
			if (is_array($str))
				{
					$new_array = array();
					foreach($str as $key => $val)
						{
							$new_array[$this->_clean_input_keys($key) ] = $this->_clean_input_data($val);
						}					
					return $new_array;
				}
			// We strip slashes if magic quotes is on to keep things consistent

			if (get_magic_quotes_gpc())
				{
				$str = stripslashes($str);
				}
			if ($this->use_xss_clean === TRUE)
				{
					$str = $this->xss_clean($str);
				}
			if (strpos($str, "\r") !== FALSE)
				{
					$str = str_replace(array("\r\n","\r") , "\n", $str);
				}
				
			return $str;
		}
	}

?>