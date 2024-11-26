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

<div class="registerform">

<p>Please fill in all required fields marked with an *</p>

<p class="errortext">
<?php

	if (isset($_POST['register'])){
		//Declare variables
		$user = array();		
		$user['firstname'] = validateField($_POST['firstname']);
		$user['lastname'] = validateField($_POST['lastname']);
		$user['province'] = validateField($_POST['province'], "-1");
		$user['email'] = validateField($_POST['email'], "email");
		$user['username'] = validateField($_POST['username']);
		$user['password'] = validateField($_POST['password']);
		$user['password2'] = validateField($_POST['password2']);
		$user['newsletter'] = 0;
		
		require_once 'php/securimage/securimage.php';
		$securimage = new Securimage();
		$isvalid = true;
		
		//Validation
		//Check terms and conditions first
		if (!isset($_POST['terms'])) {
			echo "You must agree with the Terms and Conditions to continue. <br/>";
			$isvalid = false;
		}
		if ($user['firstname'] == "err"){
			echo "Please enter your first name <br/>";
			$isvalid = false;
		}
		if ($user['lastname'] == "err"){
			echo "Please enter your last name <br/>";
			$isvalid = false;	
		}
		if ($user['province'] == "err"){
			echo "Please select your province <br/>";
			$isvalid = false;	
		}
		if ($user['email'] == "err"){
			echo "Please enter an email address <br/>";
			$isvalid = false;	
		}
		if ($user['username'] == "err"){
			echo "Please enter a username <br/>";
			$isvalid  = false;
		}
		if ($user['password'] == "err"){
			echo "Please enter a password <br/>";
			$isvalid = false;	
		}else if (strlen($user['password']) < 5){ //check to see if string was 5 characters for security purposes
			echo "Password must be at least 5 characters<br/>";
			$isvalid = false;
		}else{
			//Hash password once processing is complete
			$user['password'] = sha1($user['password']);
		}
		
		if ($_POST['password'] != $_POST['password2']){
			echo "Password and Confirm Password must match<br/>";
			$isvalid = false;	
		}	
		
		if ($securimage->check($_POST['captcha_code']) == false) {
			echo "The security code entered was incorrect.<br /><br />";
			echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";	
			$isvalid = false;
		}
		
		if (isset($_POST['newsletter'])){
			$user['newsletter'] = 1; //set to 1 for true
		}		
		
		if ($isvalid == true){			
			$usercheck = User::getByUsername($username); //Check to see if user already exists.
			if ($usercheck == null){
				//Send mail and put user into database				
				if (mail($user['email'], "Registration Form", "Thank you for registering!", "From: ryan@rawstudioz.net")){
					//Send the user to the database only when email was successful, otherwise they wont get their info and 
					//it may take some administrative effort to receive the account. If you use a confirmation link they may not be able to get to it.
					$newuser = new User($user);
					$newuser->insertNewUser();
					//User::insertNewUser();
					echo "Thank you for registering <br/>";
					echo "Message sent succesfully, you should get a confirmation email in a few moments.<br/>";
				}else{					
					echo "We're sorry, the message could not be sent Please try registering again later.<br/>";
				}
			}else{
				echo "Sorry, that username has already been chosen.<br/>";
			}
		}
		
	}
?>
</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] . "?action=register"; ?>">
    	<ul>
        	<li>
            	First Name: *<br/>
                <input type="text" name="firstname" id="firstname" placeholder="First Name" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>" /> 
            </li>
            <li>
            	Last Name: *<br/>
                <input type="text" name="lastname" id="lastname" placeholder="Last Name" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>" />
            </li>
            <li>
            	Province: *<br/>
                <select name="province" id="province">
                	<option value="-1">Select A Province</option>
                    <option value="AB">Alberta</option>
                    <option value="BC">British Columbia</option>
                    <option value="MA">Manitoba</option>
                    <option value="NB">New Brunswick</option>
                    <option value="NF">Newfoundland & Labrador</option>
                    <option value="NT">Northwest Territories</option>
                    <option value="NS">Nova Scotia</option>
                    <option value="NV">Nunavut</option>
                    <option value="ON">Ontario</option>
                    <option value="PE">Prince Edward Island</option>
                    <option value="QC">Quebec</option>
                    <option value="SK">Saskatchewan</option>
                    <option value="YK">Yukon</option>               
                </select>
            </li>
            <li>
            	Email: *<br/>
                <input type="text" name="email" id="email" placeholder="Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />
            </li>
            <li>
			<li>
				Username: *<br/>
				<input type="text" name="username" id="username" placeholder="Username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" />
			</li>
            	Password: *<br/>
                <input type="password" name="password" id="password" placeholder="Password"  />
            </li>
            <li>
            	Password Confirmation: *<br />
                <input type="password" name="password2" id="password2" placeholder="Password Confirmation" />
            </li>
            <li> Please input the following text below: *</br>
				<img id="captcha" src="php/securimage/securimage_show.php" alt="CAPTCHA Image" />
			</li>
            <li>
            	Sign me up for the newsletter - <input type="checkbox" id="newsletter" name="newsletter" checked="checked" />
            </li>
			<li>
				<input type="text" name="captcha_code" size="10" maxlength="6" />
				<a href="#" onclick="document.getElementById('captcha').src = 'php/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
			</li>
            <li>
            	I agree to the <a href="javascript:void(0);" onclick="javascript:window.open('termsandconditions.html');">Terms and Conditions</a><br/>
                <input type="checkbox" name="terms" id="terms" <?php if (isset($_POST['terms'])) echo "checked=\"checked\""; ?> />
            </li>
            <li>
            	<input type="submit" name="register" id="register" value="Register" />
                <input type="reset" value="Clear Form"/>
            </li>
            
        </ul>
    </form>
    
</div> <!-- End of register form div -->
    
	</body>
</html>












