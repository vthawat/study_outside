<ul class="list-gruoup">
<?php foreach($Study_place as $item):?>
<li class="list-group-item">
  <h4 class="text-success"><i class="fa fa-fw fa-map-pin"></i><?=$item->place_name?></h4>
  <div class="col-md-6"><h4>ที่อยู่</h4>
  <address><?=$item->address?></address>
  <address>ตำบล<?=$item->DISTRICT_NAME?></address>
  <address>อำเภอ<?=$item->AMPHUR_NAME?></address>
  <address>จังหวัด<?=$item->PROVINCE_NAME?></address>
  <address>รหัสไปรษณีย์ <?=$this->zipcode->get_by_district_id($item->district_id)?></address>
  </div>
  <div class="col-md-6"><h4>การติดต่อ</h4>
  <address>ชื่อ-นามสกุล <?=$item->contact_name?></address>
  <address>ตำแหน่ง <?=$item->contact_position?></address>
  <address>โทรศัพท์ <?=$item->contact_phone?></address>
  <address>โทรสาร <?=$item->contact_fax?></address>
  <address>อีเมล <?=$item->contact_email?></address>
  </div>
    <div class="clearfix"></div>
</li>
<?php endforeach?>
</ul>