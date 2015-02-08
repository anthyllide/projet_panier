<?php

if (!empty($_POST))
{
$_SESSION['sauvegarde'] = $_POST;
$fichier=$_SERVER['PHP_SELF'];
header('location:'.$fichier);
exit;
}

if (isset($_SESSION['sauvegarde']))
{
$_POST = $_SESSION['sauvegarde'];
unset ($_SESSION['sauvegarde']);
}