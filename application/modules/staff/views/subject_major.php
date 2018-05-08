<?php if(!empty($Subject_major)):?>
	<table class="table table-hover tb-basic">
		<thead>
			<th>#</th>
			<th>สาขาวิชา</th>
			<th>การจัดการ</th>
		</thead>
		<tbody>
			<?php $num=1;foreach($Subject_major as $item):?>
				<tr>
					<td><?=$num?></td>
					<td><?=$item->major_name?></td>
					<td>
						<!-- Single button -->
							<div class="btn-group">
							  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="fa fa-cog fa-fw"></span><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a href="<?=base_url('staff/subject_major/edit/'.$item->id)?>" class="text-yellow"><span class="fa fa-edit fa-fw"></span>แก้ไข</a></li>
							    <li><a href="<?=base_url('staff/delete/subject_major/'.$item->id)?>" class="text-red" onclick="return confirm('ยืนยันการลบรายการ?')"><span class="fa fa-remove fa-fw"></span>ลบ</a></li>
							  </ul>
							</div>
					</td>
				</tr>
			<?php $num++;endforeach;?>
		</tbody>
	</table>
<?php endif;?>