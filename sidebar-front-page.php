<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package universe-example
 */
// проверяем, есть ли у нас активный сайдбар
if ( ! is_active_sidebar( 'main-sidebar' ) ) {
	return;
}

?>

<aside id="secondary" class="sidebar__front--page">
<!-- выводим конкретно наш сайдбар -->
	<?php dynamic_sidebar( 'main-sidebar' ); ?>

    <a href="<?php the_field('sidebar_archive_mob_link', 179)?>" class="archive__btn archive__btn--mb">
          <span class="archive__btn--image">
            <i class="fas fa-archive"></i>
          </span>
          <span class="archive__btn--text">
            Перейти в Архив
          </span>
    </a>
    <a href="<?php the_field('sidebar_btn_eb_link', 179)?>" target="_blank" class="website">
      <span class="website__image">
        <i class="fas fa-globe"></i>
      </span>
      <div class="website__info">
        <span class="website__info--desc">
          <?php the_field('sidebar_btn_eb_text', 179)?>
        </span>
        <span class="website__info--title">
          <?php the_field('sidebar_btn_eb_desc', 179)?>
        </span>
      </div>
    </a>
</aside><!-- #secondary -->


