<?php
/**
* This file contains the UserTable Class
* 
*/

/**
 * 
 * UserTable entity class implements the table entity class for the 'user' table in the database. 
 * 
 * @author Conor Hanrahan
 * 
 */
class UserTable extends TableEntity {

    /**
     * Constructor for the UserTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'users');  //the name of the table is passed to the parent constructor
    }


    /**
     * Performs validation of user login credentials
     * 
     * @param string $email
     * @param string $password
     * @param boolean $encryptPW True if Password is hashed
     * @return boolean Returns TRUE if validation is successful. FALSE for invalid credentials.
     */
    public function validate_login($email,$password,$encryptPW){  
        
        if($encryptPW){//encrypt the password
        $password = hash('ripemd160', $password);       
        }     
        
        $this->SQL="SELECT * FROM users WHERE email='$email' AND password='$password'";


        //execute the query
        try {
                $rs=$this->db->query($this->SQL);
            } catch (mysqli_sql_exception $e) { //catch the exception 
                $rs=FALSE;
            }
         
            //check the credentials
            if ($rs->num_rows===1 && $rs){
                //valid username and password combination entered. 
                return TRUE;
            }
            else{
                return FALSE; //user credentials are not correct
                
            }
        
    }

    
    /**
     * Performs a SELECT query to returns all records from the table. 
     * email,Firstname and Lastname columns only.
     *
     * @param $userType  String containing user type to be selected, Default is wildcard
     * 
     * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
     */
    public function getAllRecords($userType=0){
        
        if($userType){ //select data for the specified user type
           $this->SQL = "SELECT userID,email,firstName,lastName,bio,userType AS UserType FROM users WHERE userType='$userType' ORDER BY userType";
        } 
        else{  //select data for all user types
           $this->SQL = "SELECT userID,email,firstName,lastName,bio,userType AS UserType FROM users ORDER BY userType";
        }
        
        try {
            $rs=$this->db->query($this->SQL);
            if($this->db->affected_rows){
                return $rs; //return the recordset
            }
            else{
                return false;  //no records found
            }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }        
    }
    
    
    public function getAllUserTypes(){
        $enum_array = array();
        $query = "SHOW COLUMNS FROM users LIKE 'userType'";
        $result = $this->db->query($query);
        $row = $result->fetch_row();
        
        preg_match_all('/\'(.*?)\'/', $row[1], $enum_array);
        foreach($enum_array[1] as $mkey => $mval) {
            $enum_fields[$mkey+1] = $mval;
        }
        
        return $enum_fields;
    }


    /**
     * Returns a resultset record (FirstName and LastName only by email)
     * 
     * @param string $email
     * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
     */ 
    public function getRecordByEmail($email){ 
        
        //build the SQL Query
        $this->SQL="SELECT u.userID,u.firstName,u.lastName,u.bio,u.email,u.userType";
        $this->SQL.=" FROM users u";
        $this->SQL.=" WHERE u.email = '$email'";
        
        try {
                $rs=$this->db->query($this->SQL);
                if($rs->num_rows==1){ //check that only one record is returned
                    return $rs; //return the requested recordset
                }
                else{
                    return false;  //no records found
                }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }        
    }
    
    public function getRecordByID($userID){ 
        
        //build the SQL Query
        $this->SQL="SELECT u.userID,u.firstName,u.lastName,u.bio,u.email,u.userType";
        $this->SQL.=" FROM users u";
        $this->SQL.=" WHERE u.userID = '$userID'";
        
        try {
                $rs=$this->db->query($this->SQL);
                if($rs->num_rows==1){ //check that only one record is returned
                    return $rs; //return the requested recordset
                }
                else{
                    return false;  //no records found
                }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }        
    }
    
    public function getNameByID($userID){ 
        
        //build the SQL Query
        $this->SQL="SELECT CONCAT(u.firstName, ' ', u.lastName) AS name";
        $this->SQL.=" FROM users u";
        $this->SQL.=" WHERE u.userID = '$userID'";
        
        try {
                $rs=$this->db->query($this->SQL);
                if($rs->num_rows==1){ //check that only one record is returned
                    return $rs->fetch_assoc()['name']; //return the name value
                }
                else{
                    return false;  //no records found
                }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }        
    }
    
    
    public function getIDByEmail($email){ 
        
        //build the SQL Query
        $this->SQL="SELECT u.userID";
        $this->SQL.=" FROM users u";
        $this->SQL.=" WHERE u.email = '$email'";
        
        try {
                $rs=$this->db->query($this->SQL);
                if($rs->num_rows==1){ //check that only one record is returned
                    return $rs; //return the requested recordset
                }
                else{
                    return false;  //no records found
                }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }        
    }


    /**
    * Performs a DELETE query for a single record ($email).  Verifies the
    * record exists before attempting to delete
    * 
    * @param $email  String containing email of user record to be deleted
    * 
    * @return boolean Returns FALSE on failure. For successful DELETE returns TRUE
    */
    public function deleteRecordbyEmail($email){
        
        if($this->getRecordByEmail($email)){ //confirm the record exists before deletig
            $this->SQL = "DELETE FROM users WHERE email='$email'";
            
            try {
                $rs=$this->db->query($this->SQL);
                return true;
            } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;
            }
        }
        else{
            return false;
        }       
    }


    /**
     * 
     * Adds a new record to the database table - user.
     * 
     * @param array $postArray Copy of $_POST array containing data to be inserted
     * @param boolean $encryptPW  TRUE if the password will be hashed in the database record
     * @param string $userType The current user type 
     * @return boolean
     */
    public function addRecord($postArray,$encryptPW){
        
        // use extract() toget the values entered in the registration form contained in the $postArray argument
        extract($postArray);

        //add escape to special characters      
        $firstName= addslashes($firstName);//
        $lastName= addslashes($lastName);//
        $email =strtolower($email);
        $email=addslashes($email);//
        $bio=(addslashes($bio ?? ""));//
        $userType= (integer) $userType;  //usertype is integer value only   
        
        //check is password encryption is required
        if($encryptPW){//encrypt the password
        $password = hash('ripemd160', $pass1); //encrypt the password  
        }
        else{
            $password = $pass1;  //dont encrypt the password 
        }
        
        //construct the INSERT SQL
        $this->SQL="INSERT INTO users(userType,firstName,lastName,email,bio,password) VALUES($userType,'$firstName','$lastName','$email','$bio','$password')";   
       
        //execute the insert query
        try {
            $rs=$this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $rs=FALSE;
        }

        //check the insert query worked
        if ($rs){return TRUE;}else{return FALSE;} 
    }
  
    
    /**
     * Updates an existing record by ID. Does not change password or user type.  
     * 
     * @param array $postArray containing data to be inserted
         * $postArray['userID'] string StudentID
         * $postArray['firstName'] string FirstName
         * $postArray['lastName'] string LastName
         * $postArray['mobile'] string mobile
         * $postArray['county'] integer idcounty
         * $postArray['userTypeNr'] integer userTypeNr
         * $postArray['userEnabled'] integer userEnabled
         * @return boolean
     * 
     * 
     */   
    public function updateRecord($postArray){
        
        //get the values entered in the registration form contained in the $postArray argument      
        extract($postArray);
    
        //add escape to special characters      
        $firstName= addslashes($firstName);//
        $lastName= addslashes($lastName);//
        $email=addslashes($email);//
        $bio=addslashes($bio);//
        $userType= (integer)$userType;//    
          
        //construct the INSERT SQL                    
        $this->SQL="UPDATE users SET firstName='$firstName',lastName='$lastName',userType=$userType,email='$email', bio='$bio' WHERE userID='$userID'";   
               
        //execute the query
            try {
                $rs=$this->db->query($this->SQL);
            } catch (mysqli_sql_exception $e) { //catch the exception 
                $rs=FALSE;
            }

        //check the insert query worked
        if ($this->db->affected_rows===1 && $rs){return TRUE;}else{return FALSE;}
    }
    
    
    /**
    * Validates and implements password change for specified user.  
    * 
    * @param array $postArray containing data to be inserted
       * $postArray['pass1'] String New Password copy 1 
       * $postArray['pass2'] String New Password copy 2
       * $postArray['email'] String user ID/email address 
       * $postArray['password'] String user old Password
    * @param User $user The current user.
    * 
    * @return boolean TRUE if password is changes, else FALSE
    * 
    * 
    */   
    public function changePassword($postArray,$user){
        
        //get the values entered in the registration form contained in the $postArray argument      
        extract($postArray);
    
        //add escape to special characters      
        $pass1= addslashes($pass1);
        $pass2= addslashes($pass2);
        $password= addslashes($password);
        $email=$user->getEmail();
        $userID = $user->getUserID();

        //check old password is valid before changing, make sure new passwords match
        if($this->validate_login($email, $password, $user->getPWEncrypted()) && $pass1 === $pass2){
                         
            //encrypt the password if required
            if($user->getPWEncrypted()){
                $pass1 = hash('ripemd160', $pass1);       
            }  
            
            //construct the UPDATE SQL 
            $this->SQL="UPDATE users SET password='$pass1' WHERE userID='$userID'";   
            
            //execute the query
            try {
                $rs=$this->db->query($this->SQL);
            } catch (mysqli_sql_exception $e) { //catch the exception 
                $rs=FALSE;
            }
            
            //check the insert query worked
            if ($this->db->affected_rows===1 && $rs){return TRUE;}else{return FALSE;}
        }
        else{return FALSE;}  //user did not provide valid old password
    }
    
    
}

