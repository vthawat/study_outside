<table class="table">
	<thead>
		<th width="120px">รหัสนักศึกษา</th>
		<th width="200px">ชื่อ</th>
		<th>นามสกุล</th>
	</thead>
	<tbody>
		<?php
		$rows = [];
		$r=0;
		foreach ($sheetData->getRowIterator() AS $row) {
			if($r!=0)
			{
			print '<tr>';
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
			$cells = [];
			foreach ($cellIterator as $cell) {
				
				$cells[] = $cell->getValue();
				print '<td>'.$cell->getValue().'</td>';

			}
			//$rows[] = $cells;
			//print_r($rows);
			print '</tr>';
		}
			$r++;
		}
		?>
	</tbody>
</table>

