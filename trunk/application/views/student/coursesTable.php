<?php echo '<tr>       
                            <td><a href="'.base_url().'student/courses/'.$courses->id.'"style="color: rgb(0,0,0)"><font color="000000"><u>'.$courses->classTitle.'</u></font></a></td>
                            <td>'.$courses->classDesc.'</td>
                            <td>'.$courses->classStartDate.'</td>
                            <td>'.$courses->classEndDate.'</td>
							<td>'.$courses->distanceLearning.'</td>
							<td>'.$courses->onSite.'</td>
                        </tr>'; ?>