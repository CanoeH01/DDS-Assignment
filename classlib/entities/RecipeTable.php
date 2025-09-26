<?php

/**
 * Description of RecipeTable
 *
 * RecipeTable entity class implements the table entity class for the 'recipes' table in the database.
 * 
 * @author Conor Hanrahan
 */
class RecipeTable extends TableEntity {

    /**
     * Constructor for the RecipeTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'recipes');  //the name of the table is passed to the parent constructor
    }

    
    /**
    * Performs a SELECT query to returns all records from the table. 
    * 
    * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
    */
    public function getAllRecords(){
        
        $this->SQL = "SELECT recipeID,name,description,prepTimeMinutes,cookTimeMinutes,difficulty,mealType,creatorID,thumbnail,servings FROM recipes ORDER BY timeCreated";

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
    
    
    public function getRecordsPage(){
        $page = isset($_GET['page']) ? (integer)$_GET['page'] : 1;
        $rowsPerPage = 10;
        $offset = ($page - 1) * $rowsPerPage;
        
        $this->SQL = "SELECT r.recipeID,r.name,r.description,r.prepTimeMinutes,r.cookTimeMinutes,r.difficulty,r.mealType,r.thumbnail,r.creatorID, COUNT(rr.rating) AS totalRatings, AVG(rr.rating) AS avgRating"
                . " FROM recipes r"
                . " LEFT JOIN recipe_reviews rr ON r.recipeID = rr.recipeID"
                . " GROUP BY r.recipeID"
                . " ORDER BY r.timeCreated DESC"
                . " LIMIT ? OFFSET ?";
        
        $prep = $this->db->prepare($this->SQL);
        $prep->bind_param("ii", $rowsPerPage, $offset);

        try {
            $prep->execute();
            $rs= $prep->get_result() ?? false;
            if($rs){
                $pageRows = $rs->fetch_all(MYSQLI_ASSOC);
                return $pageRows;
            }
            else{
                return false;  //no records found
            }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }        
    }
    
    public function getFilteredRecordsPage($mealType, $diet, $totalTime, $difficulty, $search, $creatorID, $userID){
        $page = isset($_GET['page']) ? (integer)$_GET['page'] : 1;
        $rowsPerPage = 10;
        $offset = ($page - 1) * $rowsPerPage;
        
        $this->SQL = "SELECT DISTINCT r.recipeID,r.name,r.description,r.prepTimeMinutes,r.cookTimeMinutes,r.difficulty,r.mealType,r.thumbnail,r.creatorID, COUNT(rr.rating)AS totalRatings, AVG(rr.rating) AS avgRating"
                . " FROM recipes r"
                . " LEFT JOIN recipe_reviews rr ON r.recipeID = rr.recipeID"
                . " LEFT JOIN recipe_diets rd ON r.recipeID = rd.recipeID"
                . " LEFT JOIN user_favourites ur ON r.recipeID = ur.recipes_recipeID";
        $this->SQL .= " WHERE 1=1";
        if ($search) {
            $this->SQL .= " AND r.name LIKE '%".$search."%'";
        }
        if ($mealType) {
            $this->SQL .= " AND r.mealType = '".$mealType."'";
        }
        if ($totalTime) { 
            $this->SQL .= " AND (r.prepTimeMinutes + r.cookTimeMinutes) <= '".$totalTime."'";
        }
        if ($difficulty) { 
            $this->SQL .= " AND r.difficulty = '".$difficulty."'";
        }
        if ($creatorID) {
            $this->SQL .=" AND r.creatorID = '".$creatorID."'";
        }
        if ($userID) {
            $this->SQL .= " AND ur.users_userID = '".$userID."'";
        }
        if ($diet) {
            $dietTable = new DietTable($this->db);
            $dietID = $dietTable->getIDByName($diet);
            $this->SQL.=" AND rd.dietID = '".$dietID."'";
        }
        $this->SQL .= " GROUP BY r.recipeID ORDER BY r.timeCreated DESC LIMIT ? OFFSET ?"; 
        $prep = $this->db->prepare($this->SQL);
        $prep->bind_param("ii", $rowsPerPage, $offset);

        try {
            $prep->execute();
            $rs= $prep->get_result() ?? false;
            $prep->close();
            if($rs){
                return $rs;
            }
            else{
                return false;  //no records found
            }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }        
    }


    public function getPagesCount(){
        $this->SQL = "SELECT COUNT(*) as total FROM recipes";
        $total = $this->db->query($this->SQL);
        $total = $total->fetch_assoc()['total'];
        $total = ceil($total / 10);
        
        return $total;
    }
    
    public function getFilteredPagesCount($mealType, $diet, $totalTime, $difficulty, $search, $creatorID, $userID){
        $this->SQL = "SELECT COUNT(DISTINCT r.recipeID) as total FROM recipes r LEFT JOIN recipe_diets rd ON r.recipeID = rd.recipeID LEFT JOIN user_favourites ur ON r.recipeID = ur.recipes_recipeID";
        $this->SQL .= " WHERE 1=1";
        if ($search) {
            $this->SQL .= " AND r.name LIKE '%".$search."%'";
        }
        if ($mealType) {
            $this->SQL .= " AND r.mealType = '".$mealType."'";
        }
        if ($totalTime) { 
            $this->SQL .= " AND (r.prepTimeMinutes + r.cookTimeMinutes) <= '".$totalTime."'";
        }
        if ($difficulty) { 
            $this->SQL .= " AND r.difficulty = '".$difficulty."'";
        }
        if ($creatorID) {
            $this->SQL .=" AND r.creatorID = '".$creatorID."'";
        }
        if ($userID) {
            $this->SQL .= " AND ur.users_userID = '".$userID."'";
        }
        if ($diet) {
            $dietTable = new DietTable($this->db);
            $dietID = $dietTable->getIDByName($diet);
            $this->SQL.=" AND rd.dietID = '".$dietID."'";
        }
        
       
        $total = $this->db->query($this->SQL);
        $total = $total->fetch_assoc()['total'];
        $total = ceil($total / 10);
        
        return $total;
    }
    
    
    public function getAllMealTypes(){
        $enum_array = array();
        $query = "SHOW COLUMNS FROM recipes LIKE 'mealType'";
        $result = $this->db->query($query);
        $row = $result->fetch_row();
        
        preg_match_all('/\'(.*?)\'/', $row[1], $enum_array);
        foreach($enum_array[1] as $mkey => $mval){
            $enum_fields[$mkey+1] = $mval;
        }
        
        return $enum_fields;
    }
    
    
    public function getAllUnitTypes() {
        $enum_array = array();
        $query = "SHOW COLUMNS FROM recipe_ingredients LIKE 'unit'";
        $result = $this->db->query($query);
        $row = $result->fetch_row();
        
        preg_match_all('/\'(.*?)\'/', $row[1], $enum_array);
        foreach($enum_array[1] as $mkey => $mval){ 
            $enum_fields[$mkey+1] = $mval;
        }
        
        return $enum_fields;
    }
    
    /**
     * Returns a resultset record (name, description, prepTimeMinutes, cookTimeMinutes, difficulty, mealType, creatorID)
     * 
     * @param string $recipeID
     * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
     */ 
    public function getRecordByID($recipeID){ 
        
        //build the SQL Query
        $this->SQL="SELECT name, recipeID, description, prepTimeMinutes, cookTimeMinutes, difficulty, mealType, creatorID, thumbnail, servings";
        $this->SQL.=" FROM recipes";
        $this->SQL.=" WHERE recipeID= '$recipeID'";
        
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
    
    
    public function deleteRecordByID($recipeID){ 
        if($recipe = $this->getRecordByID($recipeID)){ //confirm the record exists before deleting
            $this->SQL = "DELETE FROM recipes WHERE recipeID='$recipeID'";
            
            try {
                $rs=$this->db->query($this->SQL);
                
                $thumbnail = $recipe->fetch_assoc()['thumbnail'];
                if ($thumbnail && $thumbnail !== 'recipe_default.jpg') {
                    $path = 'assets/images/uploads/' . $thumbnail;
                    if (file_exists($path)) {
                        unlink($path); // delete recipe thumbnail
                    }
                }
                return true;
            } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;
            }
        }
        else{
            return false;
        }   
    }    
    
    
    public function getIDByNameAndCreator($name, $creatorID){ 
        
        //build the SQL Query
        $this->SQL="SELECT recipeID";
        $this->SQL.=" FROM recipes";
        $this->SQL.=" WHERE creatorID = '$creatorID' AND name = '$name' LIMIT 1";
        
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
    
    
    public function getRecordsByCreator($creatorID){ 
        $page = isset($_GET['page']) ? (integer)$_GET['page'] : 1;
        $rowsPerPage = 10;
        $offset = ($page - 1) * $rowsPerPage;
        
        $this->SQL = "SELECT recipeID,name,description,prepTimeMinutes,cookTimeMinutes,difficulty,mealType,thumbnail FROM recipes WHERE creatorID = '".$creatorID."' ORDER BY timeCreated LIMIT ? OFFSET ?";
        
        $prep = $this->db->prepare($this->SQL);
        $prep->bind_param("ii", $rowsPerPage, $offset);

        try {
            $prep->execute();
            $rs= $prep->get_result() ?? false;
            if($rs){
                $pageRows = $rs->fetch_all(MYSQLI_ASSOC);
                return $pageRows;
            }
            else{
                return false;  //no records found
            }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }        
    }
    
    /**
     * 
     * Adds a new record to the database table - recipes.
     * 
     * @param array $postArray Copy of $_POST array containing data to be inserted
     * @param string $imageName containing the generated file name for a recipe thumbnail upload
     * @return boolean
     */
    public function addRecord($postArray, $imageName = 'recipe_default'){
        
        // use extract() toget the values entered in the form contained in the $postArray argument
        extract($postArray);

        //add escape to special characters      
        $name= addslashes($name);//
        $description= addslashes($description);//
        $prepTimeMinutes=(integer)$prepTimeMinutes;//
        $cookTimeMinutes=(integer)$cookTimeMinutes;//
        $difficulty=addslashes($difficulty);//
        $mealType=(integer) $mealType;  //
        $servings=addslashes($servings);//
        
        $session = new Session();
        $creatorID = $session->getUserID();
        
        
        //construct the INSERT SQL
        $this->SQL="INSERT INTO recipes(name,description,prepTimeMinutes,cookTimeMinutes,difficulty,mealType,creatorID,thumbnail,servings) VALUES('$name','$description','$prepTimeMinutes','$cookTimeMinutes','$difficulty','$mealType', '$creatorID','$imageName','$servings')";   
       
        //execute the insert query
        try {
            $rs=$this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $rs=FALSE;
        }

        //check the insert query worked
        if ($rs){return TRUE;}else{return FALSE;} 
    }
    
    public function updateRecord($postArray, $imageName){
        
        // use extract() toget the values entered in the form contained in the $postArray argument
        extract($postArray);

        //add escape to special characters      
        $name= addslashes($name);//
        $description= addslashes($description);//
        $prepTimeMinutes=(integer)$prepTimeMinutes;//
        $cookTimeMinutes=(integer)$cookTimeMinutes;//
        $difficulty=addslashes($difficulty);//
        $mealType=(integer) $mealType;  //
        $servings=addslashes($servings);//
        $recipeID = $_GET['id'];
        
        
        //construct the INSERT SQL
        $this->SQL="UPDATE recipes SET name = '$name', description = '$description', prepTimeMinutes = '$prepTimeMinutes', cookTimeMinutes = '$cookTimeMinutes', difficulty = '$difficulty', mealType = '$mealType', servings = '$servings'"; 
        
        if ($imageName) {
            $this->SQL .= ", thumbnail = '".$thumbnail."'";
        }
        
        $this->SQL .= " WHERE recipeID = '".$recipeID."'";
       
        //execute the insert query
        try {
            $rs=$this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $rs=FALSE;
        }

        //check the insert query worked
        if ($rs){return TRUE;}else{return FALSE;} 
    }
    
}

