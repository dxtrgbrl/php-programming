<html>
	<head>
    <style>
    ul li{
		list-style:none;
	}
    </style>
    </head>
	<body>
	<?php require_once("php/validatepasswordchange.php"); ?>

	<div class="leftcontent">
    	<form action="changepassword.php" method="post" >
    	<ul>
        	<li><?php if ($message != "") echo $message; ?></li>
        	<li>New Password: <input type="text" id="pass1" name="pass1" value="" /></li>
            <li>Confirm Password: <input type="text" id="pass2" name="pass2" value="" /></li>
            <li><input type="submit" id="submitnewpass" name="submitnewpass" value="Change Password" /></li>
        </ul>
        </form>
    </div>   
    
    
	</body>
</html>