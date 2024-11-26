<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/securimage.php';

require_once __DIR__ . '/CaptchaObject.php';
require_once __DIR__ . '/StorageAdapter/AdapterInterface.php';

session_start();

$GLOBALS['DEBUG MODE'] = 1;

$GLOBALS['ct_recipient'] = 'YOUR@EXAMPLE.COM';
$GLOBALS['ct_msg_subject'] = 'Secureimage Test Contact Form';

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

<?php

if (isset($_POST['submit_btn'])) {

	$name = $_POST['name'];

	$recaptcha = $_POST['g-recaptcha-response'];
}

if (isset($_POST['submit_btn'])) {

	$name = $_POST['name'];

	$recaptcha = $_POST['g-recaptcha-response'];

	$secret_key = 'your_secret_key';

	$url = 'https://www.google.com/recaptcha/api/siteverify?secret='
		. $secret_key . '&response=' . $recaptcha;

	$response = file_get_contents($url);

	$response = json_decode($response);

	if ($response->success == true) {
		echo '<script>alert("Google reCAPTACHA verified")</script>';
	} else {
		echo '<script>alert("Error in Google reCAPTACHA")</script>';
	}
}

?>