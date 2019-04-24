<?php
    $schedule_items=json_decode($schedule->schedule_json);
   // print_r($schedule_items);
?>
<textarea name="" id="" cols="30" rows="80" class="form-control">
<?php foreach($schedule_items[0]->schedule_days as $item):?>
<?php print nl2br($item->title.'<br>');?>
<?php endforeach?>
</textarea>