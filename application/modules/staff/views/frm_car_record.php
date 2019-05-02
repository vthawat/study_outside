<form method="post" class="form-horizontal" action="<?php if(!empty($action)) print $action?>">
<div class="form-group">
    <label for="booking-num" class="col-sm-2 control-label">เลขที่หนังสือ มอ 520/</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" name="booking_num" id="booking-num"  value="<?php if(!empty($edit_item)) print $edit_item->subject_code?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="booking-date" class="col-sm-2 control-label">วันที่ออกบันทึกข้อความ</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="booking_date" id="booking-date"  value="<?=$this->ftps->DateThai(date('Y-m-d'))?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-title" class="col-sm-2 control-label">เรื่อง</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_title" id="booking-title"  value="ขออนุมัติใช้รถราชการและเดินทางไปราชการ/ปฏิบัติงานนอกเวลาราชการ" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-reference" class="col-sm-2 control-label">เรียน</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_reference" id="booking-reference"  value="<?php if(!empty($edit_item)) print $edit_item->subject_name?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-objective" class="col-sm-2 control-label">ด้วย</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="booking_objective" id="booking-objective"  value="รายวิชา <?=$this->ftps->get_subject($trips->subject_list_id)->subject_code?> <?=$this->ftps->get_subject($trips->subject_list_id)->subject_name?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-go-place" class="col-sm-2 control-label">ไปปฏิบัติงานที่</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_go_place" id="booking-go-place"  value="จังหวัด<?=trim($trips->end_location)?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-research-name" class="col-sm-2 control-label">ชื่อโครงการวิจัย</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="booking_research_name" id="booking-research-name"  value="<?php if(!empty($edit_item)) print $edit_item->subject_name?>">
    </div>
  </div>

  <div class="form-group">
    <label for="booking-depart-place" class="col-sm-2 control-label">สถานที่ให้รถมารับ</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_depart_place" id="booking-depart-place"  value="<?php if(!empty($edit_item)) print $edit_item->subject_name?>">
    </div>
  </div>
  <div class="form-group">
    <label for="booking-depart-date" class="col-sm-2 control-label">วันที่ให้มารับ</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_depart_date" id="booking-depart-date"  value="<?=$this->ftps->DateThai($trips->start_date)?>">
    </div>
  </div>

  <div class="form-group">
    <label for="booking-depart-time" class="col-sm-2 control-label">เวลาให้มารับ</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" name="booking_depart_time" id="booking-depart-time"  value="<?=$trips->start_timeframe?>">
    </div>
  </div>

  <div class="form-group">
    <label for="booking-arrive-date" class="col-sm-2 control-label">กลับมาถึงคณะฯวันที่</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_arrive_date" id="booking-arrive-date"  value="<?=$this->ftps->DateThai($trips->end_date)?>">
    </div>
  </div>
  <div class="form-group">
    <label for="booking-depart-time" class="col-sm-2 control-label">กลับมาถึงเวลา</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" name="booking_depart_time" id="booking-depart-time"  value="<?=$trips->end_timeframe?>">
    </div>
  </div>

  <div class="form-group">
    <label for="booking-get-money" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
      <input type="radio" name="booking_get_money" id="booking-get-money-1" value="1"> <label for="booking-get-money-1">ไม่ขอเบิกค่าใช้จ่าย</label>
      <input type="radio" name="booking_get_money" id="booking-get-money-2" value="2"> <label for="booking-get-money-2" >ขอเบิกค่าใช้จ่ายต่าง ๆ ดังนี้</label>     
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
          <input type="text" class="form-control" name="item_money_type1_1">
        </div>
        <label class="col-sm-2 control-label">บาท</label>
      </div>
      </td>
      <td class="text-right">1.ค่าวัสดุน้ำมันเชื้อเพลิง</td>
      <td></td>
      <td>
      <div class="form-group">
        <div class="col-sm-6">
          <input type="text" class="form-control" name="item_money_type2_1">
        </div>
        <label class="col-sm-2 control-label">บาท</label>
      </div>
      </td>
    </tr>
    <tr>
      <td class="text-right">2.ค่าเบี้ยเลี้ยง</td>
      <td>
        <div class="form-group">
          <div class="col-sm-3">
            <input type="text" class="form-control" name="item_money_type1_2_duration">
          </div>
          <label class="col-sm-1 control-label">วัน</label>
          </div>
      </td>
      <td>
          <div class="form-group">
            <div class="col-sm-6">
              <input type="text" class="form-control" name="item_money_type1_2">
            </div>
            <label class="col-sm-2 control-label">บาท</label>
          </div>
        </td>
      <td class="text-right">2.ค่าล่วงเวลา</td>
      <td></td>
      <td>
        <div class="form-group">
          <div class="col-sm-6">
            <input type="text" class="form-control" name="item_money_type2_2">
          </div>
          <label class="col-sm-2 control-label">บาท</label>
        </div>
      </td>
    </tr>
    <tr>
      <td class="text-right">3.ค่าที่พัก</td>
      <td>
          <div class="form-group">
          <div class="col-sm-3">
              <input type="text" class="form-control" name="item_money_type1_3_duration">
            </div>
            <label class="col-sm-1 control-label">คืน</label>
            </div>
      </td>
      <td>
          <div class="form-group">
            <div class="col-sm-6">
              <input type="text" class="form-control" name="item_money_type1_3">
            </div>
            <label class="col-sm-2 control-label">บาท</label>
          </div>
      </td>
      <td class="text-right">3.ค่าสมนาคุณพนักงานขับรถ</td>
      <td>
            <div class="form-group">
          <div class="col-sm-3">
              <input type="text" class="form-control" name="item_money_type2_3_person">
            </div>
            <label class="col-sm-1 control-label">คน</label>
            </div>
        </td>
      <td>
      <div class="form-group">
        <div class="col-sm-6">
          <input type="text" class="form-control" name="item_money_type2_3">
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
              <input type="text" class="form-control" name="item_money_type1_4_etc">
            </div>
            </div>
      </td>
      <td>
      <div class="form-group">
           <div class="col-sm-6">
              <input type="text" class="form-control" name="item_money_type1_4">
            </div>
            <label class="col-sm-2 control-label">บาท</label>
          </div>
      </td>
      <td class="text-right">4.ค่าใช้จ่ายอื่นๆ</td>
      <td>
        <div class="form-group">
          <div class="col-sm-12">
            <input type="text" class="form-control" name="item_money_type2_4_etc">
          </div>
          </div>
      </td>
      <td>
        <div class="form-group">
          <div class="col-sm-6">
            <input type="text" class="form-control" name="item_money_type2_4">
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
            <input type="text" class="form-control" name="item_money_sum_type1">
          </div>
          <label class="col-sm-2 control-label">บาท</label>
        </div>
        </td>
        <td></td>
        <td>รวมเป็นเงินทั้งสิ้น</td>
        <td>
        <div class="form-group">
          <div class="col-sm-6">
            <input type="text" class="form-control" name="item_money_sum_type2">
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
            <input type="checkbox" name="get_money_from_1" value="1">โครงการวิจัย
        </div>
        <div class="col-sm-3">
            <input type="checkbox" name="get_money_from_2" value="2">ภาควิชา/หน่วยงาน
        </div>
        <div class="col-sm-3">
            <input type="checkbox" name="get_money_from_3" value="3">คณะฯ
        </div>
        <div class="col-sm-3">
            <input type="checkbox" name="get_money_from_4" value="4">อื่นๆ ระบุ  <input type="text" class="form-control" name="get_money_from_4_etc">
        </div>       
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-10">
        <textarea name="booking-close-text" class="form-control">ปีงบประมาณ...........................พร้อมทั้งขอยืมเงินทดรองจ่ายจานวนดังกล่าวด้วย</textarea>
      </div>
    </div>

  	<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
    <button class="btn icon-btn btn-success save"><span class="btn-glyphicon fa fa-save img-circle text-success"></span>สร้างบันทึกข้อความ</button>
    <a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-stop img-circle text-gray"></span>ยกเลิก</a>
    </div>
  </div>
</form>