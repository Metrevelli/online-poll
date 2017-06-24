<?php
route::set("index.php",function(){
	Vote::createView("Index");
});
route::set("vote",function(){
	Vote::createView("Vote");
});
?>