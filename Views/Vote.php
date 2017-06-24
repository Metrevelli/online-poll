
<?php
	require_once './Includes/Partials/header.php';
  echo $_GET['url'];
?>
<fieldset>
  <legend>text here!</legend>
  <label for="accessible">
    <input type="radio" value="pretty" name="quality" id="accessible"> <span>ravi</span>
  </label>

  <label for="pretty">
    <input type="radio" value="pretty" name="quality" id="pretty"> <span>hmmm..</span>
  </label>

  <label for="accessible-and-pretty">
    <input type="radio" value="pretty"  name="quality" id="accessible-and-pretty" > <span>KI!!!</span>
  </label>
</fieldset>
<input type="submit" name="submit" class="voteButton" value="Vote">
<?php
	require_once './Includes/Partials/footer.php';
?>