<?php
require("config.php");
mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
mysql_select_db('everythingmarathon');

function protect($array)
{
	if(get_magic_quotes_gpc())
	{
		$array = array_map('stripslashes', $array);
	}
	$array = array_map('htmlspecialchars', $array);
	$array = array_map('mysql_real_escape_string', $array);
	$array = array_map('trim', $array);
	return $array;
}

function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')
{
    $chars_length = (strlen($chars) - 1);
    $string = $chars{rand(0, $chars_length)};
    for ($i = 1; $i < $length; $i = strlen($string))
    {
        $r = $chars{rand(0, $chars_length)};
        if ($r != $string{$i - 1}) $string .=  $r;
    }
   
    //Vérifie que cette chaine n'existe pas déjà
    $result = SelectQuery('SELECT id, ip FROM votants WHERE id = "'.$string.'" LIMIT 1');
    
    if(empty($result))
	    return $string;
    
    return rand_str($length, $chars);
    	
}

function SelectQuery($query, $display = FALSE)
{
	if($display == TRUE)
		echo $query;
	
	$result = mysql_query($query) or die('MySQL Error : '. mysql_error() .' '. $query);
	
	if(mysql_num_rows($result) == 0)
		$arrayResult = array();
	else
		$arrayResult = mysql_fetch_array($result);
	
	return $arrayResult;
}

function SelectQueryMultiple($query, $display = FALSE)
{
	if($display == TRUE)
		echo $query;
	
	$result = mysql_query($query) or die('MySQL Error : '. mysql_error() .' '. $query);
	
	if(mysql_num_rows($result) == 0)
		$arrayResult = array();
	else
	{
		$arrayResult = array();
		while($row = mysql_fetch_array($result))
		{
			$arrayResult[] = $row;
		}
	}
	
	return $arrayResult;
}

function InsertQuery($query, $display = FALSE)
{
	if($display == TRUE)
		echo $query;
	
	mysql_query($query) or die('MySQL Error : '. mysql_error() .' '. $query);
	return mysql_insert_id();
}

function UpdateQuery($query, $display = FALSE)
{
	if($display == TRUE)
		echo $query;
	
	$result = mysql_query($query) or die('MySQL Error : '. mysql_error() .' '. $query);
	return mysql_affected_rows($result);
}

//Transforme un timestamp Unix en timestamp MySQL
function fromUnix($timestamp)
{
	return date('Y-m-d H:i:s', $timestamp);
}

//Transforme un timestamp MySQL en timestamp Unix
function toUnix($timestamp)
{
	return strtotime($timestamp);
}
?>
