<script>
$(document).ready(function(){
        $('#videoLink').click(function()
        {
                //alert("javascript newb");
                //window.open(\''.base_url().$i->resourceLocation.'\',\'Video Window\',\'width=500,height=375\');
        });
});

</script>

<?php

        $result = $this->lectures_model->getLectureResources($lectureID);
       
        echo '
        <table id="user_lecture_resources">
                        <thead>
                                <tr>
                                        <th><u> Media View </u></th>
										<th><u> Download </u></th>
                                        <th><u> Description </u></th>
                                        <th><u> Date Posted </u></th>
                                </tr>
                        </thead>
                        <tbody>';
                     
        foreach($result as $r)
        {
                $info = $this->lectures_model->getResourceInfo($r->resource_id);
        
                echo '<tr>';
        
                foreach($info as $i)
        {
/*                        	if ($i->resourceType == "wmv")
                        	{
                        	        echo '<td><a href="" onClick="window.open(\''.base_url().$i->resourceLocation.'\',\'Video Window\',\'width=500,height=375\')">'.$i->resourceTitle.'</a></td>';
//echo '<td><a id="videoLink">'.$i->resourceTitle.'.'.$i->resourceType.'</a></td>';
                        	}
                        	else */ if ($i->resourceType == "flv")
                        	{
                        	    echo '<td>			
								<a  
									href="'.base_url().$i->resourceLocation.'"
									style="display:block;width:520px;height:330px"  
									id="player"> 
								</a>
								<script>
									flowplayer("player", "../../../flowplayer/flowplayer-3.1.5.swf");
								</script>
								</td>';
                	        }
                            else if ($i->resourceType == "pdf")
                            {
								//creative names with properly accounted-for spaces+
								$newLoc = str_replace(" ", "%20" , base_url().$i->resourceLocation);
								$newTitle = str_replace(" ", "%20" , $i->resourceTitle);
								$typelessPath = str_replace($i->resourceType,"",$newLoc);
								
								
								/***********************************************/
								// UNCOMMENT THE FOLLOWING LINE TO GET IT TO WORK LOCALLY	
								//option 1 : automatically names the swf the same as the pdf
																//$wow = exec($_SERVER['DOCUMENT_ROOT']."/homerweb/pdf2swf  lecture_notes.pdf -B rfxview.swf");
								//option 2 : use this if you want to rename the swf to something different
								//$wow = exec($_SERVER['DOCUMENT_ROOT']."/homerweb/pdf2swf  lecture_notes.pdf -o lecture_notes.swf -B rfxview.swf");
							
								//$wow = exec($_SERVER['DOCUMENT_ROOT']."/cbr2/pdf2swf m2.pdf -o what.swf");
								//$wow = exec("pdf2swf ".$newLoc." -o ".$newTitle."swf");
								
								
								//$wow = exec("pdf2swf m2.pdf -o what.swf");
								//$wow = exec("pdf2swf ".base_url().$i->resourceLocation."/".$i->resourceTitle.".pdf -o what.swf");
								//echo "Output 4 pdf2swf: <pre>$wow</pre>";
								//echo $_SERVER['DOCUMENT_ROOT'];
								//$_SERVER['DOCUMENT_ROOT'] = /home/content/d/v/l/dvlholdings/html
								//echo '<a href="/cbr2/resources/Neurosurgery%20Review%20Course%202009/Introduction/syllabus.pdf">crazy</a>';
								//'pdf2swf '.base_url().$i->resourceLocation . ''$i->resourceTitle.".pdf -o ".base_url().$i->resourceLocation . $i->resourceTitle.".swf"
                                echo '
                                        <td>
										
                                        <!--<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                                        width="100%" height="100%"
                                        codebase="http://active.macromedia.com/flash5/cabs/swflash.cab#version=8,0,0,0">
                                        <param name="MOVIE" value="'.base_url().$i->resourceLocation.'">
                                        <param name="PLAY" value="true">
                                        <param name="LOOP" value="true">
                                        <param name="QUALITY" value="high">
                                        <param name="FLASHVARS" value="zoomtype=3">
                                        <embed src="'.base_url().$i->resourceLocation.'" width="100%" height="100%"
                                        play="true" ALIGN="" loop="true" quality="high"
                                        type="application/x-shockwave-flash"
                                        flashvars="zoomtype=3"
                                        pluginspage="http://www.macromedia.com/go/getflashplayer">
                                        </embed>
                                        </object> -->
										
										
                                        <a href="'.base_url().'resources/Neurosurgery Review Course 2009/Introduction/'.$i->resourceTitle.'.html" target="_blank" width="100%" height="">'.$i->resourceTitle.'</a>
                                        </td>';            
                            } 
                                
                            else if ($i->resourceType == "pptx")
                                {
								/***********************************************/
								// UNCOMMENT THE FOLLOWING LINE TO GET IT TO WORK LOCALLY	
								// it converts .ppt to .swf ... I don't think it converts pptx
								// it will also output an accompanying .xml file
								//$wow2 = exec($_SERVER['DOCUMENT_ROOT']."/homerweb/Ppt2SwfSampleCSharpConsole  sample_presentation.ppt ".$_SERVER['DOCUMENT_ROOT']."/homerweb/sample_presentation.swf");
																							
                                echo '<td>
                                <object id="presentation" width="520px" height="330px" 
                                classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" 
                                codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" align="middle">
                                        <param name="allowScriptAccess" value="sameDomain" />
                                        <param name="movie" value="'.base_url().'resources/Neurosurgery Review Course 2009/Introduction/'.$i->resourceTitle.'.swf" />
                                        <param name="quality" value="high" />
                                        <param name="bgcolor" value="#ffffff" />
                                        <param name="allowFullScreen" value="true" />
                                        <embed src="'.base_url().'resources/Neurosurgery Review Course 2009/Introduction/'.$i->resourceTitle.'.swf" quality="high" bgcolor="#ffffff" width="520px" height="330px" name="presentation" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" allowFullScreen="true" />
                                </object>
                                </td>';
                                }     
                	        else 
                	        {
                	            echo '<td><a href="'.base_url().$i->resourceLocation.'">'.$i->resourceTitle.'.'.$i->resourceType.'</a></td>';
     	     	            }
						if($i->download == null)
						{
							echo '<td><a href="'.base_url().$i->resourceLocation.'">'.$i->resourceTitle.'.'.$i->resourceType.'</a></td>';
                        }
						else{
							echo '<td>File not downloadable.</td>';
						}
						echo '<td>'.$i->resourceDescription.'</td>';
                        echo '<td>'.$i->resourceCreatedDate.'</td>';
                }
        
                echo '</tr>';
        }               
                        
        echo '  </tbody>
                </table>';
                
?>
