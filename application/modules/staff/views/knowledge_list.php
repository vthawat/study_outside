
<ul class="list-group knowledge-items">
<?php foreach($knowledge_items as $key=>$item):?>
    <li class="list-group-item">
        <div class="col-md-3 col-xs-6">
            <div class="well">
                <img class="img-responsive" src="<?=base_url('images/knowledge/'.$item->images)?>">
                <div class="knowledge-title"><?=$item->title?></div>
            </div>
        </div>
        <div class="col-md-6 knowledge-desc"><?=nl2br($item->desc)?></div>
        <div class="col-md-3">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="fa fa-cog fa-fw"></span><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
                                 <li><a href="<?=base_url('staff/place/edit_knowledge/'.$item->id)?>" class="text-yellow"><i class="fa fa-fw fa-pencil"></i>แก้ไข</a></li>
                                 <li><a href="<?=base_url('staff/delete/knowledge/'.$item->id)?>" class="text-red" onclick="return confirm('ยืนยันการลบรายการ:<?=$item->title?>')"><i class="fa fa-fw fa-remove"></i>ลบ</a></li>
                              </ul>
                        </div>
        </div>
        <div class="clearfix"></div>
    </li>
    
<?php endforeach?>
</ul>
<?php if(empty($knowledge_items)):?>
<div class="alert alert-danger">ไม่พบรายการองค์ความรู้</div>
<?php endif?>