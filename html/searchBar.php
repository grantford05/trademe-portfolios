<?php
$self = htmlentities($_SERVER['PHP_SELF']);

echo(" 

		<div id = 'topNav'>

			<div id = 'navLogo'>

				<a href='index.php'>Portfolios</a>

			</div>

			<div id = 'searchBar'>

				<form action = 'search.php' method = 'POST'>
				
				<input type='text' id='searchInput' name='searchValue' placeholder='Looking for something in particular? Search here...' required  >

				<input type='submit' id='searchButton' name='searchButton' value='Search'>
				
				

				<ul id = 'mainNav'>
					<li><a href='browse.php'>Browse</a></li>
					<li><a href='workHome.php'>My Portfolio</a></li>");
					if(isset($_SESSION['userName']))
					{
						echo("<li><a href='account.php'>Account</a></li>");
					}
					else
					{
						echo("<li><a href='account.php'>Login</a></li>");
					}

					echo("</form>");
?>

				</ul>

			</div>

		</div> 

