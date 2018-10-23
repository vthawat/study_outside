<div class="col-md-5">
<h4><i class="fa fa-fw fa-map-pin"></i>เลือกสถานที่แนะนำ</h4>
<p>องค์ความรู้ที่สนใจ: <?php foreach(json_decode($trips->knowledge_selected,TRUE) as $knowledge):?><span class="label label-primary"><?=$knowledge?></span> <?php endforeach?></p>
<p>สาขาวิชา: <?php foreach(json_decode($trips->subject_major_selected,TRUE) as $subject_major_id):?><span class="label label-success"><?=$this->ftps->get_subject_major($subject_major_id)->major_name?></span> <?php endforeach?></p>
<div>
<ul class="list-gruoup">
<?php foreach($place_relation as $item):?>
<li class="list-group-item">
<h3 class="text-success thai-webfont"><i class="fa fa-fw fa-map-pin"></i><?=$item->place_name?></h3>
<div class="col-md-4 col-xs-6">
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
  <address>ต.<?=$item->DISTRICT_NAME?></address>
  <address>อ.<?=$item->AMPHUR_NAME?></address>
  <address>จ.<?=$item->PROVINCE_NAME?></address>
  <a class="btn btn-primary" data-toggle="modal" href="<?=base_url('staff/place_detail/'.$item->id)?>" data-target=".modal"><i class="fa fa-fw fa-search-plus"></i>ดูรายละเอียด</a>
                        <div class="material-switch pull-right">
                            <input id="place-id-<?=$item->id?>" name="map_place_id[]" type="checkbox"/>
                            <label for="place-id-<?=$item->id?>" class="label-success"></label>
                        </div>
  <div class="clearfix"></div>
</li>
<?php endforeach?>
</ul>
</div>
</div>
<div class="col-md-7"><h4 class="text-center"><i class="fa fa-fw fa-map"></i>เส้นทาง</h4></div>
<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->