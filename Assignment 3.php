<?php
$namesarray = array(
	0 => "Joe",
	1 => "Frank",
	2 => "Lisa",
	3 => "John",
	4 => "Meredith",
	5 => "Hank",
	6 => "Louise",
	7 => "Sara",
);

for ($i = 0; $i < count($namesarray); $i++) {
	echo "Name at position " . $i . " is: " . $namesarray[$i] . "<br/>";
}

echo "<br/>";

for ($i - count($namesarray) - 1; $i > -1; $i--) {
	echo "Name at position " . $i . " is: " . $namesarray[$i] . "<br/>";
}

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	Username: <input type="text" name="username">
	<br><br>
	Name: <input type="text" name="name">
	<br><br>
	Password: <input type="text" name="password">
	<br><br>
	Email: <input type="text" name="email">
	<br><br>
	Province: <input type="text" name="province">
	<br><br>
	Accept Terms: <input type="text" name="acceptterms">
	<br><br>

	<?php
	echo "<h2>Your Input:</h2>";
	echo $username;
	echo "<br>";
	echo $name;
	echo "<br>";
	echo $password;
	echo "<br>";
	echo $email;
	echo "<br>";
	echo $province;
	echo "<br>";
	echo $acceptterms;
	?>