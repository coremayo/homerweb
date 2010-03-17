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
		<!-- this A tag is where your Flowplayer will be placed. it can be anywhere -->
		<a  
			 href="http://e1h13.simplecdn.net/flowplayer/flowplayer.flv"  
			 style="display:block;width:520px;height:330px"  
			 id="player"> 
		</a> 
	
		<!-- this will install flowplayer inside previous A- tag. -->
		<script>
			flowplayer("player", "../../../flowplayer/flowplayer-3.1.5.swf");
		</script>

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
			if ($i->resourceType == "wmv")
			{
				echo '<td><a href="" onClick="window.open(\''.$i->resourceLocation.'\',\'Video Window\',\'width=500,height=375\')">'.$i->resourceTitle.'.'.$i->resourceType.'</a></td>';
				//echo '<td><a id="videoLink">'.$i->resourceTitle.'.'.$i->resourceType.'</a></td>';
			}
			else
			{
				echo '<td><a href="'.$i->resourceLocation.'">'.$i->resourceTitle.'.'.$i->resourceType.'</a></td>';
			}
			echo '<td>'.$i->resourceDescription.'</td>';
			echo '<td>'.$i->resourceCreatedDate.'</td>';
		}
	
		echo '</tr>';
	}		
			
	echo '	</tbody>
		</table>';
				
?>
