<?

	/**
	*	gContacts - Single File Inclusion 
	*
	*	This file would be used to include the Library, Functions
	*	Objects working and other things. This file is used by
	*	both Projects i.e. Project for Demo and Project Developers.
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
	define('_root', realpath(dirname(__FILE__)));

	// }}}


	/**
	*	Including the Framework file to the Project, as it will further load
	*	more important Library files and create a minimum working environment.
	**/
	require_once ( _root . "/lib/framework/framework.php" );
?>