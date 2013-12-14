<?

	/**
	*	Checking Permissions
	*
	*	This file would be used to create the framework Check Permissions
	*
	*	@package				gContacts
	*	@file					check_per.php
	*	@copyright				Cee Emm Infotech, 2013-2014
	*	@author					Vineet Gupta <vineetgupta22@gmail.com>
	*	@since					1.0.0
	*
	**/

	require_once 'gContacts.php';
	
	if ( check_folder() ) {
		header("Location:/dbconfig.php");
		exit();
	}
	
	

?>