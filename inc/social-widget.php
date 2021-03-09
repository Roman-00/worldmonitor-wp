<?php
/**
 * Добавление нового виджета Social_Widget.
 */
class Social_Widget extends WP_Widget {

    // Регистрация виджета используя основной класс
    function __construct() {
        // вызов конструктора выглядит так:
        // __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
        parent::__construct(
            'social_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: foo_widget
            __('Виджеты соцсети','worldmonitor'),
            array( 'description' => __( 'Social_Widget', 'worldmonitor' ), 'classname' => 'widget-social', )
        );

        // скрипты/стили виджета, только если он активен
        if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
            add_action('wp_enqueue_scripts', array( $this, 'add_my_widget_scripts' ));
            add_action('wp_head', array( $this, 'add_my_widget_style' ) );
        }
    }

    /**
     * Вывод виджета во Фронт-энде
     *
     * @param array $args     аргументы виджета.
     * @param array $instance сохраненные данные из настроек
     */
    function widget( $args, $instance ) {
        $title = $instance['title'];
        $link_facebook = $instance['link_facebook'];
        $link_twitter = $instance['link_twitter'];
        $link_youtube = $instance['link_youtube'];

        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        if ( ! empty( $link_facebook ) ) {
            echo '<a target="_black" href="' . $link_facebook . '">
            <img src="' . get_template_directory_uri() . '/assets/img/facebook-icon.svg" >
		</a>';
        }
        if ( ! empty( $link_twitter ) ) {
            echo '<a target="_black" href="' . $link_twitter . '">
            <img src="' . get_template_directory_uri() . '/assets/img/twitter-icon.svg" ></a>';
        }
        if ( ! empty( $link_youtube ) ) {
            echo '<a target="_black" href="' . $link_youtube. '">
			<img src="' . get_template_directory_uri() . '/assets/img/youtube-icon.svg" >
			</a>';
        }
        echo $args['after_widget'];
    }

    /**
     * Админ-часть виджета
     *
     * @param array $instance сохраненные данные из настроек
     */
    function form( $instance ) {
        $title = @ $instance['title'] ?: __( 'Виджеты соцсети', 'worldmonitor' );
        $link_facebook = @ $instance['link_facebook'] ?: 'http://yandex.ru/';
        $link_twitter = @ $instance['link_twitter'] ?: 'http://yandex.ru/';
        $link_youtube = @ $instance['link_youtube'] ?: 'http://yandex.ru/';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title ', 'universal' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link_facebook' ); ?>"><?php _e( 'Facebook link: ', 'universal' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'link_facebook' ); ?>" name="<?php echo $this->get_field_name( 'link_facebook' ); ?>" type="text" value="<?php echo esc_attr( $link_facebook ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link_twitter' ); ?>"><?php _e( 'Twitter link: ', 'universal' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'link_twitter' ); ?>" name="<?php echo $this->get_field_name( 'link_twitter' ); ?>" type="text" value="<?php echo esc_attr( $link_twitter ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link_youtube' ); ?>"><?php _e( 'Youtube link: ', 'universal' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'link_youtube' ); ?>" name="<?php echo $this->get_field_name( 'link_youtube' ); ?>" type="text" value="<?php echo esc_attr( $link_youtube ); ?>">
        </p>
        <?php
    }

    /**
     * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance новые настройки
     * @param array $old_instance предыдущие настройки
     *
     * @return array данные которые будут сохранены
     */
    function update( $new_instance, $old_instance ) {
        $instance = array();
        // записываем в массив и очищаем от тегов -strip_tags
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['link_facebook'] = ( ! empty( $new_instance['link_facebook'] ) ) ? strip_tags( $new_instance['link_facebook'] ) : '';
        $instance['link_twitter'] = ( ! empty( $new_instance['link_twitter'] ) ) ? strip_tags( $new_instance['link_twitter'] ) : '';
        $instance['link_youtube'] = ( ! empty( $new_instance['link_youtube'] ) ) ? strip_tags( $new_instance['link_youtube'] ) : '';

        return $instance;
    }

    // скрипт виджета
    function add_my_widget_scripts() {
        // фильтр чтобы можно было отключить скрипты
        if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
            return;

        $theme_url = get_stylesheet_directory_uri();

        wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
    }

    // стили виджета
    function add_my_widget_style() {
        // фильтр чтобы можно было отключить стили
        if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
            return;
        ?>
        <style type="text/css">
            .social_widget a{ display:inline; }
        </style>
        <?php
    }

}
    // конец класса Social_Widget

    // регистрация Social_Widget в WordPress
    function register_social_widget() {
        register_widget( 'Social_Widget' );
    }
    add_action( 'widgets_init', 'register_social_widget' );


?>