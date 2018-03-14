<div class="col-md-<?php if(!empty($content['size'])) print $content['size']; else print '12';?>">
<div class="box <?php if(!empty($content['color'])) print 'box-'.$content['color']?>">
  <div class="box-header with-border">
    <h3 class="box-title"><?php if(!empty($content['title'])) print $content['title']?></h3>
     <?php if(!empty($content['toolbar'])):?>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
     <?=$content['toolbar']?>
    </div><!-- /.box-tools -->
    <?php endif;?>
  </div><!-- /.box-header -->
  <div class="box-body">
    <?php if(!empty($content['detail'])) print $content['detail']?>
  </div><!-- /.box-body -->
  <?php if(!empty($content['footer'])):?>
  <div class="box-footer">
    <?=$content['footer']?>
  </div><!-- box-footer -->
  <?php endif;?>
</div><!-- /.box -->
</div>