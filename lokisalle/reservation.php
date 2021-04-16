<?php
include("inc/init.inc.php");
$mysqli = new mysqli("cl1-sql21", "dgx20964", "lokisalle", "dgx20964") or die("oups : problème de connexion");

include("inc/header.inc.php");
include("inc/nav.inc.php");

?>

<section>
  <body>
    <div class="lien2">
            <h1 class="titre">Toutes nos offres</h1>
           
    </div>
        
          <div class="text center">
        
          <?php
 
          if(isset($_GET['produit']))
          {
            $_GET['produit'] = htmlentities(urldecode($_GET['produit']));
            $donnees = executeRequete("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");
            // <!-- affichage des 3 dernières salles -->
          }
          else{ 
            $mysqli = new Mysqli("cl1-sql21", "dgx20964", "lokisalle", "dgx20964") or die ("oups : problème de connexion à la BDD !");
            $requete = "SELECT * FROM salle s INNER JOIN produit p ON s.id_salle = p.id_salle WHERE s.id_salle = p.id_salle ORDER BY id_produit DESC";
            $resultat = $mysqli->query($requete);
            while($produit = $resultat->fetch_assoc())
            { 
              echo '<div class="float">';
              echo '<h2 class="titre2">'.$produit['titre'].'</h2>';
              echo '<p>'.'Pour '.$produit['capacite'].' personnes.'.'</p>';
              echo '<img src="'.$produit['photo'].'" width="280" height="200"/>';
              echo '<div>'.'Prix : '.$produit['prix'].'€</div>';              
              echo '<div>'.'Date d\'arrivée : '.$produit['date_arrivee'].'</div>';
              echo '<div>'.'Date de départ : '.$produit['date_depart'].'</div>';
              echo '<a id="lien1" class="trans1" href="reservation_details.php?id_produit='.$produit['id_produit'].'">Voir +</a><br>';

              if(utilisateurEstConnecte()){
                echo '<form class="reset float" method="post" action="panier.php">';

                //on récupère l'id_produit
                echo '<input type="hidden" name="id_produit" value="' . $produit['id_produit'] .'">';
                echo '<input type="submit" name="ajout_panier" value="Ajout Panier" id="btn" class="ligne trans1" style="margin:0;padding:0;font-size:16px;">';
                echo '</form>';
                
                }else{
                echo '<a id="lien1" class="trans1" href="connexion.php">'.'Connectez-vous pour l\'ajouter au panier'.'</a><br>';
                echo '<hr/>';
                }
                
                echo '</div>';
            }
          }
          ?>
          
        </div>
  </body>
</section>

<?php
include("inc/footer.inc.php");