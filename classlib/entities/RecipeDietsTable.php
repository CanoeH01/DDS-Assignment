<?php

/**
 * Description of RecipeTable
 *
 * RecipeDietsTable entity class implements the table entity class for the 'recipe_diets' table in the database.
 * 
 * @author Conor Hanrahan
 */
class RecipeDietsTable extends TableEntity {

    /**
     * Constructor for the RecipeTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'recipe_diets');  //the name of the table is passed to the parent constructor
    }
    
    
    
    /**
     * 
     * Adds a new record to the database table - recipes.
     * 
     * @param array $postArray Copy of $_POST array containing data to be inserted
     * @param string $imageName containing the generated file name for a recipe thumbnail upload
     * @return boolean
     */
    public function addAllRecipeDiets($recipeID, $diets){
        if ($diets) {
            $this->SQL = "INSERT INTO recipe_diets(recipeID, dietID) VALUES";
            //construct the INSERT SQL
            for ($i = 0; $i < count($diets); $i++) {
                switch ($i) {
                    case count($diets) - 1;
                        $this->SQL.="('$recipeID','$diets[$i]]');";
                        break;

                    default:
                        $this->SQL.="('$recipeID','$diets[$i]]'), ";
                        break;
                }
            }       
            
            //execute the insert query
            try {
                $rs=$this->db->query($this->SQL);
            } catch (mysqli_sql_exception $e) { //catch the exception 
                $rs=FALSE;
            }
            
            if ($rs){return TRUE;}else{return FALSE;}
        }   
        else {
            return true;
        }
    }
    
    public function deleteAllRecipeDiets($recipeID){
        
        $this->SQL = "DELETE FROM recipe_diets WHERE recipeID = '".$recipeID."'";

        //execute the delete query
        try {
            $rs=$this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $rs=FALSE;
        }

        //check the insert query worked
        if ($rs){return TRUE;}else{return FALSE;}  
    }
    
    public function updateAllRecipeDiets($recipeID, $diets){
        if ($this->deleteAllRecipeDiets($recipeID)) {
            return $this->addAllRecipeDiets($recipeID, $diets);
        }
        else {
            return false;
        }
    }
    
    
        public function getAllDietsByRecipeID($recipeID){
        //build the SQL Query
        $this->SQL="SELECT dietID";
        $this->SQL.=" FROM recipe_diets";
        $this->SQL.=" WHERE recipeID= '$recipeID'";
        
        try {
            $rs=$this->db->query($this->SQL);
            if($rs->num_rows > 0){ //check that at least one record has returned
                return $rs; //return the requested recordset
            }
            else{
                return false;  //no records found
            }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            } 
    }
}

