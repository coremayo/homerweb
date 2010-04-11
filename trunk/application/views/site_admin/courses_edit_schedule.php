<?php 
	include 'table_constants.php';
	
	$lectureID = $this->uri->segment(4, 0);
	$selected = $this->uri->segment(5, 0);
	$lectureInfo = $this->lectures_model->getLectureInfo($lectureID);

	$data['breadcrumb'] = '<a href="'.base_url().'site_admin/courses/">Courses</a> &raquo; <a href="'.base_url().'site_admin/courses/edit_course/'.$lectureInfo->lectureClass.'/3">'.$this->classes_model->getClassTitle($lectureInfo->lectureClass).'</a> &raquo; Edit Schedule';
	$this->load->view('site_admin/header', $data); 
?>

<script>
		function timedRefresh(timeoutPeriod) {
			setTimeout("location.reload(true);",timeoutPeriod);
		}

	$(document).ready(function() 
	{
		$('#tabs').tabs({ selected: <?php echo $selected ?> });
		
		selectLectureAdminDialogTable = $('#selectLectureAdminDialogTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		resourcesTable = $('#resourcesTable').dataTable( 
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
		
		<?php echo 'var loc = \''.base_url().'uploader\';' ?>
		new AjaxUpload('uploadResource',{
		action: loc,
		onSubmit: function(){
			this.disable();
			var text = $("#resource_desc").val();
			//var downloadable = 1; 
			this.setData({
					'type': 'resource',
					'desc': text,
					'lecture': <?php echo $lectureID?>,
					'course': <?php echo $lectureInfo->lectureClass?>
					//'download' : 1
			});
		},
		onComplete: function(file, response){
			
			if (response == "success")
			{
				$("#addNewResourceDialog").dialog("close");
				$("#type_error").hide();
				timedRefresh(500);
			}
			else
			{	
				$("#type_error").show();
			}
			this.enable();
		}
		});
		
		$("#addNewResourceDialog").dialog
		({
			height: 375,
			width: 415,
			autoOpen: false
		});
		
		$('#addNewResource').click
		(
			function(data)
			{
					$("#addNewResourceDialog").dialog("open");
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
        <input type="hidden" name="courseId" value="<?php echo $lectureInfo->lectureClass;?>">
        <?php
			$start = $lectureInfo->lectureStartTime;
			$end = $lectureInfo->lectureEndTime;
			
			$startDateTime = explode(" ", $start);
			$endDateTime = explode(" ", $end);
			
			$startDate = $startDateTime[0];
			$endDate = $endDateTime[0];
			
			$startTime = explode(":", $startDateTime[1]);
			$endTime = explode(":", $endDateTime[1]);
			
			$startTimeHours = $startTime[0];
			$endTimeHours = $endTime[0];
			$startAM = 'AM';
			$endAM = 'AM';
			
			if($startTimeHours > 12){$startTimeHours = $startTimeHours - 12; $startAM = 'PM';}
			if($endTimeHours > 12){$endTimeHours = $endTimeHours - 12; $endAM = 'PM';}
			
			$startTimeMinutes = $startTime[1];
			$endTimeMinutes = $endTime[1];
		?>
        
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
                    Date: <input id="sday" type="text" name="sday" value="<?php echo $startDate?>"size="10" maxlength="10" class="input">
                    <br>
                    <br>
                    Time: <input id="stime_hr" type="text" name="stime_hr" value="<?php echo $startTimeHours?>" size="2" maxlength="2" class="input"> 
                        : <input id="stime_min" type="text" name="stime_min" value="<?php echo $startTimeMinutes?>" size="2" maxlength="2" class="input">
    
                        <select name="stime_am_pm" value="<?php echo $startAM?>">
                           <option value="AM" <?php if($startAM == 'AM') echo 'selected';?>>AM</option><option value="PM" <?php if($startAM == 'PM') echo 'selected';?>>PM</option>
                        </select>
				</td>
			</tr>
	
			<tr>
				<td align="right" bgcolor="#E8E8E8" width="15%">End Time</td>
				<td width ="68%">
					Date: <input id="eday" type="text" name="eday" value="<?php echo $endDate?>" size="10" maxlength="10" class="input">
					<br>
					<br>
					Time: <input id="etime_hr" type="text" name="etime_hr" value="<?php echo $endTimeHours?>" size="2" maxlength="2" class="input"> 
						: <input id="etime_min" type="text" name="etime_min" value="<?php echo $endTimeMinutes?>" size="2" maxlength="2" class="input">

						<select name="etime_am_pm">
							<option value="AM" <?php if($endAM == 'AM') echo 'selected';?>>AM</option><option value="PM" <?php if($endAM == 'PM') echo 'selected';?>>PM</option>
						</select>
				</td>
			</tr>
            
            <tr>
				<td></td>
				<td height="30">
                    <button type="submit">Save Changes</button>
					<button type="button" onclick="window.location.href='<?php echo base_url();?>site_admin/courses/edit_course/<?php echo $lectureInfo->lectureClass;?>/3'">Cancel</button>
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
	
		<button type="button" class="addButton" id="addNewResource">Add New Resource</button>
		
		<div id="addNewResourceDialog" title="Add New Resource">
			<div id="type_error" style="display:none">This type of file is not allowed to be uploaded.<br><br></div>
			Description: <textarea name="resource_desc" id="resource_desc" cols="50" rows="10" class="input"></textarea>
			<br>
			<br>
			<button type="button" class="addButton" id="uploadResource">Upload File</button>
		</div>
		
		<?php
			$dialogData['ID'] = 'resourcesTable';
			$dialogData['TABLE'] = array(SHOW_ALL_RESOURCES, $lectureID);
			$dialogData['FIELDS'] = SELECT_FIELD | TITLE_FIELD | DESC_FIELD | DATE_FIELD;
			$this->load->view('site_admin/table', $dialogData);
		?>
    </div>
    
    <div id="announcementsTab">
    </div>
    
</div>

<?php $this->load->view('site_admin/footer'); ?>
