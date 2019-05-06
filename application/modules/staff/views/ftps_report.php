<div class="col-md-6">
<h3 class="text-blue thai-font">สาขาวิชา</h3>
    <?php if(!empty($report_major)):?>
        <table class="table">
            <thead class="bg-blue-active">
                 <th>ชื่อสาขาวิชา</th>
                <th class="text-center">จำนวนครั้ง</th>
            </thead>
            <tbody>
                <?php foreach($report_major as $item):?>
                <tr>
                    <td><?=$item->major_name?></td>
                    <td class="text-center"><?=$item->total?></td>
                </tr>
                <?php endforeach?>
            </tbody>

        </table>
    <?php endif?>
</div>
<div class="col-md-6">
<h3 class="text-blue thai-font">จังหวัด</h3>
<?php if(!empty($report_province)):?>
        <table class="table">
            <thead class="bg-blue-active">
                 <th>ชื่อจังหวัด</th>
                <th class="text-center">จำนวนครั้ง</th>
            </thead>
            <tbody>
                <?php foreach($report_province as $item):?>
                <tr>
                    <td><?=$item->province?></td>
                    <td class="text-center"><?=$item->total?></td>
                </tr>
                <?php endforeach?>
            </tbody>

        </table>
    <?php endif?>
</div>
<div class="col-md-12">
<h3 class="text-blue thai-font">รายวิชา</h3>
<?php if(!empty($report_subject_list)):?>
        <table class="table">
            <thead class="bg-blue-active">
                 <th>ชื่อวิชา</th>
                <th class="text-center">จำนวนครั้ง</th>
            </thead>
            <tbody>
                <?php foreach($report_subject_list as $item):?>
                <tr>
                    <td><?=$item->subject_code?> <?=$item->subject_name?></td>
                    <td class="text-center"><?=$item->total?></td>
                </tr>
                <?php endforeach?>
            </tbody>

        </table>
    <?php endif?>
</div>