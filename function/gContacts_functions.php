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
	
	
	function check_folder(){
		$dir = gContacts_root . ds . 'input';
		if ( !file_exists($dir) ) {
			if ( @mkdir($dir, 0766) ) {
				if (is_writable($dir)) {
					return true;
				}else{
					die('Some Error Here');
				}
			}else{
				require_once gContacts_template . 'permission.php';
			}
		}else{
			if (is_writable($dir)) {
				return true;
			}else{
				error_die(5, gContacts_root . ds . 'input');
			}
		}
	}


	//If we are not using developer script then use our own error reporting
	if ( !defined('own_error_die') ) {
		//Own Error reporting tool for own error numbers
		function error_die($error_number, $file_location){
			//This is our reporting system
			$error_details = array(
				1 => "File doesn't Available at the location Provided",
				2 => "File Exists at the location but Class is not available in File",
				5 => "Change Permission to Write of Input Folder",
				0 => "Kindly Add the Error Number",
			);
			
			//HTML Page title for error types
			$error_title = array(
				0 => "Error Number not Found",
				1 => "File Not Found",
				2 => "Class Not Found",
				5 => "Change Permission",
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
	
	/**
	*	Function to do Beautify of JSON for CLI and GUI
	**/
	function indent($json) {
		//Returning Strings
		$result      = '';

		//Position
		$pos         = 0;

		//Lenght of original json encoded string
		$strLen      = strlen($json);

		//Providing indent to Beautify
		$indentStr   = '&nbsp;&nbsp;  ';

		//New Line to Beautify
		$newLine     = "<br/>\n";

		//Need to store any Previous Characters
		$prevChar    = '';

		//Out of JSON Quotes
		$outOfQuotes = true;

		//Running character by character
		for ($i=0; $i<=$strLen; $i++) {
			// Grab the next character in the string.
			$char = substr($json, $i, 1);

			// Are we inside a quoted string?
			if ($char == '"' && $prevChar != '\\') {
				$outOfQuotes = !$outOfQuotes;

				// If this character is the end of an element,
				// output a new line and indent the next line.
			} else if(($char == '}' || $char == ']') && $outOfQuotes) {
				$result .= $newLine;
				$pos --;

				for ($j=0; $j<$pos; $j++) {
					$result .= $indentStr;
				}
			}

			// Add the character to the result string.
			$result .= $char;

			// If the last character was the beginning of an element,
			// output a new line and indent the next line.
			if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
				$result .= $newLine;
				if ($char == '{' || $char == '[') {
					$pos ++;
				}

				for ($j = 0; $j < $pos; $j++) {
					$result .= $indentStr;
				}
			}
			$prevChar = $char;
		}
		return $result;
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
					return new Version();
				}
			}else{
				return new Version();
			}
		}
		
		
		function trace_error ( $debug = array () ){
			$err = array();
			if( is_array ( $debug )){
				foreach($debug as $k => $v){
					if($k == 0){
						if( is_array ( $v )){
							foreach($v as $k1 => $v1){
								if($k1 === 'args'){
									foreach($v1 as $k2 => $v2){
										if ( ! is_array ($v2) ){
											$err[$k][$k2]=$v2;
										}
									}
								}
							}
						}
					}
					if($k>0){
						$err[$k]=$v;
					}
				}
			}
			return $err;
		}
		


		/**
		*	gContacts_error_handler
		*
		*	gContacts Error Handler function
		**/
		function gContacts_error_handler($number=null, $message=null, $file=null, $line=null, $context=null){
			global $version;
			$version = check_version($version);
			$error = trace_error(debug_backtrace());
			if(!$file){
				$debug = debug_backtrace() ;
				if($debug){
				}else{
					die('Something Fishy happened');
				}
			}else{
				if ( $file != "/home/lawmirr/beta/function/gContacts_functions.php" and $line != 53){
					new Error($version, $number, $message, $file, $line, $context, 'gContacts_error_handler');
				}else{
					require_once gContacts_template . 'permission.php';
					die();
				}
			}
		}


		/**
		*	gContacts_error_exception_handler
		*
		*	gContacts Error Exception Handler function
		**/
		function gContacts_error_exception_handler($number=null, $message=null, $file=null, $line=null, $context=null){
			global $version;
			$version = check_version($version);
			$error = trace_error(debug_backtrace());
			if(!$file){
				$debug = debug_backtrace() ;
				if($debug){
					$debug = debug_backtrace() ;
					new Error($version, $number, $message, $debug[0]['file'], $debug[0]['line'], $debug[0]['trace'], 'gContacts_error_exception_handler');
				}else{
					die('Something Fishy happened');
				}
			}else{
				new Error($version, $number, $message, $file, $line, $context, 'gContacts_error_exception_handler');
			}
		}

		/**
		*	gContacts_fatal_error
		*
		*	gContacts Fatal Error Handling function
		**/
		function gContacts_fatal_error(){
			global $version;
			$version = check_version($version);
			$error = error_get_last();
			if ( $error['type'] > 0 ) {
				new Error($version, 16, $error["message"], $error['file'], $error['line'], null, 'gContacts_fatal_error');
				return true;
			}
		}
	}
	
	
	
	
?>
