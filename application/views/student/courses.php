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
                        <!-- <th>Distance Learning</th> -->
                        <!-- <th>On Site</th> --> 
                     </tr>
                 </thead>
                 <tbody>
                     <?php
					 if($this->session->userdata('is_site_admin')){
						 $result = $this->classes_model->getAllClasses();
						 foreach ($result as $classInfo) {
							 $coursesData['courses'] = $classInfo;
						 	 $this->load->view('student/coursesTable', $coursesData);
						 }
					 } else {
             $userId = $this->users_model->getId($this->session->userdata('email'));
             $result = $this->classes_model->getClassInfoForUser($userId);
             foreach ($result as $classInfo) {
               $data['courses'] = $classInfo;
               $this->load->view('student/coursesTable', $data);
             }
           }
                        ?>
                   </tbody>
              </table>
		</div>
	</div>
</div>
