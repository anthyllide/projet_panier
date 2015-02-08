<?php
session_start();
require_once ('inc_connexion.php'); 

$id= strip_tags($_GET['id']); //protection faille XSS

//ajout requete pour controler le stock et id

$rep = $bdd -> prepare ('SELECT StockProduct FROM products WHERE IDProduct = ?');

$rep -> execute (array($id));

$row = $rep -> fetch();

$stock = $row['StockProduct'];

if ((!empty ($stock)) AND ($_SESSION ['panier'][$id] > 0))
// pour éviter d'acheter une quantité négative !
{
$_SESSION ['panier'][$id] --;
header('location:../panier.php');
exit;
}
else
{
header('location:../panier.php');
exit;
}

