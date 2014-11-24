<?php
//Détecte la langue voulue par le visiteur : formulaire, cookie, puis headers. Si tout rate, passer en anglais
if(isset($_GET['languageList']))
{
	$language = $_GET['languageList'];
	setcookie('language', $language, time()+3600*24*15);
	$type = 'form';
}

elseif(isset($_COOKIE['language']))
{
	$language = $_COOKIE['language'];
	$type = 'cookie';
}

elseif(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
{
	//On regarde quelles langues le visiteur accepte
	preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);
	
	if (count($lang_parse[1])) {
		$acceptLangs = array_combine($lang_parse[1], $lang_parse[4]);
		foreach ($acceptLangs as $lang => $val) {
			if ($val === '') $acceptLangs[$lang] = 1;
		}
		arsort($acceptLangs, SORT_NUMERIC);
		$acceptLangs = array_reverse($acceptLangs);
	}
	
	//On regarde sa langue préférée
	foreach($acceptLangs as $lang => $val)
	{
		if(strpos($lang, 'fr') === 0)
			$language = 'french';
		elseif(strpos($lang, 'en') === 0)
			$language = 'english';
	}

	setcookie('language', $language, time()+3600*24*15);
	$type = 'http';
}
else
	$language = 'english';

//Charge le fichier de langue
if(file_exists('./' . $language . '.xml'))
{
	$languageFile = simplexml_load_file('./' . $language . '.xml');
}
else
{
	$language = 'english';
	$languageFile = simplexml_load_file('./english.xml');
}
	
foreach($languageFile->text as $text)
{
	$idLanguage = (string) $text['id'];
	$texts[$idLanguage] = (string) str_replace('{{', '<', str_replace('}}', '>', $text));
}

//Noms des consoles et des genres
$consolesNames = array('NES', 'SNES', 'Nintendo 64', 'Gamecube', 'Wii', 'Game Boy/Color', 'GBA', 'Master System', 'Game Gear', 'Mega Drive/Genesis', 'Saturn', 'Dreamcast', 'PlayStation', 'PlayStation 2', 'PlayStation 3', 'Xbox', 'Xbox 360');

foreach($consolesNames as $key => $console)
{
	$consoles[strtolower($console)] = $console;
}

$genresEnglish = array('Beat \'em up', 'Platform game', 'First Person Shooter', 'Third Person Shooter', 'Shoot \'em up', 'Action-Adventure', 'Adventure', 'RPG', 'Strategy', 'Racing', 'Rhythm game', 'Party game', 'Puzzle game', 'Sports');
$genresEnglish[] = 'Other';

$genresFrench = array('Beat \'em up', 'Jeu de plateforme', 'FPS', 'TPS (Third Person Shooter)', 'Shoot \'em up', 'Action-Aventure', 'Aventure', 'RPG', 'Stratégie', 'Course', 'Rhythm game', 'Party game', 'Puzzle game', 'Sport');
$genresFrench[] = 'Autre';

if($language == 'english')
{
	$genresNames = $genresEnglish;
	$consoles['other'] = 'Other';
}
elseif($language == 'french')
{
	$genresNames = $genresFrench;
	$consoles['other'] = 'Autre';
}

for($i = 0; $i < sizeof($genresEnglish); $i++)
{
	$genres[strtolower(str_replace(' ', '_', str_replace('\'', '', $genresEnglish[$i])))] = $genresNames[$i];
}

asort($genres);

//Fonction d'affichage du texte correspondant à l'ID avec remplacement des variables
function display($key, $display = true)
{
	global $texts;
	
	$text = $texts[$key];
	/*
	$args = func_get_args();
	$id = $args[0];
	$text = $texts[$id];
	
	for($i = 1; $i < func_num_args(); $i++)
	{
		$text = str_replace('$' . $i, $args[$i], $text); 
	}
	*/
	
	if($display)
		echo $text;
	else
		return $text;
}
?>
