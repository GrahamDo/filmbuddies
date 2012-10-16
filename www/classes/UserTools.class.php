<?php   
require_once 'User.class.php';  
require_once 'DB.class.php';  
  
class UserTools {   
    public function login($emailAddress, $password)  
    {   
        $hashedPassword = md5($password);  
        $result = mysql_query("SELECT * FROM User WHERE EmailAddress = '$emailAddress' AND Password = '$hashedPassword'");  
  
        if(mysql_num_rows($result) == 1)  
        {  
            $_SESSION["user"] = serialize(new User(mysql_fetch_assoc($result)));  
            $_SESSION["login_time"] = time();  
            $_SESSION["logged_in"] = 1;  
            return true;  
        }else{  
            return false;  
        }  
    }  
      
    public function logout() {  
        unset($_SESSION['user']);  
        unset($_SESSION['login_time']);  
        unset($_SESSION['logged_in']);  
        session_destroy();  
    }  
  
    public function checkEmailAddressExists($emailAddress) {  
        $result = mysql_query("select UserId from User where EmailAddress='$emailAddress'");  
        if(mysql_num_rows($result) == 0)  
        {  
            return false;  
        }else{  
            return true;  
        }  
    }  
      
    public function get($userId)  
    {  
        $db = new DB();  
        $result = $db->select('User', "UserId = $userId");  
          
        return new User($result);  
    }  
      
}  
  
?>  