<header>

<h1><span class="lettrage">M</span>a <span class="lettrage">P</span>'tite <span class="lettrage">B</span>outique</h1>

<nav>
<ul>
<li><a href="index.php">Accueil</a></li>
<li><a href="#">Notre société</a></li>
</ul>
</nav>

<aside id="panier">
<p><a href="panier.php">Votre panier</a></p>

<?php 
//si le panier n'est pas vide
if (!empty($_SESSION ['panier']))
{
	$nb_article = count($_SESSION ['panier']); //on compte le nb d'éléments du panier
	
		if ($nb_article === 1) // pour écrire article sans S !
		{
		?>
		<p><?php echo $nb_article.' article';?></p>
		<?php
		}
		else
		{
		?>
		<p><?php echo $nb_article.' articles';?></p>
		<?php
		}
	
}
elseif (isset($_COOKIE['panier'])) // qd on retourne sur le site plus tard, on joue sur le cookie
{
$_SESSION ['panier'] = unserialize ($_COOKIE['panier']); //on désérialise le cookie

	$nb_article = count($_SESSION ['panier']);
	
		if ($nb_article === 1)
		{
		?>
		<p><?php echo $nb_article.' article';?></p>
		<?php
		}
		else
		{
		?>
		<p><?php echo $nb_article.' articles';?></p>
		<?php
		}

}
else // s'il n'y a pas de session, ni de cookie
{
?>
<p>Panier vide</p>
<?php
}
?>
</aside>

</header>