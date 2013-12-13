<?

	/**
	*	Developers
	*
	*	This file would be used by developers as configuration
	*	file. It would be used to intigrate in there own Projects.
	*	As it would provide the clean direct access to the 
	*	libaray required by us.
	*
	*	@package				gContacts
	*	@file					gContacts.php
	*	@copyright				Cee Emm Infotech, 2013-2014
	*	@author					Vineet Gupta <vineetgupta22@gmail.com>
	*	@since					1.0.0
	*
	**/


	// {{{ constants

	/**
	*	Preprocessor to be included in every file for checking how the
	*	user is accessing the file it is required to be defined and if
	*	not defined then code/class/function not included but die at the 
	*	instance. To make impossible to access page without controller. 
	*	An implementation and working for MVC.
	**/
	define('gContacts', true);

	/**
	*	Current Location of the Directory required to include other files
	*	and library to the Project Dynamically. The location of file is 
	*	important as to Dynamically include Library and Functions files
	**/
	define('gContacts_root', realpath(dirname(dirname(__FILE__))));

	/**
	*	if you are defining it then constant that we have described time zone here.
	*	Whatever time zone is described here it will help to override default 
	*	settings used in Demo Project.
	**/
	define('time_zone', true);
	
	/**
	*	If you have your own autoloader class in the project then it is important
	*	to set constant gautoloader to true. It will not load the gautoloader
	*	instead we will be using your autoloader class
	**/
	define('gautoloader', true);
	
	
	/**
	*	It is generally seen that the developers provide there own prefix names
	*	to the files and classes to autoload the classes through autoloader. Thus, 
	*	if you are using any prefix then request you to move the location of file
	*	and change the name of file accordingly. You have to provide here the 
	*	classes name prefix so that the classes would be loaded perfectly. 
	*
	*	In case you don't use any prefix, just describe it as empty. I am setting
	*	default name as 'Law' as it is the part of our internal program.
	**/
	define('class_prefix', 'law.');
	

	/**
	*	It is also seen that some times developers have own kind of Error Reporting
	*	function or tools. To deprecate the gContacts error reporting function we are
	*	using the constant error_report. It is true it will not implement gContacts
	*	error reporting function but we have create the dummy function here to call
	*	developers error reporting tool.
	**/
	define('error_report', true);
	
	/**
	*	If the developer is providing own location of root directory then he must define
	*	location of other directories are required by the framework for wokring
	**/
	if ( defined('gContacts_root') ) {
		
		//If we are using the Project library location of library then
		//it would be
		if ( !defined('gContacts_lib') ) {
			//Kindly change this to your own location of library 
			define('gContacts_lib', _lib);
		}
		
		//location of autoloader class in case gautoloader is not defined.
		if ( !defined('gautoloader') ) {
			//location of autoloader class
			define('gContacts_autoloader', gContacts_lib. 'autoloader'. ds);
		}
		
		//location of global functions
		if ( ! defined('gContacts_functions') ) {
			//including the global functions of the projects
			define('gContacts_functions', _lib);
		}
		
		//Error reporting or other things
		if ( !defined('gContacts_template') ) {
			//location of template i.e. view of the request
			define('gContacts_template', _template);
		}
	}
	
	
	/**
	*	If developer want to use its own error reporting tools then
	*	describe the constant own_error_die as true to skip the function
	*	in functions directory
	**/
	define('own_error_die', true);
	
	
	/**
	*	In Various Project Developers have there own Error Handling
	*	Classes or Functions thus we block the usage of gContacts
	*	Error Handler. Define as false if developer doesn't have its
	*	its own error handling
	**/
	define('own_error_handing', true);
	

	// }}}

	//Function for error reporting tool.
	function error_die($error_number, $file_location){
		//Here I am provided the error details about its message and number used
		//You can change it according to your needs

		//This is our reporting system
		$error_details = array(
			1 => "File doesn't Available at the location Provided",
			2 => "File Exists at the location but Class is not available in File",
		);


		//Change the error number to report in developer correctly
		$new_error_number = array(1 => 5, 2 => 20);

		$new_error_message = array(
			5 => 'File is not Available at Current Location',
			20 => 'Kindly Provide the correct location of Class or Create a New Class',
			25 => 'Kindly Provide the Correct Number of Error Reporting',
		);

		//Provided your reporting system and call according to it.
		if ( isset ( $new_error_number[$error_number]) ){
			//Calling your error function
			error_class(
						$new_error_number[$error_number], 
						$file_location,
						$new_error_message[$new_error_number[$error_number]]
			);
		}else{
			error_class(25, __FILE__, $new_error_message[25]);
		}
	}


	//Defining the default time zone as dynamically used by Project
	$default_gContacts_timezone = "Asia/Calcutta";

	/**
	*	We are using simple gContacts_import to load library 
	*	dynamically. You have the option to use library import
	*	function but remember autoloader of library must be enabled
	*	for using this functions
	**/
	define('own_import_function', true);
	
	/**
	*	Create your function form importing class
	**/
	if ( defined('own_import_function')){
		function gcontacts_import($class_name){
			//Your own Function for importing class
			law_import(class_prefix.$class_name);
		}
	
		//gContacts Provided its own Version information and to override that
		class Version extends Law_Version{
			//Returning Version Information from  your class
			function getversion(){
				return parent::copyright();
			}
		}
	}
	

	/**
	*	Including the Framework file to the Project, as it will further load
	*	more important Library files and create a minimum working environment.
	**/
	require_once ( gContacts_root . "/lib/framework/framework.php" );
?>