<?php include('header.php5'); include('sql.php5');
?>
<p class="big"><?php display('marathonInProgress'); ?></p>
<p><a href="marathon.php5" id="newPage"><?php display('newPage'); ?></a></p>

<div>
<object type="application/x-shockwave-flash" data="http://www.ustream.tv/flash/live/1/1001710" width="400" height="320" id="utv458829">
    	<param name="flashvars" value="autoplay=false&amp;brand=embed"/>
	<param name="allowfullscreen" value="true"/>
	<param name="allowscriptaccess" value="always"/>
	<param name="movie" value="http://www.ustream.tv/flash/live/1/1001710"/>
	<param name="classid" value="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" />
</object>
</div>

<p><?php display('gamesPlayed'); ?></p>
<table>
<?php 
echo '<thead><tr><td>'.display('title', false).'</td><td>'.display('status', false).'</td><td>'.display('started', false).'</td><td>'.display('finished', false).'</td></tr></thead>'; 
?>
<tr>
	<td>GoldenEye 007</td>
	<td><?php display('inProgress'); ?></td>
	<td>14:00</td>
	<td></td>
</tr>
</table>

<p><?php display('twitter') ?></p>
<iframe src="http://www.ustream.tv/twitterjs/iframe?prefix=%23EverythingMarathon&amp;suffix=Live+at+http%3A%2F%2Fustre.am%2F4cAC" width="549" height="325" frameborder="0" style="border:0px none transparent" scrolling="no"></iframe>

<p><?php display('chatNewPage') ?></p>
<?php include('footer.php5'); ?>

