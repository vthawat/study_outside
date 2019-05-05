<?php
    $schedule_items=json_decode($schedule->schedule_json);
   // print_r($schedule_items);
?>
<h3 class="text-blue thai-font" style="text-align: center;">กำหนดการเดินทางศึกษาภาคสนาม<br><?=$subject?><br>จาก<?=$trips->start_location?> ไปยัง จ.<?=$trips->end_location?> เริ่มเดินทางระหว่างวันที่ <?=$this->ftps->DateThai($trips->start_date)?> ถึง
 <?=$this->ftps->DateThai($trips->end_date)?> เป็นเวลา <?=$trips->duration?> วัน</h3>
<?php foreach($schedule_items[0]->schedule_days as $item):?>
<h3 class="thai-font text-green" style="text-align: center;"><?=$item->title;?></h3>
<table class="table">
<?php foreach($schedule_items[0]->start_time as $index=>$start_time):?>
<?php if($item->days==$start_time->days):?>
<tr style="font-size:16px;">
    <td style="text-align: center;"><p><?=$start_time->time?><br>
        <?php if(empty($schedule_items[0]->end_time[$index]->is_lunch)):?>
         <?=$schedule_items[0]->end_time[$index]->time?>
         <?php endif;?></p>
    </td>
    <?php if(empty($schedule_items[0]->arrive_place[$index]->is_lunch)):?>
    <td><p>จาก<?=$schedule_items[0]->arrive_place[$index]->place;?><br>
        ถึง<?=$schedule_items[0]->depart_place[$index]->place;?> 
        <?php if(empty($schedule_items[0]->depart_place[$index]->is_rest_place)):?>
         <?php if($schedule_items[0]->depart_place[$index]->end_place_id!=0):?>
         <?php $place_details=$this->study_place->get_by_id($schedule_items[0]->depart_place[$index]->end_place_id);?>
        <u>การติดต่อ:</u> <?=$place_details->contact_name?> (<?=$place_details->contact_position?>) โทรศัพท์: <?=$place_details->contact_phone?>
        <?php endif?>
<?php endif;?>
    </p></td>
    <?php else:?>
    <td><?=$schedule_items[0]->arrive_place[$index]->place;?></td>
    <?php endif;?>
</tr>
<?php endif;?>
<?php endforeach;?>
</table>
<?php endforeach?>