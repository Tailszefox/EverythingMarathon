<?php
include('language.php5');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" type="image/png" href="favicon.png" />
<title>Everything Marathon</title>

<?php if($language == 'english') { ?>
<!--[if lte IE 6]><script src="ie6/warning.js"></script><script>window.onload=function(){e("ie6/")}</script><![endif]-->
<?php } elseif($language == 'french') {
?>
<!--[if lte IE 6]><script src="ie6/warningFrench.js"></script><script>window.onload=function(){e("ie6/")}</script><![endif]-->
<?php
}
?>
<link rel="stylesheet" type="text/css" href="style.css" media="screen, projection"/>
<link rel="stylesheet" type="text/css" href="styleTopMenu.css" media="only screen and (max-width: 1000px)" />

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.mediaqueries.js"></script>
<script type="text/javascript" src="javascript.js"></script>

</head>
<body>

<div id="header">
	<form method="get" action="" id="languageSelect">
		<div>
		<?php display('language') ?> :
		<select id="languageList" name="languageList">
			<option value="english" <?php echo ($language == 'english')? 'selected="selected"':'' ?>><?php display('english') ?></option>
			<option value="french" <?php echo ($language == 'french')? 'selected="selected"':''?>><?php display('french') ?></option>
		</select>
		</div>
		<noscript><div id="languageSubmit"><input type="submit" value="Change language" /></div></noscript>
	</form>
</div>

<div id="menu">
<div id="menuTop">&nbsp;</div>
<div id="menuContent">
<p><a href="index.php5"><?php display('menuMain') ?></a></p>
<p style="text-decoration: line-through;"><a href="vote.php5"><?php display('menuVote') ?></a></p>
<p><a href="faq.php5"><?php display('menuFaq') ?></a></p>
<p><a href="mailto:contact@everythingmarathon.net"><?php display('menuContact') ?></a></p>
</div>
<div id="menuBottom">&nbsp;</div>
</div>

<div id="menuTopScreen">
<a href="index.php5"><?php echo str_replace('<br />', ' ', display('menuMain', false)) ?></a> | 
<a href="vote.php5" style="text-decoration: line-through;"><?php echo str_replace('<br />', ' ', display('menuVote', false))  ?></a> | 
<a href="faq.php5"><?php echo str_replace('<br />', ' ', display('menuFaq', false))  ?></a> | 
<a href="mailto:contact@everythingmarathon.net"><?php echo str_replace('<br />', ' ', display('menuContact', false))  ?></a>
</div>

<div id="content">
