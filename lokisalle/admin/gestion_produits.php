<?php
include("../inc/init.inc.php");
//vérification du statut de l'utilisateur
if(!utilisateurEstConnecteEtEstAdmin())
{
  header('location:../profil.php');
  exit();
}

/***************** SUPPRESSION ********************/
if(isset($_GET['action']) && $_GET ['action'] == 'suppression')
{
  foreach ($_GET as $indice => $valeur) 
  {
    $_GET[$indice] = htmlentities($_GET[$indice], ENT_QUOTES);
  }
  //checker que l'id du produit à supprimer est bien un entier
  if(!is_int($_GET['id_produit'])) {
    $msg .= '<div class="confirm"><p>Le produit a bien été supprimé.</p></div>';
  }
  //on supprime le produit en base de donnée
  executeRequete("DELETE FROM produit WHERE id_produit='$_GET[id_produit]'");

  //afficher la table des produits tout de suite après avoir supprimé le produit:
  $_GET['action'] = "affichage";
}
/***************** FIN SUPPRESSION ********************/

/***************** ENREGITREMENT PRODUIT********************/

if(isset($_POST['enregistrement']))
{
  foreach($_POST AS $indice => $valeur)
  {
    $_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
  }
  extract($_POST);

  if(date('Y-m-d') > $date_arrivee || $date_depart < $date_arrivee) {
    $msg .= '<div class="erreur"><p>Vos dates de réservation sont incorrectes. Merci de bien vouloir les corriger.</p></div>';
  }

  //requête SQL qui vérifie si ce produit existe dejà en bdd (càd si la date d'arrivée et/ou la date de départ du produit ajouté se situe entre 2 dates d'un produit déjà existant pour cette même salle) :
  $produit_bdd = executeRequete("SELECT * FROM produit WHERE id_salle='$salle' AND ('$date_arrivee' BETWEEN date_arrivee AND date_depart || '$date_depart' BETWEEN date_arrivee AND date_depart)"); // 

  //si le produit existe déjà et qu'il s'agit d'un ajout, on affiche une erreur
  if($produit_bdd->num_rows > 0 && isset($_GET["action"]) && $_GET["action"] == "ajout")
  {
    $msg .= '<div class="erreur"><p>La salle est déjà réservée à ces dates-là. Veuillez choisir de nouvelles dates.</p></div>';
  }

  //si pas d'erreur lors de l'ajout du produit
  if(empty($msg))
  {
    executeRequete("REPLACE INTO produit (id_produit, date_arrivee, date_depart, id_salle, id_promo, prix, etat) VALUES ('$id_produit', '$date_arrivee', '$date_depart', '$salle', '$promo', '$prix', '')");

    if($_GET["action"] == 'ajout'){
      $msg .= '<div class="confirm"><p>Produit ajouté !</p></div>';
      }else{
        $msg .= '<div class="confirm"><p>Produit modifié !</p></div>';
      }
  }

}
/***************** FIN ENREGITREMENT PRODUIT ********************/

include("../inc/header.inc.php");
include("../inc/nav.inc.php");
echo $msg;

?>

  	<section>
  		<body>
<div class="text">
	<div class="lien2">
  			<h1 class="titre">Gestion des Produits</h1>
  			
  			<a id="lien1" class="trans1" href="?action=ajout" >Ajouter un produit</a>&nbsp;
        <a id="lien1" class="trans1" href="?action=affichage" >Afficher les produits</a>
  	</div>
</div>

<?php
/********* AJOUT D'UN PRODUIT *********/
if(isset($_GET["action"]) && ($_GET["action"] == 'ajout' || $_GET["action"] == 'modification'))
{
  //s'il s'agit d'une modification
  if(isset($_GET["id_produit"])) 
  {
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");
    $produit_actuel = $resultat->fetch_assoc();
    //debug($produit_actuel);
  }
?>

            <h3>
          <?php 
          if($_GET["action"] == 'ajout'){
            echo '<h1 class="titre2 lien2">Ajout d\'un produit</h1>';
          }else{
            echo '<h1 class="titre2 lien2">Modification d\'un produit</h1>';
          }
          ?>
            </h3>
            <form method="post" action="" role="form">
          <div class="">
            <input type="hidden" class="" id="id_produit" name="id_produit" value="<?php if(isset($produit_actuel['id_produit'])) { echo $produit_actuel['id_produit']; } ?>">
          </div>        

          <div class="">
            <label for="salle">Salle</label>
            <select id="salle" name="salle" class="ligne">
              <?php
                //on récupère toutes les salles
              echo $promo;
                        $salles = executeRequete("SELECT * FROM salle");
                        while ($salle = $salles->fetch_assoc()) {
                          echo '<option value="' . $salle['id_salle'] . '"';
                          if(isset($_POST['salle']) && $_POST['salle'] == $salle['id_salle']) 
                          { 
                            echo 'selected'; 
                          }
                          elseif(isset($produit_actuel['id_salle']) && $produit_actuel['id_salle'] == $salle['id_salle'])
                          { 
                            echo 'selected';
                          }
                          echo ' >';
                          echo $salle['id_salle'] . ' - ' . $salle['pays'] . ' - ' . $salle['ville'] . ' - ' .  $salle['adresse'] . ' - ' . $salle['cp'] . ' - ' . $salle['titre'] . ' - ' . $salle['capacite'] . ' - ' . $salle['categorie'] ;
                          echo '</option>';
                        }
                      ?>
            </select>
          </div>
          
          <div class="">
            <label for="arrivee">Date d'arrivée</label>
            <input type="date" id="arrivee" class="ligne" name="date_arrivee" value="<?php if(isset($_POST['date_arrivee'])) { echo $_POST['date_arrivee']; }elseif(isset($produit_actuel['date_arrivee'])){ echo $produit_actuel['date_arrivee']; } ?>" placeholder="Date d'arrivée AAAA-MM-JJ">
          </div>

          <div class="">
            <label for="depart">Date de départ</label>
            <input type="date" id="depart" class="ligne" name="date_depart" value="<?php if(isset($_POST['date_depart'])) { echo $_POST['date_depart']; }elseif(isset($produit_actuel['date_depart'])){ echo $produit_actuel['date_depart']; } ?>" placeholder="Date de départ AAAA-MM-JJ">
          </div>

          <div class="">
            <label for="prix">Prix</label>
            <input type="text" id="prix" class="ligne" name="prix" value="<?php if(isset($_POST['prix'])) { echo $_POST['prix']; }elseif(isset($produit_actuel['prix'])){ echo $produit_actuel['prix']; } ?>" placeholder="Prix en euros">
          </div>

          <div class="">
            <label for="promo">Attribution remise parmi les codes promo existant</label>
            <select id="promo" name="promo" class="ligne">
              <?php
                //on récupère toutes les promos

                        $promos = executeRequete("SELECT * FROM promotion");
                        while ($promo = $promos->fetch_assoc()) {
                          echo '<option value="' . $promo['id_promo'] . '"';
                          if(isset($_POST['promo']) && $_POST['promo'] == $promo['id_promo']) 
                          { 
                            echo 'selected'; 
                          }
                          elseif(isset($produit_actuel['id_promo']) && $produit_actuel['id_promo'] == $promo['id_promo'])
                          { 
                            echo 'selected';
                          }
                          echo ' >';
                          echo $promo['id_promo'] . ' - ' . $promo['code_promo'] . ' - ' . $promo['reduction'];
                          echo '</option>';
                        }
                      ?>
            </select>
          </div>
          <div class="">
            <input type="submit" name="enregistrement" class="ligne" id="btn" value="Valider"> 
          </div>
         
        </form>
  
<?php
}
/********* $AJOUT D'UN PRODUIT - FIN *********/
/********* $AFFICHAGE DES PRODUITS - DEBUT *********/
if(isset($_GET["action"]) && $_GET["action"] == 'affichage')
{
  echo '<div class="text">';
  echo '<h1 class="titre2 lien2">Affichage des produits</h1>';
  
  $req = "SELECT * FROM produit ";

  $sort='ASC';
  if(isset($_GET['sorting']))
  {
    if($_GET['sorting']=='ASC')
    {
      $sort='DESC'; 
    }
    else 
    { 
      $sort='ASC';
    }
  }

  $field = '';
  if(isset($_GET['field']))
  {
    $field = $_GET['field'];
  }

  if(!empty($field)){
    $req .= "ORDER BY $field $sort";
  }

  //on récupère les données sous forme inexploitable:
  $resultat = executeRequete($req);

  echo '<p>Nombre de produits : ' . $resultat->num_rows . '</p>';
  echo '<table border="1">';
  
  //affichage de la ligne des titres
  echo '<tr>';
  //on récupére les informations sur les champs sous forme d'objet
  while($titre = $resultat->fetch_field())
  {
    if($titre->name == "prix" || $titre->name == "date_arrivee" || $titre->name == "date_depart")
    {
      $field= $titre->name;
      
      echo '<th><a href="?action=affichage&amp;sorting=' . $sort .'&amp;field=' . $field . '">' . $titre->name . '</a></th>';
    }else{
      echo '<th>' . $titre->name . '</th>';
    }
  }
  echo '<th>Modif</th><th>Suppr</th>';
  echo '</tr>';

  //affichage des lignes du tableau
  while($ligne = $resultat->fetch_assoc())
  {
    echo '<tr>';
    foreach ($ligne as $indice => $valeur)
    {
      echo '<th>' . $valeur . '</th>';
    } 
    echo '<td><a href="?action=modification&id_produit='.$ligne['id_produit'].'"><img src="../images/modif.png" alt=""></a></td>';
    echo '<td><a href="?action=suppression&id_produit='.$ligne['id_produit'].'"onClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../images/erase.png" alt="supprimer"></a></td>';
    echo '</tr>';
  }

  echo '</table>';
  echo '</div>';
} 
/********* $AFFICHAGE DES PRODUITS - FIN *********/
?>


  		</body>

     </section>

<?php
include("../inc//admin_footer.inc.php");