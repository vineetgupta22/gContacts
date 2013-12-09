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
	*	It is genrally seen that the developers provide there own prefix names
	*	to the files and classes to autoload the classes through autoloader. Thus, 
	*	if you are using any prefix then request you to move the location of file
	*	and change the name of file accordingly. You have to provide here the 
	*	classes name prefix so that the classes would be loaded perfectly. 
	*
	*	In case you don't use any prefix, just describe it as empty. I am setting
	*	default name as 'Law' as it is the part of our internal program.
	**/
	define('class_prefix', 'law');
	

	// }}}


	//Defining the default time zone as dynamically used by Project
	$default_gContacts_timezone = "Asia/Calcutta";


	/**
	*	Including the Framework file to the Project, as it will further load
	*	more important Library files and create a minimum working environment.
	**/
	require_once ( gContacts_root . "/lib/framework/framework.php" );
?>