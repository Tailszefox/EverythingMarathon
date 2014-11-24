<?php
include('ip.php5');
include('language.php5');

$_POST = protect($_POST);

function getAkas($id)
{
	$akas = SelectQueryMultiple('SELECT * FROM alternates WHERE id_jeu = "'.$id.'"');
	
	//Noms alternatifs ?
	if(!empty($akas))
	{
		foreach($akas as $a)
		{
			$akasArray[] = $a['nom'];
		}
		
		$aka = implode(' - ', $akasArray);
	}
	
	return $aka;
}

function getVotes($id)
{
	$votes = SelectQuery('SELECT COUNT(*) as votes FROM votes WHERE id_jeu = "'.$id.'"'); 
	return $votes['votes'];
}

if($_POST['limit'] != '0')
{
	$limit = ' LIMIT ' . $_POST['limit'];
}
else
{
	$limit = '';
}

//Recherche
if($_POST['type'] == 'search')
{
	$query = 'SELECT *, jeux.nom AS vraiNom, jeux.id as idJeu FROM jeux WHERE TRUE';
	$queryAlt = 'SELECT *, jeux.nom AS vraiNom, jeux.id as idJeu FROM jeux, alternates WHERE TRUE';
	
	if($_POST['title'] != '')
	{
		$query .= ' AND (jeux.nom LIKE "%'.$_POST['title'].'%")'; 
		$queryAlt .= ' AND (alternates.nom LIKE "%'.$_POST['title'].'%")';
	}
	
	if($_POST['console'] != 'none')
	{
		$query .= ' AND jeux.console = "'.$_POST['console'].'"';
		$queryAlt .= ' AND jeux.console = "'.$_POST['console'].'"';
	}
	
	if($_POST['genre'] != 'none')
	{
		$query .= ' AND jeux.genre = "'.$_POST['genre'].'"';
		$queryAlt .= ' AND jeux.genre = "'.$_POST['genre'].'"';
	}
	
	$query .= ' ORDER BY jeux.nom' . $limit;
	$queryAlt .= ' AND alternates.id_jeu = jeux.id ORDER BY jeux.nom' . $limit;
	
	$gamesNames = SelectQueryMultiple($query, false);
	
	//On fait une recherche sur les titres alt. uniquement si on a demandé un titre
	if($_POST['title'] != '')
		$gamesAlt = SelectQueryMultiple($queryAlt, false);
	else
		$gamesAlt = array();
		
	$games = array_merge($gamesNames, $gamesAlt);
	$taille = sizeof($games);
	//On retire les doublons
	for($i = 0; $i < $taille; $i++)
	{
		for($j = $i+1; $j < $taille; $j++)
		{
			if($games[$i]['idJeu'] == $games[$j]['idJeu'])
				unset($games[$j]);
		}
	}
	
	$games = array_values($games);
	
	echo '<br /><strong> ' . display('searchResults', false) . '</strong><br /><br />';
}
elseif($_POST['type'] == 'topGames')
{
	$query = 'SELECT * FROM (SELECT *, jeux.nom as vraiNom, jeux.id as idJeu, COUNT(*) as nbVotes FROM jeux, votes WHERE jeux.id = votes.id_jeu GROUP BY votes.id_jeu) jeuxVotes ORDER BY jeuxVotes.nbVotes DESC' . $limit;
	$games = SelectQueryMultiple($query);
}
elseif($_POST['type'] == 'lastVotes')
{
	$query = 'SELECT *, jeux.nom as vraiNom, jeux.id as idJeu FROM jeux, votes WHERE jeux.id = votes.id_jeu ORDER BY votes.timestamp DESC' . $limit;
	$games = SelectQueryMultiple($query);
}
elseif($_POST['type'] == 'lastGames')
{
	$query = 'SELECT *, jeux.nom as vraiNom, jeux.id as idJeu FROM jeux ORDER BY jeux.id DESC' . $limit;
	$games = SelectQueryMultiple($query);
}

if(empty($games))
{
	display('noResults');
}
else
{
	$result = SelectQuery('SELECT numericId FROM votants WHERE id = "'.mysql_real_escape_string($id).'" LIMIT 1');
	$numericId = $result['numericId'];
	
	echo '<table class="tableGames">';
	echo '<thead><tr><td>'.display('title', false).'</td><td>'.display('console', false).'</td><td>'.display('genre', false).'</td><td>'.display('votes', false).'</td></tr></thead>';
	foreach($games as $game)
	{
		$akas = getAkas($game['idJeu']);
		$votes = getVotes($game['idJeu']);
		$voted = getVoted($game['idJeu'], $numericId);
		
		echo '<tr><td class="gameTitle">'.ucwords($game['vraiNom']);
		if(!empty($akas))
		{
			echo ' <em title="'.$akas.'" class="akas small">(' . display('aka', false) . ')</em>';
		}
		echo '</td>';
		if(isset($consoles[$game['console']]))
			echo '<td>'.$consoles[$game['console']].'</td>';
		else
			echo '<td>'.$game['console'].'</td>';
		echo '<td>'.$genres[$game['genre']].'</td>';
		echo '<td>'.$votes;
		
		/*
		if($voted)
			echo '&nbsp;<img src="plusBlack.png" title="'.display('alreadyVoted', false).'"/>';
		else
			echo '&nbsp;<img src="plus.png" class="vote" title="'.display('voteForThisGame', false).'" id="'.$game['idJeu'].'"/>';
		*/
		
		echo '</td>';
		
		echo '</tr>';
	}
	echo '</table>';
	
	if($_POST['type'] == 'search' and $_POST['limit'] == sizeof($games))
	{
		display('tooMuchResults');
	}
}

?>
