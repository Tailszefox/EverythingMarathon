<?php
include('language.php5');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" type="image/png" href="favicon.png" />
<style type="text/css">
body
{
	background-image: url('background.png');
	background-repeat: repeat-x;
	background-color: #99e3df;
	font-family: Arial, serif;
	color: black;
}

#cont
{
	padding-bottom: 5px;
	height: 320px;
}

#chatCont
{
	float: left;
	width: 100%;
	margin-right: -410px;
	
}

#chat
{
	margin-right: 410px;
}

#chatConsole
{
	width: 100%;
}

#stream
{
	float: right;
	width: 400px;
}

#fullpage
{
	width: 95%;
	background-image: url('milieu.png');
	border: 1px solid blue;
	text-align: left;
	margin: auto;
	padding: 5px;
}

.center
{
	text-align: center;
}

a
{
	color: white;
	text-decoration: none;
	border-bottom: 1px dashed white;
}

a:hover
{
	color: #99e3df;
	border-bottom: 1px dashed #99e3df;
}

</style>
<title>Everything Marathon</title>
<?php if($language == 'english') { ?>
<!--[if lte IE 6]><script src="ie6/warning.js"></script><script>window.onload=function(){e("ie6/")}</script><![endif]-->
<?php } elseif($language == 'french') {
?>
<!--[if lte IE 6]><script src="ie6/warningFrench.js"></script><script>window.onload=function(){e("ie6/")}</script><![endif]-->
<?php
}
?>
<head>
<body>
<div id="fullpage">
	<div id="cont">
		<div id="chatCont">
			<div id="chat">
				<object type="application/x-shockwave-flash" data="http://www.ustream.tv/flash/irc.swf" height="320" id="chatConsole">
					<param name="flashvars" value="hannelId=1001710&amp;brandId=1&amp;channel=#everythingmarathon&amp;server=chat1.ustream.tv" />
					<param name="allowfullscreen" value="true" />
					<param name="movie" value="http://www.ustream.tv/flash/irc.swf" />
					<param name="pluginspage" value="http://www.adobe.com/go/getflashplayer" />
				</object>
			</div>
		</div>
	
		<div id="stream">
		<object type="application/x-shockwave-flash" data="http://www.ustream.tv/flash/live/1/1001710" width="400" height="320" id="utv458829">
			<param name="flashvars" value="autoplay=false&amp;brand=embed"/>
			<param name="allowfullscreen" value="true"/>
			<param name="allowscriptaccess" value="always"/>
			<param name="movie" value="http://www.ustream.tv/flash/live/1/1001710"/>
			<param name="classid" value="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" />
		</object>
		</div>
		</div>
	
	<p class="center"><?php display('chat2') ?></p>
	<p class="center"><a href="index.php5"><?php display('backMainPage') ?></a></p>
</div>
</body>
</html>
