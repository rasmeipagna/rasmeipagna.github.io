<?php
require_once("inc/init.inc.php");
/*INSCRIPTION*/
if(isset($_POST['inscription']))
{	foreach($_POST AS $indice => $valeur)
	{
		$_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
	}
	extract($_POST);
	$reference_membre= executeRequete("SELECT * FROM membre WHERE id_membre = '$id_membre'");
	if($reference_membre->num_rows >0 && isset($_GET['action']) && $_GET['action'] == 'inscription')
	{
		$msg .='<div class="erreur"><p>La référence est déjà attribuée. Veuillez vérifier vos saisies</p></div>';
	}else{
	    $photo = "";

	    if(isset($_GET['action']) && $_GET['action'] == 'inscription')
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
	$verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']);
	if(!$verif_caractere && !empty($_POST['pseudo']))
	{
		$msg .='<div class="erreur"><p>Caractères acceptés: a-A à z-Z et de 0 à 9</p></div>';
	}
	if(strlen($_POST['pseudo']) <3 || strlen($_POST['pseudo']) > 14)
	{
		$msg .='<div class="erreur"><p>Le pseudo doit avoir entre 3 et 14 caractères</p></div>';
	}
	$verif_caractere2= preg_match('#^[@a-zA-Z0-9._-]+$#', $_POST['email']);
	if(!$verif_caractere2 && !empty($_POST['email']))
	{
		$msg .='<div class="erreur"><p>Caractères acceptés: a-A à z-Z et de 0 à 9</p></div>';
	}
	if(strlen($_POST['email']) <3 || strlen($_POST['email']) > 55)
	{
		$msg .='<div class="erreur"><p>L\'email doit avoir la forme suivante : votremail@mail.com</p></div>';
	}
	if(empty($msg)) // si $msg est valide alors il n'y a pas d'erreur !
	{
		$membre = executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
		if($membre->num_rows > 0)
		{
			$msg .='<div class="erreur"><p>Pseudo indisponible</p></div>';
		}
		$membre = executeRequete("SELECT * FROM membre WHERE email='$_POST[email]'");
		if($membre->num_rows > 0)
		{
			$msg .='<div class="erreur"><p>Email indisponible</p></div>';
		}
		else{
			foreach($_POST AS $indice => $valeur)
			{
				$_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
			}
			$msg .='<div class="confirm"><p>Vous êtes bien inscrit. Veuillez vous connecter !</p></div>';

			//$_POST['mdp'] = md5($_POST['mdp']); // pour crypter le mot de passe
			extract($_POST);  // crée des variables avec le nom des indices du tableau ARRAY. Cette variable contint la valeur

			executeRequete("INSERT INTO membre(pseudo, mdp, nom, prenom, email, sexe, photo, ville, cp, adresse, inscription) VALUES ('$pseudo', '$mdp', '$nom', '$prenom', '$email','$sexe', '$photo', '$ville','$cp', '$adresse', NOW())");

		}
	}
}
/*CONNEXION*/
if(isset($_GET['action']) && $_GET['action']== 'deconnexion')
{
  session_destroy();
}

if(utilisateurEstConnecte())
{
  header("location:profil.php");
}
if(isset($_POST['connexion']))
{
	foreach($_POST AS $indice => $valeur)
			{
				$_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
			}
			extract($_POST);
			$selection_membre = executeRequete("SELECT * FROM membre WHERE pseudo = '$pseudo' AND mdp='$mdp'");
			if($selection_membre->num_rows != 0)
			{
        		$membre = $selection_membre->fetch_assoc();
        		foreach($membre AS $indice => $valeur)
        		{
		          if($indice != 'mdp')
		          {
		          $_SESSION['utilisateur'][$indice] = $valeur;
		          }
        	}
        header("location:profil.php");
			}
			else{
				$msg .='<div class="erreur"><p>Votre pseudo ou votre mot de passe n\'est pas correct. Veuillez recommencer ou contacter l\'administrateur du site pour récupérer votre mot de passe !</p></div>';
			}
}
require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");
echo $msg;
?>

<section>
	<body>
<!-- Inscription -->
		<div class="row float size-form">

			<form method="post" action="#">
				<h1 class="title_font">Inscription</h1>
				<label for="pseudo">Pseudo</label>
      			<input class="ligne" type="text" id="pseudo" name="pseudo" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo']; }?>" placeholder="Votre pseudo..."/><br/>

      			<label for="password">Mot de passe</label>
      			<input class="ligne" type="password" id="password" name="mdp" value="<?php if(isset($_POST['password'])) {echo $_POST['password']; }?>"  placeholder="Votre mot de passe..."/><br/>

      			<label for="nom">Nom</label>
      			<input class="ligne" type="text" id="nom "name="nom" value="<?php if(isset($_POST['nom'])) {echo $_POST['nom']; }?>" placeholder="Nom"/><br/>

      			<label for="prenom">Prénom</label>
      			<input class="ligne" type="text" id="prenom "name="prenom" value="<?php if(isset($_POST['prenom'])) {echo $_POST['prenom']; }?>" placeholder="Prénom"/><br/>

      			<label for="email">Email</label>
      			<input class="ligne" type="text" id="email"name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email']; }?>" placeholder="votrenom@email.com"/><br/><br>

      			<label for="sexe">Sexe</label>
      			<input class="radio" type="radio" id="sexe" name="sexe" value="m"<?php if(isset($_POST['sexe']) && $_POST['sexe'] == "m"){echo 'checked';}elseif(!isset($_POST['sexe'])) {echo 'checked';} ?>/>Homme
      			<input class="radio" type="radio" id="sexe" name="sexe" value="f"<?php if(isset($_POST['sexe']) && $_POST['sexe'] == "f"){echo 'checked';} ?>/>Femme<br/><br>

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

      			<label>Adresse</label>
      			<textarea id="adresse" name="adresse" placeholder="Veuillez indiquer votre adresse..."><?php if(isset($_POST['adresse'])) {echo $_POST['adresse']; }?></textarea><br/><br>


      			<label for="ville">Ville</label>
      			<input class="ligne" type="text" id="ville" name="ville" value="<?php if(isset($_POST['ville'])) {echo $_POST['ville']; }?>" placeholder="Ville"/><br/>

      			<label for="cp">Code Postal</label>
      			<input class="ligne" type="text" id="cp" name="cp" value="<?php if(isset($_POST['cp'])) {echo $_POST['cp']; }?>" placeholder="Code Postal"/><br/>

      			<input id="btn" class="trans1" type="submit" name="inscription" value="Inscription" /><br/>

			</form>
		</div>
<!-- Connexion -->
			<div class="row float size-form">


  				<form method="post" action="">
  				<h1 class="title_font">Connexion</h1>
      			<label for="pseudo">Pseudo</label>
      			<input type="text" id="pseudo" name="pseudo" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo']; }?>" class="ligne" placeholder="pseudo..."/><br/>

      			<label for="password">Mot de passe</label>
      			<input type="password" id="password" name="mdp" value="" class="ligne" placeholder="mot de passe..."/><br/>

      			<input id="btn" name="connexion" type="submit" value="Connexion" class="trans1"/><br/>

      			</form>

      		</div>
      		
      		<div id="image" class="row float size-form m" style="margin-left:200px;margin-top:0;">
      			<a href="#"><img src="images/inspi_pink6.jpg" alt="fade in fade out" title="glasses_cool" width="100%"></a>
      		</div>

	</body>
</section>

<?php
require_once("inc/footer.inc.php");
