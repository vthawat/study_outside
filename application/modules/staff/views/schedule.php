<h4>กำหนดการเดินทางศึกษาภาคสนาม เส้นทางเริ่มจาก<?=$trips->start_location?> ไปยัง จ.<?=$trips->end_location?> เริ่มเดินทางระหว่างวันที่ <?=$this->ftps->DateThai($trips->start_date)?> ถึง
 <?=$this->ftps->DateThai($trips->end_date)?> เวลา <span class="badge bg-red" style="font-size:20px"><?=$trips->duration?></span> วัน</h4>
<div class="col-md-12">
<?php if(!empty($this->input->post('study_time')))
    {
        $stop_time=$this->input->post('study_time');
      //print_r($stop_time);
    }
?>
            <script>var optimize_routing;
                    var cut_waypoint=[];
                        optimize_routing=<?=$trips->routing?>;
            </script>
  <h3 class="thai-font text-blue"><i class="fa fa-fw fa-wrench"></i>ปรับแต่งกำหนดการเดินทาง</h3>
  <?php
            //if(empty($trips->optimize_routing)) $routing=json_decode($trips->routing);
           // else $routing=json_decode($trips->optimize_routing);
             $routing=json_decode($trips->routing);
             $flag_break=FALSE;
             $flag_rest=FALSE;
             $keep_end_time=array();
             $end_time=0;
             $days=1;
             $break_mode=0;
             $i=0;?>
  <form action="" method="post">
     <table class="table">
     <tr>
                 <td></td>
                 <td></td>
                 <td><h3 class="thai-font"><span class="fa fa-table fa-fw"></span>กำหนดการเดินทางของวันที่ <?=$this->ftps->DateThai($this->study_trip->NextDay($trips->start_date,$days))?></h3></td>
                </tr>
        <tr class="bg-blue-active">
            <th class="col-md-2 col-xs-2 text-center">เวลา</th>
            <th class="col-md-2 col-xs-3 text-center">เวลาดูงาน</th>
            <th>สถานที่</th>
        </tr>
        <tbody>
        <?php foreach($routing as $rout):?>
         <?php if(empty($rout->total_duration)):?>
        <?php                
                 if(!empty($stop_time))
                 { 
                        // first segment time not customize                      
                        if($rout->segment==1||$end_time==0)   $start_time=$this->study_trip->schedule_time_shift($end_time);
                        
                        else $start_time=$this->study_trip->schedule_time_shift($end_time,$stop_time[$i-1]); 
                    if($flag_break)
                    {

                        if($break_mode==2)
                        {                       
                            $break_end_time=$keep_end_time[$i-1];
                            $break_time=$stop_time[$i-1]+3600;
                            $start_time_b=$this->study_trip->schedule_time_shift($break_end_time,$break_time);
                            $start_time=$start_time_b;
                        } 
                     // clear flag break;
                      $flag_break=FALSE;
                      $break_mode=0;
                    } 
                  $end_time=$this->study_trip->schedule_time_shift($start_time,$rout->duration);
                  
                 }
                 else
                 {
                     // load default time calculate of google       
                    $start_time=$this->study_trip->schedule_time_shift($end_time);
                    $end_time=$this->study_trip->schedule_time_shift($start_time,$rout->duration);
                 }
                 
                 $keep_end_time[$i]=$end_time;

                // show place location
                $start_place=$this->study_place->get_by_id($rout->start_place_id);
                if($rout->start_place_id==0)
                    $start_location_details='อ.หาดใหญ่ จ.สงขลา';
                else $start_location_details='อ.'.$start_place->AMPHUR_NAME.' จ.'.$start_place->PROVINCE_NAME;
                $end_place=$this->study_place->get_by_id($rout->end_place_id);
                if($rout->end_place_id==0)
                    $end_location_details='อ.หาดใหญ่ จ.สงขลา';
                else $end_location_details='อ.'.$end_place->AMPHUR_NAME.' อ.'.$end_place->AMPHUR_NAME.' จ.'.$end_place->PROVINCE_NAME;
            ?>
    <?php  if(!empty($stop_time))if($i!=0)if($this->study_trip->isTimeBreak($keep_end_time[$i-1],$start_time)):?>
            <?php $flag_break=TRUE;
                    $break_mode=1;             
                    $break_end_time=$keep_end_time[$i-1];
                    $break_time=$stop_time[$i-1]+3600;
                    $start_time_b=$this->study_trip->schedule_time_shift($break_end_time,$break_time);
                   $start_time=$start_time_b;
                   $end_time=$this->study_trip->schedule_time_shift($start_time,$rout->duration);

            ?>
                <tr class="bg-gray">
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
            <?php $flag_break=TRUE;$break_mode=2;?>
                <tr class="bg-gray">
                 <td class="text-center">1 ชั่วโมง</td>
                 <td></td>
                 <td><input type="text" name="lunch_break[]" class="form-control" value="--พักกลางวัน--"></td>
                </tr>
            <?php endif;?>

            <?php if($days!=$trips->duration):?>
            <?php  if(!empty($stop_time))if($trips->duration>1)if($this->study_trip->isTimeRest($end_time)):?>

            <?php  $end_time=0;$days++?>
                <tr>
                 <td colspan="3">
                 <?php
                    $filter=array();
                    $filter['study_place_rest.amphur_id']=$start_place->amphur_id;
                    $filter['study_place_rest.province_id']=$start_place->province_id;
                 ?>
                 <?php $place_list=$this->study_place_rest->get_all($filter);?>
                 <?php if(empty($place_list)):?>
                    <div class="alert text-red">ไม่พบข้อมูลสถานที่พักค้างคืน ใน <?=$start_location_details?> <a class="btn icon-btn btn-success" href="<?=base_url('staff/place_rest/new');?>"><span class="btn-glyphicon fa fa-home img-circle text-success"></span>เพิ่มสถานที่พักค้างคืน</a></div>
                <?php endif?>
                <?php if(!empty($place_list)):?><h3 class="thai-font text-blue"><i class="fa fa-fw fa-bed"></i> เลือกสถานที่พักค้างคืนใน <?=$start_location_details?></h3><?php endif?>
                <ul class="list-group">
                 <?php if(!empty($place_list)) foreach($place_list as $place_rest):?>
                    <script>
                    cut_waypoint.push({"cut_start_place_id":<?=$rout->start_place_id?>,
                                        "cut_end_place_id":<?=$rout->end_place_id?>,
                                        "cut_segment":<?=$rout->segment?>,
                                        "cut_start_place_lat":<?=$this->study_place->get_by_id($rout->start_place_id)->lat?>,
                                        "cut_start_place_lng":<?=$this->study_place->get_by_id($rout->start_place_id)->long?>,
                                        "cut_start_place_name":"<?=$rout->start_location?>",
                                        "cut_end_place_lat":<?=$this->study_place->get_by_id($rout->end_place_id)->lat?>,
                                        "cut_end_place_lng":<?=$this->study_place->get_by_id($rout->end_place_id)->long?>,
                                        "cut_end_place_name":"<?=$rout->end_location?>",
                                        "schedule_days":<?=$days-1?>,
                                        "rest_place_id":<?=$place_rest->id?>,
                                        "rest_place_lat":<?=$place_rest->lat?>,
                                        "rest_place_lng":<?=$place_rest->long?>,
                                        "rest_place_name":"<?=$place_rest->place_name?>"
                                    });
                </script>
                    <li class="list-group-item">
                    <span>จาก<?=$rout->start_location?> <i class="fa fa-fw fa-angle-double-right"></i>ถึง<?=$place_rest->place_name.' ต.'. $place_rest->DISTRICT_NAME.' อ.'.$place_rest->AMPHUR_NAME?></span>
                    <div class="pull-right">
                    <a class="btn btn-primary" data-toggle="modal" href="<?=base_url('staff/place_rest_detail/'.$place_rest->id)?>" data-target=".modal-place-rest-details"><i class="fa fa-fw fa-search-plus"></i>ดูรายละเอียด</a>
                    <button type="button" data-toggle="modal" class="btn btn-danger select-rest-place" value="<?=$place_rest->id?>"><i class="fa fa-fw fa-map-marker"></i>เลือก</button>
                    </div>
                    <div class="clearfix"></div>
                    </li>
                    
                 <?php endforeach?>
                 </ul>
                 </td>
                </tr>
                <tr>
                 <td></td>
                 <td></td>
                 <td><h3 class="thai-font"><span class="fa fa-table fa-fw"></span>กำหนดการเดินทางของวันที่ <?=$this->ftps->DateThai($this->study_trip->NextDay($trips->start_date,$days))?></h3></td>
                </tr>
                <tr class="bg-blue-active">
            <th class="col-md-2 col-xs-2 text-center">เวลา</th>
            <th class="col-md-1 col-xs-2 text-center">เวลาดูงาน</th>
            <th>สถานที่</th>
        </tr>
            <?php endif;?>
            <?php endif;?> 
        <?php endif;?><?php $i++; ?>
        <?php endforeach?>
        </tbody>
    </table>
    <div class="text-center">
    <button class="btn icon-btn btn-primary save"><span class="btn-glyphicon fa fa-history img-circle text-primary"></span>ปรับแต่งกำหนดการ</button>
    </div>
    </form>
</div>
<div class="modal fade modal-place-rest-details" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade modal-select-place-rest" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="box box-success">
        <div class="box-header"><h3 class="thai-font">คำนวณเส้นทางสำหรับสถานที่พักค้างคืน</h3></div>
        <div class="box-body">
        <div id="map-waypoint-place-rest" class="well"></div>
        <div id="directions-panel"></div>
         </div>
         <div class="box-footer">
            <div class="text-center">
            <button class="btn icon-btn btn-success save-rest-place"><span class="btn-glyphicon fa fa-save img-circle text-success"></span>บันทึก</button>
            <button class="btn icon-btn btn-default"  data-dismiss="modal"><span class="btn-glyphicon fa fa-stop img-circle text-gray"></span>ยกเลิก</button>
            </div>                
         </div>
    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->