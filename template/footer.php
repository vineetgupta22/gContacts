<?

	/**
	*	Template - Footer
	*
	*	This file would be used to display template include Footer
	*
	*	@package				gContacts
	*	@file					footer.php
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
<html5:footer>
	<div id="ftext">
	<?
		if (isset($version)){
			echo $version->copyright();
		}
	?>
	</div>
</html5:footer>
