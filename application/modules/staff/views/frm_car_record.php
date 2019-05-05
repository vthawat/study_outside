<?php if(!empty($car_record)) $booking_car=json_decode($car_record->record_json);?>
<form method="post" class="form-horizontal" action="<?php if(!empty($action)) print $action?>">
<div class="form-group">
    <label for="booking-num" class="col-sm-2 control-label">เลขที่หนังสือ มอ 520/</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" name="booking_num" id="booking-num"  value="<?php if($mode=='edit')  print $booking_car->booking_num?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="booking-date" class="col-sm-2 control-label">วันที่ออกบันทึกข้อความ</label>
    <div class="col-sm-2">
<input type="text" class="form-control" name="booking_date" id="booking-date"  value="<?php if($mode=='edit'):?><?=$booking_car->booking_date?><?php else:?><?=$this->ftps->DateThai(date('Y-m-d'))?><?php endif?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-title" class="col-sm-2 control-label">เรื่อง</label>
    <div class="col-sm-6">
<input type="text" class="form-control" name="booking_title" id="booking-title"  value="<?php if($mode!='edit'):?>ขออนุมัติใช้รถราชการและเดินทางไปราชการ/ปฏิบัติงานนอกเวลาราชการ<?php else:?><?=$booking_car->booking_title?><?php endif;?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-reference" class="col-sm-2 control-label">เรียน</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_reference" id="booking-reference"  value="<?php if($mode=='edit') print $booking_car->booking_reference?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-objective" class="col-sm-2 control-label">ด้วย</label>
    <div class="col-sm-10">
<input type="text" class="form-control" name="booking_objective" id="booking-objective"  value="<?php if($mode!='edit'):?>รายวิชา <?=$this->ftps->get_subject($trips->subject_list_id)->subject_code?> <?=$this->ftps->get_subject($trips->subject_list_id)->subject_name?><?php else:?><?=$booking_car->booking_objective?><?php endif?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-go-place" class="col-sm-2 control-label">ไปปฏิบัติงานที่</label>
    <div class="col-sm-4">
<input type="text" class="form-control" name="booking_go_place" id="booking-go-place"  value="<?php if($mode!='edit'):?>จังหวัด<?=trim($trips->end_location)?><?php else:?><?=$booking_car->booking_go_place?><?php endif?>" required>
    </div>
  </div>


  <div class="form-group">
    <label for="booking-depart-place" class="col-sm-2 control-label">สถานที่ให้รถมารับ</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_depart_place" id="booking-depart-place"  value="<?php if($mode=='edit') print $booking_car->booking_depart_place?>">
    </div>
  </div>
  <div class="form-group">
    <label for="booking-depart-date" class="col-sm-2 control-label">วันที่ให้มารับ</label>
    <div class="col-sm-4">
<input type="text" class="form-control" name="booking_depart_date" id="booking-depart-date"  value="<?php if($mode!='edit'):?><?=$this->ftps->DateThai($trips->start_date)?><?php else:?><?=$booking_car->booking_depart_date?><?php endif?>">
    </div>
  </div>

  <div class="form-group">
    <label for="booking-depart-time" class="col-sm-2 control-label">เวลาให้มารับ</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" name="booking_depart_time" id="booking-depart-time"  value="<?php if($mode!='edit'):?><?=$trips->start_timeframe?><?php else:?><?=$booking_car->booking_depart_time?><?php endif?>">
    </div>
  </div>

  <div class="form-group">
    <label for="booking-arrive-date" class="col-sm-2 control-label">กลับมาถึงคณะฯวันที่</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_arrive_date" id="booking-arrive-date"  value="<?php if($mode!='edit'):?><?=$this->ftps->DateThai($trips->end_date)?><?php else:?><?=$booking_car->booking_arrive_date?><?php endif?>">
    </div>
  </div>
  <div class="form-group">
    <label for="booking-depart-time" class="col-sm-2 control-label">กลับมาถึงเวลา</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" name="booking_arrive_time" id="booking-arrive-time"  value="<?php if($mode!='edit'):?><?=$trips->end_timeframe?><?php else:?><?=$booking_car->booking_arrive_time?><?php endif?>">
    </div>
  </div>

  <div class="form-group">
    <label for="booking-get-money" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
      <input type="checkbox" name="booking_get_money1" id="booking-get-money-1" value="1" <?php if($mode=='edit'):?><?php if(!empty($booking_car->booking_get_money1)) print 'checked';?><?php endif?>> <label for="booking-get-money-1">ไม่ขอเบิกค่าใช้จ่าย</label>
      <input type="checkbox" name="booking_get_money2" id="booking-get-money-2" value="2" <?php if($mode=='edit'):?><?php if(!empty($booking_car->booking_get_money2)) print 'checked';?><?php endif?>> <label for="booking-get-money-2" >ขอเบิกค่าใช้จ่ายต่าง ๆ ดังนี้</label>     
    </div>
  </div>
  <table class="table">
    <thead>
      <th colspan="3" class="text-center">หมวดค่าใช้สอย</th>
      <th colspan="3" class="text-center">หมวดค่าวัสดุและค่าตอบแทน</th>
    </thead>
    <tbody>
    <tr>
      <td class="text-right">1.ค่าวัสดุน้ำมันเชื้อเพลิง</td>
      <td></td>
      <td>
      <div class="form-group">
        <div class="col-sm-6">
          <input type="text" class="form-control" name="item_money_type1_1" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type1_1?><?php endif?>">
        </div>
        <label class="col-sm-2 control-label">บาท</label>
      </div>
      </td>
      <td class="text-right">1.ค่าวัสดุน้ำมันเชื้อเพลิง</td>
      <td></td>
      <td>
      <div class="form-group">
        <div class="col-sm-6">
          <input type="text" class="form-control" name="item_money_type2_1" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type2_1?><?php endif?>">
        </div>
        <label class="col-sm-2 control-label">บาท</label>
      </div>
      </td>
    </tr>
    <tr>
      <td class="text-right">2.ค่าเบี้ยเลี้ยง</td>
      <td>
        <div class="form-group">
          <div class="col-sm-4">
            <input type="text" class="form-control" name="item_money_type1_2_duration" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type1_2_duration?><?php endif?>">
          </div>
          <label class="col-sm-1 control-label">วัน</label>
          </div>
      </td>
      <td>
          <div class="form-group">
            <div class="col-sm-6">
              <input type="text" class="form-control" name="item_money_type1_2" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type1_2?><?php endif?>">
            </div>
            <label class="col-sm-2 control-label">บาท</label>
          </div>
        </td>
      <td class="text-right">2.ค่าล่วงเวลา</td>
      <td></td>
      <td>
        <div class="form-group">
          <div class="col-sm-6">
            <input type="text" class="form-control" name="item_money_type2_2" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type2_2?><?php endif?>">
          </div>
          <label class="col-sm-2 control-label">บาท</label>
        </div>
      </td>
    </tr>
    <tr>
      <td class="text-right">3.ค่าที่พัก</td>
      <td>
          <div class="form-group">
          <div class="col-sm-4">
              <input type="text" class="form-control" name="item_money_type1_3_duration" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type1_3_duration?><?php endif?>">
            </div>
            <label class="col-sm-1 control-label">คืน</label>
            </div>
      </td>
      <td>
          <div class="form-group">
            <div class="col-sm-6">
              <input type="text" class="form-control" name="item_money_type1_3" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type1_3?><?php endif?>">
            </div>
            <label class="col-sm-2 control-label">บาท</label>
          </div>
      </td>
      <td class="text-right">3.ค่าสมนาคุณพนักงานขับรถ</td>
      <td>
            <div class="form-group">
          <div class="col-sm-4">
              <input type="text" class="form-control" name="item_money_type2_3_person" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type2_3_person?><?php endif?>">
            </div>
            <label class="col-sm-1 control-label">คน</label>
            </div>
        </td>
      <td>
      <div class="form-group">
        <div class="col-sm-6">
          <input type="text" class="form-control" name="item_money_type2_3" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type2_3?><?php endif?>">
        </div>
        <label class="col-sm-2 control-label">บาท</label>
      </div>
      </td>
    </tr>
    <tr>
      <td class="text-right">4.ค่าใช้จ่ายอื่นๆ</td>
      <td>
          <div class="form-group">
          <div class="col-sm-12">
              <input type="text" class="form-control" name="item_money_type1_4_etc" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type1_4_etc?><?php endif?>">
            </div>
            </div>
      </td>
      <td>
      <div class="form-group">
           <div class="col-sm-6">
              <input type="text" class="form-control" name="item_money_type1_4" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type1_4?><?php endif?>">
            </div>
            <label class="col-sm-2 control-label">บาท</label>
          </div>
      </td>
      <td class="text-right">4.ค่าใช้จ่ายอื่นๆ</td>
      <td>
        <div class="form-group">
          <div class="col-sm-12">
            <input type="text" class="form-control" name="item_money_type2_4_etc" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type2_4_etc?><?php endif?>">
          </div>
          </div>
      </td>
      <td>
        <div class="form-group">
          <div class="col-sm-6">
            <input type="text" class="form-control" name="item_money_type2_4" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_type2_4?><?php endif?>">
          </div>
          <label class="col-sm-2 control-label">บาท</label>
        </div>
      </td>
    </tr>
    <tr>
        <td></td>
        <td>รวมเป็นเงินทั้งสิ้น</td>
        <td>
        <div class="form-group">
          <div class="col-sm-6">
            <input type="text" class="form-control" name="item_money_sum_type1" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_sum_type1?><?php endif?>">
          </div>
          <label class="col-sm-2 control-label">บาท</label>
        </div>
        </td>
        <td></td>
        <td>รวมเป็นเงินทั้งสิ้น</td>
        <td>
        <div class="form-group">
          <div class="col-sm-6">
            <input type="text" class="form-control" name="item_money_sum_type2" value="<?php if($mode=='edit'):?><?=$booking_car->item_money_sum_type2?><?php endif?>">
          </div>
          <label class="col-sm-2 control-label">บาท</label>
        </div>
        </td>
    </tr>
    </tbody>
  </table>
  <hr>
  <div class="col-md-4"><div class="text-right">จากเงินงบประมาณ</div></div>
  <div class="form-group col-md-8">
        <div class="col-sm-3">
            <input type="checkbox" name="get_money_from_1" value="1" <?php if($mode=='edit'):?><?php if(!empty($booking_car->get_money_from_1)) print 'checked';?><?php endif?>>โครงการวิจัย
        </div>
        <div class="col-sm-3">
            <input type="checkbox" name="get_money_from_2" value="2" <?php if($mode=='edit'):?><?php if(!empty($booking_car->get_money_from_2)) print 'checked';?><?php endif?>>ภาควิชา/หน่วยงาน
        </div>
        <div class="col-sm-3">
            <input type="checkbox" name="get_money_from_3" value="3" <?php if($mode=='edit'):?><?php if(!empty($booking_car->get_money_from_3)) print 'checked';?><?php endif?>>คณะฯ
        </div>
        <div class="col-sm-3">
            <input type="checkbox" name="get_money_from_4" value="4" <?php if($mode=='edit'):?><?php if(!empty($booking_car->get_money_from_4)) print 'checked';?><?php endif?>>อื่นๆ ระบุ  <input type="text" class="form-control" name="get_money_from_4_etc" value="<?php if($mode=='edit'):?><?=$booking_car->get_money_from_4_etc?><?php endif?>">
        </div>       
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-10">
<textarea name="booking_close_text" class="form-control"><?php if($mode!='edit'):?>ปีงบประมาณ.....พร้อมทั้งขอยืมเงินทดรองจ่ายจำนวนดังกล่าวด้วย<?php else:?><?=$booking_car->booking_close_text?><?php endif?></textarea>
      </div>
    </div>

  	<div class="text-center">
    <button class="btn icon-btn btn-success save"><span class="btn-glyphicon fa fa-save img-circle text-success"></span>บันทึก</button>
    <a class="btn icon-btn btn-default cancel" href="<?=base_url('staff/cars')?>"><span class="btn-glyphicon fa fa-stop img-circle text-gray"></span>ยกเลิก</a>
    </div>
</form>