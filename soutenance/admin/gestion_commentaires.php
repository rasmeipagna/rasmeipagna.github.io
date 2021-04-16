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
  $resultat = executeRequete("SELECT * FROM avis WHERE id_avis='$_GET[id_avis]'");
  $membre_a_supprimer = $resultat->fetch_assoc();
  executeRequete("DELETE FROM avis WHERE id_avis='$_GET[id_avis]'");
  $_GET['action'] = 'affichage';
}
/***************** FIN SUPPRESSION ********************/

require_once("../inc/header.inc.php");
require_once("../inc/nav.inc.php");
?>

<section>
	<body>
<?php
//*************AFFICHAGE DES AVIS *********************//
$resultat = executeRequete("SELECT * FROM avis ORDER BY id_avis DESC");
//$resultat2 = executeRequete("SELECT * FROM membre WHERE id_membre = '$_GET[id_membre]'");// ici la requete pour appeler les membre afin que soit lié le membre à l'avis
{
	echo '<hr>';
	echo '<p class="f-size">'.'Affichage des avis'.'</p>';
	echo '<p class="f-size">Nombre d\'avis: '.$resultat->num_rows.'</p>';
	echo '<table border="1">';
	  
	echo '<tr>';
	  while($titre = $resultat->fetch_field())
	  {
	    echo '<th>'.$titre->name.'</th>'; // première ligne contenant les noms de nos colonnes
	  }
	  echo '<th>Suppr</th></tr>';
	  while($ligne = $resultat->fetch_assoc())
	  {
	    echo '<tr>';
	    foreach($ligne AS $indice => $valeur)	    
	     {
	        echo '<td>'.$valeur.'</td>';
	      }
	    
	    
		echo '<td><a href="?action=suppression&id_avis='.$ligne['id_avis'].'"onClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../images/erase.png" alt="supprimer"></a></td>';

	    echo '</tr>';
	  }

	
	echo'</table>';
	  

}

?>
	</body>
</section>

<?php
require_once("../inc/footer.inc.php");