<textarea class="form-control" id="record-html2pdf" name="record_html2pdf"><?php if(!empty($car_record)):?><?=$car_record->record_html2pdf;?><?php endif;?></textarea>
<br>
<div class="text-center"><button class="btn icon-btn btn-success save-record-html2pdf"><span class="btn-glyphicon fa fa-save img-circle text-success"></span>บันทึก</button>
<a target="_blank" href="<?=base_url('staff/printCarPdf/'.$car_record->id)?>" class="btn icon-btn btn-danger save-schedule"><span class="btn-glyphicon fa fa-file-pdf-o img-circle text-red"></span>พิมพ์เป็น PDF</a>
<a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-stop img-circle text-gray"></span>ยกเลิก</a>
</div>