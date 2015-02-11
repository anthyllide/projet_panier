<?php require_once ('include/inc_connexion.php'); ?>
<?php session_start(); ?>

<?php
//r�cup�ration des produits
$rep = $bdd -> query ('SELECT * FROM products');
$donnees = $rep -> fetchAll();

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

<section>
<!-- Affichage des produits -->
<?php
foreach ($donnees as $key => $value)
{
$NameProduct=$value ['NameProduct'];
$PriceProduct = $value ['PriceProduct'];
$id = $value ['IDProduct'];
$stock = $value ['StockProduct'];
?>

<div class="article">

<h2><?php echo $NameProduct; ?></h2>
<p class="prix"><?php echo $PriceProduct.'€'; ?></p>

<?php
if ($stock > 0) // si stock supérieur à 0 
{
?>

<form action="panier.php" method="post">
<p><input type="submit" name="<?php echo $id; ?>" value="Ajouter au panier"/></p>
</form>


<?php
}
else // si produit hors stock 
{
?>
<p class="reappro">En cours de réapprovisionnement</p>
<?php
}
?>
</div>
<div class="clear"></div>
<?php
}
?>

</section>

<?php require_once('include/inc_footer.php'); ?>

</div>
</body>

</html>