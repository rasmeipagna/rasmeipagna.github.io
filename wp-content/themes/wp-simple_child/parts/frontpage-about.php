<?php 
$section_bg=nimbus_get_option('fp-about-background-image');
if (!empty($section_bg['url'])) {
    $nimbus_parallax="data-parallax='scroll' data-image-src='" . $section_bg['url'] . "' style='background: transparent;padding:220px 0 200px;background: rgba(0, 0, 0, 0.3);'";
    $parallax_active="parallax_active";
} 
if (nimbus_get_option('fp-about-toggle') == '1') { ?>
    <section id="<?php if (nimbus_get_option('fp-about-slug')=='') {echo "about";} else {echo nimbus_get_option('fp-about-slug');} ?>" class="frontpage-row frontpage-about <?php if(isset($parallax_active)){echo $parallax_active;} ?>" <?php if(isset($nimbus_parallax)){echo $nimbus_parallax;} ?>>   
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (nimbus_get_option('fp-about-title') != '') { ?>
                        <div class="about-title h1"><?php echo nimbus_get_option('fp-about-title'); ?></div>
                    <?php } ?>
                    <?php if (nimbus_get_option('fp-about-sub-title') != '') { ?>
                        <div class="about-sub-title h4"><?php echo nimbus_get_option('fp-about-sub-title'); ?></div>
                    <?php } ?>
                    <?php if (nimbus_get_option('fp-about-description') != '') { ?>
                        <p class="about-desc"><?php echo nimbus_get_option('fp-about-description'); ?></p>
                    <?php } ?>
                    <?php if ( is_active_sidebar( 'frontpage-about-left' ) ) { ?>
                    	<?php dynamic_sidebar( 'frontpage-about-left' ); ?>
                    <?php } ?>
                    <?php if ( is_active_sidebar( 'frontpage-about-center' ) ) { ?>
                    	<?php dynamic_sidebar( 'frontpage-about-center' ); ?>
                    <?php } ?>
                    <?php if ( is_active_sidebar( 'frontpage-about-right' ) ) { ?>
                    	<?php dynamic_sidebar( 'frontpage-about-right' ); ?>
                    <?php } ?>
                </div> 
            </div>    
        </div>    
     </section>
<?php } else if (nimbus_get_option('fp-about-toggle') == '3') {
    // Don't do anything
} else { ?>  
    <section id="<?php if (nimbus_get_option('fp-about-slug')=='') {echo "about";} else {echo nimbus_get_option('fp-about-slug');} ?>" class="frontpage-row frontpage-about preview">   
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="about-title h1">A propos</div>
                    <!-- <div class="about-sub-title h4">de moi</div> -->
                    <p class="about-desc">Développeur Intégrateur Web Junior - Illustratrice </p>
                    <div class="row frontpage-about-row" data-sr="enter left and move 50px after 1s">
                        <div class="col-sm-4">
                            <div class="about-content" style="text-align:justify;">
                                Je m'appelle Rasmei-Pagna ou simplement Pagna, j'ai commencé l'intégration et le développement de site fin 2014 de manière autonome. J'ai effectué une formation de Développeur Intégrateur Web en 2015 pour compléter mes connaissances et où j'ai obtenu ma certification en Juin 2016. Dans le cadre de cette formation, j'ai utilisé les langages suivant : HTML5/CSS3, Javascript, XML, SQL, PHP procédural, Drupal, Wordpress et travaillé avec les outils suivants : Bootstrap, jQuery. Mise en application durant un stage de 3 mois dans une agence digitale/web, où j'ai intégré un Back Office avec CSS et jQuery, puis intégré et développé un site e-commerce sous Prestashop.
                                Dans la vie, je fais de la guitare et du piano, j'aime beaucoup dessiner sur ma tablette. <!-- Fan incoutournable des sagas Harry Potter et Star Wars, je dispose également de bonnes compétences sur Mass Effect et GTA5 (pas tous les jours non plus hein !) -->. J'aime sortir avec les amis, aller au musée/concerts. Plutard j'aimerai pourquoi pas, travailler dans un pays Anglo-saxon !<br><br>

                                Contactez-moi : <a href="mailto:hello@rasmeipagna.com">hello@rasmeipagna.com</a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="about-quote" style="text-align:justify;">
                                "Knowing is not enough : we must apply. Willing is not enough: we must do."<span>~ B.Lee</span>
                                
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="about-content" style="text-align:justify;">
                                My name is Pagna, I've learned code since 2014 by myself. I did a continuous training in 2015 to improve my knowledge which I completed degree in June 2016. During my formation, I've worked with the following languages : HTML5/CSS3, Javascript, Bootstrap, jQuery, MySql, PHP, Drupal, Wordpress. I've done a training period of 3 month in a webagency in Paris, which I've created a Back Office with CSS and jQuery, and developed an E-commerce website with Prestashop.
                                Furthermore, I'm playing guitar and piano, I love drawing on my digital tablet. I'm a huge fan of Harry Potter and Star Wars. <!-- I'm good at Mass Effect and GTA5 (not everyday either eh !) -->I appreciate having a good time with my friends, go to the museum or gigs. I wish I could work in another country, maybe one day ! <br><br>
                                
                                Contact me : <a href="mailto:hello@rasmeipagna.com">hello@rasmeipagna.com</a>
                            </div>
                        </div>   
                    </div>
                </div> 
            </div>    
        </div>    
     </section>
<?php } ?> 