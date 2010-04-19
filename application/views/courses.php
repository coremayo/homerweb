<div id="main">
<script type="text/javascript"> javascript:changeClass('courseNav'); </script>
	<?php
		$result = $this->classes_model->getAllClasses();
		$currentDate = date('Y-m-d');
		
		function compare_Dates($currentDate, $classStartDate, $classEndDate)
		{
			$today = strtotime($currentDate);
			$compare_StartDate = strtotime($classStartDate);
			$compare_EndDate = strtotime($classEndDate);

			if ($compare_StartDate > $today) 
			{ 
				$valid = "UPCOMING";
			}
			else if ($compare_EndDate < $today)
			{
				$valid = "ARCHIVE";
			}
			else if (($compare_StartDate < $today) && ($compare_EndDate > $today))
			{
				$valid = "CURRENT";
			}
			
			return $valid;
		}
	?>
	<div id="courses_lvl1">
		<div id="current_courses">
			<h2>Upcoming Courses</h2>
			<table id="public_upcoming_courses">
				<thead>
					<tr>
						<th>Course</th>
						<th>Description</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Price</th>
                        <th>Distance Learning</th>
                        <th>On Site</th>
					 </tr>
				 </thead>
				 <tbody>
					<?php 	
						foreach ($result as $classInfo)
						{
							if (compare_Dates($currentDate, date('Y-m-d', strtotime($classInfo->classStartDate)), date('Y-m-d', strtotime($classInfo->classEndDate))) == "UPCOMING")
							{
								echo	'<tr>      
										<td><a href="/moreInfo.php">'.$classInfo->classTitle.'</a></td>
										<td>'.$classInfo->classDesc.'</td>
										<td>'.$classInfo->classStartDate.'</td>
										<td>'.$classInfo->classEndDate.'</td>
										<td>'.$classInfo->classPrice.'</td>
										</tr>';
							}
						}
					?> 
				</tbody>
			 </table>
		</div>
	</div>
	
	<div id="courses_lvl1">
		<div>
			<h2>Current Courses</h2>
			<table id="public_current_courses">
				<thead>
					<tr>
						<th>Course</th>
						<th>Description</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Price</th>
                        <th>Distance Learning</th>
                        <th>On Site</th>
					 </tr>
				 </thead>
				 <tbody>
					<?php 	
						foreach ($result as $classInfo)
						{
							if (compare_Dates($currentDate, date('Y-m-d', strtotime($classInfo->classStartDate)), date('Y-m-d', strtotime($classInfo->classEndDate))) == "CURRENT")
							{
								echo	'<tr>      
										<td><a href="/moreInfo.php" onclick="window.open("/moreInfo.php","popup","width=500,height=500,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0"); return false">'.$classInfo->classTitle.'</a></td>
										<td>'.$classInfo->classDesc.'</td>
										<td>'.$classInfo->classStartDate.'</td>
										<td>'.$classInfo->classEndDate.'</td>
										<td>'.$classInfo->classPrice.'</td>
										</tr>';
							}
						}
					?> 
				</tbody>
			 </table>
		</div>
	</div>
	
	<div id="courses_lvl1">
		<div>
			<h2>Archived Courses</h2>
			<table id="public_archive_courses">
				<thead>
					<tr>
						<th>Course</th>
						<th>Description</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Price</th>
                        <th>Distance Learning</th>
                        <th>On Site</th>
					 </tr>
				 </thead>
				 <tbody>
					<?php 	
						foreach ($result as $classInfo)
						{
							if (compare_Dates($currentDate, date('Y-m-d', strtotime($classInfo->classStartDate)), date('Y-m-d', strtotime($classInfo->classEndDate))) == "ARCHIVE")
							{
								echo	'<tr>      
										<td><a href="/moreInfo.php" onclick="window.open("/moreInfo.php","popup","width=500,height=500,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0"); return false">'.$classInfo->classTitle.'</a></td>
										<td>'.$classInfo->classDesc.'</td>
										<td>'.$classInfo->classStartDate.'</td>
										<td>'.$classInfo->classEndDate.'</td>
										<td>'.$classInfo->classPrice.'</td>
										</tr>';
							}
						}
					?> 
				</tbody>
			 </table>
		</div>
	</div>
	
</div>

