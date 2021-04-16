<?php
require_once("inc/init.inc.php");
if($_POST)
{
	$verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']);
	if(!$verif_caractere && !empty($_POST['pseudo']))
	{
		$msg .='<div class="erreur"><p>Caractères acceptés: a-A à z-Z et de 0 à 9</p></div>';
	}
	if(strlen($_POST['pseudo']) <3 || strlen($_POST['pseudo']) > 14)
	{
		$msg .='<div class="erreur"><p>Le pseudo doit avoir entre 3 et 14 caractères</p></div>';
	}
	if(empty($msg)) // si $msg est valide alors il n'y a pas d'erreur !
	{
		$membre = executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
		if($membre->num_rows > 0)
		{
			$msg .='<div class="erreur"><p>Pseudo indisponible</p></div>';
		}
		else{
			foreach($_POST AS $indice => $valeur)
			{
				$_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
			}
			$msg .='<div class="confirm"><p>Vous êtes bien inscrit. Veuillez vous connecter sur la page de connexion !</p></div>';

			//$_POST['mdp'] = md5($_POST['mdp']); // pour crypter le mot de passe
			extract($_POST);  // crée des variables avec le nom des indices du tableau ARRAY. Cette variable contint la valeur

			executeRequete("INSERT INTO membre(pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse) VALUES ('$pseudo', '$mdp', '$nom', '$prenom', '$email','$sexe', '$ville','$cp', '$adresse')");

		}
	}
}
require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");

echo $msg;
?>

<section>
	<body>
		
		<div class="row">
			<h1 class="title_font">Inscription</h1>
			<form method="post" action="#">
				<label for="pseudo">Pseudo</label>
      			<input class="ligne" type="text" id="pseudo" name="pseudo" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo']; }?>" placeholder="Votre pseudo..."/><br/>

      			<label for="password">Mot de passe</label>
      			<input class="ligne" type="password" id="password" name="mdp" value="<?php if(isset($_POST['password'])) {echo $_POST['password']; }?>"  placeholder="Votre mot de passe..."/><br/>

      			<label for="nom">Nom</label>
      			<input class="ligne" type="text" id="nom "name="nom" value="<?php if(isset($_POST['nom'])) {echo $_POST['nom']; }?>" placeholder="Nom"/><br/>

      			<label for="prenom">Prénom</label>
      			<input class="ligne" type="text" id="prenom "name="prenom" value="<?php if(isset($_POST['prenom'])) {echo $_POST['prenom']; }?>" placeholder="Prénom"/><br/>

      			<label for="email">Email</label>
      			<input class="ligne" type="text" id="email"name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email']; }?>" placeholder="Email"/><br/><br>

      			<label for="sexe">Sexe</label>
      			<input class="ok" type="radio" id="sexe" name="sexe" value="m"<?php if(isset($_POST['sexe']) && $_POST['sexe'] == "m"){echo 'checked';}elseif(!isset($_POST['sexe'])) {echo 'checked';} ?>/>Homme
      			<input class="ok" type="radio" id="sexe" name="sexe" value="f"<?php if(isset($_POST['sexe']) && $_POST['sexe'] == "f"){echo 'checked';} ?>/>Femme<br/><br>

      			<label>Adresse</label>
      			<textarea id="adresse" name="adresse" placeholder="Veuillez indiquer votre adresse..."><?php if(isset($_POST['adresse'])) {echo $_POST['adresse']; }?></textarea><br/><br>


      			<label for="ville">Ville</label>
      			<input class="ligne" type="text" id="ville" name="ville" value="<?php if(isset($_POST['ville'])) {echo $_POST['ville']; }?>" placeholder="Ville"/><br/>

      			<label for="cp">Code Postal</label>
      			<input class="ligne" type="text" id="cp" name="cp" value="<?php if(isset($_POST['cp'])) {echo $_POST['cp']; }?>" placeholder="Code Postal"/><br/>

      			<input id="btn" class="trans1" type="submit" name="inscription" value="Inscription" /><br/>

			</form>
		</div>
	</body>
</section>

<?php
require_once("inc/footer.inc.php");