<?php 
$section_bg=nimbus_get_option('fp-team-background-image');
if (!empty($section_bg['url'])) {
    $nimbus_parallax="data-parallax='scroll' data-image-src='" . $section_bg['url'] . "' style='background: transparent;padding:220px 0 200px;background: rgba(0, 0, 0, 0.3);'";
    $parallax_active="parallax_active";
} 
if (nimbus_get_option('fp-team-toggle') == '1') { ?>
    <section id="<?php if (nimbus_get_option('fp-team-slug')=='') {echo "team";} else {echo nimbus_get_option('fp-team-slug');} ?>" class="frontpage-row frontpage-team <?php if(isset($parallax_active)){echo $parallax_active;} ?>" <?php if(isset($nimbus_parallax)){echo $nimbus_parallax;} ?>>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="team-title h1"><?php echo nimbus_get_option('fp-team-title'); ?></div>
                    <div class="team-sub-title h4"><?php echo nimbus_get_option('fp-team-sub-title'); ?></div>
                    
                    <div class="row row-centered">
                        <?php if ( is_active_sidebar( 'frontpage-team-left' ) ) { ?>
                        	<div class="col-sm-3 col-centered">
                        		<?php dynamic_sidebar( 'frontpage-team-left' ); ?>
                        	</div>
                        <?php } ?>
                        <?php if ( is_active_sidebar( 'frontpage-team-center-left' ) ) { ?>
                        	<div class="col-sm-3 col-centered">
                        		<?php dynamic_sidebar( 'frontpage-team-center-left' ); ?>
                        	</div>
                        <?php } ?>
                        <?php if ( is_active_sidebar( 'frontpage-team-center-right' ) ) { ?>
                        	<div class="col-sm-3 col-centered">
                        		<?php dynamic_sidebar( 'frontpage-team-center-right' ); ?>
                        	</div>
                        <?php } ?>
                        <?php if ( is_active_sidebar( 'frontpage-team-right' ) ) { ?>
                        	<div class="col-sm-3 col-centered">
                        		<?php dynamic_sidebar( 'frontpage-team-right' ); ?>
                        	</div>
                        <?php } ?>
                    </div>    

                </div> 
            </div>    
        </div>    
    </section> 
<?php } else if (nimbus_get_option('fp-team-toggle') == '3') {
    // Don't do anything
} else { ?>  
    <section id="<?php if (nimbus_get_option('fp-team-slug')=='') {echo "team";} else {echo nimbus_get_option('fp-team-slug');} ?>" class="frontpage-row frontpage-team preview">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="team-title h1">Meet the Team</div>
                    <div class="team-sub-title h4">Showcase the great people behind your company.</div>
                    
                    <div class="row row-centered">

                        <div class="col-sm-3 col-centered">
                            <div class="team-item" data-sr="wait 0.3s, enter right and move 50px after 1s">
                                <h4 class="team-item-title">Sally Brown</h4>
                                <img class="img-responsive center-block" src="<?php echo get_template_directory_uri(); ?>/images/preview/262x262-6.jpg" />
                                <h5 class="team-item-sub-title">CEO and Chair Woman</h5>
                                <p class="team-social-icons"><a href="#"><i class="fa fa-youtube"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-facebook"></i></a></p>
                            </div>
                        </div> 

                       <div class="col-sm-3 col-centered">
                            <div class="team-item" data-sr="wait 0.3s, enter right and move 50px after 1s">
                                <h4 class="team-item-title">John Smith</h4>
                                <img class="img-responsive center-block" src="<?php echo get_template_directory_uri(); ?>/images/preview/262x262-1.jpg" />
                                <h5 class="team-item-sub-title">CFO and Mascot</h5>
                                <p class="team-social-icons"><a href="#"><i class="fa fa-youtube"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-facebook"></i></a></p>
                            </div>
                        </div>           
                        
                        <div class="col-sm-3 col-centered">
                            <div class="team-item" data-sr="wait 0.3s, enter right and move 50px after 1s">
                                <h4 class="team-item-title">Emma Kline</h4>
                                <img class="img-responsive center-block" src="<?php echo get_template_directory_uri(); ?>/images/preview/262x262-2.jpg" />
                                <h5 class="team-item-sub-title">Vice President</h5>
                                <p class="team-social-icons"><a href="#"><i class="fa fa-youtube"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-facebook"></i></a></p>
                            </div>
                        </div> 
                        
                        <div class="col-sm-3 col-centered">
                            <div class="team-item" data-sr="wait 0.3s, enter right and move 50px after 1s">
                                <h4 class="team-item-title">Tom Baggins</h4>
                                <img class="img-responsive center-block" src="<?php echo get_template_directory_uri(); ?>/images/preview/262x262-3.jpg" />
                                <h5 class="team-item-sub-title">Project Manager</h5>
                                <p class="team-social-icons"><a href="#"><i class="fa fa-youtube"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-facebook"></i></a></p>
                            </div>
                        </div> 
                    </div>    

                </div> 
            </div>    
        </div>    
    </section> 
<?php } ?> 

