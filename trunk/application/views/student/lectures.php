<div id="main">
	<div id="subs_level1">
		<div id="subscriptions">
			<h2><?php echo $classTitle?> Lectures</h2>
                <table id="user_courses">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Speaker</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
						$lectureInfo = $this->lectures_model->getClassLectures($classId);
   						foreach ($lectureInfo ->result() as $info) {
                            echo '
                        <tr>       
                            <td><a href="'.base_url().'student/courses/'.$classId.'/'.$info->id.'"style="color: rgb(0,0,0)"><font color="000000"><u>'.$info->lectureTopic.'</u></font></a></td>
                            <td>'.$info->lectureAdmin.'</td>
                            <td>'.$info->lectureStartTime.'</td>
                        </tr>';
                         }
                        ?>
                    </tbody>
                </table>
		</div>
	</div>
</div>