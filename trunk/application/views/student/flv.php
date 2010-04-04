<?php

    $result = $this->lectures_model->getLectureResources($lectureID);

	echo '		
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
		';
                	                 
?>
