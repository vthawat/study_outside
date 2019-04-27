<?php
    $schedule_items=json_decode($schedule->schedule_json);
   // print_r($schedule_items);
   $days=1;
?>
<h3 class="text-center text-blue thai-font">พยากรณ์อากาศ</h3>
<?php foreach($schedule_items[0]->schedule_days as $item):?>
<h3 class="thai-font text-green text-center"><?=$item->title;?> <?=$days?></h3>
<table class="table">
<?php foreach($schedule_items[0]->start_time as $index=>$start_time):?>
<?php if($item->days==$start_time->days):?>
<tr style="font-size:16px;">
    <td class="text-center"><p><?=$start_time->time?><br>
        <?php if(empty($schedule_items[0]->end_time[$index]->is_lunch)):?>
         <?=$schedule_items[0]->end_time[$index]->time?>
         <?php endif;?></p>
    </td>
    <?php if(empty($schedule_items[0]->arrive_place[$index]->is_lunch)):?>
    <td><p>จาก<?=$schedule_items[0]->arrive_place[$index]->place;?><br>
        <?=$schedule_items[0]->depart_place[$index]->place;?> 
        <?php if(empty($schedule_items[0]->depart_place[$index]->is_rest_place)):?>
         <?php if($schedule_items[0]->depart_place[$index]->end_place_id!=0):?>
         <?php $place_details=$this->study_place->get_by_id($schedule_items[0]->depart_place[$index]->end_place_id);?>
        <br><p><span class="text-blue"><i class="fa fa-fw fa-cloud"></i>พยากรณ์อากาศ:</span> สภาพอากาศโดยทั่วไป</p>
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
<?php $days++;endforeach?>