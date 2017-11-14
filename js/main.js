$(document).ready(function(){
	element = document.querySelector(".addAnswer");
		element.addEventListener("click",function(){
			$("fieldset").append("<input type='text' name='answer[]' id='accessible' class='answer' placeholder='Type your answer here'>");
		});
})
