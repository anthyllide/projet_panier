<?php require_once ('include/inc_connexion.php'); ?>
<?php session_start(); ?>

<?php
//récupération des produits
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
<header>
<h1>Ma p'tite boutique</h1>
</header>

<section>
<!-- Affichage des produits -->
<?php
foreach ($donnees as $key => $value)
{
$NameProduct=$value ['NameProduct'];
$PriceProduct = $value ['PriceProduct'];
$id = $value ['IDProduct'];
?>
<div class="article">

<h2><?php echo $NameProduct; ?></h2>
<p><?php echo $PriceProduct; ?></p>

<form action="panier.php" method="post">
<p><input type="submit" name="<?php echo $id; ?>" value="Ajouter au panier"/></p>
</form>

</div>
<?php
}
?>
</section>

<aside id="panier">
<p><a href="panier.php">Votre panier</a></p>
<p>Panier vide</p>
</aside>
<footer>
<span>Copyright : ma-ptite-boutique.</span>
<span><a href="mailto:info@ma-ptite-boutique.com">Nous contactez</a></span>
</footer>
</body>

</html>