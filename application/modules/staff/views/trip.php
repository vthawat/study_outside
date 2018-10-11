<?php if(!empty($Trip_list)):?>
	<table class="table table-hover">
		<thead>
			<th>#</th>
			<th>รหัสวิชา-ชื่อวิชา</th>
			<th>วันที่เริ่ม-สิ้นสุด</th>
            <th>จังหวัดปลายทาง</th>
            <th>จำนวนวัน</th>
            <th>สถานะ</th>
		</thead>
		<tbody>
        <?php $num=1;foreach($Trip_list as $item):?>
            <tr>
                <td><?=$num?></td>
                <td><?=$this->ftps->get_subject($item->subject_list_id)->subject_code?> <?=$this->ftps->get_subject($item->subject_list_id)->subject_name?></td>
                <td><?=$item->start_date?> ถึง <?=$item->end_date?></td>
                <td><?=$item->end_location?></td>
                <td><?=$item->duration?></td>
                <td><?=$item->status?></td>
            </tr>
        <?php $num++;endforeach;?>
        <tbody>
    </table>
<?php endif;?>