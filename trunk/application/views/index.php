<div id="main">
	<div id="level1">
		<div id="announcements">
			<h2>Announcements</h2>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin purus ligula, adipiscing sed cursus sed, viverra nec nunc. Nunc tempus dignissim suscipit. Aliquam ultrices adipiscing ipsum eget congue. Nulla neque nisl, condimentum quis consequat ac, adipiscing in nisi. Suspendisse potenti.
			</p>
			<p>
				Nulla mattis aliquam ipsum. Nam quam lectus, cursus quis rhoncus et, volutpat et tellus.
			</p>
		</div>

		<div id="login">
			<h2>Login</h2>
			<form id="login_form" action="<?php echo base_url();?>main/login" method="post">
			<p>Email Address <br><input type="text" name="email" id="email" class="required email" /></p>
			<p>Password <br><input type="password" name="password" id="password" class="required" /></p>
			<p><input type="submit" value="Login" id="login_button"></p>
			</form>
			<p><small><a href="#">Forgot Password?</a> | <a href="<?php echo base_url();?>register">Register Here</a></small></p>
		</div>
	</div>
	<div id="level2">
		<div id="about">
			<h2>About Us</h2>
			<p>
				Chicago Review Course develops the most thorough and innovative medical reviews for physicians and practitioners at every stage of their careers. Our rigorous curriculum covers relevant basic sciences and provides in-depth lectures on the leading-edge diagnostic and therapeutic approaches to your particular specialty.
			</p>
			<p>
			<a href="#">Learn More...</a>
			</p>
		</div>

		<div id="image">
			<img src="<?php echo base_url();?>images/doctor.jpg" alt="Doctor" />
		</div>
	</div>
</div>
