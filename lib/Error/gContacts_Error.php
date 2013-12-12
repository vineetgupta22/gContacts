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

	class Error extends Exception{

		/**
		*	Storing the Version Information
		*	@since		1.0.0
		**/
		var $version;

		/**
		*	Error Message Received
		*	@since		1.0.0
		**/
		var $message;

		/**
		*	Error Number
		*	@since		1.0.0
		**/
		var $error_no;

		/**
		*	Error on Line Number
		*	@since		1.0.0
		**/
		var $error_line;

		/**
		*	Error File location
		*	@since		1.0.0
		**/
		var $error_file;

		/**
		*	We have 3 error handling function from which function it is sent
		*	@since		1.0.0
		**/
		var $function_from;

		/**
		*	PHP inbuilt error Number and Error type already provided. Thus, we
		*  also have to catch the errors described by the PHP for the working
		*  and reporting purposes.
		*	@var		array		PHP inbuilt errors
		**/
		var $gContacts_inbuilt_errors = array(
			1=>'E_ERROR',
			2=>'E_WARNING',
			4=>'E_PARSE',
			16=>'E_CORE_ERROR',
			32=>'E_CORE_WARNING',
			64=>'E_COMPILE_ERROR',
			128=>'E_COMPILE_WARNING',
			256=>'E_USER_ERROR',
			512=>'E_USER_WARNING',
			1024=>'E_USER_NOTICE',
			2048=>'E_STRICT',
			4096=>'E_RECOVERABLE_ERROR',
			8192=>'E_DEPRECATED',
			16384=>'E_USER_DEPRECATED',
		);

		/**
		*	Now, we have to also provide the error Numbers and Error type for 
		*  providing the better solution to the error and study what is the 
		*	error reason of the error and repair them easily.
		*
		*	Waring errors defined errors
		*	@var		array		PHP inbuilt errors
		**/
		var $_law_warning_errors = array();


		public function __construct(Version $v=null, $eno=null, $message=null, $file=null, $line=null, $from=null){

			//Setting the version information
			$this->version=$v;

			//Error Number received
			$this->error_no=$eno;

			//Error Message
			$this->message=$message;

			//Error Line
			$this->error_line=$line;

			//Error File
			$this->error_file=$file;

			//Function from
			$this->function_from=$from;

			//Now we have to check whether the error is system described or not
			if(self::check_system_error()){
				if ( file_exists(gContacts_template . 'system_error.php') ){
					//Print the Error
					require_once gContacts_template . 'system_error.php';
					die();
				}else{
					die('Some Files are missing. Kindly Download the Project Again.');
				}
			}
		}


		/**
		 *	checking the inbuilt PHP error or not
		 *
		 *	@var	integer		Error Number
		 *	return 	boolean		if PHP error described return true else false
		**/
		public function check_system_error($error_number){
			//Assuming the error is not PHP inbuilt
			$found=false;
			if($this->error_no > 0){
				foreach($this->gContacts_inbuilt_errors as $key => $value){
					if($key == $this->error_no or $value === $this->error_no){
						$this->_error_no = $value;
						$found=true;
						break;
					}
				}
			}
			return $found;
		}
	}
?>