<footer class="footer" id="footer">

    <div class="container">

        <div class="footer__menu">

            <div class="partners">
                <h2 class="partners__title">
                    Партнеры
                </h2>

                <div class="swiper-container">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <?php
                            //объявляем глобальную переменую
                            global $post;
                            // параметры вывода постов
                            $myposts = get_posts([
                                'numberposrs' => -1,
                                'post_type'   => 'partners',
                            ]);
                            // проверяем есть ли посты!
                            if( $myposts ) {
                                //если есть, запускаем цикл для перебора
                                foreach ( $myposts as $post ) {
                                    setup_postdata( $post );
                                    ?>
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        <a href="<?php the_field('link_partners')?>" target="_blank" class="series-link">
                                            <div class="card">
                                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                            } else {
                                // Постов не найдено!
                            ?><p><?php _e('No posts', 'worldmonitor')?></p> <?php
                            }
                            wp_reset_postdata(); // Сбрасываем $post
                        ?>
                    </div>
                </div>
            </div>

            <div class="footer__menu--list">
                <h2 class="menu__list--title">
                    World monitor
                </h2>
                <nav class="footer__nav menu__footer--nav">
                    <?php
                    wp_nav_menu( [
                        'theme_location'  => 'footer_menu',
                        'container'       => 'nav',
                        'container_class' => 'footer-nav',
                        'menu_class'      => 'footer__nav--item',
                        'echo'            => true,
                    ] );
                    ?>
                    <!-- a href="#" class="">
                        О нас
                    </a -->
                </nav>
            </div>

            <div class="footer__address">
                <h2 class="footer__address--title">
                    Адрес
                </h2>
                <span class="footer__address--text">
                  <?php the_field('home_adress', 179)?>
                </span>
            </div>

            <div class="footer__contacts">
                <h2 class="footer__contacts--title">
                    Контакты
                </h2>
                <a href="<?php the_field('home_link_phone', 179)?>" class="footer__contacts--link footer__contacts--link-tel">
                    <?php the_field('home_text_phone', 179)?>
                </a>
                <a href="mailto:<?php the_field('home_text_email', 179)?>" class="footer__contacts--link footer__contacts--link-email">
                    <?php the_field('home_link_email', 179)?>
                </a>
            </div>
        </div>

        <div class="footer__link">

            <div class="copyright">
            <span class="copyright__text">
              <?php the_field('text_copyright_footer', 179)?>
            </span>
            </div>

            <div class="material__block">
                <a href="<?php the_field('link_privacy_policy_footer', 179)?>" class="material__block--link">
                    <?php the_field('text_privacy_policy_footer', 179)?>
                </a>
                <a href="<?php the_field('link_terms_of_use_footer', 179)?>" class="material__block--link">
                    <?php the_field('text_terms_of_use_footer', 179)?>
                </a>
                <a href="<?php the_field('link_legal_disclaimer_footer', 179)?>" class="material__block--link">
                    <?php the_field('text_legal_disclaimer_footer', 179)?>
                </a>
            </div>

            <div class="cookies__block">
            <span class="cookies__block--text">
              Cookies
            </span>
            </div>

        </div>

    </div>

</footer>
<?php wp_footer(); ?>
</body>
</html>
