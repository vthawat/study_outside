<script>

  var place_location=[<?php print $item->lat?>,<?php print $item->long?>];

</script>
<div class="col-md-4 col-sm-12"><h3 class="thai-font"><i class="fa fa-fw fa-search"></i>ที่อยู่</h3>
  <address><?=$item->address?></address>
  <address>ต.<?=$item->DISTRICT_NAME?></address>
  <address>อ.<?=$item->AMPHUR_NAME?></address>
  <address>จ.<?=$item->PROVINCE_NAME?></address>
  <address>รหัสไปรษณีย์ <?php if(!empty($item->district_id)):?><?=$this->zipcode->get_by_district_id($item->district_id)?><?php endif?></address>
  </div>
  <div class="col-md-4 col-sm-12"><h3 class="thai-font"><i class="fa fa-fw fa-search"></i>การติดต่อ</h3>
  <address><?=$item->contact_name?></address>
  <address>ตำแหน่ง <?=$item->contact_position?></address>
  <address>โทรศัพท์ <?=$item->contact_phone?></address>
  <address>โทรสาร <?=$item->contact_fax?></address>
  <address>อีเมล <?=$item->contact_email?></address>
  </div>
  <div class="col-md-4 col-sm-12">
      <h3 class="thai-font"><i class="fa fa-fw fa-search"></i>การประเมินสถานที่</h3>
      <?=nl2br($item->place_spec)?>
  </div>
<div class="clearfix"></div>
<h3 class="thai-font"><i class="fa fa-fw fa-lightbulb-o"></i>องค์ความรู้ของสถานที่</h3>
<?php if(!empty($view_knowledge)):?><?=$view_knowledge?><?php endif?>
<h3 class="thai-font"><i class="fa fa-fw fa-map-o"></i>แผนที่</h3>
<div id="gm-map"></div>
<div class="box-footer text-center">
  <button class="btn icon-btn btn-default" data-dismiss="modal"><span class="btn-glyphicon fa fa-stop img-circle text-gray"></span>Close</button>
</div>