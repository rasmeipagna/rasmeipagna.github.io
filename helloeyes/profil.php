<?php
require_once("inc/init.inc.php");
if(!utilisateurEstConnecte())
{
  header("location:connexion.php"); 
}
/************* $ENREGISTREMENT MODIFS PROFIL - DEBUT *************/
if(isset($_POST['envoi']))
{
  if(empty($_POST['nom'])) {
        $msg .= '<div class="error msg"><p>Veuillez saisir un nom de famille.</p></div>';
    }

    if(empty($_POST['prenom'])) {
        $msg .= '<div class="error msg"><p>Veuillez saisir un prénom.</p></div>';
    }

    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg .= '<div class="error msg"><p>Veuillez saisir une adresse email valide.</p></div>';
    }

    if(empty($_POST['cp']) || strlen($_POST['cp']) < 5 || !preg_match('#^[0-9]+$#', $_POST['cp'])) {
        $msg .= '<div class="error msg"><p>Veuillez saisir un code postal valide.</p></div>';
    }

    if(empty($_POST['ville'])) {
        $msg .= '<div class="error msg"><p>Veuillez saisir une ville.</p></div>';
    }

    if(empty($_POST['adresse'])) {
        $msg .= '<div class="error msg"><p>Veuillez saisir une adresse.</p></div>';
    }

  //vérifions que les champs sont bien et correctement remplis avant d'exécuter la requête
  if(empty($msg))
  {
    //sécurisation des saisies
    foreach ($_POST as $indice => $valeur) 
    {
      $_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
    }

    extract($_POST);

    executeRequete("UPDATE membre SET nom='$nom',prenom='$prenom',email='$email',ville='$ville',cp='$cp',adresse='$adresse' WHERE id_membre='$id_membre'");

    $msg .= '<div class="msg succes"><p>Vos modifications ont bien été prises en compte.</p></div>';

  }
}
if(isset($_POST['annuler']))
{
  header("location:profil.php");
  exit();
}
/************* $ENREGISTREMENT MODIFS PROFIL - FIN *************/

require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");
?>

<section>
	<body>
        <div class="row">
          <h2>
          <?php 
            if($_GET["action"] == 'modification-profil'){
              echo '<h1 style="text-align:center;">Modification du profil</h1>';
            }else{
              echo "Profil";
            }
          ?>
          </h2>
<?php
//requete pr aller chercher les infos en bdd
$id_membre = $_SESSION["utilisateur"]["id_membre"];
$resultat = executeRequete("SELECT * FROM membre WHERE id_membre='$id_membre'");
$membre = $resultat->fetch_assoc();

/********* $MODIFICATION DU PROFIL - DEBUT *********/
if(isset($_GET["action"]) && $_GET["action"] == 'modification-profil')
{
?>
          <div class="size-form" style="margin:0 !important;">
            <form method="post" action="profil.php" role="form">
              <input type="hidden" name="id_membre" value="<?php if(isset($membre['id_membre'])){ echo $membre['id_membre']; } ?>">

              <input class="ligne" type="text" name="nom" value="<?php if(isset($membre['nom'])){ echo $membre['nom']; } ?>" placeholder="Nom de famille">
            
              <input class="ligne" type="text" name="prenom" value="<?php if(isset($membre['prenom'])){ echo $membre['prenom']; } ?>" placeholder="Prénom">
            
              <input class="ligne" type="email" name="email" value="<?php if(isset($membre['email'])){ echo $membre['email']; } ?>" placeholder="Adresse email*">
              
              <input class="ligne" type="text" name="adresse" value="<?php if(isset($membre['adresse'])){ echo $membre['adresse']; } ?>" placeholder="Adresse*">

              <input class="ligne" type="text" name="cp" value="<?php if(isset($membre['cp'])){ echo $membre['cp']; } ?>" maxlength="5" placeholder="Code postal*">

              <input class="ligne" type="text" name="ville" value="<?php if(isset($membre['ville'])){ echo $membre['ville']; } ?>" placeholder="Ville*">
              
              <input style="margin:0;" id="btn" class="trans1"  type="submit" name="envoi" value="Editer">
              <input style="margin:0;" id="btn" class="trans1"  type="submit" class="cancel" name="annuler" value="Annuler">
            </form>
          </div>

<?php
}else{
/********* $MODIFICATION DU PROFIL - FIN *********/


/********* $AFFICHAGE DES INFOS DU PROFIL - DEBUT *********/

          echo '<h1>Bienvenue sur votre compte ' . $_SESSION["utilisateur"]["pseudo"] . ' !</h1><br>';
          echo '<h1>Vos coordonnées sont : </h1>';
          echo '<p>Nom : ' . $membre['nom'] . '</p>';
          echo '<p>Prénom : ' . $membre['prenom'] . '</p>';
          echo '<p>Adresse : ' . $membre['adresse'] . ', ' . $membre['cp'] . ' ' . $membre['ville'] . '</p>';
          echo '<p>Email : ' . $membre['email'] . '</p>';
          echo '<p><a href="?action=modification-profil">Mettre à jour les informations</a></p>';


          
/********* $AFFICHAGE DES INFOS DU PROFIL - FIN *********/


/********* $AFFICHAGE DES COMMANDES - DEBUT *********/
          
          echo '<h1>Vos dernières commandes</h1>';
          $resultat_commande = executeRequete("SELECT c.id_commande,c.montant, c.date FROM commande c, membre m WHERE m.id_membre = c.id_membre AND m.id_membre = '$id_membre'");
          
          echo '<table border="1">';
          //affichage de la ligne des titres
          echo '<tr>';
          //on récupére les informations sur les champs sous forme d'objet
          while($titre = $resultat_commande->fetch_field())
          {
            echo '<th>' . $titre->name . '</th>';
          }
          echo '</tr>';
          //affichage des lignes du tableau
          while($ligne = $resultat_commande->fetch_assoc())
          {
            echo '<tr>';
            foreach ($ligne as $indice => $valeur)
            {
              echo '<td>' . $valeur . '</td>';
            } 
            echo '</tr>';
          }
          echo '</table>';   
}
/********* $AFFICHAGE DES COMMANDES - FIN *********/  
?>        
        </div>

	</body>
</section>

<?php
require_once("inc/footer.inc.php");