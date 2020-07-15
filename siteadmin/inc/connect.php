<?php
session_start();

include ("../include/config.inc.php");

include ("../include/db.conn.php"); // New File
include ("admin.loader.php"); // New File

include ("../include/functions.php");
include ("../include/CryToGraphy.php");
include ("../include/encryption.php");	
include_once ("../include/sendmail.php");
include_once ("../include/prs_function.php");
include_once ("../include/gtg_functions.php");

include './vendor/class.upload.php';
