<table class="table table-responsive">
<thead>
    <th>#</th>
    <th>ภาพประกอบ</th>
    <th>ชื่อองค์ความรู้</th>
    <th>คำอธิบาย</th>
    <th>การจัดการ</th>
</thead>
<tbody>
<?php foreach($knowledge_items as $key=>$item):?>
    <tr>
        <td><?=$key+1?></td>
        <td class="col-md-1 col-sm-4 col-xs-4"><image class="img-responsive" src="<?=base_url('images/knowledge/'.$item->images)?>"></td>
        <td><?=$item->title?></td>
        <td><?=nl2br($item->desc)?></td>
        <td></td>
    </tr>
<?php endforeach?>
</tbody>
</table>