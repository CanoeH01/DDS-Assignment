<?php

/**
 * Description of RecipeTable
 *
 * RecipeReviewTable entity class implements the table entity class for the 'recipe_reviews' table in the database.
 * 
 * @author Conor Hanrahan
 */
class RecipeReviewTable extends TableEntity {

    /**
     * Constructor for the RecipeTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'recipe_reviews');  //the name of the table is passed to the parent constructor
    }

    
    /**
    * Performs a SELECT query to returns all records from the table. 
    * 
    * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
    */
    
    
    public function getRecordsPageByRecipeID($recipeID){
        $page = isset($_GET['pageReview']) ? (integer)$_GET['pageReview'] : 1;
        $rowsPerPage = 5;
        $offset = ($page - 1) * $rowsPerPage;
        
        $this->SQL = "SELECT CONCAT(u.firstName, ' ', u.lastName) AS name, rr.reviewerID, rr.rating, rr.comment, rr.timeCreated FROM recipe_reviews rr JOIN users u ON rr.reviewerID = u.userID WHERE recipeID = '".$recipeID."' ORDER BY timeCreated DESC LIMIT ? OFFSET ?";
        
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
    
    
    public function getRecordsPageByReviewerID($reviewerID){
        $page = isset($_GET['pageReview']) ? (integer)$_GET['pageReview'] : 1;
        $rowsPerPage = 5;
        $offset = ($page - 1) * $rowsPerPage;
        
        $this->SQL = "SELECT r.name, rr.reviewerID, r.recipeID, rr.rating, rr.comment, rr.timeCreated FROM recipe_reviews rr JOIN recipes r ON rr.recipeID = r.recipeID WHERE reviewerID = '".$reviewerID."' ORDER BY timeCreated DESC LIMIT ? OFFSET ?";
        
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
    
    public function getAverageRatingByRecipeID($recipeID) {
        $this->SQL = "SELECT AVG(rating) as avgRating FROM recipe_reviews WHERE recipeID = '".$recipeID."'";
        
        try {
            $rs=$this->db->query($this->SQL);
            if($rs){ //check that record is returned
                return $rs->fetch_assoc()['avgRating']; //return the requested record value
            }
            else{
                return 0;  //no records found
            }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }       
    }
    
    public function getTotalReviewsByRecipeID($recipeID) {
        $this->SQL = "SELECT COUNT(rating) as totalReviews FROM recipe_reviews WHERE recipeID = '".$recipeID."'";
        
        try {
            $rs=$this->db->query($this->SQL);
            if($rs){ //check that record is returned
                return $rs->fetch_assoc()['totalReviews']; //return the requested record value
            }
            else{
                return 0;  //no records found
            }  
        } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;  //the query failed for some reason
            }       
    }


    public function getPagesCountByRecipeID($recipeID){
        $this->SQL = "SELECT COUNT(*) as total FROM recipe_reviews WHERE recipeID = '".$recipeID."'";
        $total = $this->db->query($this->SQL);
        $total = $total->fetch_assoc()['total'];
        $total = ceil($total / 5);
        
        return $total;
    }
    
    public function getPagesCountByReviewerID($reviewerID){
        $this->SQL = "SELECT COUNT(*) as total FROM recipe_reviews WHERE reviewerID = '".$reviewerID."'";
        $total = $this->db->query($this->SQL);
        $total = $total->fetch_assoc()['total'];
        $total = ceil($total / 5);
        
        return $total;
    }
    
   
    
    /**
     * 
     * Adds a new record to the database table - recipe_reviews.
     * 
     * @param array $postArray Copy of $_POST array containing data to be inserted
     * @return boolean
     */
    public function addRecord($postArray, $recipeID){
        
        // use extract() toget the values entered in the form contained in the $postArray argument
        extract($postArray);

        //add escape to special characters
        $rating = addslashes($rating);
        $comment = addslashes($comment);
        $reviewerID = (int)$reviewerID;
        
        
        //construct the INSERT SQL
        $this->SQL="INSERT INTO recipe_reviews(recipeID,reviewerID,rating,comment) VALUES('$recipeID','$reviewerID','$rating','$comment')";   
       
        //execute the insert query
        try {
            $rs=$this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $rs=FALSE;
        }

        //check the insert query worked
        if ($rs){return TRUE;}else{return FALSE;} 
    }
    
    public function getRecordByReviewerIDRecipeID($reviewerID, $recipeID){ 
        $this->SQL = "SELECT * FROM recipe_reviews WHERE reviewerID ='$reviewerID' AND recipeID='$recipeID'";

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
    
    public function deleteRecordByReviewerIDRecipeID($reviewerID, $recipeID){
        if ($this->getRecordByReviewerIDRecipeID($reviewerID, $recipeID)) {
            $this->SQL = "DELETE FROM recipe_reviews WHERE reviewerID ='$reviewerID' AND recipeID='$recipeID'";

            try {
                $rs=$this->db->query($this->SQL);
                return true;
            } catch (mysqli_sql_exception $e) { //catch the exception 
                return false;
            } 
        }
        else {
            return false;
        }
         
    }    
    
}

