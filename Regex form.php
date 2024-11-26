<?php
if (isset($_POST['provsubmit'])) {
	$provincename = $_POST['provincename'];
	$isvalid = true;
	require_once 'secureimage/secureimage.php';
	$secureimage = new Secureimage();

	if ($secureimage->check($_POST['captcha_code']) == false) {
		$output .= "The security code entered was incorrect.<br /><br />";
		$output .= "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
		$isvalid = false;
	}

	if ($provincename == "") {
		$isvalid = false;
		$output .= "Please input the province name you want to submit.<br/>";
	}

	if ($isvalid) {
		$dbc = mysqli_connect('localhost', 'storeuser', 'storeuser55', 'store')
			or die('Error connecting to MySQL server.');

		$query = "INSERT INTO list VALUES (NULL, '$provincename')";
		$result = mysqli_query($dbc, $query)
			or die('Error querying database.');

		mysqli_close($dbc);

		if ($result) {
			$output .= "Record inserted Successfully.<br/>";
		} else {
			$output .= "Record insertion Unsuccessful.<br/>";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="eng">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Login Page</title>
</head>

<body>
	<h2>Register</h2>
	<form method="post" action="register.php">
		<label for="now_username">New Username</label>
		<input type="text" id="new_username" name="new_username" required><br>

		<label for="new_password">New Password</label>
		<input type="password" id="new_password" name="new_password" required><br>

		<label for="new_email">Email:</label>
		<input type="text" id="new_email" name="new_email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z]{2,}$" required>
		<br>

		<input type="submit" value="Register">
	</form>
</body>