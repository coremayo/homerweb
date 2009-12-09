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