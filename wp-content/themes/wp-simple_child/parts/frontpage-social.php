<?php 
$section_bg=nimbus_get_option('fp-social-background-image');
if (!empty($section_bg['url'])) {
    $nimbus_parallax="data-parallax='scroll' data-image-src='" . $section_bg['url'] . "' style='background: transparent;padding:220px 0 200px;background: rgba(0, 0, 0, 0.3);'";
    $parallax_active="parallax_active";
} 
if (nimbus_get_option('fp-social-toggle') == '1') { ?>
    <section id="<?php if (nimbus_get_option('fp-social-slug')=='') {echo "social";} else {echo nimbus_get_option('fp-social-slug');} ?>" class="frontpage-row frontpage-social <?php if(isset($parallax_active)){echo $parallax_active;} ?>" <?php if(isset($nimbus_parallax)){echo $nimbus_parallax;} ?>>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (nimbus_get_option('fp-social-title') != '') { ?>
                        <div class="social-title h1"><?php echo nimbus_get_option('fp-social-title'); ?></div>
                    <?php } ?>
                    <?php if (nimbus_get_option('fp-social-sub-title') != '') { ?>
                        <div class="social-sub-title h4"><?php echo nimbus_get_option('fp-social-sub-title'); ?></div>
                    <?php } ?>
                    <div class="inline-center-wrapper">  
                    <?php if ( is_active_sidebar( 'frontpage-social-media' ) ) { ?>
                    	<?php dynamic_sidebar( 'frontpage-social-media' ); ?>
                    <?php } ?>
                    </div>
                </div> 
            </div>    
        </div>    
    </section> 
<?php } else if (nimbus_get_option('fp-social-toggle') == '3') {
    // Don't do anything
} else { ?>  
    <section id="<?php if (nimbus_get_option('fp-social-slug')=='') {echo "social";} else {echo nimbus_get_option('fp-social-slug');} ?>" class="frontpage-row frontpage-social preview parallax_active" data-parallax='scroll' data-image-src='<?php echo get_template_directory_uri(); ?>/images/preview/jelly.jpg' style='background: transparent;padding:220px 0 200px;background: rgba(0, 0, 0, 0.3);'>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="social-title h1">Connect With Us</div>
                    <div class="social-sub-title h4">There are lots of ways to connect with us, and we want you to try them all!</div>
                    <div class="inline-center-wrapper">  
                        <div data-sr="wait 0.2s, scale up 25%">
                            <a href="#"><i class="fa fa-bitbucket"></i><br><span class="social-item-title h5">BitBucket</span><br><span class="social-item-sub-title h5">Follow our code.</span></a>
                        </div>
                        <div data-sr="wait 0.2s, scale up 25%">
                            <a href="#"><i class="fa fa-twitter"></i><br><span class="social-item-title h5">Twitter</span><br><span class="social-item-sub-title h5">Latest tweets.</span></a>
                        </div>
                        <div data-sr="wait 0.2s, scale up 25%">
                            <a href="#"><i class="fa fa-facebook"></i><br><span class="social-item-title h5">Facebook</span><br><span class="social-item-sub-title h5">Be our friend.</span></a>
                        </div>
                        <div data-sr="wait 0.2s, scale up 25%">
                            <a href="#"><i class="fa fa-instagram"></i><br><span class="social-item-title h5">Instagram</span><br><span class="social-item-sub-title h5">See our pics.</span></a>
                        </div>
                        <div data-sr="wait 0.2s, scale up 25%">
                            <a href="#"><i class="fa fa-linkedin"></i><br><span class="social-item-title h5">Linkedin</span><br><span class="social-item-sub-title h5">Let's network.</span></a>
                        </div>
                    </div>
                </div> 
            </div>    
        </div>    
    </section> 
<?php } ?> 

