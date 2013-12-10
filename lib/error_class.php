<?

	/**
	*	Error Template
	*
	*	This file would be used to create the framework for error reporting
	*	It is just a simple template to show the error message to the user
	*
	*	@package				gContacts
	*	@file					error_class.php
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

	//Clean the screen whatever output has been done just clean it.
	$data = ob_get_clean();
	
	//Resetting the Output buffer
	ob_start();
	
	//Session Start for sync session
	session_start();

	
	//We are going to use XHTML5, the specification are not provided any where
	//but helpful to display html5 in old browsers like ie6
	
	echo '<'.'?xml version="1.0" encoding="utf-8"?'.">\r\n"; 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:html5="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
	<head>
		<title><? echo $error_title[$error_number]; ?></title>
		<!-- Link to CSS -->
		<link rel="stylesheet" href="css/error.css" type="text/css" />
	</head>
	<body id="error-page">
		<h1 id="logo"><img alt="WordPress" src="images/logo.png" /></h1>
	</body>
</html>