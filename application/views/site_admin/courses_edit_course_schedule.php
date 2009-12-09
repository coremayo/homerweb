<div id="scheduleTab">
		<button type="button" class="addButton" id="addItemButton">Add Items</button>

		<?php
			if($siteAdmin || $thisCourseAdmin){
				$data['ID'] = 'scheduleTable';
				$data['TABLE'] = array(SHOW_SCHEDULE_IN_COURSE, $courseID);
				$data['FIELDS'] = TOPIC_FIELD | STARTTIME_FIELD | ENDTIME_FIELD;
				$this->load->view('site_admin/table', $data);
			}else{
				$data['ID'] = 'scheduleTable';
				$data['TABLE'] = array(SHOW_LECTURE_ADMIN_SCHEDULE, $courseID);
				$data['FIELDS'] = TOPIC_FIELD | STARTTIME_FIELD | ENDTIME_FIELD;
				$data['userId'] = $this->users_model->getId($this->session->userdata('email'));
				$this->load->view('site_admin/table', $data);	
			}
		?>

		<div id="addItemDialog" title="Add Item">
			<form name="addItem" action="<?php echo base_url();?>site_admin/db_addCourseItem" method="POST">
            <input type="hidden" name="selected_admins" value="none">
            <input type="hidden" name="id" value="<?php echo $courseID;?>">
            
            <table width="400px" class="outer">
					<tr>
						<td>
							<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
								<tr height="40px">
									<td colspan="2" class="formHeading">Add New Item</td>
								</tr>
	
								<tr height="10px">
									<td colspan="2"></td>
								</tr>
	
								<tr>
									<td align="right" bgcolor="#E8E8E8" width="32%">Topic</td>
									<td width ="68%"><input type="text" name="topic" size="35" maxlength"50" class="input"></td>
								</tr>
								
								<tr>
									<td align="right" bgcolor="#E8E8E8" width="32%">Lecture Admin</td>
									<td><button type="button" id="selectLectureAdminButton">Select Admin</button></td>
								</tr>
	
								<tr>
									<td align="right" bgcolor="#E8E8E8" width="32%">Start Time</td>
									<td width ="68%">
										Date: <input id="sday" type="text" name="sday" size="10" maxlength="10" class="input">
										<br>
										<br>
										Time: <input id="stime_hr" type="text" name="stime_hr" size="2" maxlength="2" class="input"> 
										: <input id="stime_min" type="text" name="stime_min" size="2" maxlength="2" class="input">

										<select name="stime_am_pm">
											<option value="AM" selected>AM</option
											><option value="PM">PM</option>
										</select>
									</td>
								</tr>
	
								<tr>
									<td align="right" bgcolor="#E8E8E8" width="32%">End Time</td>
									<td width ="68%">
										Date: <input id="eday" type="text" name="eday" size="10" maxlength="10" class="input">
										<br>
										<br>
										Time: <input id="etime_hr" type="text" name="etime_hr" size="2" maxlength="2" class="input"> 
										: <input id="etime_min" type="text" name="etime_min" size="2" maxlength="2" class="input">

										<select name="etime_am_pm">
											<option value="AM" selected>AM</option
											><option value="PM">PM</option>
										</select>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
            
            <div id="selectLectureAdminDialog" title="Select Lecture Admin">
        		<?php
					$dialogData['ID'] = 'selectLectureAdminDialogTable';
					$dialogData['TABLE'] = array(SHOW_ALL_USERS, $courseID);
					$dialogData['FIELDS'] = RADIO_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD;
					$this->load->view('site_admin/table', $dialogData);
				?>
         	</div>
			</form>
		</div>
        
	</div>
