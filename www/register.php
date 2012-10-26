<?php  
require_once 'includes/global.inc.php';  
$emailAddress = "";  
$password = "";  
$password_confirm = "";  
$fullName = "";
$utcOffset = "";
$error = "";  
  
if(isset($_POST['emailAddress'])) 
{   
    $success = true;  

		//First thing's first - validate the profile image
		$allowedExts = array("jpg", "jpeg", "gif", "png");
		$extension = end(explode(".", $_FILES["file"]["name"]));
		if ((($_FILES["profileImage"]["type"] == "image/gif")
		|| ($_FILES["profileImage"]["type"] == "image/jpeg")
		|| ($_FILES["profileImage"]["type"] == "image/png")
		|| ($_FILES["profileImage"]["type"] == "image/pjpeg"))
		&& ($_FILES["profileImage"]["size"] < 20000)
		&& in_array($extension, $allowedExts)) 
		{
			if ($_FILES["profileImage"]["error"] > 0)
			{
				$error .= "<p style=\"color:red;\">Error: " . $_FILES["profileImage"]["error"] . "/p>";
				$success = false;
			}
		}
		else
		{
			echo "Invalid file";
			$success = false;
		}

		if ($success)
		{
			$emailAddress = $_POST['emailAddress'];  
			$password = $_POST['password'];  
			$password_confirm = $_POST['password-confirm'];  
			$fullName = $_POST['fullName'];
			$utcOffset = $_POST['utcOffset'];
		
			$userTools = new UserTools();  

			if($userTools->checkEmailAddressExists($emailAddress))  
			{  
					$error .= "<p style=\"color:red;\">That e-mail address is already taken.</p> \n\r";  
					$success = false;  
			}  
		}
				
    if($success)  
    {  
        $data['EmailAddress'] = $emailAddress;  
        $data['HashedPassword'] = md5($password); //encrypt the password for storage  
				$data['FullName'] = $fullName;
				$data['UtcOffset'] = $utcOffset;
	
        $newUser = new User($data);  
  
        $newUser->save(true);  
  
        //TODO log them in  
        //$userTools->login($emailAddress, $password);  
  
        //TODO redirect them to a welcome page  
        //header("Location: welcome.php");  
    }  
}  
?>  
  
<html>  
<head>  
    <title>Registration</title>  
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
		<script language="javascript">	
			function ValidateField(txt, messageIfFail)
			{
				if (txt == null || txt == "")
				{
					alert(messageIfFail);
					return false;
				}			
				return true;
			}
		
			function SubmitForm()
			{
				if (!ValidateField(document.forms["registerForm"]["emailAddress"].value, "Please enter a valid e-mail address!"))
					return;
					
				var password = document.forms["registerForm"]["password"].value;
				if (!ValidateField(password, "Please enter a valid password!"))
					return;
				if (password != document.forms["registerForm"]["password-confirm"].value)
				{
					alert("Password and Confirm Password don't match!");
					return;
				}
				if (!ValidateField(document.forms["registerForm"]["fullName"].value, "Please enter your real full name!"))
					return;
				
				var utcOffset = document.forms["registerForm"]["utcOffset"].value;
				if (!ValidateField(utcOffset, "Please enter your UTC offset (the number of hours you are ahead or behind UTC)!"))
					return;

				if((parseFloat(utcOffset) != parseInt(utcOffset)) || isNaN(utcOffset))
				{
					alert("Please enter only whole numbers for the UTC offset!");
					return;
				}
				
				document.forms["registerForm"].submit();
			}
		</script>		
</head>  
<body>  
		<?php include "header.html" ?>
		
		<div class="row">
			<div class="span12">
				<?php echo ($error != "") ? $error : ""; ?>  
				<form id="registerForm" action="register.php" method="post">  
			
				E-Mail Address: <input type="text" value="<?php echo $emailAddress; ?>" name="emailAddress" /><br/>  
				Password: <input type="password" value="<?php echo $password; ?>" name="password" /><br/>  
				Password (confirm): <input type="password" value="<?php echo $password_confirm; ?>" name="password-confirm" /><br/>  
				<p/>
				Your Full Name: <input type="text" value="<?php echo $fullName; ?>" name="fullName" /><br/>
				UTC Offset: <input type="text" value="<?php echo $utcOffset; ?>" name="utcOffset" /><br/>
				Profile image: <input type="file" name="profileImage" id="profileImage" /><br/>
				<a class="btn btn-danger" onclick="SubmitForm();">Register</a>
				</form>  
			</div>
		</div>
		
		<?php include "footer.html" ?>
</body>  
</html> 