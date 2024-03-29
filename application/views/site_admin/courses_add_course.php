<?php 
	include 'table_constants.php';
	if(!$siteAdmin){
		$data['siteAdmin'] = $siteAdmin;
		$this->load->view('site_admin/unauthorized', $data);
		return;
	}
	$data['breadcrumb'] = '<a href="'.base_url().'site_admin/courses/">Courses</a> &raquo; Add New Course';
	$this->load->view('site_admin/header', $data);
	
?>

<script>
	var addCourseAdminDialogTable;
	
	$(document).ready(function() 
	{
		$("#end_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		$("#start_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});

		addCourseAdminDialogTable = $('#addCourseAdminDialogTable').dataTable( 
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
	});
</script>

<form action="<?php echo base_url();?>site_admin/db_addCourse" method="POST">
	
	<div id="addCourseAdminDialog" title="Add Course Admins">
		<?php
			$data['ID'] = 'addCourseAdminDialogTable';
			$data['TABLE'] = array(SHOW_ALL_USERS, null);
			$data['FIELDS'] = SELECT_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD;
			$this->load->view('site_admin/table', $data);
		?>
	</div>
		
	<input type="hidden" name="selected_admins" value="none">
		
	<table width="700px" class="outer">
		<tr>
			<td>
				<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
					<tr height="40px">
						<td colspan="2" class="formHeading">Add New Course</td>
					</tr>
	
					<tr>
						<td colspan="2" class="note" bgcolor="#E8E8E8"><span class="red">*</span> indicates a required field</td>
					<tr>
	
					<tr height="10px">
						<td colspan="2"></td>
					</tr>
	
					<tr>
						<td align="right" bgcolor="#E8E8E8" width="32%">Title<span class="red">*</span></td>
						<td width ="68%"><input type="text" name="title" size="35" maxlength"50" class="input"></td>
					</tr>
	
					<tr>
						<td align="right" bgcolor="#E8E8E8" width="32%">Description</td>
						<td width ="68%"><textarea name="description" cols="60" rows="10" class="input"></textarea></td>
					</tr>
	
					<tr>
						<td align="right" bgcolor="#E8E8E8" width="32%">Price<span class="red">*</span></td>
						<td width ="68%">$<input type="text" name="price" size="10" maxlength"10" class="input"></td>
					</tr>
						
					<tr>
						<td align="right" bgcolor="#E8E8E8" width="32%">Start Date<span class="red">*</span></td>
						<td width ="68%"><input id="start_date" type="text" name="start_date" size="10" maxlength"10" class="input"></td>
					</tr>
						
					<tr>
						<td align="right" bgcolor="#E8E8E8" width="32%">End Date<span class="red">*</span></td>
						<td width ="68%"><input id="end_date" type="text" name="end_date" size="10" maxlength"10" class="input"></td>
					</tr>
						
					<tr>
						<td align="right" bgcolor="#E8E8E8" width="32%">Subscription Length<span class="red">*</span></td>
						<td width ="68%"><input id="subscription_length" type="text" name="subscription_length" size="10" maxlength"10" class="input"> days</td>
					</tr>
						
					<tr>
						<td align="right" bgcolor="#E8E8E8" width="32%">Course Admins</td>
						<td><button type="button" id="addCourseAdminButton">Add Course Admin</button></td>
					</tr>
						
						
					<tr>
						<td></td>
						<td height="30">
							<button type="submit">Add Course</button>
							<button type="button" onclick="window.location.href='<?php echo base_url();?>site_admin/courses'">Cancel</button>
						</td>
					</tr>
				 </table>
			</td>
		</tr>
	</table>
</form>

<?php $this->load->view('site_admin/footer'); ?>