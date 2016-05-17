<?php
class EventsManager_widget extends WP_Widget {
     
  // widget constructor
  public function __construct(){
     parent::__construct(
    // Base ID of your widget
    'em_widget', 

    // Widget name will appear in UI
    __('Events manager', 'my-em'), 

    // Widget description
    array( 'description' => __( 'Sample widget display posts from events category', 'my-em' ) ) 
    );
  }
    
  public function widget( $args, $instance ) {
    // outputs the content of the widget
    extract( $args );
     
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $count_posts = empty($instance['count_posts']) ? '' : $instance['count_posts'];
     
    echo $before_widget;
     
    if ( $title ) {
        echo $before_title . $title . $after_title;
    }
     
    $this->show_posts($instance['count_posts']);

    echo $after_widget;
  }
  
  function show_posts($number_to_show){

    ?>
    <ul>
    <?php
        global $post;
        $args = array( 'posts_per_page' => $number_to_show, 'post_type'=> 'events');
        $myposts = get_posts( $args );
        foreach( $myposts as $post ){ setup_postdata($post);
        ?>
          <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php
        }
        wp_reset_postdata();
    ?>
    </ul>

  <?php
  }

  public function form( $instance ) {
    // creates the back-end form
    $title = ( !empty( $instance['title'] ) ) ? $instance['title'] : '';
    $count_posts = ( !empty( $instance['count_posts'] ) ) ? $instance['count_posts'] : 'post_count';

    ?>
    <p>
        <label for="<?php echo $this->get_field_name( 'title' ); ?>">Title: </label>
        <input class='widefat' id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>


    <select  class='widefat' id="<?php echo $this->get_field_id('count_posts'); ?>"
                name="<?php echo $this->get_field_name('count_posts'); ?>" type="text">
    <?php

    $count = 1;

    while($count < 4){
      ?>
          <option value="<?php echo $count; ?>"<?php echo ($count_posts==$count)?'selected':''; ?>>
            <?php echo $count; ?>
          </option>
      <?php
      $count++;
    }
    ?>
    </select>
    <?php
  }
    
  // Updating widget replacing old instances with new
  public function update( $new_instance, $old_instance ) {
    // processes widget options on save
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['count_posts'] = $new_instance['count_posts'];
    return $instance;
  }
   
}


add_action( 'widgets_init', function(){
     register_widget( 'EventsManager_widget' );
});

?>