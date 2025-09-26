<?php
/**
* This file contains the AdminManageSystem Class
* 
*/


/**
 * ManageRecipe is an extended PanelModel Class
 * 
 * The purpose of this class is to generate HTML view panel headings and template content
 * for a <em><b>RECIPE system management</b></em>  page.  The content generated is intended for 3 panel
 * view layouts. 
 * 
 * @author conor.hanrahan
 * 
 */
class ManageRecipe extends PanelModel {
   
    
    /**
     * Constructor Method
     * 
     * This is the constructor for the ManageRecipe class. The ManageSystems class provides the 
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
        $this->modelType='AdminManageSystem';
        parent::__construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID);

    } 

    /**
     * Set the Panel 1 heading
     */
    public function setPanelHead_1(){//set the panel 1 heading
        switch ($this->pageID) {
            case "addRecipe":
                $this->panelHead_1='<h3 style="margin: 0.5em 0 0 0;">Create Recipe</h3>'; 
                break;
            case "editRecipe":
                $this->panelHead_1='<h3 style="margin: 0.5em 0 0 0;">Edit Recipe</h3>';
                break;
        }
    }//end METHOD - //set the panel 1 heading
    
    /**
     * Set the Panel 1 text content
     */
    public function setPanelContent_1(){//set the panel 1 content

        $session = new Session();
        switch ($this->pageID) {
            case "addRecipe":               
                $recipeTable = new RecipeTable($this->db);
                $mealTypes = $recipeTable->getAllMealTypes();
                               
                if (isset($this->postArray['btnCreateRecipe'])) {
                    $imageName = $this->cropImageUpload();
                    $success = false;
                    
                    if ($recipeTable->addRecord($this->postArray, $imageName)) {
                        $creatorID = $session->getUserID();
                        $recipeID = $recipeTable->getIDByNameAndCreator($this->postArray['name'], $creatorID);
                        $recipeID = $recipeID->fetch_row()[0];
                        
                        if (isset($this->postArray['diets'])) {
                            $diets = $this->postArray['diets'];
                        }
                        else {
                            $diets = null;
                        }

                        $recipeDietsTable = new RecipeDietsTable($this->db);
                        
                        if ($recipeDietsTable->addAllRecipeDiets($recipeID, $diets)) {
                            $ingredients = $session->getRecipeIngredients();                            
                            $recipeIngredientTable = new RecipeIngredientTable($this->db);
                            
                            if ($recipeIngredientTable->addAllIngredientsRecord($ingredients, $recipeID)) {
                                $steps = $session->getRecipeSteps();
                                $recipeStepTable = new RecipeStepTable($this->db);
                                
                                if ($recipeStepTable->addAllStepsRecord($steps, $recipeID)) {
                                    $success = true;
                                }
                            }
                        }
                    }
                    
                    if ($success) {
                        $this->panelContent_1.='<strong style="padding-bottom: 3em;">Recipe Added Successfully</strong><br>';
                        $session->setRecipeIngredients([]);
                        $session->setRecipeSteps([]);
                        $this->setPanelContent_2();
                        $this->setPanelContent_3();
                    }
                    else {
                        $this->panelContent_1.='<strong style="padding-bottom: 3em;">Recipe could not be added</strong><br>';
                        $recipeTable->deleteRecordByID($recipeID);
                    }
                }
                $this->panelContent_1.= Form::form_create_recipe($mealTypes, $this->pageID);
                break;
                
                
            case "editRecipe":
                $recipeTable = new RecipeTable($this->db);
                $recipeToEdit = $recipeTable->getRecordByID($_GET['id']);
                $recipeToEdit = $recipeToEdit->fetch_assoc();
                $mealTypes = $recipeTable->getAllMealTypes();
                
               
                               
                if (isset($this->postArray['btnEditRecipe'])) {
                    $imageName = $this->cropImageUpload();
                    if ($imageName == 'recipe_default.jpg') {
                        $imageName = null;
                    }
                    
                    $success = false;
                    if ($recipeTable->updateRecord($this->postArray, $imageName)) {;
                        $creatorID = $this->postArray['creatorID'];
                        $recipeID = $recipeTable->getIDByNameAndCreator($this->postArray['name'], $creatorID);
                        $recipeID = $recipeID->fetch_row()[0];
                        
                        if (isset($this->postArray['diets'])) {
                            $diets = $this->postArray['diets'];
                        }
                        else {
                            $diets = null;
                        }

                        $recipeDietsTable = new RecipeDietsTable($this->db);
                        
                        if ($recipeDietsTable->updateAllRecipeDiets($recipeID, $diets)) {
                            $ingredients = $session->getRecipeIngredients();                            
                            $recipeIngredientTable = new RecipeIngredientTable($this->db);
                            
                            if ($recipeIngredientTable->updateAllIngredientsRecord($ingredients, $recipeID)) {
                                $steps = $session->getRecipeSteps();
                                $recipeStepTable = new RecipeStepTable($this->db);
                                
                                if ($recipeStepTable->updateAllStepsRecord($steps, $recipeID)) {
                                    $success = true;
                                }
                            }
                        }
                    }
                    
                    if ($success) {
                        $this->panelContent_1.='<br><strong>Recipe Edited Successfully</strong>';
                        $session->setRecipeIngredients([]);
                        $session->setRecipeSteps([]);
                        $this->setPanelContent_2();
                        $this->setPanelContent_3();
                    }
                    else {
                        $this->panelContent_1.='<br><strong>Something went wrong while editing recipe<strong>';
                    }
                }
                $this->panelContent_1.= Form::form_edit_recipe($mealTypes, $this->pageID, $recipeToEdit);
                break;
        }
    }//end METHOD - //set the panel 1 content        

    
    /**
     * Set the Panel 2 heading
     */
    public function setPanelHead_2(){ //set the panel 2 heading   
        switch ($this->pageID) {
            case "addRecipe":
            case "editRecipe":    
                $this->panelHead_2='<h3>Ingredients</h3>';  
                break;
        }
    }//end METHOD - //set the panel 2 heading   
    
    /**
     * Set the Panel 2 text content
     */
    public function setPanelContent_2(){//set the panel 2 content
        switch ($this->pageID) {
            case "addRecipe":
                
                $session = new Session();
                if (!isset($_GET['id'])) {
                    $session->setRecipeIngredients([]);
                    $session->setRecipeSteps([]);
                }
                
                $ingredients = $session->getRecipeIngredients();
                
                $ingredientTable = new IngredientTable($this->db);
                $ingredientsList = $ingredientTable->getAllRecords();
                
                $recipeTable = new RecipeTable($this->db);
                $unitTypes = $recipeTable->getAllUnitTypes();
                
                
                if (isset($this->postArray['btnAddIngredient'])) {
                    if (!empty($this->postArray['ingredient']) && !empty($this->postArray['quantity'])) {
                        $ingredients[$this->postArray['ingredient']] = [$this->postArray['isEssential'],$this->postArray['quantity'], $this->postArray['unit']];
                    }
                }
                elseif (isset($this->postArray['btnRemoveIngredient'])) {
                    array_pop($ingredients);
                }
                elseif (isset($this->postArray['btnClear'])) {
                    $ingredients = [];
                }
                $session->setRecipeIngredients($ingredients);
                
                $this->panelContent_2= HelperHTML::generateVerticalIngredientRecordTable($ingredients);
                $this->panelContent_2.= Form::form_add_recipe_ingredient($ingredientsList,$unitTypes, $this->pageID);
                break;
                
                
            case "editRecipe":
                $session = new Session();
                $recipeIngredientsTable = new RecipeIngredientTable($this->db);
                $ingredients = $recipeIngredientsTable->getIngredientsByRecipeID($_GET['id']);
                
                if ($session->getRecipeIngredients() === []) {
                    $ingredientsArray = array();
                    while ($row = $ingredients->fetch_assoc()) {
                        $ingredientsArray[$row['name']] = [ 0=> $row['essential'], 1=> $row['quantity'],  2=> $row['unit']]; 
                    }

                    $session->setRecipeIngredients($ingredientsArray);
                }
                else {
                    $ingredientsArray = $session->getRecipeIngredients();
                }
               
                $ingredientTable = new IngredientTable($this->db);
                $ingredientsList = $ingredientTable->getAllRecords();
                
                $recipeTable = new RecipeTable($this->db);
                $unitTypes = $recipeTable->getAllUnitTypes();
                
                
                if (isset($this->postArray['btnAddIngredient'])) {
                    if (!empty($this->postArray['ingredient']) && !empty($this->postArray['quantity'])) {
                        $ingredientsArray[$this->postArray['ingredient']] = [$this->postArray['isEssential'],$this->postArray['quantity'], $this->postArray['unit']];
                    }
                }
                elseif (isset($this->postArray['btnRemoveIngredient'])) {
                    array_pop($ingredientsArray);
                }
                elseif (isset($this->postArray['btnClear'])) {
                    $ingredientsArray = [];
                }
                
                $session->setRecipeIngredients($ingredientsArray);
                
                $this->panelContent_2= HelperHTML::generateVerticalIngredientRecordTable($ingredientsArray);
                $this->panelContent_2.= Form::form_add_recipe_ingredient($ingredientsList,$unitTypes, $this->pageID);
                break;
        }
    }//end METHOD - //set the panel 2 content  


    /**
     * Set the Panel 3 heading
     */
    public function setPanelHead_3(){ //set the panel 3 heading  
            $this->panelHead_3='<h3>Steps</h3>'; 
    } //end METHOD - //set the panel 3 heading
    
    /**
     * Set the Panel 3 text content
     */
    public function setPanelContent_3(){ //set the panel 2 content{        
        switch ($this->pageID) {
            case "addRecipe":
                $session = new Session();
                $steps = $session->getRecipeSteps();

                if (isset($this->postArray['btnAddStep'])) {
                    if (!empty($this->postArray['step'])) {
                        array_push($steps, $this->postArray['step']);
                    }
                }
                elseif (isset($this->postArray['btnRemoveStep'])) {
                    array_pop($steps);
                }
                elseif(isset($this->postArray['btnClear'])) {
                    $steps = [];
                }
                $session->setRecipeSteps($steps);
                
                $this->panelContent_3= HelperHTML::generateVerticalIndexedRecordTable($steps);
                $this->panelContent_3.= Form::form_add_recipe_step($this->pageID);
                break;
                
            case "editRecipe":
                $session = new Session();
                
                if ($session->getRecipeSteps() === []) {
                    $stepsArray = array();
                    $recipeStepTable = new RecipeStepTable($this->db);
                    $stepsRecords = $recipeStepTable->getStepsByRecipeID($_GET['id']);
                    while ($row = $stepsRecords->fetch_row()) {
                        array_push($stepsArray, $row[0]);
                    }
                    $session->setRecipeSteps($stepsArray);
                }
                else{
                    $stepsArray = $session->getRecipeSteps();
                }

                if (isset($this->postArray['btnAddStep'])) {
                    if (!empty($this->postArray['step'])) {
                        array_push($stepsArray, $this->postArray['step']);
                    }
                }
                elseif (isset($this->postArray['btnRemoveStep'])) {
                    array_pop($stepsArray);
                }
                elseif(isset($this->postArray['btnClear'])) {
                    $stepsArray = [];
                }
                $session->setRecipeSteps($stepsArray);
                
                $this->panelContent_3= HelperHTML::generateVerticalIndexedRecordTable($stepsArray);
                $this->panelContent_3.= Form::form_add_recipe_step($this->pageID);
                break;
        }
    }  //end METHOD - //set the panel 3 content 
    
    
    public function cropImageUpload() {
                            
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === 0) {
            $uploadPath = 'assets/images/uploads/';
            $tempName = $_FILES['thumbnail']['tmp_name'];
            $ext = strtolower(pathinfo(basename($_FILES['thumbnail']['name']), PATHINFO_EXTENSION));
            $imageName = uniqid('recipe_').'.jpg';
            $fullPath = $uploadPath . $imageName;

            switch ($ext) {
                case 'jpg':
                case 'jpeg':
                    $source = imagecreatefromjpeg($tempName);
                    break;
                case 'png':
                    $source = imagecreatefrompng($tempName);
                    break;
                case 'webp':
                    $source = imagecreatefromwebp($tempName);
                    break;
                default:
                    $source = false;
                    break;
            }

            if ($source) {
                $width = imagesx($source);
                $height = imagesy($source);
                $cropSize = min($width, $height);
                
                $x = ($width - $cropSize) / 2;
                $y = ($height - $cropSize) / 2;
                
                $cropRectangle = [
                    'x' => $x,
                    'y' => $y,
                    'width' => $cropSize,
                    'height' => $cropSize 
                ];
                
                $croppedImage = imagecrop($source, $cropRectangle);
                imagejpeg($croppedImage, $fullPath, 70);
                imagedestroy($croppedImage);
            }
            else {
                $imageName = 'recipe_default.jpg';
            }
            
            imagedestroy($source);
            return $imageName;
        }
        else {
            return 'recipe_default.jpg';
        }
    }

       
}//end class
        