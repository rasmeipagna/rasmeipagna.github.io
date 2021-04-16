<?php
include("../inc/init.inc.php");
//vérification du statut de l'utilisateur
if(!utilisateurEstConnecteEtEstAdmin())
{
	header('location:../profil.php');
	exit();
}

/************* $SUPPRESSION CODE PROMO - DEBUT *************/
//var_dump($_GET);
if(isset($_GET['action']) && $_GET['action'] == 'suppression-codepromo')
{
	//sécurisation des saisies en entrée
	$_GET[$id_promo] = htmlentities($_GET['id_promo'], ENT_QUOTES);

	//on peut ensuite supprimer le code promo en base de donnée
	executeRequete("DELETE FROM promotion WHERE id_promo='$_GET[$id_promo]'");

	//afficher la table des codes promo tout de suite après avoir supprimé le code promo :
	$_GET['action'] = "affichage-codespromo";
}

/************* $SUPPRESSION CODE PROMO - FIN *************/


/************* $ENREGISTREMENT CODE PROMO - DEBUT *************/
if(isset($_POST['enregistrement']))
{
	//sécurisation des saisies
	foreach ($_POST as $indice => $valeur) 
	{
		$_POST[$indice] = htmlentities($_POST[$indice], ENT_QUOTES);
	}

	//déclaration des variables avant de les utiliser dans la fonction/requête
	extract($_POST);

	//requête SQL qui vérifie si le code promo existe en base de données:
	$codespromo_bdd = executeRequete("SELECT * FROM promotion WHERE code_promo='$code_promo'"); // 

	//si le code promo existe déjà et qu'il s'agit d'un ajout, on affiche une erreur
	if($codespromo_bdd->num_rows > 0 && isset($_GET["action"]) && $_GET["action"] == "ajout-codepromo") 
	{
		$msg .= '<div class="erreur"><p>Ce code promo existe déjà. Veuillez vérifier vos saisies !</p></div>';
	}
	else 
	
	//si pas d'erreur lors de l'ajout du code promo
	if(empty($msg))
	{
		executeRequete("REPLACE INTO promotion (id_promo, code_promo, reduction) VALUES ('$id_promo', '$code_promo', '$reduction')");

		if($_GET["action"] == 'ajout-codepromo'){
			$msg .= '<div class="confirm"><p>Code promo ajouté !</p></div>';
		}else{
			$msg .= '<div class="confirm"><p>Code promo modifié !</p></div>';
		}
	}
}
/************* $ENREGISTREMENT CODE PROMO - FIN *************/
include("../inc/header.inc.php");
include("../inc/nav.inc.php");
echo $msg;
?>

  	<section>
  		<body>
  			<div class="text">
				<div class="lien2">
			  			<h2>Gestion des codes promo</h2>
			  			
			  			<a id="lien1" class="trans1" href="?action=ajout-codepromo" >Ajouter un code promo</a>&nbsp;
			        <a id="lien1" class="trans1" href="?action=affichage-codespromo" >Afficher les codes promo</a>
			  	</div>
			</div>


<?php
/********* $AJOUT D'UN CODE PROMO - DEBUT *********/
if(isset($_GET["action"]) && ($_GET["action"] == 'ajout-codepromo' || $_GET["action"] == 'modification-codepromo'))
{
	//s'il s'agit d'une modification
	if(isset($_GET["id_promo"])) 
	{
		//sécurisation des saisies en entrée
		$_GET[$id_promo] = htmlentities($_GET['id_promo'], ENT_QUOTES);

		//puis récupérer toutes les données du code promo à modifier
		$resultat = executeRequete("SELECT * FROM promotion WHERE id_promo = '$_GET[$id_promo]'");

		$codepromo_actuel = $resultat->fetch_assoc();
		//debug($codepromo_actuel);
	}
?>

	      		<h3>
					<?php 
					if($_GET["action"] == 'ajout-codepromo'){
						echo '<h1 class="titre2 lien2">Ajout d\'un code promo</h1>';
					}else{
						echo '<h1 class="titre2 lien2">Modification d\'un code promo</h1>';
					}
					?>
	      		</h3>
	      		<form method="post" action="" role="form">
					<div class="">
						<input type="hidden" class="ligne" id="id_promo" name="id_promo" value="<?php if(isset($codepromo_actuel['id_promo'])) { echo $codepromo_actuel['id_promo']; } ?>">
					</div>				
					
					<div class="">
						<label for="code">Code Promo</label>
						<input type="text" id="code" class="ligne" name="code_promo" value="<?php if(isset($_POST['code_promo'])) { echo $_POST['code_promo']; }elseif(isset($codepromo_actuel['code_promo'])){ echo $codepromo_actuel['code_promo']; } ?>" placeholder="Code promo" maxlength="6">
					</div>

					<div class="">
						<label for="discount">Réduction</label>
						<input type="text" id="discount" class="ligne" name="reduction" value="<?php if(isset($_POST['reduction'])) { echo $_POST['reduction']; }elseif(isset($codepromo_actuel['reduction'])){ echo $codepromo_actuel['reduction']; } ?>" placeholder="Réduction">
					</div>

					<div class="">
						<input type="submit" name="enregistrement" id="btn" class="trans1" value="Valider"> 
					</div>
				</form>
	
<?php
}
/********* $AJOUT D'UN CODE PROMO - FIN *********/


/********* $AFFICHAGE DES CODES PROMO - DEBUT *********/
if(isset($_GET["action"]) && $_GET["action"] == 'affichage-codespromo')
{	
	echo '<div class="text">';
	echo '<h1 class="titre2 lien2">Affichage des codes promo</h1>';
	
	//on récupère les données sous forme inexploitable:
	$resultat = $mysqli->query("SELECT * FROM promotion");
	echo '<p>Nombre de codes promo : ' . $resultat->num_rows . '</p>';
	echo '<table border="1">';
	
	//affichage de la ligne des titres
	echo '<tr>';
	//on récupére les informations sur les champs sous forme d'objet
	while($titre = $resultat->fetch_field())
	{
		echo '<th>' . $titre->name . '</th>';
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
		echo '<td><a href="?action=modification&id_promo='.$ligne['id_promo'].'"><img src="../images/modif.png" alt=""></a></td>';
    echo '<td><a href="?action=suppression&id_promo='.$ligne['id_promo'].'"onClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../images/erase.png" alt="supprimer"></a></td>';
		echo '</tr>';
	}

	echo '</table>';
	echo '</div>';
} 
/********* $AFFICHAGE DES CODES PROMO - FIN *********/
?>


			</div>
			<!-- /.container -->
		</div>
		<!-- /.main -->
  		</body>

     </section>

<?php
include("../inc//admin_footer.inc.php");