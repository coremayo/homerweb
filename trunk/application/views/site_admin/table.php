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
						$rows = $this->subscriptions_model->getAllStudentSubscriptions($optionID);
						$tableType = SUBSCRIPTIONS;
					}
					else if($display == SHOW_ADMINS_NOT_IN_COURSE)
					{
						$rows = $this->classes_model->getNonCourseAdmins($optionID);
						$tableType = USERS;
					}
					else if($display == SHOW_STUDENTS_NOT_IN_COURSE)
					{
						$rows = $this->classes_model->getNonCourseAdmins($optionID);
						$tableType = USERS;
					}
					else if($display == SHOW_SCHEDULE_IN_COURSE)
					{
						$rows = $this->classes_model->getSchedule($optionID);
						$tableType = SCHEDULE;
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
					else if ($tableType == SCHEDULE)
					{
						if ($FIELDS & TYPE_FIELD)  		echo '<th>Type</th>';
						if ($FIELDS & TOPIC_FIELD)  	echo '<th>Topic</th>';
						if ($FIELDS & STARTTIME_FIELD)  echo '<th>Start Time</th>';
						if ($FIELDS & ENDTIME_FIELD)  	echo '<th>End Time</th>';
						if ($FIELDS & ADMIN_FIELD)      echo '<th>Lecture Admin</th>';
					}
					else if ($tableType == SUBSCRIPTIONS)
					{
						if ($FIELDS & SELECT_FIELD)  echo '<th><input type="checkbox" name="select_user_all"></th>';
						if ($FIELDS & SUB_FIELD)   echo '<th>Subscription ID</th>';
						if ($FIELDS & EMAIL_FIELD)   echo '<th>Email Address</th>';
						if ($FIELDS & FNAME_FIELD)   echo '<th>First Name</th>';
						if ($FIELDS & LNAME_FIELD)   echo '<th>Last Name</th>';
						if ($FIELDS & STARTDATE_FIELD) echo '<th>Start Date</th>';
						if ($FIELDS & ENDDATE_FIELD) echo '<th>End Date</th>';
						if ($FIELDS & SUB_ACTIVE_FIELD)  echo '<th>Expiration Status</th>';
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
					else if ($tableType == SCHEDULE)
					{
						if ($FIELDS & TYPE_FIELD)       echo '<td>'.$row->type.'</td>';
						if ($FIELDS & TOPIC_FIELD)  	echo '<td><a href="'.base_url().'site_admin/courses/edit_schedule/'.$row->id.'">'.$row->lectureTopic.'</a></td>';
						if ($FIELDS & STARTTIME_FIELD)  echo '<td>'.$row->lectureStartTime.'</td>';
						if ($FIELDS & ENDTIME_FIELD)  	echo '<td>'.$row->lectureEndTime.'</td>';
						if ($FIELDS & ADMIN_FIELD)      echo '<td><a href="'.base_url().'site_admin/users/edit_user/'.$row->lectureAdmin.'">'.$this->users_model->getFullName($row->lectureAdmin).'</a></td>';
					}
					else if ($tableType == SUBSCRIPTIONS)
					{
						if ($FIELDS & SELECT_FIELD)  echo '<td><input type="checkbox" name="select_user" value="'.$row->subID.'"></td>';
						if ($FIELDS & SUB_FIELD)	 echo '<td>'.$row->subID.'</td>';
						if ($FIELDS & EMAIL_FIELD)   echo '<td>'.$row->userEmail.'</td>';
						if ($FIELDS & FNAME_FIELD)   echo '<td>'.$row->userFirstName.'</td>';
						if ($FIELDS & LNAME_FIELD)   echo '<td>'.$row->userLastName.'</td>';
						if ($FIELDS & STARTDATE_FIELD) echo '<td>'.$row->subscriptionStartDate.'</td>';
						if ($FIELDS & ENDDATE_FIELD) echo '<td>'.$row->subscriptionEndDate.'</td>';
						if ($FIELDS & SUB_ACTIVE_FIELD)
						{
							if (strtotime($row->subscriptionEndDate) >= strtotime(Date("l F d, Y")))
								$img = 'active_icon.gif';
							else
								$img = 'inactive_icon.gif';
	
							echo '<td><img src="'.base_url().'images/site_admin/'.$img.'"/></td>';
						}
						
					}
	
					echo '</tr>';
				}
			?>

		</tbody>
	</table>
</div>