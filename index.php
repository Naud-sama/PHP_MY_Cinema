<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>my_cinema</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<header>
		<a id='ger' href="gerer.php">Manage your subscription</a>
		<a href="index.php"><img id='logo' src="img/Cinema.png"></a>
		<div id='button'>
			<a class='buttons' href="abonnement.php">Subscribe</a>
			<a class='buttons' href="historique.php">History</a>
			<a class='buttons' href="avis.php">Opinion</a>
		</div>
	</header>

	<article>
		<form method="post">
			<div id="search">
				<input type="search" name="search"/>
				<button>Search</button>
			</div>
			<div id ="filter">
				<p>
					<label for="genre">Kind:</label><br />
					<select name="genre" id="genre">
						<option value="tout" name='genre'>All</option>
						<?php
							$bdd = new PDO('mysql:host=127.0.0.1;dbname=epitech_tp;charset=utf8', 'root', 'arnauddu30');
							$gen = $bdd->query('SELECT nom FROM genre ORDER BY nom');
							while($g = $gen->fetch())
							{
								if($g['nom'] != 'exp&amp;atilde;&amp;copy;rimental')
									echo '<option value=' . $g['nom'] . '>' . ucfirst($g['nom']) . '</option>';
							}
						?>
					</select>
				</p>
				<p>
					<label for="distrib">Distributors:</label><br />
					<select name="distrib" id="distrib">
						<option value="tout" name='distrib'>All</option>
						<?php
							$bdd = new PDO('mysql:host=127.0.0.1;dbname=epitech_tp;charset=utf8', 'root', 'arnauddu30');
							$dis = $bdd->query('SELECT nom FROM distrib ORDER BY nom');
							while($d = $dis->fetch())
							{
								if ($d['nom'] != 'british path&amp;atilde;&amp;copy;' && $d['nom'] != 'france 3 cin&amp;atilde;&amp;copy;ma' && $d['nom'] != 'path&amp;atilde;&amp;copy;' && $d['nom'] != 'path&amp;atilde;&amp;copy; distribution ltd.' && $d['nom'] != 'v&amp;atilde;&amp;copy;rtigo films')
									echo '<option value=' . $d['nom'] . '>' . ucfirst($d['nom']) . '</option>';
							}
						?>
					</select>
				</p>
				<!--<label for="date">Date:</label><br />
				<input type="date" name="date">-->
			</div>
		</form>
		<?php
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=epitech_tp;charset=utf8', 'root', 'arnauddu30');
			if(isset($_POST['search']) AND !empty($_POST['search']))
			{
				$search = htmlspecialchars($_POST['search']);
				if($_POST['genre'] == 'tout' && $_POST['distrib'] == 'tout')
				{
					$film = $bdd->query('SELECT titre FROM film WHERE titre LIKE "%' . $search . '%"');
					echo "<div id='block'>";
					while($f = $film->fetch())
					{
						echo '<p>' . $f['titre'] . '</p><br>';
					}
					echo "</div>";
				}
				elseif ($_POST['distrib'] == 'tout' && $_POST['genre'] != 'tout')
				{
					$gen = $_POST['genre'];
					echo "<div id='block'>";
					$genre = $bdd->query('SELECT titre, nom FROM film, genre WHERE film.id_genre = genre.id_genre AND nom = "'.$gen.'" AND titre LIKE "%' . $search . '%"');
					while($g = $genre->fetch())
					{
						echo '<p>' . $g['titre'] . '</p><br>';
					}
					echo "</div>";
				}
				elseif ($_POST['genre'] == 'tout' && $_POST['distrib'] != 'tout')
				{
					$dist = $_POST['distrib'];
					echo "<div id='block'>";
					$dis = $bdd->query('SELECT titre, nom FROM film, distrib WHERE film.id_distrib = distrib.id_distrib AND nom LIKE "%'.$dist.'%" AND titre LIKE "%' . $search . '%"');
					while($d = $dis->fetch())
					{
						echo '<p>' . $d['titre'] . '</p><br>';
					}
					echo "</div>";
				}
				else
				{
					$gen = $_POST['genre'];
					$dis = $_POST['distrib'];
					echo "<div id='block'>";
					$all = $bdd->query('SELECT titre, film.id_distrib, genre.id_genre, genre.nom, distrib.nom, distrib.id_distrib FROM film, genre, distrib WHERE film.id_distrib = distrib.id_distrib AND film.id_genre = genre.id_genre AND genre.nom = "'.$gen.'" AND titre LIKE "%' . $search . '%" AND distrib.nom LIKE "%'.$dis.'%"');
					while($a = $all->fetch())
					{
						echo '<p>' . $a['titre'] . '</p><br>';
					}
					echo "</div>";
				}
			}
			elseif(isset($_POST['genre']) && $_POST['genre'] != 'tout' && $_POST['distrib'] == 'tout')
			{
				$gen = $_POST['genre'];
				echo "<div id='block'>";
				$genre = $bdd->query('SELECT titre, nom FROM film, genre WHERE film.id_genre = genre.id_genre AND nom = "' . $gen . '"');
				while($g = $genre->fetch())
				{
					echo '<p>' . $g['titre'] . '</p><br>';
				}
				echo "</div>";
			}
			elseif(isset($_POST['distrib']) && $_POST['distrib'] != 'tout' && $_POST['genre'] == 'tout')
			{
				$dis = $_POST['distrib'];
				echo "<div id='block'>";
				$dist = $bdd->query('SELECT titre, nom FROM film, distrib WHERE film.id_distrib = distrib.id_distrib AND nom LIKE "%'.$dis.'%"');
				while($d = $dist->fetch())
				{
					echo '<p>' . $d['titre'] . '</p><br>';
				}
				echo "</div>";
			}
			elseif(isset($_POST['genre']) && isset($_POST['distrib']))
			{
				$gen = $_POST['genre'];
				$dis = $_POST['distrib'];
				echo "<div id='block'>";
				$all = $bdd->query('SELECT titre, genre.nom, distrib.nom FROM film, genre, distrib WHERE film.id_distrib = distrib.id_distrib AND film.id_genre = genre.id_genre AND genre.nom = "'.$gen.'" AND distrib.nom LIKE "%'.$dis.'%"');
				while($a = $all->fetch())
				{
					echo '<p>' . $a['titre'] . '</p><br>';
				}
				echo "</div>";
			}
			else
			{
				echo "<div id='block'>";
				$allf = $bdd->query('SELECT titre FROM film');
				while($a = $allf->fetch())
				{
					echo '<p>' . $a['titre'] . '</p><br>';
				}
				echo "</div>";
			}
		?>
	</article>

	<footer>
	</footer>
</body>
</html>
<?php
/*
$page = isset($_GET['p']) ? (intval($_GET['p']) -1) : 0;
$items = isset($_GET['i']) ? $_GET['i'] : 10;

$db = new PDO('mysql:host=localhost;dbname=epitech_tp;charset=utf8', 'root', '');

$sql = 'SELECT * FROM film ORDER BY id_film ASC LIMIT '.($page * $items).', '.$items;
$req = $db->query($sql);

while($datas = $req->fetch()){
	echo $datas['id_film']." - ".$datas['titre'];
	echo "<hr />";
}

$sql2 = 'SELECT COUNT(id_film) FROM film';
$req = $db->query($sql2);
$nb_film = $req->fetch()[0];
for ($i=0; $i < ($nb_film / $items); $i++){
	$style="";
	
	if($i == $page) $style="color:red";
	echo "<a style='".$style."' href='?p=".($i+1)."&i=".$items."'>".($i+1)."</a> - ";
	
	
}

echo "<hr />";
echo $sql;*/
?>