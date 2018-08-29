<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class MY_Controller extends CI_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			$this->load->helper(array('form', 'url', 'string'));
			$this->load->library(array('form_validation', 'email', 'session'));
			$this->load->model('frontend/BottomSocialWidgetModel');
			$this->load->model('frontend/BottomInternalPagesModel');
			$this->load->model('frontend/WishlistModel');
			$this->load->model('admin/SiteSettingsModel');
			
		//	error_reporting(0);
			
			
			

			// Get login URL
         	
			//get social link
			$this->site_data['socialwidget'] = $this->BottomSoicalWidget();
			
			//get active internal pages
			//$this->site_data['internalpages'] = $this->BottomInternalPages();	
			
			//get sitedata for tp header
			
			$this->site_data['HeaderTopSectionData'] = $this->Header_Top_Section();
			
			$this->site_data['HeaderMiddle_Main_MenuSectionData'] = $this->Header_Middle_MainMenu_Section();	
			
			//get copyright data 
			$this->site_data['copyright'] = $this->CopyRightSection();
			
			//get footer column one data
			$this->site_data['footercolumnone'] = $this->FooterColumnOne();
			
			//get footer column two data
			$this->site_data['footercolumntwo'] = $this->FooterColumnTwo();	
			
			//get footer column three data
			$this->site_data['footercolumnthree'] = $this->FooterColumnThree();	
			
			
		}
		
		
		/****************************************************************************
			Description	:	Function use for Get Social Links 
			Developer	:	Puneet Singh
			Doc			:	07/April/2017
		****************************************************************************/
		
		public function BottomSoicalWidget()
		{
			
			$socialLink = $this->BottomSocialWidgetModel->GetSocialLinksWidget();
			$html ="";
			$url ="";
			foreach($socialLink as $Data)
			{	
				if(!empty($Data->optionValue)){
					
					$optionvalue = $Data->optionValue;
					
					$url.='<li><a target="_blank" href="'.$optionvalue.'"><i class="fa fa-'.$Data->optionName.'" aria-hidden="true"></i></a></li>';
					
				}
			}
			
			$html .='<ul>'.$url.'</ul>';
			return $html;
			
		}
		
		
		/****************************************************************************
			Description	:	Function use for Bottom Internal Pages
			Developer	:	Puneet Singh
			Doc			:	07/April/2017
		****************************************************************************/
		
		/* public function BottomInternalPages()
			{
			
			$InternalPages= $this->BottomInternalPagesModel->GetBottomInternalPages();
			
			foreach($InternalPages as $Pages)
			{	
			if($Pages->is_page_active != '0' ){
			
			$pageslug = $Pages->pageSlug;
			$pagename = $Pages->pageTitle;
			
			$pageurl.='<li><a href="'.$pageslug.'">'.$pagename.'</a></li>';
			
			}
			}
			
			$html .='<ul>'.$pageurl.'</ul>';
			return $html;
			
		} */ 
		
		
		/****************************************************************************
			Description	:	Function use for Footer Column One
			Developer	:	Puneet Singh
			Doc			:	12/April/2017
		****************************************************************************/
		
		public function FooterColumnOne()
		{
			
			$data['ColumnOne'] = $this->SiteSettingsModel->GetSiteoptionData();
			
			return $this->load->view('frontend/templates/sub_template/footer_column1', $data , TRUE);
			
		}
		
		
		/****************************************************************************
			Description	:	Function use for Footer Column One
			Developer	:	Puneet Singh
			Doc			:	12/April/2017
		****************************************************************************/
		
		public function FooterColumnTwo()
		{
			
			$data['Columntwo'] = $this->SiteSettingsModel->GetSiteoptionData();
			
			return $this->load->view('frontend/templates/sub_template/footer_column2', $data , TRUE);
			
		}
		
		
		/****************************************************************************
			Description	:	Function use for Footer Column One
			Developer	:	Puneet Singh
			Doc			:	12/April/2017
		****************************************************************************/
		
		public function FooterColumnThree()
		{
			
			$data['Columnthree'] = $this->SiteSettingsModel->GetSiteoptionData();
			
			return $this->load->view('frontend/templates/sub_template/footer_column3', $data , TRUE);
			
		}
		
		
		/****************************************************************************
			Description	:	Function use for Top-Header
			Developer	:	Puneet Singh
			Doc			:	11/April/2017
		****************************************************************************/
		
		public function Header_Top_Section(){
			$PageData['siteData'] = $this->SiteSettingsModel->GetSiteoptionData();
			
				return $this->load->view('frontend/templates/sub_template/header_top_section',$PageData, TRUE);
		}
		
		/****************************************************************************
			Description	:	Function use for Middle and main menu Header
			Developer	:	Puneet Singh
			Doc			:	11/April/2017
		****************************************************************************/
		
		public function Header_Middle_MainMenu_Section(){
		
			$PageData['siteData'] = $this->SiteSettingsModel->GetSiteoptionData();

			if ($this->session->has_userdata('is_customer')) 
			{
				$PageData['wishlistcounter'] = $this->WishlistModel->CountUserWishlist( $this->session->userdata['is_customer']['user_id'] );
				
			}
			else
			{
				$PageData['wishlistcounter'] = '0';
			}
			
			return $this->load->view('frontend/templates/sub_template/header_middel_mainmenu_section',$PageData, TRUE);
		}
		
		
	/****************************************************************************
	*	Description	:	Function use for Copyright section
	*		Developer	:	Puneet Singh
	*		Doc			:	11/April/2017
	*****************************************************************************/
		
		public function CopyRightSection()
		{
			$html="";
			
			$copyright = $this->SiteSettingsModel->GetSiteoptionData();
			if($copyright['is_active_siteCopyrightKey']['optionValue'] == '1'){
				$html.='<p class="coppright" >'.$copyright['siteCopyrightKey']['optionValue'].'</p>';
			}
			return $html;
		}
		
	}					