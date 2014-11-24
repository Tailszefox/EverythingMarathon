<?php include('header.php5'); ?>
<div class="big">FAQ</div>
<p><?php display('faqIntro'); ?></p>
<div class="justify">
<ul>
<?php
$i = 1;
while(isset($texts['question' . $i]))
{
	echo '<li class="question"><strong>';
	display('question' . $i);
	echo '</strong><ul><li class="answer">';
	display('answer' . $i);
	echo '</li></ul>';
	echo '</li>';
	$i++;
}
?>
</ul>
</div>
<?php include('footer.php5'); ?>
