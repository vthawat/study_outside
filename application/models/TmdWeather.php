<?php
class TmdWeather extends CI_Model
{
    var $access_token='';
    var $status_code;
	function __construct()
	{
		parent::__construct();
       // $this->load->library('guzzle');
        $this->load->config('tmd_weather');
		$this->access_token=$this->config->item('tmd_access_token');

    }
    function getDailyFocecasts($date=null,$lat=null,$lon=null)
	{

        $headers=array();
        $bodys=array();
        $url=$this->config->item('tmd_api_focecasts_locatin_based').'?fields=tc_max,cond,rain,rh&duration=1&date='.$date.'&lat='.$lat.'&lon='.$lon;
		// via header parameter
        $headers['authorization']='Bearer '.$this->access_token;
        $headers['accept']='application/json';


		$client = new GuzzleHttp\Client();

  		try{

                $response = $client->request('GET',$url , ['headers' =>$headers]);
				$this->status_code=$response->getStatusCode();
				return json_decode($response->getBody()->getContents());											
		   
		 } catch (GuzzleHttp\Exception\BadResponseException $e) {
			$this->status_code=400;
			$this->output->set_status_header($this->status_code);
		    $response = $e->getResponse();
			return json_decode($response->getBody()->getContents());
		  }
        
    }
}