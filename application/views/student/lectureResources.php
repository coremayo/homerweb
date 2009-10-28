<?php

	$result = $this->lectures_model->getLectureResources($lectureID);

	echo '<table id="lecture_notes">
			<thead>
				<tr>
					<th>Filename</th>
					<th>Description</th>
					<th>Date Posted</th>
				</tr>
			</thead>
			<tbody>';
			
	foreach($result as $r)
	{
		$info = $this->lectures_model->getResourceInfo($r->resource_id);
	
		echo '<tr>';
	
		foreach($info as $i)
    	{
			echo '<td><a href="'.$i->resourceLocation.'">'.$i->resourceTitle.'.'.$i->resourceType.'</a></td>';
			echo '<td>'.$i->resourceDescription.'</td>';
			echo '<td>'.$i->resourceCreatedDate.'</td>';
		}
	
		echo '</tr>';
	}		
			
	echo '	</tbody>
		</table>';
				
?>