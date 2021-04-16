<?php
require_once("../inc/init.inc.php");

if(!utilisateurEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}
/********************SUPPRESSION********************/
if(isset($_GET['action']) && $_GET['action']== 'suppression')
{
	$resultat =executeRequete("SELECT * FROM article WHERE id_article='$_GET[id_article]'");
	$article_a_supprimer = $resultat->fetch_assoc();
	$chemin_photo = RACINE_SERVER . $article_a_supprimer['photo'];

	if(!empty($article_a_supprimer['photo']) && file_exists($chemin_photo))
	{
		unlink($chemin_photo);
	}
	executeRequete("DELETE FROM article WHERE id_article = '$_GET[id_article]'");
	$_GET['action'] = 'affichage';
}
/********************FIN SUPPRESSION********************/
/***************** ENREGITREMENT ARTICLE ********************/

if(isset($_POST['enregistrement']))
{
	foreach($_POST AS $indice => $valeur)
	{
		$_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
	}
	extract($_POST);
	$reference_article= executeRequete("SELECT * FROM article WHERE id_article = '$id_article'"); // faire une requete en bdd
	if($reference_article->num_rows >0 && isset($_GET['action']) && $_GET['action'] == 'ajout')// si la référence existe
	{
		$msg .='<div class="erreur"><p>La référence est déjà attribuée. Veuillez vérifier vos saisies</p></div>';
	}else{
	    $photo = "";

	    if(isset($_GET['action']) && $_GET['action'] == 'editer')
	    {
	      $photo = $_POST['photo_actuelle'];
	    }

	    if(!empty($_FILES['photo']['name']))
	    {
	     if(verificationExtensionPhoto())
	     {
	      $nom_photo = $_POST['reference'].'_'.$_FILES['photo']['name'];
	      $photo = RACINE_SITE . "photo/$nom_photo";
	      $photo_dossier = RACINE_SERVER . RACINE_SITE . "photo/$nom_photo";
	      copy($_FILES['photo']['tmp_name'], $photo_dossier);
	     }
	     else{
	      $msg .='<div class="erreur"><p>L\'extension n\'est pas valide. Extension acceptées : png / gif / jpg / jpeg !</p></div>';
	     }
	    }
	}
	if(empty($msg))
	{
		executeRequete("REPLACE INTO article (id_article, reference, categorie, titre, description, genre, photo, prix, stock, couleur) VALUES ('$id_article','$reference', '$categorie','$titre', '$description', '$genre', '$photo', '$prix','$stock', '$couleur')");
	}
  	if(isset($_GET['action']) && $_GET['action'] == 'editer')
	  {
	    $msg .='<div class="confirm"><p>L\'article a bien été modifié.</p></div>';
	  }
	  if(isset($_GET['action']) && $_GET['action'] == 'ajout')
	  {
	    $msg .='<div class="confirm"><p>L\'article a bien été ajouté.</p></div>';
	  }

}

/***************** FIN ENREGITREMENT ARTICLE ********************/


require_once("../inc/header.inc.php");
require_once("../inc/nav.inc.php");
echo $msg
?>

<section>
	<body>
		<div class="row center">
			<h1>Gestion des articles</h1>
			<a id="lien1" class="trans1" href="?action=affichage"> Afficher les articles </a>-
			<a id="lien1" class="trans1" href="?action=ajout"> Ajouter un article </a>
		</div>
		<?php
		//*************AFFICHAGE DES ARTICLES *********************//
		if(isset($_GET['action']) && $_GET['action'] =='affichage')
		{
		  echo '<hr>';
		  echo '<p class="f-size">'.'Affichage des articles'.'</p>';
		  $resultat = executeRequete("SELECT * FROM article ORDER BY id_article DESC");
		  echo '<p class="f-size">Nombre d\'article(s): '.$resultat->num_rows.'</p>';
		  echo '<table border="1">';

		  echo '<tr>';
		  while($titre = $resultat->fetch_field())
		  {
		    echo '<th>'.$titre->name.'</th>'; // première ligne contenant les noms de nos colonnes
		  }
		  echo '<th>Modif</th><th>Suppr</th></tr>';
		  while($ligne = $resultat->fetch_assoc())
		  {
		    echo '<tr>';
		    foreach($ligne AS $indice => $valeur)
		    {
		      if($indice == 'photo') // $indice est strictement égal à photo
		      {
		        echo '<td><img src="'.$valeur.'" width="150"></td>'; // on insère un img src et la valeur correspondante à la photo pour afficher la photo
		      }else{
		        echo '<td>'.$valeur.'</td>';
		      }

		    }
		    echo '<td><a href="?action=editer&id_article='.$ligne['id_article'].'"><img src="../images/modif.png" alt=""></a></td>';
		    echo '<td><a href="?action=suppression&id_article='.$ligne['id_article'].'"onClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../images/erase.png" alt="supprimer"></a></td>';
		    echo '</tr>';
		  }
		  echo'</table>';


		}
		//************* FIN AFFICHAGE DES ARTICLES *********************//
		//************* AFFICHAGE DU FORMULAIRE *********************//
		if(isset($_GET['action']) && ($_GET['action'] =='ajout' || $_GET['action'] =='editer'))
		{
		  if(isset($_GET['id_article']))
		  {
		    $resultat = executeRequete("SELECT * FROM article WHERE id_article='$_GET[id_article]'");
		    $article_actuel= $resultat->fetch_assoc();
		  }
		?>
		<hr>
		<div class="row">
	        <form class="size-form" method="post" action="" enctype="multipart/form-data">
	        <!-- l'attribut enctype="multipart/form-data" est obligatoire en cas d'upload de fichier -->

	        <h1>Formulaire Article</h1>

	        <input type="hidden" name="id_article" id="id_article" value="<?php if(isset($article_actuel['id_article'])) { echo $article_actuel['id_article'];}?>"/>

	        <label for="reference">Référence</label>
	        <input class="ligne" type="text" name="reference" id="reference" value="<?php if(isset($_POST['reference'])) { echo $_POST['reference']; }elseif(isset($article_actuel['reference'])) { echo $article_actuel['reference']; } ?>" placeholder="Entrer un numéro de référence..."/><br />

	        <label for="categorie">Catégorie</label>
	        <input class="ligne" type="text" name="categorie" id="categorie" value="<?php if(isset($_POST['categorie'])) {echo $_POST['categorie']; }elseif(isset($article_actuel['categorie'])) { echo $article_actuel['categorie'];} ?>" placeholder="Optique/Solaire"/><br />

	        <label for="titre">Titre</label>
	        <input class="ligne" type="text" name="titre" id="titre" value="<?php if(isset($_POST['titre'])) {echo $_POST['titre']; }elseif(isset($article_actuel['titre'])) { echo $article_actuel['titre']; } ?>" placeholder="Titre..."/><br />

	        <label for="description">Description</label>
	        <textarea style="font-size:14px" type="text" name="description" id="description" placeholder="Vendez nous du rêve..."><?php if(isset($_POST['description'])) {echo $_POST['description']; }elseif(isset($article_actuel['description'])) { echo $article_actuel['description']; } ?></textarea><br />

	        <label for="couleur">Couleur</label>
	        <input class="ligne" type="text" name="couleur" id="couleur" value="<?php if(isset($_POST['couleur'])) {echo $_POST['couleur']; }elseif(isset($article_actuel['couleur'])) { echo $article_actuel['couleur'];} ?>"/><br />

	        <label for="genre">Sexe</label>
	          &nbsp;&nbsp;
	          <input type="radio" id="genre" name="genre" value="m" class="radio-inline" <?php if(isset($_POST['genre']) && $_POST['genre'] == "m") { echo 'checked';}elseif(isset($article_actuel['genre']) && $article_actuel['genre'] == 'm') { echo 'checked';}elseif(!isset($_POST['genre']) && !isset($article_actuel['genre'])) { echo 'checked'; } ?> />Homme

	          <input type="radio" id="genre" name="genre" value="f" class="radio-inline" <?php if(isset($_POST['genre']) && $_POST['genre'] == "f"){echo 'checked';}elseif(isset($article_actuel['genre']) && $article_actuel['genre'] == 'f') { echo 'checked';} ?>/>Femme
	          <br /><br />

	        <label>Photo</label>
	        <input class="ligne" style="font-size:12px" type="file" name="photo"/><br />
	        <?php
	        if(isset($article_actuel))
	        {
	          echo '<label for="photo">Photo Actuelle:</label><br/>';
	          echo '<img src="'.$article_actuel['photo'].'"width="140"/>';
	          echo '<input type="hidden" name="photo_actuelle" value="'.$article_actuel['photo'].'"/><hr/>';
	        }
	        ?>

	        <label for="prix">Prix</label>
	        <input class="ligne" type="text" name="prix" id="prix" value="<?php if(isset($_POST['prix'])) {echo $_POST['prix']; }elseif(isset($article_actuel['prix'])) { echo $article_actuel['prix'];} ?>" /><br />

	        <label for="stock">Stock</label>
	        <input class="ligne" type="text" name="stock" id="stock" value="<?php if(isset($_POST['stock'])) {echo $_POST['stock']; } elseif(isset($article_actuel['stock'])) { echo $article_actuel['stock'];} ?>" /><br />



			<input id="btn" name="enregistrement" type="submit" value="<?php echo ucfirst($_GET['action']);?>" class="trans1"/>
<?php
}
//*************FIN AFFICHAGE DU FORMULAIRE*********************//
?>
	        </form>
	    </div>

	</body>
</section>

<?php
require_once("../inc/footer.inc.php");
