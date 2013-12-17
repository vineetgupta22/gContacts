<?

	/**
	*	Error Class
	*
	*	This file would be used to create the framework for error reporting
	*	It do the things according to the error.
	*
	*	@package				gContacts
	*	@file					gContacts_error.php
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

	class Error_Supress{

		var $supress=array();
	
		function suppress($file, $line){
			$this->supress[$line]=$file;
		}
		
		function check($file, $line){
			$return=false;
			foreach($this->supress as $cline => $cfile){
				if ( $cline === $line and $cfile===$file) {
					$return=true;
					break;
				}
			}
			return $return;
		}
	}
	
?>