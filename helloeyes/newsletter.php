<?php
require_once("inc/init.inc.php");
/*INSCRIPTION NEWSLETTER*/
if(isset($_POST['inscription']))
{	foreach($_POST AS $indice => $valeur)
	{
		$_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
	}
	extract($_POST);
	$reference_membre= executeRequete("SELECT * FROM newsletter WHERE id_newsletter = '$id_newsletter'");
	if($reference_membre->num_rows >0 && isset($_GET['action']) && $_GET['action'] == 'inscription')
	{
		$msg .='<div class="erreur"><p>La référence est déjà attribuée. Veuillez vérifier vos saisies</p></div>';
	}
	$verif_caractere = preg_match('#^[@a-zA-Z0-9._-]+$#', $_POST['email']);
	if(!$verif_caractere && !empty($_POST['email']))
	{
		$msg .='<div class="erreur"><p>Caractères acceptés: a-A à z-Z et de 0 à 9</p></div>';
	}
	if(strlen($_POST['email']) <3 || strlen($_POST['email']) > 150)
	{
		$msg .='<div class="erreur"><p>Le pseudo doit avoir entre 3 et 150 caractères</p></div>';
	}
	if(empty($msg)) // si $msg est valide alors il n'y a pas d'erreur !
	{
		$membre = executeRequete("SELECT * FROM newsletter WHERE email='$_POST[email]'");
		if($membre->num_rows > 0)
		{
			$msg .='<div class="erreur"><p>Email indisponible</p></div>';
		}
		else{
			foreach($_POST AS $indice => $valeur)
			{
				$_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
			}
			$msg .='<div class="confirm"><p>Vous êtes bien inscrit à notre newsletter. Vous recevrez nos nouveautés dans votre boîte email !</p></div>';

			//$_POST['mdp'] = md5($_POST['mdp']); // pour crypter le mot de passe
			extract($_POST);  // crée des variables avec le nom des indices du tableau ARRAY. Cette variable contint la valeur

			executeRequete("INSERT INTO newsletter(id_newsletter, email, date_inscription) VALUES ('$id_newsletter','$email', NOW())");

		}
	}
}
require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");
echo $msg;
?>

<section>
	<body>
<!-- Inscription Newsletter-->
		<div class="row">
			<h1 class="bg title_font center"> Inscrivez-vous à notre newsletter !</h1><br>
			<form method="post" action="#">
				

      			<input class="ligne" type="hidden" id="id_newsletter" name="id_newsletter" value="<?php if(isset($_POST['id_newsletter'])) {echo $_POST['id_newsletter']; }?>"/><br/>

      	
      			<label for="email">Email</label>
      			<input class="ligne" type="text" id="email"name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email']; }?>" placeholder="votrenom@email.com"/><br/><br>

      			<input id="btn" class="trans1" type="submit" name="inscription" value="Inscription" /><br/>

			</form>
		</div>
<!-- Connexion -->
	</body>
</section>

<?php
require_once("inc/footer.inc.php");