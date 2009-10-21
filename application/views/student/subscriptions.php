<div id="main">
	<div id="subs_level1">
		<div id="subscriptions">
			<h2>Subscriptions</h2>
        <br>
        <table id="user_sub">
    <thead>
        <tr>
            <th>Course</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Days Left</th>
        </tr>
    </thead>
    <tbody>
    	<?php $subs = $this->subscriptions_model->getUserSubscriptions($this->users_model->getId($this->session->userdata('email')));
   		foreach ($subs ->result() as $sub) {?>  
        <tr>       
            <td><?php echo($this->classes_model->getClassTitle($sub->subscriptionClass));?></td>
            <td><?php echo($sub->subscriptionStartDate);?></td>
            <td><?php echo($sub->subscriptionEndDate);?></td>
            <td><?php echo($this->subscriptions_model->getTimeRemaining($sub->id));?></td>
        </tr>
        <?php }?>
        
    </tbody>
</table>
		</div>
	</div>
</div>