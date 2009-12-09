<?php $classInfo = $this->classes_model->getClassInfo($classId); ?>
<div id="main">
<script type="text/javascript"> javascript:changeClass('subNav'); </script>
	<div id="subs_level1">
		<div id="subscriptions">
      <h2>Purchase Course</h2>
      <p>You are about to purchase a subscription to the following course:</p>
      <h3><?php echo $classInfo->classTitle; ?></h3>
      <ul style="list-style-type: circle;">
        <li><?php echo $classInfo->classDesc; ?></li>
        <li><?php echo (date('F j, Y', strtotime($classInfo->classStartDate)) ." - ". date('F j, Y', strtotime($classInfo->classEndDate))); ?></li>
        <li>$<?php echo $classInfo->classPrice; ?></li>
      </ul>

      <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
      <input type="hidden" name="cmd" value="_xclick">
      <input type="hidden" name="business" value="cmayoS_1257878766_biz@gatech.edu">
      <input type="hidden" name="item_name" value="<?php echo $classInfo->classTitle; ?>">
      <input type="hidden" name="item_number" value="<?php echo $classId; ?>">
      <input type="hidden" name="currency_code" value="USD">
      <input type="hidden" name="amount" value="<?php echo $classInfo->classPrice; ?>">
      <input type="hidden" name="custom" value="<?php echo $this->users_model->getId($this->session->userdata('email')); ?>">
      <input type="hidden" name="return" value="<?php echo base_url(); ?>student/subscriptions">
      <input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>purchase/buy/<?php echo $classId; ?>">
      <input type="image" border="0" name="submit" src="http://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" alt="Make payments with PayPal - it's fast, free and secure!">
      <input type="hidden" name="notify_url" value="<?php echo base_url(); ?>purchase/receivePayment">
      </form>
    </div>
  </div>
</div>
