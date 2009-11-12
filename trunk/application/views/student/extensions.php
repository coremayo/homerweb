<div id="main">
<script type="text/javascript"> javascript:changeClass('subNav'); </script>
	<div id="subs_level1">
		<div id="extensions">
			<h2>Extensions</h2>
        	<?php $sub = $this->subscriptions_model->getSubscription($id);?>
            
            <table width="700px" class="outer">
			<tr>
				<td>
					<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
                    	<tr height="40px">
							<td colspan="2" class="formHeading">Subscription</td>
						</tr>
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
							<td width ="75%"><?php echo $sub->subscriptionEndDate?></td>
						</tr>
                        
                        <tr>
							<td align="right" bgcolor="#addbf0" width="25%">Time Remaining</td>
							<td width ="75%"><?php echo $this->subscriptions_model->getTimeRemaining($sub->id)?> Days</td>
						</tr>
                        <tr height="40px">
							<td colspan="2" class="formHeading">Extension Terms</td>
						</tr>
                        <tr>
							<td align="right" bgcolor="#addbf0" width="25%">Course</td>
							<td width ="75%"><?php echo $this->classes_model->getClassTitle($sub->subscriptionClass)?></td>
						</tr>
                        
                        <tr>
							<td align="right" bgcolor="#addbf0" width="25%">Extend</td>
							<td width ="75%"><?php echo $this->classes_model->getClassSubLength($sub->subscriptionClass)?> Days</td>
						</tr>
                        
                        <tr>
							<td align="right" bgcolor="#addbf0" width="25%">Price</td>
							<td width ="75%">$<?php echo $this->classes_model->getClassPrice($sub->subscriptionClass)?></td>
						</tr>
                         <tr>
							<td align="right" bgcolor="#addbf0" width="25%">New End Date</td>
							<td width ="75%"><?php echo $extendedDate?></td>
						</tr>
                      </table>
				 </td>
			  </tr>
			  </table>
        
		</div>
	</div>
</div>