<table class="table">
	<thead>
		<th width="50px" class="text-center">#</th>
		<th width="120px" class="text-center">รหัสนักศึกษา</th>
		<th width="200px">ชื่อ</th>
		<th>นามสกุล</th>
		<th>หมายเหตุ</th>
		<th>การจัดการ</th>
	</thead>
	<tbody>
		<?php $i=1;foreach($student_list as $item):?>
			<tr>
				<td class="text-center"><?=$i?></td>
				<td class="text-center"><?=$item->std_code?></td>
				<td><?=$item->first_name?></td>
				<td><?=$item->last_name?></td>
				<td><?=$item->comment?></td>
				<td>        <!-- Single button -->
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="fa fa-cog fa-fw"></span><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							  	<li><a href="<?=base_url('staff/student/edit/'.$item->id)?>" class="text-yellow"><span class="fa fa-edit fa-fw"></span>แก้ไข</a></li>
							    <li><a href="<?=base_url('staff/delete/student/'.$item->id)?>" class="text-red" onclick="return confirm('ยืนยันการลบรายการ?')"><span class="fa fa-remove fa-fw"></span>ลบ</a></li>
							  </ul>
				
				</td>
			</tr>
		<?php $i++;endforeach?>
	</tbody>
</table>

