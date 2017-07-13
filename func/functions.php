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
	if(!empty($get) && !empty($link)){
		return $link[0]["link"];
	}
	redirect::to("../index.php");
}
function insertUserVote($postt){
	$convertedLink = base_convert($postt["questionID"],10,36);
	$realLink = $postt["questionID"];
	$answerID = $postt['userAnswerID'];
	if(!checkUserIpAddress($realLink)){
		if(empty($answerID))
			redirect::to("../vote.php?poll=$convertedLink");
		$dbHelp = new dbHelp;
		$votes = $dbHelp->select("votes","Answers",array("answerID" => $answerID));
		$insertIp = insertUserIpAddress($realLink);
		$updateVotes = $dbHelp->update("Answers",array("votes" => ($votes[0]["votes"] + 1)),array("answerID" => $answerID));
		if($updateVotes && $insertIp)
			redirect::to("../result.php?result=$convertedLink");
	}
	redirect::to("../result.php?result=$convertedLink");
}
function insertUserIpAddress($questionID){
	$dbHelp = new dbHelp;
	$ip = getRealIpAddr();
	$insertIp = $dbHelp->insert("userVotedPolls",array("IP_ADDRESS"=>$ip,"questionID"=>$questionID));
	return $insertIp;
}
function checkUserIpAddress($questionID){
	$dbHelp = new dbHelp;
	$ip = getRealIpAddr();
	$checkUserIp = $dbHelp->select("*","userVotedPolls",array("IP_ADDRESS"=>$ip,"questionID"=>$questionID));
	return $checkUserIp;
}
function getRealIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}