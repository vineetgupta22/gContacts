<?

	/**
	*	Database Information
	*
	*	This file would be used to display template to get the information
	*	about database from the user
	*
	*	@package				gContacts
	*	@file					dbcontents.php
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
<html5:section id='starting'>
<?	
	if ( isset ($_POST['dbname'] ) ) {
		$message = array();
		$valid=true;
		if ( ! isset ($_POST['uname']) or strlen($_POST['uname']) <= 0){
			$message[]= "Kindly Provide the User Name";
			$valid=false;
		}
		if ( ! isset ($_POST['dbname']) or strlen($_POST['dbname']) <= 0){
			$message[]= "Kindly Provide the Database Name";
			$valid=false;
		}
		
		if ( ! isset ($_POST['pwd']) or strlen($_POST['pwd']) <= 0){
			if ( $_SERVER['SERVER_ADDR'] != '127.0.0.1' ) {
				$message[]= "Kindly Provide the Correct Password to Connect DB";
				$valid=false;
			}
		}
		
		if ( ! isset ($_POST['dbhost']) or strlen($_POST['dbhost']) <= 0){
			$message[]= "Kindly Provide the Database Host Name";
			$valid=false;
		}
		
		
		if ( $valid ){
			$db = new DBConnect($_POST['dbhost'], $_POST['uname'], $_POST['pwd'], $_POST['dbname'], $_POST['prefix']);
		}else{
			foreach($message as $m){
				echo "<div style='color:red;width:100%;text-align:center;font-weight:bold;margin-top:25px;'>";
				echo $m;
				echo "</div>";
			}
		}
		
		
	}
	
	
?>


	<div style='float:left; margin:0 auto;text-align:center;margin-top:15px; width:100%;font-size:16px;'>
		<div style='width:70%;margin-left:15%;border:1px solid #ccc;'>
			<div style='width:90%; margin-left:5%'>
			<form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>">
				<p style='text-align:left;font-size:18px;'>
					Below you should enter your database connection details. If you're not sure about these, contact your host. 
				</p>
					<table class="form-table">
						<tr>
							<th scope="row">
								<label for="dbname">Database Name</label>
							</th>
							<td>
								<input name="dbname" id="dbname" type="text" size="25" value="" placeholder="gContacts" />
							</td>
							<td>
								The name of the database you want to run gContacts in.
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="uname">User Name</label>
							</th>
							<td>
								<input name="uname" id="uname" type="text" size="25" placeholder="username" />
							</td>
							<td>
								Your MySQL username for connecting DB
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="pwd">Password</label>
							</th>
							<td>
								<input name="pwd" id="pwd" type="text" size="25" placeholder="password" />
							</td>
							<td>
								...and MySQL password.
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="dbhost">Database Host</label>
							</th>
							<td>
								<input name="dbhost" id="dbhost" type="text" size="25" placeholder="localhost" />
							</td>
							<td>
								You should be able to get this info from your web host, if <code>localhost</code> does not work.
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="prefix">
									Table Prefix
								</label>
							</th>
							<td>
								<input name="prefix" id="prefix" type="text" id="prefix" placeholder="gContacts_" size="25" />
							</td>
							<td>
								If you want to run multiple WordPress installations in a single database, change this.
							</td>
						</tr>
					</table>
					<p class="step"><input name="submit" type="submit" value="Submit" class="button" /></p>
				</form>
			</div>
		</div>
	</div>
</html5:section>