<?php

// Get Name from Any Table GetName(tablename,return field name,where clause, id);
function make_seed() 
{
	list($usec, $sec) = explode(' ', microtime());
	return (float) $sec + ((float) $usec * 100000);
}

function GetName1($tablename,$field,$where,$id)
{
	$db = new Database();
	$uquery = "SELECT $field FROM $tablename WHERE $where = '$id'";
	if ($result = $db->db_fetch_obj($uquery)) {
		return $result;
	}
	
}
// Get Value in combo box from any table GetCombo(select one, tablename,value field name,display field name,where clause optional,orderby,selected value optional)

function GetCombo1($display, $tablename, $fieldname, $disfieldname, $where, $orderby, $selected)
{	
	$db = new Database();
	$hrquery = "SELECT * FROM $tablename";	
	if($where){
		$hrquery .= " WHERE $where";
	}
	$hrquery .= " ORDER BY $orderby";
	
	// $hrresult=mysqli_query($hrquery);
	// $hrtotalrow=mysqli_affected_rows();

	$hrtotalrow = $db->db_num($hrquery);
	
	if($display){
		$Getval = "<option value=''>Select $display</option>";
	}
	
	for($hr=0 ; $hr < $hrtotalrow; $hr++)
	{
		// $hrrow=mysql_fetch_object($hrresult);
		$hrrow = $db->db_fetch_obj($hrresult);
		$newval = stripslashes(ucfirst($hrrow->$disfieldname));
		$val = $hrrow->$fieldname;

		if($val==$selected)
			$sel="selected";
		else
			$sel="";
		
		$Getval.="<option value='$val' $sel>$newval</option>";
	}
	return $Getval;
}


function getname($table,$id,$name,$compvar="id")
{
	$db = new Database();
	$getsql = "select $name from $table where $compvar='$id'";
	if( $db->db_num($getsql) ) {
		$getobj = $db->db_fetch_arr($getsql);
		return stripslashes($getobj[0]);
	}
	else {
		return "";
	}
}

function getcombo($table,$value,$name,$args="",$sel="")
{
	$comboqry = "select $value,$name from $table ".$args ;
	$combosres = mysql_query($comboqry);
	while($comboobj = mysql_fetch_array($combosres))
	{
		$comboobj[0]  = stripslashes($comboobj[0]);
		$comboobj[1]  = stripslashes($comboobj[1]);	
		if($comboobj[0] == $sel)
		{
			$selected ="selected";
		}
		else
		{
			$selected = "";
		}
		echo "<option $selected value='$comboobj[0]'>".ucfirst(strtolower($comboobj[1]))."</option>" ;
	}
}

function getcombonew($table,$value,$name,$args="",$sel="",$seprator="-")
{
	$comboqry = "select $value,$name from $table ".$args ;
	$combosres = mysql_query($comboqry);
	while($comboobj = mysql_fetch_array($combosres))
	{
		$comboobj[0]  = stripslashes($comboobj[0]);
		$DisplayText = "";
		for($discnt=1;$discnt<count($comboobj);$discnt++)
		{
			$DisplayText .= stripslashes($comboobj[$discnt])."-";
		}
		$DisplayText = rtrim($DisplayText,"-");
		if($comboobj[0] == $sel)
		{
			$selected ="selected";
		}
		else
		{
			$selected = "";
		}
		echo "<option $selected value='$comboobj[0]'>$DisplayText</option>" ;
	}
}

function recursive_remove_directory($directory, $empty=FALSE)
 {
     // if the path has a slash at the end we remove it here
     if(substr($directory,-1) == '/')
     {
         $directory = substr($directory,0,-1);
     }
  
     // if the path is not valid or is not a directory ...
    if(!file_exists($directory) || !is_dir($directory))
     {
         // ... we return false and exit the function
         return FALSE;
  
     // ... if the path is not readable
     }
	 elseif(!is_readable($directory))
     {
         // ... we return false and exit the function
         return FALSE;
  
     // ... else if the path is readable
     }
	 else{
  
         // we open the directory
         $handle = opendir($directory);
  
        // and scan through the items inside
        while (FALSE !== ($item = readdir($handle)))
         {
             // if the filepointer is not the current directory
            // or the parent directory
             if($item != '.' && $item != '..')
             {
                 // we build the new path to delete
                 $path = $directory.'/'.$item;
  
                 // if the new path is a directory
                 if(is_dir($path)) 
                 {
                     // we call this function with the new path
                     recursive_remove_directory($path);
  
                 // if the new path is a file
                 }else{
                     // we remove the file
                     unlink($path);
                 }
             }
         }
         // close the directory
         closedir($handle);
  
         // if the option to empty is not set to true
         if($empty == FALSE)
         {
             // try to delete the now empty directory
             if(!rmdir($directory))
             {
                 // return false if not possible
                 return FALSE;
             }
         }
         // return success
         return TRUE;
    }
 }
 


function dcd($str)
{
	return stripslashes($str); 
}



//to generate date list box...added By 
function getDayValue($id="")
{
	for($d=1; $d < 32; $d++)
	{
		if($d == $id)
			$dayOption .="<option value='$d' selected>$d</option>";
		else
			$dayOption .="<option value='$d'>$d</option>";
	}
	return $dayOption;
}

//THIS FUNCTION IS FOR GETTING ARRAY OF 'YEAR FOR MOT' added By 
//ADDED ONE ARGUMENT FOR GETTING YEAR LIST IF THIRD ARGUMENT IS
//START YEAR THEN FIRST ARG TAKEN AS STARTING YEAR
//OTHER WISE IT WILL BE NO OF YEARS. CHANGED NAME TO GETYEAR

function getYear($id="",$start="1970",$val1="5",$type="styear")
{
	$date = getdate();

	$cur_yr = $date[year];

	if($type == "styear")
		$val1 = $cur_yr - $val1 + 1;
	
	for($c=$start; $c<=$val1; $c++,$cur_yr--)
	{
		if($c==$id)
			$motyOption.="<option value='$c' selected>$c</option>";
		else
			$motyOption.="<option value='$c'>$c</option>";
	}
	return $motyOption;
}

//THIS FUNCTION IS FOR GETTING ARRAY OF 'MONTH' added By 
//CHANGED NAME OF MOTMONTH TO GETMONTH

function getMonth($id="")
{	
		
	$mon=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	
	$tMonth=$mon;
	$actMonth=$tMonth;
	
	for($m=1; $m < count($actMonth); $m++)
	{
		if($m == $id)
			$motmOption .="<option value='$m' selected>$actMonth[$m]</option>";
		else
			$motmOption .="<option value='$m'>$actMonth[$m]</option>";					
	}
	
	return $motmOption;
}

function my_array_unique($somearray)
{
	$tmparr = array_unique($somearray);
	$i=0;
	$newarr=array();
	foreach ($tmparr as $v)
	{ 
		if(!in_array(trim($v),$newarr))
		{
			$newarr[$i] = trim($v);
			$i++;
		}	
	}
	return $newarr;
}
function fetchvalue($table,$where,$id,$name)
{
	$getsql = "select $name from $table where $where='$id'";
	$getres = mysql_query($getsql);
	if($getres)
	{
		$getobj = mysql_fetch_array($getres);
		return stripslashes($getobj[0]);
	}
	else
	{
		return "";
	}
}

// function by ghanshyam start

function GTG_get_cat_name($id)
{
	$q = "select catname from category where id=".$id;
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			return trim(stripslashes($r1['catname']));
		}
	}
	else
	{
		return "N/A";
	}
}

function GTG_get_main_cat_name($id)
{
	$q = "select * from category where id=".$id;
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			$qq = "select catname from category where id=".$r1['parent'];
			$rr = mysql_query($qq);
			if(mysql_num_rows($rr) > 0)
			{
				while($rr1 = mysql_fetch_array($rr))
				{
					return trim(stripslashes($rr1['catname']));
				}
			}
		}
	}
	else
	{
		return "N/A";
	}
}

function GTG_get_image($pid)
{
	$q = "select * from prodimages where pid=".$pid." order by pimage asc limit 1";
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			return trim($r1['pimage']);
		}
	}
	else
	{
		return "";
	}
}

function GTG_get_pagename($pid)
{
	$q = "select name from `staticpage` where `id`=".$pid;
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			return trim($r1['name']);
		}
	}
}

function GTG_get_pagecontent($pid)
{
	$q = "select content from staticpage where id=".$pid;
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			return trim(stripslashes($r1['content']));
		}
	}
}

function GTG_gtg_password($email)
{
	$q = "select password from users where email='".$email."'";
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			return trim(stripslashes($r1['password']));
		}
	}
	else
	{
		return "NO_PASSWORD_FOUND";
	}
}

function GTG_tocap($str)
{
	echo ucfirst(strtolower($str));
}

## 31 ##
	function getcountry($id)
	{
		if($id != "" && $id > 0)
		{
			$q = "select * from country where id=".$id;
			$r = mysql_query($q);
			while($r1 = mysql_fetch_array($r))
			{
				return $r1['name'];
			}
		}
		else
		{
			return "N/A";
		}
	}
function getMonthpraful($id="")
{	
		
	$mon=array("","January","February","March","April","May","June","July","August","September","October","November","December");
	
	$tMonth=$mon;
	$actMonth=$tMonth;
	return $actMonth[$id];
}
// function by ghanshyam end
//Special Character  REmove //Alti
function replace_praful($str) 
{
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","n",$str);
	$str=ereg_replace("&","and",$str);
	$str=ereg_replace("&amp;","and",$str);
	
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","c",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","n",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","u",$str);	
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","y",$str);
	$str=ereg_replace("�","y",$str);
	
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);	
	$str=ereg_replace("�","C",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","I",$str);	
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","N",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);	
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);	
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","Y",$str);	
	//$str=ereg_replace("'","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	
	
	return $str;
}
//
function replace_praful_1($str) 
{
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","n",$str);
	//$str=ereg_replace("&","and",$str);
	$str=ereg_replace("&amp;","and",$str);
	
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","c",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","n",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","u",$str);	
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","y",$str);
	$str=ereg_replace("�","y",$str);
	
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);	
	$str=ereg_replace("�","C",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","I",$str);	
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","N",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);	
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);	
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","Y",$str);	
	//$str=ereg_replace("'","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	
	
	return $str;
}

function replace_praful_runner($str) 
{
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","n",$str);
	//$str=ereg_replace("&","and",$str);
	//$str=ereg_replace("&amp;","and",$str);
	
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","c",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","n",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","u",$str);	
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","y",$str);
	$str=ereg_replace("�","y",$str);
	
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);	
	$str=ereg_replace("�","C",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","I",$str);	
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","N",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);	
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);	
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","Y",$str);	
	//$str=ereg_replace("'","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	
	
	return $str;
}
//SQL injection functoin 
function pyp_add($str) 
{
	$str=ereg_replace("script=","",$str);
	$str=ereg_replace("script","",$str);
	$str=ereg_replace("select","",$str);
	$str=ereg_replace("union","",$str);
	$str=ereg_replace("drop","",$str);
	$str=ereg_replace("<","&lt;",$str);
	$str=ereg_replace("%3C","",$str);
	$str=ereg_replace(">","&gt;",$str);
	$str=ereg_replace("%3E","",$str);
	//$str=ereg_replace("&lt;","",$str);
	//$str=ereg_replace("&gt;","",$str);
	$str=ereg_replace(";","",$str);
	$str=ereg_replace("%3B","",$str);
	$str=ereg_replace("--","",$str);
	$str=ereg_replace("insert","",$str);
	$str=ereg_replace("delete","",$str);
	$str=ereg_replace("xp_","",$str);
	$str=ereg_replace("\*","",$str);
	$str=ereg_replace("sysobjects","",$str);
	$str=ereg_replace(".exe","",$str);
	$str=ereg_replace("exec","",$str);
	$str=ereg_replace("^","",$str);
	$str=ereg_replace("%5E","",$str);
	
	$str=addslashes(htmlentities($str, ENT_QUOTES)); 
	
	return $str;
}
function pyp_strip($str) 
{
	$str=ereg_replace("script=","",$str);
	$str=ereg_replace("script","",$str);
	$str=ereg_replace("select","",$str);
	$str=ereg_replace("union","",$str);
	$str=ereg_replace("drop","",$str);
	$str=ereg_replace("<","&lt;",$str);
	$str=ereg_replace("%3C","",$str);
	$str=ereg_replace(">","&gt;",$str);
	$str=ereg_replace("%3E","",$str);
	//$str=ereg_replace("&lt;","",$str);
	//$str=ereg_replace("&gt;","",$str);
	$str=ereg_replace(";","",$str);
	$str=ereg_replace("%3B","",$str);
	$str=ereg_replace("--","",$str);
	$str=ereg_replace("insert","",$str);
	$str=ereg_replace("delete","",$str);
	$str=ereg_replace("xp_","",$str);
	$str=ereg_replace("\*","",$str);
	$str=ereg_replace("sysobjects","",$str);
	$str=ereg_replace(".exe","",$str);
	$str=ereg_replace("exec","",$str);
	$str=ereg_replace("^","",$str);
	$str=ereg_replace("%5E","",$str);
	
	//Special Characters//
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","n",$str);
	//$str=ereg_replace("&","and",$str);
	$str=ereg_replace("&amp;","and",$str);	
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","c",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","n",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","u",$str);	
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","y",$str);
	$str=ereg_replace("�","y",$str);	
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);	
	$str=ereg_replace("�","C",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","I",$str);	
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","N",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);	
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);	
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","Y",$str);	
	//$str=ereg_replace("'","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	
	$str=stripslashes($str);
}

function getPureText($catnm)
{
	$catnm1=ereg_replace(" & ","",$catnm);
	$catnm1=ereg_replace(" / ","",$catnm1);
	$catnm1=ereg_replace("--","",$catnm1);
	$catnm1=ereg_replace("'","",$catnm1);
	$catnm1=ereg_replace(" ","",$catnm1);
	$catnm1=ereg_replace("/","",$catnm1);
	$catnm1=ereg_replace(":","",$catnm1);
	$catnm1=ereg_replace("/","",$catnm1);
	$catnm1=ereg_replace("[^A-Za-z0-9]","",$catnm1);
	return $catnm1;
}

function getExtension($filename)
{
	$path_info = pathinfo($filename);
	return ".".$path_info['extension'];
}
function GetDropdown($value,$name,$table,$args="",$sel="")
{
	$comboqry = "select $value,$name from $table ".$args ;
	$combosres = mysql_query($comboqry);
	while($comboobj = mysql_fetch_array($combosres))
	{
		$comboobj[0]  = stripslashes($comboobj[0]);
		$comboobj[1]  = stripslashes($comboobj[1]);	
		if($comboobj[0] == $sel)
		{
			$selected ="selected";
		}
		else
		{
			$selected = "";
		}
		echo "<option $selected value='$comboobj[0]'>".trim($comboobj[1])."</option>" ;
	}
}
//EXIRE YEAR
function expYear($id="")
{
	$date = getdate();

	$cur_yr = $date[year];
	$val1 = $cur_yr + 10;
		

	for($c=$cur_yr; $c<=$val1; $c++)
	{
		if($c == $id)
			$motyOption .="<option value='$c' selected>$c</option>";
		else
			$motyOption .="<option value='$c'>$c</option>";
	}
	return $motyOption;
}

//expire hour
function expHour($id="")
{

	for($c=1; $c<=12; $c++)
	{
		$selected = ($c == $id)?"SELECTED":"";
		$motyOption .="<option value='".str_pad($c,2,"0",STR_PAD_LEFT)."' $selected>".str_pad($c,2,"0",STR_PAD_LEFT)."</option>";
	}
	return $motyOption;
}

//expire minute
function expMin($id="")
{

	for($c=1; $c<=59; $c++)
	{
		$selected = ($c == $id)?"SELECTED":"";
		$motyOption .="<option value='".str_pad($c,2,"0",STR_PAD_LEFT)."' $selected>".str_pad($c,2,"0",STR_PAD_LEFT)."</option>";
	}
	return $motyOption;
}

function getMonth_new($id="")
{	
	//$mon=array("","January","February","March","April","May","June","July","August","September","Octomber","November","December");
	$mon=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	
	$tMonth=$mon;
	$actMonth=$tMonth;
	
	for($m=1; $m < count($actMonth); $m++)
	{
		if($m == $id)
			$motmOption .="<option value='".str_pad($m,2,"0",STR_PAD_LEFT)."' selected>".str_pad($actMonth[$m],2,"0",STR_PAD_LEFT)."</option>";
		else
			$motmOption .="<option value='".str_pad($m,2,"0",STR_PAD_LEFT)."'>".str_pad($actMonth[$m],2,"0",STR_PAD_LEFT)."</option>";					
	}
	
	return $motmOption;
}
function getDay_new($id="")
{	
	for($m=1; $m <=31; $m++)
	{
		if($m == $id)
			$motmOption .="<option value='".str_pad($m,2,"0",STR_PAD_LEFT)."' selected>".str_pad($m,2,"0",STR_PAD_LEFT)."</option>";
		else
			$motmOption .="<option value='".str_pad($m,2,"0",STR_PAD_LEFT)."'>".str_pad($m,2,"0",STR_PAD_LEFT)."</option>";					
	}
	
	return $motmOption;
}
function getYear_new($id="",$max="20",$min="")
{
	$date = getdate();

	$cur_yr = $date[year];
	if($min=="")
	{
		$min=2009;
	}
	else
	{
		$min=$date[year]-$min;
	}
	$lastyr=2009+$max;
	for($c=$min; $c<=$lastyr; $c++)
	{
		if($c==$id)
			$motyOption.="<option value='$c' selected>$c</option>";
		else
			$motyOption.="<option value='$c'>$c</option>";
	}
	return $motyOption;
}
function dateDiff($start, $end)
{
	$start_ts = strtotime($start);
	$end_ts = strtotime($end);
	$diff = $end_ts - $start_ts;
	return round($diff / 86400);
}
function WebsiteWithProperUrl($website)
{
	if(substr($website,0,8)=="https://")
	 {
		$Htttpth="";
	 }
	 else if(substr($website,0,7)=="http://")
	 {
		$Htttpth="";
	 }
	 else 
	 {
		$Htttpth="http://";
	 }
	
	return $Htttpth.$website;
}
function get_post($value)
{
$value=addslashes(trim($_POST[$value]));
return $value;
}
function get_value($fetch,$value)
{
$value=stripslashes(trim($fetch->$value));
return $value;
}
function get_get($value)
{

$value=strip_tags(addslashes(trim($_GET[$value])));
return $value;
}
function get_value_first($fetch,$value)
{
$value=ucfirst(stripslashes(trim($fetch->$value)));
return $value;
}

function GetDropdown_states($value,$name,$table,$args="",$sel="")
{
	$comboqry = "select $value,$name from $table where ( id_country=170  ) order by state_name asc";
	$combosres = mysql_query($comboqry);
	while($comboobj = mysql_fetch_array($combosres))
	{
		$comboobj[0]  = stripslashes($comboobj[0]);
		$comboobj[1]  = stripslashes($comboobj[1]);	
		if($comboobj[0] == $sel)
		{
			$selected ="selected";
		}
		else
		{
			$selected = "";
		}
		echo "<option $selected value='$comboobj[0]'>".trim($comboobj[1])."</option>" ;
	}
	echo '<option value="">---Province---</option>';
	$comboqry = "select $value,$name from $table where ( id_country=36  ) order by state_name asc";
	$combosres = mysql_query($comboqry);
	while($comboobj = mysql_fetch_array($combosres))
	{
		$comboobj[0]  = stripslashes($comboobj[0]);
		$comboobj[1]  = stripslashes($comboobj[1]);	
		if($comboobj[0] == $sel)
		{
			$selected ="selected";
		}
		else
		{
			$selected = "";
		}
		echo "<option $selected value='$comboobj[0]'>".trim($comboobj[1])."</option>" ;
	}
	echo '<option value="International">International</option>';
}
function expMin_new($id="")
{
	if($id == "00"){$selected1 ="selected";}else{$selected1 = "";}
	if($id == "15"){$selected2 ="selected";}else{$selected2 = "";}
	if($id == "30"){$selected3 ="selected";}else{$selected3 = "";}
	if($id == "45"){$selected4 ="selected";}else{$selected4 = "";}
	$motyOption .="<option value='00' $selected1>00</option>";
	$motyOption .="<option value='15' $selected2>15</option>";
	$motyOption .="<option value='30' $selected3>30</option>";
	$motyOption .="<option value='45' $selected4>45</option>";
	return $motyOption;
}
/*function CryptK($string,$Key)
{
	$sLen=strlen($string);
	for ($i=0;$i<$sLen;$i++)
		$RetStr.=ord(substr($string,$i,1))+$Key;
	return $RetStr;	
}
function DeCryptK($string,$Key)
{
	$sLen=strlen($string)/2;
	$j=0;
	for ($i=0;$i<$sLen;$i++)
	{
		$RetStr.=chr(substr($string,$j,2)-$Key);
		$j+=2;
	}
	return $RetStr;	
}*/
function GetTotalUserPackage($userid)
{
	$GetUserPcakageQry=mysql_query("SELECT * FROM users_packages where userid='".$userid."' and paidstatus ='Y'");
	$TotGetUserPcakageQry=mysql_affected_rows();
	return $TotGetUserPcakageQry;
}
function GetTotalUserPackageDetail($userid)
{
	$GetUserPcakageQry=mysql_query("SELECT * FROM users_packages where userid='".$userid."'");
	$TotGetUserPcakageQry=mysql_affected_rows();
	$GetUserPcakageQryRow=mysql_fetch_array($GetUserPcakageQry);
	return $GetUserPcakageQryRow['packageid'];
}
function GetMemberShipType($userid)
{
	$GetUserPackageQry=mysql_query("SELECT * from users_packages where userid='".trim($userid)."'");
	$TotGetUserPackage=mysql_affected_rows();
	if($TotGetUserPackage>0)
	{
		$GetUserPackageQryRow=mysql_fetch_object($GetUserPackageQry);
		if($GetUserPackageQryRow->packagetype=="FREE")
		{
			$PackageName="Basic Membership";
		}
		else
		{
			$PackageName="Premium Member";
		}
		//$PackageName=stripslashes(GetName1("packages","name","id",$GetUserPackageQryRow->packageid));
	}
	else
	{
		$PackageName="Basic Membership";
	}
	return $PackageName;
}
function GetAppliedforJobOrNot($userid,$jobid)
{
	if($userid=="")
	{
		$Returnval='<a href="job-apply.php?jid='.$jobid.'" class="link-red"><strong>Apply</strong></a>';
	}
	else
	{
		$GetUserPcakageQry=mysql_query("SELECT * FROM job_apply where jobapplyid='".$userid."' and  jobid ='".$jobid."'");
		$TotGetUserPcakageQry=mysql_affected_rows();
		if($TotGetUserPcakageQry>0)
		{
			$GetUserPcakageQryRow=mysql_fetch_array($GetUserPcakageQry);
			$applieddate=date("m/d/Y",strtotime($GetUserPcakageQryRow['applydate']));
			$Returnval='<span class="font-11-red">You applied to this job on '.$applieddate.'</span>';
		}
		else
		{
			$Returnval='<a href="job-apply.php?jid='.$jobid.'" class="link-red"><strong>Apply</strong></a>';
		}	
	}
	
	return $Returnval;
}
function int_to_Decimal($Intnumber)
{
	return number_format($Intnumber, 2, '.', '');
}

function IsUserPaidForPackage($userid)
{
	$GetUserPcakageQry=mysql_query("SELECT * FROM users_packages where userid='".$userid."'");
	$TotGetUserPcakageQry=mysql_affected_rows();
	if($TotGetUserPcakageQry>0)
	{
		$GetUserPcakageQryRow=mysql_fetch_array($GetUserPcakageQry);
		if($GetUserPcakageQryRow['packageid']=="1" || $GetUserPcakageQryRow['packageid']=="6" || $GetUserPcakageQryRow['packageid']==1 || $GetUserPcakageQryRow['packageid']==6)
		{
			return "Free";
		}
		else if($GetUserPcakageQryRow['paidstatus']=="Y")
		{
			return "Yes";
		}	
		else
		{
			return "No";
		}
	}
	else
	{
		return "No";
	}
}
function GetTotalVideoUplodedByUser($userid)
{
	$GetUserPcakageQry=mysql_query("SELECT * FROM projects_videos where userid='".$userid."' and video_extra!=''");
	$TotGetUserPcakageQry=mysql_affected_rows();
	$GetUserPcakageQryRow=mysql_fetch_array($GetUserPcakageQry);
	return $TotGetUserPcakageQry;
}
function getModifiedUrlNamechange($catnm)
{
	$catnm=trim($catnm);

	$catnm1=ereg_replace(" & ","_",$catnm);
	$catnm1=ereg_replace(" / ","_",$catnm1);
	$catnm1=ereg_replace("--","_",$catnm1);
	$catnm1=ereg_replace(" ","_",$catnm1);
	$catnm1=ereg_replace("--","_",$catnm1);
	$catnm1=ereg_replace("/","_",$catnm1);
	$catnm1=ereg_replace("--","_",$catnm1);
	$catnm1=ereg_replace(":","_",$catnm1);
	$catnm1=ereg_replace("/","_",$catnm1);
	$catnm1=ereg_replace("[^A-Za-z0-9]","_",$catnm1);
	$catnm1=ereg_replace("--","_",$catnm1);
	$catnm1=ereg_replace("--","_",$catnm1);
	return $catnm1;
}

function getModifiedUrlNamechange2($catnm)
{
	$catnm=trim($catnm);

	$catnm1=ereg_replace(" & ","-",$catnm);
	$catnm1=ereg_replace(" / ","-",$catnm1);
	$catnm1=ereg_replace("--","-",$catnm1);
	$catnm1=ereg_replace(" ","-",$catnm1);
	$catnm1=ereg_replace("--","-",$catnm1);
	$catnm1=ereg_replace("/","-",$catnm1);
	$catnm1=ereg_replace("--","-",$catnm1);
	$catnm1=ereg_replace(":","-",$catnm1);
	$catnm1=ereg_replace("/","-",$catnm1);
	$catnm1=ereg_replace("[^A-Za-z0-9]","-",$catnm1);
	$catnm1=ereg_replace("--","-",$catnm1);
	$catnm1=ereg_replace("--","-",$catnm1);
	return $catnm1;
}
function GetUrl_Stat($kwrd,$livekwrd)
{
	session_start();	
	global $GET_HOSTNM;
	global $GET_HOSTNM2;		
	if ($_SERVER['HTTP_HOST']=='abc')
		return "$GET_HOSTNM/$kwrd";
	else 
		return "$GET_HOSTNM/$livekwrd";
}
function GetUrl_Category($id)
{
	
	session_start();	
	global $GET_HOSTNM;
	global $GET_HOSTNM2;	
	$name=strtolower(getname("category",$id,"name"));	
	$name1=getModifiedUrlNamechange($name);
	$stag1=str_replace("___","_",$name1);
	$name=str_replace("__","_",$stag1);
	if ($_SERVER['HTTP_HOST']=='abc')
		return "$GET_HOSTNM/cat.php?id=$id";
	else
		return "$GET_HOSTNM/category/$name/$id"; 	
}
function GetUrl_SubCategory($id,$sid)
{
	session_start();	
	global $GET_HOSTNM;
	global $GET_HOSTNM2;	
	$name=strtolower(getname("category",$id,"name"));	
	$name1=getModifiedUrlNamechange($name);
	$stag1=str_replace("___","_",$name1);
	$name=str_replace("__","_",$stag1);
	
	$subname=strtolower(getname("category",$sid,"name"));	
	$subname1=getModifiedUrlNamechange($subname);
	$substag1=str_replace("___","_",$subname1);
	$subname=str_replace("__","_",$substag1);
	
	
	if ($_SERVER['HTTP_HOST']=='abc')
		return "$GET_HOSTNM/subcat.php?id=$sid";
	else
		return "$GET_HOSTNM/category/$name/$subname/$sid"; 	
}
//New Function by PYP
function GetUrl_Designers($id)
{
	session_start();	
	global $GET_HOSTNM;
	$name=GetName1("designers","urlname","id",$id);
	if ($_SERVER['HTTP_HOST']=='abc')
		return "$GET_HOSTNM/collections.php?product=$name";
	else
		return "$GET_HOSTNM/Collections/$name"; 	
}

function GetUrl_Sale($id)
{
	session_start();	
	global $GET_HOSTNM;
	$name=GetName1("category_sale","urlname","id",$id);
	if ($_SERVER['HTTP_HOST']=='abc')
		return "$GET_HOSTNM/sale_products.php?product=$name";
	else
		return "$GET_HOSTNM/Sale/$name"; 	
}
function GetUrl_Product($id,$section,$oid)
{
	session_start();	
	global $GET_HOSTNM;
	$name=GetName1("products","urlname","id",$id);
	if ($_SERVER['HTTP_HOST']=='abc')
	{
		return "$GET_HOSTNM/product_detail.php?product=$name";
	}
	else
	{
		if($section=="Collections")
		{
			return "$GET_HOSTNM/Collections/$oid/$name"; 
		}
		else if($section=="Accessories")
		{
			return "$GET_HOSTNM/Accessories/$oid/$name"; 
		}
		else if($section=="Headphones")
		{
			return "$GET_HOSTNM/Headphones/$oid/$name"; 
		}
	}	
}
/* For admin orders*/
function getYearValue_Admin($id="")
{	
	for($m=2010;$m<date('Y')+2;$m++)
	{
		if($m == $id)
			$motmOption .="<option value='$m' selected>$m</option>";
		else
			$motmOption .="<option value='$m'>$m</option>";					
	}
	
	return $motmOption;
}	
function getMonth_Admin($id="")
{	
	$mon=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	
	$tMonth=$mon;
	$actMonth=$tMonth;
	
	for($m=1; $m < count($actMonth); $m++)
	{
		if($m == $id)
			$motmOption .="<option value='$m' selected>$actMonth[$m]</option>";
		else
			$motmOption .="<option value='$m'>$actMonth[$m]</option>";					
	}
	
	return $motmOption;
}
function getDay_Admin($id="")
{	
	for($m=1; $m < 31; $m++)
	{
		if($m == $id)
			$motmOption .="<option value='$m' selected>$m</option>";
		else
			$motmOption .="<option value='$m'>$m</option>";					
	}
	
	return $motmOption;
}
function getQuantityDrp_Admin($start,$end,$selquantity="")
{	
	for($m=$start; $m <= $end; $m++)
	{
		if($m == $selquantity)
			$motmOption .="<option value='$m' selected>$m</option>";
		else
			$motmOption .="<option value='$m'>$m</option>";					
	}
	
	return $motmOption;
}

function GetUrl_Gift($id)
{
	session_start();	
	global $GET_HOSTNM;
	if ($_SERVER['HTTP_HOST']=='abc')
		return "$GET_HOSTNM/gift_detail.php?card=$id";
	else
		return "$GET_HOSTNM/Gift-Ideas/Gift-Certificates/$id"; 	
}
function GetUrl_Press($id)
{
	session_start();	
	global $GET_HOSTNM;
	if ($_SERVER['HTTP_HOST']=='abc')
		return "$GET_HOSTNM/press_detail.php?id=$id";
	else
		return "$GET_HOSTNM/Press/$id"; 	
}
function GetUrl_Lookbook($id)
{
	session_start();	
	global $GET_HOSTNM;
	if ($_SERVER['HTTP_HOST']=='abc')
		return "$GET_HOSTNM/lookbook.php?id=$id";
	else
		return "$GET_HOSTNM/Look-Book/$id"; 	
}
/* FOR NOFTYYYY */
function GetUrl_Women($id)
{
	session_start();	
	global $GET_HOSTNM;
	$name=GetName1("category","urlname","id",$id);
	if ($_SERVER['HTTP_HOST']=='abc')
		return "$GET_HOSTNM/headphones.php?product=$name";
	else
		return "$GET_HOSTNM/Headphones/$name"; 	
}
function GetUrl_Men($id)
{
	session_start();	
	global $GET_HOSTNM;
	$name=GetName1("category","urlname","id",$id);
	if ($_SERVER['HTTP_HOST']=='abc')
		return "$GET_HOSTNM/accessories.php?product=$name";
	else
		return "$GET_HOSTNM/Accessories/$name"; 	
}
function GetUrl_DesignerNew($id)
{
	session_start();	
	global $GET_HOSTNM;
	$name=GetName1("category","urlname","id",$id);
	if ($_SERVER['HTTP_HOST']=='abc')
		return "$GET_HOSTNM/collections.php?product=$name";
	else
		return "$GET_HOSTNM/Collections/$name"; 	
}
function GetNewAccountNumber()
{
	/*$getaccTypeQryRs=mysql_query("SELECT id FROM users ORDER by id DESC");
	$tot=mysql_affected_rows();
	if($tot>0)
	{
		$getaccTypeQryRow=mysql_fetch_array($getaccTypeQryRs);
		$lastid=$getaccTypeQryRow['id'];
		$ret="11111000000000"+$lastid+1;
	}
	else
	{
		$ret="11111000000001";
	}*/
	$ret=rand(2000000000,9999999999);
	return sprintf('%.0f', $ret);
}
function GetNewCustomerID()
{
	$getaccTypeQryRs=mysql_query("SELECT id FROM users ORDER by id DESC");
	$tot=mysql_affected_rows();
	if($tot>0)
	{
		$getaccTypeQryRow=mysql_fetch_array($getaccTypeQryRs);
		$lastid=$getaccTypeQryRow['id'];
		$ret=11111110+$lastid+1;
	}
	else
	{
		$ret="11111111";
	}
	return $ret;
}
function getMonth_newXX($id="")
{	
	//$mon=array("","January","February","March","April","May","June","July","August","September","Octomber","November","December");
	$mon=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	
	$tMonth=$mon;
	$actMonth=$tMonth;
	
	for($m=1; $m < count($actMonth); $m++)
	{
		if($m == $id)
			$motmOption .="<option value='".str_pad($m,2,"0",STR_PAD_LEFT)."' selected>".str_pad($actMonth[$m],2,"0",STR_PAD_LEFT)."</option>";
		else
			$motmOption .="<option value='".str_pad($m,2,"0",STR_PAD_LEFT)."'>".str_pad($actMonth[$m],2,"0",STR_PAD_LEFT)."</option>";					
	}
	
	return $motmOption;
}
function getDay_newXX($id="")
{	
	for($m=1; $m <=31; $m++)
	{
		if($m == $id)
			$motmOption .="<option value='".str_pad($m,2,"0",STR_PAD_LEFT)."' selected>".str_pad($m,2,"0",STR_PAD_LEFT)."</option>";
		else
			$motmOption .="<option value='".str_pad($m,2,"0",STR_PAD_LEFT)."'>".str_pad($m,2,"0",STR_PAD_LEFT)."</option>";					
	}
	
	return $motmOption;
}
function getYearXX($id="",$start="1970",$val1="5",$type="styear")
{
	$date = getdate();

	$cur_yr = $date[year];

	if($type == "styear")
		$val1 = $cur_yr - $val1 + 1;
	
	for($c=$start; $c<=$val1; $c++,$cur_yr--)
	{
		if($c==$id)
			$motyOption.="<option value='$c' selected>$c</option>";
		else
			$motyOption.="<option value='$c'>$c</option>";
	}
	return $motyOption;
}
function get_client_ip() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function GetTotalVotes($id)
{
	$GetUserPcakageQry=mysql_query("SELECT id FROM podcasts_votes where pollid='".$id."'");
	$TotGetUserPcakageQry=mysql_affected_rows();
	return $TotGetUserPcakageQry;
}

function xTimeAgo($time_ago)
{
$time_ago =strtotime($time_ago);

$getservertimeQryRs=mysql_query("select now() as servertime");
$getservertimeQryRow=mysql_fetch_array($getservertimeQryRs);
$cur_time=strtotime($getservertimeQryRow['servertime']);
		
//$cur_time 	= time();


$time_elapsed 	= $cur_time - $time_ago;
$seconds 	= $time_elapsed ;
$minutes 	= round($time_elapsed / 60 );
$hours 		= round($time_elapsed / 3600);
$days 		= round($time_elapsed / 86400 );
$weeks 		= round($time_elapsed / 604800);
$months 	= round($time_elapsed / 2600640 );
$years 		= round($time_elapsed / 31207680 );
// Seconds
if($seconds <= 60){
	echo "$seconds seconds ago";
}
//Minutes
else if($minutes <=60){
	if($minutes==1){
		echo "one minute ago";
	}
	else{
		echo "$minutes minutes ago";
	}
}
//Hours
else if($hours <=24){
	if($hours==1){
		echo "an hour ago";
	}else{
		echo "$hours hours ago";
	}
}
//Days
else if($days <= 7){
	if($days==1){
		echo "yesterday";
	}else{
		echo "$days days ago";
	}
}
//Weeks
else if($weeks <= 4.3){
	if($weeks==1){
		echo "a week ago";
	}else{
		echo "$weeks weeks ago";
	}
}
//Months
else if($months <=12){
	if($months==1){
		echo "a month ago";
	}else{
		echo "$months months ago";
	}
}
//Years
else{
	if($years==1){
		echo "one year ago";
	}else{
		echo "$years years ago";
	}
}
}

function GetTotalComments($id)
{
	$GetUserPcakageQry=mysql_query("SELECT id FROM podcasts_comments where podcastid='".$id."' and active='Y' ");
	$TotGetUserPcakageQry=mysql_affected_rows();
	return $TotGetUserPcakageQry;
}
?>