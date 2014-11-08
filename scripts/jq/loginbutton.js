window.onload = function()
{
 	init();
}

function init()
{
 	changeText();
}

function changeText()
{
  	document.getElementById('loginbutton').innerHTML = "<li id = 'loginbutton'><a href='account.php'>Account</a></li>";
}