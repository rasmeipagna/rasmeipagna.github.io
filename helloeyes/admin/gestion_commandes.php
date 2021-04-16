<?php
require_once("../inc/init.inc.php");
if(!utilisateurEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}
/***************** SUPPRESSION ********************/
if(isset($_GET['action']) && $_GET ['action'] == 'suppression')
{
  $resultat = executeRequete("SELECT * FROM commande WHERE id_commande='$_GET[id_commande]'");
  $membre_a_supprimer = $resultat->fetch_assoc();
  executeRequete("DELETE FROM commande WHERE id_commande='$_GET[id_commande]'");
  $_GET['action'] = 'affichage';
}
/***************** FIN SUPPRESSION ********************/

require_once("../inc/header.inc.php");
require_once("../inc/nav.inc.php");
?>

<section>
	<body>
<?php
//*************AFFICHAGE DES COMMANDES *********************//
$resultat = executeRequete("SELECT * FROM commande ORDER BY id_commande DESC");
{
	echo '<hr>';
	echo '<p class="f-size">'.'Affichage des commandes'.'</p>';
	echo '<p class="f-size">Nombre de commande: '.$resultat->num_rows.'</p>';
	echo '<table border="1">';
	  
	echo '<tr>';
	  while($titre = $resultat->fetch_field())
	  {
	    echo '<th>'.$titre->name.'</th>'; // première ligne contenant les noms de nos colonnes
	  }
	  echo '<th>Détails</th><th>Modif</th><th>Suppr</th></tr>';
	  while($ligne = $resultat->fetch_assoc())
	  {
	    echo '<tr>';
	    foreach($ligne AS $indice => $valeur)	    
	     {
	        echo '<td>'.$valeur.'</td>';
	      }
	    echo '<td><a href="?action=details&id_details_commande='.$ligne['id_commande'].'"</a>Détails</td>';
	    echo '<td><a href="?action=editer&id_commande='.$ligne['id_commande'].'"><img src="../images/modif.png" alt=""></a></td>';
		echo '<td><a href="?action=suppression&id_commande='.$ligne['id_commande'].'"onClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../images/erase.png" alt="supprimer"></a></td>';

	    echo '</tr>';
	  }

	
	echo'</table>';
//*************FIN AFFICHAGE DES COMMANDES *********************//	
//*************AFFICHAGE DETAILS DES COMMANDES *********************// 

}
if(isset($_GET['action']) && $_GET ['action'] == 'details')
{
  $resultat_details = executeRequete("SELECT * FROM details_commande WHERE id_details_commande='$_GET[id_details_commande]'");
  {
  	echo '<hr>';
	echo '<p class="f-size">Détails de la commande</p>';
	echo '<table border="1">';
	  
	echo '<tr>';
	  while($titre = $resultat_details->fetch_field())
	  {
	    echo '<th>'.$titre->name.'</th>'; // première ligne contenant les noms de nos colonnes
	  }
	  
	  while($ligne = $resultat_details->fetch_assoc()) //contenu du tableau avec le détail inscrit dans la table bdd
	  {
	    echo '<tr>';
	    foreach($ligne AS $indice => $valeur)	    
	     {
	        echo '<td>'.$valeur.'</td>';
	      } 
	    echo '<p>'.$membre['pseudo'].'</p>';
	    echo '</tr>';
	  }

	
	echo'</table>';
  }
}
//*************FIN AFFICHAGE DETAILS DES COMMANDES *********************// 
?>
	</body>
</section>

<?php
require_once("../inc/footer.inc.php");