<?php
/**
* This file contains the ViewRecipe Class
* 
*/


/**
 * AdminRecipeDetails is an extended PanelModel Class
 * 
 * The purpose of this class is to generate HTML view panel headings and template content
 * for a <em><b>Recipe Description</b></em>  page.  The content generated is intended for 3 panel
 * view layouts. 
 *   
 *
 * @author Conor Hanrahan
 * 
 */

class AdminRecipeDetails extends PanelModel {
  
    /**
    * Constructor Method
    * 
    * The constructor for the PanelModel class. The ManageSystems class provides the 
    * panel content for up to 3 page panels.
    * 
    * @param User $user  The current user
    * @param MySQLi $db The database connection handle
    * @param Array $postArray Copy of the $_POST array
    * @param String $pageTitle The page Title
    * @param String $pageHead The Page Heading
    * @param String $pageID The currently selected Page ID
    * 
    */  
    function __construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID){  
        $this->modelType='AdminRecipeDetails';
        parent::__construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID);
    } 
    
    
    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1(){
        switch ($this->pageID) {
            case "viewRecipes":
                $this->panelHead_1='<h3>Results</h3>';
                break;

            default:
                break;
        }      
    }
    
    /**
    * Set the Panel 1 text content 
    */ 
    public function setPanelContent_1(){
        
        switch ($this->pageID) {
            case "recipeDetails":
                $recipeTable = new RecipeTable($this->db);
                if (isset($this->postArray['btnDeleteRecipe'])) {
                    $pageID = $this->pageID . "&id=" . $_GET['id'];
                    $this->panelContent_1 = Form::form_confirm_recipe($pageID, "Confirm Deletion", $_GET['id']);
                }
                else if (isset($this->postArray['btnConfirm'])) {
                    if ($recipeTable->deleteRecordByID($_GET['id'])) {
                        $this->panelContent_1 = '<p><strong>Recipe deleted successfully</strong>    <a href="index.php?pageID=myProfile">Home</a></p>';
                    }
                    else {
                        $this->panelContent_1 = '<p><strong>Recipe could not be deleted</strong>    <a href="index.php?pageID=myProfile">Home</a></p>';
                    }
                    
                }
                else {                
                    $recipe = $recipeTable->getRecordByID($_GET['id']);
                    $recipe = $recipe->fetch_assoc();
                    $userTable = new UserTable($this->db);
                    $creatorName = $userTable->getNameByID($recipe['creatorID']);
                    $userID = $this->user->getUserID();

                    $recipeID = $recipe['recipeID'] ?? null;
                    $userFavouritesTable = new UserFavouritesTable($this->db);
                    $isFavourited = $userFavouritesTable->isRecipeFavourited($userID, $recipeID);
                    
                    $recipeReviewTable = new RecipeReviewTable($this->db);
                    $avgReview = (int) $recipeReviewTable->getAverageRatingByRecipeID($recipeID);
                    $totalReviews = $recipeReviewTable->getTotalReviewsByRecipeID($recipeID);

                    $this->panelContent_1 = HelperHTML::generateRecipeInfoCardEditDelete($recipe, $creatorName, $userID, $this->pageID, $isFavourited, $avgReview, $totalReviews);
                        
                    if (isset($this->postArray['btnAddFavourite'])) {
                        if ($userFavouritesTable->addRecord($userID, $recipeID)) {
                            $isFavourited = true;
                            $this->panelContent_1 = HelperHTML::generateRecipeInfoCardEditDelete($recipe, $creatorName, $userID , $this->pageID, $isFavourited, $avgReview, $totalReviews);
                        }
                    }
                    elseif (isset($this->postArray['btnRemoveFavourite'])){
                        if ($userFavouritesTable->deleteRecord($userID, $recipeID)) {
                            $isFavourited = false;
                            $this->panelContent_1 = HelperHTML::generateRecipeInfoCardEditDelete($recipe, $creatorName, $userID , $this->pageID, $isFavourited, $avgReview, $totalReviews);
                        }
                    }    
                }
                break;

            default:
                break;
        }

    }        

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2(){ 
        $this->panelHead_2=''; 
    }  
    
    /**
    * Set the Panel 2 text content 
    */ 
    public function setPanelContent_2(){
        
        switch ($this->pageID) {
            case "recipeDetails": 
                
                if (isset($this->postArray['btnDeleteRecipe'])) {
                    $this->panelContent_2 = "";
                }
                else if (isset($this->postArray['btnConfirm'])) {
                    $this->panelContent_2 = "";
                }
                else {
                    $recipeStepTable = new RecipeStepTable($this->db);
                    $recipeIngredientsTable = new RecipeIngredientTable($this->db);
                    $steps = $recipeStepTable->getStepsByRecipeID($_GET['id']);
                    $ingredients = $recipeIngredientsTable->getIngredientsByRecipeID($_GET['id']);
                    $this->panelContent_2= HelperHTML::generateRecipeDetailsCard($ingredients, $steps);
                }
                

                break;

            default:
                break;
        }

    }

    /**
     * Set the Panel 3 heading 
     */
    public function setPanelHead_3(){ 
        switch ($this->pageID) {
            case "recipeDetails": 
                
                if (isset($this->postArray['btnDeleteRecipe'])) {
                    $this->panelHead_3 = "";
                }
                else if (isset($this->postArray['btnConfirm'])) {
                    $this->panelHead_3 = "";
                }
                else {
                    $this->panelHead_3 = '<h3>Reviews</h3>';
                }
                

                break;

            default:
                break;
        };
    } 
    
    /**
    * Set the Panel 3 text content 
    */ 
    public function setPanelContent_3(){
        switch ($this->pageID) {
            case "recipeDetails": 
                
                if (isset($this->postArray['btnDeleteRecipe'])) {
                    $this->panelContent_3 = "";
                }
                else if (isset($this->postArray['btnConfirm'])) {
                    $this->panelContent_3 = "";
                }
                else {
                    
                    $recipeReviewTable = new RecipeReviewTable($this->db);
                    if (isset($this->postArray['btnAddReview'])) {
                        if ($recipeReviewTable->addRecord($this->postArray, $_GET['id'])) {
                            header("Location: index.php?pageID=$this->pageID&id=".$_GET['id']."#review");
                        }
                        else {
                            $this->panelContent_3 = '<strong class="col-sm-4" style="padding-top: 2.5em;">Review could not be added, users can only leave 1 review per recipe</strong>';
                        }
                    }
                    else {
                        $reviewerID = $this->user->getUserID();
                        $this->panelContent_3 = Form::form_add_review($this->pageID, $_GET['id'], $reviewerID);
                    }
                    
                    $reviews = $recipeReviewTable->getRecordsPageByRecipeID($_GET['id']);
                    $totalPages = $recipeReviewTable->getPagesCountByRecipeID($_GET['id']);
                    $this->panelContent_3 .= HelperHTML::generateReviewList($reviews, $_GET['pageReviews'] ?? 1, $totalPages, $_GET['id'], $this->pageID);
                }
                

                break;

            default:
                break;
        };
    }        

        
        
}
        