<?php
 
echo '
<div id="table">
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
		<thead>
			<tr>';
			
				if (isset($show_all) || isset($show_title)) echo '<th>Title</th>';
				if (isset($show_all) || isset($show_desc)) echo '<th>Description</th>';
				if (isset($show_all) || isset($show_price)) echo '<th>Price</th>';
				if (isset($show_all) || isset($show_sub)) echo '<th>Subscription Length</th>';
				if (isset($show_all) || isset($show_users)) echo '<th># of Users</th>';
				if (isset($show_all) || isset($show_admins)) echo '<th># of Admins</th>';
				if (isset($show_all) || isset($show_start)) echo '<th>Start Date</th>';
				if (isset($show_all) || isset($show_end)) echo '<th>End Date</th>';
echo '
			</tr>
		</thead>
		<tbody>';
		
$classes = $this->classes_model->getAllClasses();

foreach ($classes as $class)
{
	$title = $class->classTitle;
	$desc = $class->classDesc;
	$price = $class->classPrice;
	$sub = $class->classSubLength;
	$users = $this->classes_model->getNumUsers($class->id);
	$admins = $this->classes_model->getNumAdmins($class->id);
	$start = $class->classStartDate;
	$end = $class->classEndDate;

	if ($price == 0)
	{
		$price = '$0.00';
	}
	else
	{
		$price = '$'.$price;
	}

	echo '<tr>';
	
	if (isset($show_all) || isset($show_title))  echo '<td><a href="'.base_url().'site_admin/courses/edit_course/'.$class->id.'">'.$title.'</a></td>';
	if (isset($show_all) || isset($show_desc))   echo '<td>'.$desc.'</td>';
	if (isset($show_all) || isset($show_price))  echo '<td>'.$price.'</td>';
	if (isset($show_all) || isset($show_sub))  echo '<td>'.$sub.'</td>';
	if (isset($show_all) || isset($show_users))  echo '<td>'.$users.'</td>';
	if (isset($show_all) || isset($show_admins)) echo '<td>'.$admins.'</td>';
	if (isset($show_all) || isset($show_start))  echo '<td>'.$start.'</td>';
	if (isset($show_all) || isset($show_end))    echo '<td>'.$end.'</td>';
	
	echo '</tr>';
}

echo	'</tbody>
	</table>
</div>';	