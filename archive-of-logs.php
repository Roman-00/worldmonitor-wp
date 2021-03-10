<?php
/*
    Template Name: Страница Архив Журналов
    Template Post Type: page
*/
?>
<?php get_header();?>

    <section class="archive" id="archive">

        <div class="container">

            <div class="breadcumps">
                    <span class="breadcumps__link">
                      <?php if (function_exists('the_breadcrumbs') ) the_breadcrumbs(); ?>
                    </span>
            </div>

            <div class="archive__interface">
                <div class="archive__section--title">
                    <h2 class="archive__title">
                        <?php single_cat_title();?>
                    </h2>
                </div>
            </div>

            <div class="archive__container">

                <div class="archive__article--container">

                    <div class="archive__article--wrap">
                        <?php
                            // Обьявляем глобальную переменную
                            global $post;
                            // параметры вывода журналов в архив
                            $myposts = get_posts([
                                'numberposts' => -1,
                                'post_type'   => 'all_magazine'
                            ]);
                            // проверяем, есть ли посты
                            if( $myposts ) {
                                // если есть, запускаем цикл для перебора
                                foreach ( $myposts as $post ) {
                                    setup_postdata( $post );
                                    ?>
                                    <article class="archive__article--card">

                                        <figure class="archive__article--image">
                                            <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                                        </figure>

                                        <div class="archive__article--content">

                                            <h3 class="archive__article--title">
                                                <?php echo get_the_title(); ?>
                                            </h3>

                                            <p class="archive__article--excerpt">
                                                <?php echo mb_strimwidth(get_the_excerpt(), 0, 90, '...'); ?>
                                            </p>

                                            <a href="<?php the_field('link_to_magazine') ?>" class="archive__article--link">
                                                Читать журнал
                                                <i class="fas fa-long-arrow-alt-right"></i>
                                            </a>

                                        </div>

                                    </article>
                                    <?php
                                }
                            } else {
                                // Постов не найдено
                                ?> <p><?php _e('No posts', 'universal')?></p> <?php
                            }
                            wp_reset_postdata(); // Сбрасываем $post
                        ?>

                    </div>

                </div>

                <?php get_sidebar('page')?>
            </div>
        </div>

    </section>

<?php get_footer();?>