<?php

/**
 * Description of IngredientTable
 *
 * Ingredient entity class implements the table entity class for the 'ingredients' table in the database.
 * 
 * @author Conor Hanrahan
 */
class IngredientTable extends TableEntity {

    /**
     * Constructor for the IngredientTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'ingredients');  //the name of the table is passed to the parent constructor
    }

    
    /**
     * Performs a SELECT query to returns all records from the table. 
     * 
     * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
     */
    public function getAllRecords(){
        
        $this->SQL = "SELECT name FROM ingredients ORDER BY name";    
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
    
    
    public function getIngredientIDByName($name){
        $this->SQL = "SELECT ingredientID FROM ingredients WHERE name = '$name' LIMIT 1";   
        
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
}

    
    


