<textarea class="form-control" id="schedule-html" name="schedule_html"><?php print $schedule_html;?></textarea>
<br>
<div class="text-center"><button class="btn icon-btn btn-success save-schedule"><span class="btn-glyphicon fa fa-save img-circle text-success"></span>บันทึก</button>
<a target="_blank" href="<?=base_url('staff/printSchedule/'.$trips->id)?>" class="btn icon-btn btn-danger"><span class="btn-glyphicon fa fa-print img-circle text-black"></span>Print</a>
</div>
