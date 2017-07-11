<?php

function createPoll($post){
  if(!empty($post['question']) && !empty($post['answer'])){
  		$dbHelp = new dbHelp;
  		$question = $post['question'];
  		$answers = $post['answer'];
		$insertedQuestionId = $dbHelp->insert("Question",array("question" => $question));
		$insertedLink = base_convert($insertedQuestionId, 10, 36);
		$dbHelp->insert("Link",array("link" => $insertedLink,"questionID" => $insertedQuestionId));
		foreach ($answers as $item) {
			if(!empty($item))
				$dbHelp->insert("Answers",array("answer"=>$item,"questionID"=>$insertedQuestionId,"votes" => 0));
		}
		redirect::to("../link.php?link=$insertedLink");
  }else{
  	redirect::to("../index.php");
  }
}
function generateLinks($get){
	$dbHelp = new dbHelp;
	$link = $dbHelp->select("link","Link",array("link"=>$get));
	// print_r($link);
	if(!empty($get) && !empty($link)){
		return $link[0]["link"];
	}
	redirect::to("../index.php");
}
function insertUserVote($postt){
	if(!empty($postt)){
		$dbHelp = new dbHelp;
		$answerID = $postt['userAnswerID'];
		$link = base_convert($postt["questionID"],10,36);
		$votes = $dbHelp->select("votes","Answers",array("answerID" => $answerID));
		$updateVotes = $dbHelp->update("Answers",array("votes" => ($votes[0]["votes"] + 1)),array("answerID" => $answerID));
		if($updateVotes)
			redirect::to("../result.php?result=$link");
	}
}