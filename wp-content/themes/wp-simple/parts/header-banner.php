

<?php if (is_front_page() && !is_paged())  { ?>
    <?php  $section_bg=nimbus_get_option('fp-banner-background-image');
    if (!empty($section_bg['url'])) {
        $nimbus_parallax="data-parallax='scroll' data-image-src='" . $section_bg['url'] . "' style='background: rgba(0, 0, 0, 0.3);'";
        $parallax_active="parallax_active";
    } ?>
    <?php if (nimbus_get_option('fp-banner-toggle') == '1') { ?>
        <section class="frontpage-banner <?php if(isset($parallax_active)){echo $parallax_active;} ?>" <?php if(isset($nimbus_parallax)){echo $nimbus_parallax;} ?>>
            <div class="container">
                <div class="banner-wrap" data-sr='wait 0.4s, scale up 25%'>
                    <?php if (nimbus_get_option('fp-banner-title') != '') { ?>
                        <div class="banner-title"><?php echo nimbus_get_option('fp-banner-title'); ?></div>
                    <?php } ?>
                    <?php if (nimbus_get_option('fp-banner-sub-title') != '') { ?>
                        <div class="banner-sub-title"><?php echo nimbus_get_option('fp-banner-sub-title'); ?></div>
                    <?php } ?>
                    <?php if (nimbus_get_option('fp-banner-button-url') != '') { ?>
                        <div class="banner-link-button"><a href="<?php echo nimbus_get_option('fp-banner-button-url'); ?>"><?php echo nimbus_get_option('fp-banner-button-text'); ?></a></div>
                    <?php } ?>
                </div>      
            </div>    
        </section>  
    <?php } else if (nimbus_get_option('fp-banner-toggle') == '3') { ?>
        <section class="frontpage-banner <?php if(isset($parallax_active)){echo $parallax_active;} ?>"  <?php if(isset($nimbus_parallax)){echo $nimbus_parallax;} ?>>
            <div class="container">
                <div class="banner-wrap" data-sr='wait 0.4s, scale up 25%'>
                    <div class="banner-title">Slideshow</div>
                    <div class="banner-sub-title">This feature is availible to PRO theme users.</div>
                    <div class="banner-link-button"><a href="#">Learn More</a></div> 
                </div>    
            </div>    
        </section> 
    <?php } else { ?>     
        <section class="frontpage-banner parallax_active" data-parallax='scroll' data-image-src='<?php echo get_template_directory_uri(); ?>/images/preview/deer.jpg' style='background: transparent;background: rgba(0, 0, 0, 0.3);'>
            <div class="container">
                <div class="banner-wrap" data-sr='wait 0.9s, scale up 25%'>
                    <div class="banner-title">Simple</div>
                    <div class="banner-sub-title">A Business Wordpress Theme</div>
                    <div class="banner-link-button"><a href="http://www.nimbusthemes.com/free/simple/">Learn More</a></div>
                </div>    
            </div>    
        </section> 
    <?php } ?> 
<?php } else { ?> 
    <?php  $section_bg=nimbus_get_option('sub-banner-background-image');
    if (!empty($section_bg['url'])) {
        $nimbus_parallax="data-parallax='scroll' data-image-src='" . $section_bg['url'] . "' style='background: rgba(0, 0, 0, 0.3);'";
        $parallax_active="parallax_active";
    } ?>
    <?php if (nimbus_get_option('sub-banner-toggle') == '1') { ?>
        <section class="subpage-banner <?php if(isset($parallax_active)){echo $parallax_active;} ?>"  <?php if(isset($nimbus_parallax)){echo $nimbus_parallax;} ?>>
            <div class="container">
                <div class="banner-wrap" data-sr='wait 0.4s, scale up 25%'>
                    <h1 class="banner-title"><?php get_template_part( 'parts/title'); ?></h1>
                </div>    
            </div>    
        </section> 
    <?php } else { ?>     
        <section class="subpage-banner parallax_active" data-parallax='scroll' data-image-src='<?php echo get_template_directory_uri(); ?>/images/preview/deer.jpg' style='background: transparent;background: rgba(0, 0, 0, 0.3);'>
            <div class="container">
                <div class="banner-wrap" data-sr='wait 0.9s, scale up 25%'>
                    <h1 class="banner-title"><?php get_template_part( 'parts/title'); ?></h1>
                </div>    
            </div>    
        </section> 
    <?php } ?> 
<?php } ?>