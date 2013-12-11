<?

	/**
	*	Functions
	*
	*	This file would be used to create function dynamically. Each function
	*	has its own meaning thus required to used with developer configuration
	*	syntax.
	*
	*	@package				gContacts
	*	@file					gContacts_functions.php
	*	@copyright				Cee Emm Infotech, 2013-2014
	*	@author					Vineet Gupta <vineetgupta22@gmail.com>
	*	@since					1.0.0
	*	
	**/

	/**
	*	If the variable is not defined then somebody is trying to access files
	*	not through MVC and restrictions from doing such thing.
	**/
	defined('gContacts') or die('Direct Access to the File is Prohibited');

	//If we are not using developer script then use our own error reporting
	if ( !defined('own_error_die') ) {
		//Own Error reporting tool for own error numbers
		function error_die($error_number, $file_location){
			//This is our reporting system
			$error_details = array(
				1 => "File doesn't Available at the location Provided",
				2 => "File Exists at the location but Class is not available in File",
				0 => "Kindly Add the Error Number",
			);
			
			//HTML Page title for error types
			$error_title = array(
				0 => "Error Number not Found",
				1 => "File Not Found",
				2 => "Class Not Found",
			);
			
			if ( isset ( $error_details[$error_number]) ) {
				//If the template of error exits then
				if ( file_exists ( gContacts_template . 'steup_error.php') ) {
				}else{
					if ( file_exists ( gContacts_lib . 'error_class.php') ) {
						//else display error message
						require_once gContacts_lib . 'error_class.php';
					}else{
						die('Some Files are missing. Kindly Download the Project Again.');
					}
				}
			}else{
				$message = $error_details[0] . $error_number . " in the Project";
				$error_number =0;
				if ( file_exists ( gContacts_lib . 'error_class.php') ) {
					//else display error message
					require_once gContacts_lib . 'error_class.php';
				}else{
					die('Some Files are missing. Kindly Download the Project Again.');
				}
			}
		}
	}
	
	//We have to implement our own error Handler
	if ( ! defined('own_error_handing') ){
		define('gContacts_error_handler', true);
	}

?>
