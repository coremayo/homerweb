<div id="main">
<script type="text/javascript"> javascript:changeClass('coursesNav'); </script>
        <div id="subs_level1">
		<div id="subscriptions">
			<h2>
                           <?php echo '<a href="'.base_url().'student/courses/'.$classId.'"style="color: rgb(255,255,255)"><font color="000000"><u>'.$classTitle.'</u></font></a> > '.$lectureTopic.' '
                           ?>
                                Lecture Resources
                        </h2>
                        <table id="lecture_info" cellpadding="5">
                                <tr>
                                        <th><b> Topic: </b></td>
                                        <td align="left"><?php echo $lectureTopic ?></td>
                                        <td><b> Date: </b></td>
                                        <td align="left"><?php echo date('D, F d, Y', strtotime($lectureStartTime)); ?></td>
                                </tr>
                                <tr>
                                        <td><b> Instructor: </b></td>
                                        <td align="left"><?php echo $this->users_model->getFullName($lectureAdmin) ?></td>
                                        <td><b> Time: </b></td>
                                        <td align="left"><?php echo date('h:i:s A', strtotime($lectureStartTime))."  -  ".date('h:i:s A', strtotime($lectureEndTime)) ?></td>
                                </tr>
                                <?php 
                                        $data['lectureID'] = $lectureID;
                                        $this->load->view('student/lectureResources', $data);
                                ?>
                        </table> 
		 </div>
	</div>
</div>