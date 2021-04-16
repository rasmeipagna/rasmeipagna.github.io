<?php
require_once("../inc/init.inc.php");

if(!utilisateurEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}
/***************** SUPPRESSION ********************/
if(isset($_GET['action']) && $_GET ['action'] == 'suppression')
{
  $resultat = executeRequete("SELECT * FROM membre WHERE id_membre='$_GET[id_membre]'");
  $membre_a_supprimer = $resultat->fetch_assoc();
  executeRequete("DELETE FROM membre WHERE id_membre='$_GET[id_membre]'");
  $_GET['action'] = 'affichage';
}
/***************** FIN SUPPRESSION ********************/
/***************** ENREGITREMENT MEMBRE********************/

if(isset($_POST['enregistrement']))
{
	foreach($_POST AS $indice => $valeur)
	{
		$_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
	}
	extract($_POST);
	$reference_membre= executeRequete("SELECT * FROM membre WHERE id_membre = '$id_membre'");
	if($reference_membre->num_rows >0 && isset($_GET['action']) && $_GET['action'] == 'ajout')
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
		executeRequete("REPLACE INTO membre (id_membre, pseudo, mdp, nom, prenom, email, sexe, photo, ville, cp, adresse, statut, inscription) VALUES ('$id_membre','$pseudo', '$mdp','$nom', '$prenom', '$email', '$sexe', '$photo', '$ville', '$cp', '$adresse', '$statut', NOW())");
	}
	  if(isset($_GET['action']) && $_GET['action'] == 'editer')
	  {
	    $msg .='<div class="confirm"><p>Le membre a bien été modifié.</p></div>';
	  }
	  if(isset($_GET['action']) && $_GET['action'] == 'ajout')
	  {
	    $msg .='<div class="confirm"><p>Le membre a bien été ajouté.</p></div>';
	  }

}

require_once("../inc/header.inc.php");
require_once("../inc/nav.inc.php");
echo $msg
?>

<section>
	<body>

			<div class="row center">
       			<h1>Gestion des Membres</h1>
			      <a id="lien1" class="trans1" href="?action=affichage">Afficher les membres </a>-
			      <a id="lien1" class="trans1" href="?action=ajout"> Création d'un nouveau compte</a>
  			</div>




<?php
//*************AFFICHAGE DES MEMBRES *********************//
if(isset($_GET['action']) && $_GET['action'] =='affichage')
{
	echo '<hr>';
	echo '<p class="f-size">'.'Affichage des membres'.'</p>';
	$resultat = executeRequete("SELECT * FROM membre ORDER BY inscription DESC");
	echo '<p class="f-size">Nombre de membres: '.$resultat->num_rows.'</p>';
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
		        echo '<td><a href="'.$valeur.'"><img src="'.$valeur.'" width="150" alt="ordonnance" title="ordonnance"></a></td>'; // on insère un img src et la valeur correspondante à la photo pour afficher la photo
		      }else{
		        echo '<td>'.$valeur.'</td>';
		      }

		    }
	    echo '<td><a href="?action=editer&id_membre='.$ligne['id_membre'].'"><img src="../images/modif.png" alt=""></a></td>';
	    echo '<td><a href="?action=suppression&id_membre='.$ligne['id_membre'].'"onClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../images/erase.png" alt="supprimer"></a></td>';
	    echo '</tr>';
	  }
	  echo'</table>';


}

//************* FIN AFFICHAGE DES MEMBRES *********************//
//************* AFFICHAGE DU FORMULAIRE *********************//
if(isset($_GET['action']) && ($_GET['action'] =='ajout' || $_GET['action'] =='editer'))
{
  if(isset($_GET['id_membre']))
  {
    $resultat = executeRequete("SELECT * FROM membre WHERE id_membre='$_GET[id_membre]'");
    $membre= $resultat->fetch_assoc();
  }
?>
			<hr>
			<div class="row">
       			<form class="size-form" method="post" action="" enctype="multipart/form-data">

       			<h1>Modifier un membre</h1>
       			<input type="hidden" name="id_membre" id="id_membre" value="<?php if(isset($membre['id_membre'])) { echo $membre['id_membre'];}?>"/>

     			<label for="pseudo">Pseudo</label>
      			<input class="ligne" type="text" id="pseudo" name="pseudo" value="<?php if(isset($membre['pseudo'])) {echo $membre['pseudo']; }?>" placeholder="Votre pseudo..."/><br/>

      			<label for="password">Mot de passe</label>
      			<input class="ligne" type="password" id="password" name="mdp" value="<?php if(isset($membre['password'])) {echo $membre['password']; }?>"  placeholder="Votre mot de passe..."/><br/>

      			<label for="nom">Nom</label>
      			<input class="ligne" type="text" id="nom "name="nom" value="<?php if(isset($membre['nom'])) {echo $membre['nom']; }?>" placeholder="Nom"/><br/>

      			<label for="prenom">Prénom</label>
      			<input class="ligne" type="text" id="prenom "name="prenom" value="<?php if(isset($membre['prenom'])) {echo $membre['prenom']; }?>" placeholder="Prénom"/><br/>

      			<label for="email">Email</label>
      			<input class="ligne" type="text" id="email"name="email" value="<?php if(isset($membre['email'])) {echo $membre['email']; }?>" placeholder="Email"/><br/><br>

      			<label for="sexe">Sexe</label>
      			<input class="ok" type="radio" id="sexe" name="sexe" value="m"<?php if(isset($_POST['sexe']) && $_POST['sexe'] == "m"){echo 'checked';}elseif(!isset($_POST['sexe'])) {echo 'checked';} ?>/>Homme
      			<input class="ok" type="radio" id="sexe" name="sexe" value="f"<?php if(isset($_POST['sexe']) && $_POST['sexe'] == "f"){echo 'checked';} ?>/>Femme<br/><br>

      			 <label>Ordonnance</label>
		        <input class="ligne" style="font-size:12px" type="file" name="photo"/><br />
		        <?php
		        if(isset($article_actuel))
		        {
		          echo '<label for="photo">Ordonnance:</label><br/>';
		          echo '<img src="'.$article_actuel['photo'].'"width="140"/>';
		          echo '<input type="hidden" name="photo_actuelle" value="'.$article_actuel['photo'].'"/><hr/>';
		        }
		        ?>

      			<label for="adresse">Adresse</label>
        		<input type="text" name="adresse" id="adresse" value="<?php if(isset($_POST['adresse'])) {echo $_POST['adresse']; }elseif(isset($membre['adresse'])) { echo $membre['adresse'];} ?>" class="ligne" /><br />


      			<label for="ville">Ville</label>
      			<input class="ligne" type="text" id="ville" name="ville" value="<?php if(isset($membre['ville'])) {echo $membre['ville']; }?>" placeholder="Ville"/><br/>

      			<label for="cp">Code Postal</label>
      			<input class="ligne" type="text" id="cp" name="cp" value="<?php if(isset($membre['cp'])) {echo $membre['cp']; }?>" placeholder="Code Postal"/><br/>

      			<label for="statut">Statut</label>
      			<input class="ok" type="radio" id="statut" name="statut" value="1"<?php if(isset($_POST['statut']) && $_POST['statut'] == "1"){echo 'checked';}elseif(!isset($_POST['statut'])) {echo 'checked';} ?>/>Admin
      			<input class="ok" type="radio" id="statut" name="statut" value="0"<?php if(isset($_POST['statut']) && $_POST['statut'] == "0"){echo 'checked';} ?>/>Membre<br/><br>

      			<input id="btn" class="trans1" type="submit" name="enregistrement" value="<?php echo ucfirst($_GET['action']);?>" /><br/>


     			</form>
    		</div>
<?php
}
//*************FIN AFFICHAGE DU FORMULAIRE*********************//
?>
        
	</body>
</section>

<?php
require_once("../inc/footer.inc.php");
