<?php

/**
 * Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 * via http://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets
 */
function widget_first_last_classes($params) {

	
	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'widget-first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'widget-last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}
add_filter('dynamic_sidebar_params','widget_first_last_classes');


$cartogram_theme_name = "landmark";




/*///////////////////////////////////////////////////////////////////// 
//  Recent Posts
/////////////////////////////////////////////////////////////////////*/

class TTrust_Recent_Posts extends WP_Widget {

	function TTrust_Recent_Posts() {
		global $cartogram_theme_name, $ttrust_version, $options;
		$widget_ops = array('classname' => 'ttrust_recent_posts', 'description' => __('Display recent posts from any category.', 'cartogram'));
		$this->WP_Widget('ttrust_recent_posts', $cartogram_theme_name.' '.__('Recent Posts', 'cartogram'), $widget_ops);
	}

	function widget($args, $instance) {
	
		global $cartogram_theme_name, $options;
	
		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 10 )
			$number = 10;
			
		$rp_cat = $instance['rp_cat'];			 

		$r = new WP_Query(array('cat' => $rp_cat, 'showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
		if ($r->have_posts()) :
?>				
			<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>			
		
			<ul class="widgetList">
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
				<li class="clearfix">
					<?php if(has_post_thumbnail()) : ?>
						<a class="thumb" href="<?php the_permalink() ?>" rel="bookmark" ><?php the_post_thumbnail('ttrust_post_thumb_tiny', array('class' => 'postThumb', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?></a>					
					<?php endif; ?>
					<p class="title"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a></p>
					<span class="meta"><?php the_time(get_option('date_format')); ?> </span>
				</li>
				<?php endwhile; ?>
			</ul>
				
			<?php echo $after_widget; ?>
		
		
<?php
			wp_reset_query();  
		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['rp_cat'] = $new_instance['rp_cat'];		

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Recent Posts';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
			
		if (isset($instance['rp_cat'])) :	
			$rp_cat = $instance['rp_cat'];
		endif;
		
		
		if (isset($instance['show_post'])) :	
			$show_post = $instance['show_post'];
		endif;
		

		$pn_categories_obj = get_categories('hide_empty=0');
		$pn_categories = array(); ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'cartogram'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('rp_cat'); ?>"><?php _e('Category', 'cartogram'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('rp_cat'); ?>" name="<?php echo $this->get_field_name('rp_cat'); ?>">
			<option value=""><?php _e('All', 'cartogram'); ?></option>
			<?php foreach ($pn_categories_obj as $pn_cat) {				
				echo '<option value="'.$pn_cat->cat_ID.'" '.selected($pn_cat->cat_ID, $rp_cat).'>'.$pn_cat->cat_name.'</option>';
			} ?>
		</select></p>	

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:', 'cartogram'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e('10 max', 'cartogram'); ?></small></p>
<?php
	}
}

register_widget('TTrust_Recent_Posts');


/*///////////////////////////////////////////////////////////////////// 
//  Twitter
/////////////////////////////////////////////////////////////////////*/


class TTrust_Twitter extends WP_Widget {
 
	function TTrust_Twitter() {
	
		global $cartogram_theme_name, $ttrust_version, $options;
		
        $widget_ops = array('classname' => 'widget_ttrust_twitter', 'description' => 'Display latest tweets.');
		$this->WP_Widget('ttrust_twitter', $cartogram_theme_name.' '.__('Twitter', 'cartogram'), $widget_ops);
    
    }
 
    function widget($args, $instance) {
    
    	global $cartogram_theme_name, $ttrust_version, $options;
       
        extract( $args );
        
        $title	= empty($instance['title']) ? 'Latest Tweets' : $instance['title'];
        $user	= $instance['user'];        
        $label	= empty($instance['twitter_label']) ? 'Follow' : $instance['twitter_label'];
        if ( !$nr = (int) $instance['twitter_count'] )
			$nr = 5;
		else if ( $nr < 1 )
			$nr = 1;
		else if ( $nr > 15 )
			$nr = 15;
 
        ?>
			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
								
				<div id="twitterBox" class="clearfix"></div>

    			<script type="text/javascript">
 					//<![CDATA[
					jQuery(document).ready(function() {
						jQuery("#twitterBox").getTwitter({
							userName: '<?php echo $user; ?>',
							numTweets: '<?php echo $nr; ?>',
							loaderText: "Loading tweets...",
							slideIn: false,
							showHeading: false,
							headingText: "",
							showProfileLink: false
						});
					});
					//]]>    			
    			</script>				
				
				<?php if($label) : ?>
                <p class="twitterLink"><a target="_blank" class="action" href="http://twitter.com/<?php echo $user; ?>"><span><?php echo $label; ?></span></a></p>
                <?php endif; ?>
 
			<?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {  
    
    	$instance['title'] = strip_tags($new_instance['title']);
    	$instance['user'] = strip_tags($new_instance['user']);    
    	$instance['twitter_label'] = strip_tags($new_instance['twitter_label']);
    	$instance['twitter_count'] = (int) $new_instance['twitter_count'];
                  
        return $new_instance;
    }
 
    function form($instance) {
    
    	global $cartogram_theme_name, $ttrust_version, $options;
        
		$instance	= wp_parse_args( (array) $instance, array( 'title' => '', 'user' => '', 'twitter_link' => '', 'twitter_label' => '', 'twitter_count' => '') );
		$title		= empty($instance['title']) ? 'Latest Tweets' : $instance['title'];
		$user		= $instance['user'];		
		$label		= $instance['twitter_label'];
		if (!$count = (int) $instance['twitter_count']) $count = 5;
?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'cartogram'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Username:', 'cartogram'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo esc_attr($user); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_count'); ?>"><?php _e('Number of tweets:', 'cartogram'); ?></label>
			<input id="<?php echo $this->get_field_id('twitter_count'); ?>" name="<?php echo $this->get_field_name('twitter_count'); ?>" type="text" value="<?php echo $count; ?>" size="3" /><br />
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_label'); ?>"><?php _e('Follow Link label:', 'cartogram'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_label'); ?>" name="<?php echo $this->get_field_name('twitter_label'); ?>" type="text" value="<?php echo esc_attr($label); ?>" />
			</label>
		</p>
		
<?php
	}

}
 
register_widget('TTrust_Twitter');



/*///////////////////////////////////////////////////////////////////// 
//  Flickr
/////////////////////////////////////////////////////////////////////*/

class TTrust_Flickr extends WP_Widget {
 
	function TTrust_Flickr() {
		global $cartogram_theme_name, $ttrust_version, $options;
        $widget_ops = array('classname' => 'widget_ttrust_flickr', 'description' => 'Display flickr photos.');
		$this->WP_Widget('ttrust_flickr', $cartogram_theme_name.' '.__('Flickr', 'cartogram'), $widget_ops);
    
    }
 
    function widget($args, $instance) {
    
    	global $options;
        
        extract( $args );
        
        $title	= empty($instance['title']) ? 'Flickr' : apply_filters('widget_title', $instance['title']);
        $user	=  $instance['user'];
        
        if ( !$nr = (int) $instance['flickr_nr'] )
			$nr = 6;
		else if ( $nr < 1 )
			$nr = 3;
		else if ( $nr > 15 )
			$nr = 15;
 
        ?>
			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
				
    			<div id="flickrBox" class="clearfix"></div>

    			<script type="text/javascript">
 					//<![CDATA[
					jQuery(document).ready(function($){    			
    					$('#flickrBox').jflickrfeed({
							limit: <?php echo $nr; ?>,
							qstrings: {
								id: '<?php echo $user; ?>'
							},
							itemTemplate:
							'<div class="flickrImage">' +
								'<a href="{{link}}" title="{{title}}">' +
									'<img src="{{image_s}}" alt="{{title}}" />' +
								'</a>' +
							'</div>'
						});
					});
					//]]>    			
    			</script>
 
			<?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {  
    
    	$instance['title'] = strip_tags($new_instance['title']);
    	$instance['user'] = strip_tags($new_instance['user']);
    	$instance['flickr_nr'] = (int) $new_instance['flickr_nr'];
                  
        return $new_instance;
    }
 
    function form($instance) {
    
    	global $options;
        
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'user' => '', 'flickr_nr' => '') );
		$title = strip_tags($instance['title']);
		$user = $instance['user'];
		if (!$nr = (int) $instance['flickr_nr']) $nr = 6;
?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'cartogram'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Flickr ID:', 'cartogram'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo esc_attr($user); ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('flickr_nr'); ?>"><?php _e('Number of photos:', 'cartogram'); ?></label>
			<input id="<?php echo $this->get_field_id('flickr_nr'); ?>" name="<?php echo $this->get_field_name('flickr_nr'); ?>" type="text" value="<?php echo $nr; ?>" size="3" /><br />
			<small><?php _e('(15 max)'); ?></small>
		</p>
		
<?php
	}

}
 
register_widget('TTrust_Flickr');
?>