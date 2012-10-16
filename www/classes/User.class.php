<?php  
require_once 'DB.class.php';  
    
class User {  
	public $UserId;
	public $DateAddedUtc;
	public $EmailAddress;
	public $FullName;
	public $HashedPassword;
	public $UtcOffset;
	public $ProfileImageLocation;
  
    function __construct($data) {  
		$this->UserId = (isset($data['UserId'])) ? $data['UserId'] : "";
		$this->DateAddedUtc = (isset($data['DateAddedUtc'])) ? data['DateAddedUtc'] : "";
		$this->EmailAddress = (isset($data['EmailAddress'])) ? data['EmailAddress'] : "";
		$this->FullName = (isset($data['FullName'])) ? data['FullName'] : "";
		$this->HashedPassword = (isset($data['HashedPassword'])) ? data['HashedPassword'] : "";
		$this->UtcOffset = (isset($data['UtcOffset'])) ? data['UtcOffset'] : "";
		$this->ProfileImageLocation = (isset($data['ProfileImageLocation'])) ? data['ProfileImageLocation'] : "";
    }  
  
    public function save($isNewUser = false) {  
        //create a new database object.  
        $db = new DB();  
          
        //if the user is already registered and we're  
        //just updating their info.  
        if(!$isNewUser) {  
            //set the data array  
            $data = array(  
                "EmailAddress" => "'$this->EmailAddress'",
				"FullName" => "'$this->FullName'",
                "HashedPassword" => "'$this->HashedPassword'",  
				"UtcOffset" => "'$this->UtcOffset'",
				"ProfileImageLocation" => "'this->ProfileImageLocation'"
            );  
            $db->update($data, 'users', 'UserId = '.$this->UserId); 
        }else { 
        //if the user is being registered for the first time. 
            $data = array( 
                "EmailAddress" => "'$this->EmailAddress'",
				"FullName" => "'$this->FullName'",
                "HashedPassword" => "'$this->HashedPassword'",  
				"UtcOffset" => "'$this->UtcOffset'",
				"ProfileImageLocation" => "'this->ProfileImageLocation'"
            );  
              
            $this->UserId = $db->insert($data, 'User');  
            $this->DateAddedUtc = time();  
        }  
        return true;  
    }  
}  
?>  