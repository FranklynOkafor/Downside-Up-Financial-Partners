<?php
/**
 * The front page template.
 *
 * Assembles the homepage from individual, reusable template parts so each
 * section can be iterated on (and later wired up to ACF) independently.
 */

get_header();
?>

<?php get_template_part('template-parts/hero/hero-home'); ?>
<?php get_template_part('template-parts/sections/trust-signals'); ?>
<?php get_template_part('template-parts/sections/services'); ?>
<?php get_template_part('template-parts/sections/why-us'); ?>
<?php get_template_part('template-parts/sections/testimonials'); ?>
<?php get_template_part('template-parts/sections/cta'); ?>
<?php get_template_part('template-parts/sections/newsletter'); ?>

<?php
get_footer();
