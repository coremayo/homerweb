<div id="main">
<script type="text/javascript"> javascript:changeClass('subNav'); </script>
	<div id="subs_level1">
		<div id="subscriptions">
			<h2>Subscriptions</h2>
        <br>
        <table class = "display" id="user_sub">
    <thead>
        <tr>
        	<th>ID</th>
            <th>Course</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Days Left</th>
            <th>Extend</th>
        </tr>
    </thead>
    <tbody>
    	<?php $subs = $this->subscriptions_model->getUserSubscriptions($this->users_model->getId($this->session->userdata('email')));
   		foreach ($subs ->result() as $sub) {
			echo '
        <tr> 
			<td>'.$sub->id.'</td>
            <td>'.$this->classes_model->getClassTitle($sub->subscriptionClass).'</td>
            <td>'.$sub->subscriptionStartDate.'</td>
            <td>'.$sub->subscriptionEndDate.'</td>
            <td>'.$this->subscriptions_model->getTimeRemaining($sub->id).'</td>
			<td><button type="button" onclick="window.location.href=\''.base_url().'student/subscriptions/extensions/'.$sub->id.'\'">Extend</button></td>
        </tr>';
        } 
		?>
        
    </tbody>
</table>
		</div>
	</div>
</div>