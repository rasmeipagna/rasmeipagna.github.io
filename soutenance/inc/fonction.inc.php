<?php
function executeRequete($req)
{
	global $mysqli; // permet d'avoir accès à la variable $mysqli définie dans l'environnement global
	$resultat = $mysqli->query($req); // on exécute la requete reçue en argument
	if(!$resultat) // raccourci pour dire si $resultat = FALSE dans ce cas, il y a un problème sur la requete
	{
		die("Erreur sur la requete sql<br/>Message: ".$mysqli->error ."<br/>Code: $req");
	}
	return $resultat; // on renvoi un objet issu de la classe Mysqli_result
}

/*******************************************************/

function debug($var, $mode = 1)
{
	echo'<div>';
	if($mode === 1)
	{
		print '<pre>';var_dump($var); echo'</pre>';
	}
	else{
		print '<pre>';print_r($var); echo'</pre>';
	}
	echo '</div>';
	return;
	
}
/***********************************************/
/*************FONCTION UTILISATEUR*************/
/***********************************************/
function utilisateurEstConnecte()
{
  if(!isset($_SESSION['utilisateur'])) // on vérifie si l'indice utilisateur existe dans la session. Si cet indice existe al ors forcément l'utilisauer est connecté
  {
    return FALSE; // s'il n'eest pas connecté : on renvoi FALSE
  }
  else{
    return TRUE; // connecté on renvoi TRUE
  }
}
//----------------------------------------------
function utilisateurEstConnecteEtEstAdmin()
{
	if(utilisateurEstConnecte() && $_SESSION['utilisateur']['statut'] == 1)
	{
		return TRUE;
	}
	return FALSE;
}

//--------------ACTIVE NAV----------------------

function active($url)
{
  if ($_SERVER['PHP_SELF'] == $url)
  {
    echo ' active';
  }
}

//--------------PHOTO----------------------
function verificationExtensionPhoto()
{
	$extension = strrchr($_FILES['photo']['name'], '.');// strrchr permet de remonter la chaine de caractères donnée en 1er argument et la coupe, pour nous renvoyer le contenu à partir du "." donné en 2eme argument. Remonte car cette fonction remonte en partant de la fin de la chaine.
	$extension = strtolower(substr($extension, 1));// strtolower met en minuscule s'il y a majuscule //substr coupe une chaine de caractère, ici il s'agit du '.' => au lieu de récupérer ".jpg" on a desormais "jpg"
	$tab_extension_valide = array('gif', 'png', 'jpg', 'jpeg');// nous déclarons un tableau ARRAY contenant les extensions autorisées.
	$verif_extension = in_array($extension, $tab_extension_valide); // in_array va chercher si la valeur du premier argument se trouve dans une des valeurs du deuxième argument qui doit obligatoirement être un tableau ARRAY // nous renvoi TRUE ou FALSE
	return $verif_extension;
}

//----------PANIER---------------------
function creationDuPanier()
{
  if(!isset($_SESSION['panier']))
  {
    $_SESSION['panier'] = array();
    $_SESSION['panier']['titre'] = array();
    $_SESSION['panier']['id_article'] = array();
    $_SESSION['panier']['quantite'] = array();
    $_SESSION['panier']['prix'] = array();
  }
  return TRUE;
}
// soit le panier n'existe pas, on le crée, on rtourne TRUE
// soit il existe déjà, on retourne directement TRUE

function ajouterArticleDansPanier($titre, $id_article, $quantite, $prix) // réception d'argument en provenance de panier.php
{
  // nous devons savoir si l'article que l'on souhaite ajouter est déjà présent dans le panier ou non.
  $position_article = array_search($id_article, $_SESSION['panier']['id_article']); // la fonction array_search() nous renvoi l'indice du tableau où se trouve l'article que l'on cherche.
  if($position_article !== FALSE) // si l'article a été trouvé dans notre $_SESSION['panier']['id_article']
  {
    $_SESSION['panier']['quantite'][$position_article] += $quantite; // nous rajoutons uniquement la nouvelle quantité.
  }
  else { // sinon si l'id_article n'est pas trouvé, on rentre les informations de l'article dans le panier.
    $_SESSION['panier']['titre'][] = $titre;
    $_SESSION['panier']['id_article'][] = $id_article;
    $_SESSION['panier']['quantite'][] = $quantite;
    $_SESSION['panier']['prix'][] = $prix;
  }
}


function retirerArticleDuPanier($id_article_a_supprimer)
{
  $position_article = array_search($id_article_a_supprimer, $_SESSION['panier']['id_article']); // array_seach() nous renvoi l'indice ou se trouve le premier argument.
  
  if($position_article !== FALSE) // si le produit est présent
  {
    array_splice($_SESSION['panier']['titre'], $position_article, 1);
    array_splice($_SESSION['panier']['id_article'], $position_article, 1);
    array_splice($_SESSION['panier']['quantite'], $position_article, 1);
    array_splice($_SESSION['panier']['prix'], $position_article, 1);
    // array_splice() à ne pas confondre avec array_slice() permet de retirer un élément d'un tableau ARRAY et de réordonner le tableau afin qu'il n'y ai pas de décalage.
  }
}

// --- Montant total

function montantTotal()
{
  $total = 0;
  for($i=0; $i < count($_SESSION['panier']['quantite']); $i++) //boucle qui tourne autant de fois qu'il y a d'article dans le panier.
  {
    $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i]; // on multiplie la quantité par le prix.
  }
  return round($total, 2); // on renvoi $total qui contient la valeur totale du panier.
}
