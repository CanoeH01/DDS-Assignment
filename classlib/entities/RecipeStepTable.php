<?php

/**
 * Description of RecipeStepTable
 *
 * RecipeStepTable entity class implements the table entity class for the 'recipe_steps' table in the database.
 * 
 * @author Conor Hanrahan
 */
class RecipeStepTable extends TableEntity {

    /**
     * Constructor for the RecipeStepTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'recipe_steps');  //the name of the table is passed to the parent constructor
    }

    
    /**
     * 
     * Adds a list of new records to the database table - recipe_steps.
     * 
     * @param array $steps is a copy of $_SESSION['recipeSteps'] containing data to be inserted
     * @param int $recipeID is the ID value of the recipe these steps belong to
     * @return boolean
     */
    public function addAllStepsRecord($steps, $recipeID){  
        $this->SQL="INSERT INTO recipe_steps(recipeID, stepNo, instructions) VALUES";
        
        for ($i = 0; $i < count($steps); $i++) {
            $steps[$i] = addslashes($steps[$i]);
            
            $this->SQL.="('$recipeID','".($i + 1)."','$steps[$i]')";
            switch ($i) {
                case count($steps)-1:
                    $this->SQL.=";";
                    break;
                default:
                    $this->SQL.=",";                    
                    break;
            }
        }

        $recipeTable = new RecipeTable($this->db);
        // don't add steps if recipe doesn't already have a record in the recipes table
        if ($recipeTable->getRecordByID($recipeID)) {
            //execute the insert query
            try {
                $rs=$this->db->query($this->SQL);
            } catch (mysqli_sql_exception $e) { //catch the exception 
                $rs=FALSE;
            }
        }
        
        //check the insert query worked
        return ($rs)? TRUE : FALSE; 
    }
    
    public function deleteAllStepsRecord($recipeID){  
        $this->SQL="DELETE FROM recipe_steps WHERE recipeID = '".$recipeID."'";
        
        //execute the delete query
        try {
            $rs=$this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $rs=FALSE;
        }
        
        //check the query worked
        return ($rs)? TRUE : FALSE; 
    }
    
    public function updateAllStepsRecord($steps, $recipeID){
        if ($this->deleteAllStepsRecord($recipeID)) {
            return $this->addAllStepsRecord($steps, $recipeID);
        }
        else {
            return false;
        }
    }
    
    public function getStepsByRecipeID($recipeID){
        //build the SQL Query
        $this->SQL="SELECT instructions";
        $this->SQL.=" FROM recipe_steps";
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

