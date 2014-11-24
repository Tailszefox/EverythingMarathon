<?php include('header.php5'); include('sql.php5');
?>
<p class="big"><?php display('votesClosed'); ?></p>
<p><?php display('votesClosed2'); ?></p>
<table>
<?php 
echo '<thead><tr><td>'.display('title', false).'</td><td>'.display('console', false).'</td><td>'.display('genre', false).'</td><td>'.display('votes', false).'</td></tr></thead>'; 
$query = 'SELECT * FROM (SELECT *, jeux.nom as vraiNom, jeux.id as idJeu, COUNT(*) as nbVotes FROM jeux, votes WHERE jeux.id = votes.id_jeu GROUP BY votes.id_jeu) jeuxVotes ORDER BY jeuxVotes.nbVotes DESC LIMIT 6';
$games = SelectQueryMultiple($query);

foreach($games as $game)
{
	echo '<tr><td class="gameTitle">'.ucwords($game['vraiNom']).'</td>';
	if(isset($consoles[$game['console']]))
		echo '<td>'.$consoles[$game['console']].'</td>';
	else
		echo '<td>'.$game['console'].'</td>';
		
	echo '<td>'.$genres[$game['genre']].'</td>';
	echo '<td>'.$game['nbVotes'].'</td>';
	echo '</tr>';
}
?>
</table>

<p><?php display('votesClosed3'); ?></p>
<p><strong><?php display('bonusStage'); ?></strong></p>
<p><?php display('bonusStage2'); ?></p>
<p><strong><?php display('reminder'); ?></strong></p>

<div>
<object type="application/x-shockwave-flash" data="http://www.ustream.tv/flash/live/1/1001710" width="400" height="320" id="utv458829">
    	<param name="flashvars" value="autoplay=false&amp;brand=embed"/>
	<param name="allowfullscreen" value="true"/>
	<param name="allowscriptaccess" value="always"/>
	<param name="movie" value="http://www.ustream.tv/flash/live/1/1001710"/>
	<param name="classid" value="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" />
</object>
<hr style="width: 50%;"/>
<?php display('twitter') ?><br />
<iframe src="http://www.ustream.tv/twitterjs/iframe?prefix=%23EverythingMarathon&amp;suffix=Live+at+http%3A%2F%2Fustre.am%2F4cAC" width="549" height="325" frameborder="0" style="border:0px none transparent" scrolling="no"></iframe>

<hr style="width: 50%;"/>
<?php display('chat') ?><br />
<object type="application/x-shockwave-flash" data="http://www.ustream.tv/flash/irc.swf" width="563" height="266">
	<param name="flashvars" value="hannelId=1001710&amp;brandId=1&amp;channel=#everythingmarathon&amp;server=chat1.ustream.tv" />
	<param name="allowfullscreen" value="true" />
	<param name="movie" value="http://www.ustream.tv/flash/irc.swf" />
	<param name="pluginspage" value="http://www.adobe.com/go/getflashplayer" />
</object>
</div>
<?php include('footer.php5'); ?>

