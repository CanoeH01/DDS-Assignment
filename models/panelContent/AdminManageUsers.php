<?php
/**
* This file contains the AdminManageUsers Class
* 
*/


/**
 * AdminManageUsers is an extended PanelModel Class
 * 
 * 
 * The purpose of this class is to generate HTML view panel headings and template content
 * for an <em><b>ADMINISTRATOR user - user management</b></em> page.  The content generated is intended for 2 panel
 * view layouts. 
 * 
 * @author Conor Hanrahan
 * 
 */
class AdminManageUsers extends PanelModel{

  
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
    */    
    function __construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID){  
        $this->modelType='ManageUsers';
        parent::__construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID);
    } 

    /**
     * Set the Panel 1 heading 
     */    
    public function setPanelHead_1(){
         
        switch ($this->pageID) {
            case "manageUsers":
                $this->panelHead_1='<h3>Users</h3>';  
                break;            
            default:
                $this->panelHead_1='<h3>Manage Users</h3>';  
                break;
            }//end switch     
        
    }

    /**
    * Set the Panel 1 text content 
    */ 
    public function setPanelContent_1(){           
        switch ($this->pageID) {
            case "manageUsers":
                $userTable=new UserTable($this->db);
                $rs=$userTable->getAllRecords();    
                if ($rs){                   
                    $this->panelContent_1=HelperHTML::generateUserSelectTABLE($rs, 'email', $this->pageID, 'Edit');
                    $this->panelContent_1.= Form::form_single_button('Create Account', 'btnAddAccount',$this->pageID, 'Add');                        
                }
                else{
                    $this->panelContent_1="No users data available ";
                } 
                break;
                
            default:
                $this->panelContent_1="Use the links provided to manage users ";  
                break;
            }//end switch                       
    }       

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2(){ 
        
        switch ($this->pageID) {
            case "manageUsers":
                if(isset($this->postArray['btnRecordSelected'])){
                    $email=strtolower($this->postArray['recordSelected']);
                    $this->panelHead_2="<h3>Manage $email </h3>";
                }
                elseif(isset($this->postArray['btnAddAccount'])){
                    $this->panelHead_2="<h3>Add New Account</h3>";
                }
                elseif(isset($this->postArray['btnDeleteAccount'])) {
                    $this->panelHead_2="<h3>Alert</h3>";
                }
                else 
                    $this->panelHead_2="<h3>Manage Users</h3>";
                break;
         
            default:
                $this->panelHead_2='<h3>Manage Users</h3>';  
                break;
            }//end switch    
    }     
    

    /**
    * Set the Panel 1 text content 
    */ 
    public function setPanelContent_2(){
        
        switch ($this->pageID) {
            case "manageUsers":
                
                if(isset($this->postArray['btnAddAccount'])){
                    $userTable=new UserTable($this->db);
                    $this->panelContent_2 .= Form::form_register($userTable,$this->pageID);
                }
                elseif(isset($this->postArray['btnRegister'])){   //check if the user register button is pressed             
                    $this->panelContent_2 = $this->doRegisterUser();
                }
                elseif(isset($this->postArray['btnDeleteAccount'])) {
                    $this->panelContent_2 = Form::form_confirm($this->pageID, 'Confirm Record Deletion',$this->postArray['email']); //ask user to confirm or cancel
                }
                elseif(isset($this->postArray['btnConfirm'])){
                    $this->panelContent_2 = $this->doConfirmDeletion();
                }
                elseif(isset($this->postArray['btnRecordSelected'])){                     
                    $this->panelContent_2 =$this->doEditUser();
                }
                elseif(isset($this->postArray['btnUpdateAccount'])){ 
                    $this->panelContent_2 = $this->doUpdateRecord();
                }                       
                elseif(isset($this->postArray['btnDeleteAccount'])) {
                    $this->panelContent_2.=Form::form_confirm($this->pageID, 'Confirm Record Deletion',$this->postArray['email']); //ask user to confirm or cancel
                }
                else {
                    $this->panelContent_2="Use the links provided to manage users ";
                }
               
                break;
                
            default:
                $this->panelContent_2="Use the links provided to manage users ";  
                break;
            }//end switch    
    } 

    /**
     * Set the Panel 3 heading 
     */
    public function setPanelHead_3(){} 
    
    
    /**
    * Set the Panel 3 text content 
    */ 
    public function setPanelContent_3(){}      
    
    
    private function doRegisterUser(){
        if($this->postArray['pass1']===$this->postArray['pass1']){//check 2 passwords entered match                 
            $userTable=new UserTable($this->db);
            if($userTable->addRecord($this->postArray, ENCRYPT_PW)){ //try to add new record
                $resultMsg='Registration Processed Successfully'; 
            }
            else{ //unable to add new record - may already exist
                $resultMsg='Unable to Add new user - check details - user may already be registered';
            }
        }
        else{//passwords do not match
            $resultMsg='Passwords must match exactly - please re-enter form details';
        }
        
        return $resultMsg;
    } 
    
    
    private function doConfirmDeletion(){
        $userTable=new UserTable($this->db);
        if($userTable->deleteRecordbyEmail($this->postArray['btnConfirm'])){  
            $resultMsg='User record deleted';  //record successfully deleted
        }
        else{
            $resultMsg='Unable to delete user record'; //Unable to delete user record - there may be some dependencies
        }
        
        return $resultMsg;
    }
   
    
    private function doEditUser(){
        $email=strtolower($this->postArray['recordSelected']);
        $userTable=new UserTable($this->db);
        $userRecord=$userTable->getRecordByEmail($email);

        if($userRecord){  //record found - generate an edit form
            $resultMsg=Form::form_administrator_edit_account($userTable, $userRecord, $this->pageID);
        }
        else{ //no record for this ID
            $resultMsg='No record found with the following email : '.$email;
        }
        
        return $resultMsg;
    }
    
    
    private function doUpdateRecord() {
        $userTable=new UserTable($this->db);
        if($userTable->updateRecord($this->postArray)){
             $resultMsg='Updated user account successfully';
        }
        else{
             $resultMsg='Unable to update user account';
        }
        
        return $resultMsg;
    }
}
        