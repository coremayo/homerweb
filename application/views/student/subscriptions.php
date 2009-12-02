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
			<td><button type="button" onclick="window.location.href=\''.base_url().'purchase/buy/'.$sub->subscriptionClass.'\'">Extend</button></td>
        </tr>';
        } 
		?>
        
    </tbody>
</table>
		</div>
	</div>
  <br />

<?php
// this is the course purchasing panel
$userId = $this->users_model->getId($this->session->userdata('email'));
$courses = $this->subscriptions_model->getPossibleSubscriptions($userId);
$numCourses = $courses->num_rows();
?>
  <div id="subs_level1">
    <div>
      <h2>Purchase New Courses</h2>
      <p>there are <?php echo $numCourses ?> courses available</p>
      <table class="display" id="purchase_courses">
        <thead>
          <tr>
            <th>ID</th>
            <th>Course Title</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Purchase</th>
          </tr>
        </thead>
        <tbody>
          <?php
           foreach ($courses->result() as $course) {
             echo '
               <tr>
                <td>'.$course->id.'</td>
                <td>'.$course->classTitle.'</td>
                <td>'.$course->classStartDate.'</td>
                <td>'.$course->classEndDate.'</td>
                <td><button type="button" onclick="window.location.href=\''.base_url().'purchase/buy/'.$course->id.'\'"">Purchase</button></td>
               </tr>
             ';
           }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
