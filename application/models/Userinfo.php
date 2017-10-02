<?php
class Userinfo extends CI_Model
{
	var $status_code=400;  // set default
	var $error_description='invalid token';
	var $client_id;
	var $endpoint_url;
	var $ssl_validate;
	function __construct()
	{
		parent::__construct();
		$this->setConfig();
		$this->load->library('guzzle');

	}

	function setConfig()
	{
		$this->config->load('psuoauth2');
		$this->client_id=$this->config->item('client_id');
		$this->ssl_validate=$this->config->item('ssl_validate');
		$this->endpoint_url=$this->config->item('endpoint_url');

	}
	function getOAuthUser($access_token)
	{

		 $client = new GuzzleHttp\Client();
		 $url    = $this->endpoint_url.'userinfo?access_token='.$access_token;
		 try {
		 		  $response = $client->request('GET',$url,['verify' => $this->ssl_validate]);
		 		  if($response->getStatusCode()==200)
		 		  {
		 		  	$this->status_code=$response->getStatusCode();
    				return json_decode($response->getBody()->getContents());
    			  }

		 }
		 catch (GuzzleHttp\Exception\BadResponseException $e) {
		    $response = $e->getResponse();
			if($this->status_code!=400)
			{
		    	$responseBody = json_decode($response->getBody()->getContents());
		  		 $this->status_code=$response->getStatusCode();
		   		 $this->error_description=$responseBody->error_description;
			}
		  }

	}
	function SignOut($access_token)
	{
		 $client = new GuzzleHttp\Client();
		 $url    = $this->endpoint_url.'destroy?access_token='.$access_token;
		 try {
		 		  $response = $client->request('GET',$url,['verify' => $this->ssl_validate]);
		 		  if($response->getStatusCode()==200)
		 		  {
		 		  	$this->status_code=$response->getStatusCode();
    				return json_decode($response->getBody()->getContents());
    			  }

		 }
		 catch (GuzzleHttp\Exception\BadResponseException $e) {
		    $response = $e->getResponse();
			if($this->status_code!=400)
			{
		    	$responseBody = json_decode($response->getBody()->getContents());
		  		 $this->status_code=$response->getStatusCode();
		   		 $this->error_description=$responseBody->error_description;
			}
		  }
	}
	function isAuthorized($access_token)
	{
		$user_id=$this->getOAuthUser($access_token)->username;
		 $client = new GuzzleHttp\Client();
		
		 $url    = $this->endpoint_url.'isUserAuthorized?access_token='.$access_token.'&client_id='.$this->client_id.'&user_id='.$user_id;
		 try {
		 		  $response = $client->request('GET',$url,['verify' => $this->ssl_validate]);
		 		  if($response->getStatusCode()==200)
		 		  {
		 		  	$this->status_code=$response->getStatusCode();
    				return json_decode($response->getBody()->getContents());
    			  }

		 }
		 catch (GuzzleHttp\Exception\BadResponseException $e) {
		    $response = $e->getResponse();
			if($this->status_code!=400)
			{
		    	$responseBody = json_decode($response->getBody()->getContents());
		  		 $this->status_code=$response->getStatusCode();
		   		 $this->error_description=$responseBody->error_description;
			}
		  }
				
	}

}