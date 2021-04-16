<?php
include("inc/init.inc.php");
creationDuPanier();

//-----------VIDER LE PANIER
if(isset($_GET['action']) && $_GET['action'] == 'vider') 
{
  unset($_SESSION['panier']);
}
//------------FIN VIDER LE PANIER

//------------AJOUTER UNE SALLE
if(isset($_POST['ajout_panier'])) // ce $_GET provient de la page voir la fiche détaillée de index.php reservation.php recherche.php
{
  //on récupère les informations (titre et prix) du produit en BDD pour une question de sécurité


  $resultat = executeRequete("SELECT produit.id_produit, salle.titre, salle.photo, salle.ville, salle.capacite, produit.date_arrivee, produit.date_depart, produit.prix FROM produit, salle WHERE produit.id_produit = '$_POST[id_produit]' AND produit.id_salle = salle.id_salle");

  //ajout de la TVA sur le prix du produit
  $produit = $resultat->fetch_assoc();
  $produit['tva'] = $produit['prix']*1.2; 
  
  //Je récupère l'id_produit via POST + le reste des infos de la bdd -> je peux donc executer la fonction d'ajout au panier en lui passant les arguments
  ajouterProduitDansPanier($_POST['id_produit'], $produit['titre'], $produit['photo'], $produit['ville'], $produit['capacite'], $produit['date_arrivee'], $produit['date_depart'], $produit['prix'], $produit['tva']);
  header("location:panier.php");
}
//------------FIN AJOUTER UNE SALLE

//------------RETIRER UN PRODUIT
if(isset($_GET['action']) && $_GET['action'] == 'retirer') // si l'utilisateur veut retirer un article
{
  retirerProduitDuPanier($_GET['id_produit']); // on exécute la fonction
}

//------------FIN RETIRER UN PRODUIT

//------------PAYER LE PANIER

if(isset($_GET['action']) && $_GET['action'] == 'payer') // si l'utilisateur a cliqué sur le bouton "payer le panier"
{
 
    //vérifier que les salles sur le point d'être réservées sont bien disponibles
  for($i=0; $i<count($_SESSION['panier']['id_produit']); $i++)
  {
    //pour chaque produit, on récupère ses infos en BDD afin de vérifier son état
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]); 
    $result = $resultat->fetch_assoc();

    if($result['etat'] != 0) //si le produit en bdd n'est pas dispo
    {
      $msg .= '<div class="erreur"><p>La salle '.$_SESSION['panier']['salle'][$i].' n\'est plus disponible à ces dates et a donc été retirée de votre commande.<br>Merci de vérifier votre commande avant de procéder au paiement.<p></div>';
      //on retire l'article du panier
      retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]); 
      //on réordonne les indices du tableau
      $i--;
      //variable de contrôle
      $erreur = TRUE; 
    } 
  }
  //s'il n'y a pas de pb de disponibilité, on crée une nouvelle commande
  if(!isset($erreur)) // on vérifie s'il n'y a pas eu une erreur
  {
 
    //enregistrement de la commande en BDD
    $montant = montantTotal();
    $client = $_SESSION['utilisateur']['id_membre'];
    executeRequete("INSERT INTO commande(montant, id_membre, date) VALUES ('$montant', '$client', NOW())"); 

    //on récupère l'id généré lors de l'insertion de la commande et met à jour la table details_commande
    $id_commande = $mysqli->insert_id; 
    for($i=0; $i<count($_SESSION['panier']['id_produit']); $i++)
    {
      $details_id_produit = $_SESSION['panier']['id_produit'][$i];
      executeRequete("INSERT INTO details_commande (id_commande, id_produit) VALUES ('$id_commande', '$details_id_produit')");
      
      //on actualise la disponibilité en BDD après la commande du client :
      executeRequete("UPDATE produit SET etat = '1' WHERE id_produit = $details_id_produit");
    }
    
    //on vide le panier :
    unset($_SESSION['panier']); 
    header("location:panier.php");
  }
}



//------------FIN PAYER LE PANIER
include("inc/header.inc.php");
include("inc/nav.inc.php");
echo $msg;
?>

    <section>
      <body>

<div class="text">
  <div class="lien2">
       <h1 class="titre">Votre Panier</h1>
  </div>

  
<?php

          if(utilisateurEstConnecte())
          {

            //debug($_POST);
            //debug($_SESSION);
            echo '<table border="1">';
            echo '<tr><th>Votre panier</th></tr>';
            echo '<tr><th>ID produit</th><th>Salle</th><th>Photo</th><th>Ville</th><th>Capacité</th><th>Date arrivée</th><th>Date de départ</th><th>Retirer</th><th>Prix TTC</th></tr>';

            //si le panier n'est pas vide
            if(!empty($_SESSION['panier']['id_produit'])) 
            {
              //var_dump($_SESSION['panier']);
              for($i=0; $i < count($_SESSION['panier']['id_produit']); $i++) 
              {
                echo '<tr>';
                echo '<td>' . $_SESSION['panier']['id_produit'][$i] . '</td>';
                echo '<td>' . $_SESSION['panier']['id_salle'][$i] . '</td>';
                echo '<td><img src="' . $_SESSION['panier']['photo'][$i] . '" width="150" alt="" /></td>';
                echo '<td>' . $_SESSION['panier']['ville'][$i] . '</td>';
                echo '<td>' . $_SESSION['panier']['capacite'][$i] . '</td>';
                echo '<td>' . $_SESSION['panier']['date_arrivee'][$i] . '</td>';
                echo '<td>' . $_SESSION['panier']['date_depart'][$i] . '</td>';
                echo '<td><a href="?action=retirer&amp;id_produit=' . $_SESSION['panier']['id_produit'][$i] . '" class="">Retirer</a></td>';
                echo '<td>' . $_SESSION['panier']['prix'][$i] . '&euro;</td>';
                
                echo '</tr>';
              }
              echo '<tr><td>Montant total du panier : </td><td>' . montantTotal() . '€ TTC</td></tr>';  
              echo '<tr><td><a id="lien1" class="trans1" href="?action=vider" class="">Vider le panier</a></td></tr>';
              if(!utilisateurEstConnecte())
              { 
                echo '<tr><td>Veuillez vous <a id="lien1" class="trans1" href="connexion.php">connecter</a> ou vous <a id="lien1" class="trans1" href="inscription.php">inscrire</a> pour finaliser votre commande !</td></tr>';
              }
              else
              {
                echo '<tr><td><a href="?action=payer" id="lien1" class="trans1">Payer le panier</a></td></tr>';
              }
            }
            else
            {
              echo '<tr><td>Votre panier est vide</td></tr>';

            }
            echo '</table>';

            echo '<p>Nous vous enverrons un email de confirmation à votre adresse : <br>';
            echo $_SESSION["utilisateur"]["email"] . '</p>';
          }
          else
          {
            echo '<p>Vous devez <a id="lien1" class="trans1" href="connexion.php">vous connecter</a> afin d accéder à votre panier.<br>'; 
          }
?>
</div>





      </body>

     </section>

<?php
include("inc/footer.inc.php");