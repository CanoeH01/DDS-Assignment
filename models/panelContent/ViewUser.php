<?php
/**
* This file contains the ViewUser Class
* 
*/


/**
 * ViewUser is an extended PanelModel Class
 * 
 * The purpose of this class is to generate HTML view panel headings and template content
 * for a <em><b>User Profile</b></em>  page.  The content generated is intended for 3 panel
 * view layouts. 
 *   
 *
 * @author conor.hanrahan
 * 
 */
class ViewUser extends PanelModel {
  
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
        $this->modelType='ManageSystem';
        parent::__construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID);
    } 
    

    
    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1(){
        switch ($this->pageID) {
            case "viewUser":
                $this->panelHead_1='<h3>Profile</h3>'; 
                break;
            case "myProfile":
                $this->panelHead_1='<h3>My Profile</h3>';
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
            case 'viewUser':
                if ($this->user->getUserID() === $_GET['id']) {
                    header("Location: index.php?pageID=myProfile");
                    exit;
                }
                else {
                    $userTable = new UserTable($this->db);
                    $userRecord = $userTable->getRecordByID($_GET['id']);
                    $userProfile = $userRecord->fetch_assoc();
                    $this->panelContent_1=HelperHTML::generateUserProfileCard($userProfile, $this->pageID);
                }
;
                break;
            
            case 'myProfile':
                $userTable = new UserTable($this->db);
                $userRecord = $userTable->getRecordByID($this->user->getUserID());
                
                if (isset($this->postArray['btnEditProfile'])) {
                    $this->panelContent_1=Form::form_edit_account($userRecord, $this->pageID);
                }
                elseif (isset($this->postArray['btnChangePassword'])) {
                    $this->panelContent_1=Form::form_password_change($this->pageID);
                }
                elseif (isset($this->postArray['btnUpdateAccount'])){
                    if ($userTable->updateRecord($this->postArray)) {
                        header("Location: index.php?pageID=myProfile");
                    }
                    else {
                        $this->panelContent_1='<strong>Something went wrong while updating account<strong>';
                    }
                }
                elseif (isset($this->postArray['btnChangePW'])) {
                    if ($userTable->changePassword($this->postArray, $this->user)) {
                        $userProfile = $userRecord->fetch_assoc();
                        $this->panelContent_1='<strong style="padding-left: 1.4em;">Password successfully updated</strong>';
                        $this->panelContent_1.=HelperHTML::generateUserProfileCard($userProfile, $this->pageID, true); 
                    }
                    else {
                        $userProfile = $userRecord->fetch_assoc();
                        $this->panelContent_1='<strong style="padding-left: 1.4em;">Password could not be updated, please ensure passwords match</strong>';
                        $this->panelContent_1.=HelperHTML::generateUserProfileCard($userProfile, $this->pageID, true); 
                    }
                }
                elseif (isset($this->postArray['btnDeleteAccount'])) {
                    $this->panelContent_1= Form::form_confirm($this->pageID, "Confirm Deletion", "delete");
                }
                elseif (isset($this->postArray['btnConfirm'])) {
                    $email = $this->user->getEmail();
                    if ($userTable->deleteRecordbyEmail($email)) {
                        $this->user->logout(); 
                    }
                    else {
                        $this->panelContent_1.="<strong>Could not delete account</strong>";
                    }
                }                
                else {
                    $userProfile = $userRecord->fetch_assoc();
                    $this->panelContent_1=HelperHTML::generateUserProfileCard($userProfile, $this->pageID, true);                    
                }
                

                break;
        }

    }        

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2(){ 
        switch ($this->pageID) {
            case 'viewUser':
                $this->panelHead_2='<h3>Recipes Created</h3>'; 
                break;
            
            case 'myProfile':
                $this->panelHead_2='<h3>My Recipes</h3>'; ;
                break;
        }
    }  
    
    /**
    * Set the Panel 2 text content 
    */ 
    public function setPanelContent_2(){
        $recipeTable = new RecipeTable($this->db);;
        
        switch ($this->pageID) {
            case 'viewUser':
                $userID = $_GET['id'];
                break;
            
            case 'myProfile':
                $userID = $this->user->getUserID();
                break;
            
            default:
                
                break;
        }

        $recipes = $recipeTable->getFilteredRecordsPage(null, null, null, null, null, $userID, null);
        $totalPages = $recipeTable->getFilteredPagesCount(null, null, null, null, null, $userID, null);
        $this->panelContent_2= HelperHTML::generateRecipeCardGrid($recipes, $_GET['page'] ?? 1, $totalPages);
    }

    /**
     * Set the Panel 3 heading 
     */
    public function setPanelHead_3(){ 
        switch ($this->pageID) {
            case 'viewUser':
                $this->panelHead_3='<h3>Reviews</h3>'; 
                break;
            
            case 'myProfile':
                $this->panelHead_3='<h3>My Reviews</h3>'; ;
                break;
        }
    } 
    
    /**
    * Set the Panel 3 text content 
    */ 
    public function setPanelContent_3(){
        $recipeReviewTable = new RecipeReviewTable($this->db);;
        
        switch ($this->pageID) {
            case 'viewUser':
                $userID = $_GET['id'];
                $isDeletable = false;
                break;
            
            case 'myProfile':
                $userID = $this->user->getUserID();
                $isDeletable = true;
                break;
            
            default:
                break;
        }
        
        if (isset($this->postArray['btnDeleteReview'])) {
            $this->panelContent_3 = Form::form_confirm_review($this->pageID, "Confirm Deletion", $this->postArray['btnDeleteReview']);
        }
        elseif (isset($this->postArray['btnConfirmReview'])) {
            if ($recipeReviewTable->deleteRecordByReviewerIDRecipeID($userID, $this->postArray['btnConfirmReview'])) {
                $this->panelContent_3 = "<strong>Review successfully deleted</strong>";
            }
            else {
                $this->panelContent_3 = "<strong>could not delete review</strong>";
            }
        }
        
        $reviews = $recipeReviewTable->getRecordsPageByReviewerID($userID);
        $totalPages = $recipeReviewTable->getPagesCountByReviewerID($userID);
        $this->panelContent_3 .= HelperHTML::generateReviewListUserProfile($reviews, $_GET['pageReview'] ?? 1, $totalPages, $this->pageID, $isDeletable);
        
    }        

        
        
}
        