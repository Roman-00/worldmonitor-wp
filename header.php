<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head()?>
</head>
<body <?php body_class(); ?>>
<!-- возможность разработчикам вставлять свои участки кода,плагин,щетчик аналитики яндекс и -->
<?php wp_body_open(); ?>

<?php get_sidebar('top'); ?>

<header class="header" id="header">

    <div class="container">

        <div class="header__interface">
            <div class="header__interface--left">
                <div class="menu__mobile--btn">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="language__version">
                    <a href="https://worldmonitor.kz/en" class="language__version--item">
                        Eng
                    </a> /
                    <a href="https://worldmonitor.kz/" class="language__version--item language__version--item-active">
                        Rus
                    </a>
                </div>

                <div class="header__search">
                    <?php echo get_search_form(); ?>
                </div>
            </div>

            <a href="#" class="logo__link">
                    <span class="logo menu__logo">
                        <?php
                        $logo_img = '';
                        if(is_front_page()){
                            if( $custom_logo_id = get_theme_mod('custom_logo') ){
                                $logo_img = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                                    'class'    => 'custom-logo',
                                    'itemprop' => 'logo',
                                ) );
                                echo '<div class="logo">' . $logo_img .
                                    '<span class="logo-name">' . get_bloginfo('name') . '</span></div>';
                            }else {
                                echo '<span class="logo-name">' . get_bloginfo('name') . '</span>';
                            }} else {
                            echo '<div class="logo">' . get_custom_logo() .
                                '<a class="logo-name" href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a></div>';
                        }
                        ?>
                    </span>
            </a>

            <div class="header__interface--right">
                <div class="header__social">
                    <a href="<?php the_field('link_linkedin', 179)?>" class="header__social--item social__item--linkedin">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="<?php the_field('link_facebook', 179)?>" class="header__social--item social__item--facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="<?php the_field('link_instagram', 179)?>" class="header__social--item social__item--instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="<?php the_field('link_telegram', 179)?>" class="header__social--item social__item--telegram">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
                </div>

                <div class="header__subscription">
                        <span class="header__subscription--text popup-btn">
                            <?php the_field('text_sub', 179)?>
                        </span>
                    <span class="header__subscription--image">
                            <svg class="subscription__svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M506.134,241.843c-0.006-0.006-0.011-0.013-0.018-0.019l-104.504-104c-7.829-7.791-20.492-7.762-28.285,0.068
                                            c-7.792,7.829-7.762,20.492,0.067,28.284L443.558,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h423.557
                                            l-70.162,69.824c-7.829,7.792-7.859,20.455-0.067,28.284c7.793,7.831,20.457,7.858,28.285,0.068l104.504-104
                                            c0.006-0.006,0.011-0.013,0.018-0.019C513.968,262.339,513.943,249.635,506.134,241.843z"/>
                                    </g>
                                </g>
                            </svg>
                        </span>
                </div>

                <div class="language__version mob__lg--version">
                    <a href="#" class="language__version--item">
                        Eng
                    </a> /
                    <a href="#" class="language__version--item language__version--item-active">
                        Rus
                    </a>
                </div>
            </div>

        </div>

    </div>

    <div class="menu">

        <div class="container">

            <?php
            wp_nav_menu( [
                'theme_location'  => 'header_menu',
                'container'       => 'nav',
                'container_class' => 'header-nav',
                'menu_class'      => 'nav menu__nav',
                'echo'            => true,
            ] );
            ?>

        </div>

    </div>

</header>