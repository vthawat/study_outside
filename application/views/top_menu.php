<ul class="top-menu nav navbar-nav navbar-right" style="margin-right:10px">
                            <!-- NAV -->
                 <?php if(!$User_info):?>
                      <li><a href="<?=base_url('psuauthen')?>"><i class="fa fa-fw fa-sign-in"></i>Sign-in</a></li>
                  <?php else:?>
                  	<li class="dropdown dropdown-large"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-user"></i><?=$User_info->username?></a>
                  		<ul class="dropdown-menu dropdown-menu-large">
						<li class="col-sm-6 col-xs-12">
							<ul>
								<li class="dropdown-header text-center">Current User</li>
								<li class="text-center"><img class="app-menu-icon img-circle" src="https://dss.psu.ac.th/dss_person/images/staff/<?=$User_info->staff_id?>.jpg"><address><?=$User_info->first_name?> <?=$User_info->last_name?></address></li>
							</ul>
						</li>

						<li class="col-sm-6 col-xs-12">
								<ul>
									<li><a href="<?=base_url('psuauthen/signout')?>"><i class="fa fa-fw fa-sign-out"></i>Sign-Out</a></li>
								</ul>
							</li>
                  		</ul>
                  	</li>
                 <?php endif?>
                        </ul>