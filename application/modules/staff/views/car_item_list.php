<table class="table">
<thead>
    <th>กำหนดการเดินทาง</th>
    <th>จังหวัดปลายทาง</th>
    <th>สถานะ</th>
    <th>การจัดการ</th>
</thead>
<tbody>
<?php foreach($trip_cars as $item):?>
<tr>
    <td><?=$this->ftps->DateThai($item->start_date)?> <i class="fa fa-fw fa-angle-double-right"></i> <?=$this->ftps->DateThai($item->end_date)?></td>
    <td><?=$item->end_location?></td>
    <?php if($this->study_trip->has_car_record($item->id)):?>
    <td>สร้างบันทึกข้อความแล้ว</td>
    <?php else:?>
    <td class="text-red">ยังไม่สร้างบันทึกข้อความ</td>
    <?php endif?>
    <td>
                    			<!-- Single button -->
                                <div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="fa fa-cog fa-fw"></span><span class="caret"></span>
							  </button>
    </td>
</tr>
<?php endforeach?>
</tbody>
</table>