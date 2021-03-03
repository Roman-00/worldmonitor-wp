<?php
/**
 * worldmonitor functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package worldmonitor
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'worldmonitor_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function worldmonitor_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on worldmonitor, use a find and replace
		 * to change 'worldmonitor' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'worldmonitor', get_template_directory() . '/languages' );

        // Удаляем роль при деактивации нашей темы
        add_action('switch_theme', 'deactivate_worldmonitor_theme');
        function deactivate_worldmonitor_theme() {
            remove_role('developer');
            remove_role('editor_in_chief');
            remove_role('admin');
        }

        // Добавляем роль при активации нашей темы
        add_action('after_switch_theme', 'activate_worldmonitor_theme');
        function activate_worldmonitor_theme() {
            // Получим объект данных роли "Автор"
            $author = get_role( 'author' );
            add_role( 'developer', 'Разработчик', $author->capabilities);
            add_role( 'editor_in_chief', 'Главный редактор',
                [
                    'read'         => true,  // true разрешает эту возможность
                    'edit_posts'   => true,  // true разрешает редактировать посты
                    'upload_files' => true,  // может загружать файлы
                    'delete_posts' => false,
                ]);
            add_role( 'admin', 'Администратор',
                [
                    'read'         => true,  // true разрешает эту возможность
                    'edit_posts'   => true,  // true разрешает редактировать посты
                    'upload_files' => true,  // может загружать файлы
                    'delete_posts' => true,  // может удалять посты
                ]);
        }

        // Динамический вывод title
        add_theme_support('title-tag');

        // Добавляем возможность делать миниатюры изобраджений для статей
        add_theme_support('post-thumbnails', array('post'));

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

        // Добавление пользовательского лого динамически
        add_theme_support( 'custom-logo', [
            'width'       => 350,
            'flex-height' => true,
            'header-text' => 'WorldMonitor',
            'unlink-homepage-logo' => false, // WP 5.5
        ] );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( [
            'header_menu' => __('Header menu', 'worldmonitor'),
            'footer_menu' => __('Footer menu', 'worldmonitor'),
        ]);
        // регистрация нового типа записей
        add_action( 'init', 'register_post_types' );
        function register_post_types(){
            register_post_type( 'magazine', [
                'label'  => null,
                'labels' => [
                    'name'               => __( 'Magazine', 'universal' ), // основное название для типа записи
                    'singular_name'      => __( 'Magazine', 'universal' ), // название для одной записи этого типа
                    'add_new'            => __( 'Add magazine', 'universal' ), // для добавления новой записи
                    'add_new_item'       => __( 'Add new magazine', 'universal' ), // заголовка у вновь создаваемой записи в админ-панели.
                    'edit_item'          => __( 'Edit magazine', 'universal' ), // для редактирования типа записи
                    'new_item'           => __( 'New magazine', 'universal' ), // текст новой записи
                    'view_item'          => __( 'View magazine', 'universal' ), // для просмотра записи этого типа.
                    'search_items'       => __( 'Search magazine', 'universal' ), // для поиска по этим типам записи
                    'not_found'          => __( 'Not found', 'worldmonitor' ), // если в результате поиска ничего не было найдено
                    'not_found_in_trash' => __( 'Not found in trash', 'worldmonitor' ), // если не было найдено в корзине
                    'parent_item_colon'  => '', // для родителей (у древовидных типов)
                    'menu_name'          => __( 'Magazine', 'worldmonitor' ), // название меню
                ],
                'description'         => __( 'Part with Magazine', 'worldmonitor' ),
                'public'              => true,
                'show_admin_column'   => true,
                // 'publicly_queryable'  => null, // зависит от public
                // 'exclude_from_search' => null, // зависит от public
                // 'show_ui'             => null, // зависит от public
                // 'show_in_nav_menus'   => null, // зависит от public
                'show_in_menu'        => true, // показывать ли в меню адмнки
                // 'show_in_admin_bar'   => null, // зависит от show_in_menu
                'show_in_rest'        => true, // добавить в REST API. C WP 4.7
                'rest_base'           => null, // $post_type. C WP 4.7
                'menu_position'       => 5,
                'menu_icon'           => 'dashicons-media-interactive',
                'capability_type'   => 'post',
                //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
                //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
                'hierarchical'        => false,
                'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'custom-fields', 'author' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
                'taxonomies'          => [],
                'has_archive'         => true,
                'rewrite'             => true,
                'query_var'           => true,
            ] );
        }

        // хук, через который подключается функция
        // регистрирующая новые таксономии (create_book_taxonomies)
        add_action( 'init', 'create_magazine_taxonomies' );

        // функция, создающая 2 новые таксономии "genres" и "writers" для постов типа "book"
        function create_magazine_taxonomies(){

            // Добавляем древовидную таксономию 'genre' (как категории)
            register_taxonomy('type', array('magazine'), array(
                'hierarchical'  => true,
                'labels'        => array(
                    'name'              => _x( 'Type', 'taxonomy general name', 'worldmonitor' ),
                    'singular_name'     => _x( 'Type', 'taxonomy singular name', 'worldmonitor' ),
                    'search_items'      =>  __( 'Search Type', 'worldmonitor' ),
                    'all_items'         => __( 'All Type', 'worldmonitor' ),
                    'parent_item'       => __( 'Parent Type', 'worldmonitor' ),
                    'parent_item_colon' => __( 'Parent Type:', 'worldmonitor' ),
                    'edit_item'         => __( 'Edit Type', 'worldmonitor' ),
                    'update_item'       => __( 'Update Type', 'worldmonitor' ),
                    'add_new_item'      => __( 'Add New Type', 'worldmonitor' ),
                    'new_item_name'     => __( 'New Type Name', 'worldmonitor' ),
                    'menu_name'         => __( 'Type', 'worldmonitor' ),
                ),
                // показывать ли это в меню
                'show_ui'       => true,
                'query_var'     => true,
                'rewrite'       => array( 'slug' => 'type' ), // свой слаг в URL
                'show_admin_column' => true,
            ));

            // Добавляем НЕ древовидную таксономию 'writer' (как метки)
            register_taxonomy('teacher', 'magazine',array(
                'hierarchical'  => false,
                'labels'        => array(
                    'name'                        => _x( 'Teacher', 'taxonomy general name', 'worldmonitor' ),
                    'singular_name'               => _x( 'Teacher', 'taxonomy singular name', 'worldmonitor' ),
                    'search_items'                =>  __( 'Search Teachers', 'worldmonitor' ),
                    'popular_items'               => __( 'Popular Teachers', 'worldmonitor' ),
                    'all_items'                   => __( 'All Teachers', 'worldmonitor' ),
                    'parent_item'                 => null,
                    'parent_item_colon'           => null,
                    'edit_item'                   => __( 'Edit Teacher', 'worldmonitor' ),
                    'update_item'                 => __( 'Update Teacher', 'worldmonitor' ),
                    'add_new_item'                => __( 'Add New Teacher', 'worldmonitor' ),
                    'new_item_name'               => __( 'New Teacher Name', 'worldmonitor' ),
                    'separate_items_with_commas'  => __( 'Separate Teacher with commas', 'worldmonitor' ),
                    'add_or_remove_items'         => __( 'Add or remove teacher', 'worldmonitor' ),
                    'choose_from_most_used'       => __( 'Choose from the most used teachers', 'worldmonitor' ),
                    'menu_name'                   => __( 'Teachers', 'worldmonitor' ),
                ),
                'show_ui'       => true,
                'query_var'     => true,
                'rewrite'       => array( 'slug' => 'teacher' ), // свой слаг в URL
                'show_admin_column' => true,
            ));
            // Добавляем древовидную таксономию 'genre' (как категории)
        }
	}
endif;
add_action( 'after_setup_theme', 'worldmonitor_setup' );

/**
 * Ставьте скрипты и стили в очередь. Подключение скриптов!
 */
function worldmonitor_scripts() {
	wp_enqueue_style( 'worldmonitor-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'worldmonitor-awesome', get_template_directory_uri() . '/assets/plugin/fontAwesome/all.css');
    wp_enqueue_style( 'worldmonitor-swiper', get_template_directory_uri() . '/assets/plugin/swiper/swiper-bundle.min.css');
    wp_enqueue_style( 'worldmonitor-theme', get_template_directory_uri() . '/assets/css/style.css');

    wp_deregister_script( 'jquery-core' );
    wp_register_script( 'jquery-core', '//code.jquery.com/jquery-3.5.1.min.js');
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/plugin/swiper/swiper-bundle.min.js', null, true);
    wp_enqueue_script( 'fontAwesome', get_template_directory_uri() . '/assets/plugin/fontAwesome/all.js', null, true);
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/main.js', 'swiper', true);
}
add_action( 'wp_enqueue_scripts', 'worldmonitor_scripts' );

## фильтр для облака тэгов, изменяем настройки облака тэгов
add_filter( 'widget_tag_cloud_args', 'edit_widget_tag_cloud_args');
function edit_widget_tag_cloud_args($args) {
    $args['unit'] = 'px';
    $args['smallest'] = '14';
    $args['largest'] = '14';
    $args['number'] = '11';
    // сортировка по кол-ву повторений тега
    $args['orderby'] = 'count';
    return $args;
}

## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
    // размеры которые нужно удалить
    return array_diff( $sizes, [
        'medium_large',
        'large',
        '1536x1536',
        '2048x2048',
    ] );
}

// меняем стиль многоточие в отрывках
add_filter('excerpt_more', function($more) {
    return '...';
});

// склоняем слова после числительных
function plural_form($number, $after) {
    $cases = array (2, 0, 1, 1, 1, 2);
    echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Подключаем зоны для сайтбара
 */

require get_template_directory() . '/inc/widget_zone.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * "Хлебные крошки" для WordPress
 * автор: Dimox
 * версия: 2019.03.03
 * лицензия: MIT
 */

require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

