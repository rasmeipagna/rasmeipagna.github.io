<?php
require_once("inc/init.inc.php");
//AFFICHAGE DE L'ARTICLE
if(isset($_GET['id_article'])) // si un article est passé dans l'url
{
	$resultat = executeRequete("SELECT * FROM article WHERE id_article='$_GET[id_article]'");
}
if($resultat->num_rows <= 0)// si l'article n'existe pas
{
	header("location:index.php");
	exit();
}
$produit = $resultat->fetch_assoc();
//AFFICHAGE DU FORMULAIRE DES COMMENTAIRES
if($_POST)
{
	$id_article = ($_GET['id_article']) ? $_GET['id_article']:0;//addslashes($_POST['id_article']);
	$commentaire = addslashes($_POST['commentaire']);
	$id_membre = (!empty($_SESSION['utilisateur']['id_membre'])) ? $_SESSION['utilisateur']['id_membre']:0;

  $req = "INSERT INTO avis (id_avis, id_membre, id_article, commentaire, date) VALUES ('$id_avis','$id_membre','$id_article','$commentaire', NOW())";

  $mysqli->query($req) or die ($mysqli->error);

}
require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");
echo $msg;

?>

<section>
	<body>
		<div class="row">

            <h1 class="center"> Fiche article</h1>

            <h1 class="title_font bg center"><?php { echo $produit['titre']; }?></h1>
            <br>
            <p><?php { echo $produit['description']; }?></p><hr>
            <p>Catégorie : <?php { echo $produit['categorie']; }?></p><hr>
            <p>Couleur : <?php { echo $produit['couleur']; }?></p><hr>
            <img src="<?php { echo $produit['photo']; }?>" style="width:50%;" />
            <hr>
            <p>Prix: <?php { echo $produit['prix']; }?>€</p>
            <hr>
            <?php
            if($produit['stock'] > 0)
            {
              echo '<p>Stock : '.$produit['stock'].'</p><hr/>';
              echo '<form method="post" action="panier.php">';
              echo  '<input type="hidden" name="id_article" value="'.$produit['id_article'].'"/>'; // on récupère l'id_article
              echo '<label>Quantité: </label>';
              echo '<select name="quantite" id="quantite">';

              for($i=1; $i<=$produit['stock'] && $i<=5 ; $i++) // ma valeur $i; $i est inférieur ou égal au stock selon le produit et si le stock commandé est supérieur à , bloque la à 5 et pas plus, la condition le bloque, on ne dépasse pas plus de 5 tours; $i ++ faire tourner la boucle.
              {
                echo '<option>'.$i.'</option>';
              }
              echo '</select><br/>';
              echo '<input id="btn" class="trans1" type="submit" name="ajout_panier" value="Ajouter"/><br/>';
              echo '</form>';
            }else{
              echo '<p>Rupture de stock pour ce produit</p><hr/>';
            }
            ?>

    </div>
            <?php
                  //Recupérer l'id membre des tables avis et membres afin que le commentaire soit lié à l'utilisateur connecté ainsi qu'à l'article spécifique

                  // print_r($_SESSION);

                  //echo $id_article;
                  $resultat = $mysqli->query("SELECT a.id_avis, a.id_membre, m.pseudo, id_article, commentaire, date_format(date, '%d/%m/%Y') AS date_fr, date_format(date, '%H:%i:%s') AS heure_fr FROM avis a, membre m where a.id_membre = m.id_membre  AND id_article =$_GET[id_article] ORDER BY id_avis DESC") or die ($mysqli->error);


                  if(utilisateurEstConnecte()){

                    echo '<form class="row" style="margin:0;padding:0;" method="post" action="#">';
                    echo '<fieldset>';
                    echo '<legend><h2>'.$resultat->num_rows.' Avis</h2></legend>';
                    while($commentaire = $resultat->fetch_assoc())
                      {

                        echo '<input class="ligne" type="hidden" name="id_membre" id="id_membre" value="'.$id_membre.'" /><br />';
                        echo '<p>Par: '.$commentaire['pseudo'] .', le '. $commentaire['date_fr'] . ', à '. $commentaire['heure_fr'] . '</p>';
                        echo '<p>'. $commentaire['commentaire']. '</p>';
                        echo '<hr>';
                      }
                    echo '<legend><h1>Laisser un avis en tant que '.$_SESSION['utilisateur']['pseudo'] .'</h1></legend>';
                    echo '<input class="ligne" type="hidden" name="id_article" id="id_article" value="'.$id_article.'" /><br />';



                    echo '<label for="commentaire">Commentaire</label><br />';
                    echo '<textarea name="commentaire" id="commentaire"></textarea><br />';
                    echo '<input id="btn" class="trans1" type="submit" value="Envoyer" name="envoi" />';

                    echo '</fieldset>';
                    echo '</form>';
                  }else{
                    echo '<form class="row" style="margin:0;padding:0;" method="post" action="#">';
                    echo '<fieldset>';
                    echo '<legend><h2>'.$resultat->num_rows.' Avis</h2></legend>';
                    while($commentaire = $resultat->fetch_assoc())
                    {
                      echo '<p>Par: '.$commentaire['pseudo'] .', le '. $commentaire['date_fr'] . ', à '. $commentaire['heure_fr'] . '</p>';
                      echo '<p>'. $commentaire['commentaire']. '</p>';
                      echo '<hr>';
                    }
                        echo '<a id="lien1" class="trans1" href="connexion.php">Veuillez vous connecter laisser un commentaire</a>';
                        echo '</fieldset>';
                        echo '</form>';
                  }
            ?>



	</body>
</section>

<?php
require_once("inc/footer.inc.php");
