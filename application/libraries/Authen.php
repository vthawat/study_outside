<?php
//require_once('nusoap/nusoap.php');
class Authen
	{		

	function credential($usr,$pass)
	{	
			$client = new SoapClient("https://passport.psu.ac.th/Authentication/Authentication.asmx?WSDL");
			$params=array("username"=>$usr,"password"=>$pass);
			$response=$client->GetStaffDetails($params);
			if(empty($response->GetStaffDetailsResult->string[0]))
				return FALSE;
			else {

				$userinfo=array('staff_id'=>$response->GetStaffDetailsResult->string[0],
								'username'=>$usr,
								'first_name'=>$response->GetStaffDetailsResult->string[1],
								'last_name'=>$response->GetStaffDetailsResult->string[2],
								'fac_id'=>$response->GetStaffDetailsResult->string[4]);
				return $userinfo;
			}
	}
		
}
  /* End of file Authen.php */
/* Location: ./application/libaries/Authen.php */