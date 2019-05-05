<div class="col-md-6">
<h3 class="text-blue thai-font">สาขาวิชาต่อจำนวนการออกไปฝึกภาคสนาม</h3>
    <?php if(!empty($report_major)):?>
        <table class="table">
            <thead>
                 <th>สาขาวิชา</th>
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
<h3 class="text-blue thai-font">จังหวัดต่อจำนวนการออกไปฝึกภาคสนาม</h3>
<?php if(!empty($report_province)):?>
        <table class="table">
            <thead>
                 <th>จังหวัด</th>
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