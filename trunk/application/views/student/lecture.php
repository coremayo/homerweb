<div id="main">
        <div id="subs_level1">
		<div id="subscriptions">
			<h2>
                           <?php echo '<a href="'.base_url().'student/courses/'.$classId.'"style="color: rgb(255,255,255)"><font color="000000"><u>'.$classTitle.'</u></font></a> > '.$lectureTopic.' '
                           ?>
                                Lecture Resources
                        </h2>
                        <table>
                        <tr>
                        <td id="rightBottom">Topic: </td>
                        <td id="bottomborder"><?php echo $lectureTopic ?></td>
                        </tr>
                        <tr>
                        <td id="rightBottom">Date: </td>
                        <td id="bottomborder"><?php echo date('D, F d, Y', strtotime($lectureStartTime)); ?>
                        </td>
                        </tr>
                        <tr>
                        <td id="rightBottom">Time: </td>
                        <td id="bottomborder"> <?php echo date('h:i:s A', strtotime($lectureStartTime))."  -  ".date('h:i:s A', strtotime($lectureEndTime)) ?>; </td>
                        </tr>
                        <tr>
                        <td id="rightBottom">Instructor: </td>
                        <td id="bottomborder"><?php echo $this->users_model->getFullName($lectureAdmin) ?></td>
                        </tr>
                        <?php 
                                $data['lectureID'] = $lectureID;
                                $this->load->view('student/lectureResources', $data);
                         ?>
                        <tr></tr>
                        <tr></tr>
                        </table> 
		 </div>
	</div>
<<<<<<< .mine
=======
         <div id="subs_level1"> 
                <div id="lecture_resources">
                        
                        <table id="lecture_notes">
                                <thead>
                                        <tr>
                                        <th>Filename</th>
                                        <th>Description</th>
                                        <th>Date Posted</th>
                                        </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> Lecture_p1.pdf </d>
                                    <td> Part one of the lecture notes </d>
                                    <td> 10/08/2009 </td>
                                </tr>
                                <tr>
                                    <td> Sample_problems.pdf </d>
                                    <td> Sample problems from with answers </d>
                                    <td> 10/08/2009 </td>
                                </tr>
                                <tr>
                                    <td> practice_test.pdf </d>
                                    <td> Some example practice test problems from previous years</d>
                                    <td> 10/08/2009 </td>
                                </tr>
                                </tbody>
                        </table>
                 </div>
       </div> 
>>>>>>> .r68
</div>