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
                     <?php $result = $this->subscriptions_model->getValidCourseIDs($this->users_model->getId($this->session->userdata('email')));
                     foreach ($result ->result() as $res) {
						$classInfo = $this->classes_model->getClassInfo($res->subscriptionClass);
                        echo '
                        <tr>       
                            <td><a href="'.base_url().'student/courses/'.$classInfo->id.'"style="color: rgb(0,0,0)"><font color="000000"><u>'.$classInfo->classTitle.'</u></font></a></td>
                            <td>'.$classInfo->classDesc.'</td>
                            <td>'.$classInfo->classStartDate.'</td>
                            <td>'.$classInfo->classEndDate.'</td>
                        </tr>';
                        }
                        ?>
                   </tbody>
              </table>
		</div>
	</div>
</div>
