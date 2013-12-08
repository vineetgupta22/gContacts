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
	*	@file					gContacts.php
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


?>