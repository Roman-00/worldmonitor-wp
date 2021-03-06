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
                                                <?php echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?>
                                            </h4>
                                            <p class="article__grid--excerpt">
                                                <?php echo mb_strimwidth(get_the_excerpt(), 0, 87, '...'); ?>
                                            </p>
                                            <div class="article__grid--info">
                                                <div class="author">
                                                    <?php $author_id = get_the_author_meta('ID');?>
                                                    <img src="<?php echo get_avatar_url($author_id);?>" alt="Автор" class="author__avatar">
                                                    <span class="author__name">
                                                            <strong><?php the_author();?></strong> : <?php echo get_the_author_meta('description')?>
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
                                                </div> -->
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
                                            <div class="view">
                                                <i class="far fa-eye"></i>
                                                <span class="view__count">
                                                    <?php echo get_post_meta( $post->ID, 'views', true ); ?>
                                                </span>
                                            </div>
                                            <span class="category__name category__name--news">
                                                <?php $category = get_the_category(); echo $category[0]->name; ?>
                                            </span>
                                            <h4 class="article__grid--title">
                                                <?php echo mb_strimwidth(get_the_title(), 0, 18, '...'); ?>
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
                                                <?php echo mb_strimwidth(get_the_title(), 0, 16, '...'); ?>
                                            </h4>
                                            <p class="article__grid--excerpt">
                                                <?php echo mb_strimwidth(get_the_excerpt(), 0, 40, '...'); ?>
                                            </p>
                                            <div class="article__grid--info">
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
                                ?> <p><?php _e('No posts', 'worldmonitor') ?></p> <?php
                            }

                            wp_reset_postdata(); // Сбрасываем $post
                            ?>
                </div>

                <div class="article__grid article__grid--pl">
                    <?php
                    global $post;
                    // формируем запрос в базу данных
                    $query = new WP_Query( [
                        // получаем 5 постов
                        'posts_per_page' => 3,
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
                                                <?php $category = get_the_category(); echo $category[0]->name; ?>
                                            </span>
                                            <h4 class="article__grid--title">
                                                <?php echo mb_strimwidth(get_the_title(), 0, 13, '...'); ?>
                                            </h4>
                                            <p class="article__grid--excerpt">
                                                <?php echo mb_strimwidth(get_the_excerpt(), 0, 40, '...'); ?>
                                            </p>

                                            <div class="article__grid--info">

                                                <div class="author">
                                                    <?php $author_id = get_the_author_meta('ID');?>
                                                    <img src="<?php echo get_avatar_url($author_id);?>" alt="Автор" class="author__avatar">
                                                    <span class="author__name">
                                                        <strong><? the_author(); ?></strong>
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

                                            <div class="article__grid--info">

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
                        ?> <p><?php _e('No posts', 'worldmonitor') ?></p> <?php
                    }

                    wp_reset_postdata(); // Сбрасываем $post
                    ?>

                </div>

                <div class="article__grid article__grid--mb">

                    <div class="swiper-container article--swiper-mb">

                        <div class="swiper-wrapper">
                                <?php
                                    // Объявляем глобальную переменную
                                    global $post;
                                    //параметры вывода постов в слайдер
                                    $myposts = get_posts([
                                            'numberposts' => -1,
                                            'category_name' => 'news',
                                            'tag' => 'actual',
                                    ]);

                                    // проверяем есть ли посты
                                    if( $myposts ) {
                                        // если есть посты, запускаем цикл для перебора
                                        foreach ( $myposts as $post ) {
                                            setup_postdata( $post );
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="article__grid--item-mb" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(64, 48, 61, 0.35)), url(<?php if( has_post_thumbnail() ) {
                                                        echo get_the_post_thumbnail_url();
                                                    } else {
                                                        echo get_template_directory_uri().'./assets/img/image-default.png';
                                                    }?>) no-repeat center center / cover">

                                                    <a href="<?php echo the_permalink() ?>" class="article__grid--permalink-mb">

                                                        <span class="category__name category__name--news">
                                                          <?php $category = get_the_category(); echo $category[0]->name; ?>
                                                        </span>

                                                        <h4 class="article__grid--title">
                                                            <?php echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?>
                                                        </h4>

                                                        <p class="article__grid--excerpt">
                                                            <?php echo mb_strimwidth(get_the_excerpt(), 0, 40, '...'); ?>
                                                        </p>

                                                        <div class="article__grid--info">

                                                            <div class="author">
                                                                <?php $author_id = get_the_author_meta('ID');?>
                                                                <img src="<?php echo get_avatar_url($author_id);?>" alt="Автор" class="author__avatar">
                                                                <span class="author__name">
                                                                  <strong><? the_author(); ?></strong>
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
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        // Постов не найдено
                                        ?><p><?php _e('No posts', 'worldmonitor')?></p><?php
                                    }
                                    wp_reset_postdata(); // Сбрасываем $post
                                ?>
                        </div>
                    </div>

                    <h2 class="article__grid--mb-title">
                        <?php the_field('name_title_mob_text', 179)?>
                    </h2>

                    <div class="article__card--mb--news">
                        <?php
                            // Обьявляем глобальную переменную
                            global $post;
                            // параметры вывода постов
                            $myposts = get_posts([
                                'numberposts' => 3,
                                'category_name'    => 'news',
                            ]);
                            // проверяем, есть ли посты?
                            if( $myposts ) {
                                foreach( $myposts as $post ) {
                                    setup_postdata( $post );
                                    ?>
                                    <div class="article__card--item-mb">
                                        <a href="<?php echo get_author_posts_url($author_id);?>" class="article__card--permalink-mb">
                                            <div class="article__card--mb-content">
                                                <h2 class="article__card--mb-title">
                                                    <?php echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?>
                                                </h2>
                                                <p class="article__card--mb-except">
                                                    <?php echo mb_strimwidth(get_the_excerpt(), 0, 40, '...'); ?>
                                                </p>
                                                <div class="article__card--grid--info">

                                                    <div class="article__card--author--mb">
                                                  <span class="article__card--author--author">
                                                    <strong><?php the_author(); ?></strong>
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
                                    </div>
                                <?php }
                            } else {
                                // Постов не найдено
                                ?> <p><?php _e('No posts', 'universal')?></p> <?php
                            }
                            wp_reset_postdata(); // Сбрасываем $post
                        ?>
                    </div>

                </div>

                <div class="block__magazine">

                    <?php
                        // объявляем глобальную переменую
                        global $post;
                        // параметры вывода постов
                        $myposts = get_posts([
                            'numberposts' => 1,
                            'post_type'   => 'magazine',
                        ]);
                        // проверяем есть ли посты?
                        if ( $myposts ) {
                            // если есть, запускаем цикл для перебора
                            foreach ( $myposts as $post) {
                                setup_postdata( $post );
                                ?>
                                <div class="block__magazine--item" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(64, 48, 61, 0.35)), url(<?php if( has_post_thumbnail() ) {
                                        echo get_the_post_thumbnail_url();
                                    } else {
                                        echo get_template_directory_uri().'./assets/img/image-default.png';
                                    }?>) no-repeat center center / cover">

                                    <div class="block__magazine--permalink">

                                        <div class="block__magazine--info">

                                            <div class="author">
                                                <?php $author_id = get_the_author_meta('ID');?>
                                                <img src="<?php echo get_avatar_url($author_id);?>" alt="Автор" class="author__avatar">
                                                <span class="author__name">
                                                  <strong><? the_author(); ?></strong>
                                                </span>
                                            </div>

                                        </div>

                                        <div class="block__magazine--button">
                                            <span class="tag">
                                              Свежий выпуск
                                            </span>
                                            <a href="<?php the_field('link_view_joomag')?>" class="block__magazine--button-btn">
                                                Читать далее <i class="fas fa-long-arrow-alt-right"></i>
                                            </a>
                                        </div>

                                    </div>

                                </div>
                                <a href="<?php the_field('link_archive_magazine')?>" class="archive__btn">
                                    <span class="archive__btn--image">
                                      <i class="fas fa-archive"></i>
                                    </span>
                                    <span class="archive__btn--text">
                                     <?php the_field('text_link_btn_archive')?>
                                    </span>
                                </a>
                                <?php
                            }
                        } else {
                            // Постов не найдено
                            ?> <p><?php _e('No posts', 'worldmonitor')?></p> <?php
                        }

                        wp_reset_postdata(); // Сбрасываем $post
                    ?>

                </div>

                <?php get_sidebar('front-page'); ?>

            </div>

        </div>

    </section>

    <div class="modal_show">
        <div class="modal_show-dialog">
            <div class="modal_show-text">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/w.png' ?>" alt="Первая буква лого" class="modal_show-thumb">
                <p class="modal_show-question">
                    Хотите получать только актуальную информацию от worldmonitor.kz?
                </p>
            </div>
            <div class="modal_show-interface">
                <button class="modal_show-no">Нет, спасибо</button>
                <button class="modal_show-yes popup-btn">Да, конечно</button>
            </div>
        </div>
    </div>

    <div class="popup">
        <div class="popup-content">
            <button class="popup-close">&times;</button>
            <div class="main-form">
                <h3>Введите свои данные для связи с нами!</h3>
                <form id="form3" name="user_form" action="<?php echo get_template_directory_uri() . '/assets/php/send.php'?>" method="POST">
                    <div class="input-group popup_input-group">
                        <label for="form3-name">Имя:</label>
                        <input type="text" class="form-name popup_form-input" id="form3-name" name="user_name" placeholder="Как вас зовут:"
                               required>
                    </div>
                    <div class="input-group popup_input-group">
                        <label for="form3-surname">Фамилия:</label>
                        <input type="text" class="form-surname popup_form-input" id="form3-surname" name="user_surname" placeholder="Ваша Фамилия:"
                               required>
                    </div>
                    <div class="input-group popup_input-group">
                        <label for="form3-company">Компания</label>
                        <input type="text" class="form-company popup_form-input" id="form3-company" name="user_company" placeholder="Название вашей компании:"
                               required>
                    </div>
                    <div class="input-group popup_input-group">
                        <label for="form3-place">Должность</label>
                        <input type="text" class="form-place popup_form-input" id="form3-place" name="user_place" placeholder="Ваша должность:"
                               required>
                    </div>
                    <div class="input-group popup_input-group">
                        <label for="form3-phone">Телефон</label>
                        <input type="tel" class="form-phone popup_form-input" id="form3-phone" name="user_phone"
                               placeholder="Ваш телефон:" required>
                    </div>
                    <div class="input-group popup_input-group">
                        <label for="form3-email">Email</label>
                        <input type="email" class="form-email popup_form-input" id="form3-email" name="user_email"
                               placeholder="Ваш E-mail">
                    </div>
                    <button class="btn form-btn" id="submit" type="submit">Оставить заявку!</button>
                </form>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>