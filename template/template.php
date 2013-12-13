<?

	/**
	*	Template
	*
	*	This file would be used to display template
	*
	*	@package				gContacts
	*	@file					template.php
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
	
	
	$page = $_SERVER['REQUEST_URI'];
	$page = explode('/', $page);
	
	if( strlen ( $page[1] ) > 0 ){
		$page = $page[1];
	}else{
		$page = 'home';
	}
	
	
	//This is XML Version for the IE Browsers as it is used to convert the 
	//Web Page Html5 to XML Version for IE Brosers	
	echo '<'.'?xml version="1.0" encoding="utf-8"?'.">\r\n"; 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:html5="http://www.w3.org/1999/xhtml" xml:lang="en-GB" >

	<!--Starting of HEAD Section -->
	<head>

		<!--Inclding Meta Web Tags -->
		<?  require_once gContacts_template . 'meta.php';  ?>
		<!--Ending Meta Web Tags -->

			
		<!--Starting of Titile of the Web Page -->
			<?  require_once gContacts_template . 'title.php';  ?>
		<!-- Ending of Titile of the Web Page -->

		<!--Inclding of single CSS File for all pages -->
	<? require_once gContacts_template. 'css.php'; ?>
		<!--Ending of single CSS File for all pages -->		

		<!-- Inclding JQuery if google cdn not working  -->
			<script>window.jQuery || document.write('<script src="/js/jquery.js">\x3C/script>')</script>
		<!-- Ending JQuery if google cdn not working -->

		
		<!--Inclding all other JS Scripts According the Web Page Name -->
<?  require_once gContacts_template . 'other_js.php';  ?>
		<!-- End of inclusion of all other JS Scripts -->
		
	</head>
	<!--Ending of HEAD Section -->

	<!--Starting of Body Section -->
	<body id="template">
		
		<!--Starting of static header Section -->
<?  require_once gContacts_template . 'header.php';  ?>
		<!--Ending  of static header Section -->
		
		
		<!--Starting of contents Section -->
<?  require_once 'contents.php';  ?>
		<!--Ending  of contents Section -->
		
		<!--Starting of contents Section -->
<?  require_once gContacts_template . 'footer.php';  ?>
		<!--Ending  of contents Section -->
		
	</body>
	<!--Ending of Body Section -->
</html>