<?php
require_once("inc/init.inc.php");

if (isset ($_POST['valider'])){
    //On récupère les valeurs entrées par l'utilisateur :
						$id_membre = (!empty($_SESSION['utilisateur']['id_membre'])) ? $_SESSION['utilisateur']['id_membre']:0;
            $email= preg_match('#^[a-zA-Z0-9@._-]+$#',$_POST['email'])? $_POST['email']:0;
						if(!$email && !empty($_POST['email']))
						{
							$msg .='<div class="erreur"><p>Caractères acceptés: a-A à z-Z et de 0 à 9</p></div>';
						}
						if(strlen($_POST['email']) <5 || strlen($_POST['email']) > 50)
						{
							$msg .='<div class="erreur"><p>Le mail doit faire plus de 5 caractères</p></div>';
						}
            $message= addslashes($_POST['message']);
						if(empty($msg))
						//On prépare la commande sql d'insertion
						$resultat = $mysqli->query("INSERT INTO contact(id_contact, id_membre, email, message, sub_date) VALUES ('$id_contact', '$id_membre', '$email', '$message', NOW())") or die ($mysqli->error);
						if(empty($msg))
						{
							$msg .='<div class="confirm"><p>Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.</p></div>';
						}
            //On construit la date d'aujourd'hui
            //strictement comme sql la construit
            $today = date("y-m-d");



        }

require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");
echo $msg;
?>

<section>
	<body>
		<div class="row">

			<h1 class="bg title_font center"> Contactez nous !</h1><br>

			<form name="inscription" method="post" action="#">

				<input class="ligne" type="hidden" id="id_membre" name="id_membre"/>

				<label for="email">Votre mail : </label>
				<input class="ligne" type="text" id="email" name="email"/><br/><br>

				<label for="message">Votre message :</label>
				<textarea id="message" name="message" placeholder="Votre message..."></textarea><br/><br>
				<input id="btn" name="valider" type="submit" value="Valider" class="trans1"/>
			</form>

		</div>
	</body>
</section>

<?php
require_once("inc/footer.inc.php");
