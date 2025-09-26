<?php

/**
 * Description of RecipeTable
 *
 * UserFavouritesTable entity class implements the table entity class for the 'user_favourites' table in the database.
 * 
 * @author Conor Hanrahan
 */
class UserFavouritesTable extends TableEntity {

    /**
     * Constructor for the RecipeTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'user_favourites');  //the name of the table is passed to the parent constructor
    }

    
    /**
    * Performs a SELECT query to returns all records from the table. 
    * 
    * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
    */
    public function getAllRecordsByUserID($userID){
        
        $this->SQL = "SELECT users_userID,recipes_recipeID,FROM user_favourites ORDER BY timeAdded WHERE users_userID = '".$userID."'";

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
    
    public function isRecipeFavourited($userID, $recipeID) {
        $this->SQL = "SELECT users_userID,recipes_recipeID FROM user_favourites WHERE users_userID = '".$userID."' AND recipes_recipeID = '".$recipeID."' ORDER BY timeAdded";

        try {
            $rs=$this->db->query($this->SQL);
            if($this->db->affected_rows){
                return true; //return the recordset
            }
            else{
                return false;  //no records found
            }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }        
    }
    
    
    public function addRecord($userID, $recipeID){
        //construct the INSERT SQL
        $this->SQL="INSERT INTO user_favourites(users_userID,recipes_recipeID) VALUES('$userID','$recipeID')";  
       
        //execute the insert query
        try {
            $rs=$this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $rs=FALSE;
        }

        //check the insert query worked
        if ($rs){return TRUE;}else{return FALSE;} 
    }
    
    public function deleteRecord($userID, $recipeID){
        //construct the DELETE SQL
        $this->SQL="DELETE FROM user_favourites WHERE users_userID = '".$userID."' AND recipes_recipeID = '".$recipeID."'";  
       
        //execute the delete query
        try {
            $rs=$this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $rs=FALSE;
        }

        //check the query worked
        if ($rs){return TRUE;}else{return FALSE;} 
    }
    
}

