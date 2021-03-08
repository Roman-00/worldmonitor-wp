<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package universe-example
 */
// проверяем, есть ли у нас активный сайдбар
if ( ! is_active_sidebar( 'page-sidebar-bottom' ) ) {
    return;
}

?>

<aside id="secondary" class="page-sidebar">
    <!-- выводим конкретно наш сайдбар -->
    <?php dynamic_sidebar( 'page-sidebar-bottom' ); ?>
</aside><!-- #secondary -->