<?

	/**
	*	Autoloader
	*
	*	This file would be used to create the framework autoloader
	*	application for the purpose of loading the required libraries
	*	dynamically, so that we don't require to include all the files/
	*	library in one go. It will make the application lightweight as
	*	auto load the library according to the required things.
	*
	*
	*	@package				gContacts
	*	@file					autoloader.php
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


	//Register for autoload class handler.
	spl_autoload_register(array('gContacts_autoloader','load'));


	/**
	*	Auto loader class for gContacts loading libraries dynamically.
	**/
	abstract class gContacts_autoloader{
		/**
		*  Container for Imported class names loaded by autoloader
	    **/
		protected static $_imported = array();

		/**
		*  Container for Loaded class names loaded by autoloader
		**/
		protected static $_classes = array();

		/**
		*  Default Extension of Files used to import files
		**/
		protected static $ext = '.php';

		/**
		*  Prefex for the Class name for the loading the lass
		**/
		protected static $prefix = 'gContacts_';

		/**
		*	@var		class_name		The Name of the Class we are going to load
		*	@return		boolean			On Success True else False for any error
		**/
		public static function load($class_name){
			//We are assuming that every class which is required is stored in the
			//Library Directory of the Code and the Folder Name is the Name of the
			//Class and File name is also the same.

			//For instance DBConnect which is used for connection to the MYSQL is
			//stored under DBConnect sub folder of Library with the file-name of
			//DBConnect.php

			//Since the PHP is case sensitive and thus Name of Folder and File must
			//match with the exact name of calling. In case, it doesn't match an error
			//No.1 issued describing the File Not Found.

			// If the class already exists do nothing.
			if (class_exists($class_name)) {
				//Nothing to do much as Class already loaded
				return false;
			}else{
				//Now Sending to set the file location the file
				self::import($class_name);

				//Now Check the File Name is set
				if(self::$_imported[$class_name]){
					//It will import the file only once
					require_once self::$_imported[$class_name];
				}

				//Now Check again this time Class must present else issue Error No.2
				if (class_exists($class_name)) {
					//Now Class is available thus return from here
					return true;
				}else{
					//As file Exits but Class doesn't found 
					error_die(2, self::$_imported[$class_name]);
				}
			}
		}


		/**
		*	@var		class_name		The Name of the Class we are going to load
		*	@return						True on Success and in class error display
		*	error message and die
		**/
		public static function import($class_name){
			//Getting the correct folder location of the file
			$folder_name = self::get_folder($class_name);

			//File Name of the Class
			$file_name = self::get_file_name($class_name);

			//Now Check the Exists or not
			if ( file_exists($folder_name . $file_name ) ) {
				//Describe the location of file for importing file
				self::$_imported[$class_name] = $folder_name . $file_name;
				return true;
			}else{
				//As file doesn't Exits we Have to do Error Shutdown
				error_die(1, $folder_name . $file_name);
			}
		}

		//Getting the File Name from Class Name
		public static function get_file_name($class_name){
			//File Name would be prefix + last variable after explode
			$file = explode('_', $class_name);
			$count = count($file);
			return self::$prefix . $file[($count-1)] . self::$ext;
		}

		//Getting the Folder Name from Class Name
		public static function get_folder($class_name){
			//Now some times it happens that there Library sub folder has further
			//Sub folder then it should be described with delimiter _

			$folders = explode('_', $class_name);
			if ( count($folders) == 1 ){
				return gContacts_lib . $folders[0] . ds;
			}else{
				$folder_name=gContacts_lib;
				foreach($folders as $folder){
					$folder_name.=$folder . ds;
				}
				return $folder_name;
			}
		}

	}

?>