<div class="col-md-6">
<h3 class="text-blue thai-font">สาขาวิชาต่อจำนวนการออกไปฝึกภาคสนาม</h3>
    <?php if(!empty($report_major)):?>
        <table class="table">
            <thead>
                 <th>สาขาวิชา</th>
                <th>จำนวนครั้ง</th>
            </thead>
            <tbody>
                <?php foreach($report_major as $item):?>
                <tr>
                    <td><?=$item->major_name?></td>
                    <td><?=$item->total?></td>
                </tr>
                <?php endforeach?>
            </tbody>

        </table>
    <?php endif?>
</div>
<div class="col-md-6">
<h3 class="text-blue thai-font">จังหวัดต่อจำนวนการออกไปฝึกภาคสนาม</h3>
</div>