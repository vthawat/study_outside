<table class="table">
	<thead>
		<th>รหัสนักศึกษา</th>
		<th>คำนำหน้า</th>
		<th>ชื่อ</th>
		<th>นามสกุล</th>
	</thead>
	<tbody>
		<?php
		$rows = [];
		foreach ($sheetData->getRowIterator() AS $row) {
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
		?>
	</tbody>
</table>

