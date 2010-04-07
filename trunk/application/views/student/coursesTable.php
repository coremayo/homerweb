<?php echo '<tr>       
                            <td><a href="'.base_url().'student/courses/'.$courses->id.'"style="color: rgb(0,0,0)"><font color="000000"><u>'.$courses->classTitle.'</u></font></a></td>
							
							//Creates a Pop-Up window for the course whenever the user clicks on a course
                            <td><a href="/moreInfo.php" onclick="window.open("/moreInfo.php","popup","width=500,height=500,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0"); return false">'.$courses->classDesc.'</a></td>
                            <td>'.$courses->classStartDate.'</td>
                            <td>'.$courses->classEndDate.'</td>
                        </tr>'; ?>