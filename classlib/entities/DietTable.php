<?php

/**
 * Description of DietTable
 *
 * DietTable entity class implements the table entity class for the 'diets' table in the database.
 * 
 * @author Conor Hanrahan
 */
class DietTable extends TableEntity {

    /**
     * Constructor for the RecipeTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'diets');  //the name of the table is passed to the parent constructor
    }

    
    /**
    * Performs a SELECT query to returns all records from the table. 
    * 
    * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
    */
    public function getAllRecords(){  
        $this->SQL = "SELECT dietID AS dietID, dietType AS dietType FROM diets";

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
    
    public function getIDByName($dietType){  
        $this->SQL = "SELECT dietID AS dietID FROM diets WHERE dietType = '". $dietType."'";

        try {
            $rs=$this->db->query($this->SQL);
            if($this->db->affected_rows){
                $dietName = $rs->fetch_assoc()['dietID'];
                return $dietName; //return the value
            }
            else{
                return false;  //no records found
            }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }        
    }
    
    
    
}


    
    


