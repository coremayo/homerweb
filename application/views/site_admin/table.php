<div id="<?php echo $ID;?>">
	<table cellpadding="0" cellspacing="0" border="0" class="display">
		<thead>
			<tr>
				<?php 
					include 'table_constants.php';
					
					$display = $TABLE[0];
					$optionID = $TABLE[1];
					
			
					if($display == SHOW_ALL_USERS)
					{
						$rows = $this->users_model->getAllUsers();
						$tableType = USERS;
					}
					else if($display == SHOW_ALL_COURSES)
					{
						$rows = $this->classes_model->getAllClasses();
						$tableType = COURSES;
					}
					else if($display == SHOW_ADMINS_IN_COURSE)
					{
						$rows = $this->classes_model->getAllAdmins($optionID);
						$tableType = USERS;
					}
					else if($display == SHOW_STUDENTS_IN_COURSE)
					{
						$rows = $this->classes_model->getAllStudents($optionID);
						$tableType = USERS;
					}
					else if($display == SHOW_ADMINS_NOT_IN_COURSE)
					{
						$rows = $this->classes_model->getNonAdmins($optionID);
						$tableType = USERS;
					}					
					
					if ($tableType == USERS)
					{
						if ($FIELDS & SELECT_FIELD)  echo '<th><input type="checkbox" name="select_user_all"></th>';
						if ($FIELDS & EMAIL_FIELD)   echo '<th>Email Address</th>';
						if ($FIELDS & FNAME_FIELD)   echo '<th>First Name</th>';
						if ($FIELDS & LNAME_FIELD)   echo '<th>Last Name</th>';
						if ($FIELDS & REGDATE_FIELD) echo '<th>Registration Date</th>';
						if ($FIELDS & ACTIVE_FIELD)  echo '<th>Active Status</th>';
					}
					else if ($tableType == COURSES)
					{
						if ($FIELDS & TITLE_FIELD)  	echo '<th>Title</th>';
						if ($FIELDS & DESC_FIELD)   	echo '<th>Description</th>';
						if ($FIELDS & PRICE_FIELD)  	echo '<th>Price</th>';
						if ($FIELDS & SUBLENGTH_FIELD)  echo '<th>Subscription Length</th>';
						if ($FIELDS & USERS_FIELD)  	echo '<th># of Users</th>';
						if ($FIELDS & ADMINS_FIELD) 	echo '<th># of Admins</th>';
						if ($FIELDS & STARTDATE_FIELD)  echo '<th>Start Date</th>';
						if ($FIELDS & ENDDATE_FIELD)    echo '<th>End Date</th>';
					}
				?>
			</tr>
		</thead>
		<tbody>	

			<?php
				foreach ($rows as $row)
				{
					echo '<tr>';
	
					if ($tableType == USERS)
					{
						if ($FIELDS & SELECT_FIELD)  echo '<td><input type="checkbox" name="select_user" value="'.$row->id.'"></td>';
						if ($FIELDS & EMAIL_FIELD)   echo '<td><a href="'.base_url().'site_admin/users/edit_user/'.$row->id.'">'.$row->userEmail.'</a></td>';
						if ($FIELDS & FNAME_FIELD)   echo '<td>'.$row->userFirstName.'</td>';
						if ($FIELDS & LNAME_FIELD)   echo '<td>'.$row->userLastName.'</td>';
						if ($FIELDS & REGDATE_FIELD) echo '<td>'.$row->userRegistrationDate.'</td>';
						if ($FIELDS & ACTIVE_FIELD)
						{
							if ($row->userActive)
								$img = 'active_icon.gif';
							else
								$img = 'inactive_icon.gif';
	
							echo '<td><img src="'.base_url().'images/site_admin/'.$img.'"/></td>';
						}
					}
					else if ($tableType == COURSES)
					{
						if ($FIELDS & TITLE_FIELD)  	echo '<td><a href="'.base_url().'site_admin/courses/edit_course/'.$row->id.'">'.$row->classTitle.'</a></td>';
						if ($FIELDS & DESC_FIELD)   	echo '<td>'.$row->classDesc.'</td>';
						if ($FIELDS & PRICE_FIELD)  	echo '<td>$'.$row->classPrice.'</td>';
						if ($FIELDS & SUBLENGTH_FIELD)  echo '<td>'.$row->classSubLength.'</td>';
						if ($FIELDS & USERS_FIELD)  	echo '<td>'.$this->classes_model->getNumUsers($row->id).'</td>';
						if ($FIELDS & ADMINS_FIELD) 	echo '<td>'.$this->classes_model->getNumAdmins($row->id).'</td>';
						if ($FIELDS & STARTDATE_FIELD)  echo '<td>'.$row->classStartDate.'</td>';
						if ($FIELDS & ENDDATE_FIELD)    echo '<td>'.$row->classEndDate.'</td>';
					}
	
					echo '</tr>';
				}
			?>

		</tbody>
	</table>
</div>