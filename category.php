<?php get_header();?>
    <section class="news" id="news">
        <div class="container">

            <div class="breadcumps">
              <span class="breadcumps__link">
                <?php if (function_exists('the_breadcrumbs') ) the_breadcrumbs(); ?>
              </span>
            </div>

            <div class="content__wrapper">

                <div class="content__wrapper--left">

                    <div class="news__interface">
                        <div class="news__section--title">
                            <h2 class="news__title">
                                <?php single_cat_title();?>
                            </h2>
                        </div>
                    </div>

                    <div class="news__block">

                        <div class="article__container">
                            <?php while ( have_posts() ) { the_post(); ?>
                                <article class="article__card">
                                    <a href="<?php echo the_permalink() ?>" class="post__permalink">
                                        <?php /* <figure class="article__image">
                                            <img src="<?php
                                            //проверяем,есть ли у поста миниатюра
                                            if( has_post_thumbnail() ) {
                                                echo get_the_post_thumbnail_url();
                                            } else {
                                                echo get_template_directory_uri() . '/assets/images/image-default.png';
                                            }
                                            ?>" alt="news">
                                        </figure> */?>
                                        <div class="article__content">
                                            <h3 class="card__title">
                                                <?php echo mb_strimwidth(get_the_title(), 0, 28, '...'); ?>
                                            </h3>
                                            <p class="card__excerpt">
                                                <?php echo mb_strimwidth(get_the_excerpt(), 0, 75, '...'); ?>
                                            </p>
                                            <div class="card__info">
                                                <div class="author">
                                                    <?php $author_id = get_the_author_meta('ID');?>
                                                    <img src="<?php echo get_avatar_url($author_id);?>" alt="Автор" class="author__avatar">
                                                    <span class="author__name">
                                                      <strong><?php the_author();?></strong>
                                                      <span class="date">
                                                        <?php the_time('j F'); ?>
                                                      </span>
                                                    </span>
                                                    </div>
                                                    <div class="view">
                                                        <i class="far fa-eye"></i>
                                                        <span class="view__count">
                                                             <?php echo get_post_meta( $post->ID, 'views', true ); ?>
                                                        </span>
                                                    </div>

                                                    <!-- div class="favorite">
                                                        <i class="far fa-heart"></i>
                                                    </div -->
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            <?php } ?>
                                <?php if ( ! have_posts() ){
                                    _e('No entries', 'universal') ;
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="content__wrapper--right">

                </div>

            </div>

        </div>
    </section>
<?php get_footer();?>