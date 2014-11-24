<?php include('header.php5'); include('sql.php5');
?>
<p class="big"><?php display('marathonOver'); ?></p>
<p><?php display('marathonOver2'); ?></p>

<p><img src="voggle.png" alt="Voggle" /><br /><em><?php display('voggle'); ?></em></p>

<table>
<?php 
echo '<thead><tr><td>'.display('title', false).'</td><td>'.display('started', false).'</td><td>'.display('finished', false).'</td></tr></thead>'; 
?>
<tr>
	<td><strong>GoldenEye 007</strong></td>
	<td>25/07 14:00</td>
	<td>25/07 17:00</td>
</tr>
<tr>
	<td><strong>Streets of Rage</strong></td>
	<td>25/07 17:00</td>
	<td>25/07 17:45</td>
</tr>
<tr>
	<td><strong>GoldenEye 007</strong> <?php display('end'); ?></td>
	<td>25/07 17:45</td>
	<td>25/07 19:30</td>
</tr>
<tr>
	<td>Worms 2 (Bonus stage)</td>
	<td>25/07 19:30</td>
	<td>25/07 20:00</td>
</tr>
<tr>
	<td><strong>Paper Mario 2</strong></td>
	<td>25/07 20:00</td>
	<td>26/07 0:00</td>
</tr>
<tr>
	<td><strong>Kirby 64</strong></td>
	<td>26/07 0:00</td>
	<td>26/07 5:30</td>
</tr>
<tr>
	<td>Super Mario World (Bonus stage)</td>
	<td>26/07 5:30</td>
	<td>26/07 6:15</td>
</tr>
<tr>
	<td><strong>Paper Mario 2</strong> <?php display('continued'); ?></td>
	<td>26/07 6:15</td>
	<td>26/07 20:00</td>
</tr>
<tr>
	<td>1 vs. 100 (Bonus stage)</td>
	<td>26/07 20:00</td>
	<td>26/07 22:00</td>
</tr>
<tr>
	<td><strong>Paper Mario 2</strong> <?php display('end'); ?></td>
	<td>26/07 22:00</td>
	<td>27/07 0:40</td>
</tr>
<tr>
	<td><strong>The Legend of Zelda: The Wind Waker</strong></td>
	<td>27/07 0:40</td>
	<td>27/07 18:50</td>
</tr>
<tr>
	<td><strong>Shenmue</strong></td>
	<td>27/07 18:50</td>
	<td>28/07 8:00</td>
</tr>
</table>

<p><?php display('totalPlayTime')?></p>
<table>
<?php 
echo '<thead><tr><td>'.display('title', false).'</td><td>'.display('time', false).'</td></tr></thead>'; 
?>
<tr>
	<td>GoldenEye 007</td>
	<td>4:45</td>
</tr>
<tr>
	<td>Streets of Rage</td>
	<td>0:45</td>
</tr>
<tr>
	<td>Paper Mario 2</td>
	<td>20:25</td>
</tr>
<tr>
	<td>Kirby 64</td>
	<td>5:30</td>
</tr>
<tr>
	<td>The Legend of Zelda: The Wind Waker</td>
	<td>18:10</td>
</tr>
<tr>
	<td>Shenmue</td>
	<td>13:10</td>
</tr>
</table>

<p><?php display('uselessStream'); ?></p>
<div>
<object type="application/x-shockwave-flash" data="http://www.ustream.tv/flash/live/1/1001710" width="400" height="320" id="utv458829">
    	<param name="flashvars" value="autoplay=false&amp;brand=embed"/>
	<param name="allowfullscreen" value="true"/>
	<param name="allowscriptaccess" value="always"/>
	<param name="movie" value="http://www.ustream.tv/flash/live/1/1001710"/>
	<param name="classid" value="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" />
</object>
</div>

<!--
<p><?php display('twitter') ?></p>
<iframe src="http://www.ustream.tv/twitterjs/iframe?prefix=%23EverythingMarathon&amp;suffix=Live+at+http%3A%2F%2Fustre.am%2F4cAC" width="549" height="325" frameborder="0" style="border:0px none transparent" scrolling="no"></iframe>
-->

<p><?php display('chatOver') ?></p>
<object type="application/x-shockwave-flash" data="http://www.ustream.tv/flash/irc.swf" height="320" width="600">
	<param name="flashvars" value="hannelId=1001710&amp;brandId=1&amp;channel=#everythingmarathon&amp;server=chat1.ustream.tv" />
	<param name="allowfullscreen" value="true" />
	<param name="movie" value="http://www.ustream.tv/flash/irc.swf" />
	<param name="pluginspage" value="http://www.adobe.com/go/getflashplayer" />
</object>
<?php include('footer.php5'); ?>

