<div id="main">
	<div id="subs_level1">
		<div id="extensions">
			<h2>Extensions</h2>
        	<br>
        	<?php $sub = $this->subscriptions_model->getSubscription($id);?>
            
            <table width="700px" class="outer">
			<tr>
				<td>
					<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
						<tr>
							<td align="right" bgcolor="#addbf0" width="25%">Course</td>
							<td width ="75%"><?php echo $this->classes_model->getClassTitle($sub->subscriptionClass)?></td>
						</tr>
	
						<tr>
							<td align="right" bgcolor="#addbf0" width="25%">Subscription Start</td>
							<td width ="75%"><?php echo $sub->subscriptionStartDate?></td>
						</tr>
                        
                        <tr>
							<td align="right" bgcolor="#addbf0" width="25%">Subscription End</td>
							<td width ="5%"><?php echo $sub->subscriptionEndDate?></td>
						</tr>
                        
                        <tr>
							<td align="right" bgcolor="#addbf0" width="25%">Time Remaining</td>
							<td width ="75%"><?php echo $this->subscriptions_model->getTimeRemaining($sub->id)?> Days</td>
						</tr>
                      </table>
				 </td>
			  </tr>
			  </table>
        		<?php echo '
        	  		<p>Extend '.$this->classes_model->getClassTitle($sub->subscriptionClass).'
					for '.$this->classes_model->getClassSubLength($sub->subscriptionClass).' 
					days at the price of $'.$this->classes_model->getClassPrice($sub->subscriptionClass).'
					</p>'
			  	?>
        
		</div>
	</div>
</div>