<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>my_cinema</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<header>
		<a id='ger' href="gerer.php">Gerer son abonnement</a>
		<a href="index.php"><img id='logo' src="img/Cinema.png"></a>
		<div id='button'>
			<a class='buttons' href="abonnement.php">Abonnements</a>
			<a class='buttons' href="historique.php">Historique</a>
			<a class='buttons' href="avis.php">Avis</a>
		</div>
	</header>
	<article>
		<?php
			if(!isset($_POST['identify']))
			{
				echo "<h1>Se connecter:</h1>";
				echo "<p class='ps'>Pseudo:<input class='txt' type='text' name='pseudo'/></p>
					<p class='ps'>Mdp:<input class='txt' type='text' name='mdp'/></p>";
				echo "<p id='psc'><a href='inscription.php'>Pas encore de compte ?</a></p>";
			}
		?>
	</article>

	<footer>
	</footer>
</body>
</html>