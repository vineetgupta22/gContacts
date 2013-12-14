<?

	/**
	*	Permission
	*
	*	This file would be used to create the tempate for permission 
	*	required for create folder and write access to file.
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
	
	//Clean the screen whatever output has been done just clean it.
	$data = ob_get_clean();
	
	//Resetting the Output buffer
	ob_start();
	
	function direcotry_exits($list = array(), $dir){
			$found=false;
			foreach($list as $dir_list){
				if ($dir_list === $dir){
					$found=true;
					break;
				}
			}
			return $found;
		}
	
	
	if ( isset($_POST['username']) ) {
		echo "FTP Information Provided<br>";
		
		/**
		*	The Major Problem while using FTP PHP is to reach the location
		*	of the location of root directory of the Project.
		*
		*	If we connect through FTP the base directory is the parent/root
		*	directory for the FTP but actually that is not the base directory
		*	for our project.
		*	
		*	We have to reach the root directory of our Project. For identification
		*	that we have reached the Project Directory we have see the existence
		*	of gContacts.php file in the directory. That would be the only way to
		*	confirm that we have reached the gContacts root directory.
		*
		*	our gContacts constant includes things are:
		*	1.	Location of Root Directory of domain
		*	2.	Location of Host Root Directory current domain [may be sub domain]
		*	3. 	Location of Project Root Directory [gContacts]
		*
		*	First we have to identify the root directory of primary/all domain
		*	for that we would use open basedir with is a variable of php.ini
		*	the root directory must be provided there.
		*	
		*	Next, thing is that open_basedir would have provides multiple base
		*	directories and how to identify the correct root directory. Our 
		*	Project root directory includes location for root directory.
		*
		*	Multiple directories explode into array and how subtract each directory
		*	from project directory. Where the subtraction actually take place that
		*	is our root directory
		*
		*
		*	Our Project Root Directory as:
		*
		*	------------------       ------------------------      --------------------------
		*	| Root Directory |   +   | Domain Root Directory |  +  | Project Root Directory |
		*	------------------       ------------------------      --------------------------
		*			||						||							||
		*		    ----------------------------|-------------------------
		*	    After FTP Login We can be standing any where from these three location
		*									||
		*						Identify the Root Directory
		*									||
		*					Root Directory Identified from open_dir
		*									||
		*			Project Root Directory - Domain Root = sub directories from domain root
		*									||
		*			Domain Root = $_SERVER['DOCUMENT_ROOT'] - Root = Sub directories from 
		*															root to domain root
		*		Now, we have identify current location of FTP
		*
		*	If, we suppose that we are standing at root directory then we have to cd to 
		*	domain root. If issues error we are not standing here. If no error then cd
		*	to sub directories to project then project file must exits there. If the file
		*	exists we are standing to root directory
		**/
		
		//Location we have reach
		$our_root_directory = gContacts;

		//Open directory includes root directory
		$open_dir=ini_get('open_basedir');
		
		//Splitting each directory
		$split = explode(':', $open_dir);
		
		foreach($split as $v){
			$original_len = strlen($our_root_directory);
			$temp = str_replace($v, '', $our_root_directory);
			if ( strlen($temp) < $original_len ) {
				$root_directory = $v;
				break;
			}
		}
		
		$domain_root = $_SERVER['DOCUMENT_ROOT'];
		$subdirectories_for_domain_root = str_replace($root_directory, '', $_SERVER['DOCUMENT_ROOT']);
		$subdirectories_for_project_root_from_domain_root = str_replace($_SERVER['DOCUMENT_ROOT'], '', $our_root_directory);
		
		//Removing first "/"
		if ($subdirectories_for_domain_root[0]=="/") $subdirectories_for_domain_root = substr($subdirectories_for_domain_root,1);
		if ($subdirectories_for_project_root_from_domain_root[0]=="/") $subdirectories_for_project_root_from_domain_root = substr($subdirectories_for_project_root_from_domain_root,1);
		
		//Removing Last "/"
		$subdirectories_for_domain_root=rtrim($subdirectories_for_domain_root, '/');
		$subdirectories_for_project_root_from_domain_root=rtrim($subdirectories_for_project_root_from_domain_root, '/');
		
		
		echo "This is Root Directory location = " . $root_directory . '<br>';
		echo "This is Domain Root Directory location = " . $_SERVER['DOCUMENT_ROOT'] . '<br>';
		echo "This is Project Root Directory location = " . gContacts . '<br>';
		
		
		//Connect to FTP Server
		$ftp_server = $_SERVER['HTTP_HOST'];
		
		//Connect to it
		$conn_id = ftp_ssl_connect($ftp_server); 
		
		//Provided by post
		$ftp_user_name = $_POST['username'];
		$ftp_user_pass = $_POST['password'];
		
		//Login to it
		$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
		
		
		//Checking connection
		ftp_pasv($conn_id, true); 
		
		
		if ((!$conn_id) || (!$login_result)) {
			echo "FTP connection has failed!";
			echo "Attempted to connect to $ftp_server for user $ftp_user_name";
			exit;
		}else{
			echo "Connected to $ftp_server, for user $ftp_user_name<br/><br/>";
		}
		
		
		//If we are standing at Root Directory then 
		$minimum_possiblity = $root_directory;
		
		//Now check the following directories and sub-directories exits
		//at current location with domain root
		
		//These can be many subdirectories each splitted by ds
		$check_directories = $subdirectories_for_domain_root;
		
		$split_directories = explode(ds, $check_directories);
		
		//List of current files and directories in ftp current location
		$directory_files = ftp_nlist($conn_id, ".");
		
		go($split_directories);
		
		$we_are_here = "";
		
		$found=false;
		foreach($split_directories as $dir){
			if( direcotry_exits($directory_files, $dir) ) {
				//Current directory name exits
				$found=true;
				
				//Now can the directory location to dir
				ftp_chdir ( $conn_id , $dir );
				
				//Now change the Directory List of Files
				$directory_files = ftp_nlist($conn_id, ".");
				
				$we_are_here.=$dir.ds;
			}else{
				if ( ! $found){
					$not_found_correct_location.=$dir.ds;
				}else{
					die('This Situation will not Rise');
				}
			}
		}
		
		echo "We are here = " . $we_are_here . '<br>';
		echo "Not the current directory_location = " . $not_found_correct_location . '<br>';
		
		//These can be many subdirectories each splitted by ds
		$check_directories2 = $subdirectories_for_project_root_from_domain_root;
		$split_directories = explode(ds, $check_directories2);
		
		go($split_directories);
		
		$found=false;
		foreach($split_directories as $dir){
			if( direcotry_exits($directory_files, $dir) ) {
				//Current directory name exits
				$found=true;
				
				//Now can the directory location to dir
				ftp_chdir ( $conn_id , $dir );
				
				//Now change the Directory List of Files
				$directory_files = ftp_nlist($conn_id, ".");
				
				$we_are_here.=$dir.ds;
			}else{
				if ( ! $found){
					$not_found_correct_location.=$dir.ds;
				}else{
					die('This Situation will not Rise');
				}
			}
		}
		
		
		echo "We are here = " . $we_are_here . '<br>';
		echo "Not the current directory_location = " . $not_found_correct_location . '<br>';
		
		
		//current parent location of ftp login root_directory + not found correct location
		$ftp_root = $root_directory.ds;
		if ( $not_found_correct_location ){
			$ftp_root.=$not_found_correct_location;
		}
		
		echo "Ftp Login to Location at " . $ftp_root . '<br>';
		echo "Ftp Current Location at " . gContacts;
		
		
		//Create directory with write permission and redirect to root again after checking
		if ( ftp_mkdir ( $conn_id , "input" ) ) {
			if ( ftp_chmod($conn_id, 0766, 'input') ) {
		
				ftp_close($conn_id);
				
				if ( check_folder() ) {
					header("Location:/dbconfig.php");
				}else{
					echo 'ERROR is here';
				}
			}
		}else{
			echo "There was a problem while creating dir\n";
		}
		
		
		die();
		
	}
	
	
	
	//We are going to use XHTML5, the specification are not provided any where
	//but helpful to display html5 in old browsers like ie6
	
	echo '<'.'?xml version="1.0" encoding="utf-8"?'.">\r\n"; 
?>
<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" xmlns:html5="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
	<head>
		<title>Permission</title>
		
		<!-- Link to CSS -->
		<link rel="stylesheet" href="css/error.css" type="text/css" />
	</head>
	<body id="error-page">
		<h1 id="logo"><img alt="gContacts" src="images/logo.png" /></h1>
		<div class='error'>
			<ol>
				<li>We Need Some Write Access to the Directories for proper working</li>
				<li>Kindly Create "input" folder in root directory of Project with write permission "0666".</li>
				<li>Kindly Provide the Write Permission - "0666" to Files:</li>
				<li>If you don't know how to do it. Kindly Provide the FTP information below</li>
			</ol>
		</div>
		<br/><br/>
		<form method="post">
			<table style='width:100%;border:1px solid #000;padding:5px;'>
				<tr>
					<th>
						Provide FTP Information
					</th>
				</tr>
				<tr>
					<td>
						<table style='width:100%;border:1px solid #000;'>
							<tr>
								<td style='width:25%;padding:15px;'>
									<b>User Name: </b>
								</td>
								<td style='width:25%'>
									<input type='text' name='username' value='' size="50"/>
								</td>
								<td style='width:25%'>
									<b>Password: </b>
								</td>
								<td style='width:25%'>
									<input type='text' name='password' value='' size="50"/>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<div style='width:100%;text-align:center;margin-top:15px;'>
							<input type='submit' name ='submit' value='submit'/>
						</div>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
	

<?
	die();
?>