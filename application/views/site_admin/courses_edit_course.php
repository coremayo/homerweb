<?php 
	include 'table_constants.php';
	
	$courseID = $this->uri->segment(4, 0);
	$courseInfo = $this->classes_model->getClassInfo($courseID);

	$data['breadcrumb'] = '<a href="'.base_url().'site_admin/courses/">Courses</a> &raquo; Edit Course';
	$this->load->view('site_admin/header', $data); 
?>

<script>
	var addCourseAdminDialogTable;
	var courseAdminsTable;
	
	$(document).ready(function() 
	{
		$('#tabs').tabs();
		
		$("#end_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		$("#start_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		
		addCourseAdminDialogTable = $('#addCourseAdminDialogTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		courseAdminsTable = $('#courseAdminsTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		$("#addCourseAdminDialog").dialog
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
				'Add Course Admins'	:	function() 
										{
											var data = $('input', addCourseAdminDialogTable.fnGetNodes()).serialize();
	
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
		
		$('#addCourseAdminButton').click
		(
			function(data)
			{
				$("#addCourseAdminDialog").dialog("open");
			}
		);
		
		$("#addCourseAdminDialog input[name='select_user_all']").change
		(
			function()
			{
				if ($("#addCourseAdminDialog input[name='select_user_all']").attr('checked'))
				{
					$('td input', addCourseAdminDialogTable.fnGetNodes()).attr({checked: 'checked'});
				}
				else
				{
					$('td input', addCourseAdminDialogTable.fnGetNodes()).attr({checked: ''});
				}
			}
		)
		
		$("#courseAdminsTable input[name='select_user_all']").change
		(
			function()
			{
				if ($("#courseAdminsTable input[name='select_user_all']").attr('checked'))
				{
					$('td input', courseAdminsTable.fnGetNodes()).attr({checked: 'checked'});
				}
				else
				{
					$('td input', courseAdminsTable.fnGetNodes()).attr({checked: ''});
				}
			}
		)
	});
</script>

<h2>Edit Course '<?php echo $courseInfo->classTitle;?>'</h2>

<div id="tabs">
	<ul>
		<li><a href="#courseInformationTab">Course Information</a></li>
		<li><a href="#courseAdminsTab">Course Admins</a></li>
		<li><a href="#studentTab">Students</a></li>
		<li><a href="#lecturesTab">Lectures</a></li>
	</ul>
	
	<div id="courseInformationTab">
		<form action="<?php echo base_url();?>site_admin/db_editCourseInfo" method="POST">
		
			<input type="hidden" name="id" value="<?php echo $courseID;?>">
			
			<table width="700px" class="outer">
				<tr>
					<td>
						<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
							<tr height="40px">
								<td colspan="2" class="formHeading">Edit Course Information </td>
							</tr>
	
							<tr>
								<td colspan="2" class="note" bgcolor="#E8E8E8"><span class="red">*</span> indicates a required field</td>
							<tr>
	
							<tr height="10px">
								<td colspan="2"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Title<span class="red">*</span></td>
								<td width ="68%"><input type="text" name="title" size="35" maxlength"50" class="input" value="<?php echo $courseInfo->classTitle;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Description</td>
								<td width ="68%"><textarea name="description" cols="60" rows="10" class="input"><?php echo $courseInfo->classDesc;?></textarea></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Price<span class="red">*</span></td>
								<td width ="68%">$<input type="text" name="price" size="10" maxlength"10" class="input" value="<?php echo $courseInfo->classPrice;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Start Date<span class="red">*</span></td>
								<td width ="68%"><input type="text" id="start_date" name="start_date" size="10" maxlength"10" class="input" value="<?php echo $courseInfo->classStartDate;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">End Date<span class="red">*</span></td>
								<td width ="68%"><input type="text" id="end_date" name="end_date" size="10" maxlength"10" class="input" value="<?php echo $courseInfo->classEndDate;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Subscription Length<span class="red">*</span></td>
								<td width ="68%"><input type="text" name="subscription_length" size="10" maxlength"10" class="input" value="<?php echo $courseInfo->classSubLength;?>"></td>
							</tr>
	
							<tr>
								<td></td>
								<td height="30">
									<button type="submit">Save Changes</button>
									<button type="button" onclick="window.location.href='<?php echo base_url();?>site_admin/courses'">Cancel</button>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id="courseAdminsTab">
		<form action="<?php echo base_url();?>site_admin/db_editCourseAdmins" method="POST">

			<button type="button" class="addButton" id="addCourseAdminButton">Add Course Admin</button>
			
			<?php
				$data['ID'] = 'courseAdminsTable';
				$data['TABLE'] = array(SHOW_ADMINS_IN_COURSE, $courseID);
				$data['FIELDS'] = SELECT_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD | REGDATE_FIELD | ACTIVE_FIELD;
				$this->load->view('site_admin/table', $data);
			?>
			
			<div id="addCourseAdminDialog" title="Add Course Admins">
				<?php
					$dialogData['ID'] = 'addCourseAdminDialogTable';
					$dialogData['TABLE'] = array(SHOW_ADMINS_NOT_IN_COURSE, $courseID);
					$dialogData['FIELDS'] = SELECT_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD;
					$this->load->view('site_admin/table', $dialogData);
				?>
			</div>
		</form>
	</div>
	
	<div id="studentTab">
		
	</div>
	
	<div id="lecturesTab">

	</div>
</div>

<?php $this->load->view('site_admin/footer'); ?>