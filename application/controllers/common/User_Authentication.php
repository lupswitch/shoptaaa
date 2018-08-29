<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Authentication extends CI_Controller
{
    function __construct() {
		parent::__construct();
		
		// Load facebook library
		$this->load->library('facebook');
		
		//Load user model
		$this->load->model('common/SocialLoginUsers');
    }
    
    public function index(){
		$userData = array();
		
		pr($this->session->userdata());
		// Check if user is logged in
		if($this->facebook->is_authenticated()){
			// Get user facebook profile details
			$userProfile = $this->facebook->request('get', '/me?fields=id,name,first_name,last_name,email,gender,about,picture');

		    // Preparing data for database insertion
            $userData['oauth_provider'] 	= 'facebook';
            $userData['oauth_uid'] 			= $userProfile['id'];
            $userData['firstName'] 			= $userProfile['first_name'];
            $userData['lastName'] 			= $userProfile['last_name'];
            $userData['email'] 				= $userProfile['email'];
            $userData['userGender'] 		= $userProfile['gender'];
        /*  $userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id']; */
            $userData['profileImage'] 		= $userProfile['picture']['data']['url'];
			
            // Insert or update user data
            $FbUserData = $this->SocialLoginUsers->checkFacebookUserAuth($userData);
			
			// Check user data insert or update status
            if(!empty($FbUserData)){
                $data['userData'] = $userData;
                $this->session->set_userdata('is_customer',$FbUserData);
            } else {
               $data['is_customer'] = array();
            }
			
			// Get logout URL
			$data['logoutUrl'] = $this->facebook->logout_url();
		}else{
            $fbuser = '';
			
			// Get login URL
            $data['authUrl'] =  $this->facebook->login_url();
        }
		
		// Load login & profile view
        $this->load->view('user_authentication/index',$data);
    }

	public function logout() {
		// Remove local Facebook session
		$this->facebook->destroy_session();
		// Remove user data from session
		$this->session->unset_userdata('userData');
		// Redirect to login page
        redirect('/fbAuth');
    }
}
