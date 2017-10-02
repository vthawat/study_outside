               <ul class="top-menu nav navbar-nav navbar-right" style="margin-right:10px">
                            <!-- NAV -->
                          	<li class="dropdown dropdown-large">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-th"></i>Applications</a>
				
				<ul class="dropdown-menu dropdown-menu-large row">
					<li class="col-sm-4 col-xs-6">
						<ul>
							<li class="dropdown-header text-center">Often App</li>
							<li class="text-center"><a href="https://dev-saas.eng.psu.ac.th/receipt"><img src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/receipt.png')?>" class="app-menu-icon"><address>Receipt System</address></a></li>
							<li class="text-center"><a href="https://dev-saas.eng.psu.ac.th/rtp"><img src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/strategy.png')?>" class="app-menu-icon"><address>Special Case Student Registration</address></a></li>
							<li class="text-center"><a href="https://dev-saas.eng.psu.ac.th/projects"><img src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/projects.png')?>" class="app-menu-icon"><address>Progress & Tracking</address></a></li>
							
						</ul>
					</li>
					<li class="col-sm-4 col-xs-6">
						<ul>
							<li class="dropdown-header text-center">Private App</li>
							<li class="text-center"><a href="#"><img src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/shield.png')?>" class="app-menu-icon"><address>My Account</address></a></li>
							<li class="text-center"><a href="#"><img src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/pick-app.png')?>" class="app-menu-icon"><address><i class="fa fa-fw fa-plus"></i>Add-on</address></a></li>
							<li class="text-center"><a href="#"><img src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/pick-app.png')?>" class="app-menu-icon"><address><i class="fa fa-fw fa-plus"></i>Add-on</address></a></li>
						</ul>
					</li>
					<li class="col-sm-4 col-xs-12">
						<ul>
							<li class="dropdown-header text-center">Information Centric</li>
							<li class="text-center"><a href="#"><img src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/app-center.png')?>" class="app-menu-icon"><address>Apps Center</address></a></li>
							<li class="text-center"><a href="#"><img src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/layers.png')?>" class="app-menu-icon"><address>Info Portal</address></a></li>
						</ul>
					</li>
				</ul>
				
			</li>
			 <li class="dropdown">
                            	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-language"></i>Language</a>
                            	<ul class="dropdown-menu">
                            		<li><a href="#"><img src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/flag-en.png')?>"> English</a></li>
                            		<li><a href="#"><img src="<?=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/flag-th.png')?>"> Thai</a></li>
                            	</ul>
                            </li>
                 <?php if(empty($User_info)):?>
                      <li><a href="<?=base_url('psuoauth2')?>"><i class="fa fa-fw fa-sign-in"></i>Sign-in</a></li>
                  <?php else:?>
                  	<li class="dropdown dropdown-large"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-user"></i><?=$User_info->username?></a>
                  		<ul class="dropdown-menu dropdown-menu-large">
						<li class="col-sm-6 col-xs-6">
							<ul>
								<li class="dropdown-header text-center">Current User</li>
								<li class="text-center"><img class="app-menu-icon" src="<?=prep_url($this->config->item('uiux_path'))?>/web/vendors/ecs/images/avatar/user.png"><address><?=$User_info->first_name?> <?=$User_info->last_name?></address></li>
							</ul>
						</li>
						<li class="col-sm-6 col-xs-6">
							<ul>
								<li class="dropdown-header">Role Selector</li>
								<li><a><i class="fa fa-fw fa-angle-double-right" aria-hidden="true"></i>Student</a></li>
								<li><a><i class="fa fa-fw fa-angle-double-right" aria-hidden="true"></i>Staff</a></li>
							</ul>
						</li>
						<li class="col-sm-6 col-xs-12">
								<ul>
								<li class="divider"></li>
								<li><a href="#"><i class="fa fa-fw fa-bell-o"></i>Notification <span class="pull-right label label-danger ">10</span></a></li>
								<li><a href="<?=base_url('psuoauth2/signout')?>"><i class="fa fa-fw fa-sign-out"></i>Sign-Out</a></li>
								</ul>
							</li>
                  		</ul>
                  	</li>
                 <?php endif?>
                        </ul>