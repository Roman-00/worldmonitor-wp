<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package universe-example
 */
// проверяем, есть ли у нас активный сайдбар
if ( ! is_active_sidebar( 'top-sidebar' ) ) {
	return;
}

?>

<aside id="top_ad" class="top__ad">
<!-- выводим конкретно наш сайдбар -->
	<?php dynamic_sidebar( 'top-sidebar' ); ?>
</aside><!-- #secondary -->
