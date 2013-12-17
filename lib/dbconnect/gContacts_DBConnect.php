<?

	/**
	*	Database Connection
	*
	*	This file would be used to create the framework for Database
	*	connection handling and storing things in Database
	*
	*	@package				gContacts
	*	@file					gContacts_DBConnect.php
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

	//Default returning type
	define('ARRAY_A','ARRAY_A',true);
	
	class gContacts_DBConnect{
		//We are not going to store the DB Password and the reason is that if there is
		//any error or theft then the password is saved as not provided as direct access
		//storing in class

		/** Database 	Hostname
		 *  @access 	private
		 *  @var 		string
		**/
		private $db_host;

		/** Database 	Username
		 *  @access 	private
		 *  @var 		string
		**/
		private $db_user;

		/** Database 	DB_NAME
		 *  @access 	private
		 *  @var 		string
		**/
		private $db_name;

		/** Whether the database queries are ready to start executing.
		 *  @access 	private
		 *  @var 		string
		**/
		private $ready = false;
		
		/** For Connection to multiple databases
		 *  @access 	private
		 *  @var 		string
		**/
		private $_new_link=false;
		
		/** For Table Prefix
		 *  @access 	public
		 *  @var 		string
		**/
		var $table_prefix=false;
		
		/** For Connection to multiple databases
		 *  @access 	public
		 *  @var 		string
		**/
		var $last_result=false;
		
		/**
		* Saved info of table column
		*
		* @access public
		* @var array
		*/
		var $col_info;
		
		/**
		* Saving Queries run
		*
		* @access public
		* @var array
		*/
		var $last_query;
		
		
		
		
		/**
		*	@fn		gContacts_DBConnect( $db_host, $db_user, $db_pass, $db_name, $db_prefix, $new_link)
		*	@parma[in]	$db_host		hostname for connection
		*	@parma[in]	$db_user		username for the connection
		*	@parma[in]	$db_pass		password for the connection
		*	@parma[in]	$db_name		database to be  connected
		*	@parma[in]	$new_line		for multipule connection default false
		**/
		public function gContacts_DBConnect( $db_host, $db_user, $db_pass, $db_name, $table_prefix, $new_link = false){
			//Resetting any connection if already set
			$this->reset();
			$this->db_host=$db_host;
			$this->db_user=$db_user;
			$this->db_name=$db_name;
			$this->_new_link=$new_link;
			if ( strlen ( trim ( $table_prefix ) ) > 0) {
				$this->table_prefix=$table_prefix;
			}
			$this->db_connect($db_pass);
		}
		
		/**
		*	@fn		reset
		*	@brief	un-linking already connected database
		**/
		public function reset(){
			unset($this->dbh);
			self::flush();
		}
		
		/**
		*	@fn		flush()
		*	@brief	Flushing last query and last results and other things
		**/
		public function flush(){
			$this->last_result = null;
			$this->col_info = null;
			$this->last_query = null;
		}
		
		
		/**
		*	@fn		db_connect($password = '')
		*	@parma[in]	$password		password for database connection
		*	@brief	Database Connection password is not saved in class
		*	for providing security
		**/
		public function db_connect($password = null){
			global $Error_Supress;
			if(!$this->ready){
				$Error_Supress->suppress(__FILE__, (__LINE__+1));
				$this->dbh = @mysql_connect($this->db_host,$this->db_user, $password, $this->_new_link);
				if($this->dbh){
					$this->ready = true;
					$this->select($this->db_name, $this->dbh );
				}else{
					error_die('10', __FILE__);
				}
			}
		}
		
		
		/**
		*	@fn		select($db_name, $dbh = null)
		*	@parma[in]	$db_name		Database name to be used
		*	@parma[in]	$dbh			Database Connection Handler
		*	@brief	Database to be used selected
		**/
		public function select($db_name, $dbh = null){
			if(is_null($dbh)){
				$dbh = $this->dbh;
			}
			if (mysql_select_db( $db_name, $dbh ) ){
				$this->ready = true;
			}
		}
	}
?>