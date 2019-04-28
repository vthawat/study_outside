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
				<td></td>
			</tr>
		<?php $i++;endforeach?>
	</tbody>
</table>

