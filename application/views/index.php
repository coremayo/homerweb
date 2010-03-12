<div id="main">
<script type="text/javascript"> javascript:changeClass('mainNav'); </script>
	<div id="level1">
		<div id="about">
			<h2>About Us</h2>
			<p>
				Chicago Review Course develops the most thorough and innovative medical reviews for physicians and practitioners at every stage of their careers. Our rigorous curriculum covers relevant basic sciences and provides in-depth lectures on the leading-edge diagnostic and therapeutic approaches to your particular specialty.
			</p>
			<p>
			<a href="#">Learn More...</a>
			</p>
		</div>

		<div id="login">
			<h2>Login</h2>
			<form id="login_form" action="<?php echo base_url();?>main/login" method="post">
			<p>Email Address <br><input type="text" name="email" id="email" class="required email" /></p>
			<p>Password <br><input type="password" name="password" id="password" class="required" /></p>
			<p><input type="submit" value="Login" id="login_button"></p>
			</form>
			<p><small><a href="<?php echo base_url();?>forgotPassword">Forgot Password?</a> | <a href="<?php echo base_url();?>register">Register Here</a></small></p>
		</div>
	</div>
	
	<div id="courses_lvl1">
		<div id="current_courses">
			<h2>Upcoming Courses</h2>
			<table id="public_upcoming_courses">
				<thead>
					<tr>
						<th>Course</th>
						<th>Description</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Price</th>
					 </tr>
				 </thead>
				 <tbody>
					<?php
						$today = strtotime(date('Y-m-d'));
						$result = $this->classes_model->getAllClasses();
						
						foreach ($result as $classInfo)
						{
							if (strtotime(date('Y-m-d', strtotime($classInfo->classStartDate))) > $today)
							{
								echo	'<tr>      
										<td>'.$classInfo->classTitle.'</td>
										<td>'.$classInfo->classDesc.'</td>
										<td>'.$classInfo->classStartDate.'</td>
										<td>'.$classInfo->classEndDate.'</td>
										<td>'.$classInfo->classPrice.'</td>
										</tr>';
							}
						}
					?> 
				</tbody>
			 </table>
		</div>
	</div>
	
	<br></br>
	
	<div id="courses_lvl1">
	<h2>Video Player</h2>
	<OBJECT id="VIDEO" width="320" height="240" 
		style="position:absolute; left:0;top:0;"
		CLASSID="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6"
		type="application/x-oleobject">
	
		<PARAM NAME="URL" VALUE="<?php echo base_url();?>resources/Neurosurgery Review Course 2009/Introduction/sample_video.wmv">
		<PARAM NAME="SendPlayStateChangeEvents" VALUE="True">
		<PARAM NAME="AutoStart" VALUE="True">
		<PARAM name="uiMode" value="none">
		<PARAM name="PlayCount" value="9999">
	</OBJECT>
	</div>
</div>

