<?php defined('BASEPATH') OR exit('No direct script access allowed.');
	
	/*** Function sue for print data in <pre> format***/
	
	if(!function_exists('pr'))
	{
		function pr($value)
		{
			Echo "<pre>";
				print_R($value);
			Echo "</pre>";
		}
	}
		 
	if(!function_exists('keys_are_equal'))
	{
		function keys_are_equal($array1, $array2) 
		{
			return !array_diff_key($array1, $array2) && !array_diff_key($array2, $array1);
		}
	}
	
	/*****************************************************************************
		*	Description : Method is used Generate Random string 
		*	Developer   : Er.Parwinder Singh
		*	DOC			: 30th-March-2017	
	******************************************************************************/
	if(!function_exists('rand_string'))
	{	
		
		function rand_string( $length )
		{
			
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			
			$size = strlen( $chars );
			$str = '';
			for( $i = 0; $i < $length; $i++ ){
				$str .= $chars[ rand( 0, $size - 1 ) ];
			}
			
			return $str;
		}
	}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */		
	
	
	/*****************************************************************************
		*	Description : Method is used upload image. 
		*	parameters	: $name( File name), $ImagePath( image path ),$thumbPath( image thumb path )
		*	Developer   : Er.Parwinder Singh
		*	DOC			: 30th-March-2016	
	******************************************************************************/
	
	if(!function_exists('Upload_Single_Images'))
	{	
		function Upload_Single_Images($img, $name, $ImagePath, $thumbPath="")
		{
			
			$CI =& get_instance();
			$CI->load->library('image_lib'); // load library
			
			//$config['upload_path'] = './assets/uploads/profile-img/'; 
			$config['upload_path']   = $ImagePath; 
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '10000';
			$config['max_width']  = '10000';
			$config['max_height']  = '10000';
			$config['file_name'] = $name;
			
			//$CI->load->library('upload', $config);
			$CI->upload->initialize($config);
			//	print_r($config);
			
			if ( ! $CI->upload->do_upload($img))
			{ /* check is image upload or not */
				return $error = array('success' =>'0','error' => $CI->upload->display_errors());
			}
			else
			{
				
				$file = $CI->upload->data();
				$files = glob($config['upload_path'].'/*'); // get all file names
				
				$config = 	array(
				'source_image'      => $file['full_path'], //path to the uploaded image
				/* 'new_image'         => './assets/uploads/profile-img/', //path to */
				'new_image'         => $ImagePath, //path to
				'maintain_ratio'    => True,
				/* 'width'             => 480,
				'height'            => 294 */
				);
				$CI->image_lib->initialize($config);
				$CI->image_lib->resize();
				
				
				$config =	 array(
				'source_image'      => $file['full_path'],
								'new_image'         => './uploads/product_images/thumb_images',
								 //path to
								'maintain_ratio'    => true,
								'width'             => 316,
								'height'            => 236
							);
				
				if(!empty($thumbPath))
				{
					$config['new_image']    = $thumbPath;
				}
				
				//here is the second thumbnail, notice the call for the initialize() function again
				$CI->image_lib->initialize($config);
				$CI->image_lib->resize();
				
				$data = array('upload_data' => $CI->upload->data());
				
				return array('success' =>'1','RtnFileNData' => $file);
			}
		}
	}
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */		
	
	
	/*****************************************************************************
		*	Description : @ProductGalleryUpload is used upload Product Gallery. 
		*	Developer   : Er.Parwinder Singh
		*	DOC			: 31th-March-2016	
	******************************************************************************/
	
	if(!function_exists('ProductGalleryUpload'))
	{	
		
		function ProductGalleryUpload($files)
		{
			
			$CI =& get_instance();
			
			$ImageNewName = 'GalleryImage-'.date('Y-m-d_H:i:s').'-'.rand_string(5).rand_string(5); /* generate the random name */
			$uploadPath = "./uploads/product_images/";
			
			
            $CI->load->library('image_lib'); // load library
			$errorGalleryArray 		=	array ();
			$successGalleryArray 	=	array();
			
			
            $count = count($_FILES['ProductGalleryImage']['name']);
			
			for($i=0; $i<$count; $i++) 
			{
				
				
			    $_FILES['ProductGalleryImage']['name']		= $files['ProductGalleryImage']['name'][$i];
                $_FILES['ProductGalleryImage']['type']		= $files['ProductGalleryImage']['type'][$i];
                $_FILES['ProductGalleryImage']['tmp_name']	= $files['ProductGalleryImage']['tmp_name'][$i];
                $_FILES['ProductGalleryImage']['error']		= $files['ProductGalleryImage']['error'][$i];
                $_FILES['ProductGalleryImage']['size']		= $files['ProductGalleryImage']['size'][$i]; 
				
				$config = array();
				$config['upload_path']  = $uploadPath; 
				$config['allowed_types']= 'gif|jpg|png|jpeg';
				$config['overwrite']    = FALSE;
				$config['file_name'] 	= $ImageNewName;			
				
				$CI->upload->initialize($config);
				$CI->load->library('upload');
		        
				if( ! $CI->upload->do_upload('ProductGalleryImage') )
				{
                    //error coming here
					$errorGalleryArray[] = $CI->upload->display_errors();
				}
                else 
                {
					$successGalleryArray[]  = $CI->upload->data();
				}
				
			}			
			return $AllFileArray = 	array( 	
			'Errors' => $errorGalleryArray , 
			'Success' => $successGalleryArray, 
			);			
		}		
	}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
	
	/*****************************************************************************
		*	Description : Method is used Send Email. 
		*	Developer   : Er.Parwinder Singh
		*	DOC			: 27th-Dec-2016	
	******************************************************************************/
	
	if(!function_exists('SendEmails'))
	{	
		function SendEmails($sendto , $subject, $msg )
		{
			$CI =& get_instance();
			$CI->load->library('email'); // load library
			//>>>>>>>>>>>>>>      Sending Mail       <<<<<<<<<<<<
			$config['protocol'] = 'sendmail';
			$config['charset'] 	= 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config = 	array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'eweba1test@gmail.com',
			'smtp_pass' => 'plokijuh12345',
			'mailtype'  => 'html',
			'charset'   => 'iso-8859-1'
			);			
			$CI->email->set_mailtype("html");
			//$CI->email->initialize($config);			
			//$CI->load->library('email');
			$CI->load->library('email', $config);			
			$CI->email->from('info@shoptaapp.com', 'Shopta App World of E-coommerce');
			$CI->email->to($sendto);
			/* $CI->email->cc('parwinder.singh@a1professionals.info'); 
			$CI->email->bcc('puneet.singh@a1professionals.info'); */			
			$CI->email->subject($subject);
			$CI->email->message($msg);			
			//$CI->email->send(); 
			if($CI->email->send())
			{
				return  true;
			}
			else
			{
				return  false;
			}
		}
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
	}
	if(!function_exists('facebookAccess'))
	{
		function facebookAccess()
		{
			$CI =& get_instance();
			$CI->load->library('facebook'); // load library
			$data['FBAuthUrl'] =  $CI->facebook->login_url();
			$data['logoutUrl'] = $CI->facebook->logout_url();			
			return $data;
		}
	}
	