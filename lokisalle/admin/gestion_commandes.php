<?php
include("../inc/init.inc.php");
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
include("../inc/header.inc.php");
include("../inc/nav.inc.php");

?>

  	<section>
  		<body>
  			<div class="text">
			<div class="lien2">
       			<h1 class="titre">Gestion des Commandes</h1>
	  		</div>
			</div>
<?php
//*************AFFICHAGE DES COMMANDES *********************//
$resultat = executeRequete("SELECT * FROM commande ORDER BY id_commande DESC");
{
	
	echo '<div class="text">';
	echo '<h1 class="titre2 lien2">Affichage des commandes</h1>';
	echo '<p>Nombre de commande: '.$resultat->num_rows.'</p>';
	echo '<table border="1">';
	  
	echo '<tr>';
	  while($titre = $resultat->fetch_field())
	  {
	    echo '<th>'.$titre->name.'</th>'; // première ligne contenant les noms de nos colonnes
	  }
	  echo '<th>Détails</th><th>Suppr</th></tr>';
	  while($ligne = $resultat->fetch_assoc())
	  {
	    echo '<tr>';
	    foreach($ligne AS $indice => $valeur)	    
	     {
	        echo '<td>'.$valeur.'</td>';
	      }
	    echo '<td><a href="?action=details&id_commande='.$ligne['id_commande'].'"</a>Détails</td>';
		echo '<td><a href="?action=suppression&id_commande='.$ligne['id_commande'].'"onClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../images/erase.png" alt="supprimer"></a></td>';

	    echo '</tr>';
	  }

	
	echo'</table>';
	echo '</div>';
	  

}
if(isset($_GET['action']) && $_GET ['action'] == 'details')
{	

	$resultat_details = executeRequete("SELECT c.id_commande, c.montant, c.date, c.id_membre, m.pseudo, d.id_produit, s.id_salle, s.ville FROM details_commande d, commande c, membre m, produit p, salle s WHERE d.id_commande = c.id_commande AND m.id_membre=c.id_membre AND d.id_produit=p.id_produit AND s.id_salle=p.id_salle AND d.id_commande='$_GET[id_commande]'");
  {
  	echo '<div class="text">';
	echo '<h1 class="titre2 lien2">Détails de la commande</h1>';
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
	   
	    echo '</tr>';
	  }

	
	echo'</table>';
  }
}
?>
  		</body>

     </section>

<?php
include("../inc//admin_footer.inc.php");