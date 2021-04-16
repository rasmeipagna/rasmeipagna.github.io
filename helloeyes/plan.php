<?php
require_once("inc/init.inc.php");
require_once("inc/header.inc.php");
require_once("inc/nav.inc.php");
?>

<section>
	<body>
		<ul>
			<li  style="display:block;"><a class="trans1 <?php active('/soutenance/index.php');?>" href="index.php">Home</a></li>
	        <li  style="display:block;"><a class="trans1 <?php active('/soutenance/inspiration.php');?>" href="inspiration.php">Inspiration</a></li>
	        <li  style="display:block;"><a class="trans1 <?php active('/soutenance/connexion.php');?>" href="connexion.php">Mon compte</a></li>
	    </ul>
	</body>
</section>

<?php
require_once("inc/footer.inc.php");