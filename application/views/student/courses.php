<div id="main">
<script type="text/javascript"> javascript:changeClass('coursesNav'); </script>
	<div id="subs_level1">
		<div id="course_list">
			<h2>Courses</h2>
            <br />
            <table id="user_courses">
            	<thead>
                	<tr>
                    	<th>Course</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>     
                     </tr>
                 </thead>
                 <tbody>
                     <?php
					 $id = $this->users_model->getId($this->session->userdata('email'));
					 if($this->session->userdata('is_site_admin')){
						 $result = $this->classes_model->getAllClasses();
						 foreach ($result as $classInfo) {
							$coursesData['courses'] = $classInfo;
						 	$this->load->view('student/coursesTable', $coursesData);
						 }
					 }
					 else{
						 $result = $this->subscriptions_model->getValidCourseIDs($id);
                     foreach ($result as $res) {
						$classInfo = $this->classes_model->getClassInfo($res->subscriptionClass);
							$coursesData['courses'] = $classInfo;
                        	$this->load->view('student/coursesTable', $coursesData);
                        }
					 }
					 if($this->session->userdata('is_class_admin')){
						 $result = $this->classes_model->getCoursesAdminOf($id);
						 foreach ($result as $classInfo) {
							$coursesData['courses'] = $classInfo;
						 	$this->load->view('student/coursesTable', $coursesData);
						 }
					 }
                        ?>
                   </tbody>
              </table>
		</div>
	</div>
</div>
