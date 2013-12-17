<?

	/**
	*	Framework
	*
	*	This file would be used to create the framework for the project.
	*	This file would be used to include other important Library files
	*	as some of the files are not required by developers and thus we
	*	have to remove some of the library dynamically for the working
	*	of both Project Demo and Developers.
	*
	*
	*	@package				gContacts
	*	@file					framework.php
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

	//Starting the output buffer
	ob_start();
	
	
	if ( !defined('gContact_session') ) {
		//Session the session
		session_start();

		//Session is started here
		define('gContact_session', true);
	}
	
	

	/**
	*	Definition of directory separator to be used 
	**/
	if(!defined('ds')){
		define('ds', DIRECTORY_SEPARATOR);
	}


	/**
	*	Activation of reporting of all errors in the Project
	**/
	error_reporting(-1);

	/**
	*	Don't Display System Generated Errors
	**/
	ini_set('display_errors', '0');


	/**
	*	Defining the time-zone on time to make sure working according to 
	*	the time-zone provided. If this is not the developers version
	*	then setting the default time-zone. As now there are two files
	*	where the time-zone can be defined. One is in developer file
	*	and other is here. You can change anywhere you like
	**/
	if ( !defined('time_zone') ) {
		$default_gContacts_timezone = "Asia/Calcutta";
	}


	//Checking whether the current time zone is already set by user
	if ( ini_get('date.timezone') != $default_gContacts_timezone){
		if(function_exists('date_default_timezone_set')){
			date_default_timezone_set($default_gContacts_timezone);
		}
	}

	if (!defined('gContacts_lib') ) {
		//We need some of the Global variables so that we can use them anywhere
		define('gContacts_lib', gContacts_root. ds. 'lib'. ds);
	}

	if (!defined('gContacts_template') ) {
		//location of template i.e. view of the request
		define('gContacts_template', gContacts_root. ds. 'template'. ds);
	}
	
	if (!defined('gautoloader') ) {
		//location of autoloader class
		define('gContacts_autoloader', gContacts_lib. 'autoloader'. ds);
	}

	if (!defined('gContacts_functions') ) {
		//including the global functions of the projects
		define('gContacts_functions', gContacts_root. ds . 'function'. ds);
	}


	//Including Functions for the Project
	require_once gContacts_functions . "gContacts_functions.php";


	/**
	*	We have to Check as going to use our gContacts Error Handler
	*	or Developer's
	**/
	if ( defined('gContacts_error_handler') ){
		/**
		*	Basically there are four types of errors in PHP
		*
		*	1. Parser Error
		*
		*		It occurs when there is the syntax error/mistake in the source
		*	code A Parser Error stop the execution of the code. The reasons for
		*	parser error are:
		*
		*			- unclosed quotes
		*			- Missing or Extra parentheses
		*			- unclosed brackets
		*			- Missing semicolon
		*
		*	2. Fatal Error
		*
		*		Fatal Error are those errors which PHP Understand but some thing
		*	which can't be done. Fatal Error stops the execution of the Code. The
		*	simple example is to function references of function which is not 
		*	available in PHP or User Defined.
		*
		*	3. Warning Error
		*
		*		Warning Error doesn't stop the execution of the script. They just
		*	show the errors on the Page that something is wrong. Simple Example is
		*	include a page which doesn't exists.
		*
		*	4.	Notice Error
		*
		*		Notice Errors are same as Warning Error to notify that there 
		*	are some errors in the script that required to be corrected.
		**/

		/**
		*	PHP has three main function for Errors Handling by user itself:
		*	1. set_error_handler 			[for Handling PHP Error]
		*	2. set_exception_handler		[for Handling PHP Exception Errors]
		*	3. register_shutdown_function	[For Handling PHP Fatal or execution stop Erros]
		*
		*	Now, we are going to re-direct 3 types of error to Function and do things
		*	in Functions. We may choose our way of reporting errors
		*
		*	If you want to use the Error Handle make sure that Function must exists.
		* 	Thus, we have added the functions first then error handling and autoloader.
		**/
		//Setting for the PHP Error Handler
		set_error_handler('gContacts_error_handler');

		//Setting for the PHP Exceptions Error Handler
		set_exception_handler('gContacts_error_exception_handler');

		//Setting for the PHP Fatal Error
		register_shutdown_function('gContacts_fatal_error');
	}


	/**
	*	We now require the auto-loading of the library files. As it
	*	would help not to write require or include phrase again and
	*	again. Again it would be constructed as dynamically, so it
	*	project or developer has its own class then it can be used
	*	and this Project Autoloader not get activated.
	**/
	if ( !defined('gautoloader') ) {
		require_once gContacts_autoloader . 'autoloader.php';
	}

	gContacts_import('Version');
	$version=new Version();

	//Required for printing of page
	$page = $_SERVER['REQUEST_URI'];
	$page = explode('?', $page);
	$page = explode('/', $page[0]);


	if( strlen ( $page[1] ) > 0 ){
		$page = $page[1];
	}else{
		$page = 'home';
	}

?>