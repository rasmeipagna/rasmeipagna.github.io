<?php


// #################################################
// About Row Content Widget
// #################################################

class nimbus_about_content_widget extends WP_Widget {
    
    // Register widget
    function __construct() {
        parent::__construct(
          'nimbus-about-content-widget', // Base ID
          'Nimbus - About Content Widget', // Name
          array( 'description' => __('Display about content boxes on the frontpage', 'nimbus' ))  // Description
        );
    }
    
    // Create output function
    public function widget($args, $instance) {
		echo $args['before_widget'];
		?>
            <div class="about-content">
                <?php if ( ! empty( $instance['content'] ) ) { 
                    echo $instance['content']; 
                } ?>
            </div>  
		<?php
		echo $args['after_widget'];
    }  
    
    // Create widget form
	public function form( $instance ) {
		$content = ! empty( $instance['content'] ) ? $instance['content'] : __( '', 'nimbus' );
		?>
		<p>
			<textarea id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" rows="4" cols="50"><?php echo esc_attr( $content ); ?></textarea>
		</p>
		<?php 
	}
    
    // Save stuff
    public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['content'] = ( ! empty( $new_instance['content'] ) ) ? strip_tags( $new_instance['content'] ) : '';
		return $instance;
	}
        
}

// Register about row content widget
function register_nimbus_about_content_widget() {
    register_widget( 'nimbus_about_content_widget' );
}
add_action( 'widgets_init', 'register_nimbus_about_content_widget' );



// #################################################
// About Row Quote Widget
// #################################################

class nimbus_about_quote_widget extends WP_Widget {
    
    // Register widget
    function __construct() {
        parent::__construct(
          'nimbus-about-quote-widget', // Base ID
          'Nimbus - About Quote Widget', // Name
          array( 'description' => __('Display quote boxes on the frontpage', 'nimbus' ))  // Description
        );
    }
    
    // Create output function
    public function widget($args, $instance) {
		echo $args['before_widget'];
		?>
            <div class="about-quote">
                <?php if ( ! empty( $instance['quote'] ) ) { 
                    echo $instance['quote'] ."<span>~" . $instance['tag'] ."</span>"; 
                } ?>
            </div>  
		<?php
		echo $args['after_widget'];
    }  
    
    // Create widget form
	public function form( $instance ) {
		$quote = ! empty( $instance['quote'] ) ? $instance['quote'] : __( '', 'nimbus' );
		$tag = ! empty( $instance['tag'] ) ? $instance['tag'] : __( '', 'nimbus' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'quote' ); ?>"><?php _e( 'Quote:', 'nimbus' ); ?></label> 
			<textarea id="<?php echo $this->get_field_id( 'quote' ); ?>" name="<?php echo $this->get_field_name( 'quote' ); ?>" rows="4" cols="50"><?php echo esc_attr( $quote ); ?></textarea>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'tag' ); ?>"><?php _e( 'Name:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'tag' ); ?>" name="<?php echo $this->get_field_name( 'tag' ); ?>" type="text" value="<?php echo esc_attr( $tag ); ?>">
		</p>
		<?php 
	}
    
    // Save stuff
    public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['quote'] = ( ! empty( $new_instance['quote'] ) ) ? strip_tags( $new_instance['quote'] ) : '';
		$instance['tag'] = ( ! empty( $new_instance['tag'] ) ) ? strip_tags( $new_instance['tag'] ) : '';
		return $instance;
	}
        
}

// Register about row content widget
function register_nimbus_about_quote_widget() {
    register_widget( 'nimbus_about_quote_widget' );
}
add_action( 'widgets_init', 'register_nimbus_about_quote_widget' );



// #################################################
// Team Row Content Widget
// #################################################

class nimbus_team_content_widget extends WP_Widget {
    
    // Register widget
    function __construct() {
        parent::__construct(
          'nimbus-team-content-widget', // Base ID
          'Nimbus - Team Content Widget', // Name
          array( 'description' => __('Display team content boxes on the frontpage', 'nimbus' )) // Description
        );
    }
    
    // Create output function
    public function widget($args, $instance) {
		echo $args['before_widget'];
		?>
		    <h4 class="team-item-title">
                <?php if ( ! empty( $instance['name'] ) ) { 
                    echo $instance['name']; 
                } ?>            	
            </h4>
            <img class="img-responsive center-block" src="<?php if ( ! empty( $instance['imgurl184sq'] ) ) { echo $instance['imgurl184sq']; } ?>" />

            <h5 class="team-item-sub-title">
                <?php if ( ! empty( $instance['title'] ) ) { 
                    echo $instance['title']; 
                } ?> 
            </h5>
            <p class="team-social-icons">
            	<?php if (!empty( $instance['social1']) && !empty( $instance['faclass1'])) { ?>
            		<a href="<?php echo $instance['social1']; ?>"><i class="fa <?php echo $instance['faclass1']; ?>"></i></a>
            	<?php } ?>
            	<?php if (!empty( $instance['social2']) && !empty( $instance['faclass2'])) { ?>
            		<a href="<?php echo $instance['social2']; ?>"><i class="fa <?php echo $instance['faclass2']; ?>"></i></a>
            	<?php } ?>
            	<?php if (!empty( $instance['social3']) && !empty( $instance['faclass3'])) { ?>
            		<a href="<?php echo $instance['social3']; ?>"><i class="fa <?php echo $instance['faclass3']; ?>"></i></a>
            	<?php } ?>
            </p>  
		<?php
		echo $args['after_widget'];
    }  
    
    // Create widget form
	public function form( $instance ) {
		$imgurl184sq = ! empty( $instance['imgurl184sq'] ) ? $instance['imgurl184sq'] : __( '', 'nimbus' );
		$name = ! empty( $instance['name'] ) ? $instance['name'] : __( '', 'nimbus' );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'nimbus' );
		$social1 = ! empty( $instance['social1'] ) ? $instance['social1'] : __( '', 'nimbus' );
		$faclass1 = ! empty( $instance['faclass1'] ) ? $instance['faclass1'] : __( '', 'nimbus' );
		$social2 = ! empty( $instance['social2'] ) ? $instance['social2'] : __( '', 'nimbus' );
		$faclass2 = ! empty( $instance['faclass2'] ) ? $instance['faclass2'] : __( '', 'nimbus' );
		$social3 = ! empty( $instance['social3'] ) ? $instance['social3'] : __( '', 'nimbus' );
		$faclass3 = ! empty( $instance['faclass3'] ) ? $instance['faclass3'] : __( '', 'nimbus' );
		
		
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'imgurl184sq' ); ?>"><?php _e( 'Headshot Image (262x262px):', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'imgurl184sq' ); ?>" name="<?php echo $this->get_field_name( 'imgurl184sq' ); ?>" type="text" value="<?php echo esc_attr( $imgurl184sq ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'social1' ); ?>"><?php _e( 'Social Media Link #1:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'social1' ); ?>" name="<?php echo $this->get_field_name( 'social1' ); ?>" type="text" value="<?php echo esc_attr( $social1 ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'faclass1' ); ?>"><?php _e( 'FontAwesome Class #1:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'faclass1' ); ?>" name="<?php echo $this->get_field_name( 'faclass1' ); ?>" type="text" value="<?php echo esc_attr( $faclass1 ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'social2' ); ?>"><?php _e( 'Social Media Link #2:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'social2' ); ?>" name="<?php echo $this->get_field_name( 'social2' ); ?>" type="text" value="<?php echo esc_attr( $social2 ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'faclass2' ); ?>"><?php _e( 'FontAwesome Class #2:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'faclass2' ); ?>" name="<?php echo $this->get_field_name( 'faclass2' ); ?>" type="text" value="<?php echo esc_attr( $faclass2 ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'social3' ); ?>"><?php _e( 'Social Media Link #3:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'social3' ); ?>" name="<?php echo $this->get_field_name( 'social3' ); ?>" type="text" value="<?php echo esc_attr( $social3 ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'faclass3' ); ?>"><?php _e( 'FontAwesome Class #3:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'faclass3' ); ?>" name="<?php echo $this->get_field_name( 'faclass3' ); ?>" type="text" value="<?php echo esc_attr( $faclass3 ); ?>">
		</p>


		
		<?php 
	}
    
    // Save stuff
    public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['imgurl184sq'] = ( ! empty( $new_instance['imgurl184sq'] ) ) ? $new_instance['imgurl184sq'] : '';
		$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? $new_instance['name'] : '';
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
		$instance['social1'] = ( ! empty( $new_instance['social1'] ) ) ? $new_instance['social1'] : '';
		$instance['faclass1'] = ( ! empty( $new_instance['faclass1'] ) ) ? $new_instance['faclass1'] : '';
		$instance['social2'] = ( ! empty( $new_instance['social2'] ) ) ? $new_instance['social2'] : '';
		$instance['faclass2'] = ( ! empty( $new_instance['faclass2'] ) ) ? $new_instance['faclass2'] : '';
		$instance['social3'] = ( ! empty( $new_instance['social3'] ) ) ? $new_instance['social3'] : '';
		$instance['faclass3'] = ( ! empty( $new_instance['faclass3'] ) ) ? $new_instance['faclass3'] : '';
		return $instance;
	}
        
}

// Register widget
function register_nimbus_team_content_widget() {
    register_widget( 'nimbus_team_content_widget' );
}
add_action( 'widgets_init', 'register_nimbus_team_content_widget' );





// #################################################
// Social Media Row Content Widget
// #################################################

class nimbus_social_content_widget extends WP_Widget {
    
    // Register widget
    function __construct() {
        parent::__construct(
          'nimbus-social-content-widget', // Base ID
          'Nimbus - Social Media Content Widget', // Name
          array( 'description' => __('Display social content boxes on the frontpage', 'nimbus' ))  // Description
        );
    }
    
    // Create output function
    public function widget($args, $instance) {
		echo $args['before_widget'];
		?>
			<div data-sr="wait 0.2s, scale up 25%">
	            <a href="<?php if ( ! empty( $instance['url'] ) ) { echo $instance['url']; } ?>">
	            	<i class="fa <?php if ( ! empty( $instance['faclass'] ) ) { echo $instance['faclass']; } ?>"></i><br>
	            	<span class="social-item-title h5">
		                <?php if ( ! empty( $instance['title'] ) ) { 
		                    echo $instance['title']; 
		                } ?> 	
	            	</span><br>
	            	<span class="social-item-sub-title h5">
		                <?php if ( ! empty( $instance['sub-title'] ) ) { 
		                    echo $instance['sub-title']; 
		                } ?>
	            	</span>
	            </a>  
            </div>
		<?php
		echo $args['after_widget'];
    }  
    
    // Create widget form
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'nimbus' );
		$sub_title = ! empty( $instance['sub-title'] ) ? $instance['sub-title'] : __( '', 'nimbus' );
		$faclass = ! empty( $instance['faclass'] ) ? $instance['faclass'] : __( 'fa-star', 'nimbus' );
		$url = ! empty( $instance['url'] ) ? $instance['url'] : __( '', 'nimbus' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'sub-title' ); ?>"><?php _e( 'Sub-title:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'sub-title' ); ?>" name="<?php echo $this->get_field_name( 'sub-title' ); ?>" type="text" value="<?php echo esc_attr( $sub_title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'faclass' ); ?>"><?php _e( 'FontAwesome Class:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'faclass' ); ?>" name="<?php echo $this->get_field_name( 'faclass' ); ?>" type="text" value="<?php echo esc_attr( $faclass ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:', 'nimbus' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
		</p>
		<?php 
	}
    
    // Save stuff
    public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['sub-title'] = ( ! empty( $new_instance['sub-title'] ) ) ? $new_instance['sub-title'] : '';
        $instance['faclass'] = ( ! empty( $new_instance['faclass'] ) ) ? $new_instance['faclass'] : '';	
	    $instance['url'] = ( ! empty( $new_instance['url'] ) ) ? $new_instance['url'] : '';
		return $instance;
	}
        
}

// Register widget
function register_nimbus_social_content_widget() {
    register_widget( 'nimbus_social_content_widget' );
}
add_action( 'widgets_init', 'register_nimbus_social_content_widget' );