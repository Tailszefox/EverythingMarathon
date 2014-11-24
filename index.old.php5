<?php include('header.php5'); include('sql.php5');

function enough($target)
{
	global $nbVoters;
	if($nbVoters >= $target)
		echo '<strong>'.display('ok', false).'</strong>';
}
?>
<p class="big"><?php display('welcome'); ?></p>
<div class="justify">
<?php display('intro'); ?>
</div>
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
<div>
<p class="big"><?php display('currentVoters'); ?> 
<?php 
$results = SelectQuery('SELECT COUNT(*) as nbVotants FROM votants');
$nbVoters = $results['nbVotants'];
echo $nbVoters;
?>
</p>
<table id="voters">
<thead>
<tr>
	<td><?php display('numberOfGames'); ?></td>
	<td><?php display('numberofVoters'); ?></td>
	<td>&nbsp;</td>
</tr>
</thead>
<tr>
	<td>1</td>
	<td>10</td>
	<td><?php enough(10); ?></td>
</tr>
<tr>
	<td>2</td>
	<td>20</td>
	<td><?php enough(20); ?></td>
</tr>
<tr>
	<td>3</td>
	<td>30</td>
	<td><?php enough(30); ?></td>
</tr>
<tr>
	<td>4</td>
	<td>40</td>
	<td><?php enough(40); ?></td>
</tr>
<tr>
	<td>5</td>
	<td>50</td>
	<td><?php enough(50); ?></td>
</tr>
<tr>
	<td>6</td>
	<td>65</td>
	<td><?php enough(65); ?></td>
</tr>
<tr>
	<td>7</td>
	<td><?php display('lotsOfVoters') ?></td>
	<td><?php enough(9000); ?></td>
</tr>
<?php
/*
<tr>
	<td>8</td>
	<td><?php display('lotsOfVoters') ?></td>
	<td><?php enough(9000); ?></td>
</tr>
<?php
<tr>
	<td>9</td>
	<td>90</td>
	<td><?php enough(90); ?></td>
</tr>
<tr>
	<td>10</td>
	<td>100</td>
	<td><?php enough(100); ?></td>
</tr>
<tr>
	<td>11</td>
	<td>120</td>
	<td><?php enough(120); ?></td>
</tr>
<tr>
	<td>12</td>
	<td>140</td>
	<td><?php enough(140); ?></td>
</tr>
<tr>
	<td>13</td>
	<td>160</td>
	<td><?php enough(160); ?></td>
</tr>
<tr>
	<td>14</td>
	<td>180</td>
	<td><?php enough(180); ?></td>
</tr>
<tr>
	<td>15</td>
	<td>200</td>
	<td><?php enough(200); ?></td>
</tr>
<tr>
	<td>16</td>
	<td><?php display('lotsOfVoters') ?></td>
	<td><?php enough(9000); ?></td>
</tr>
*/ ?>
</table>
</div>
<?php include('footer.php5'); ?>

