<script>
$(document).ready(function(){
        $('#videoLink').click(function()
        {
                //alert("javascript newb");
                //window.open(\''.$i->resourceLocation.'\',\'Video Window\',\'width=500,height=375\');
        });
});

</script>

<?php

        $result = $this->lectures_model->getLectureResources($lectureID);

        

        echo '
        <table id="user_lecture_resources">
                        <thead>
                                <tr>
                                        <th><u> Filename </u></th>
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
			if($i->download == null)
			{
                        	if ($i->resourceType == "wmv")
                        	{
                        	        echo '<td><a href="" onClick="window.open(\''.$i->resourceLocation.'\',\'Video Window\',\'width=500,height=375\')">'.$i->resourceTitle.'.'.$i->resourceType.'</a></td>';
                        	        //echo '<td><a id="videoLink">'.$i->resourceTitle.'.'.$i->resourceType.'</a></td>';
                        	}
                        	else if ($i->resourceType == "flv")
                        	{
                        	        echo '<td>			
                	<a  
                	         href="'.$i->resourceLocation.'"
                	         style="display:block;width:520px;height:330px"  
                	         id="player"> 
					</a>
                	<script>
                	        flowplayer("player", "../../../flowplayer/flowplayer-3.1.5.swf");
                	</script>
                	<!-- now for the "downloadable" link ..need to add an "if downloadable" tag..-->
				<a href="'.$i->resourceLocation.'">'.$i->resourceTitle.'.'.$i->resourceType.'</a>
				</td>';
                	        }
                                else if ($i->resourceType == "pdf")
                                {
                                        echo '
                                        <td>
                                        <!--<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                                        width="100%" height="100%"
                                        codebase="http://active.macromedia.com/flash5/cabs/swflash.cab#version=8,0,0,0">
                                        <param name="MOVIE" value="'.base_url().'resources/Neurosurgery Review Course 2009/Introduction/'.$i->resourceTitle.'.swf">
                                        <param name="PLAY" value="true">
                                        <param name="LOOP" value="true">
                                        <param name="QUALITY" value="high">
                                        <param name="FLASHVARS" value="zoomtype=3">
                                        <embed src="'.base_url().'resources/Neurosurgery Review Course 2009/Introduction/'.$i->resourceTitle.'.swf" width="100%" height="100%"
                                        play="true" ALIGN="" loop="true" quality="high"
                                        type="application/x-shockwave-flash"
                                        flashvars="zoomtype=3"
                                        pluginspage="http://www.macromedia.com/go/getflashplayer">
                                        </embed>
                                        </object> -->
                                        <a href="'.base_url().'resources/Neurosurgery Review Course 2009/Introduction/'.$i->resourceTitle.'.html" target="_blank" width="100%" height="">'.$i->resourceTitle.'.'.$i->resourceType.'</a>
                                        </td>';
                                        
                                } 
                                
                                else if ($i->resourceType == "pptx")
                                {
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
                                <a href="'.$i->resourceLocation.'">'.$i->resourceTitle.'.'.$i->resourceType.'</a>
                                </td>';
                                }     
                	        else 
                	        {
                	                echo '<td><a href="'.$i->resourceLocation.'">'.$i->resourceTitle.'.'.$i->resourceType.'</a></td>';
     	     	                }
			}
                        echo '<td>'.$i->resourceDescription.'</td>';
                        echo '<td>'.$i->resourceCreatedDate.'</td>';
                }
        
                echo '</tr>';
        }               
                        
        echo '  </tbody>
                </table>';
                
?>
