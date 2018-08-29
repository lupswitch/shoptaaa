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
				$this->db->select('*');
				$this->db->from('Categary');
				$this->db->where('parent_cat', '0');
				$this->db->where('is_cat_active', '1');
				$query = $this->db->get();
				$categaryData = $query->result_array();
				foreach($categaryData as $categary)
					{
						$subCat = $this->CommonFormate->getSubCatagary($categary['c_id']);
						if ($categary['c_id'] == $subCat[0]['parent_cat'])
							{
								$categary['subCatagary'] = $subCat;
							}
						  else
							{
								$categary['subCatagary'] = [];
							}
						$realData[] = $categary;
					}
				$query = $this->db->query("SELECT * FROM (SELECT * FROM Product y ORDER BY y.pId DESC LIMIT 4) x ORDER BY x.pId ");
				$WelcomeImageData = $query->result_array();
				foreach($WelcomeImageData as $ImageData)
					{
						$productImage = $this->CommonFormate->getproductImage($ImageData['pId']);
						if ($ImageData['pId'] == $productImage[0]['p_id'])
							{
								$ImageData['productImage'] = $productImage;
							}
						  else
							{
								$ImageData['productImage'] = [];
							}
						$realImageData[] = $ImageData;
					}
				return $categary = array(
					'WelcomeImage' => $realImageData,
					'categaryData' => $realData
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