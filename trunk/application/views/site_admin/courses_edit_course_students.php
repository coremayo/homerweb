<div id="studentTab">
		<form name="addStudent" action="<?php echo base_url();?>site_admin/db_addCourseSubscriptions" method="POST">
			<input type="hidden" name="id" value="<?php echo $courseID;?>">
			<input type="hidden" name="classID" value="<?php echo $courseInfo->id;?>">
			<input type="hidden" name="selected_students" value="none">
			
			<button type="button" class="addButton" id="addStudentButton">Add Subscription</button>
            <button type="button" class="editButton" id="editSelectedButton">Edit Subscriptions</button>
            <button type="button" class="deleteButton" id="deleteSubButton">Delete Subscriptions</button>

			<?php
				$data['ID'] = 'studentTable';
				$data['TABLE'] = array(SHOW_STUDENTS_IN_COURSE, $courseID);
				$data['FIELDS'] = SELECT_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD | STARTDATE_FIELD | ENDDATE_FIELD | SUB_ACTIVE_FIELD;
				$this->load->view('site_admin/table', $data);
			?>

			<div id="addStudentDialog" title="Add Subscriptions">
            	<p>Course and lecture admins for this course will not be displayed in this list</p>
                <p>If a user already has a subscription, it will be extended</p>
				<?php
					$dialogData['ID'] = 'addStudentDialogTable';
					$dialogData['TABLE'] = array(SHOW_STUDENTS_NOT_IN_COURSE, $courseID);
					$dialogData['FIELDS'] = SELECT_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD;
					$this->load->view('site_admin/table', $dialogData);
				?>
			</div>
		</form>
        
        <div id="editSubDialog" title="Edit Subscriptions">
			<form name="editSubs" action="<?php echo base_url();?>site_admin/db_editCourseSubscriptions" method="POST">
            <input type="hidden" name="selected_subs" value="none">
            <input type="hidden" name="id" value="<?php echo $courseID;?>">
				<table width="400px" class="outer">
					<tr>
						<td>
							<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
								<tr height="40px">
									<td colspan="2" class="formHeading">Edit Subscriptions</td>
								</tr>
	
								<tr height="10px">
									<td colspan="2"></td>
								</tr>
                                
                                <tr>
									<td colspan="2">Leave unchanged fields blank.</td>
								</tr>
                                <tr>
									<td colspan="2">You may enter negative numbers.</td>
								</tr>
                                <tr>
									<td align="right" bgcolor="#E8E8E8" width="32%">Editing By</td>
                                    <td width ="68%">
									<input type="radio" name="edit_option" value="date" checked>Date
									<br>
									<input type="radio" name="edit_option" value="days">Days
								</td>
								</tr>
                                
                                <tr class="setStart">
									<td align="right" bgcolor="#E8E8E8" width="39%">Set Start Date</td>
									<td width ="61%"><input type="text" name="setStart" id="setStart" size="10" maxlength"10" class="input"></td>
								</tr>
								
								<tr class="setEnd">
									<td align="right" bgcolor="#E8E8E8" width="39%">Set End Date</td>
									<td width ="61%"><input type="text" name="setEnd" id="setEnd" size="10" maxlength"10" class="input"></td>
								</tr>
                                
                                <tr class="extStart">
									<td align="right" bgcolor="#E8E8E8" width="39%">Extend Start Date By</td>
									<td width ="61%"><input type="text" name="extStart" size="5" maxlength"5" class="input"> Days</td>
								</tr>
                                
                                <tr class="extEnd">
									<td align="right" bgcolor="#E8E8E8" width="39%">Extend End Date By</td>
									<td width ="61%"><input type="text" name="extEnd" size="5" maxlength"5" class="input"> Days</td>
								</tr>

							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>
        
        <form name="deleteSub" action="<?php echo base_url();?>site_admin/db_deleteCourseSubscriptions" method="POST">
        	<input type="hidden" name="id" value="<?php echo $courseID;?>">
            <input type="hidden" name="selected_subs" value="none">
        </form>
	</div>