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