<?php
	class EventsManager{

		private static $initiated = false;

		public static function init() {
			if ( ! self::$initiated ) {
				self::init_hooks();
			}
		}

		private static function init_hooks() {
			self::$initiated = true;

			add_action( 'add_meta_boxes', array('EventsManager', 'add_events_metaboxes') );
			add_action( 'save_post', array('EventsManager', 'save_events_metaboxes'), 1, 2 );

		}

		public static function activation_hook(){


		}

		public static function deactivation_hook(){


		}

		/**
		 * @name create_post_type
		 * @description Register custom post type
		 * 
		 * @return void
		 */
		public static function create_post_type() {
		    $args = array(
		        'label' => 'Events',
		        'public' => true,
		        'show_ui' => true,
		        'capability_type' => 'post',
		        'hierarchical' => false,
		        'rewrite' => array('slug' => 'events'),
		        'query_var' => true,
		        'menu_icon' => 'dashicons-calendar-alt',
		        'supports' => array(
		            'title',
		            'editor',
		            'excerpt',
		            'trackbacks',
		            'custom-fields',
		            'comments',
		            'revisions',
		            'thumbnail',
		            'author',
		            'page-attributes',),
		        'taxonomies' => array('period')

		        );

   			register_post_type( 'events', $args );
   			
   			// add support for feature image in post
   			add_theme_support( 'post-thumbnails' );

		}


		/**
		 * @name period_taxonomy
		 * @description Register custom taxonomy period
		 * 
		 * @return void
		 */
		public static function period_taxonomy() {
		    register_taxonomy(
		        'period',
		        'events',
		        array(
		            'hierarchical' => true,
		            'label' => 'Period',
		            'query_var' => true,
		            'rewrite' => array(
		                'slug' => 'period',
		                'with_front' => false
		            )
		        )
		    );
		}



		/**
		 * @name event_add_metaboxes
		 * @description Register plugin meta-boxes
		 * @param $post_type
		 * @return void
		 */
		public static function add_events_metaboxes($post_type) {

			//add_meta_box('wpt_events_date', 'Event Date', 'wpt_events_date', 'events', 'side', 'default');

			$post_types = array('events');
			if ( in_array( $post_type, $post_types )) {
				
				add_meta_box('events_location', __( 'Event location', 'my-em' ), array('EventsManager', 'events_location'));
				add_meta_box('events_date', __( 'Event date', 'my-em' ), array('EventsManager', 'events_date'));
				add_meta_box('events_sponsor', __( 'Event sponsor', 'my-em' ), array('EventsManager', 'events_sponsor'));

			}
		}

		/**
		 * @name save_events_metaboxes
		 * @param $post_id
		 *
		 * @return void
		 */
		public static function save_events_metaboxes($post_id){

				if (!isset($_POST["events_management_noncename"]) || !wp_verify_nonce($_POST["events_management_noncename"], plugin_basename(__FILE__)))
			        return $post_id;

			    if(!current_user_can("edit_post", $post_id))
			        return $post_id;

			    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
			        return $post_id;


			    $event_location = "";
			    $event_date = "";
			    $event_sponsor = "";


			    if(isset($_POST["events_management_noncename"]))
			    {
			        $event_location = $_POST["event_location"];
			    }   
			    update_post_meta($post_id, "event_location", $event_location);

			    if(isset($_POST["events_management_noncename"]))
			    {
			        $event_date = $_POST["event_date"];
			    }   
			    update_post_meta($post_id, "event_date", $event_date);

			    if(isset($_POST["events_management_noncename"]))
			    {
			        $event_sponsor = $_POST["event_sponsor"];
			    }   
			    update_post_meta($post_id, "event_sponsor", $event_sponsor);

		}

		/**
		 * @name events_location
		 * @param $post
		 *
		 * @return void
		 */
		public static function events_location($post) {

			wp_nonce_field( plugin_basename(__FILE__), 'events_management_noncename' );
			?>

			<input name="event_location" type="text" value="<?php echo get_post_meta($post->ID, "event_location", true); ?>">

			<?php	

		}


		/**
		 * @name events_place
		 * @param $post
		 *
		 * @return void
		 */
		public static function events_date($post) {

			wp_nonce_field( plugin_basename(__FILE__), 'events_management_noncename' );
			?>

			<input name="event_date" type="text" value="<?php echo get_post_meta($post->ID, "event_date", true); ?>">

			<?php	

		}

		/**
		 * @name events_sponsor
		 * @param $post
		 *
		 * @return void
		 */
		public static function events_sponsor($post) {

			wp_nonce_field( plugin_basename(__FILE__), 'events_management_noncename' );
			?>

			<input name="event_sponsor" type="text" value="<?php echo get_post_meta($post->ID, "event_sponsor", true); ?>">

			<?php	

		}

	}
?>