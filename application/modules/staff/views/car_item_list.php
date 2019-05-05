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
    <?php $use_car=0;if($this->study_trip->has_car_record($item->period_trip_id)):?>
    <td class="text-green"><?php $use_car=1?><i class="fa fa-fw fa-check"></i>ออกใบขอใช้รถแล้ว</td>
    <?php else:?>
    <td class="text-red"><i class="fa fa-fw fa-ban"></i>ยังไม่ออกใบขอใช้รถ</td>
    <?php endif?>
    <td>
                    			<!-- Single button -->
                                <div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="fa fa-cog fa-fw"></span><span class="caret"></span>
							  </button>
                              <ul class="dropdown-menu">
                              <?php if($use_car==0):?>
                              <li><a href="<?=base_url('staff/cars/create/'.$item->period_trip_id)?>" class="text-green"><i class="fa fa-fw fa-bus"></i>ออกใบขอใช้รถ</a></li>
                                <?php else:?>
                                <li><a class="text-maroon" target="_blank" href="<?=base_url('staff/printCarPdf/'.$item->id)?>"><span class="fa fa-file-pdf-o fa-fw"></span>พิมพ์เป็น PDF</a></li>
                                <li><a href="<?=base_url('staff/cars/edit_draf/'.$item->id)?>" class="text-yellow"><span class="fa fa-edit fa-fw"></span>ปรับแต่งบันทึกข้อความ</a></li>
                                <li><a href="<?=base_url('staff/cars/edit_data/'.$item->id)?>" class="text-primary"><span class="fa fa-edit fa-fw"></span>แก้ไขข้อมูล</a></li>
                                <?php endif?>
                              </ul>
    </td>
</tr>
<?php endforeach?>
</tbody>
</table>