<!-- Create the navbar to be displayed at top of every page
     Authors: Grant Ford and Lucas Mills
     Project: Trade Me Portfolios
     Date: 28/10/2014 -->

<?php
$self = htmlentities($_SERVER['PHP_SELF']);

echo(" 

		<div id = 'topNav'>

			<div id = 'navLogo'>

				<a class='image' href='index.php'><img src='/images/portLogo.png'></a>

			</div>

			<div id = 'searchBar'>

				<form action = 'search.php' method = 'POST'>
				
				<input type='text' id='searchInput' name='searchValue' placeholder='Looking for something in particular? Search here...' required  >

				<input type='submit' id='searchButton' name='searchButton' value='Search' onclick='location.href = 'search.php?'>
				
				

				<ul id = 'mainNav'>
					<li><a href='browse.php'>Browse</a></li>
					<li><a href='workHome.php'>My Portfolio</a></li>");
						if(isset($_SESSION['userName']))
						{
							echo("<li id = 'loginbutton'><a href='account.php'>Account</a></li>");
						}
						else
						{
							echo("<li id = 'loginbutton'><a href='account.php'>Login</a></li>");
						}
				echo("</ul>");

					echo("</form>");
?>

			</div>

		</div> 