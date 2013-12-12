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

	/**
	*	gContacts_import
	*
	*	Function is used to import the library files in the Project
	*	this is the dynamic function for doing things
	**/
	if ( !defined('own_import_function') ) {
		function gContacts_import($class_name){
			gContacts_autoloader::import($class_name);
		}
	}
	
	/**
	*	go
	*
	*	Function go is used to print array as each time we use print_r
	*	prints but nothing is understandable and thus to do understanding
	*	printing of print_r using go function
	**/
	function go($abc = array()){
		echo '<pre>';
		print_r($abc);
		echo '</pre>';
	}


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
						//Template printing class is missing and thus through an die error
						die('Some Files are missing. Kindly Download the Project Again.<br>'.$file_location);
					}
				}
			}else{
				$message = $error_details[0] . $error_number . " in the Project";
				$error_number =0;
				if ( file_exists ( gContacts_lib . 'error_class.php') ) {
					//else display error message
					require_once gContacts_lib . 'error_class.php';
				}else{
					//Template printing class is missing and thus through an die error
					die('Some Files are missing. Kindly Download the Project Again.<br>' . $file_location);
				}
			}
		}
	}
	
	//We have to implement our own error Handler
	if ( ! defined('own_error_handing') ){
		/**
		*	Functions are loaded before auto loader or any thing other loaded.
		*	For Error Reporting we need to determine whether Developer version
		*	is being used or Demo Version is used.
		**/
		define('gContacts_error_handler', true);


		/**
		*	As We need the Version information to print the details thus
		*	small function to get the version information
		**/
		function check_version($version = null){
			if(!is_object($version)){
				if (!class_exists('Version')) {
					gContacts_import('Version');
					$a = new Version();
					return $a->getversion();
				}
			}else{
				return $version->getversion();
			}
		}


		/**
		*	gContacts_error_handler
		*
		*	gContacts Error Handler function
		**/
		function gContacts_error_handler($number=null, $message=null, $file=null, $line=null, $context=null){
			global $version;
			$version = check_version($version);
		}


		/**
		*	gContacts_error_exception_handler
		*
		*	gContacts Error Exception Handler function
		**/
		function gContacts_error_exception_handler($number=null, $message=null, $file=null, $line=null, $context=null){
			global $version;
			$version = check_version($version);
		}

		/**
		*	gContacts_fatal_error
		*
		*	gContacts Fatal Error Handling function
		**/
		function gContacts_fatal_error(){
			global $version;
			$version = check_version($version);
			$error_last = error_get_last();
			if ( $error_last['type'] > 0 ) {
				new Error($version, 16, $error_last["message"], $error_last['file'], $error_last['line'], 'gContacts_fatal_error');
				return true;
			}
		}
	}
?>
