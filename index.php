
<?php
require_once './Includes/Partials/header.php';
require_once './func/functions.php';
?>
<form action="Handlers/createPoll.php" method="POST" >
<fieldset>
  <legend><input type="text" name="question" class="question" placeholder="Type your Question here" style="" spellcheck="false"></legend>

    <input type="text" name="answer[]" id="accessible" class="answer" placeholder="Type your answer here">

    <input type="text" name="answer[]" id="accessible" class="answer" placeholder="Type your answer here">

    <input type="text" name="answer[]" id="accessible" class="answer" placeholder="Type your answer here">

    <input type="text" name="answer[]" id="accessible" class="answer" placeholder="Type your answer here">

    <input type="text" name="answer[]" id="accessible" class="answer" placeholder="Type your answer here">

</fieldset>
<input type="submit" name="submit" class="voteButton" value="Create Poll">
</form>
<?php
	require_once './Includes/Partials/footer.php';
?>
