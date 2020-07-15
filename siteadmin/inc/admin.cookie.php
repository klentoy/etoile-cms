<?php
 session_start();
  if(!isset($_COOKIE['UsErId']))
  {
	   header("Location:index.php");
	   exit;
  	   //echo "<script language=javascript>window.parent.location.href='index.php'</ script>";
  }
?>