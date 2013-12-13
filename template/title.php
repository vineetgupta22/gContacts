<?

	/**
	*	Template - Title
	*
	*	This file would be used to display template Title Tags
	*
	*	@package				gContacts
	*	@file					title.php
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
?>
<title>
<?
	if ($page == "home"){
		echo "Welcome to gContacts";
	}
?>
</title>