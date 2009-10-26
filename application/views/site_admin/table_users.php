<?php 

echo '
<table cellpadding="0" cellspacing="0" border="0" class="display">
	<thead>
		<tr>';
			
		    if (isset($show_all) || isset($show_select))  echo '<th><input type="checkbox" name="select_user_all"></th>';
			if (isset($show_all) || isset($show_email))   echo '<th>Email Address</th>';
			if (isset($show_all) || isset($show_fname))   echo '<th>First Name</th>';
			if (isset($show_all) || isset($show_lname))   echo '<th>Last Name</th>';
			if (isset($show_all) || isset($show_regDate)) echo '<th>Registration Date</th>';
			if (isset($show_all) || isset($show_active))  echo '<th>Active Status</th>';
echo '
		</tr>
	</thead>
<tbody>';	
		
$users = $this->users_model->getAllUsers();
$count = 0;

foreach ($users as $user)
{
	$count++;
	$email = $user->userEmail;
	$fname = $user->userFirstName;
	$lname = $user->userLastName;
	$regDate = $user->userRegistrationDate;
	$active = $user->userActive;
     
	if ($active)
	{
		$active = '<img src="'.base_url().'images/site_admin/active_icon.gif" alt="Active" />';
	}
	else
	{
		$active = '<img src="'.base_url().'images/site_admin/inactive_icon.gif" alt="Inactive" />';
	}


	echo '<tr>';
	
	if (isset($show_all) || isset($show_select))  echo '<td><input type="checkbox" name="select_user" value="'.$user->id.'"></td>';
	if (isset($show_all) || isset($show_email))   echo '<td><a href="'.base_url().'site_admin/users/edit_user/'.$user->id.'">'.$email.'</a></td>';
	if (isset($show_all) || isset($show_fname))   echo '<td>'.$fname.'</td>';
	if (isset($show_all) || isset($show_lname))   echo '<td>'.$lname.'</td>';
	if (isset($show_all) || isset($show_regDate)) echo '<td>'.$regDate.'</td>';
	if (isset($show_all) || isset($show_active))  echo '<td>'.$active.'</td>';

	echo '</tr>';
}

echo	'</tbody>
	</table>';