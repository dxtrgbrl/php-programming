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