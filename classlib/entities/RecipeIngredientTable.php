<?php

/**
 * Description of RecipeIngredientTable
 *
 * RecipeIngredientTable entity class implements the table entity class for the 'recipe_ingredients' table in the database.
 * 
 * @author conor.hanrahan
 */
class RecipeIngredientTable extends TableEntity {

    /**
     * Constructor for the RecipeIngredientTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'recipe_ingredients');  //the name of the table is passed to the parent constructor
    }


    /**
     * 
     * Adds a list of new records to the database table - recipe_steps.
     * 
     * @param array $ingredients is a copy of $_SESSION['recipeIngredients'] containing data to be inserted
     * @param int $recipeID is the ID value of the recipe these ingredients belong to
     * @return boolean
     */
    public function addAllIngredientsRecord($ingredients, $recipeID){
        $ingredientTable = new IngredientTable($this->db);
        $i = 0;        
        
        $this->SQL="INSERT INTO recipe_ingredients(ingredientID, recipeID, quantity, unit, essential) VALUES";
        foreach ($ingredients as $key => $value) {
            $key = addslashes($key); // key is ingredient name
            $value[0] = (integer) $value[0]; // value[0] is whether or not ingredient is essential (0/1)
            $value[1] = addslashes($value[1]); // value[1] is the quantity of ingredient
            $ingredientID = $ingredientTable->getIngredientIDByName($key);
            $ingredientID = $ingredientID->fetch_row();
            
            // value[2] is the unit of measurement on the quantity
            $this->SQL.="('$ingredientID[0]','$recipeID','$value[1]','$value[2]','$value[0]')";
            
            switch ($i) {
                case count($ingredients)-1:
                    $this->SQL.=";";
                    break;
                default:
                    $this->SQL.=",";                    
                    break;
            }
            $i++;
        }
        
        $recipeTable = new RecipeTable($this->db);
        // don't add ingredients if recipe doesn't already have a record in the recipes table
        if ($recipeTable->getRecordByID($recipeID)) {
            //execute the insert query
            try {
                $rs=$this->db->query($this->SQL);
            } catch (mysqli_sql_exception $e) { //catch the exception 
                $rs=FALSE;
            }
        }
        
        //check the insert query worked
        return ($rs) ? TRUE : FALSE; 
    }
    
    
    public function deleteAllIngredientsRecord($recipeID){     
        
        $this->SQL="DELETE FROM recipe_ingredients WHERE recipeID = '".$recipeID."'";

        //execute the delete query
        try {
            $rs=$this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $rs=FALSE;
        }
        
        //check the query worked
        return ($rs) ? TRUE : FALSE; 
    }
    
    public function updateAllIngredientsRecord($ingredients, $recipeID) {
        if ($this->deleteAllIngredientsRecord($recipeID)) {
            return $this->addAllIngredientsRecord($ingredients, $recipeID);
        }
        else {
            return false;
        }
    }
    
    public function getIngredientsByRecipeID($recipeID){
        //build the SQL Query
        $this->SQL="SELECT i.name, ri.quantity, ri.unit, ri.essential";
        $this->SQL.=" FROM recipe_ingredients ri JOIN ingredients i ON ri.ingredientID = i.ingredientID";
        $this->SQL.=" WHERE ri.recipeID= '$recipeID'";
        
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

