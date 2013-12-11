<?

	/**
	*	Version
	*
	*	This file would be used to maint the version information about
	*	the project.
	*
	*
	*	@package				gContacts
	*	@file					version.php
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
	*  gContacts - Version Information and development stage inforamtion
	*
	**/
	
	final class Version{
		/**
		* 	Package Name under which development is taking place
		**/
		var $package_name = 'gContacts - XML to DB';
		
		/**
		*  Package Name under which development is taking place
		**/
		var $package_short_name = 'gContacts';
		
		/**
		*	gContacts Major Release Version for tracking of Errors and Reporting
		*	Purposes
		**/
		var $gContacts_Major_Release = "0";
		
		/**
		*	gContacts Minor Release Version for tracking of Errors and Reporting
		*	Purposes
		*/
		var $gContacts_Minor_Release = "0";
		
		/**
		*	gContacts Changes Release Version for tracking of Errors and Reporting
		*	Purposes
		*/
		var $gContacts_Changes_Release = 23;
		
		public static function getversion(){
			return new Version();
		}
		
	}

?>
