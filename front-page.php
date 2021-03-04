<?php get_header();?>
<main>

    <section class="hero" id="hero">

        <div class="container">

            <div class="main__grid">


                <div class="article__grid">
                    <?php
                    global $post;
                    // формируем запрос в базу данных
                    $query = new WP_Query( [
                        // получаем 5 постов
                        'posts_per_page' => 5,
                        //'orderby'        => 'comment_count',
                        'category_name'    => 'news',
                        //'tag' => 'Популярное',
                        // 'meta_key' => 'css',
                        // 'meta_value'  => 'css',
                    ] );
                    // проверяем,есть ли посты
                    if ( $query->have_posts() ) {
                        // создаем переменную-счетчик постов
                        $cnt = 0;
                        // пока посты есть, выводим их
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            // увеличиваем счетчик постов
                            $cnt++;
                            switch ($cnt) {
                                // первый пост
                                case '1':
                                    ?>
                                    <div class="article__grid--item article__grid--item-1" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(64, 48, 61, 0.35)), url(<?php if( has_post_thumbnail() ) {
                                            echo get_the_post_thumbnail_url();
                                        } else {
                                            echo get_template_directory_uri().'./assets/img/image-default.png';
                                        }?>) no-repeat center center / cover">
                                        <a href="<?php echo the_permalink() ?>" class="article__grid--permalink">
                                            <span class="category__name category__name--news">
                                                 <?php $category = get_the_category(); echo $category[0]->name;?>
                                            </span>
                                            <h4 class="article__grid--title">
                                                <?php echo get_the_title(); ?>
                                            </h4>
                                            <p class="article__grid--excerpt">
                                                <?php echo mb_strimwidth(get_the_excerpt(), 0, 90, '...'); ?>
                                            </p>
                                            <div class="article__grid--info">
                                                <div class="author">
                                                    <?php $author_id = get_the_author_meta('ID');?>
                                                    <img src="<?php echo get_avatar_url($author_id);?>" alt="Автор" class="author__avatar">
                                                    <span class="author__name">
                                                            <strong><?php the_author();?></strong> : <?php echo get_the_author_meta('description')?>
                                                        </span>
                                                </div>
                                                <!-- <div class="view">
                                                    <i class="far fa-eye"></i>
                                                    <span class="view__count">
                                                            365
                                                        </span>
                                                </div>
                                                <div class="favorite">
                                                    <i class="far fa-heart"></i>
                                                </div>-->
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                    break;
                                // выводим второй пост
                                case '2': ?>
                                    <div class="article__grid--item article__grid--item-2" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(64, 48, 61, 0.35)), url(<?php if( has_post_thumbnail() ) {
                                            echo get_the_post_thumbnail_url();
                                        } else {
                                            echo get_template_directory_uri().'./assets/img/image-default.png';
                                        }?>) no-repeat center center / cover">
                                        <a href="<?php echo the_permalink() ?>" class="article__grid--permalink">
                                            <!-- div class="view">
                                                <i class="far fa-eye"></i>
                                                <span class="view__count">
                                                                  365
                                                                </span>
                                            </div -->
                                            <span class="category__name category__name--news">
                                                <?php $category = get_the_category(); echo $category[0]->name; ?>
                                            </span>
                                            <h4 class="article__grid--title">
                                                <?php the_title(); ?>
                                            </h4>
                                            <div class="article__grid--info">
                                                <div class="author">
                                                    <?php $author_id = get_the_author_meta('ID');?>
                                                    <img src="<?php echo get_avatar_url($author_id);?>" alt="Автор" class="author__avatar">
                                                    <span class="author__name">
                                                        <strong><?php the_author();?></strong>
                                                    </span>
                                                </div>
                                                <!--div class="favorite">
                                                    <i class="far fa-heart"></i>
                                                </div -->
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                    break;
                                // выводим остальные посты
                                default: ?>
                                    <div class="article__grid--item article__grid--item-default" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(64, 48, 61, 0.35)), url(<?php if( has_post_thumbnail() ) {
                                            echo get_the_post_thumbnail_url();
                                        } else {
                                            echo get_template_directory_uri().'./assets/img/image-default.png';
                                        }?>) no-repeat center center / cover">
                                        <a href="<?php echo the_permalink() ?>" class="article__grid--permalink">
                                            <h4 class="article__grid--title">
                                                <?php echo mb_strimwidth(get_the_title(), 0, 13, '...'); ?>
                                            </h4>
                                            <p class="article__grid--excerpt">
                                                <?php echo mb_strimwidth(get_the_excerpt(), 0, 40, '...'); ?>
                                            </p>
                                            <!--div class="article__grid--info">
                                                <div class="view">
                                                    <i class="far fa-eye"></i>
                                                    <span class="view__count">
                                                                        365
                                                                    </span>
                                                </div>
                                                <div class="favorite">
                                                    <i class="far fa-heart"></i>
                                                </div>
                                            </div -->
                                        </a>
                                    </div>
                                    <?php
                                    break;
                                    }
                                    ?>
                                    <!-- Вывода постов, функции цикла: the_title() и т.д. -->
                                    <?php
                                }
                            } else {
                                // Постов не найдено
                                ?> <p><?php _e('No posts', 'universal') ?></p> <?php
                            }

                            wp_reset_postdata(); // Сбрасываем $post
                            ?>
                </div>

                <div class="article__grid article__grid--pl">

                    <div class="article__grid--item article__grid--item-1" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(64, 48, 61, 0.35)), url('img/MinFin.jpg') no-repeat center center / cover">

                        <a href="detail.html" class="article__grid--permalink">

                  <span class="category__name category__name--news">
                    Новости
                  </span>

                            <h4 class="article__grid--title">
                                Бюджет, внешние рынки и ...
                            </h4>

                            <p class="article__grid--excerpt">
                                Правительством предприняты беспрецедентные меры поддержки граждан РК ...
                            </p>

                            <div class="article__grid--info">

                                <div class="author">
                                    <img src="img/author.png" alt="Автор" class="author__avatar">
                                    <span class="author__name">
                        <strong>Инна Квашова</strong> : Главный редактор
                      </span>
                                </div>

                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <span class="view__count">
                        365
                      </span>
                                </div>

                                <div class="favorite">
                                    <i class="far fa-heart"></i>
                                </div>
                            </div>

                        </a>

                    </div>

                    <div class="article__grid--item article__grid--item-default" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(64, 48, 61, 0.35)), url('img/min-trud.jpg') no-repeat center center / cover">

                        <a href="detail.html" class="article__grid--permalink">

                            <h4 class="article__grid--title">
                                Меры поддержки
                            </h4>

                            <p class="article__grid--excerpt">
                                Правительством предприняты беспрецедентные ...
                            </p>

                            <div class="article__grid--info">

                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <span class="view__count">
                        365
                      </span>
                                </div>

                                <div class="favorite">
                                    <i class="far fa-heart"></i>
                                </div>
                            </div>

                        </a>

                    </div>

                    <div class="article__grid--item article__grid--item-default" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(64, 48, 61, 0.35)), url('img/min-trud.jpg') no-repeat center center / cover">

                        <a href="detail.html" class="article__grid--permalink">

                            <h4 class="article__grid--title">
                                Меры поддержки
                            </h4>

                            <p class="article__grid--excerpt">
                                Правительством предприняты беспрецедентные ...
                            </p>

                            <div class="article__grid--info">

                                <div class="view">
                                    <i class="far fa-eye"></i>
                                    <span class="view__count">
                        365
                      </span>
                                </div>

                                <div class="favorite">
                                    <i class="far fa-heart"></i>
                                </div>
                            </div>

                        </a>

                    </div>

                </div>

                <div class="article__grid article__grid--mb">

                    <div class="swiper-container article--swiper-mb">

                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="article__grid--item-mb" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(64, 48, 61, 0.35)), url('img/MinFin.jpg') no-repeat center center / cover">

                                    <a href="detail.html" class="article__grid--permalink-mb">

                        <span class="category__name category__name--news">
                          Новости
                        </span>

                                        <h4 class="article__grid--title">
                                            Бюджет, внешние рынки и ...
                                        </h4>

                                        <p class="article__grid--excerpt">
                                            Правительством предприняты беспрецедентные меры поддержки граждан РК ...
                                        </p>

                                        <div class="article__grid--info">

                                            <div class="author">
                                                <img src="img/author.png" alt="Автор" class="author__avatar">
                                                <span class="author__name">
                              <strong>Инна Квашова</strong>
                            </span>
                                            </div>

                                            <div class="view">
                                                <i class="far fa-eye"></i>
                                                <span class="view__count">
                              365
                            </span>
                                            </div>

                                            <div class="favorite">
                                                <i class="far fa-heart"></i>
                                            </div>
                                        </div>

                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>

                    <h2 class="article__grid--mb-title">
                        Новости
                    </h2>

                    <div class="article__card--mb--news">
                        <div class="article__card--item-mb">
                            <a href="detail.html" class="article__card--permalink-mb">
                                <div class="article__card--mb-content">
                                    <h2 class="article__card--mb-title">
                                        What is Lorem Ipsum?
                                    </h2>
                                    <p class="article__card--mb-except">
                                        Lorem Ipsum is simply dummy text of the
                                        printing and typesetting industry.
                                    </p>
                                    <div class="article__card--grid--info">

                                        <div class="article__card--author--mb">
                          <span class="article__card--author--author">
                            <strong>Инна Квашова</strong>
                          </span>
                                        </div>

                                        <div class="view">
                                            <i class="far fa-eye"></i>
                                            <span class="view__count">
                            365
                          </span>
                                        </div>

                                        <div class="favorite">
                                            <i class="far fa-heart"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="article__card--item-mb">
                            <a href="detail.html" class="article__card--permalink-mb">
                                <div class="article__card--mb-content">
                                    <h2 class="article__card--mb-title">
                                        What is Lorem Ipsum?
                                    </h2>
                                    <p class="article__card--mb-except">
                                        Lorem Ipsum is simply dummy text of the
                                        printing and typesetting industry.
                                    </p>
                                    <div class="article__card--grid--info">

                                        <div class="article__card--author--mb">
                          <span class="article__card--author--author">
                            <strong>Инна Квашова</strong>
                          </span>
                                        </div>

                                        <div class="view">
                                            <i class="far fa-eye"></i>
                                            <span class="view__count">
                            365
                          </span>
                                        </div>

                                        <div class="favorite">
                                            <i class="far fa-heart"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="article__card--item-mb">
                            <a href="detail.html" class="article__card--permalink-mb">
                                <div class="article__card--mb-content">
                                    <h2 class="article__card--mb-title">
                                        What is Lorem Ipsum?
                                    </h2>
                                    <p class="article__card--mb-except">
                                        Lorem Ipsum is simply dummy text of the
                                        printing and typesetting industry.
                                    </p>
                                    <div class="article__card--grid--info">

                                        <div class="article__card--author--mb">
                          <span class="article__card--author--author">
                            <strong>Инна Квашова</strong>
                          </span>
                                        </div>

                                        <div class="view">
                                            <i class="far fa-eye"></i>
                                            <span class="view__count">
                            365
                          </span>
                                        </div>

                                        <div class="favorite">
                                            <i class="far fa-heart"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="block__magazine">

                    <div class="block__magazine--item" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(64, 48, 61, 0.35)), url('img/img-magazine.jpg') no-repeat center center / cover">

                        <div class="block__magazine--permalink">

                            <div class="block__magazine--info">

                                <div class="author">
                                    <img src="img/author.png" alt="Автор" class="author__avatar">
                                    <span class="author__name">
                          <strong>Инна Квашова</strong>
                        </span>
                                </div>

                            </div>

                            <div class="block__magazine--button">
                    <span class="tag">
                      Свежий выпуск
                    </span>
                                <a href="#" class="block__magazine--button-btn">
                                    Читать далее <i class="fas fa-long-arrow-alt-right"></i>
                                </a>
                            </div>

                        </div>

                    </div>

                    <a href="archive.html" class="archive__btn">
                <span class="archive__btn--image">
                  <i class="fas fa-archive"></i>
                </span>
                        <span class="archive__btn--text">
                  Перейти в Архив
                </span>
                    </a>

                </div>

                <aside id="secondary" class="sidebar__front--page">
                    <img src="img/add.jpg" alt="" class="aside-ad">

                    <a href="archive.html" class="archive__btn archive__btn--mb">
                  <span class="archive__btn--image">
                    <i class="fas fa-archive"></i>
                  </span>
                        <span class="archive__btn--text">
                    Перейти в Архив
                  </span>
                    </a>

                    <a href="http://www.eurobak.kz/" target="_blank" class="website">
                  <span class="website__image">
                    <i class="fas fa-globe"></i>
                  </span>
                        <div class="website__info">
                    <span class="website__info--desc">
                      Official e-magazine
                    </span>
                            <span class="website__info--title">
                      EUROBAK.KZ
                    </span>
                        </div>
                    </a>
                </aside>

            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>