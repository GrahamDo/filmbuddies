<?php  
require_once 'includes/global.inc.php';  
$emailAddress = "";  
$password = "";  
$password_confirm = "";  
$error = "";  
  
if(isset($_POST['submit-form'])) {     
    //retrieve the $_POST variables  
    $emailAddress = $_POST['emailAddress'];  
    $password = $_POST['password'];  
    $password_confirm = $_POST['password-confirm'];  
  
    //initialize variables for form validation  
    $success = true;  
    $userTools = new UserTools();  
  
    //validate that the form was filled out correctly  
    //check to see if user name already exists  
    if($userTools->checkEmailAddressExists($emailAddress))  
    {  
        $error .= "That e-mail address is already taken.<br/> \n\r";  
        $success = false;  
    }  
  
    //check to see if passwords match  
    if($password != $password_confirm) {  
        $error .= "Passwords do not match.<br/> \n\r";  
        $success = false;  
    }  
  
    if($success)  
    {  
        //prep the data for saving in a new user object  
        $data['EmailAddress'] = $emailAddress;  
        $data['password'] = md5($password); //encrypt the password for storage  
  
        //create the new user object  
        $newUser = new User($data);  
  
        //save the new user to the database  
        $newUser->save(true);  
  
        //log them in  
        $userTools->login($emailAddress, $password);  
  
        //redirect them to a welcome page  
        header("Location: welcome.php");  
    }  
}  
  
//If the form wasn't submitted, or didn't validate  
//then we show the registration form again  
?>  
  
<html>  
<head>  
    <title>Registration</title>  
</head>  
<body>  
    <?php echo ($error != "") ? $error : ""; ?>  
    <form action="register.php" method="post">  
  
    E-Mail Address: <input type="text" value="<?php echo $emailAddress; ?>" name="emailAddress" /><br/>  
    Password: <input type="password" value="<?php echo $password; ?>" name="password" /><br/>  
    Password (confirm): <input type="password" value="<?php echo $password_confirm; ?>" name="password-confirm" /><br/>  
    E-Mail: <input type="text" value="<?php echo $email; ?>" name="email" /><br/>  
    <input type="submit" value="Register" name="submit-form" />  
  
    </form>  
</body>  
</html> 