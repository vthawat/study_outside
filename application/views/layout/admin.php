<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/ecs/images/app_icons/<?=$this->config->item('uiux_app_icon')?>">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
   
    <!-- Theme style -->
    <link href="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/AdminLTE/dist/css/skins/skin-green.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/bootsnipp/custom.css" rel="stylesheet" type="text/css" />
	<?=$_styles?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/AdminLTE/plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/AdminLTE/dist/js/app.min.js" type="text/javascript"></script>
  	<?=$_scripts?>
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="skin-green sidebar-mini" ng-app="app">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">
	   <div class="hidden-xs">
        <!-- Logo -->
        <a href="<?=base_url()?>" class="logo" style="height:60px">
        	<span class="logo-mini"><img class="std-logo" src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/'.$this->config->item('uiux_app_icon_small'))?>"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" style="font-size: 26px"><img class="std-logo" src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/'.$this->config->item('uiux_app_icon_small'))?>"></span>
        </a>
		</div>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="font-medium thai-font"> <?=$app_name?></span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
		    		<?=$notifications?>
            <?=$menu?>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form (Optional) -->
			<?=$search?>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
			<?=$sidebar?>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="text-info thai-webfont"><?=$page_header?></h1>
          <?=$message?>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <?=$content?>
		<div class="clearfix"></div>
        </section><!-- /.content -->
        <br /><br />
      </div><!-- /.content-wrapper -->
      <!-- Main Footer -->
      <div class="main-footer bg-black">
        <!-- Default to the left -->
        <?=$footer?>
      </div>
    </div><!-- ./wrapper -->

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
  </body>
   <script type="text/javascript">
$(document).ready(function () {
    $('a[href="' + this.location.href + '"]').parent().addClass('active');

    $('a[href="' + this.location.href + '"]').parent().parent().parent().addClass('active');
});
</script>
</html>