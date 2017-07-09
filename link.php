<?php
	require_once './Includes/Partials/header.php';
	require_once './func/functions.php';
	require_once './Database/dbHelper.php';
	$link = generateLinks($_GET["link"]);
?>
<fieldset>
	<legend>Generated links</legend>

	Vote: <input type="text" name="vote" class="link" onClick="this.select();" style="margin-left:28px" value="http://localhost/online-poll/vote.php?poll=<?=$link?>">
	</br>
	Results: <input type="text" name="results" class="link" onClick="this.select();" style="margin-left:10px" value="http://localhost/online-poll/result.php?result=<?=$link?>">

</fieldset>
<input type="submit" name="submit" class="voteButton" value="New Poll" onclick="window.location='index.php';">
<?php
	require_once './Includes/Partials/footer.php';
?>