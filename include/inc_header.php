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

<?php if (!empty($_SESSION ['panier']))
{
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
else
{
?>
<p>Panier vide</p>
<?php
}
?>
</aside>

</header>