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
  $_POST['id_membre'] = addslashes($_POST['id_membre']);
  $_POST['commentaire'] = addslashes($_POST['commentaire']);
  /* $pseudo = $_POST['pseudo'];
  $message = $_POST['message']; */
  extract($_POST); // extract() ne marche que sur un tableau ARRAY indexé avec dews indices sous forme chaine de caractères.
  // cette fonction récupère tous les indices du tableau et crée un variable du même nom qui contient la valeur.
  $req = "INSERT INTO avis (id_membre, pseudo, commentaire, date) VALUES ('$id_membre','$pseudo','$commentaire', NOW())";
  
  $mysqli->query($req) or die ($mysqli->error);
  
}
require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");
echo $msg
?>

<section>
	<body>
		<div class="row">
			
            <h1 class="center"> Fiche article</h1>

            <h1 class="title_font bg center"><?php { echo $produit['titre']; }?></h1>
            <br>
            <p><?php { echo $produit['description']; }?></p>
            <p>Catégorie : <?php { echo $produit['categorie']; }?></p>
            <p>Couleur : <?php { echo $produit['couleur']; }?></p>
            <img src="<?php { echo $produit['photo']; }?>" style="width:50%;" />
            <hr>
            <p><?php { echo $produit['prix']; }?></p>
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

                  $resultat = $mysqli->query("SELECT id_membre, pseudo, commentaire, date_format(date, '%d/%m/%Y') AS date_fr, date_format(date, '%H:%i:%s') AS heure_fr FROM avis ORDER BY id_avis DESC") or die ($mysqli->error);

                  if(utilisateurEstConnecte()){
                        echo '<form class="row" style="margin:0;padding:0;" method="post" action="#">';
                        echo '<fieldset>';
                        echo '<legend><h2>'.$resultat->num_rows.' Avis</h2></legend>';
                              while($commentaire = $resultat->fetch_assoc())
                              {
                                //var_dump($commentaire);
                                //echo $commentaire['id_membre'] . '<hr />';
                              
                                  echo '<p>Par: '.$commentaire['pseudo'] .', le '. $commentaire['date_fr'] . ', à '. $commentaire['heure_fr'] . '</p>';
                                  echo '<p>'. $commentaire['commentaire']. '</p>';
                                  echo '<p>'. $produit['id_article']. '</p>';
                                  echo '<hr>';
                              
                                
                              }
                              echo '<legend><h1>Avis</h1></legend>';

                              echo '<label for="pseudo">Pseudo</label>';
                              echo '<input class="ligne" type="text" name="pseudo" id="pseudo" value="" /><br />';

                              echo '<label for="commentaire">Commentaire</label><br />';
                              echo '<textarea name="commentaire" id="commentaire"></textarea><br />';
                                
                              echo '<input id="btn" class="trans1" type="submit" value="Envoyer" name="envoi" />';
                        echo '</fieldset>';
                        echo '</form>';
                  }else{
                        echo '<form class="row" style="margin:0;padding:0;" method="post" action="">';
                        echo '<fieldset>';
                        echo '<legend><h2>'.$resultat->num_rows.' Avis</h2></legend>';
                              while($commentaire = $resultat->fetch_assoc())
                              {                             
                                  echo '<p>Par: '.$commentaire['id_membre'] .', le '. $commentaire['date_fr'] . ', à '. $commentaire['heure_fr'] . '</p>';
                                  echo '<p>'. $commentaire['commentaire']. '</p>';
                                  echo '<hr>';
                                                              
                              }
                        echo '<p class="f-size center">Veuillez vous <a id="lien1" class="trans1" href="connexion.php">connecter</a> pour laisser un commentaire</p>';
                        echo '</fieldset>';
                        echo '</form>';
                  }
            ?>
      	
           
	
	</body>
</section>

<?php
require_once("inc/footer.inc.php");