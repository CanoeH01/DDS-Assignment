<?php
/**
* This file contains the ViewRecipe Class
* 
*/


/**
 * ViewRecipe is an extended PanelModel Class
 * 
 * The purpose of this class is to generate HTML view panel headings and template content
 * for a <em><b>User Profile</b></em>  page.  The content generated is intended for 3 panel
 * view layouts. 
 *   
 *
 * @author conor.hanrahan
 * 
 */

class ViewRecipe extends PanelModel {
  
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
        $this->modelType='ViewRecipe';
        parent::__construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID);
    } 
    
    
    public function getFilters(){
        $dietTable = new DietTable($this->db);
        $filters = array();
        $filters['meal type'] = (isset($_GET['mealType'])) ? $_GET['mealType'] : NULL;
        $filters['diet'] = (isset($_GET['diet'])) ? $_GET['diet'] : NULL;
        $filters['total time'] = (isset($_GET['totalTime'])) ? (integer) $_GET['totalTime'] : NULL;
        $filters['difficulty'] = (isset($_GET['difficulty'])) ? $_GET['difficulty'] : NULL;
        $filters['search'] = (isset($_GET['search'])) ? $_GET['search'] : NULL;
        return $filters;
    }

    
    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1(){
        switch ($this->pageID) {
            case "viewRecipes":
                $this->panelHead_1='<h3>Results</h3>';
                break;
            
            case "myFavourites":
                $this->panelHead_1='<h3>My Favourites</h3>';
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
            case "viewRecipes":
            case "myFavourites":
                
                $recipeTable = new RecipeTable($this->db);
                $mealTypes = $recipeTable->getAllMealTypes();
                $dietTable = new DietTable($this->db);
                $rs = $dietTable->getAllRecords();
                $diets = $rs->fetch_all(MYSQLI_ASSOC);

                $this->panelContent_1 = Form::form_recipe_controls($this->pageID, $mealTypes, $diets);
                
                if (isset($_GET['btnFilterResults']) || isset($_GET['search'])) {
                    $filters = $this->getFilters();
                    $this->panelContent_1.= HelperHTML::generateFilterList($filters);
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
        $recipeTable = new RecipeTable($this->db);
        switch ($this->pageID) {
            case "viewRecipes":     
                
                if (isset($_GET['btnFilterResults']) || isset($_GET['search'])) {
                    $filters = $this->getFilters();
                    $recipes = $recipeTable->getFilteredRecordsPage($filters['meal type'], $filters['diet'], $filters['total time'], $filters['difficulty'], $filters['search'], null, null);
                    $totalPages = $recipeTable->getFilteredPagesCount($filters['meal type'], $filters['diet'], $filters['total time'], $filters['difficulty'], $filters['search'], null, null);
                }
                else {
                    $recipes = $recipeTable->getRecordsPage();
                    $totalPages = $recipeTable->getPagesCount();
                }
                
                break;
                
            case "myFavourites":
                
                $userID = $this->user->getUserID();
                
                if (isset($_GET['btnFilterResults']) || isset($_GET['search'])) {
                    $filters = $this->getFilters();
                    $recipes = $recipeTable->getFilteredRecordsPage($filters['meal type'], $filters['diet'], $filters['total time'], $filters['difficulty'], $filters['search'], null, $userID);
                    $totalPages = $recipeTable->getFilteredPagesCount($filters['meal type'], $filters['diet'], $filters['total time'], $filters['difficulty'], $filters['search'], null, $userID);
                }
                else {
                    $recipes = $recipeTable->getFilteredRecordsPage(null, null, null, null, null, null, $userID);
                    $totalPages = $recipeTable->getFilteredPagesCount(null, null, null, null, null, null, $userID);
                }
                break;

            default:
                break;
        }
        $this->panelContent_2= HelperHTML::generateRecipeCardGrid($recipes,$_GET['page'] ?? 1,$totalPages); 

    }

    /**
     * Set the Panel 3 heading 
     */
    public function setPanelHead_3(){ 
        $this->panelHead_3='<h3>Panel 3</h3>'; 
    } 
    
    /**
    * Set the Panel 3 text content 
    */ 
    public function setPanelContent_3(){
        $this->panelContent_3= "Panel 3 content for <b>$this->pageHeading</b> menu item is under construction.";
    }        

        
        
}
        