<?php
/**
* This file contains the Installer Class
* 
*/

/**
 * The Installer class provides the static installation methods. 
 * 
 * This class is responsible for providing the following functions:
 * 
    * MySQL Database installation
 *
 * @author Gerry Guinane 
 * 
 */


class Installer {
  
    
    
/**
 * 
 * Installs the MySQL database for this app
 * 
 * @param string $DBServer String containing address of the MySQL server
 * @param string $DBUser   String containing MySQL user ID 
 * @param string $DBPass   String containing MySQL user password
 * @param string $SQLscript String containing path to SQL script for database creation
 * @return string String containing description of result of database installation. 
 * 
 */    
public static function installDB($DBServer, $DBUser, $DBPass,$SQLscript){

//TODO Installer - add try catches and throws exception. Function needs to be integrated to the function call. 
    
    $msg= '<h3>Database installation</h3>';
    $dbConn=new mysqli($DBServer, $DBUser, $DBPass);
    if($dbConn->connect_errno){
        $msg.= '<br>**installation FAIL** ERROR NR:'.$db->connect_errno.'<br>';
        $dbConn->close();
        return $msg;
        }
        else{
            //install the database
            $sql = file_get_contents($SQLscript);
            $dbConn->multi_query($sql);
            $msg.= '<br>**Database installation SUCCESSFUL<br>';
            $dbConn->close();
            return $msg;
        }    
}


}



