<?php
/**
* This file contains the AdminController Class
* 
*/


/**
 * Controller for logged in - ADMIN user type
 *
 * @author Conor Hanrahan
 * 
 */
class AdminController extends Controller  {


    /**
     * Constructor Method
     * 
     * The constructor for the Controller class. The Controller class is the parent class for all Controllers.
     * 
     * @param User $user  The current user
     * @param MySQLi  $db The database connection object
     * @param String  $pageTitle The web page title 
     */  
    function __construct($user,$db, $pageTitle) { 
        $this->controllerType='Administrator';
        parent::__construct($user,$db, $pageTitle);
    }


    /**
     * Method to update the selected view depending on the currently selected page ID. 
     * 
     * This method implements handlers for each page ID.  It loads the page content and navigation models 
     * as required by the page ID and prepares the $data content array to pass to the view. 
     * It selects and loads the required view. 
     * 
     */
    public function updateView() { //update the VIEW based on the users page selection
        if (isset($this->getArray['pageID'])) { //check if a page id is contained in the URL
            switch ($this->getArray['pageID']) {
                  
                case "logout":                    
                    //Change the login state to false
                    $this->user->logout();
                    $this->userLoggedIn=FALSE;
                    
                    //create objects to generate view content
                    $contentModel = new GeneralHome($this->user,$this->db, $this->postArray ,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->getArray['pageID']);
                    $navigationModel = new NavigationGeneral($this->user, 'home');
                    array_push($this->controllerObjects,$navigationModel,$contentModel);
                    $data = $this->getPageContent($contentModel,$navigationModel);  //get the page content from the models                 
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purpose
                    //update the view
                    include_once 'views/view_navbar_2_panel_8_4.php'; //load the view                  
                    break;   
                
                //manage users handlers               
                case "manageUsers":
                    //create objects to generate view content ($loggedin,$pageTitle,$pageHead,$database,$pageID)
                    $contentModel = new AdminManageUsers($this->user,$this->db, $this->postArray ,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->getArray['pageID']);
                    $navigationModel = new NavigationAdmin($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$navigationModel,$contentModel);
                    $data = $this->getPageContent($contentModel,$navigationModel);  //get the page content from the models                 
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purpose
                    //update the view
                    include_once 'views/view_navbar_2_panel_8_4.php';  //load the view                      
                    break;
                
                case "viewUser":
                    //create objects to generate view content ($loggedin,$pageTitle,$pageHead,$database,$pageID)
                    $contentModel = new ViewUser($this->user,$this->db, $this->postArray ,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->getArray['pageID']);
                    $navigationModel = new NavigationAdmin($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$navigationModel,$contentModel);
                    $data = $this->getPageContent($contentModel,$navigationModel);  //get the page content from the models                 
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purpose
                    //update the view
                    include_once 'views/view_navbar_3_panel_stacked_user_profile.php';  //load the view                      
                    break;
                
                case "myProfile":
                    //create objects to generate view content ($loggedin,$pageTitle,$pageHead,$database,$pageID)
                    $contentModel = new ViewUser($this->user,$this->db, $this->postArray ,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->getArray['pageID']);
                    $navigationModel = new NavigationAdmin($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$navigationModel,$contentModel);
                    $data = $this->getPageContent($contentModel,$navigationModel);  //get the page content from the models                 
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purpose
                    //update the view
                    include_once 'views/view_navbar_3_panel_stacked_user_profile.php';  //load the view  
                    break;
             
                case "addRecipe":
                    //create objects to generate view content
                    $contentModel = new ManageRecipe($this->user,$this->db, $this->postArray ,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->getArray['pageID']);
                    $navigationModel = new NavigationAdmin($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$navigationModel,$contentModel);
                    $data = $this->getPageContent($contentModel,$navigationModel);  //get the page content from the models                 
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purpose
                    //update the view
                    include_once 'views/view_navbar_3_panel_6_3_3.php';  //load the view                      
                    break;
                
                case "editRecipe":
                    //create objects to generate view content
                    $contentModel = new ManageRecipe($this->user,$this->db, $this->postArray ,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->getArray['pageID']);
                    $navigationModel = new NavigationAdmin($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$navigationModel,$contentModel);
                    $data = $this->getPageContent($contentModel,$navigationModel);  //get the page content from the models                 
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purpose
                    //update the view
                    include_once 'views/view_navbar_3_panel_6_3_3.php';  //load the view                      
                    break;
                
                case "viewRecipes":
                case "myFavourites":
                    //create objects to generate view content
                    $contentModel = new ViewRecipe($this->user,$this->db, $this->postArray ,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->getArray['pageID']);
                    $navigationModel = new NavigationAdmin($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$navigationModel,$contentModel);
                    $data = $this->getPageContent($contentModel,$navigationModel);  //get the page content from the models                 
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purpose
                    //update the view
                    include_once 'views/view_navbar_2_panel_stacked_recipes.php';  //load the view                      
                    break; 

                case "recipeDetails":
                    //create objects to generate view content
                    $contentModel = new AdminRecipeDetails($this->user,$this->db, $this->postArray ,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->getArray['pageID']);
                    $navigationModel = new NavigationAdmin($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$navigationModel,$contentModel);
                    $data = $this->getPageContent($contentModel,$navigationModel);  //get the page content from the models                 
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purpose
                    //update the view
                    include_once 'views/view_navbar_3_panel_stacked_recipe_details.php';  //load the view                      
                    break;    
                
                
                default:
                    //no valid $pageID selected by user - default loads HOME page
                    //create objects to generate view content
                    $contentModel = new AdminHome($this->user,$this->db, $this->postArray ,$this->pageTitle, 'HOME','home');
                    $navigationModel = new NavigationAdmin($this->user, 'home');
                    array_push($this->controllerObjects,$navigationModel,$contentModel);
                    $data = $this->getPageContent($contentModel,$navigationModel);  //get the page content from the models                 
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purpose
                    //update the view
                    include_once 'views/view_navbar_3_panel.php';
                    break;
            }
        } 
        else {//no page selected and NO page ID passed in the URL 
            //no page selected - default loads HOME page (profile for logged in users)
            //create objects to generate view content
            $contentModel = new ViewUser($this->user,$this->db, $this->postArray ,$this->pageTitle, 'MYPROFILE','myProfile');
            $navigationModel = new NavigationAdmin($this->user, 'myProfile');
            array_push($this->controllerObjects,$navigationModel,$contentModel);
            $data = $this->getPageContent($contentModel,$navigationModel);  //get the page content from the models                 
            $this->viewData = $data;  //put the content array into a class property for diagnostic purpose
            //update the view
            include_once 'views/view_navbar_3_panel_stacked_user_profile.php';  //load the view
        }
    }       
     
}


