<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'usj87942');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'usj87942');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'VHPxqJPQWMIM');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'cl1-sql23');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/** Augmenter la taille de la mémoire*/
define('WP_MEMORY_LIMIT', '32M');

/** Nombre de sauergarde par articles pour diminuer le poids de la BDD*/
/* Indique le nombre max de révisions d'un article, ici 3*/
define('WP_POST_REVISIONS', 3 );
/* Les sauvegardes automatiques sont maintenant de 180 secondes*/
define('AUTOSAVE_INTERVAL', 180 );

/** On vide la corbeille tous les 7 jours*/
define('EMPTY_TRASH_DAYS', 7 );

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '35RPxS(8xJV$~CgUBi=.*ELZIgr bE[PKiBop~2m@12$wc_hmL:N>]%-dPLtEo/!');
define('SECURE_AUTH_KEY',  'RRH?u<m).(r-G[%8t`~S)$rPh=[ae*y;Sv#^L[71=]LQ4o{qH|}`G fN$)/J&2n&');
define('LOGGED_IN_KEY',    '3D/O:[$Vn-!0Q9Mc]{Eg[XY<cZ6{&LgGGc]JQx4*S^v`+6[QGrm?^Nz[PIeHa.l9');
define('NONCE_KEY',        'W=&2.E,Y)6t%ifGzB/!g4<@jG?+SY]040gISU=A<y]e/(yoNE`w}3[E/FTl1]RIE');
define('AUTH_SALT',        '/KZC1{Y$7#Q%m7bu^QHo8@yunH|gU0m4+I,8nKK;XKeP`9qu(`]1[X*%HXO4`9;|');
define('SECURE_AUTH_SALT', 'j^~aT3rdZ2]CDWgMZ32nC2^$)y*MEf((tW@IoaD#%(ZJ@%HH|J/#-g?cHX1PLX;I');
define('LOGGED_IN_SALT',   'mShNg A_B%:6M!F0gXc9W+ne-Z(G:Di ?ADY+CX(b?& 4OqHa^KNf-QL~Bwb1#;j');
define('NONCE_SALT',       ',`2fMV45SCjwDwf0-AoD |^;F{X_ngHeh.IN@z{ 0Z&C2IbARav)3;&n1VoZfQ?;');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_rasmeipagna_portfolio';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d'information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress 
 */
define('WP_DEBUG', false); /*Mettre true si jamais oon rencontre un bug wordpress*/

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');