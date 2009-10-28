<?php 
$courseID = $this->uri->segment(4, 0);

$courseInfo = $this->classes_model->getClassInfo($courseID);
$courseTitle = $courseInfo->classTitle;
$courseDesc = $courseInfo->classDesc;
$coursePrice = $courseInfo->classPrice;
$courseSub = $courseInfo->classSubLength;
$courseStart = $courseInfo->classStartDate;
$courseEnd = $courseInfo->classEndDate;


$data['breadcrumb'] = '<a href="'.base_url().'site_admin/courses/">Courses</a> &raquo; Edit Course';
$this->load->view('site_admin/header', $data); 
?>

<h2>Edit Course '<?php echo $courseTitle;?>'</h2>

<div id="edit_course_tabs">
	<ul>
		<li><a href="#edit_course_tab1">Course Information</a></li>
		<li><a href="#edit_course_tab2">Course Admins</a></li>
		<li><a href="#edit_course_tab3">Students</a></li>
		<li><a href="#edit_course_tab4">Lectures</a></li>
	</ul>
	
	<div id="edit_course_tab1">
		<form name="edit_course_form" action="<?php echo base_url();?>site_admin/db_editCourseInfo" method="POST">
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
								<td width ="68%"><input type="text" name="title" size="35" maxlength"50" class="input" value="<?php echo $courseTitle;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Description</td>
								<td width ="68%"><textarea name="description" cols="60" rows="10" class="input"><?php echo $courseDesc;?></textarea></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Price<span class="red">*</span></td>
								<td width ="68%">$<input type="text" name="price" size="10" maxlength"10" class="input" value="<?php echo $coursePrice;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Start Date<span class="red">*</span></td>
								<td width ="68%"><input id="start_date" type="text" name="start_date" size="10" maxlength"10" class="input" value="<?php echo $courseStart;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">End Date<span class="red">*</span></td>
								<td width ="68%"><input id="end_date" type="text" name="end_date" size="10" maxlength"10" class="input" value="<?php echo $courseEnd;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Subscription Length<span class="red">*</span></td>
								<td width ="68%"><input id="subscription_length" type="text" name="subscription_length" size="10" maxlength"10" class="input" value="<?php echo $courseSub;?>"></td>
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
	
	<div id="edit_course_tab2">
		
	</div>
	
	<div id="edit_course_tab3">
		
	</div>
	
	<div id="edit_course_tab4">

	</div>
</div>

<?php $this->load->view('site_admin/footer'); ?>