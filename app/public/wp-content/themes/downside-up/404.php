<?php
/**
 * The template for displaying 404 pages (not found).
 * Follows the same get_header() / <main id="primary"> / get_footer()
 * structure as single.php and index.php, so this inherits the site's
 * existing header, navigation and footer exactly as every other page
 * does.
 *
 * @package Downside-up
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php get_template_part('template-parts/sections/error-404'); ?>
</main>

<?php
get_footer();
