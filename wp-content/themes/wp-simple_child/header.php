<?php
if (is_single() || is_page()) // Si c'est un article ou une page
    $metaDescription = get_post_meta((int)$post->ID, 'meta-description', true); // on récupère ce qu'on veut
 
// Pour avoir une description par défaut si on n'a rien récupéré
$metaDescriptionDefault = 'Web developer, Webdesigner Rasmei-Pagna TOUNG';
if (!isset($metaDescription))
    $metaDescription = $metaDescriptionDefault;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Mono:100,100italic' rel='stylesheet' type='text/css'>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php wp_title('Rasmei-Pagna TOUNG'); ?></title>
<?php
if (isset($metaDescription))
    echo '<meta name="description" content="'.$metaDescription .'">';
?>
        <meta property="og:type" content="PortFolio, Website, of Rasmei-Pagna TOUNG" />
        <meta property="og:title" content="Rasmei-Pagna TOUNG" />
        <meta property="og:url" content="http://www.rasmeipagna.com" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php wp_head(); ?>

    </head>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-82448269-1', 'auto');
  ga('send', 'pageview');

</script>
    <body <?php body_class(); ?>>
        <header id="<?php if (nimbus_get_option('home-slug')=='') {echo "action2";} else {echo nimbus_get_option('home-slug');} ?>">
            <?php
            // get_template_part( 'parts/header','menu');
            get_template_part( 'parts/header','banner');
            ?>
        </header>