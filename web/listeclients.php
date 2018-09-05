<?php
//mockup datas
$mdata = [[
	"id"=>"1",
	"nom"=>"ARMANI",
	"prenom"=>"Sophie",
	"ville"=>"Nantes",
	"age"=>"25"
],[
	"id"=>"2",
	"nom"=>"BERURIER",
	"prenom"=>"Laurent",
	"ville"=>"Saint-Herblain",
	"age"=>"30"
]
];
$clients;
try {
	$pdo = new PDO('mysql:host=localhost;dbname=pizzeria', 'root', '');
	$clients = $pdo->query('SELECT * FROM client;')->fetchAll();
} catch (Exception $e) {
	echo "<div style=\"border:1px solid\"><span style=\"color:red;\">".$e->getMessage().'</span><span>'."/!\ using mockup datas</span></div>";
	$clients = $mdata;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Pizzeria Ria</title>
</head>
<body>
	<h3>Gestion des clients</h3>
	<a href="ajoutclient.php">Ajout</a> / <a href="..">Retour à l'accueil</a>
	<h2>Liste des clients</h2>
	<table><tr align="left"><th width="30">Id.</th>
		<th width="180">NOM</th>
		<th width="120">Prénom</th>
		<th width="180">Ville</th>
		<th width="30">Age</th></tr>
		<?php
		$template = <<<EOT
		<tr><td>{id}</td><td>{nom}</td><td>{prenom}</td><td>{ville}</td><td>{age}</td>
		<td><a href="#">Modifier</a></td><td><a href="#">Supprimer</a></td>
		</tr>
EOT;
			foreach ($clients as $aClient) {
				echo str_replace("{id}", $aClient['id'],
					str_replace("{nom}", $aClient['nom'],
					str_replace("{prenom}", $aClient['prenom'],
					str_replace("{ville}", $aClient['ville'],
					str_replace("{age}", $aClient['age'], $template)))));
			}
		?>
    </table>
</body>
</html>