<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| TMD API Configuration 
|--------------------------------------------------------------------------
|
| These are the folders where your modules are located. You may define an
| absolute path to the location or a relative path starting from the root
| directory.
|
| API document https://data.tmd.go.th/nwpapi/doc
*/

/** Access token  */
$config['tmd_access_token']='eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRjZGMzNTEwOTY5ODI2MzY1MjZkNTkxODcwZjBiZjRlNjVjNzE1ODIxY2NhNzFjMzJjNmY4M2NmNGMzMDJjYzhkZTg0NjE5MzFmYTFmIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGNkYzM1MTA5Njk4MjYzNjUyNmQ1OTE4NzBmMGJmNGU2NWM3MTU4MjFjY2E3MWMzMmM2ZjgzY2Y0YzMwMmNjOGRlODQ2MTkzMWZhMWYiLCJpYXQiOjE1MzEyNDAwNzQsIm5iZiI6MTUzMTI0MDA3NCwiZXhwIjoxNTYyNzc2MDc0LCJzdWIiOiIyMjIiLCJzY29wZXMiOltdfQ.EnqaD3pTC-d4n1T8bn4lGO85pxb3JofrzNwxH2KMuItuFF385c-p0z8l5hs2RnbkWclrf-bgagUvxDr-AUASQoe8x5AVliRMFThsamqcDeU1ldtxvmXa8biJ6tzYWOtTXhh0DqVq_r9EoiPGgrrvZpLDmHUiLuGMrh9nu8M_5FUcXwb1Z8OB-K2PHuqoQHgv9DzrF07XRZvMF-zLG3MG6Oq64XgimxrMfC96CDm6qnFdgMFcsbgmV8tNyWJ3hWmK4kTAsjxC03xQoyCXR5RxdEjpBl621hddTPBLtMwNoPdANgWWosQYxKgfoCXJp5qX8bedPz9qDCoYl3-IzC-Dr3W3Pwc8MRFurh5539Py-Vl0upLIYxzLshgavXHkhkuj2OS1EzVrsdFvx7wyW5T2-nJhaGeU_qPtn7JrOvKzt1JNYByBrsRVf_I3vN9dO29I0RSeREDhqSYNFTkB0SDJGzWqV4mkKPJVl5pq-NTR9RoWRdLhBGlOBDGXJHeO27mWwR4fzd19kBaLY1CcyHCyy0EL3U02wVEwGKVnmpv3Xk10EGml71b2SSSJunEkwrxym15K75EjGKpJGiOv6O28lfKECCULojddeafss2GoXJ9GI3GnXFEUjhFXBaf5fiihwFXa4-eKnHYxTIDDH7Gp2jV8KllTqPu1raTeTjPVjaY';

/** API Service URL  ข้อมูลพยากรณ์อากาศรายวัน เชิงพื้นที่ */

$config['tmd_api_forecasts_range_date']='https://data.tmd.go.th/nwpapi/v1/forecast/location/daily';

$config['tmd_api_forecasts_locatin_based']='https://data.tmd.go.th/nwpapi/v1/forecast/location/daily/at';

