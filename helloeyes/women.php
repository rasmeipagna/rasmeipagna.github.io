<?php
require_once("inc/init.inc.php");
$resultat_article = $mysqli->query("SELECT titre,photo, prix FROM article WHERE genre ='f'");
require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");
?>

<section>
	<body>
		<div class="row"><h1 class="bg title_font center">Pour Femmes</h1></div>
			
			<?php
			while($article = $resultat_article->fetch_assoc())
			{	

				echo '<div class="row float size margin">';
				echo '<h1>'.$article['titre'].'</h1>';				
				echo '<img src="'.$article['photo'].'" width="280" height="200">';
				echo '<p>'.'Prix : '.$article['prix'].'€'.'</p>';
				echo '<a id="lien1" class="trans1" href="fiche_article.php?id_article='.$article['id_article'].'">'.'Voir +'.'</a><br>';

				if(utilisateurEstConnecte()){
			    echo '<a id="lien1" class="trans1" href="panier.php">'.'Ajouter au panier'.'</a><br>';
			    
			  	}else{
			  	echo '<a id="lien1" class="trans1" href="connexion.php">'.'Connectez-vous pour l\'ajouter au panier'.'</a><br>';
			  	
			  	}
			  	echo '</div>';
			}
			?>
	</body>
</section>

<?php
require_once("inc/footer.inc.php");