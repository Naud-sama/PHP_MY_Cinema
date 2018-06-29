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
		<form method="post">
			<input type="search" name="search"/>
			<button>Rechercher</button>
			<div id ="filter">
				<p>
					<label for="genre">Genre:</label><br />
					<select name="genre" id="genre">
						<option value="tout" name='genre'>Tout</option>
						<option value="Action" name='genre'>Action</option>
						<option value="Aventure" name='genre'>Adventure</option>
						<option value="Animation" name='genre'>Animation</option>
						<option value="Biography" name='genre'>Biography</option>
						<option value="Comedy" name='genre'>Comedy</option>
						<option value="Detective" name='genre'>Detective</option>
						<option value="Documentary" name='genre'>Documentary</option>
						<option value="Drama" name='genre'>Drama</option>
						<option value="Dramatic" name='genre'>Dramatic comedy</option>
						<option value="Erotic" name='genre'>Erotic</option>
						<option value="Experimental" name='genre'>Experimental</option>
						<option value="Family" name='genre'>Family</option>
						<option value="Fantasy" name='genre'>Fantasy</option>
						<option value="Historical" name='genre'>Historical</option>
						<option value="Historical epic" name='genre'>Historical epic</option>
						<option value="Horror" name='genre'>Horror</option>
						<option value="Karate" name='genre'>Karate</option>
						<option value="Music" name='genre'>Music</option>
						<option value="Musical" name='genre'>Musical</option>
						<option value="Program" name='genre'>Program</option>				
						<option value="Romance" name='genre'>Romance</option>
						<option value="Science fiction" name='genre'>Science fiction</option>
						<option value="Short film" name='genre'>Short film</option>
						<option value="Spying" name='genre'>Spying</option>
						<option value="Thriller" name='genre'>Thriller</option>
						<option value="Unknow" name='genre'>Unknow</option>
						<option value="Various" name='genre'>Various</option>
						<option value="War" name='genre'>War</option>
						<option value="Western" name='genre'>Western</option>
					</select>
				</p>
				<p>
					<label for="Distributeur">Distributeur:</label><br />
					<select name="Distributeur" id="Distributeur">
						<option value="tout" name='genre'>Tout</option>
					</select>
				</p>
			</div>
		</form>
		<?php
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=epitech_tp;charset=utf8', 'root', 'arnauddu30');
			$film = $bdd->query('SELECT titre FROM film');
			if(isset($_POST['search']) AND !empty($_POST['search']))
			{
				$search = htmlspecialchars($_POST['search']);
				if($_POST['genre'] == 'tout')
				{
					$film = $bdd->query('SELECT titre FROM film WHERE titre like "%' . $search . '%"');
					echo "<div id='block'>";
					while($f = $film->fetch())
					{
						echo '<p>' . $f['titre'] . '</p>';
					}
					echo "</div>";
				}
				else
				{
					$search = htmlspecialchars($_POST['search']);
					$gen = $_POST['genre'];
					echo "<div id='block'>";
					$genre = $bdd->query('SELECT titre, genre.id_genre, nom FROM film, genre WHERE film.id_genre = genre.id_genre AND nom LIKE "%' . $gen . '%" AND titre LIKE "%' . $search . '%"');
					while($g = $genre->fetch())
					{
						echo '<p>' . $g['titre'] . '</p>';
					}
					echo "</div>";
				}
			}
			elseif(isset($_POST['genre']))
			{
				$gen = $_POST['genre'];
				echo "<div id='block'>";
				$genre = $bdd->query('SELECT titre, genre.id_genre, nom FROM film, genre WHERE film.id_genre = genre.id_genre AND nom LIKE "%' . $gen . '%"');
				while($g = $genre->fetch())
				{
					echo '<p>' . $g['titre'] . '</p>';
				}
				echo "</div>";
			}
		?>
	</article>

	<footer>
	</footer>
</body>
</html>