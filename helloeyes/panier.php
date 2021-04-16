<?php
require_once("inc/init.inc.php");
creationDuPanier();

//---------VIDER LE PANIER
if(isset($_GET['action']) && $_GET['action'] =='vider')
{
	unset($_SESSION['panier']);
}
//---------FIN VIDER LE PANIER
//------------AJOUTER UN ARTICLE
if(isset($_POST['ajout_panier'])) // ce $_POST provient de la page fiche_article
{
  $resultat = executeRequete("SELECT * FROM article WHERE id_article='$_POST[id_article]'"); // on récupère les informations de l'article en BDD pour avoir le prix et le titre.
  $article = $resultat->fetch_assoc();
  $article['prix'] = $article['prix']* 1.2; // ajout de la TVA sur le prix de l'article
  ajouterArticleDansPanier($article['titre'], $_POST['id_article'], $_POST['quantite'], $article['prix']);// on execute la fonction en lui passant les arguments.
  header("location:panier.php"); // pour recharger la page afin d'éviter de faire plusieurs ajouts avec F5(rechargement de page)
}
//------------FIN AJOUTER UN ARTICLE

//------------RETIRER UN ARTICLE
if(isset($_GET['action']) && $_GET['action'] == 'retirer') // si l'utilisateur veut retirer un article
{
  retirerArticleDuPanier($_GET['id_article']); // on exécute la fonction
}

//------------FIN RETIRER UN ARTICLE
//------------PAYER LE PANIER

if(isset($_GET['action']) && $_GET['action'] == 'payer') // si l'utilisateur a cliqué sur le bouton "payer le panier"
{
  for($i=0; $i < count($_SESSION['panier']['id_article']); $i++)
  {
    $resultat = executeRequete("SELECT * FROM article WHERE id_article=".$_SESSION['panier']['id_article'][$i]); // pour chaque article on récupère ses informations en BDD afin de controler le stock restant
    $result = $resultat->fetch_assoc();
    if($result['stock'] < $_SESSION['panier']['quantite'][$i]) // si le stock en BDD est inférieur à la quantité demandée.
    {
      if($result['stock'] > 0) // s'il reste du stock mais inférieur à la quantité demandée
      {
        $msg .='<div class="erreur bg-danger"><p>La quantité de l\'article '.$_SESSION['panier']['id_article'][$i].' a été modifiée car notre stock est insuffisant<br/>Veuillez vérifier votre commande !</p></div>';
        $_SESSION['panier']['quantite'][$i] = $result['stock'];
      }else{// stock =0
        $msg .='<div class="erreur bg-danger"><p>L\'article '.$_SESSION['panier']['id_article'][$i].' a été retiré de votre commande car nous sommes en rupture de stock<br/>Veuillez vérifier votre commande !</p></div>';
        retirerArticleDuPanier($_SESSION['panier']['id_article'][$i]); // on retire l'article du panier.
        $i--; // on décrémente $i car après avoir retiré un article du panier, les indices sont réordonnés.Ceci afin de ne pas rater l'article qui aura remplacé celui supprimé
      }
      $erreur = TRUE; // variable de contrôle
    }
  }
  if(!isset($erreur)) // on vérifier s'il n'y a pas eu une erreur
  {
    $client = $_SESSION['utilisateur']['id_membre'];
    $montant = montantTotal();
    executeRequete("INSERT INTO commande(id_membre, montant, date) VALUES('$client', '$montant', NOW())"); //enregistrement de la commande
    $id_commande = $mysqli->insert_id; // on récupère l'id généré lors de l'insertion de la commande
    for($i =0; $i < count($_SESSION['panier']['titre']); $i++) // pour chaque article on va faire une insertion dans la table details_commande et mettre à jour les stocks
    {
      $details_id_article = $_SESSION['panier']['id_article'][$i];
      $details_quantite = $_SESSION['panier']['quantite'][$i];
      $details_prix = $_SESSION['panier']['prix'][$i];
      executeRequete("INSERT INTO details_commande(id_commande, id_article, quantite, prix)VALUES('$id_commande', '$details_id_article', '$details_quantite','$details_prix')");

      executeRequete("UPDATE article SET stock=stock - $details_quantite WHERE id_article=$details_id_article");
    }
    unset($_SESSION['panier']);
    header("location:panier.php");
    // mail(); // pour envoyer un mail à l'utilisateur
  }
}

//------------FIN PAYER LE PANIER
require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");
echo $msg;
?>

<section>
	<body>
		<?php
      /*debug($_POST);*/
      // debug($_SESSION);
       //echo montantTotal();

//requete pr aller chercher les infos en bdd
$id_membre = $_SESSION["utilisateur"]["id_membre"];
$resultat = executeRequete("SELECT * FROM membre WHERE id_membre='$id_membre'");
$membre = $resultat->fetch_assoc();
      echo '<div class="row">';
      

     
      echo '<table border="">';
      echo '<tr><th><style="text-align:center"><p>PANIER</p></th></tr>';
      echo '<tr><th><p>Titre</p></th><th><p>Article</p></th><th><p>Quantité</p></th><th><p>Prix unitaire</p></th><th><p>Action</p></th></tr>';

      if(empty($_SESSION['panier']['id_article']))
      {
        echo '<tr><td><p>Votre panier est vide</p></td></tr>';
      }else{
        for($i=0; $i<count($_SESSION['panier']['prix']);$i++)
        {
          echo '<tr>';
          echo '<td><p>'.$_SESSION['panier']['titre'][$i].'</p></td>';        
          echo '<td><p>'.$_SESSION['panier']['id_article'][$i].'</p></td>';        
          echo '<td><p>'.$_SESSION['panier']['quantite'][$i].'</p></td>';        
          echo '<td><p>'.$_SESSION['panier']['prix'][$i].'€</p></td>';  
          echo '<td><a id="lien1" class="trans1" href="?action=retirer&id_article='.$_SESSION['panier']['id_article'][$i].'" >Retirer</a></td>'; 
          echo '</tr>';
        } 
          echo '<tr><td><p>Montant Total :</td><td><p>'.montantTotal().'€TTC</p></td></tr>';

          echo '<tr><td><a id="lien1" class="trans1" href="?action=vider" class="trans1">Vider le panier</a></td></tr>'; 
          if(utilisateurEstConnecte())
          {
            echo '<tr><td><p><a onclick="panier();" href="?action=payer" id="lien1" class="trans1">Payer le panier</a></p></td></tr>'; 
          }else{
            echo '<tr><td><p>Veuillez vous <a id="lien1" class="trans1" href="connexion.php">connecter</a> pour payer</p></td></tr>';
          }

      }

      echo '</table>';

      echo '<hr>';
      if(utilisateurEstConnecte())
      {
        echo '<h1>Votre adresse de livraison est :</h1><p> <br/>'.$membre['adresse'] . ', ' . $membre['cp'] . ' ' . $membre['ville'] . '</p>';
      }
      
      echo '</div>';
      
      ?>
	</body>
</section>

<?php
require_once("inc/footer.inc.php");