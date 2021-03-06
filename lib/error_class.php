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
	$data = ob_end_clean();
	
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
		<h1 id="logo"><img alt="gContacts" src="images/logo.png" /></h1>
		<?
			if ( count ($_POST) > 0 ) {
				if ( ! isset($_GET['m'] ) ) {
					echo "<form method=post action='".$_SERVER['PHP_SELF'] ."?m=1'>\n";
				}elseif($_GET['m'] == 1){
					echo "<form method=post action='".$_SERVER['PHP_SELF'] ."?m=2'>\n";
				}
				unset($_POST['submit']);
				foreach($_POST as $k => $v){
					echo "\t\t\t<input type='hidden' name='$k' value='$v' />\n";
				}
			}
			
			if ( ! isset($_GET['m'] ) ) {
			
		?>
		<div class='error'>
			<ol>
				<li>Due to some technical fault the current page can't be displayed. </li>
				<li>Any inconvenience caused due to Error is highly regretted.</li>
				<li>We will take necessary steps at the earlier possible to resolve the issue.</li>
				<li>If you want to notify Developer then click Prepare Email</li>
			</ol>
		</div>
		<br/><br/>
			<?
				if ( count ($_POST) > 0 ) {
					?>
						<p class="step"><input name="submit" type="submit" value="Prepare eMail" class="button" /></p>
					<?
						echo "</form>";
				}else{
			?>
				<p class="step"><a href="<?php echo $_SERVER['PHP_SELF'] . "?m=1"; ?>" class="button">Prepare eMail</a></p>
				<br/><br/>
			<?
				}
			}
			?>
		
			<?
			if ( isset ( $_GET['m'] ) ) {
				//If the Server Address is not equal to localhost then send error through email
				if ( $_SERVER['SERVER_ADDR'] != '127.0.0.1' and ( $_GET['m'] == 1) ){
					$emailmessage.="<div style='float:left;width:100%;text-align:justify;'>";
					$emailmessage.="<div style='float:left;width:90%;text-align:justify;margin-left:5%;margin-right:5%'>";
					$emailmessage.="<b><br><br>Request Information</b>= <br/>\n".stripslashes (indent(@json_encode($_REQUEST)));
					$emailmessage.="</div></div>";
					$emailmessage.="<b><br><br>Error Number=</b>".$error_number;
					$emailmessage.="<b><br><br>Message = </b>".$error_details[$error_number];
					$emailmessage.="<b><br><br>Location = </b>".$file_location;
					
				?>
					<div class='error'>
						<ol>
							<li>We have gathered the below mentioned Information to track the bug.</li>
							<li>Click Send Email to Notify us</li>
							<li style='text-align:center;font-weight:bold'>Email Preview</li>
						</ol>
					</div>
				<?
					echo "<div id='message'>" . $emailmessage . '</div>';
				?>
				<br/>
				<?
					if ( count ($_POST) > 0 ) {
				?>
						<p class="step"><input name="submit" type="submit" value="Send eMail" class="button" /></p>
				<?
						echo "</form>";
					}else{
				?>
					<p class="step"><a href="<?php echo $_SERVER['PHP_SELF'] . "?m=2"; ?>" class="button">Send eMail</a></p>
					<br/><br/>
				<?
					}
				}else{
					if ($_GET['m'] == 1){
					?>
					<br/>
					<div class='error'>
						<ol>
							<li>Sorry, Localhost run can't view Error Message</li>
						</ol>
					</div>
					<?
					}
				}
			}
			if ( isset ( $_GET['m'] ) ) {
				if ( ( $_GET['m'] == 2) and $_SERVER['SERVER_ADDR'] != '127.0.0.1'){
					$headers='';
					$headers.="From: error@". $_SERVER['SERVER_NAME'] ."\r\n";
					$headers.="Content-type: text/html\r\n";
					$email='"Cee Emm Infotech" '."<vineetgupta22@gmail.com>";
					$emailmessage='';
					$emailmessage.=indent(@json_encode($_REQUEST));
					$emailmessage.="<br><br>Error Number=".$error_number;
					$emailmessage.="<br><br>Message = ".$error_details[$error_number];
					$emailmessage.="<br><br>Location = ".$file_location;
					$emailmessage.="<br><br>ERRROR In gContacts";
					$res=@mail($email, "Error Message", $emailmessage,$headers);
				?>
				<br/><br/><br/><br/>
				<div class='error'>
					<ol>
						<li style='text-align:center;'>Thanks for sending Email</li>
					</ol>
				</div>
				<br/><br/><br/><br/><?
				}else{
					if ($_GET['m'] == 2){
					?>
					<div class='error'>
						<ol>
							<li>Sorry, Localhost run can't view Error Message</li>
						</ol>
					</div>
					<?
					}
				}
			}
		?>
	</body>
</html>

<?
	die();
?>