<?php
  require_once '../core/autoLoadClass.php';
  require_once '../Database/dbHelper.php';
  if(!empty($_POST['question']) && !empty($_POST['answer'])){
  		$question = $_POST['question'];
  		$answers = $_POST['answer'];
		$dbHelp = new dbHelp;
		$insertedQuestionId = $dbHelp->insert("Question",array("question" => $question));
		$link = $insertedQuestionId, 20, 36;
		$dbHelp->insert("Link",array("link" => $link,"questionID" => $insertedQuestionId));
		foreach ($answers as $item) {
			if(!empty($item))
				$dbHelp->insert("Answers",array("answer"=>$item,"questionID"=>$insertedQuestionId));
		}

  }
?>