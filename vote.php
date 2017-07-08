<?php
	require_once './Includes/Partials/header.php';
  require_once './Database/dbHelper.php';
	if(isset($_GET['poll']) && !empty($_GET['poll'])){
	$dbHelp = new dbHelp;
  $link = base_convert($_GET['poll'],36,10);
  $question = $dbHelp->select("question","Question",array("questionID"=>$link));
  if(empty($question)){
    redirect::to(404);
  }
  $answer = $dbHelp->select("answerID,answer","Answers",array("questionID"=>$link));
  print_r($answer);
?>
<form method="POST" action="Handlers/insetVote.php">
<fieldset>
  <legend><?=$question[0]["question"]?></legend>
  <?php
    foreach ($answer as $key => $value){
  ?>
  <label >
    <input type="radio"  name="userAnswerID" value="<?=$value['answerID']?>"> <span><?=$value['answer']?></span>
  </label>
  <?php
    }
  ?>
  <input type="hidden" name="questionID" value="<?=$link?>">
</fieldset>
<input type="submit" name="submit" class="voteButton" value="Vote">
</form>
<?php
}
	require_once './Includes/Partials/footer.php';
?>