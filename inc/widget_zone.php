<?

/// подключение сайдбара
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function worldmonitor_theme_widgets_init() {
    // ф-ия регистрирует зоны под виджеты
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar in front page', 'worldmonitor' ),
            'id'            => 'main-sidebar',
            'description'   => esc_html__( 'Add widget here', 'worldmonitor' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    // ф-ия регистрирует зоны под виджеты
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar in detail page bottom', 'worldmonitor' ),
            'id'            => 'page-sidebar-bottom',
            'description'   => esc_html__( 'Add widget here', 'worldmonitor' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    // ф-ия регистрирует зоны под виджеты
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar with top', 'worldmonitor' ),
            'id'            => 'top-sidebar',
            'description'   => esc_html__( 'Add widget here', 'worldmonitor' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    // ф-ия регистрирует зоны под виджеты
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer menu', 'worldmonitor' ),
            'id'            => 'sidebar-footer',
            'description'   => esc_html__( 'Add widget here', 'worldmonitor' ),
            'before_widget' => '<section id="%1$s" class="footer-menu %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="footer-menu-title">',
            'after_title'   => '</h2>',
        )
    );
    // ф-ия регистрирует зоны под виджеты
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer text', 'worldmonitor' ),
            'id'            => 'sidebar-footer-text',
            'description'   => esc_html__( 'Add widget here', 'worldmonitor' ),
            'before_widget' => '<section id="%1$s" class="footer-text %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '',
            'after_title'   => '',
        )
    );
    // ф-ия регистрирует зоны под виджеты
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar content page', 'worldmonitor' ),
            'id'            => 'page-sidebar',
            'description'   => esc_html__( 'Add widget here', 'worldmonitor' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '',
            'after_title'   => '',
        )
    );
}
add_action( 'widgets_init', 'worldmonitor_theme_widgets_init' );

?>