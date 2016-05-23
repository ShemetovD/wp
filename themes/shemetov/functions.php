<?php

function shemetov_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'shemetov' ),
        'id'            => 'sidebar-main',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );

}
add_action( 'widgets_init', 'shemetov_widgets_init' );


add_action( 'after_setup_theme', 'register_temp_menu' );
function register_temp_menu() {
  register_nav_menu( 'primary', __( 'Temp Menu', 'theme-slug' ) );
}


?>