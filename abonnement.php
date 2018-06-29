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
		<h1>Liste des abonements:</h1>
		<?php
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=epitech_tp;charset=utf8', 'root', 'arnauddu30');
			$abo = $bdd->query('SELECT id_abo, nom, resum, prix, duree_abo FROM abonnement');
			echo "<div id='abo'>";
			echo "<table>
					<tr>
						<th>Type</th>
						<th>Description</th>
						<th>Prix(€)</th>
						<th>Duree(j)</th>
					</tr>";
			while($a = $abo->fetch())
			{
				echo '<tr>'.
				'<td>' . $a['nom'] . '</td>'.
				'<td>' . $a['resum'] . '</td>'.
				'<td>' . $a['prix'] . '</td>'.
				'<td>' . $a['duree_abo'] . '</td>'.
				'<tr>';
			}
			echo "</div></table>";
			$red = $bdd->query('SELECT id_reduction, nom, pourcentage_reduc FROM reduction');
			echo "<h2>Reductions possibles:</h2>";
			echo "<div id='red'>";
			echo "<table>
					<tr>
						<th>Type</th>
						<th>reduction(en %)</th>
					</tr>";
			while($r = $red->fetch())
			{
				echo '<tr>'.
				'<td>' . $r['nom'] . '</td>'.
				'<td>' . $r['pourcentage_reduc'] . '</td>'.
				'<tr>';
			}
			echo "</div></table>";
		?>
	</article>

	<footer>
	</footer>
</body>
</html>