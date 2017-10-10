<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <!-- Bootstrap -->
    <link href="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Owl Carousel Assets -->
    <link href="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/css/owl.carousel.css')?>" rel="stylesheet">
    <link href="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/css/owl.theme.css')?>" rel="stylesheet">

    <!-- Pixeden Icon Font -->
    <link rel="stylesheet" href="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/css/Pe-icon-7-stroke.css')?>">

    <!-- Font Awesome -->
    <link href="<?=prep_url($this->config->item('uiux_path').'/web/vendors/Font-Awesome/css/font-awesome.min.css')?>" rel="stylesheet">


    <!-- PrettyPhoto -->
    <link href="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/css/prettyPhoto.css')?>" rel="stylesheet">
    
    <?=$_scripts?>
    <!-- Favicon -->
<link rel="shortcut icon" href="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/ecs/images/app_icons/<?=$this->config->item('uiux_app_icon')?>">

    <!-- Style -->
    <link href="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/css/style.css')?>" rel="stylesheet">
    <link href="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/bootsnipp/custom.css" rel="stylesheet" type="text/css" />

    <link href="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/css/animate.css')?>" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/css/responsive.css')?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
    <?=$_styles?>
</head>

<body>
    <!-- PRELOADER -->
    <div class="spn_hol">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

 <!-- END PRELOADER -->
 <!-- =========================
     START ABOUT US SECTION
============================== -->
    <section class="header parallax home-parallax page" id="HOME">
        <h2></h2>
        <div class="section_overlay">
            <nav class="navbar navbar-default navbar-eng navbar-fixed-top" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                            <?=$app_info?>
                        
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php if(!empty($menu)):?>
                            <?=$menu?>
                        <?php endif;?>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container- -->
            </nav>
            <?=$header?>
        </div>
    </section>

    <!-- END HEADER SECTION -->

<?=$content?>

<!-- =========================
     FOOTER 
============================== -->

    <section class="copyright">
    <?=$footer?>
    </section>
    <!-- END FOOTER -->


<!-- =========================
     SCRIPTS 
============================== -->


    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/jquery.min.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/bootstrap.min.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/owl.carousel.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/jquery.fitvids.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/smoothscroll.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/jquery.parallax-1.1.3.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/jquery.prettyPhoto.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/jquery.ajaxchimp.min.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/jquery.ajaxchimp.langs.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/wow.min.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/waypoints.min.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/jquery.counterup.min.js')?>"></script>
    <script src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/bent/js/script.js')?>"></script>
</body>

</html>