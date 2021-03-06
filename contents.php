<?

	/**
	*	Template - Contents
	*
	*	This file would be used to display template contents for specific
	*	directory file accessed.
	*
	*	@package				gContacts
	*	@file					contents.php
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
	
	if ($page == "home"){
		require_once "home_contents.php";
	}
	
	if ($page == "dbconfig.php"){
		require_once "dbcontents.php";
	}
	
	if ($page == "columns.php"){
		require_once "columns_contents.php";
	}
	

?>