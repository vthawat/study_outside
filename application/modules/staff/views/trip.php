<?php if(!empty($Trip_list)):?>
	<table class="table table-hover">
		<thead>
			<th>#</th>
			<th>รหัสวิชา-ชื่อวิชา</th>
			<th>วันที่เริ่ม-สิ้นสุด ระยะเวลา(วัน)</th>
            <th>จังหวัดปลายทาง</th>
            <th>การจัดการ</th>
            <th>สถานะล่าสุด</th>   
		</thead>
		<tbody>
        <?php $num=1;foreach($Trip_list as $item):?>
            <tr>
                <td><?=$num?></td>
                <td><?=$this->ftps->get_subject($item->subject_list_id)->subject_code?> <?=$this->ftps->get_subject($item->subject_list_id)->subject_name?></td>
                <td><?=$this->ftps->DateThai($item->start_date)?> <i class="fa fa-fw fa-angle-double-right"></i> <?=$this->ftps->DateThai($item->end_date)?>
                <span><i class="fa fa-fw fa-calendar-o"></i><?=$item->duration?></span></td>
                <td><?=$item->end_location?></td>
                <td>
                			<!-- Single button -->
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="fa fa-cog fa-fw"></span><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
                                <?php if($this->study_trip->check_trip_status($item->status)==1):?>
                                <li><a href="<?=base_url('staff/trip/waypoint/'.$item->id)?>" class="text-green"><span class="fa fa-fw fa-map-marker"></span>สร้างเส้นทาง</a></li>
							    <?php elseif($this->study_trip->check_trip_status($item->status)<=3):?>
<?php if($this->study_trip->has_schedule($item->id)):?><li><a href="<?=base_url('staff/trip/custom_schedule/'.$item->id)?>" class="text-black"><span class="fa fa-fw fa-table"></span>ปรับแต่งกำหนดการเดินทางด้วยตนเอง</a></li><?php endif;?>
                                <li><a href="<?=base_url('staff/trip/schedule/'.$item->id)?>" class="text-green"><span class="fa fa-fw fa-table"></span>สร้างกำหนดการเดินทางอัตโนมัติ</a></li>
                                <li><a href="<?=base_url('staff/trip/waypoint/'.$item->id)?>" class="text-aqua"><span class="fa fa-fw fa-map-o"></span>ปรับเปลี่ยนเส้นทางอัตโนมัติ</a></li>
                                <li><a href="<?=base_url('staff/trip/custom_route/'.$item->id)?>" class="text-blue"><span class="fa fa-fw fa-map"></span>ปรับเปลี่ยนเส้นทางด้วยตนเอง</a></li>
                                <?php endif?>
                                <li><a href="<?=base_url('staff/trip/edit/'.$item->id)?>" class="text-yellow"><span class="fa fa-edit fa-fw"></span>แก้ไข</a></li>
							    <li><a href="<?=base_url('staff/delete/trip/'.$item->id)?>" class="text-red" onclick="return confirm('ยืนยันการลบรายการ?')"><span class="fa fa-remove fa-fw"></span>ลบ</a></li>
							  </ul>
							</div>
                </td>
                <td><?=$item->status?></td>
            </tr>
        <?php $num++;endforeach;?>
        <tbody>
    </table>
<?php endif;?>