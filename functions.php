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
        add_theme_support('post-thumbnails', array('post', 'magazine', 'partners'));

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
                    'name'               => __( 'Журнал', 'worldmonitor' ), // основное название для типа записи
                    'singular_name'      => __( 'Журнал', 'worldmonitor' ), // название для одной записи этого типа
                    'add_new'            => __( 'Добавить Журнал', 'worldmonitor' ), // для добавления новой записи
                    'add_new_item'       => __( 'Добавление Журнала', 'worldmonitor' ), // заголовка у вновь создаваемой записи в админ-панели.
                    'edit_item'          => __( 'Редактировать Журнал', 'worldmonitor' ), // для редактирования типа записи
                    'new_item'           => __( 'Новый Журнал', 'worldmonitor' ), // текст новой записи
                    'view_item'          => __( 'Посмотреть Журнал', 'worldmonitor' ), // для просмотра записи этого типа.
                    'search_items'       => __( 'Искать Журнал', 'worldmonitor' ), // для поиска по этим типам записи
                    'not_found'          => __( 'Не найдено', 'worldmonitor' ), // если в результате поиска ничего не было найдено
                    'not_found_in_trash' => __( 'Не найдено в корзине', 'worldmonitor' ), // если не было найдено в корзине
                    'parent_item_colon'  => '', // для родителей (у древовидных типов)
                    'menu_name'          => __( 'Журнал', 'worldmonitor' ), // название меню
                ],
                'description'         => __( 'Part with videolesson', 'worldmonitor' ),
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
                'menu_icon'           => 'dashicons-media-document',
                'capability_type'   => 'post',
                //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
                //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
                'hierarchical'        => false,
                'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'custom-fields', 'author' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
                'taxonomies'          => ['reliase'],
                'has_archive'         => true,
                'rewrite'             => true,
                'query_var'           => true,
            ] );
        }
        // хук для регистрации
        add_action( 'init', 'create_magazine_taxonomy' );
        function create_magazine_taxonomy(){
            register_taxonomy( 'reliase', [ 'magazine' ], [
                'label'                 => '', // определяется параметром $labels->name
                'labels'                => [
                    'name'              => 'Выпуск',
                    'singular_name'     => 'Выпуск',
                    'search_items'      => 'Найти Выпуск',
                    'all_items'         => 'Все Выпуски',
                    'view_item '        => 'Посмотреть Выпуск',
                    'parent_item'       => 'Родительский Выпуск',
                    'parent_item_colon' => 'Родительский Выпуск',
                    'edit_item'         => 'Редактировать Выпуск',
                    'update_item'       => 'Обновить Выпуск',
                    'add_new_item'      => 'Добавить новый Выпуск',
                    'new_item_name'     => 'Выпуск',
                    'menu_name'         => 'Выпуск',
                ],
                'description'           => 'Выпуск Журнала', // описание таксономии
                'public'                => true,
                'publicly_queryable'    => true, // равен аргументу public
                'show_in_nav_menus'     => true, // равен аргументу public
                'show_ui'               => true, // равен аргументу public
                'show_in_menu'          => true, // равен аргументу show_ui
                'show_tagcloud'         => true, // равен аргументу show_ui
                'show_in_quick_edit'    => true, // равен аргументу show_ui
                'hierarchical'          => false,
                'rewrite'               => array( 'slug' => 'reliase' ),
                'show_in_rest'          => true
            ] );
        }

        // регистрация нового типа записей Партнеры
        add_action( 'init', 'register_partners_post_types' );
        function register_partners_post_types(){
            register_post_type( 'partners', [
                'label'  => null,
                'labels' => [
                    'name'               => __( 'Партнеры', 'worldmonitor' ), // основное название для типа записи
                    'singular_name'      => __( 'Партнеры', 'worldmonitor' ), // название для одной записи этого типа
                    'add_new'            => __( 'Добавить Партнера', 'worldmonitor' ), // для добавления новой записи
                    'add_new_item'       => __( 'Добавление Партнера', 'worldmonitor' ), // заголовка у вновь создаваемой записи в админ-панели.
                    'edit_item'          => __( 'Редактировать Партнера', 'worldmonitor' ), // для редактирования типа записи
                    'new_item'           => __( 'Новый Партнер', 'worldmonitor' ), // текст новой записи
                    'view_item'          => __( 'Посмотреть Партнера', 'worldmonitor' ), // для просмотра записи этого типа.
                    'search_items'       => __( 'Искать Партнера', 'worldmonitor' ), // для поиска по этим типам записи
                    'not_found'          => __( 'Не найдено', 'worldmonitor' ), // если в результате поиска ничего не было найдено
                    'not_found_in_trash' => __( 'Не найдено в корзине', 'worldmonitor' ), // если не было найдено в корзине
                    'parent_item_colon'  => '', // для родителей (у древовидных типов)
                    'menu_name'          => __( 'Партнеры', 'worldmonitor' ), // название меню
                ],
                'description'         => __( 'Вкладка парнеры', 'worldmonitor' ),
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
                'menu_position'       => 6,
                'menu_icon'           => 'dashicons-admin-site-alt',
                'capability_type'   => 'post',
                //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
                //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
                'hierarchical'        => false,
                'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'custom-fields', 'author' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
                'taxonomies'          => [''],
                'has_archive'         => true,
                'rewrite'             => true,
                'query_var'           => true,
            ] );
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
 * Подключаем счетчик постов!
 */

require get_template_directory() . '/inc/views-post.php';

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

