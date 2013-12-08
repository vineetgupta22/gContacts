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
	define('_root', realpath(dirname(dirname(__FILE__))));

	/**
	*	if you are defining it then constant that we have described time zone here.
	*	Whatever time zone is described here it will help to override default 
	*	settings used in Demo Project.
	**/
	define('time_zone', true);

	// }}}


	//Defining the default time zone as dynamically used by Project
	$default_gContacts_timezone = "Asia/Calcutta";


	/**
	*	Including the Framework file to the Project, as it will further load
	*	more important Library files and create a minimum working environment.
	**/
	require_once ( _root . "/lib/framework/framework.php" );
?>