<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package worldmonitor
 */

get_header();
?>

    <div class="container">

        <h2 class="search__page--title">
            <?php _e('Результаты поиска: ', 'worldmonitor')?><?php the_search_query(); ?>
        </h2>

        <div class="search__container">

            <?php while ( have_posts() ){ the_post(); ?>

                <div class="search__article--post">
                    <a href="<?php echo get_the_permalink(); ?>">
                        <img src="<?php
                            //проверяем, есть ли у поста миниатюра
                            if( has_post_thumbnail() ) {
                                echo get_the_post_thumbnail_url();
                            } else {
                                echo get_template_directory_uri() . '/assets/images/image-default.png';
                            }
                        ?>" alt="">

                        <small>
                            <?php
                            foreach (get_the_category() as $category) {
                                printf(
                                    '<a href="%s" class="category-link %s">%s</a>',
                                    esc_url(get_category_link($category)),
                                    esc_html( $category -> slug),
                                    esc_html( $category -> name),
                                    );
                            }
                            }
                            ?>
                        </small>
                        <h2 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...') ?></h2>
                        <p class="news-item-excerpt">
                            <?php echo mb_strimwidth(get_the_excerpt(), 0, 200, '...'); ?>
                        </p>
                        <div class="more">
                            <p>Читать</p>
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </div>
                    </a>
                </div>
                <?php if( ! have_posts() ){ ?>
                    <?php _e('No entries', 'worldmonitor')?>
                <?php } ?>
        </div>
        <?php
            $args = array (
              'prev_text' => __('Back', 'worldmonitor'),
              'next_text' => __('Next', 'worldmonitor'),
            );
            the_posts_pagination( $args )?>
    </div>
<?php get_footer(); ?>
