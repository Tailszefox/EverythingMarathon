<?php include('header.php5'); include('ip.php5');?>
<noscript><p><strong><?php display('javascriptDisabled'); ?></strong></p></noscript>
<!--
<p><strong><?php display('canAdd'); ?></strong></p>
-->
<!-- Add form -->
<!--
<p id="add"><span id="linkAdd"><?php display('addNewGame') ?></span></p>
<form id="addForm" class="hidden" action="">

<div id="formItself">
<p><?php display('beforeAdding') ?></p>
<p><label for="titleAdd"><?php display('title') ?></label>
<input type="text" name="title" id="titleAdd" />
</p>

<p><label for="consolesAdd"><?php display('console') ?></label>
<select id="consolesAdd" name="consoles">
<?php
foreach($consoles as $key => $console)
{
	echo '<option value="'.$key.'">' . $console . '</option>';
}
?>
</select>
</p>

<p class="hidden" id="consolesOtherAddParagraph"><label for="consolesOtherAdd"><?php display('consoleName') ?></label>
<input type="text" name="consolesOther" id="consolesOtherAdd"/>
</p>

<p><label for="genresAdd"><?php display('genre') ?></label>
<select id="genresAdd" name="genres">
<?php
foreach($genres as $key => $genre)
{
	echo '<option value="'.$key.'">' . $genre . '</option>';
}
?>
</select>
</p>

<p><label for="alternatesAdd"><?php display('alsoKnownAs') ?><br />
<span class="small"><?php display('alsoKnownAsExplanation') ?></span>
</label>
<textarea id="alternatesAdd" name="alternates" rows="2" cols="50">
</textarea>
</p>

<p><label for="captchaAdd"><?php display('captcha') ?><br />
<span class="small"><?php display('captchaExplanation') ?></span>
</label>
<input type="text" id="captchaAdd" name="captcha" />
</p>
</div>

<p><input type="submit" name="submit" id="submitAdd" value="<?php display('addThisGame') ?>" />
<br /><input type="submit" name="submit" id="submitReallyAdd" class="hidden" value="<?php display('reallyAddThisGame') ?>" /></p>
</form>

<div id="result">&nbsp;</div>
-->

<!-- Search form -->
<form id="searchForm" action="">
<div>
<input type="text" name="title" id="titleSearch" value="<?php display('title') ?>" title="<?php display('title') ?>"/>
<select id="consolesSearch" name="consoles">
<option value="none"></option>
<optgroup label="<?php display('console') ?>">
<?php
foreach($consoles as $key => $console)
{
	echo '<option value="'.$key.'">' . $console . '</option>';
}
?>
</optgroup>
</select>

<input type="text" class="hidden" name="consolesOther" id="consolesOtherSearch" value="<?php display('consoleName') ?>" title="<?php display('consoleName') ?>"/>
<select id="genresSearch" name="genres">
<option value="none"></option>
<optgroup label="<?php display('genre') ?>">
<?php
foreach($genres as $key => $genre)
{
	echo '<option value="'.$key.'">' . $genre . '</option>';
}
?>
</optgroup>
</select>
<input type="submit" name="submit" id="search" value="<?php display('search') ?>"/>
</div>
</form>
<div id="searchResult">&nbsp;</div>

<div id="topGames">
	<p><strong><?php display('topGames'); ?></strong></p>
	<div id="topGamesTable">&nbsp;</div>
</div>

<div id="lastVotes">
	<p><strong><?php display('lastVotes'); ?></strong></p>
	<div id="lastVotesTable">&nbsp;</div>
</div>

<div id="lastGames">
	<p><strong><?php display('lastGames'); ?></strong></p>
	<div id="lastGamesTable">&nbsp;</div>
</div>
<?php include('footer.php5'); ?>
