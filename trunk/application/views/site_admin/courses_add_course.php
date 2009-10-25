<?php 
$data['breadcrumb'] = '<a href="'.base_url().'site_admin/courses/">Courses</a> &raquo; Add New Course';
$this->load->view('site_admin/header', $data); 
?>

<div id="content">
	<form name="add_new_course_form" action="<?php echo base_url();?>site_admin/db_addCourse" method="POST">
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
							<td align="right" bgcolor="#E8E8E8" width="32%">Admins</td>
						</tr>
						
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Users</td>
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
</div>

<?php $this->load->view('site_admin/footer'); ?>