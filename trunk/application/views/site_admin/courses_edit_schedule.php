<?php 
	include 'table_constants.php';
	
	$lectureID = $this->uri->segment(4, 0);
	$selected = $this->uri->segment(5, 0);
	$lectureInfo = $this->lectures_model->getLectureInfo($lectureID);

	$data['breadcrumb'] = '<a href="'.base_url().'site_admin/courses/">Courses</a> &raquo; <a href="'.base_url().'site_admin/courses/edit_course/'.$lectureInfo->lectureClass.'/3">'.$this->classes_model->getClassTitle($lectureInfo->lectureClass).'</a> &raquo; Edit Schedule';
	$this->load->view('site_admin/header', $data); 
?>

<script>
	$(document).ready(function() 
	{
		$('#tabs').tabs({ selected: <?php echo $selected ?> });
		
		selectLectureAdminDialogTable = $('#selectLectureAdminDialogTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		
		$("#selectLectureAdminDialog").dialog
		({
			bgiframe: true,
			height: 500,
			width: 800,
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			buttons: 
			{
				'Cancel'			:	function() 
										{
											$(this).dialog('close');
										}
				,			
				'Add Admin'	:	function() 
										{
											var data = $('input', selectLectureAdminDialogTable.fnGetNodes()).serialize();

											if (data == '')
											{
												$("input[name='selected_admins']").val('none');

											}
											else
											{
												$("input[name='selected_admins']").val(data);

											}

											$(this).dialog('close');
										}
			}
		});

		$('#selectLectureAdminButton').click
		(
			function(data)
			{
					$("#selectLectureAdminDialog").dialog("open");
			}
		);
	});
</script>

<h2>Edit Schedule '<?php echo $lectureInfo->lectureTopic;?>'</h2>

<div id="tabs">
	<ul>
		<li><a href="#scheduleInformationTab">Schedule Information</a></li>
		<li><a href="#resourceTab">Resources</a></li>
		<li><a href="#announcementsTab">Announcements</a></li>
	</ul>
	
	<div id="scheduleInformationTab">
    	<form name="addItem" action="<?php echo base_url();?>site_admin/db_editCourseItem" method="POST">
        <input type="hidden" name="selected_admins" value="none">
        <input type="hidden" name="id" value="<?php echo $lectureID;?>">
        
        <table width="700px" class="outer">
		<tr>
		<td>
		<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
			<tr height="40px">
				<td colspan="2" class="formHeading">Edit Schedule Information</td>
			</tr>
	
			<tr height="10px">
				<td colspan="2"></td>
			</tr>
	
			<tr>
				<td align="right" bgcolor="#E8E8E8" width="15%">Topic</td>
				<td width ="30%"><input type="text" name="topic" size="35" maxlength"50" class="input" value="<?php echo $lectureInfo->lectureTopic ?>"></td>
			</tr>
								
			<tr>
				<td align="right" bgcolor="#E8E8E8" width="15%">Lecture Admin</td>
				<td><?php echo $this->users_model->getEmail($lectureInfo->lectureAdmin).' ('. $this->users_model->getFullName($lectureInfo->lectureAdmin).') '?></td>
			</tr>
            
            <tr>
				<td align="right" width="15%"></td>
				<td><button type="button" id="selectLectureAdminButton">Change Admin</button></td>
			</tr>
	
			<tr>
				<td align="right" bgcolor="#E8E8E8" width="15%">Start Time</td>
				<td width ="68%">
                    Date: <input id="sday" type="text" name="sday" size="10" maxlength="10" class="input">
                    <br>
                    <br>
                    Time: <input id="stime_hr" type="text" name="stime_hr" size="2" maxlength="2" class="input"> 
                        : <input id="stime_min" type="text" name="stime_min" size="2" maxlength="2" class="input">
    
                        <select name="stime_am_pm">
                            <option value="AM" selected>AM</option><option value="PM">PM</option>
                        </select>
				</td>
			</tr>
	
			<tr>
				<td align="right" bgcolor="#E8E8E8" width="15%">End Time</td>
				<td width ="68%">
					Date: <input id="eday" type="text" name="eday" size="10" maxlength="10" class="input">
					<br>
					<br>
					Time: <input id="etime_hr" type="text" name="etime_hr" size="2" maxlength="2" class="input"> 
						: <input id="etime_min" type="text" name="etime_min" size="2" maxlength="2" class="input">

						<select name="etime_am_pm">
							<option value="AM" selected>AM</option><option value="PM">PM</option>
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
				$dialogData['TABLE'] = array(SHOW_ALL_USERS, $lectureID);
				$dialogData['FIELDS'] = RADIO_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD;
				$this->load->view('site_admin/table', $dialogData);
			?>
         </div>
		</form>
    </div>
    
    <div id="resourceTab">
    </div>
    
    <div id="announcementsTab">
    </div>
    
</div>

<?php $this->load->view('site_admin/footer'); ?>