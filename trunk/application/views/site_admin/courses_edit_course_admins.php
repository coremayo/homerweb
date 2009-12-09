<div id="courseAdminsTab">
		<form name="addAdmin" action="<?php echo base_url();?>site_admin/db_editCourseAdmins" method="POST">
        	<input type="hidden" name="id" value="<?php echo $courseID;?>">
        	<input type="hidden" name="classID" value="<?php echo $courseInfo->classAdmins;?>">
            <input type="hidden" name="selected_admins" value="none">
            <button type="button" class="addButton" id="addCourseAdminButton">Add Course Admin</button>
			<button type="button" class="deleteButton" id="deleteCourseAdminButton">Remove Course Admin</button>
			
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
        <form name="deleteAdmin" action="<?php echo base_url();?>site_admin/db_deleteCourseAdmins" method="POST">
        	<input type="hidden" name="id" value="<?php echo $courseID;?>">
            <input type="hidden" name="classID" value="<?php echo $courseInfo->classAdmins;?>">
            <input type="hidden" name="selected_admins" value="none">
        </form>
        <div id="alert">
            <p>Nothing was selected</p>
        </div>
	</div>