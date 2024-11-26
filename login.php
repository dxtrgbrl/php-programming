<?php 
	require_once("php/config.php");
		
	$message = ""; //used to inform the user
	
	if (isset($_POST['logoutsubmit'])){
		session_unset(); //clears session variables
		session_destroy(); //destroys old session starts new session
		$message = "You have successfully logged out.";
	}
?>
<html>
	<head>
    <style>
    ul li{
		list-style:none;
	}
    </style>
    </head>
	<body>
    
	<?php 
		if (isset($_POST['loginsubmit'])){
			//Declare Variables
			$username = $_POST['username'];
			$password = $_POST['password'];
			$isvalid = true;
			
			//Validate
			if ($username == ""){
				$message .= "Please input username.<br/>";
				$isvalid = false;	
			}
			
			if ($password == ""){
				$message .= "Please input password.<br/>";
				$isvalid = false;
			}
			
			//Connect to DB and login user if info is correct
			$user = User::getByUsernameAndPassword($username, $password);
			
			//check to see if user was found
			if ($user != null){
				$_SESSION['username'] = $user->username;
				$message = "Welcome back, " . $_SESSION['username'];
			}else{
				$message = "Incorrect Username Or Password.";
			}
		}else if (isset($_SESSION['username'])){
			$message = "Welcome back, " . $_SESSION['username'];
		}
	?>
		<!-- Create login form with: Username, Password, Submit button, and perform validation -->
		<!-- Output username and password if valid -->
        <div style="position:relative; border:solid 1px red; width:500px; padding:20px; ">
        	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            	<ul>
                	<li><?php if (isset($message) && $message != ""){ echo $message; } ?></li>
                	<li>Username:<br/>
                    <input type="text" name="username" id="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; //Sticky Form ?>" /> 
                    </li>
                    <li>Password:<br/>
                    <input type="password" name="password" id="password" value="" />                    
                    </li>
                    <li>
             		<?php if(!isset($_SESSION['username'])){ ?>
                    	<input type="submit" name="loginsubmit" id="loginsubmit" value="Login" />
                    <?php }else{ ?>
                    	<input type="submit" name="logoutsubmit" id="logoutsubmit" value="Log Out" />
                    <?php } ?>
                    </li>
                </ul>
            </form>
        </div>
		
	</body>
</html>






