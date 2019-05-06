<form method="get" class="form-horizontal" action="<?=$action?>">

  <div class="form-group">
    <label for="trip-start" class="col-sm-4 control-label">เริ่มวันที่</label>
    <div class="col-sm-8">
            <div class="input-daterange input-group" id="datepicker">
                    <input type="text" class="form-control start_date" name="start_date" value="<?php if(!empty($this->input->get('start_date'))):?><?=$this->input->get('start_date')?><?php endif?>"/>
        </div>
   </div>
 </div>
 <div class="form-group">
    <label for="trip-start" class="col-sm-4 control-label">ถึงวันที่</label>
    <div class="col-sm-8">
    <div class="input-daterange input-group" id="datepicker">
            <input type="text" class="form-control end_date" name="end_date" value="<?php if(!empty($this->input->get('end_date'))):?><?=$this->input->get('end_date')?><?php endif?>"/>
   </div>
   </div>
 </div>
 <div class="text-center"><button class="btn icon-btn btn-success save" type="submit"><span class="btn-glyphicon fa fa-check img-circle text-success"></span>ตกลง</button></div>
</form>