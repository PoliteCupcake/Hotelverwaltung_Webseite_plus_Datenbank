<?php
//Flagging for Roles

	$anon        = false;
	$guest       = false;
	$serviceTech = false;
	$admin       = false;
	session_start();
	if( isset($_SESSION["userid"]) )
	{
		switch($_SESSION["userRole"])
		{
			case "guest"      : $guest       = true; break;
			case "serviceTech": $serviceTech = true; break;
			case "admin"      : $admin       = true; break;
		}
	}
	else
		$anon = true;
?>