<ul class="list-gruoup">
<?php foreach($Study_place as $item):?>
<li class="list-group-item">
  <h4 class="text-primary"><i class="fa fa-fw fa-map-pin"></i><?=$item->place_name?></h4>
  <div class="col-md-5 col-sm-12"><h4>ที่อยู่</h4>
  <address><?=$item->address?></address>
  <address>ตำบล<?=$item->DISTRICT_NAME?></address>
  <address>อำเภอ<?=$item->AMPHUR_NAME?></address>
  <address>จังหวัด<?=$item->PROVINCE_NAME?></address>
  <address>รหัสไปรษณีย์ <?=$this->zipcode->get_by_district_id($item->district_id)?></address>
  </div>
  <div class="col-md-4 col-sm-12"><h4>การติดต่อ</h4>
  <address>ชื่อ-นามสกุล <?=$item->contact_name?></address>
  <address>ตำแหน่ง <?=$item->contact_position?></address>
  <address>โทรศัพท์ <?=$item->contact_phone?></address>
  <address>โทรสาร <?=$item->contact_fax?></address>
  <address>อีเมล <?=$item->contact_email?></address>
  </div>
  <div class="col-md-3">
  					<!-- Single button -->
            <div class="btn-group">
							  <a class="btn btn-primary" href=""><i class="fa fa-fw fa-search-plus"></i>ดูรายละเอียด</a>
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