<?php if(!empty($Trip_list)):?>
	<table class="table table-hover">
		<thead>
			<th>#</th>
			<th>รหัสวิชา-ชื่อวิชา</th>
			<th>วันที่เริ่ม-สิ้นสุด</th>
            <th>ระยะเวลา</th>
            <th>จังหวัดปลายทาง</th>
            <th>สถานะ</th>
            <th>การจัดการ</th>
		</thead>
		<tbody>
        <?php $num=1;foreach($Trip_list as $item):?>
            <tr>
                <td><?=$num?></td>
                <td><?=$this->ftps->get_subject($item->subject_list_id)->subject_code?> <?=$this->ftps->get_subject($item->subject_list_id)->subject_name?></td>
                <td><?=$item->start_date?> ถึง <?=$item->end_date?></td>
                <td><?=$item->duration?></td>
                <td><?=$item->end_location?></td>
                <td><?=$item->status?></td>
                <td>
                			<!-- Single button -->
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="fa fa-cog fa-fw"></span><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
                                <li><a href="<?=base_url('staff/trip/waypoint/'.$item->id)?>" class="text-green"><span class="fa fa-fw fa-map-marker"></span>สร้างเส้นทาง</a></li>
							    <li><a href="<?=base_url('staff/trip/edit/'.$item->id)?>" class="text-yellow"><span class="fa fa-edit fa-fw"></span>แก้ไข</a></li>
							    <li><a href="<?=base_url('staff/trip/remove/'.$item->id)?>" class="text-red" onclick="return confirm('ยืนยันการลบรายการ?')"><span class="fa fa-remove fa-fw"></span>ลบ</a></li>
							  </ul>
							</div>
                </td>
            </tr>
        <?php $num++;endforeach;?>
        <tbody>
    </table>
<?php endif;?>