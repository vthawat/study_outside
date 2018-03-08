<?php if(!$User_info):?><div class="container"><?php endif?>
    <div class="row thai-font footer">
            <div class="col-md-4">
                        <div><img class="footer-app-icon" src="<?=$app_icon?>"></div>                
                        <h3 class="title thai-font"><?=$app_name?></h3>
                        <ul class="list-unstyled">
                            <li></li>
                            <?php if(!empty($app_desc)):?><li><?=$app_desc?></li><?php endif?>
                            <li><?=$app_version?></li>
                        </ul>
                </div>
                <div class="col-md-offset-1 col-md-3 col-sm-4 col-xs-6 col-footer phone">
                <h3 class="title thai-font">ผู้ดูแลระบบ</h3>
                <ul class="list-unstyled">
                            <li><?=$app_admin_department?></li>
                            <li>คณะทรัพยากรธรรมชาติ</li>
                            <li>มหาวิทยาลัยสงขลานครินทร์</li>
                        </ul>
                </div>
                <div class="col-md-offset-1 col-md-3 col-sm-4 col-xs-6 col-footer phone">
                <h3 class="title thai-font">การติดต่อ</h3>
                <ul class="list-unstyled">
                            <li><i class="fa fa-fw fa-user"></i><?=$app_admin_contact?></li>
                            <li><i class="fa fa-fw fa-envelope"></i><?=$app_admin_email?></li>
                            <li><i class="fa fa-fw fa-phone"></i><?=$app_admin_phone?></li>
                        </ul>
                </div>

    </div>
    <?php if(!$User_info):?></div><?php endif?>