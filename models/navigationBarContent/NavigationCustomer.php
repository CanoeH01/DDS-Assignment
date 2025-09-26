<?php
/**
* This file contains the NavigationCustomer Class
* 
*/

/**
 * 
 * NavigationCustomer class is a model class that implements the content generation for the
 * page navigation bar for a logged in CUSTOMER user.  
 * 
 * @author Gerry Guinane
 * 
 */

class NavigationCustomer implements NavigationInterface {
    
        /**
         *
         * @var boolean $loggedin User logged in state 
         */
        protected $loggedin; 

        /**
         *
         * @var String $modelType Identifues this navigation model type  
         */
        protected $modelType; 

        /**
         *
         * @var String $pageID The currently selected page
         */
        protected $pageID;   

        /**
         *
         * @var array $menuNav An array of menu items  
         */
        protected $menuNav;    

        /**
         *
         * @var User $user  The current user object. 
         */
        protected $user;     

        
	/**
         * Class constructor. 
         * 
         * @param User $user The current user object.
         * @param string $pageID The currently selected page
         */
	function __construct($user,$pageID) {               
            $this->loggedin=$user->getLoggedInState();
            $this->modelType='NavigationCustomer';
            $this->user=$user;
            $this->pageID=$pageID;
            $this->setmenuNav();
	}

        /**
         * Method to prepare the navigation menu depending on the currently selected page ID. 
         * 
         * This method implements handlers for each page ID.  It prepares a HTML list item string
         * containing the menu items that will appear in the view. This string may be returned using the 
         * getMenuNav() method of this class.
         * 
         * If a user is not properly logged in it force redirects to the website home page. 
         * 
         */
        public function setmenuNav(){//set the menu items depending on the users selected page ID
            
            //empty string for menu items
            $this->menuNav='';

            if($this->loggedin){ 
                //handlers for logged in user
                switch ($this->pageID) {

                    case "viewUser":
                        $this->menuNav.=' <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myProfile">My Profile</a></li>';
                        $this->menuNav.='<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Recipes <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=addRecipe">Create Recipe</a></li>
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewRecipes">View Recipes</a></li>
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myFavourites">My Favourites</a></li>
                                            </ul>
                                        </li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;
                    
                    case "myProfile":
                        $this->menuNav.='<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Recipes <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=addRecipe">Create Recipe</a></li>
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewRecipes">View Recipes</a></li>
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myFavourites">My Favourites</a></li>
                                            </ul>
                                        </li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;
                    case "addRecipe":
                        $this->menuNav.=' <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myProfile">My Profile</a></li>';
                        $this->menuNav.='<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Recipes <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewRecipes">View Recipes</a></li>
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myFavourites">My Favourites</a></li>
                                            </ul>
                                        </li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';;
                        break;
                    
                    case "viewRecipes":
                        $this->menuNav.=' <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myProfile">My Profile</a></li>';
                        $this->menuNav.='<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Recipes <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=addRecipe">Create Recipe</a></li>
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myFavourites">My Favourites</a></li>
                                            </ul>
                                        </li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;
                    case "recipeDetails":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myProfile">My Profile</a></li>';
                        $this->menuNav.='<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Recipes <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=addRecipe">Create Recipe</a></li>
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewRecipes">View Recipes</a></li>
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myFavourites">My Favourites</a></li>
                                            </ul>
                                        </li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;
                   
                    default:
                        $this->menuNav.=' <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myProfile">My Profile</a></li>';
                        $this->menuNav.='<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Recipes <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=addRecipe">Create Recipe</a></li>
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewRecipes">View Recipes</a></li>
                                                <li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myFavourites">My Favourites</a></li>
                                            </ul>
                                        </li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;
            }
      
        } 
        else{
            header("Location: index.php?pageID=myProfile");
        } 
    }

        /**
         * Getter to return the HTML menu string. 
         * 
         * @return string Containing  a HTML list item string containing the menu items that will appear in the view.
         */        
        public function getMenuNav(){return $this->menuNav;}    

        /**
         * Dumps diagnostic information in HTML format relating to the class properties
         */        
        public function getDiagnosticInfo(){

            echo '<!-- NAVIGATION CUSTOMER CLASS PROPERTY SECTION  -->';
                echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV
                    
                    echo '<h3>NAVIGATION CUSTOMER (CLASS) properties</h3>';
                    echo '<table border=1 border-style: dashed; style="background-color: #EEEEEE" >';
                    echo '<tr><th>PROPERTY</th><th>VALUE</th></tr>';                        
                    echo "<tr><td>pageID</td>   <td>$this->pageID</td></tr>";
                    echo "<tr><td>menuNav</td>  <td>$this->menuNav      </td></tr>";
                    echo '</table>';
                    echo '<p><hr>';
                echo '</div>';            
            echo '<!-- END NAVIGATION CLASS PROPERTY SECTION  -->';
            
 }      

 
}
        