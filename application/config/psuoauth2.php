<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Configuration for connect to PSU Passport OAuth2.0 Services
|--------------------------------------------------------------------------
|
| 
|
| WARNING: You MUST set this value!
|
| client_id: 
| client_secret:
| redirect_uri:
| authorize_url:
| access_token_url:
| endpoint_url: url for use api resource 
| ssl_validate: //set TRUE for valid ssl certificate , set FALSE invalid ssl certificate
*/
$config['client_id']='';

$config['client_secret']='';

$config['redirect_uri']='psuoauth2/callback';

$config['authorize_url']='https://dev-oauth2.eng.psu.ac.th/authorize';

$config['access_token_url']='https://dev-oauth2.eng.psu.ac.th/authorize/token';

$config['endpoint_url']='https://dev-oauth2.eng.psu.ac.th/resource/';

$config['ssl_validate']=FALSE;

?>