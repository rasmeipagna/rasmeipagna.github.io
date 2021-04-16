<?php
require_once("inc/init.inc.php");
$resultat_article = $mysqli->query("SELECT titre,photo, prix FROM article ORDER BY id_article DESC");
$categorie_article = executeRequete("SELECT DISTINCT categorie FROM article");
require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");

?>
<section>
	<body>

		<div class="col">
			 <!-- Début Sliders -->

            <div class="slider">
                <input type="radio" name="slide-switches" id="slide1" checked class="slide-switch">
                <label for="slide1" class="slide-label">Slide 1</label>
                    <div class="slide-content padded">
                        <img src="images/glasses2.jpg" alt="glasses">
                    </div>

                <input type="radio" name="slide-switches" id="slide2" class="slide-switch">
                <label for="slide2" class="slide-label">Slide 2</label>
                    <div class="slide-content">
                      <img src="images/glasses1.jpg" alt="glasses">
                    </div>

                <input type="radio" name="slide-switches" id="slide3" class="slide-switch">
                <label for="slide3" class="slide-label">Slide 3</label>
                    <div class="slide-content">
                       <img src="images/glasses3.jpg" alt="glasses">
                    </div>
            </div>
      <!-- Fin Slider-->
		</div> <!-- fin col1 -->

			<div class="row">
				<h1 class="title_font clearboth center">Hello Eyes is wearing you !</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc gravida luctus dolor et consequat. Curabitur sit amet lorem at arcu eleifend blandit sit amet nec lorem. Curabitur ac nibh eu augue condimentum sollicitudin sed id massa. Duis quis libero id enim consectetur ornare ac ultrices mauris. Integer nisi mauris, dictum nec dolor vitae, imperdiet maximus ex. Ut gravida venenatis dolor ut finibus. Maecenas at nulla tortor. Vivamus sed sagittis quam, non luctus nibh. Integer eu velit sit amet arcu luctus cursus. Integer risus leo, rhoncus vitae faucibus at, pretium at nibh. Suspendisse eu pretium purus, vitae euismod justo. In imperdiet augue ac tellus auctor congue. Vestibulum sit amet magna diam. Donec rutrum justo a odio vestibulum faucibus. Vestibulum sed massa volutpat, rhoncus quam et, consequat metus. Quisque nunc tellus, finibus nec blandit non, auctor ut purus. </p>

			</div>
			<div id="image" class="row float">
				<a href="#"><img class ="m" src="images/studio1.jpg" alt="fade in fade out" width="450px"></a>
				<a href="#"><img class ="m" src="images/studio2.jpg" alt="fade in fade out" width="450px"></a>
				<a href="#"><img class ="m" src="images/studio3.jpg" alt="fade in fade out" width="450px"></a>
				<a href="#"><img class ="m" src="images/studio4.jpg" alt="fade in fade out" width="450px"></a>

			</div>
			<div class="clearboth"></div>
			<div id="top" class="row"><h1 class="bg title_font center">Toutes nos lunettes</h1></div>
			<!-- affichage soit des optiques soit des solaires -->
			<?php
	 		echo '<ul class="m-cat">';
	 		
	       	while($categorie = $categorie_article->fetch_assoc())
	       		{

	       			echo '<li>News <a style="font-weight:bold;font-size:20px;" id="lien1" class="trans1" href="?categorie=' .$categorie['categorie'].'">' .$categorie['categorie'].'</a></li>';
	       		}
	       	echo '<li><a style="font-weight:bold;font-size:20px;" id="lien1" class="trans1" href="index.php">'.'Catalogue'.'</a></li>';
	       	echo'</ul>';
	       	?>
	       	<?php

	       	if(isset($_GET['categorie']))
	       	{
	       		$_GET['categorie'] = htmlentities(urldecode($_GET['categorie']));
	       		$donnees =executeRequete("SELECT * FROM article WHERE categorie = '$_GET[categorie]' ORDER BY id_article DESC LIMIT 0,6");
	       		while($article = $donnees->fetch_assoc())
	       		{
	       		echo '<div class="row float size margin">';
				echo '<h1><a id="lien1" class="trans1" href="fiche_article.php?id_article='.$article['id_article'].'">'.$article['titre'].'</a></h1>';
				echo '<a style="background-color:white;" id="lien1" class="trans1" href="fiche_article.php?id_article='.$article['id_article'].'"><img src="'.$article['photo'].'" width="220" alt="photo_lunettes" title="photo_lunettes"></a>';
				echo '<p>'.'Prix : '.$article['prix'].'€</p>';
				echo '<a id="lien1" class="trans1" href="fiche_article.php?id_article='.$article['id_article'].'">Voir +</a><br>';


					if(utilisateurEstConnecte()){
				    echo '<a id="lien1" class="trans1" href="panier.php">'.'Ajouter au panier'.'</a><br>';
				    echo '<hr>';

				  	}else{
				  	echo '<a id="lien1" class="trans1" href="connexion.php">'.'Connectez-vous pour l\'ajouter au panier'.'</a><br>';
				  	echo '<hr>';
				  	}
				 
			  	echo '</div>';
			  	

	       		}
	       		echo '<div id="image" class="row float">';
				echo '<a href="#"><img class ="m" src="images/horizontal-2.jpg" alt="fade in fade out" width="450px"></a>';
				echo '<a href="#"><img class ="m" src="images/horizontal-3.jpg" alt="fade in fade out" width="450px"></a>';
				echo '<a href="#"><img class ="m" src="images/present1.jpg" alt="fade in fade out" width="450px"></a>';
				echo '<a href="#"><img class ="m" src="images/present2.jpg" alt="fade in fade out" width="450px"></a>';

				echo '</div>';
	       		
	       		// <!-- affichage de la totalité + nouvelles lunettes catégories confondues -->
	       	}else{
	       		$mysqli = new Mysqli("cl1-sql23", "usj87943", "GBfiZlbF0u2M", "usj87943") or die ("oups : problème de connexion à la BDD !");
	       		$requete = "SELECT * FROM article ORDER BY id_article DESC";
	       		$resultat = $mysqli->query($requete);
	       		while($article = $resultat->fetch_assoc())

	       		{
	       			echo '<div class="row float size margin">';
					echo '<h1><a id="lien1" class="trans1" href="fiche_article.php?id_article='.$article['id_article'].'">'.$article['titre'].'</a></h1>';
	       			echo '<a style="background-color:white;"  id="lien1" class="trans1" href="fiche_article.php?id_article='.$article['id_article'].'"><img src="'.$article['photo'].'" width="220" alt="photo_lunettes" title="photo_lunettes"/></a>';
	       			echo '<p>'.'Prix : '.$article['prix'].'€</p>';
					echo '<a id="lien1" class="trans1" href="fiche_article.php?id_article='.$article['id_article'].'">Voir +</a><br>';
					echo '<hr>';

					echo '</div>';
	       		}

	       	}


			?>



	</body>
</section>
<?php
require_once("inc/footer.inc.php");
?>
