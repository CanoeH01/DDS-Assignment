<?php
/**
* This file contains the HelperHTML Base Class. 
* 
*/

/**
 * 
 * HelperHTML class provides static HTML helper functions. 
 * 
 * @author Conor Hanrahan
 * 
 */
Class HelperHTML {
    
   /**
    * Function that generates a HTML table from a resultset object. 
    * 
    * @param mysqli_result  $resultSet A resultset object
    * @return string Containing a HTML table corresponding to the resultset. 
    * 
    */
    public static function generateTABLE($resultSet){
        //This STATIC method returns a HTML table as a string
        //It takes one argument - $resultSet which must contain an object
        //of the $resultSet class
        $table='';  //start with an empty string
        
        if($resultSet){ //check that a valid resultset has been passed to this method
        
        //generate the HTML table
        $i=0;
        $resultSet->data_seek(0);  //point to the first row in the result set
        $table.= '<table class="table table-striped">';
        while ($row = $resultSet->fetch_assoc()) {  //fetch associative array
            while ($i===0)  //trick to generate the HTML table headings
            {   $table.=  '<tr>';
                foreach($row as $key=>$value){
                    $table.=  "<th>$key</th>"; //echo the keys as table headings for the first row of the HTML table
                }
                $table.=  '</tr>';
                $i=1;  
            }

            $table.=  '<tr>';
            foreach($row as $value){
                $table.=  "<td>$value</td>";
                }
            $table.=  '</tr>';
        }
        $table.=  '</table>';
        }
        else{
            $table='Sorry - there is no data available matching your query at this time';
        }
        return $table;
    }
    
    
    /**
    * Function that generates a HTML 2 column table from a single associative array. 
    * 
    * @param array  $dataArray An associative array of data (mixed)
    * @return string Containing a HTML table corresponding to the resultset. 
    * 
    */
    public static function generateVerticalRecordTable($dataArray){
        //This STATIC method returns a HTML table as a string
        //It takes one argument - $dataArray which must contain an associative array of data

        $table= '<table class="table table-striped">';
        
        foreach($dataArray as $key=>$value){
            $table.= '<tr>';
            $table.= '<td><b>'.$key.'</b></td>';
            $table.= '<td>'.$value.'</td>';
            $table.= '</tr>';
         
        }
        $table.='</table>';          
        return $table;
    }
    
    
    public static function generateVerticalIndexedRecordTable($dataArray){
        //This STATIC method returns a HTML table as a string
        //It takes one argument - $dataArray which must contain an indexed array of data

        
        $table= '<table class="table table-striped">';
        
        for($i = 0; $i < sizeof($dataArray); $i++){
            $table.= '<tr>';
            $table.= '<td><b>'.($i + 1).'</b></td>';
            $table.= '<td>'.$dataArray[$i].'</td>';
            $table.= '</tr>';
         
        }
        $table.='</table>';          
        return $table;
    }
    
    
    public static function generateVerticalIngredientRecordTable($ingredients){
        //This STATIC method returns a HTML table as a string 
        //It takes one argument - $ingredients which must contain a 2 dimensional associative array of data containing ingredients. e.g. {"Ham":["1","20", "g"], ...}
        
        $table= '<table class="table table-striped">';
        
        foreach($ingredients as $key=>$value){
            $table.= '<tr>';
            $table.= '<td><b>'.$key.'</b></td>';
            $table.= '<td>'.$value[1].$value[2].'</td>';
            $table.= '</tr>';
         
        }
        $table.='</table>';          
        return $table;
    }
    
    
    /**
     * Function that generates a HTML table with a SELECT button from a resultset object. 
     * 
     * @param mysqli_result $resultSet The resultset to be implemented in the select table. 
     * @param string $selectKeyField Specifies which table entity field should be used to uniquely identify a record. 
     * @param string $pageID The current page ID
     * @param string $buttonText Text to appear on the SELECT button
     * @return string String containing a HTML table with a SELECT button from a resultset object.
     */
    public static function generateSelectTABLE($resultSet,$selectKeyField,$pageID,$buttonText){
        //This STATIC method returns a HTML table as a string
        //It takes one argument - $resultSet which must contain an object
        //of the $resultSet class
        $table="";  //start with an empty string
        
        if($resultSet){ //check that a valid resultset has been passed to this method
        
            //generate the HTML table
            $i=0;
            $resultSet->data_seek(0);  //point to the first row in the result set
            $table.= '<table class="table table-striped">';
            while ($row = $resultSet->fetch_assoc()) {  //fetch associative array
                while ($i===0)  //trick to generate the HTML table headings
                {   $table.=  '<tr>';
                    foreach($row as $key=>$value){
                        $table.=  "<th>$key</th>"; //echo the keys as table headings for the first row of the HTML table
                    }
                    $table.=  "<th>Select</th>";
                    $table.=  '</tr>';
                    $i=1;  
                }

                $table.=  '<tr>';
                foreach($row as $key=>$value){  //generate the data columns
                        $table.=  "<td>$value</td>";
                    }

                foreach($row as $key=>$value){ //generate the selector button with the hidden key value
                    if ($key===$selectKeyField){
                        $table.=  "<td>";
                        $table.=  '<form action="index.php?pageID='.$pageID.'" method="post">';    
                        $table.=  '<input type="submit" type="button" value="'.$buttonText.'" name="btnRecordSelected">'; 
                        $table.=  '<input type="hidden" value="'.$value.'" name="recordSelected">'; 
                        $table.=  '</form>';    
                        $table.=  '</td>';
                    }
                }                 
                $table.=  '</tr>';
            }
            $table.=  '</table>';
        }
        else{
            $table='Sorry - there is no data available matching your query at this time';
        }
        return $table;
    }

    
    public static function generateUserSelectTABLE($resultSet,$selectKeyField,$pageID,$buttonText){
        $table="";
        
        if($resultSet){ 
        
            $i=0;
            $j=0;
            $resultSet->data_seek(0); 
            $table.= '<table class="table table-striped">';
            while ($row = $resultSet->fetch_assoc()) {
                while ($i===0)  //trick to generate the HTML table headings
                {   $table.=  '<tr>';
                    foreach($row as $key=>$value){
                        if ($j === 0) {
                            $j++;
                        }
                        else {
                            $table.=  "<th>$key</th>"; 
                        }
                    }
                    $table.=  "<th></th>";
                    $table.=  '</tr>';
                    $i=1;  
                }

                $i=0; 
                $table.=  '<tr>';
                foreach($row as $key=>$value){
                    switch ($i) {
                        case 0:
                            $userID = $value;
                            $i++;
                            break;
                        case 1:
                        $table .= '<td><a href="index.php?pageID=viewUser&id='.$userID.'" style="background: none; border: none; color: #1a0dab; text-decoration: underline; cursor: pointer;">'.$value.'</a>';
                        $table.='</form>';  
                        $i=2;
                            break;
                        default:
                            $table.=  "<td>$value</td>";
                            break;
                    }
                }

                foreach($row as $key=>$value){ //generate the selector button with the hidden key value
                    if ($key===$selectKeyField){
                        $table.=  "<td>";
                        $table.=  '<form action="index.php?pageID='.$pageID.'" method="post">';    
                        $table.=  '<input type="submit" type="button" value="'.$buttonText.'" name="btnRecordSelected">'; 
                        $table.=  '<input type="hidden" value="'.$value.'" name="recordSelected">'; 
                        $table.=  '</form>';    
                        $table.=  '</td>';
                    }
                }                
                $table.=  '</tr>';
            }   
            $table.=  '</table>';
        }
        else{
            $table='Sorry - there is no data available matching your query at this time';
        }
        return $table;
    }
    
    
    public static function generateRecipeCardGrid($recipes, $currentPage, $totalPages){
        $html = '<link rel="stylesheet" href="css/ViewRecipesRecipeCard.css">';

        // Start a container or row
        $html .= '<div class="container-fluid">';

        foreach ($recipes as $recipe) {
            $thumbnail = htmlspecialchars('assets/images/uploads/' . ($recipe['thumbnail'] ?? 'default.jpg'));
            $name = htmlspecialchars($recipe['name'] ?? 'Untitled Recipe');
            $difficulty = htmlspecialchars($recipe['difficulty'] ?? 'Unknown');
            $prepTime = (int)($recipe['prepTimeMinutes'] ?? 0);
            $cookTime = (int)($recipe['cookTimeMinutes'] ?? 0);
            $totalTime = $prepTime + $cookTime;
            $description = htmlspecialchars($recipe['description'] ?? 'No description available.');
            $recipeID = $recipe['recipeID'] ?? 0;
            $mealType = htmlspecialchars($recipe['mealType'] ?? "Unknown");
            $creatorID = (int) (isset($recipe['creatorID'])) ? $recipe['creatorID']: $_GET['id'];
            $roundedRating = round($recipe['avgRating'] ?? 0);
            $starRating  = str_repeat('★', $roundedRating) . str_repeat('☆', 5 - $roundedRating);
            $ratingCount = $recipe['totalRatings'] ?? 0;

            $html .= '
            <div class="recipe-row">
                <div class="row">

                    <div class="col-sm-3">
                        <img src="' . $thumbnail . '" alt="' . $name . '" class="recipe-image">
                    </div>

                    <div class="col-sm-9 recipe-info">
                        <h4 class="recipe-title"><a href="index.php?pageID=recipeDetails&id=' . $recipeID . '" style="color: inherit;">' . $name . '</a></h4>
                        <p class="recipe-rating">
                            ' . $starRating . '
                            <span style="color:#444; font-size:0.9em;">(' . $ratingCount . ' ratings)</span>
                        </p>
                        <p class="recipe-description">' . $description . '</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 recipe-meta">
                        <span><i class="glyphicon glyphicon-tag"></i> ' . $mealType . '</span>
                        <span><i class="glyphicon glyphicon-time"></i> ' . $totalTime . ' mins</span>
                        <span><i class="glyphicon glyphicon-flash"></i> ' . $difficulty . '</span>
                    </div>
                </div>
            </div>
            ';
        }
        $html .= '</div>';
        
        $html .= '<div class="text-center">';
        $html .= '<ul class="pagination">';
        $html .= '<li class="disabled"><a href="#">Page ' . $currentPage . ' of ' . $totalPages . '</a></li>';
        if ($currentPage > 1){ 
            $html .= '<li><a href="index.php?pageID='.$_GET['pageID'].'&id='.$creatorID.'&page=' . ($currentPage - 1) . '" style="text-dectoration: none; color: inherit;">Previous</a></li>';
        }
        if ($currentPage < $totalPages){
            $html .= '<li><a href="index.php?pageID='.$_GET['pageID'].'&id='.$creatorID.'&page=' . ($currentPage + 1) . '" style="text-dectoration: none; color: inherit;">Next</a></li>';
        }
        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }


    public static function generateRecipeInfoCard($recipe, $creatorName, $userID, $pageID, $isFavourited, $avgReview, $totalRatings) {
        $thumbnail = htmlspecialchars('assets/images/uploads/' . ($recipe['thumbnail'] ?? 'recipe_default.jpg'));
        $name = htmlspecialchars($recipe['name'] ?? 'Untitled Recipe');
        $difficulty = htmlspecialchars($recipe['difficulty'] ?? 'Unknown');
        $prepTime = (int)($recipe['prepTimeMinutes'] ?? 0);
        $cookTime = (int)($recipe['cookTimeMinutes'] ?? 0);
        $description = htmlspecialchars($recipe['description'] ?? 'No description available.');
        $roundedRating = round($avgReview ?? 0);
        $stars  = str_repeat('★', $roundedRating) . str_repeat('☆', 5 - $roundedRating);
        $servings = ($recipe['servings'] ?? 'Unknown');
        $creatorID = (int)($recipe['creatorID'] ?? '[deleted]'); 
        $recipeID = (int)$recipe['recipeID'];
        

        $html = '<div class="container recipe-info-card">';
        $html .= '<div class="row">';

        $html .= '<div class="col-sm-4">';
        $html .= '<img src="' . $thumbnail . '" alt="' . $name . '" class="img-responsive">';
        $html .= '</div>';

        $html .= '<div class="col-sm-6">';
        $html .= '<h2 style="margin-top: 0;">' . $name . '</h2>';
        
        $html .= '<p><a href="index.php?pageID=viewUser&id=' . $creatorID . '">'.$creatorName.'</a></p>';
        
        $html .= '<p>';
        $html .= '<span style="color: #f0ad4e; font-size: 1.2em;">' . $stars . '</span> ';
        $html .= '<span style="color: #666;">(' . $totalRatings . ' ratings)</span>';
        $html .= '</p>';

        $html .= '<div class="row" style="font-size: 1.1em;">';

        $html .= '<div class="col-xs-4">';
        $html .= '<i class="glyphicon glyphicon-time" style="font-size: 1.4em;"></i> ';
        $html .= '<div style="display: inline-block; width: 7em; vertical-align: top; margin-left: 0.6em;">';
        $html .= '<div><strong>Prep:</strong> ' . $prepTime . ' mins</div>';
        $html .= '<div><strong>Cook:</strong> ' . $cookTime . ' mins</div>';
        $html .= '</div></div>';

        $html .= '<div class="col-xs-4" style="padding-left: 0;">';
        $html .= '<i class="glyphicon glyphicon-flash" style="font-size: 1.4em;"></i> ';
        $html .= '<span style="margin-left: 6px;"><strong>Difficulty:</strong> ' . $difficulty . '</span>';
        $html .= '</div>';

        $html .= '<div class="col-xs-4">';
        $html .= '<i class="glyphicon glyphicon-cutlery" style="font-size: 1.4em;"></i> ';
        $html .= '<span style="margin-left: 6px;"><strong>Serves:</strong> ' . $servings . '</span>';
        $html .= '</div>';

        $html .= '</div>'; 
        $html .= '<p style="font-size: 1.2em; margin-top: 2em;">' . $description . '</p>';
        
        if ($isFavourited) {
            $html .= '<form method="post" action="index.php?pageID='.$pageID.'&id='.$_GET['id'].'">'
            . '<button type="submit" class="btn btn-success" style="width: 15em;" name="btnRemoveFavourite" value="'.$recipeID.'">Remove Favourite</button>'
            . '</form>';
        }
        else {
            $html .= '<form method="post" action="index.php?pageID='.$pageID.'&id='.$_GET['id'].'">'
          . '<button type="submit" class="btn btn-success" style="width: 15em;" name="btnAddFavourite" value="'.$recipeID.'">Add Favourite</button>'
          . '</form>';  
        }

        
        $html .= '</div>'; 
        $html .= '</div>'; 
        $html .= '</div>'; 

        return $html;
    }
    
        public static function generateRecipeInfoCardGeneral($recipe, $creatorName, $pageID, $avgReview, $totalReviews) {
        $thumbnail = htmlspecialchars('assets/images/uploads/' . ($recipe['thumbnail'] ?? 'recipe_default.jpg'));
        $name = htmlspecialchars($recipe['name'] ?? 'Untitled Recipe');
        $difficulty = htmlspecialchars($recipe['difficulty'] ?? 'Unknown');
        $prepTime = (int)($recipe['prepTimeMinutes'] ?? 0);
        $cookTime = (int)($recipe['cookTimeMinutes'] ?? 0);
        $description = htmlspecialchars($recipe['description'] ?? 'No description available.');
        $stars = str_repeat('★', $avgReview) . str_repeat('☆', 5 - $avgReview);
        $ratingCount = 107;
        $servings = ($recipe['servings'] ?? 'Unknown');
        $creatorID = (int)($recipe['creatorID'] ?? '[deleted]'); 
        

        $html = '<div class="container recipe-info-card">';
        $html .= '<div class="row">';

        $html .= '<div class="col-sm-4">';
        $html .= '<img src="' . $thumbnail . '" alt="' . $name . '" class="img-responsive">';
        $html .= '</div>';

        $html .= '<div class="col-sm-6">';
        $html .= '<h2 style="margin-top: 0;">' . $name . '</h2>';
        
        $html .= '<p><a href="index.php?pageID=viewUser&id=' . $creatorID . '">'.$creatorName.'</a></p>';
        
        $html .= '<p>';
        $html .= '<span style="color: #f0ad4e; font-size: 1.2em;">' . $stars . '</span> ';
        $html .= '<span style="color: #666;">(' . $totalReviews . ' ratings)</span>';
        $html .= '</p>';

        $html .= '<div class="row" style="font-size: 1.1em;">';

        $html .= '<div class="col-xs-4">';
        $html .= '<i class="glyphicon glyphicon-time" style="font-size: 1.4em;"></i> ';
        $html .= '<div style="display: inline-block; width: 7em; vertical-align: top; margin-left: 6px;">';
        $html .= '<div><strong>Prep:</strong> ' . $prepTime . ' mins</div>';
        $html .= '<div><strong>Cook:</strong> ' . $cookTime . ' mins</div>';
        $html .= '</div></div>';

        $html .= '<div class="col-xs-4" style="padding-left: 0;">';
        $html .= '<i class="glyphicon glyphicon-flash" style="font-size: 1.4em;"></i> ';
        $html .= '<span style="margin-left: 6px;"><strong>Difficulty:</strong> ' . $difficulty . '</span>';
        $html .= '</div>';

        $html .= '<div class="col-xs-4">';
        $html .= '<i class="glyphicon glyphicon-cutlery" style="font-size: 1.4em;"></i> ';
        $html .= '<span style="margin-left: 6px;"><strong>Serves:</strong> ' . $servings . '</span>';
        $html .= '</div>';

        $html .= '</div>'; 
        $html .= '<p style="font-size: 1.2em; margin-top: 2em;">' . $description . '</p>';
        
        $html .= '</div>'; 
        $html .= '</div>'; 
        $html .= '</div>'; 

        return $html;
    }
    
    
    public static function generateRecipeInfoCardEditDelete($recipe, $creatorName, $userID, $pageID, $isFavourited, $avgReview, $totalReviews) {
        $thumbnail = htmlspecialchars('assets/images/uploads/' . ($recipe['thumbnail'] ?? 'recipe_default.jpg'));
        $name = htmlspecialchars($recipe['name'] ?? 'Untitled Recipe');
        $difficulty = htmlspecialchars($recipe['difficulty'] ?? 'Unknown');
        $prepTime = (int)($recipe['prepTimeMinutes'] ?? 0);
        $cookTime = (int)($recipe['cookTimeMinutes'] ?? 0);
        $description = htmlspecialchars($recipe['description'] ?? 'No description available.');
        $stars = str_repeat('★', $avgReview) . str_repeat('☆', 5 - $avgReview);

        $servings = ($recipe['servings'] ?? 'Unknown');
        $creatorID = (int)($recipe['creatorID'] ?? '[deleted]'); 
        $recipeID = (int)$recipe['recipeID'];
        

        $html = '<div class="container recipe-info-card">';
        $html .= '<div class="row">';

        $html .= '<div class="col-sm-4">';
        $html .= '<img src="' . $thumbnail . '" alt="' . $name . '" class="img-responsive">';
        $html .= '</div>';

        $html .= '<div class="col-sm-6">';
        $html .= '<h2 style="margin-top: 0;">' . $name . '</h2>';
        
        $html .= '<p><a href="index.php?pageID=viewUser&id=' . $creatorID . '">'.$creatorName.'</a></p>';
        
        $html .= '<p>';
        $html .= '<span style="color: #f0ad4e; font-size: 1.2em;">' . $stars . '</span> ';
        $html .= '<span style="color: #666;">(' . $totalReviews . ' ratings)</span>';
        $html .= '</p>';

        $html .= '<div class="row" style="font-size: 1.1em;">';

        $html .= '<div class="col-xs-4">';
        $html .= '<i class="glyphicon glyphicon-time" style="font-size: 1.4em;"></i> ';
        $html .= '<div style="display: inline-block; width: 7em; vertical-align: top; margin-left: 6px;">';
        $html .= '<div><strong>Prep:</strong> ' . $prepTime . ' mins</div>';
        $html .= '<div><strong>Cook:</strong> ' . $cookTime . ' mins</div>';
        $html .= '</div></div>';

        $html .= '<div class="col-xs-4" style="padding-left: 0;">';
        $html .= '<i class="glyphicon glyphicon-flash" style="font-size: 1.4em;"></i> ';
        $html .= '<span><strong>Difficulty:</strong> ' . $difficulty . '</span>';
        $html .= '</div>';

        $html .= '<div class="col-xs-4">';
        $html .= '<i class="glyphicon glyphicon-cutlery" style="font-size: 1.4em;"></i> ';
        $html .= '<span style="margin-left: 6px;"><strong>Serves:</strong> ' . $servings . '</span>';
        $html .= '</div>';

        $html .= '</div>'; 
        $html .= '<p style="font-size: 1.2em; margin-top: 2em;">' . $description . '</p>';
        
        if ($isFavourited) {
            $html .= '<form method="post" action="index.php?pageID='.$pageID.'&id='.$_GET['id'].'">'
          . '<button type="submit" class="btn btn-success" style="width: 15em;" name="btnRemoveFavourite" value="'.$recipeID.'">Remove Favourite</button>'
          . '</form>';
        }
        else {
            $html .= '<form method="post" action="index.php?pageID='.$pageID.'&id='.$_GET['id'].'">'
          . '<button type="submit" class="btn btn-success" style="width: 15em;" name="btnAddFavourite" value="'.$recipeID.'">Add Favourite</button>'
          . '</form>';  
        }
        
        $html .= '<form method="post" action="index.php?pageID='.$pageID.'&id='.$_GET['id'].'">'
          . '<div class="btn-group" role="group">'
          . '<a href="index.php?pageID=editRecipe&id='.$_GET['id'].'" class="btn btn-warning" style="margin-top: 1em;">Edit Recipe</a>'
          . '<button type="submit" class="btn btn-danger" name="btnDeleteRecipe" value="'.$recipeID.'" style="margin-top: 1em;">Delete Recipe</button>'      
          . '</div></form>';  

        
        $html .= '</div>'; 
        $html .= '</div>'; 
        $html .= '</div>'; 

        return $html;
    }


    
    public static function generateRecipeDetailsCard($ingredients, $steps){
        $html = '<div class="col-sm-5" style="width:36%; padding-left: 2em;"><h3>Ingredients</h3>';
        $html .= '<ul class="list-unstyled">';
        foreach ($ingredients as $ingredient) {
            $ingredientName = htmlspecialchars($ingredient['name']);
            $quantity       = htmlspecialchars($ingredient['quantity']);
            $unit           = htmlspecialchars($ingredient['unit']);
            $essential      = $ingredient['essential'] ? '' : ' (Optional)';
            
            switch ($unit) {
                case ' ':
                    $html .= "<li style=\"padding-bottom: 1.4em\">$quantity <strong>".$ingredientName."(s)</strong>$essential</li>";
                    break;
                
                case 'tsp':
                case 'tbsp':
                case 'cups':
                    $html .= "<li style=\"padding-bottom: 1.4em\">$quantity $unit <strong>$ingredientName</strong>$essential</li>";
                    break;
                
                default:
                    $html .= "<li style=\"padding-bottom: 1.4em\">$quantity$unit <strong>$ingredientName</strong>$essential</li>";
                    break;
            }
            if ($unit === ' ') {
                
            }
            else {
                
            }

        }
        $html .= '</ul></div>';

        $html .= '<div class="col-sm-7"><h3>Method</h3>';
        $i = 1;
        while ($row = $steps->fetch_assoc()) { 
            foreach ($row as $key=>$value) {
                $html .= '<strong>Step '.$i++.'</strong>';
                $html .= '<p>' . htmlspecialchars($value) . '</p><hr>';
            }
        }

        $html .= '</div>';
        
        return $html;
    }
    
    public static function generateReviewList($reviews, $currentPage, $totalPages, $recipeID, $pageID) {
        $html = '<div class="col-sm-7" style="padding-top: 1.8em; padding-left: 5em;">';
        if (empty($reviews)) {
            $html .= '<p class="text-muted"><strong>No reviews yet for this recipe.<strong></p></div>';
            return $html;
        }

        $html .= '<div class="list-group">';

        foreach ($reviews as $review) {
            $reviewer = htmlspecialchars($review['name']);
            $rating = (int)$review['rating'];
            $comment = nl2br(htmlspecialchars($review['comment']));
            $reviewerID = htmlspecialchars($review['reviewerID']);
            $reviewTime = self::timeAgo($review['timeCreated']);
            
            $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);

            $html .= '<div class="list-group-item">';
            $html .= '<h4 class="list-group-item-heading"><a href="index.php?pageID=viewUser&id='.$reviewerID.'" style="color: inherit;">' . $reviewer . '</a></h4>';
            $html .= '<p class="text-warning" style="color: #f9c74f; font-size: 1.2em; margin-bottom: 0.6em;">' . $stars . '</p>';
            $html .= '<p class="list-group-item-text" style="margin-bottom: 0.6em;">' . $comment . '</p>';
            $html .= '<p class="text-muted text-right"><strong>' .$reviewTime . '</strong></p>';
            $html .= '</div>';
        }

        $html .= '</div>';

        $html .= '<div class="text-center">';
        $html .= '<ul class="pagination">';
        $html .= '<li class="disabled"><a href="#">Page ' . $currentPage . ' of ' . $totalPages . '</a></li>';

        if ($currentPage > 1) {
            $html .= '<li><a href="index.php?pageID='.$pageID.'&id=' . $recipeID . '&pageReview=' . ($currentPage - 1) . '" style="text-dectoration: none; color: inherit;">Previous</a></li>';
        }

        if ($currentPage < $totalPages) {
            $html .= '<li><a href="index.php?pageID='.$pageID.'&id=' . $recipeID . '&pageReview=' . ($currentPage + 1) . '" style="text-dectoration: none; color: inherit;">Next</a></li>';
        }

        $html .= '</ul></div></div>';

        return $html;
    }
    
    public static function generateReviewListUserProfile($reviews, $currentPage, $totalPages, $pageID, $isDeletable = false) {
        if (empty($reviews)) {
            $html = '<p class="text-muted"><strong>User has not left any reviews yet.<strong></p>';
            return $html;
        }

        $html = '<div class="list-group">';

        foreach ($reviews as $review) {
            $recipeName = htmlspecialchars($review['name']);
            $rating = (int)$review['rating'];
            $comment = nl2br(htmlspecialchars($review['comment']));
            $reviewTime = self::timeAgo($review['timeCreated']);
            $recipeID = (int)$review['recipeID'];
            $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);

            $html .= '<div class="list-group-item">';
            $html .= '<h4 class="list-group-item-heading"><a href="index.php?pageID=recipeDetails&id='.$recipeID.'" style="color: inherit;">' . $recipeName . '</a></h4>';
            if ($isDeletable) {
                $html .= '<form method="post" action="index.php?pageID='.$pageID.'&id='.$recipeID.'"><button type="submit" class="btn btn-danger pull-right" name="btnDeleteReview" value="'.$recipeID.'">Delete</button></form>';
            }
            $html .= '<p style="color: #f9c74f; font-size: 1.2em; margin-bottom: 0.6em;">' . $stars . '</p>';
            $html .= '<p class="list-group-item-text" style="margin-bottom: 0.6em;">' . $comment . '</p>';
            $html .= '<p class="text-muted text-right"><strong>' .$reviewTime . '</strong></p>';
            $html .= '</div>';
        }

        $html .= '</div>';

        $html .= '<div class="text-center">';
        $html .= '<ul class="pagination">';
        $html .= '<li class="disabled"><a href="#">Page ' . $currentPage . ' of ' . $totalPages . '</a></li>';

        if ($currentPage > 1) {
            $html .= '<li><a href="index.php?pageID='.$pageID.'&id=' . $recipeID . '&pageReview=' . ($currentPage - 1) . '" style="text-dectoration: none; color: inherit;">Previous</a></li>';
        }

        if ($currentPage < $totalPages) {
            $html .= '<li><a href="index.php?pageID='.$pageID.'&id=' . $recipeID . '&pageReview=' . ($currentPage + 1) . '" style="text-dectoration: none; color: inherit;">Next</a></li>';
        }

        $html .= '</ul></div>';

        return $html;
    }
    
    /**
     * Function that generates a "time ago" string for a timestamp value. 
     * 
     * @param string $timeStamp timestamp to convert to a "time ago" string
     * @return string String containing a "time ago" value for the inputted timestamp
     */
    private static function timeAgo($timeStamp) {
        $time = strtotime($timeStamp);
        $diff = time() - $time;

        if ($diff < 60) return $diff . ' seconds ago';
        if ($diff < 3600) return floor($diff / 60) . ' minutes ago';
        if ($diff < 86400) return floor($diff / 3600) . ' hours ago';
        if ($diff < 604800) return floor($diff / 86400) . ' days ago';
        if ($diff < 2629746) return floor($diff / 604800) . ' weeks ago';
        if ($diff < 31556952) return floor($diff / 2629746) . ' months ago';

        return floor($diff / 31556952) . ' years ago';
    }
    
public static function generateUserProfileCard($user, $pageID, $canEdit = false) {
    $name = htmlspecialchars($user['firstName'] . ' ' . $user['lastName']);
    $email = htmlspecialchars($user['email']);
    $bio = empty($user['bio']) ? 'This user has not written a bio yet.' : htmlspecialchars($user['bio']);

    $html = '<div class="container-fluid">';
    $html .= '<div class="row">';
    $html .= '<div class="col-sm-12">';
    $html .= '<div class="profile-card" style="background-color: #fff; padding: 20px; margin: 20px 0; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">';
    
    $html .= '<h3 style="margin-top: 0; color: #333;">' . $name . '</h3>';
    
    $html .= '<p style="color: #555; padding-left: 0.2em;">' . $email . '</p>';
    $html .= '<p style="color: #666; padding-top: 2em;">' . $bio . '</p>';
    
    if ($canEdit) {
        $html .= '<form class="text-right" method="post" action="index.php?pageID='.$pageID.'">';
        $html .= '<input type="submit" name="btnEditProfile" value="Manage My Account" class="btn btn-success">';
        $html .= '</form>';
    }


    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>'; 
    $html .= '</div>'; 

    return $html;
}




    public static function generateFilterList($filters){
        $html = '<ul class="list-inline">';
    
        foreach ($filters as $key => $value) {
            if ($value) {
                $html .= '<li><span class="label label-default">' 
                      . htmlspecialchars($key . ': ' . $value) 
                      . '</span></li>';  
            }
        }
        $html .= '</ul>';

        return $html;
    }
}




