CodeIgniter - BaseCode
====================

Requirements
Apache 2+, PHP 5.3+, Database server (MySQL, Postgres or MsSQL)
you must be familiyer with Codeigniter framework and depth knowledge in OOP will enhance your speed of development.

Summery
BaseCode has been develop to support and enhance the speed of the development in custom web applications and CMS's using Codeigniter framework

basecode alredy coded all your crud operations and include lots of house keeping work.


Basecode Design
Controller structure
Basecode being desing using two levels of controller classes
level 1
My_Controller - holds all methods and controllers common to the system
level 2
Admin_Controller - holds all methods and controllers common to admin users / backend users
Frontend_Controller - holds all methods and controllers common to fronend users

custom controllers should be extend from level 2 controllers, so that all level and accesswrite are maintained throughout the whole hierarchy.

Model structure
all model should be extented from MY_Model which content whole crud operations which will inherit on such acction.
you just need to add data according to your table which is corresponding to the model
Please gothow sample before proceed

View structure
each controller have a seperate view folder and generally each folder maintain main 3 files
1. edit.php - which contain a form and uses in editing and updating
2. index.php - which contatin a list of record 
3. view.php - data view page 
