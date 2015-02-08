<?php session_start(); ?>
<?php require('include/inc_refresh.php'); ?>
<?php require_once ('include/inc_connexion.php'); ?>


<?php 
//***MANQUE COOKIE***

 // Verification existence $_POST

if (!empty ($_POST))
{

foreach ($_POST as $key => $value)//boucle pour extraire l'id produit
{
$id = $key;
}
	// vérification existence $_SESSION ['panier']
	if (!isset ($_SESSION ['panier']))
	{
	$_SESSION ['panier'] = array();
	}

	if (isset ($_SESSION ['panier'][$id]))
	{
		$rep = $bdd -> prepare ('SELECT StockProduct FROM products WHERE IDProduct = ?');

		$rep -> execute (array($id));

		$row = $rep -> fetch();

		$stock = $row['StockProduct'];


			if ((!empty ($stock)) AND ($_SESSION ['panier'][$id] < $stock))
			{
	
			$_SESSION ['panier'][$id]++;
			
			}
	}
	else
	{
	$_SESSION ['panier'][$id] = 1; //qte à 1
	}
	var_dump($_SESSION['panier']);
}
elseif (empty($_SESSION['panier']))
{
	$message='Votre panier est vide.';
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
<div id="wrapper">

<?php require_once ('include/inc_header.php') ?>

<h1 class="titre_panier">Votre Panier</h1>

<?php
if (isset ($message))
{
?>
<p class="erreur"><?php echo $message;
exit; ?></p>
<?php
}

if (isset ($_SESSION ['stock_error']))
{
?>
<p class="erreur"><?php echo $_SESSION ['stock_error'];?></p>
<?php
unset ($_SESSION ['stock_error']);
}
?>

<section>

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




<tbody>
<?php 
foreach ($_SESSION ['panier'] as $key => $qte)
{


$rep = $bdd -> prepare ('SELECT * FROM products WHERE IDProduct= ?');
$rep -> execute (array($key));

$donnees = $rep -> fetch();

$nom = $donnees ['NameProduct'];
$prix = $donnees ['PriceProduct'];
$prix_total = $prix*$qte;
$total['total'] = $prix_total + $prix_total ;

?>

<tr>
<td><?php echo $nom; ?></td>
<td><a class="choix_quantite" href="include/less.php?id=<?php echo $key; ?>">-</a><span><?php echo $qte;?></span><a class="choix_quantite" href="include/add.php?id=<?php echo $key;?>">+</a></td>
<td><?php echo $prix.'€'; ?></td>
<td><?php echo $prix_total.'€'; ?></td>
<td><a class="supprimer_article" href="include/del.php?id=<?php echo $key; ?>">x</a></td>
</tr>



<?php
}


?>
</tbody>

<tfoot>
<tr>
<td class="no_border"></td>
<td class="no_border"></td>
<td class="table_bold">TOTAL</td>
<td><?php echo $total ['total'].'€'; ?> </td>
</tr>
<tr>
<td class="no_border"></td>
<td class="no_border"></td>
<td class="table_bold">dont TVA 20%</td>
<td><?php echo round ($tva = $total ['total'] -($total ['total']/1.2),2).'€' ;?></td>
</tr>
</tfoot>


</table>


<form action="#">
<input id="valider_panier" type="submit" name="valider" value="Valider le panier" />
</form>
</section>

<?php require_once('include/inc_footer.php'); ?>

</div>
</body>

</html>