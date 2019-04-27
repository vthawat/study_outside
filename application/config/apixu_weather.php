<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| APIXU API Configuration 
|--------------------------------------------------------------------------
|
| These are the folders where your modules are located. You may define an
| absolute path to the location or a relative path starting from the root
| directory.
|
| API document https://www.apixu.com/doc/request.aspx
*/

/** API key  */
$config['apixu_key']='29e49c6fbb3b4350979162826171610';

/** API Service URL  ข้อมูลพยากรณ์อากาศรายวัน เชิงพื้นที่ */

$config['apixu_focecasts_location_based']='https://api.apixu.com/v1/forecast.json';

