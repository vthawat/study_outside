<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $CI =& get_instance();?>
   <link rel="shortcut icon" href="<?=prep_url($CI->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/receipt.png')?>">

    <title>Error</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=prep_url($CI->config->item('uiux_path'))?>/web/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=prep_url($CI->config->item('uiux_path'))?>/web/vendors/Font-Awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=prep_url($CI->config->item('uiux_path'))?>/web/vendors/ecs/css/error-404.css" rel="stylesheet">
  </head>
  <body>
		<div class="container">
		    <div class="row">
		        <div class="col-md-12">
		            <div class="error-template well">
		            	<div class="jumbotron">
		                <h1>Oops!</h1>
		                <h2>Error <?=$status_code?></h2>
		                <div class="error-details">
		                    <?=$message?>
		                </div>
		                <div class="error-actions">
		                    <a href="<?=base_url()?>" class="btn btn-primary btn-lg"><span class="fa fa-fw fa-home"></span>Home</a> 
							<a href="<?=base_url()?>" class="btn btn-warning btn-lg"><span class="fa fa-fw fa-home"></span>Back</a>
		                </div>
		            </div>
		            </div>
		        </div>
		    </div>
		</div>  	
  </body>
</html>