<p>กำหนดการเดินทางศึกษาภาคสนาม เส้นทางเริ่มจาก<?=$trips->start_location?> ไปยัง จ.<?=$trips->end_location?> เริ่มเดินทางระหว่างวันที่ <?=$trips->start_date?> ถึง
 <?=$trips->end_date?> เป็นระยะเวลา <?=$trips->duration?> วัน</p>
<div class="col-md-12">
<?php if(!empty($this->input->post('study_time')))
    {
        $stop_time=$this->input->post('study_time');
      //print_r($stop_time);
    }
?>
        

  <h3 class="thai-font text-blue"><i class="fa fa-fw fa-wrench"></i>ปรับแต่งกำหนดการเดินทาง</h3>
  <form action="" method="post">
     <table class="table table-hover">
        <thead class="bg-gray">
            <th class="col-md-2 col-xs-2 text-center">เวลา</th>
            <th class="col-md-1 col-xs-2 text-center">เวลาดูงาน</th>
            <th>สถานที่</th>
        </thead>
        <tbody>
        <?php
            $routing=json_decode($trips->routing);
             $flag_break=FALSE;
             $keep_end_time=array();
             $end_time=0;
             $break_mode=0;
             $i=0;?>
        <?php foreach($routing as $rout):?>
         <?php if(empty($rout->total_duration)):?>
        <?php                
                 if(!empty($stop_time))
                 { 
                        // first segment time not customize                      
                        if($rout->segment==1)   $start_time=$this->study_trip->schedule_time_shift($end_time);
                        
                        else $start_time=$this->study_trip->schedule_time_shift($end_time,$stop_time[$i-1]); 
                    if($flag_break) {
                        
                        //$break_time=$stop_time[$i-1]+3600;
                       // $start_time=$this->study_trip->schedule_time_shift($end_time,$break_time);
                      // print $break_time;
                        //$flag_break=FALSE;
                        //print 'breakmode-'.$break_mode;

                       // $start_time=$this->study_trip->schedule_time_shift($keep_end_time[$i-2],$break_time);
                        if($break_mode==2){
                          
                            $break_end_time=$keep_end_time[$i-1];
                            $break_time=$stop_time[$i-1]+3600;
                            $start_time_b=$this->study_trip->schedule_time_shift($break_end_time,$break_time);
                            $start_time=$start_time_b;
                        }  //$start_time=$this->study_trip->schedule_time_shift($keep_end_time[$i-1],$break_time);
                       // print $end_time.'+'.$stop_time[$i-1];
                     //  $start_time=$this->study_trip->schedule_time_shift($end_time,$break_time);
                       // $start_time_b=$this->study_trip->schedule_time_shift($break_end_time,$break_time);
                       //print $break_end_time.'+'. $break_time.'=';
                     // print $this->study_trip->schedule_time_shift($break_end_time,$break_time);
                      //$start_time=$start_time_b;
                     //print $start_time;
                      $flag_break=FALSE;
                       
                    } 
                   // $start_time=$this->study_trip->schedule_time_shift($end_time,$stop_time[$i]);
                    
                    //print $break_mode."<br>";
                    //$start_time=$this->study_trip->schedule_time_shift($end_time,$stop_time[$i-1]);
                  //  print$start_time= $start_time_b;
                   // else $start_time=$this->study_trip->schedule_time_shift($end_time,$stop_time[$i-1]);
                   
                  // $start_time=$this->study_trip->schedule_time_shift($end_time,$stop_time[$i-1]); 
                  $end_time=$this->study_trip->schedule_time_shift($start_time,$rout->duration);
                  $break_mode=0;
                 }
                 else
                 {
                     // load default time calculate of google       
                    $start_time=$this->study_trip->schedule_time_shift($end_time);
                    $end_time=$this->study_trip->schedule_time_shift($start_time,$rout->duration);
                 }
                 
                 $keep_end_time[$i]=$end_time;
                // print  $keep_end_time[$i];
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
    <?php  if(!empty($stop_time))if($i!=0)if($this->study_trip->isTimeBreak($keep_end_time[$i-1],$start_time)):?>
            <?php $flag_break=TRUE;
                $break_mode=1;
               
                    $break_end_time=$keep_end_time[$i-1];
                    $break_time=$stop_time[$i-1]+3600;
                    $start_time_b=$this->study_trip->schedule_time_shift($break_end_time,$break_time);
                   $start_time=$start_time_b;
                   $end_time=$this->study_trip->schedule_time_shift($start_time,$rout->duration);
                   // print   $start_time_b;
             
               // print $i;
           // $start_time=$this->study_trip->schedule_time_shift($end_time,$stop_time[$i-1]+3600); //+3600 sec 
            ?>
                <tr>
                 <td class="text-center">1 ชั่วโมง</td>
                 <td></td>
                 <td><input type="text" name="lunch_break[]" class="form-control" value="--พักกลางวัน--"></td>
                </tr>
            <?php endif;?>
        <tr>
            <td class="text-center"><?=$start_time?> - <?=$end_time?></td>
            <td>
            <?php if($rout->end_place_id!=0):?>
                 <select class="form-control" name="study_time[]">
                        <?php foreach($this->study_trip->study_time as $study_time):?>
                            <?php if((strtotime($study_time)-strtotime('TODAY'))==$stop_time[$i]):?>
                            <option value="<?=strtotime($study_time)-strtotime('TODAY')?>" selected><?=$study_time?></option>
                            <?php else:?>
                            <option value="<?=strtotime($study_time)-strtotime('TODAY')?>"><?=$study_time?></option>
                <?php endif;?>
                        <?php endforeach?>
                </select>
            <?php endif;?>
            </td>
            <td>จาก<?=$rout->start_location?> <?=$start_location_details?> <i class="fa fa-fw fa-angle-double-right"></i>ถึง<?=$rout->end_location?> <?=$end_location_details?></td>
        </tr>
        <?php  if(!empty($stop_time))if($this->study_trip->isTimeBreak($start_time,$end_time)):?>
            <?php $flag_break=TRUE;
             $break_mode=2;
            // $i=$i-1;
            //$start_time=$this->study_trip->schedule_time_shift($end_time,$stop_time[$i-1]+3600); //+3600 sec
           
             ?>
                <tr>
                 <td class="text-center">1 ชั่วโมง</td>
                 <td></td>
                 <td><input type="text" name="lunch_break[]" class="form-control" value="--พักกลางวัน--"></td>
                </tr>
            <?php endif;?>
            
        <?php endif;?><?php $i++; ?>
        <?php endforeach?>
        </tbody>
    </table>
    <div class="text-center">
    <button class="btn icon-btn btn-primary save"><span class="btn-glyphicon fa fa-history img-circle text-primary"></span>ปรับแต่งเวลา</button>
    </div>
    </form>
<?php
/*echo gmdate("i", 34200)."<br>"; // conver second to minute 
$start = strtotime('08:30');
$end   = strtotime('18:00');
$diff  = $end - $start;
echo $diff;
$hours = floor($diff / (60 * 60));
$minutes = $diff - $hours * (60 * 60);
echo 'Remaining time: ' . $hours .  ' hours, ' . floor( $minutes / 60 ) . ' minutes';
*/
//print $this->study_trip->cal_trip_perday();
?>
</div>