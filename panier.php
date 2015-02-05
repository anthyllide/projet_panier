<?php require_once ('include/inc_connexion.php'); ?>
<?php session_start(); ?>

<?php 

 // Constitution panier


if (isset ($_POST))
{

foreach ($_POST as $key => $value)
{
$id = $key;
}

	if (!isset ($_SESSION ['panier']))
	{
	$_SESSION ['panier'] = array();
	}

	if (isset ($_SESSION ['panier'][$id]))
	{
	$_SESSION ['panier'][$id]++;
	}
	else
	{
	$_SESSION ['panier'][$id] = 1; //qte à 1
	}
}	
?>
	
	

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<title>Ma p'tite boutique</title>
<link rel="stylesheet" href="css/style.css" media="screen" />
</head>
<body>
<h1>Votre Panier</h1>
<table>

<thead>
<tr>
<th>Article</th>
<th>Quantité</th>
<th>Prix unitaire TTC</th>
<th>Prix total TTC</th>
<th>Supprimer</th>
</tr>
</thead>

<tfoot>
<tr>
<td></td>
<td></td>
<td>TOTAL</td>
<td>egal</td>
</tr>
<tr>
<td></td>
<td></td>
<td>dont TVA 20%</td>
<td>montant TVA</td>
</tr>
</tfoot>


<tbody>
<?php 
foreach ($_SESSION ['panier']['id'] as $IDProduct => $qte)
{

$rep = $bdd -> prepare ('SELECT * FROM products WHERE IDProduct= ?');
$rep -> execute (array($IDProduct));

$donnees = $rep -> fetch();

$nom = $donnees ['NameProduct'];
$prix = $donnees ['PriceProduct'];
$prix_total = $prix*$qte;


?>

<tr>
<td><?php echo $nom; ?></td>
<td><a href="#">-</a><span><?php echo $qte;?></span><a href="#">+</a></td>
<td><?php echo $prix; ?></td>
<td><?php echo $prix_total ?></td>
<td><a href="panier;php?ref="<?php echo $IDProduct ?>">x</a></td>
</tr>
<?php
}
?>
</tbody>

</table>


<form action="#">
<input type="submit" name="valider" value="Valider" />
</form>

<p><a href="index.php">Continuer vos achats</a></p>

</body>

</html>