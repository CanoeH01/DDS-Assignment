<?php
/**
* This file contains the Form Class
* 
*/

/**
 * 
 * Form class - is a helper class that generates HTML forms  
 * 
 *  
 * @author Gerry Guinane
 * 
 */

class Form {


    /**
     * Generates a HTML user select form 
     * 
     * @param string $pageID The pageID of the page which will be used to process the login form. 
     * @return string String containing the generated form.
     */    
    public static function form_select_user($pageID){
            $form='<form method="post" action="index.php?pageID='.$pageID.'">';
            $form.='<div class="form-group">';
            $form.='<label for="userID">Email</label><input required type="text" class="form-control" id="userID" name="userID" >';
            $form.='</div> ';
            $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnUserSelect">Select</button>';
            $form.='</form>';
            return $form;
    }    


    /**
     * Generates a HTML login form 
     * 
     * @param string $pageID The pageID of the page which will be used to process the login form. 
     * @return string String containing the generated form.
     */    
    public static function form_login($pageID){
            $form='<form method="post" action="index.php?pageID='.$pageID.'">';
            $form.='<div class="form-group">';
            $form.='<label for="email">Email</label><input required type="text" class="form-control" id="email" name="email" >';
            $form.='<label for="password">Password</label><input required type="password" class="form-control" id="password" name="password" >';
            $form.='</div> ';
            $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnLogin">Login</button>';
            $form.='</form>';
            return $form;
    }

    
    public static function form_single_button($buttonText, $buttonName, $pageID, $buttonValue = 1){
        $form='<form action="index.php?pageID='. $pageID.'" method="post">';
        $form.='<button type="submit" class="btn btn-default" value="'.$buttonValue.'" name="'.$buttonName.'">'.$buttonText.'</button>';
        $form.='</form>';
        
        return $form;
    }
    
    
    public static function form_recipe_controls($pageID, $mealTypes, $diets){
        $form='<form action="index.php?pageID='. $pageID.'" method="get">';
        $form.='<div class="row">';
        $form .= '<input type="hidden" name="search" value="' . htmlspecialchars($_GET['search'] ?? '') . '">';
        $form.='<div class="col-sm-3"><select class="form-control" id="mealType" name="mealType">';
        $form.= '<option value="" disabled selected hidden>Meal Type</option>';
        foreach($mealTypes as $key=>$value){
            $form.= '<option value="'.$value.'"'.(($_GET['mealType'] ?? '') == $value ? ' selected' : '').'>'.$value.'</option>';
  
        }
        $form.='</select></div>';
        
        $form.='<div class="col-sm-3"><select class="form-control" id="diet" name="diet">';
        $form.= '<option value="" disabled selected hidden>Diets</option>';
        foreach($diets as $diet){
            $dietID = (integer)$diet['dietID'];
            $dietType = htmlspecialchars($diet['dietType']);
            $form.= '<option value="'.$dietType.'" '.(($_GET['diet'] ?? '') == $dietType ? ' selected' : '').'>'.$dietType.'</option>';  
        }
        $form.='</select></div>';
        
        $form.='<div class="col-sm-3"><select class="form-control" id="totalTime" name="totalTime">';
        $form.= '<option value="" disabled selected hidden>Total time</option>';
        $form.= '<option value="15" '.(($_GET['totalTime'] ?? '') == 15 ? ' selected' : '').'>Under 15 minutes</option>';
        $form.= '<option value="30" '.(($_GET['totalTime'] ?? '') == 30 ? ' selected' : '').'>Under 30 minutes</option>';
        $form.= '<option value="45" '.(($_GET['totalTime'] ?? '') == 45 ? ' selected' : '').'>Under 45 minutes</option>';
        $form.= '<option value="60" '.(($_GET['totalTime'] ?? '') == 60 ? ' selected' : '').'>Under 1 hour</option>';
        $form.='</select></div>';
        
        $form.='<div class="col-sm-3"><select class="form-control" id="difficulty" name="difficulty">';
        $form.= '<option value="" disabled selected hidden>Difficulty</option>';
        $form.= '<option value="Very Easy" '.(($_GET['difficulty'] ?? '') == 'Very Easy' ? ' selected' : '').'>Very Easy</option>';
        $form.= '<option value="Easy" '.(($_GET['difficulty'] ?? '') == 'Easy' ? ' selected' : '').'>Easy</option>';
        $form.= '<option value="Medium" '.(($_GET['difficulty'] ?? '') == 'Medium' ? ' selected' : '').'>Medium</option>';
        $form.= '<option value="Hard" '.(($_GET['difficulty'] ?? '') == 'Hard' ? ' selected' : '').'>Hard</option>';
        $form.= '<option value="Very Hard" '.(($_GET['difficulty'] ?? '') == 'Very Hard' ? ' selected' : '').'>Very Hard</option>';
        $form.='</select></div>';
        
        $form.='</div><div class="row" style="margin-top: 1em; margin-bottom: 1em;">';
        $form.='<input type="hidden" name="pageID" value="'.$pageID.'">';
        $form.='<div class="col-sm-3"><button type="submit" class="btn btn-default" value="filter" name="btnFilterResults">Filter</button>';
        $form.='<a href="index.php?pageID='.$pageID.'" class="btn btn-default" role="button">Clear</a></div>';
        $form.='</div>'
                . '</form>';
        
        return $form;
    }    

    
    /**
     * Generates a HTML password change form
     * 
     * @param string $pageID The pageID of the page which will be used to process the login form.
     * @return string String containing the generated form.
     */
    public static function form_password_change($pageID){
            $form='<form method="post" action="index.php?pageID='.$pageID.'">';
            $form.='<div class="form-group">';
            $form.='<label for="pass1">Enter New Password</label><input required type="password" class="form-control" id="pass1" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">';
            $form.='<label for="pass2">Re-enter New Password</label><input required type="password" class="form-control" id="pass2" name="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must match the above password exactly">';
            $form.='<label for="password">Enter OLD Password</label><input required type="password" class="form-control" id="password" name="password" >';
            $form.='</div> ';
            $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnChangePW">Change Password</button>';
            $form.='<button type="submit" class="btn btn-default" name="btnCancelUpdatePW" value="updatePWCancel" formnovalidate>Cancel</button>';
            $form.='</form>';
            return $form;
    } 

    
    /**
     * 
     * Generates a HTML form for editing account details. 
     * 
     * The form generated will display but does not permit editing of the users ID.  
     * 
     * @param mysqli_result $userRecord Resultset containing the current user details from the database  user table 
     * @param string $pageID The pageID of the page which will be used to process the login form.
     * @return string String containing the generated form.
     */
    public static function form_edit_account($userRecord, $pageID){
        $userRecordArray=$userRecord->fetch_assoc();
        extract($userRecordArray); //makes constructing the form a little easier

        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<div class="form-group">';

        $form.='<label for="firstName">First Name</label><input required type="text" class="form-control"  value="'.$firstName.'" id="firstName" name="firstName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="First Name (up to 45 Characters)">';
        $form.='<label for="lastName">Last Name</label><input required type="text" class="form-control"   value="'.$lastName.'" id="lastName" name="lastName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="Last Name (up to 45 Characters)" >';

        //hidden DEFAULT input values for user type and userID enabled
        $form.= '<input type="hidden" id="userType" name="userType" value="'.$userType.'">';
        $form.= '<input type="hidden" id="userID" name="userID" value="'.$userID.'">';

        $form.='<label for="email">Email (not editable)</label><input required readonly type="text" class="form-control" value="'.$email.'" id="email" name="email" pattern="[a-zA-Z0-9@.]{1,45}" title="enter a valid email" >';
        $form.='<label for="bio">Bio</label><textarea rows="4" cols="4" class="form-control" id="bio" name="bio" pattern="{1,255}">'.$bio.'</textarea>';
        $form.='<button type="submit" class="btn btn-link pull-right" name="btnChangePassword" value="update"><label for="btnChangePassword"><strong>Change Password</strong></label></button>';

        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" name="btnUpdateAccount" value="update">Update</button>';
        $form.='<button type="submit" class="btn btn-default" name="btnCancelUpdateAccount" value="cancel">Cancel</button>';
        $form.='<button type="submit" class="btn btn-default" name="btnDeleteAccount" value="delete">Delete Account</button>';
        $form.='</form>';

        return $form;
    }


    /**
     * 
     * Generates a HTML form for editing account details. 
     * 
     * The form generated will display but does not permit editing of the users ID.  
     * 
     * @param mysqli_result $userRecord Resultset containing the current user details from the database  user table 
     * @param string $pageID The pageID of the page which will be used to process the login form.
     * @return string String containing the generated form.
     */
    public static function form_administrator_edit_account($userTable, $userRecord, $pageID){
        $userTypeList = $userTable->getAllUserTypes();
        $userRecordArray=$userRecord->fetch_assoc();
        extract($userRecordArray); 

        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<div class="form-group">';
        $form.='<label for="userID">User ID (not editable)</label><input required readonly type="text" class="form-control"   value="'.$userID.'" id="userID" name="userID" >';
        $form.='<label for="firstName">First Name</label><input required type="text" class="form-control"  value="'.$firstName.'" id="firstName" name="firstName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="First Name (up to 45 Characters)">';
        $form.='<label for="lastName">Last Name</label><input required type="text" class="form-control"   value="'.$lastName.'" id="lastName" name="lastName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="Last Name (up to 45 Characters)" >';

        $form.='<label for="userTypeNr">Select Usertype</label>';
        $form.='<select class="form-control" id="userType" name="userType">';            
        foreach($userTypeList as $key=>$value){
            if ($value === $userType) {
                $form.= '<option value="'.$key.'" selected>'.$value.'</option>';
            }
            else {
                $form.= '<option value="'.$key.'">'.$value.'</option>';
            }
        }
        $form.='</select></div>';

        $form.='<label for="email">email (not editable)</label><input required readonly type="text" class="form-control" value="'.$email.'" id="email" name="email" pattern="[a-zA-Z0-9@.]{1,45}" title="enter a valid email" >';
        $form.='<label for="bio">bio</label><input type="text" class="form-control" value="'.$bio.'" id="bio" name="bio"" title="Personal Bio (up to 300 Characters)" >';

        $form.='<button type="submit" class="btn btn-default" name="btnUpdateAccount" value="update">Update Account</button>';
        $form.='<button type="submit" class="btn btn-default" name="btnDeleteAccount" value="update">Delete Account</button>';
        $form.='</div></form>';

        return $form;
    }


    /**
     * Generates a HTML form for registering a new  account.  It is intended for administrator use
     * 
     * The form generated will display a drop down list/chooser of counties and user types.  
     * 
     * 
     * @param string $pageID The pageID of the page which will be used to process the login form.
     * @return string String containing the generated form.
     */
    public static function form_register($userTable, $pageID){
        $userTypeList = $userTable->getAllUserTypes();

        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<div class="form-group">';
        $form.='<label for="firstName">First Name</label><input required type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="First Name (up to 45 Characters)">';
        $form.='<label for="lastName">Last Name</label><input required type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="Last Name (up to 45 Characters)" >';
        $form.='<label for="bio">Bio (optional)</label><input type="text" class="form-control"  id="bio" name="bio"" pattern="{0,300}" title="Personal Bio (up to 300 Characters)" >';

        $form.='<label for="userType">Select Usertype</label>';
        $form.='<select class="form-control" id="userType" name="userType">';            
        $i = 0;
        foreach($userTypeList as $key=>$value){
            if ($i === 0) {
                $form.= '<option value="'.$key.'" selected>'.$value.'</option>';
                $i++;
            }
            else {
                $form.= '<option value="'.$key.'">'.$value.'</option>';
            }
        }
        $form.='</select></div>';

        $form.='<label for="email">email</label><input type="text" class="form-control" id="email" name="email" pattern="[a-zA-Z0-9@.]{1,45}" title="enter a valid email" >';
        $form.='<label for="pass1">Password</label><input required type="password" class="form-control" id="pass1" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">';
        $form.='<label for="pass2">Re-enter Password</label><input required type="password" class="form-control" id="pass2" name="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must match the above password exactly">';
        $form.='<button type="submit" class="btn btn-default" name="btnRegister" value="registerUser">Register</button>';
        $form.='</div></form>';

        return $form;
    }


    /**
     * Generates a HTML form for registering a new  account.  It is intended for CUSTOMER use
     * 
     * The form generated will display a drop down list/chooser of counties and user types.  
     * 
     * @param string $pageID The pageID of the page which will be used to process the login form.
     * @return string String containing the generated form.
     */
    public static function form_register_customer($pageID){
        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<div class="form-group">';
        $form.='<label for="firstName">First Name</label><input required type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="First Name (up to 45 Characters)">';
        $form.='<label for="lastName">Last Name</label><input required type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="Last Name (up to 45 Characters)" >';

        //hidden DEFAULT input values for user type and login enabled
        $form.= '<input type="hidden" id="userType" name="userType" value="1">'; // 1 is customer, 2 is Administrator

        $form.='<label for="email">email</label><input type="text" class="form-control" id="email" name="email" pattern="[a-zA-Z0-9@.]{1,45}" title="enter a valid email" >';
        $form.='<label for="pass1">Password</label><input required type="password" class="form-control" id="pass1" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">';
        $form.='<label for="pass2">Re-enter Password</label><input required type="password" class="form-control" id="pass2" name="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must match the above password exactly">';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" name="btnRegister" value="registerUser">Register</button>';
        $form.='</form>';

        return $form;
    }

    
    public static function form_create_recipe($mealTypes, $pageID){

        $form='<form method="post" id="createRecipeForm" action="index.php?pageID='.$pageID.'&id=0" enctype="multipart/form-data">';
        $form.='<div class="form-group">';
        $form.='<label for="name">Recipe Name</label><input required type="text" class="form-control" id="name" name="name" pattern="{1,20}" title="Recipe Name (up to 20 Characters)">';
        $form.='<label for="description">Description</label><input required type="text" class="form-control" id="description" name="description" pattern="{1,100}" title="Recipe Description (up to 100 Characters)" >';
        $form.='<label for="prepTimeMinutes">Prep Time (In Minutes)</label><input required type="number" min="0" class="form-control" id="prepTimeMinutes" name="prepTimeMinutes" " title="Amount of minutes of preparation that recipe requires (A whole number)" >';
        $form.='<label for="cookTimeMinutes">Cooking Time (In Minutes)</label><input required type="number" min="0" class="form-control" id="cookTimeMinutes" name="cookTimeMinutes" " title="Amount of minutes of cooking that recipe requires (A whole number)" >';
        $form.='<label for="difficulty">Difficulty (1-5)</label><input type="number" min="1" max="5" class="form-control" id="difficulty" name="difficulty" pattern="{1,5}" title="Enter a number between 1 and 5" >';
        $form.='<label for="servings">Servings</label><input required type="number" min="1" max="50" class="form-control" id="servings" name="servings"  title="Amount of servings that recipe makes (A whole number)" >';

        $form.='<label for="mealType">Select Meal Type</label>';
        $form.='<select class="form-control" id="mealType" name="mealType">';
        $form.= '<option value="0" selected>Select a Meal Type</option>';
        foreach($mealTypes as $key=>$value){
            $form.= '<option value="'.$key.'">'.$value.'</option>';  
        }
        $form.='</select>';
        
        $form .= '<fieldset style="margin-top: 1em;"><legend>Dietary Compatibility</legend>';
        $form .= '<div class="form-group" style="display: flex; gap: 1em;">';
        $form .= '<label class="checkbox-inline"><input type="checkbox" name="diets[]" value="1"> Vegan</label>';
        $form .= '<label class="checkbox-inline"><input type="checkbox" name="diets[]" value="2"> Vegetarian</label>';
        $form .= '<label class="checkbox-inline"><input type="checkbox" name="diets[]" value="3"> Gluten-Free</label>';
        $form .= '<label class="checkbox-inline"><input type="checkbox" name="diets[]" value="4"> Keto</label>';
        $form .= '<label class="checkbox-inline"><input type="checkbox" name="diets[]" value="5"> Dairy-Free</label>';
        $form .= '</div>';
        $form .= '</fieldset>';

        
        $form.='<label for="thumbnail">Recipe Thumbnail</label><input type="file" class="form-control" name="thumbnail" accept="image/*">';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" name="btnCreateRecipe" value="Create">Create</button>';
        $form .='<button type="submit" class="btn btn-default" id="btnClear" name="btnClear" value="Clear" formnovalidate>Clear</button>';
        $form.='</form>';

        // script to restore input box values on page refresh, needed as page refreshes on adding a step or ingredient
        $form .= '<script src="javascript/RecipeForm-Persistence.js"></script>';

        return $form;
    }
    
    
    public static function form_edit_recipe($mealTypes, $pageID, $recipe){
        $thumbnail = htmlspecialchars('assets/images/uploads/' . ($recipe['thumbnail'] ?? 'recipe_default.jpg'));
        $name = htmlspecialchars($recipe['name'] ?? 'Untitled Recipe');
        $prepTime = (int)$recipe['prepTimeMinutes'];
        $cookTime = (int)$recipe['cookTimeMinutes'];
        $description = htmlspecialchars($recipe['description'] ?? 'No description available.');
        $servings = ($recipe['servings'] ?? 'Unknown');
        $creatorID = (int)($recipe['creatorID'] ?? '[deleted]'); 
        $recipeID = (int)(isset($recipe['recipeID'])) ? $recipe['recipeID'] : $_GET['id'];
        $mealType = $recipe['mealType'] ?? "";
        
        $difficulty = htmlspecialchars($recipe['difficulty']);
        $difficultyMap = [
            'Very Easy' => 1,
            'Easy' => 2,
            'Medium' => 3,
            'Hard' => 4,
            'Very Hard' => 5
        ];

        $numericDifficulty = $difficultyMap[$difficulty];


        $form='<form method="post" id="createRecipeForm" action="index.php?pageID=editRecipe&id='.$recipeID.'" enctype="multipart/form-data">';
        $form.='<div class="form-group">';
        $form.='<label for="name">Recipe Name</label><input required type="text" class="form-control" id="name" name="name" value="'.$name.'" pattern="{1,20}" title="Recipe Name (up to 20 Characters)">';
        $form.='<label for="description">Description</label><input required type="text" class="form-control" id="description" name="description" value="'.$description.'" pattern="{1,100}" title="Recipe Description (up to 100 Characters)" >';
        $form.='<label for="prepTimeMinutes">Prep Time (In Minutes)</label><input required type="number" min="1" class="form-control" id="prepTimeMinutes" name="prepTimeMinutes" value="'.$prepTime.'" title="Amount of minutes of preparation that recipe requires (A whole number)" >';
        $form.='<label for="cookTimeMinutes">Cooking Time (In Minutes)</label><input required type="number" min="1" class="form-control" id="cookTimeMinutes" name="cookTimeMinutes" value="'.$cookTime.'" title="Amount of minutes of cooking that recipe requires (A whole number)" >';
        $form.='<label for="difficulty">Difficulty (1-5)</label><input type="number" min="1" max="5" class="form-control" id="difficulty" name="difficulty" value="'.$numericDifficulty.'" pattern="{1,5}" title="Enter a number between 1 and 5" >';
        $form.='<label for="servings">Servings</label><input required type="number" min="1" max="50" class="form-control" id="servings" name="servings" value="'.$servings.'"  title="Amount of servings that recipe makes (A whole number)" >';

        $form.='<label for="mealType">Select Meal Type</label>';
        $form.='<select class="form-control" id="mealType" name="mealType">';
        $form.= '<option value="" disabled hidden>Select a Meal Type</option>';
        foreach($mealTypes as $key=>$value){
            if ($value == $mealType) {
                $form.= '<option value="'.$key.'" selected>'.$value.'</option>';
            }
            else {
                $form.= '<option value="'.$key.'">'.$value.'</option>'; 
            }
        }
        $form.='</select>';
        
        $form .= '<fieldset style="margin-top: 1em;"><legend>Dietary Compatibility</legend>';
        $form .= '<div class="form-group" style="display: flex; gap: 1em;">';
        $form .= '<label class="checkbox-inline"><input type="checkbox" name="diets[]" value="1"> Vegan</label>';
        $form .= '<label class="checkbox-inline"><input type="checkbox" name="diets[]" value="2"> Vegetarian</label>';
        $form .= '<label class="checkbox-inline"><input type="checkbox" name="diets[]" value="3"> Gluten-Free</label>';
        $form .= '<label class="checkbox-inline"><input type="checkbox" name="diets[]" value="4"> Keto</label>';
        $form .= '<label class="checkbox-inline"><input type="checkbox" name="diets[]" value="5"> Dairy-Free</label>';
        $form .= '</div>';
        $form .= '</fieldset>';
        
        $form .= '<input type="hidden" name="creatorID" value="'.$creatorID.'">';

        
        $form.='<label for="thumbnail">Recipe Thumbnail (only upload if you wish to change) </label><input type="file" class="form-control" name="thumbnail" accept="image/*">';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" name="btnEditRecipe" value="Edit">Confirm Changes</button>';
        $form .='<a href="index.php?pageID=recipeDetails&id='.$recipeID.'" class="btn btn-default">Return</a>';
        $form.='</form>';

        // script to restore input box values on page refresh, needed as page refreshes on adding a step or ingredient
        $form .= '<script src="javascript/RecipeForm-Persistence.js"></script>';

        return $form;
    }

    
    public static function form_add_recipe_step($pageID){
        $form='<form method="post" action="index.php?pageID='.$pageID.'&id='.($_GET['id'] ?? 0).'" style="margin-bottom: 3em;">';
        $form.='<div class="form-group">';
        $form.='<label for="step">Enter steps in order, one at a time</label>';
        $form.='<textarea rows="4" cols="50" class="form-control" id="step" name="step" pattern="{1,100}" title="Recipe Step Description (up to 100 Characters)"></textarea>';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" name="btnAddStep" value="Add">Add</button>';
        $form.='<button type="submit" class="btn btn-default" name="btnRemoveStep" value="Remove">Remove</button>';
        $form.='</form>';

        return $form;
    }

    
    public static function form_add_recipe_ingredient($ingredients, $unitTypes, $pageID){
        $form='<form method="post" action="index.php?pageID='.$pageID.'&id='.($_GET['id'] ?? 0).'" style="margin-bottom: 3em;">';
        $form.='<div class="form-group">';
        $form.='<div style="display: flex; justify-content: space-between;"><label for="ingredient">Select Ingredient</label>';
        $form.='<input type="hidden" name="isEssential" value="0">';
        $form.='<div class="checkbox"><label for="isEssential"><input type="checkbox" id="isEssential" name="isEssential" value="1" checked>Essential</label></div></div>';

        $form.='<select class="form-control" id="ingredient" name="ingredient">';
        $form.= '<option value="0" selected>Select Ingredient</option>';
        while ($option = $ingredients->fetch_row()) {  //fetch each field
            $form.= '<option value="'.$option[0].'">'.$option[0].'</option>';  
        }   
        $form.='</select>';

        $form.='<label for="quantity">Select Amount</label><div style="display: flex;"><input type="number" min="0.25" step="0.25" class="form-control" id="quantity" name="quantity" title="Ingredient Quantity">';
        $form.='<select class="form-control" id="unit" name="unit" style="width: 45%;">';            
        $i = 0;
        foreach($unitTypes as $key=>$value){
            switch ($i) {
                case 0:
                    $form.= '<option value="'.$value.'" selected>'.$value.'</option>';
                    break;
                case count($unitTypes) - 1:
                    $form.= '<option value="'.$value.'">units</option>';
                    break;

                default:
                    $form.= '<option value="'.$value.'">'.$value.'</option>';
                    break;
            }
            $i++;
        }
        $form.='</select></div>';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" name="btnAddIngredient" value="Add">Add</button>';
        $form.='<button type="submit" class="btn btn-default" name="btnRemoveIngredient" value="Remove">Remove</button>';
        $form.='</form>';

        return $form;
    }


    /**
     * Generates a HTML form for entering a chat message and optionally specifying a recipient. 
     * 
     * 
     * @param string $pageID The pageID of the page which will be used to process the login form.
     * @return string String containing the generated form.
     */    
    public static function form_add_msg($pageID){
        $form='<div class="container-fluid">';
        $form.='<form method="post" action="index.php?pageID='.$pageID.'">';

        $form.='<div class="form-group">';

        $form.='<label for="message">Enter a Message</label><textarea class="form-control" id="message" name="message" rows="3" style="resize:vertical"></textarea> ';

        $form.='<label for="msgTo">Addressed To (enter ID or leave blank for ALL)</label><input type="text" class="form-control" id="msgTo" name="msgTo" >';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnAddMsg">Submit Message</button>';
        $form.='</form>';
        $form.='</div>';
        return $form;
    }      
    
    
    public static function form_add_review($pageID, $recipeID, $reviewerID) {
        $form = '<form id="review" method="post" action="index.php?pageID=' . htmlspecialchars($pageID) . '&id=' . (int)$recipeID . '" class="col-sm-4" style="padding: 0;">';

        $form .= '<div class="form-group">';
        $form .= '<label for="rating">Rating (1 to 5)</label>';
        $form .= '<input type="number" min="1" max="5" class="form-control" id="rating" name="rating" placeholder="Select a rating" title="Enter a number between 1 and 5" >';
        $form .= '</div>';

        $form .= '<div class="form-group">';
        $form .= '<label for="comment">Comment</label>';
        $form .= '<textarea class="form-control" id="comment" name="comment" rows="4" required maxlength="255" placeholder="What did you think of this recipe?"></textarea>';
        $form .= '</div>';
        
        $form .= '<input type="hidden" name="reviewerID" value="'.$reviewerID.'">';

        $form .= '<button type="submit" class="btn btn-default" name="btnAddReview">Submit Review</button>';
        $form .= '</form>';

        return $form;
    }


    /**
     * Generates a HTML CONFIRM form (Button)
     * 
     * @param string $pageID The pageID of the page which will be used to process the login form. 
     * @param string $choice The value of the chosen variable to be confirmed. 
     * @param string $btnText The text to appear on the form button. 
     * @return string String containing the generated form.
     */    
    public static function form_confirm($pageID,$btnText,$choice){
        $form='<p>Are you sure you want to delete this account? this cannot be reversed</p>';
        $form.='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<button type="submit" class="btn btn-default" value='.$choice.' name="btnConfirm">'.$btnText.'</button>';
        $form.='<button type="submit" class="btn btn-default" value='.FALSE.' name="btnConfirm">Cancel</button>';
        $form.='</form>';
        return $form;
    } 
    
    public static function form_confirm_review($pageID,$btnText,$choice){
        $form='<p>Are you sure you want to delete this review? this cannot be reversed</p>';
        $form.='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<button type="submit" class="btn btn-default" value='.$choice.' name="btnConfirmReview">'.$btnText.'</button>';
        $form.='<button type="submit" class="btn btn-default" value='.FALSE.' name="btnConfirm">Cancel</button>';
        $form.='</form>';
        return $form;
    } 
    
    public static function form_confirm_recipe($pageID,$btnText,$choice){
        $form='<p>Are you sure you want to delete this recipe? this cannot be reversed</p>';
        $form.='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<button type="submit" class="btn btn-default" value='.$choice.' name="btnConfirm">'.$btnText.'</button>';
        $form.='<button type="submit" class="btn btn-default" value='.FALSE.' name="btnConfirm">Cancel</button>';
        $form.='</form>';
        return $form;
    }    
   
}
