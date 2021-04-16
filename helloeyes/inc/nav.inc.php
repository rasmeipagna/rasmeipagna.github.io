    <nav>
      <ul>
        <?php if(utilisateurEstConnecte()) {?>
        <li><a class="trans1 <?php active('/soutenance/index.php');?>" href="<?php echo RACINE_SITE;?>index.php">Home</a></li>
        <li><a class="trans1 <?php active('/soutenance/inspiration.php');?>" href="<?php echo RACINE_SITE;?>inspiration.php">Inspiration</a></li>
        <li><a class="trans1 <?php active('/soutenance/panier.php');?>" href="<?php echo RACINE_SITE;?>panier.php">Panier</a></li>
        <li><a class="trans1 <?php active('/soutenance/profil.php');?>" href="<?php echo RACINE_SITE;?>profil.php">Profil</a></li>
        <li><a class="trans1 <?php active('/soutenance/connexion.php');?>" href="<?php echo RACINE_SITE;?>connexion.php?action=deconnexion">Deconnexion</a></li>
        
        <?php }else{ ?>

        <li><a class="trans1 <?php active('/soutenance/index.php');?>" href="index.php">Home</a></li>
        <li><a class="trans1 <?php active('/soutenance/inspiration.php');?>" href="inspiration.php">Inspiration</a></li>
        <li><a class="trans1 <?php active('/soutenance/connexion.php');?>" href="connexion.php">Mon compte</a></li>
        
        <?php }?>
      </ul>
      <ul>
        <?php if(utilisateurEstConnecteEtEstAdmin())
        {
              
              echo '<li ("/soutenance/index.php");><a class="trans1" href="'.RACINE_SITE.'admin/gestion_produits.php">Gestion Produits</a></li>';
              echo '<li ("/soutenance/index.php");><a class="trans1" href="'.RACINE_SITE.'admin/gestion_commandes.php">Gestion Commandes</a></li>'; 
              echo '<li ("/soutenance/index.php");><a class="trans1" href="'.RACINE_SITE.'admin/gestion_membres.php">Gestion Membres</a></li>';
              echo '<li ("/soutenance/index.php");><a class="trans1" href="'.RACINE_SITE.'admin/gestion_commentaires.php">Gestion Commentaires</a></li>';
              
              
        }
        ?>
        
      </ul>
    </nav>

  </header>