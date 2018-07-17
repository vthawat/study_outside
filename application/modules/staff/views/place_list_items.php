<ul class="list-gruoup">
<?php foreach($Study_place as $item):?>
<li class="list-group-item">
  <h3 class="text-success thai-webfont"><i class="fa fa-fw fa-map-pin"></i><?=$item->place_name?></h3>
  <div class="col-md-3 col-xs-6">
  <?php  $knowledge_items=$this->study_place->get_knowledge_by_study_place_id($item->id);?>
  <?php if(!empty($knowledge_items)):?>   
          <div class="well">
                <img class="img-responsive" src="<?=base_url('images/knowledge/'.$knowledge_items[0]->images)?>">
            </div>

  <?php else:?>
          <div class="well">
                  <img class="img-responsive" src="<?=base_url('images/knowledge/none-images.png')?>">
          </div>
  <?php endif?>
  </div>
  <div class="col-md-4 col-sm-12"><h3 class="thai-font">ที่อยู่</h3>
  <address><?=$item->address?></address>
  <address>ต.<?=$item->DISTRICT_NAME?></address>
  <address>อ.<?=$item->AMPHUR_NAME?></address>
  <address>จ.<?=$item->PROVINCE_NAME?></address>
  <address>รหัสไปรษณีย์ <?php if(!empty($item->district_id)):?><?=$this->zipcode->get_by_district_id($item->district_id)?><?php endif?></address>
  </div>
  <div class="col-md-4 col-sm-12"><h3 class="thai-font">การติดต่อ</h3>
  <address><?=$item->contact_name?></address>
  <address>ตำแหน่ง <?=$item->contact_position?></address>
  <address>โทรศัพท์ <?=$item->contact_phone?></address>
  <address>โทรสาร <?=$item->contact_fax?></address>
  <address>อีเมล <?=$item->contact_email?></address>
  </div>
    <div class="clearfix"></div>
    <div class="col-md-offset-8 col-md-4">
  					<!-- Single button -->
            <div class="btn-group">
							  <a class="btn btn-primary" data-toggle="modal" href="<?=base_url('staff/place_detail/'.$item->id)?>" data-target=".modal"><i class="fa fa-fw fa-search-plus"></i>ดูรายละเอียด</a>
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="fa fa-cog fa-fw"></span><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
                  <li><a href="<?=base_url('staff/place/knowledge/'.$item->id)?>" class="text-blue"><i class="fa fa-fw fa-info-circle"></i>องค์ความรู้ของสถานที่</a></li>
                  <li><a href="<?=base_url('staff/place/edit/'.$item->id)?>" class="text-yellow"><i class="fa fa-fw fa-pencil"></i>แก้ไข</a></li>
                  <li><a href="<?=base_url('staff/delete/place/'.$item->id)?>" class="text-red" onclick="return confirm('ยืนยันการลบรายการสถานที่: <?=$item->place_name?>?')"><i class="fa fa-fw fa-remove"></i>ลบ</a></li>
							  </ul>
							</div>
  
  </div>
  <div class="clearfix"></div>
</li>
<?php endforeach?>
</ul>
<div class="text-center"><?=$this->pagination->create_links()?></div>
<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->