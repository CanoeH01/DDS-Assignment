<?php
/**
* This HTML file contains a two panel VIEW template with navbar.  
* 
*/


/**
 * 
 * This HTML file contains a two panel VIEW template with navbar.
 * 
 * The template contains PHP placeholders for page content. The content is passed to 
 * this VIEW via the $data array
 *
 * @author gerry.guinane
 * 
 */


 /*
  * @var array $data Array containing page content elements. 
  * 
  */
extract($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $pageTitle;?></title>
<!--
--
--Load the bootstrap scripts by reference
--Note the use of the 'integrity' property
--More info on that property here: https://blog.compass-security.com/2015/12/subresource-integrity-html-attribute/
-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<link rel="stylesheet" type="text/CSS" href="css/style.css">
<script src="javascript/StickyLogo.js"></script>

<!--apply any local styles if required -->
<style type="text/css">
</style>
</head> 
    <div id="header-wrapper">
        <div class="logo-container text-center" style="background-color: #f0f0f0; padding: 0.2em 0; border-bottom: 1px solid #ddd;">
            <h1 class="logo-text">
                <span class="logo-bold">Kitchen</span><span class="logo-light">Index</span>
            </h1>
        </div>

        <!--Main SECTION--> 

        <!--Top of page Navigation menus-->    
        <nav role="navigation" class="navbar navbar-custom" id="mainNavbar">
            <div class="container">
            <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand"><?php echo $pageHeading?></a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
		<?php //foreach($menuNav as $menuItem){echo "<li>$menuItem</li>";} //populate the navbar menu items?>
                <?php echo $menuNav; ?>
            </ul>
            
            <form class="navbar-form navbar-right" role="search" method="get" action="index.php">
                <input type="hidden" name="pageID" value="viewRecipes">
                <input type="text" class="form-control" placeholder="Search Recipes" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '')?>">
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>
    </div>
</nav>


<!--Main container for page content-->  
<div class="container-fluid"> 

     
<div class="row">
    <!--Left Hand Side (LHS) content panel--> 
    <div class="col-md-6">
            <div class="panel" style="box-shadow: none;">
              <div class="panel-heading"><?php echo $panelHead_1; ?></div>
              <div class="panel-body">
                    <?php echo $panelContent_1; ?>
              </div>
            </div>
    </div>

    <!--Right Hand Side (RHS) content panel--> 
    <div class="col-md-6">
            <div class="panel" style="box-shadow: none;">
              <div class="panel-heading"><?php echo $panelHead_2; ?></div>
              <div class="panel-body">
                    <?php echo $panelContent_2; ?>
              </div>
            </div>
    </div>
</div>

</div>  <!--end of main container-->
</div>  <!--end of main container-->
                             		