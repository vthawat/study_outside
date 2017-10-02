<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Psuoauth2 extends CI_Controller {
/**
* psu oauth2_client controller for developers startup
* author: thawat varachai
*/
	var $access_token;
	var $refresh_token;
	var $client_id;
	var $client_secret;
	var $authorize_url;
	var $access_token_url;
	var $redirect_uri;
	var $ssl_validate;
	var $portal_controller='user';  // sample to endpoint api

	function __construct()
	{
		parent::__construct();
		$this->setConfig();
		$this->load->model('userinfo');

	}
	function index()
	{
			
		$this->userinfo->getOAuthUser(get_cookie('access_token'));
				if($this->userinfo->status_code!=200)
					 $this->authorize_code(); // Start Request Authorize code
				elseif($this->userinfo->status_code==200)
				{
					if($this->userinfo->isAuthorized(get_cookie('access_token'))->isauthorized)
						//access_token successfull
						$this->oauth_to_rbac_sign_in(get_cookie('access_token')); // Start Sing integrate with RBAC library
						//redirect(base_url($this->portal_controller));
					else 
						$this->authorize_code(); // Start Request Authorize code

				}		

				else redirect(base_url($this->portal_controller));  // call to portal controller
				

	}
	function setConfig()
	{
		$this->config->load('psuoauth2');
		$this->client_id=$this->config->item('client_id');
		$this->client_secret=$this->config->item('client_secret');
		$this->authorize_url=$this->config->item('authorize_url');
		$this->access_token_url=$this->config->item('access_token_url');
		$this->redirect_uri=base_url().$this->config->item('redirect_uri');
		$this->ssl_validate=$this->config->item('ssl_validate');
	}
	function oauth_to_rbac_sign_in($access_token=null)
	{
		if(empty($access_token))
			show_error('Invalid access_token', 403);

			$this->load->model('userinfo');
			$userinfo=$this->userinfo->getOAuthUser($access_token);
			if($this->userinfo->status_code==200)
			{
				$active_login_user=$this->ezrbac->getUserByID($this->ezrbac->getUserByUsername($userinfo->username)->id);
				$this->ezrbac->registerUserSession($active_login_user);
				redirect(base_url($this->portal_controller));
			}
			else show_error($this->userinfo->error_description, $this->userinfo->status_code);
	}
	function endpoint()
	{
		
		$access_token=get_cookie('access_token');
		if(empty($access_token))  // access_token expired
			redirect(base_url('psuoauth2'));

			$userinfo=$this->userinfo->getOAuthUser($access_token);
			if($this->userinfo->status_code==200)  // valid access_token
				$this->load->view('endpoint',array('userinfo'=>$userinfo));
				/*
					start code heare for register apps session and redirect private zone

				*/
			else
				show_error('Invalid access_token', 403); // invalid access_token handrer

	}
	function authorize_code()
	{

		$params=array();
		$params['client_id']=$this->client_id;
		$params['redirect_uri']=$this->redirect_uri;
		$params['state']=md5(time());
		$params['scope']='userinfo';
		$params['response_type']='code';
		$callback_url=$this->redirect_uri;
		$client = new GuzzleHttp\Client();

  		try{
   				 $response = $client->request( 'POST',$this->authorize_url,['verify' => $this->ssl_validate,'form_params'=>$params]);

		    if($response->getStatusCode()==200)	 			
		 			redirect($this->authorize_url.'?client_id='.$this->client_id.'&redirect_uri='.$callback_url.'&state='.md5(time()).'&response_type=code');

		 } catch (GuzzleHttp\Exception\BadResponseException $e) {
		    $response = $e->getResponse();
		    $responseBodyAsString = $response->getBody()->getContents();
		    $error=json_decode($responseBodyAsString);
		    show_error($error->error_description, $response->getStatusCode());
		  }

	}

	function callback()
	{
		if(!empty($this->input->get('error')))
			show_error($this->input->get('error_description'), 403);
		$this->access_token($this->input->get('code'));
	
	}
	function access_token($authorize_code=null)
	{
		if(empty($authorize_code))
			show_error('Invalid authorize_code', 403);

		$callback_url=$this->redirect_uri;
		$params = array('client_id' =>$this->client_id,
						'client_secret'=>$this->client_secret,
						'redirect_uri'=>$callback_url,
						'grant_type'=>'authorization_code',
						'code'=>$authorize_code);
		
		/***** Start Authorization code ******/
		$client = new GuzzleHttp\Client();
  		  try {
  		  $response = $client->request( 'POST', 
                                   $this->access_token_url, 
                                  ['verify' => $this->ssl_validate,'form_params'=> $params]);
			    if($response->getStatusCode()==200)
			    {
			    	 $responseBody = json_decode($response->getBody()->getContents());
			    	 // set access_token and refresh token
			    	 $this->set_token($responseBody->access_token,$responseBody->refresh_token,$responseBody->expires_in);
			    	 // start endpoint
			    	redirect(base_url($this->portal_controller));
			   
			    }

		  } catch (GuzzleHttp\Exception\BadResponseException $e) {
		    $response = $e->getResponse();
		    $responseBodyAsString = $response->getBody()->getContents();
		    $error=json_decode($responseBodyAsString);
		    show_error($error->error_description, $response->getStatusCode());
		  }


	}
	function refresh_token($refresh_token=null)
	{
		if(empty($authorize_code))
			show_error('Invalid refresh_token', 403);
	}

	function set_token($access_token=null,$refresh_token=null,$expires_in=null)
	{
		if(empty($access_token)&&empty($refresh_token)) 
			show_error('Invalid refresh_token and access_token', 403);

		// set cookie for access_token refresh_token and expires_in
		$this->access_token=$access_token;
		$this->refresh_token=$refresh_token;
		
		$this->input->set_cookie(array('name'=>'access_token',
								'value'=>$this->access_token,
								'expire'=>$expires_in));

		$this->input->set_cookie(array('name'=>'refresh_token',
								'value'=>$this->refresh_token,
								'expire'=>$expires_in));
		return TRUE;
	}
	function signout()
	{
		$access_token=get_cookie('access_token');
		if(empty($access_token))  // access_token expired
			redirect(base_url('psuoauth2'));
			$userinfo=$this->userinfo->SignOut($access_token);
			if($this->userinfo->status_code==200)  // valid access_token
				{
				//delete_cookie("access_token");

				//redirect(base_url());
				/*
					start code here for destroy apps session and redirect public zone

				*/
				// destory RBAC session
				redirect(base_url('acl/logout'));
				}	
			else
				show_error('Invalid access_token', 403); // invalid access_token handerer
	}
}