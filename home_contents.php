<?

	/**
	*	Template - Home Contents
	*
	*	This file would be used to display template contents for home
	*	page.
	*
	*	@package				gContacts
	*	@file					home_contents.php
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
	<div style='float:left; margin:0 auto;text-align:center;margin-top:15px; width:100%;font-size:16px;'>
		<div style='width:70%;margin-left:15%;'>
	
	<p style='text-align:justify;text-indent:50px;'>
		Welcome to gContacts. Before getting started, we need some information on the database. 
		You will need to know the following items before proceeding.
	</p>
	<ol>
		<li>Database host</li>
		<li>Database name</li>
		<li>Database username</li>
		<li>Database password</li>
		<li>Table prefix (if you want to run more than one gContacts in a single database) </li>
	</ol>
	
	
	<p style='text-align:justify;text-indent:50px;'>In all likelihood, these items were supplied to you by your Web Host. If you do not have this information, then you will need to contact them before you can continue. If you&#8217;re all ready&hellip;</p>
	
	<p class="step"><a href="check_per.php" class="button">Let&#8217;s go!</a></p>
		</div>
	</div>
</html5:section>