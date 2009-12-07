<div id="main">
<script type="text/javascript"> javascript:changeClass('courseNav'); </script>
	<?php
		$result = $this->classes_model->getAllClasses();
		$currentYear = date('Y');
		$currentMonth = date('m');
		$currentDate = date('Y-m-d');
	?>
	<div id="courses_lvl1">
		<div id="current_courses">
			<h2>Upcoming Courses</h2>
			<table id="public_courses">
				<thead>
					<tr>
						<th>Course</th>
						<th>Description</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Price</th>
					 </tr>
				 </thead>
				 <tbody>
					<?php 	
						foreach ($result as $classInfo)
						{
							//if (((date('m', strtotime($classInfo->classStartDate)) > $currentMonth) && (date('Y', strtotime($classInfo->classStartDate)) > $currentYear)) ||
								//((date('m', strtotime($classInfo->classStartDate)) < $currentMonth) && (date('Y', strtotime($classInfo->classStartDate)) > $currentYear)))
							//{
								echo	'<tr>      
										<td>'.$classInfo->classTitle.'</td>
										<td>'.$classInfo->classDesc.'</td>
										<td>'.$classInfo->classStartDate.'</td>
										<td>'.$classInfo->classEndDate.'</td>
										<td>'.$classInfo->classPrice.'</td>
										</tr>';
							//}
						}
						echo 'class month: '.date('m', strtotime($classInfo->classEndDate)).' current month: '.$currentMonth.'  class year: '.date('Y', strtotime($classInfo->classEndDate)).' current year: '.$currentYear.' ';
					?> 
				</tbody>
			 </table>
		</div>
	</div>
</div>

