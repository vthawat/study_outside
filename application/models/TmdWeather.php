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
	function is_in_range_forecasts($date)
	{
        $headers=array();
        $url=$this->config->item('tmd_api_forecasts_range_date');
		// via header parameter
        $headers['authorization']='Bearer '.$this->access_token;
        $headers['accept']='application/json';


		$client = new GuzzleHttp\Client();

  		try{

                $response = $client->request('GET',$url , ['headers' =>$headers]);
				$this->status_code=$response->getStatusCode();
				$forecasts=json_decode($response->getBody()->getContents());
				$start_date=$forecasts->daily_data->min;
				$end_date=$forecasts->daily_data->max;
			//	print $start_date;
				//print_r($forecasts);
				$now = new DateTime($date);
				$startdate = new DateTime($start_date);
				$enddate = new DateTime($end_date);
			
				if($startdate <= $now && $now <= $enddate) {
					return TRUE;
				}else{
					return FALSE;
				}
				
				
		   
		 } catch (GuzzleHttp\Exception\BadResponseException $e) {
			$this->status_code=400;
			$this->output->set_status_header($this->status_code);
		    $response = $e->getResponse();
			return json_decode($response->getBody()->getContents());
		  }
	}
    function getDailyFocecasts($date=null,$lat=null,$lon=null)
	{
		if($this->is_in_range_forecasts($date))
		{

			$headers=array();
			$url=$this->config->item('tmd_api_forecasts_locatin_based').'?fields=tc_max,cond,rain,rh&duration=1&date='.$date.'&lat='.$lat.'&lon='.$lon;
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
		else return FALSE;
    }
}