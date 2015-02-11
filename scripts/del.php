<?php
session_start();

if ((isset ($_GET['id'])) AND (count($_SESSION['panier']) > 1))
{
$id=$_GET['id'];

unset ($_SESSION ['panier'][$id]);

header('location:../panier.php');
exit;

}
elseif ((isset ($_GET['id'])) AND (count($_SESSION['panier']) === 1))
{

$_SESSION ['panier'] = array();

header('location:../panier.php');
exit;
}