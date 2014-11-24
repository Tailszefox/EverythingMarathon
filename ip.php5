<?php
include('sql.php5');

if(isset($_COOKIE['id']))
{
	//Le type est déjà venu, on cherche son ID
	$result = SelectQuery('SELECT id, ip FROM votants WHERE id = "'.mysql_real_escape_string($_COOKIE['id']).'" LIMIT 1');
	if(!empty($result))
	{
		$id = $result['id'];
		$ip = $result['ip'];
	}
}

//Si l'ID n'existe pas ou qu'il n'y a pas de cookie, on cherche si l'IP correspond à quelque chose
if(!isset($ip))
{
	$result = SelectQuery('SELECT id, ip FROM votants WHERE ip = "'.mysql_real_escape_string($_SERVER['REMOTE_ADDR']).'" LIMIT 1');
	if(!empty($result))
	{
		$id = $result['id'];
		$ip = $result['ip'];
	}
}

//Si toujours rien, c'est qu'il n'est vraiment jamais venu
if(!isset($ip))
{
	$id = '';
	$ip = $_SERVER['REMOTE_ADDR'];
}

//Ajoute le visiteur comme votant s'il n'existe pas déjà, et retourne son ID numérique dans tous les cas
function checkVotant($id, $ip, $language)
{
	if(empty($id))
	{
		$id = rand_str(20);
		
		$numericId = InsertQuery('INSERT INTO votants(id, ip, langue) VALUE("'.mysql_real_escape_string($id).'", "'.$ip.'", "'.$language.'")');
		
		//Ajoute un cookie
		setcookie('id', $id, time()+3600*24*15);
		
		return $numericId;
	}
	else
	{
		$result = SelectQuery('SELECT numericId FROM votants WHERE id = "'.mysql_real_escape_string($id).'" LIMIT 1');
		return $result['numericId'];
	}
}

//Vérifie si le visiteur a voté pour un jeu ou non
function getVoted($id, $idVisit)
{
	if($idVisit == '')
		return false;
	
	$vote = SelectQuery('SELECT * FROM votes WHERE id_jeu = "'.$id.'" AND id_votant = "'.$idVisit.'"');
	if(empty($vote))
		return false;
	else
		return true;
}
?>
