<form method="post" class="form-horizontal" action="<?php if(!empty($action)) print $action?>" enctype="multipart/form-data">
<div class="col-md-4">
    <h4>ภาพประกอบ</h4>
                        <!-- image-preview-filename input [CUT FROM HERE]-->
                        <div class="input-group image-preview">
                            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="fa fa-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="fa fa-folder-open"></span>
                                    <span class="image-preview-input-title">Browse</span>
                                    <input type="file" accept="image/png, image/jpeg" name="knowledge_image" required/> <!-- rename it -->
                                </div>
                            </span>
                        </div><!-- /input-group image-preview [TO HERE]--> 
</div>
<div class="col-md-8">
    <div class="form-group">
        <label for="knowledge-title" class="col-sm-2 control-label">ชื่อองค์ความรู้*</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="title" id="knowledge-title"  value="<?php if(!empty($edit_item)) print $edit_item->title?>" required>
        </div>
    </div>
    <div class="form-group">
        <label for="knowledge-desc" class="col-sm-2 control-label">คำอธิบาย*</label>
        <div class="col-sm-10">
        <textarea class="form-control" name="desc" id="knowledge-desc" cols="30" rows="10" required><?php if(!empty($edit_item)) print $edit_item->desc?></textarea>
        </div>
    </div>
</div>
<div class="text-center">
    <button class="btn icon-btn btn-success save"><span class="btn-glyphicon fa fa-save img-circle text-success"></span>บันทึก</button>
    <a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-mail-reply img-circle text-primary"></span>ยกเลิก</a>
</div>
<form>