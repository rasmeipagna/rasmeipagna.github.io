<?php
include("inc/init.inc.php");

if(isset($_GET['id_produit'])) // si un article est passé dans l'url
{
	$resultat = executeRequete("SELECT * FROM produit WHERE id_produit='$_GET[id_produit]'");
}
if($resultat->num_rows <= 0)// si l'article n'existe pas
{
	header("location:index.php"); 
	exit();
}

//sinon on exploite les données du produit pour les afficher
$produit = $resultat->fetch_assoc();
$id_salle = $produit['id_salle'];

/************* $ENREGISTREMENT AVIS - DEBUT *************/
if(isset($_POST['enregistrement']))
{
  //sécurisation des saisies
  foreach ($_POST as $indice => $valeur) 
  {
    $_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
  }

  //déclaration des variables avant de les utiliser dans la fonction/requête
  extract($_POST);

  //on enregistre l'avis en bdd
  $id_membre = $_SESSION['utilisateur']['id_membre'];
  executeRequete("INSERT INTO avis (id_membre, id_salle, commentaire, note, date) VALUES ('$id_membre', '$id_salle', '$commentaire', '$note', NOW())");

  $msg .= '<div class="confirm"><p>Avis ajouté !</p></div>';
  
  
}
/************* $ENREGISTREMENT AVIS - FIN *************/


include("inc/header.inc.php");
include("inc/nav.inc.php");
echo $msg;
?>

  	<section>
  		<body>
			<h1 class="titre">Details de la salle</h1>
			    <div class="text">
             <?php
            //on récupère les infos de la salle du produit cliqué afin de les afficher
            $salles = executeRequete("SELECT * FROM salle WHERE id_salle='$produit[id_salle]'");

            while ($salle = $salles->fetch_assoc()) {
              echo '<h1 class="titre2">'.$salle['titre'].'</h1>';
            ?>

             <?php
              echo '<p><img src="' . $salle['photo'] . '" width="50%" alt="photo" /></p>';
              echo $salle['adresse'] . '</p>';

              echo 'Du ' . $produit['date_arrivee'] . ' au ' . $produit['date_depart'];
              
              echo '<p>Prix : ' . $produit['prix'] . '€</p>';
              echo '<p>Pour ' . $salle['capacite'] . ' personnes</p>';
              echo '<p>Catégorie : ' . $salle['categorie'] . '</p>';
              echo '<hr>';
              echo '<p>' . $salle['description'] . '</p><br />';
               
               if($produit['etat'] == 0)
              {
                echo '<form method="post" action="panier.php">';

                //on récupère l'id_produit
                echo '<input type="hidden" name="id_produit" value="' . $produit['id_produit'] .'">'; 
                echo '<input type="submit" name="ajout_panier" value="Réserver" class="ligne trans1" id="btn">';
                echo '</form>';
              }else{
                echo '<p class="erreur">Cette salle est déjà réservée à ces dates-là.</p>';
              }
              

            }
            
          
           /********* $AFFICHAGE DES COMMENTAIRES - DEBUT *********/  
            //on récupère les avis pour cette salles
            $donnees = executeRequete("SELECT a.commentaire, a.note, a.date, m.pseudo FROM avis a, membre m WHERE a.id_salle='$id_salle' AND a.id_membre=m.id_membre");

            echo '<div class="text">';
            echo '<fieldset><legend><h1 class="titre2">Avis sur cette salle</h1></legend>';
            if($donnees->num_rows > 0) 
            {
              //on rend les données exploitables afin de pourvoir les afficher
              while ($avis = $donnees->fetch_assoc()) 
              {
                echo '<p>' . $avis['pseudo'] . ', le ' . $avis['date'] . ' (' . $avis['note'] . '/10)</p>';
                echo '<p>' . $avis['commentaire'] . '</p>';
              }
            }
            else {
              echo '<p>Il n y a pas encore d avis sur cette salle.</p>';
            }
            
/********* $AFFICHAGE DES COMMENTAIRES - FIN *********/  
           
/********* $AJOUTER UN COMMENTAIRE - DEBUT *********/  
          if(utilisateurEstConnecte())
          {

            //on vérifie que le membre n'a pas déjà laissé d'avis
            $id_membre = $_SESSION['utilisateur']['id_membre'];
            $avis_membre = executeRequete("SELECT * FROM avis WHERE id_membre='$id_membre' AND id_salle = '$id_salle'");

            if($avis_membre->num_rows > 0) 
            {
              echo '<div class="confirm"><p>Vous avez déjà noté cette salle. Merci pour votre contribution !</p></div>';
            }
            else{
         ?>
             <form class="text float" method="post" action="" role="form">  
                    
                    <div class="">
                        <label for="comment">Ajouter un commentaire</label><br>
                        <textarea id="comment" class="" name="commentaire" placeholder="Votre commentaire"><?php if(isset($_POST['commentaire'])) { echo $_POST['commentaire']; } ?></textarea>
                    </div>

                    <div class="">
                      <label for="review">Note</label>
                      <select id="review" name="note" class="ligne">
                        <?php 
                          for($i=1; $i<11;$i++){
                            echo '<option value="' . $i . '"';
                            if(isset($_POST['note']) && $_POST['note'] == $i){ echo 'selected'; }
                            echo '>' . $i . '</option>';
                          }
                        ?>
                        
                      </select>
                    </div>

                    <div class="">
                      <input type="submit" name="enregistrement" id="btn" class="ligne trans1" value="Soumettre">
                    </div>

            </form>
              <?php 
                }   
              }
              else
              {
                echo '<p><a id="lien1" class="trans1" href="connexion.php">Connectez-vous</a> pour pouvoir déposer des commentaires.</p><br>';
              }
              echo '</fieldset>';
            echo '</div>';
/********* $AJOUTER UN COMMENTAIRE - FIN *********/  
             
              ?>       

        </div>

  		</body>

     </section>

<?php
include("inc/footer.inc.php");