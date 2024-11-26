<?php
require_once("php/header.php");
$output = "";
?>
<div id="left">
	<?php
	if (isset($_GET["logout"])) {
		setcookie("loggedin", false, time() - 3600);
		header("location:loginform.php");
	}
	if (isset($_POST[""])) {
		$user = array();
		$user["username"] = "";
		$user["password"] = "";
		$isvalid = true;
	}
	if ($_POST['username'] == "") {
		$output .= "Please input your username.<br/>";
		$isvalid = false;
	} else {
		$user["username"] = strip_tags($_POST['username']);
	}

	if ($_POST['password'] == "") {
		$output .= "Please input your password.<br/>";
		$isvalid = false;

	} else {
		$user["password"] = strip_tags($_POST['password']);
		$user["password"] = sha1($user['password']);
	}

	if ($isvalid) {
		$dbc = mysqli_connect('localhost', 'storeuser', 'storeuser55', 'store')
			or die('Error connecting to MySQL server.');

		$query = "SELECT * FROM users WHERE username = '" . $user["username"] . "' AND password = '" . $user["password"] .
			$result = mysqli_query($dbc, $query)
			or die('Error querying database.');
		mysqli_close($dbc);

		if ($result->num_rows > 0) {
			setcookie('loggedin', true, time() + 120);
			header("location:loginform.php");
		} else {
			$output .= "Incorrect username or Password.<br/>";
		}
	}
	?>

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