<?php
include('ip.php5');
include('language.php5');

$_POST = protect($_POST);

function displayGame($title, $id, $console)
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
	
	global $consoles;
	
	if(isset($consoles[$console]))
		$console = $consoles[$console];
		
	echo '<p><strong class="titleClick">' . ucwords($title) .'</strong> - '.$console.'<br /><em class="small">';
	
	if(!empty($aka))
	{
		display('aka');
		echo ': '.$aka;
	}
	
	echo '</em></p>';
}

function createArrayGames($sameName, $alternateNames)
{
	$games = array();
	foreach($sameName as $game)
	{
		$games[$game['id']]['title'] = $game['nom'];
		$games[$game['id']]['console'] = $game['console'];
	}
	
	foreach($alternateNames as $game)
	{
		$games[$game['id']]['title'] = $game['vraiNom'];
		$games[$game['id']]['console'] = $game['console'];
	}
	return $games;
}

$exists = FALSE;

//On teste si le jeu n'existe pas déjà
if(($_POST['force']) != 'true')
{
	//On regarde déjà si le jeu n'existe pas déjà dans la base directement, et par nom alternatif
	$sameName = SelectQuery('SELECT * FROM jeux WHERE nom = "'.$_POST['title'].'" AND console = "'.$_POST['console'].'" LIMIT 1');
	$alternateNames = SelectQuery('SELECT *, jeux.nom AS vraiNom FROM alternates, jeux WHERE alternates.nom = "'.$_POST['title'].'" AND jeux.console = "'.$_POST['console'].'" and alternates.id_jeu = jeux.id LIMIT 1');
	
	if(sizeof($sameName) > 0 || sizeof($alternateNames) > 0)
	{
		echo '<div id="already">';
		display('alreadyExists');
		
		//Le jeu existe déjà sous ce nom
		if(sizeof($sameName) > 0)
		{
			$title = $sameName['nom'];
			$id = $sameName['id'];
			$console = $sameName['console'];
		}
		//Le jeu existe déjà sous un autre nom
		elseif(sizeof($alternateNames) > 0)
		{
			$title = $alternateNames['vraiNom'];
			$id = $alternateNames['id_jeu'];
			$console = $alternateNames['console'];
		}
		
		displayGame($title, $id, $console);
		
		display('clickForVote');
		echo '</div>';
		
		$exists = TRUE;
	}
	
	//On regarde aussi s'il n'existe pas déjà un autre jeu du même nom sur une autre plate-forme
	if($exists == FALSE)
	{
		$sameName = SelectQueryMultiple('SELECT * FROM jeux WHERE nom = "'.$_POST['title'].'"');
		$alternateNames = SelectQueryMultiple('SELECT *, jeux.nom AS vraiNom FROM alternates, jeux WHERE alternates.nom = "'.$_POST['title'].'" and alternates.id_jeu = jeux.id');
		
		if(!empty($sameName) or !empty($alternateNames))
		{
			$games = createArrayGames($sameName, $alternateNames);
			
			echo '<div id="maybeAlready">';
			display('alreadyExistsOtherConsoles');
			
			foreach($games as $id => $game)
				displayGame($game['title'], $id, $game['console']);
			
			display('clickForReallyAdd');
			echo '</div>';
			
			$exists = TRUE;
		}
	}
	
	//On jette un œil avec le SOUNDEX
	if($exists == FALSE)
	{
		$sameName = SelectQueryMultiple('SELECT * FROM jeux WHERE SOUNDEX(nom) = SOUNDEX("'.$_POST['title'].'")');
		$alternateNames = SelectQueryMultiple('SELECT *, jeux.nom AS vraiNom FROM alternates, jeux WHERE SOUNDEX(alternates.nom) = SOUNDEX("'.$_POST['title'].'") and alternates.id_jeu = jeux.id');
		
		if(!empty($sameName) or !empty($alternateNames))
		{
			$games = createArrayGames($sameName, $alternateNames);
			
			echo '<div id="maybeAlready">';
			display('maybeAlreadyExists');
			
			foreach($games as $id => $game)
				displayGame($game['title'], $id, $game['console']);
			
			display('clickForReallyAdd');
			echo '</div>';
			
			$exists = TRUE;
		}
	}
	
	//Et enfin Levenshtein
	if($exists == FALSE)
	{
		$sameName = SelectQueryMultiple('SELECT * FROM jeux WHERE console = "'.$_POST['console'].'"');
		$alternateNames = SelectQuery('SELECT *, jeux.nom AS vraiNom FROM alternates, jeux WHERE jeux.console = "'.$_POST['console'].'" and alternates.id_jeu = jeux.id');
		
		$games = array();
		foreach($sameName as $game)
		{
			if(strlen($_POST['title']) >= 5 and strlen($game['nom']) >= 5 and levenshtein($_POST['title'], $game['nom']) <= 3)
			{
				$games[$game['id']]['title'] = $game['nom'];
				$games[$game['id']]['console'] = $game['console'];
			}
		}
		
		foreach($alternateNames as $game)
		{
			if(strlen($_POST['title']) >= 5 and strlen($game['vraiNom']) >= 5 and levenshtein($_POST['title'], $game['vraiNom']) <= 3)
			{
				$games[$game['id']]['title'] = $game['vraiNom'];
				$games[$game['id']]['console'] = $game['console'];
			}
		}
		
		if(!empty($games))
		{
			echo '<div id="maybeAlready">';
			display('maybeAlreadyExists');
			
			foreach($games as $id => $game)
				displayGame($game['title'], $id, $game['console']);
			
			display('clickForReallyAdd');
			echo '</div>';
			
			$exists = TRUE;
		}
	}
}

//Si on est ici c'est que le jeu n'existe pas déjà, ou qu'on force son ajout
if($_POST['force'] == 'true' || $exists == FALSE)
{
	$numericId = checkVotant($id, $ip, $language);
	
	$gameId = InsertQuery('INSERT INTO jeux(nom, console, genre) VALUES("'.$_POST['title'].'","'.$_POST['console'].'", "'.$_POST['genre'].'")');
	
	if($_POST['alternates'] != '')
	{
		$alternates = split(';;;', str_replace('\n', ';;;', $_POST['alternates']));
		$alternates = array_map('trim', $alternates);
		$alternates = array_unique($alternates);
		
		foreach($alternates as $alt)
			InsertQuery('INSERT INTO alternates(id_jeu, nom) VALUES("'.$gameId.'", "'.$alt.'")');
	}                                        
	
	
	InsertQuery('INSERT INTO votes(id_votant, id_jeu, timestamp) VALUES("'.$numericId.'", "'.$gameId.'", "'.fromUnix(time()).'")');
	
	echo '<div id="gameAdded">';
	display('gameAdded');
	echo '</div>';
}

?>
