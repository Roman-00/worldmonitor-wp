<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package worldmonitor
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="container">
            <div class="detail__wrap">
                <div class="detail__tag--name">
                    <span class="detail__tag--name-text">
                        <?php
                            foreach (get_the_category() as $category) {
                                printf(
                                    '<a href="%s" class="category-link %s">%s</a>',
                                    esc_url(get_category_link($category)),
                                    esc_html( $category -> slug),
                                    esc_html( $category -> name),
                                );
                            }
                        ?>
                    </span>
                </div>
                <?php
                    if ( is_singular() ) :
                        the_title( '<h2 class="detail__content--title">', '</h2>' );
                    else :
                        the_title( '<h2 class="detail__content--title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    endif;?>
                <!-- выводим краткое описание записи -->
                <p class="detail__content--desc">
                    <?php echo mb_strimwidth(get_the_excerpt(), 0, 300, '...'); ?>
                </p>
                <div class="detail__grid--info">

                    <div class="author">
                        <?php $author_id = get_the_author_meta('ID');?>
                        <img src="<?php echo get_avatar_url($author_id); ?>" alt="Автор" class="author__avatar">
                        <span class="author__name">
                          <strong><?php the_author();?></strong> : <?php echo get_the_author_meta('description')?>
                          <span class="detail__date">
                             <?php the_time('j F, H:i'); ?>
                          </span>
                        </span>
                    </div>

                </div>
                <?/*php the_title( '<h2 class="detail__content--title">', '</h2>' );*/?>
            </div>
        </div>
    </header><!-- .entry-header -->

    <div class="container">
        <div class="detail__wrap--content">
            <div class="detail__grid--container">
                <div class="detail__page--image">
                    <?php worldmonitor_post_thumbnail(); ?>
                </div>

                <div class="detail__page--block">

                    <div class="detail__block--social">
                        <?php
                            meks_ess_share();
                        ?>
                    </div>

                    <div class="detail__block--content">
                        <?php
                        // выводим содержимое
                        the_content(
                        // выводим его на экран
                            sprintf(
                            // очищаем от разных лишних тегов
                                wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'universe-example' ),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                // очищаем от разных лишних тегов title
                                wp_kses_post( get_the_title() )
                            )
                        );
                        // Обертка для страничной навигации, например,когда пост состоит из нескольких постов
                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'universe-example' ),
                                'after'  => '</div>',
                            )
                        );
                        ?>
                        <span class="detail__popular--tag">
                          <strong>Похожие темы:</strong>
                          <span class="d_p_t">
                             <?php
                                $tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'worldmonitor-example' ) );
                                if ( $tags_list ) {
                                /* translators: 1: list of tags. */
                                    printf( '<span class="tags-links">' . esc_html__( '%1$s', 'worldmonitor-example' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                }
                             ?>
                          </span>
                        </span>
                        <div class="detail__post--comment">

                            <div class="detail__post--comment-info">
                                <?php get_sidebar('page-bottom'); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php get_sidebar('page')?>
        </div>
    </div>

    <!-- div class="entry-content">
        <div class="container">

        </div>
    </div --><!-- .entry-content -->

    <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Edit <span class="screen-reader-text">%s</span>', 'worldmonitor' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
