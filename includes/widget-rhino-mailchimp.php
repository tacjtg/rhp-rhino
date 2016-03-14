<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Create Custom MailChimp Email Widget.
 *
 * @since  	1.0.2
 * @package Rhino
 * @author 	Rockhouse
 */

class rhino_email_widget extends WP_Widget {

	// Constructor
    public function __construct( $id_base = false, $name = 'Rhino: Email Widget', $widget_options = array(), $control_options = array() ) {

		$name = __('Rhino: Email Widget', 'rhino');
        parent::__construct( $id_base, $name, $widget_options, $control_options );

    }

	// widget form creation
	function form($instance) {

	// Check values
	if( $instance) {

	     $title = esc_attr($instance['title']);
	     $text = esc_attr($instance['text']);
	     $textarea = esc_textarea($instance['textarea']);
	     $fields = esc_textarea($instance['fields']);

	} else {

	     $title = '';
	     $text = '';
	     $textarea = '';
		 $fields = '';

	} ?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Header:', 'rhino'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Details:', 'rhino'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
	</p>

	<div class="rhino-email-subscribe-form">
		<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Mailchimp Subscribe URL:', 'rhino'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
	</div>

	<p>
		You can alternatively past the entire <a href="http://kb.mailchimp.com/lists/signup-forms/add-a-signup-form-to-your-website" target="_blank">Mailchimp Embedded Form Code</a> in this box and it will extract the Form URL.
	</p>

	<div class="rhino-email-form-fields">
		<label for="<?php echo $this->get_field_id('fields'); ?>"><?php _e('Extra Form Fields:', 'rhino'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('fields'); ?>" name="<?php echo $this->get_field_name('fields'); ?>"><?php echo $fields; ?></textarea>
	</div>

	<p>
		This is for any custom Groups or Fields that have been configured in Mailchimp and normally left blank. Use with caution.
	</p>

	<?php }

	// Update Widget
	function update($new_instance, $old_instance) {

	    $instance = $old_instance;

		if( substr($new_instance['textarea'],0,4) !== 'http' ) {
			$matches = array();
			preg_match('/action="([^"]+)"/',$new_instance['textarea'],$matches);
			$new_instance['textarea'] = ( count($matches) > 1 ) ? 'https:' . $matches[1] : '';
		}

	    // Fields
	    $instance['title'] = strip_tags($new_instance['title']);
	    $instance['text'] = strip_tags($new_instance['text']);
	    if ( current_user_can('unfiltered_html') ) {
			$instance['textarea'] =  $new_instance['textarea'];
			$instance['fields'] =  $new_instance['fields'];
		} else {
			$instance['textarea'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['textarea']) ) ); // wp_filter_post_kses() expects slashed
			$instance['fields'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['fields']) ) );
		}

	    return $instance;

	}

	// Display Widget
	function widget($args, $instance) {

	   extract( $args );

	   // Widget Options
	   $title = apply_filters('widget_title', $instance['title']);
	   $text = $instance['text'];
	   $textarea = $instance['textarea'];
	   $fields = $instance['fields'];

	   echo $before_widget;

	   // Display the widget
	   echo '<div class="widget-text rhino-email-widget col-full">';

	   // Check if title is set
	   if ( $title ) {

	      echo $before_title . $title . $after_title;

	   }

	   // Check if text is set
	   if( $text ) {

	      echo '<p class="rhino-email-details">'.$text.'</p>';

	   }

	   // Check if textarea is set
	   if( $textarea ) {

		   echo <<<HTML
<p class="rhino-email-embed">
	<!-- Begin MailChimp Signup Form -->
	<div id="mc_embed_signup">
		<form action="{$textarea}" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			<div id="mc_embed_signup_scroll">
				<div class="mc-field-group">
					<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address">
					{$fields}
					<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button primary medium subscribe">
					<div class="clear"></div>
				</div>
			</div>
		</form>
	</div><!--End mc_embed_signup-->
</p>
HTML;
	   }

	   echo '</div>';

	   echo $after_widget;

	}

	public static function register() {
		register_widget( __CLASS__ );
	}

}

// register widget
add_action('widgets_init', array('rhino_email_widget','register') );
