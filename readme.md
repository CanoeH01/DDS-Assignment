# 🍴 Recipe Management Web App  
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](./LICENSE)

## 📖 About this Project  
A PHP & MySQL web application for managing recipes, built as part of a college project.  
It features role-based permissions, ingredient management, and recipe creation.  

⚠️ **Note on Source Code**  
This project uses a starter MVC framework and template code provided by my lecturer, Gerry Guinane.  
All application-specific functionality (ingredients database, recipe system, and permissions) was implemented by me.  

## 🛠️ Tech Stack  
- **Language:** PHP  
- **Database:** MySQL  
- **Frontend:** HTML, CSS, JavaScript, Bootstrap  
- **Pattern:** MVC (Model–View–Controller) framework (starter code provided by lecturer)  

## 🚀 Features  
- User registration and login with different permission levels (admin, registered user, guest)  
- Ingredient database with hundreds of pre-populated pantry staples, fruits, vegetables, spices, etc.  
- Recipe creation and management (add ingredients, instructions, and details)  
- Role-based permissions:  
  - **Admin** – Full control (manage users, ingredients, and recipes)  
  - **Registered Users** – Create and manage their own recipes, view others’ recipes, and contribute ingredients  
  - **Guests** – Browse recipes and ingredients in read-only mode  
- Organized MVC structure for scalability and maintainability  


## 💻 Running the Project  
1. Clone the repository:  
   ```
   git clone https://github.com/CanoeH01/DDS-Assignment.git
   cd DDS-Assignment
   ```
2.	Enable gd extension for php inside your php.ini file if not already enabled. This can be found by opening up XAMPP control panel, choosing “config” on the Apache module, and selecting php.ini. This file can also be found in ``C:\xampp\php\php.ini``. Once file is opened in text editor, navigate to the line that says ``;extension=gd`` (was on line 931 for me) and delete the semicolon character, so it now says ``extension=gd``. Save and close php.ini. 
3.	Extract ``DDS Assignment.zip`` to ``C:/xampp/htdocs/``
4.	Visit application in browser using Apache
5.	You will be greeted with a MySQLi error, click the “Install Framework Database” button
6.	You will see an updated prompt at the bottom of the page, saying “**Database installation SUCCESSFUL” with a button below to restart the application, click this button
7.	You will be taken to index.php, from here, login with an account from the test data section and begin using the application
8.	 If you wish to turn off diagnostic information, go to ``C:\xampp\htdocs\DDS Assignment\config\config.php`` and open with a text editor. On line 26 change ``define ('DEBUG_MODE',TRUE);`` to ``define ('DEBUG_MODE',FALSE);``.

## 📜 License

This project is licensed under the MIT License – see the [LICENSE](./LICENSE) file for details.