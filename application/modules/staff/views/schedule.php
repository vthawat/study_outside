<p>กำหนดการเดินทางศึกษาภาคสนาม เส้นทางจาก<?=$trips->start_location?> ถึง จ.<?=$trips->end_location?> เริ่มเดินทางระหว่างวันที่ <?=$trips->start_date?> ถึง
 <?=$trips->end_date?> เป็นระยะเวลา <?=$trips->duration?> วัน</p>
<div class="col-md-6">
    <h3 class="thai-font text-info"><i class="fa fa-fw fa-table"></i>กำหนดการเดินทางจากระบบสร้างอัตโนมัติ</h3>
    <table class="table table-hover">
        <thead class="bg-gray">
            <th class="col-md-2 col-xs-3 text-center">เวลา</th>
            <th>สถานที่</th>
        </thead>
        <tbody>
        <?php $routing=json_decode($trips->routing)?>
        <?php foreach($routing as $rout):?>
        <?php if(empty($rout->total_duration)):?>
        <tr>
            <?php
                 if($rout->segment==1) $end_time=0;
                 $start_time=$this->study_trip->schedule_time_shift($end_time);
                 $end_time=$this->study_trip->schedule_time_shift($start_time,$rout->duration);
                 
                // show place location
                $start_place=$this->study_place->get_by_id($rout->start_place_id);
                if($rout->start_place_id==0)
                    $start_location_details='อ.หาดใหญ่ จ.สงขลา';
                else $start_location_details='อ.'.$start_place->AMPHUR_NAME.' จ.'.$start_place->PROVINCE_NAME;
                $end_place=$this->study_place->get_by_id($rout->end_place_id);
                if($rout->end_place_id==0)
                    $end_location_details='อ.หาดใหญ่ จ.สงขลา';
                else $end_location_details='อ.'.$end_place->AMPHUR_NAME.' จ.'.$end_place->PROVINCE_NAME;
            ?>
            <td class="text-center"><?=$start_time?> - <?=$end_time?></td>
            <td><?=$rout->start_location?> <?=$start_location_details?> <i class="fa fa-fw fa-angle-double-right"></i><?=$rout->end_location?> <?=$end_location_details?></td>
        </tr>
        <?php endif;?>
        <?php endforeach?>
        </tbody>
    </table>
    <?php
      
   /* $schedule_time=$this->study_trip->schedule_time_shift();
    print $this->study_trip->schedule_time_shift($schedule_time,2000);
    $schedule_time1=$this->study_trip->schedule_time_shift($schedule_time,2000);
    print $this->study_trip->schedule_time_shift($schedule_time1,3000);
*/

    ?>
</div>
<div class="col-md-6">
    <h3 class="thai-font text-green"><i class="fa fa-fw fa-wrench"></i>ปรับแต่งกำหนดการเดินทาง</h3>
</div>