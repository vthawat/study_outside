<?php
    $schedule_items=json_decode($schedule->schedule_json);
   // print_r($schedule_items);
   $weather_cond=[1=> "ท้องฟ้าแจ่มใส",
                    2 => "มีเมฆบางส่วน",
                    3 => "เมฆเป็นส่วนมาก",
                    4 => "มีเมฆมาก",
                    5 => "ฝนตกเล็กน้อย",
                    6 => "ฝนปานกลาง",
                    7 => "ฝนตกหนัก",
                    8 => "ฝนฟ้าคะนอง",
                    9 => "อากาศหนาวจัด",
                    10 => "อากาศหนาว",
                    11 => "อากาศเย็น",
                    12 => "อากาศร้อนจัด"];
   $days=1;
?>
<h3 class="text-center text-blue thai-font">พยากรณ์อากาศ</h3>
<?php foreach($schedule_items[0]->schedule_days as $item):?>
<h3 class="thai-font text-green text-center"><?=$item->title;?> </h3>
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
         <?php $tmd_focecasts=$this->tmdweather->getDailyFocecasts($this->study_trip->NextDay($trips->start_date,$days),$place_details->lat,$place_details->long);?>
        <br><p><span class="text-blue">พยากรณ์อากาศ</span><br></span> <img src="<?=base_url('images/weather_icon/'.$tmd_focecasts->WeatherForecasts[0]->forecasts[0]->data->cond.'.png')?>"><?=$weather_cond[$tmd_focecasts->WeatherForecasts[0]->forecasts[0]->data->cond]?> อุณหภมิสูงสุด: <?=$tmd_focecasts->WeatherForecasts[0]->forecasts[0]->data->tc_max?> °C <br>
        ความชื้นสัมพัทธเฉลี่ย ที่ระดับพื้นผิว: <?=$tmd_focecasts->WeatherForecasts[0]->forecasts[0]->data->rh?> % ปริมาณฝนรวม 24 ชม.: <?=$tmd_focecasts->WeatherForecasts[0]->forecasts[0]->data->rain?> มม.</p>
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