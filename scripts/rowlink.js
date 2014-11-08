$(document).ready(function() {     
	$("tr").click(function(event) {
  		if(event.target.nodeName != "A"){
    	window.location.href = $(this).attr("title");
  	}
	});
});