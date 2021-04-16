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
                    <div class="about-title h1">About Us</div>
                    <div class="about-sub-title h4">A little bit of background on our fabulous company.</div>
                    <p class="about-desc">Uenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.Cum sociis natoque penatibus.</p>
                    <div class="row frontpage-about-row" data-sr="enter left and move 50px after 1s">
                        <div class="col-sm-4">
                            <div class="about-content">
                                Uenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.Cum sociis natoque penatibus. Uenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.Cum sociis natoque penatibus.
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="about-quote">
                                Taking your business to the next level is what inspires us to get up each morning and make our service better.<span>~Mike Long (CEO)</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="about-content">
                                Uenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.Cum sociis natoque penatibus. Uenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.Cum sociis natoque penatibus.
                            </div>
                        </div>   
                    </div>
                </div> 
            </div>    
        </div>    
     </section>
<?php } ?> 