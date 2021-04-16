<?php
include("inc/init.inc.php");
$mysqli = new mysqli("cl1-sql21", "dgx20964", "lokisalle", "dgx20964") or die("oups : problème de connexion");
$resultat_salle = $mysqli->query("SELECT titre, photo, capacite, date_arrivee, date_depart, prix FROM salle s INNER JOIN produit p ON s.id_salle = p.id_salle WHERE s.id_salle = p.id_salle ORDER BY s.id_salle DESC LIMIT 0,3");
$produit_id = executeRequete("SELECT DISTINCT id_produit FROM produit");
include("inc/header.inc.php");
include("inc/nav.inc.php");
?>

<section>
  <body>
<h1 class="titre">Nos Bureaux</h1>
    <div class="text">
    	 <!-- Début Sliders -->
            <div class="slider">
                <input type="radio" name="slide-switches" id="slide1" checked class="slide-switch">
                <label for="slide1" class="slide-label">Slide 1</label>
                    <div class="slide-content padded">
                        <img src="images/office1.jpg" alt="Salle 1">
                        
                    </div>

                <input type="radio" name="slide-switches" id="slide2" class="slide-switch">
                <label for="slide2" class="slide-label">Slide 2</label>
                    <div class="slide-content">
                      <img src="images/office2.jpg" alt="Salle 1">
                    </div>

                <input type="radio" name="slide-switches" id="slide3" class="slide-switch">
                <label for="slide3" class="slide-label">Slide 3</label>
                    <div class="slide-content">
                       <img src="images/office3.jpg" alt="Salle 3">
                    </div>

                <input type="radio" name="slide-switches" id="slide4" class="slide-switch">
                <label for="slide4" class="slide-label">Slide 4</label>
                    <div class="slide-content">
                       <img src="images/office4.jpg" alt="Salle 4">
                    </div>
             
            </div>
      <!-- Fin Slider-->
      <p>LokiSalle vous propose un service de location de salle pour l'organisation de vos réunions, séminaires, formations ou autres événements, que vous soyez particuliers ou professionnels.<br>Situées dans les quartiers d'affaire des villes de Paris, Lyon et Marseille, toutes nos salles sont parfaitement desservies par les transports publics ou à proximité de gare SNCF.<br>Des professionnels d'organisation d'événements sont également présents sur le site pour vous faciliter toute l'organisation. Depuis la location de salles jusqu'à sa décoration en passant par l'animation sonore...<br>Lokisalle vous facilite vos recherches, n'hésitez pas à venir nous rendre visite ou réserver directement nos salles sur notre site !</p>
  <h1 class="titre">Nos 3 dernieres nouveautes</h1>
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
            $requete = "SELECT * FROM salle s INNER JOIN produit p ON s.id_salle = p.id_salle WHERE s.id_salle = p.id_salle ORDER BY id_produit DESC LIMIT 0,3";
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
    </div>
  </body>
</section>

<?php
include("inc/footer.inc.php");