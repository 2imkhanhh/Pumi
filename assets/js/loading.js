
var base_url='';
	
if(window.location.host=='localhost')
{
	var url = window.location.href;
	var arr = url.split("/");
	
	base_url= window.location.protocol + "//" + window.location.host + "/" + arr[3];
}
 else
	base_url= window.location.protocol + "//" + window.location.host;

