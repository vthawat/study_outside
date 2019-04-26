<?php
    $schedule_items=json_decode($schedule->schedule_json);
   // print_r($schedule_items);
?>
<?php foreach($schedule_items[0]->schedule_days as $item):?>
<h4 align="center"><?=$item->title;?></h4><br>
<table class="table">
<?php foreach($schedule_items[0]->start_time as $index=>$start_time):?>
<?php if($item->days==$start_time->days):?>
<tr>
    <td><?=$start_time->time?><br>
        <?php if(empty($schedule_items[0]->end_time[$index]->is_lunch)):?>
         <?=$schedule_items[0]->end_time[$index]->time?>
         <?php endif;?>
    </td>
    <?php if(empty($schedule_items[0]->arrive_place[$index]->is_lunch)):?>
    <td>จาก<?=$schedule_items[0]->arrive_place[$index]->place;?><br>
        ถึง<?=$schedule_items[0]->depart_place[$index]->place;?>
    </td>
    <?php else:?>
    <td><?=$schedule_items[0]->arrive_place[$index]->place;?></td>
    <?php endif;?>
</tr>
<?php endif;?>
<?php endforeach;?>
</table>
<?php endforeach?>