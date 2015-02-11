<?php
if (!empty ($_POST)) //si $_POST n'est pas vide 
{

foreach ($_POST as $key => $value)//boucle pour extraire l'id produit
{
$id = $key;
}


	if (isset ($_SESSION ['panier'][$id])) //si le produit fait déjà partie du panier
	{
		$rep = $bdd -> prepare ('SELECT StockProduct FROM products WHERE IDProduct = ?');

		$rep -> execute (array($id));

		$row = $rep -> fetch();

		$stock = $row['StockProduct'];

			// si le produit existe bien dans la table produit et si le stock est inférieur à la quatité
			if ((!empty ($stock)) AND ($_SESSION ['panier'][$id] < $stock))
			{
	
			$_SESSION ['panier'][$id]++; //alors on ajoute 1
			
			//mise à jour cookie

			$panier = $_SESSION ['panier'];
			$cookie = serialize($panier);

			setcookie('panier', $cookie, time()+ 1296000);
			
			}
				
	}
	
	else //si le produit ne fait pas partie du panier
	{
	$_SESSION ['panier'][$id] = 1; //alors la qte vaut 1
	
	$panier = $_SESSION ['panier'];
	$cookie = serialize($panier);

	setcookie('panier', $cookie, time()+ 1296000); // création du cookie
	}

	
}

//sinon si le panier est vide ou est égale à un array vide
elseif (empty($_SESSION['panier']) OR ($_SESSION['panier'] === array()))
{

	if (!empty($_COOKIE ['panier']))//si le cookie n'est pas vide
	{
	//alors on vide le cookie et rechargement de la page 
	setcookie ('panier', NULL , -1);
	header('location:panier.php');
	exit;
	
	}
	
	$message='Votre panier est vide.';
	
}
