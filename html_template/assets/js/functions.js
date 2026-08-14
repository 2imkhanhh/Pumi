function initial_dialog(){
	
}

function open_dialog(text){
	
	$("#dialog").html(text);
	$("#dialog").dialog("open");
	
}
function round(num){

	return Math.ceil(num*100)/100;
}