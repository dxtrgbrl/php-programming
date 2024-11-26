<?php
if (!isset($_COOKIE['loggedin'])) {
	?>
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
		<ul>
			<li>
				<h3>Login Form</h3>
			</li>
			<li>
				<?php if ($output != "")
					echo $output; ?>
			</li>
			<li>Username:
				<input type="text" name="username" id="username" />
			</li>
			<li>Password:
				<input type="password" name="password" id="password" />
			</li>
			<input type="submit" name="login" id="login" value="Login" />
			</li>
		</ul>
	</form>
<?php } else if ($_COOKIE["loggedin"] == true) { ?>
		Welcome back, you are logged in. <a href="loginform.php?logout=true" target="_blank">Logout</a>
<?php } ?>