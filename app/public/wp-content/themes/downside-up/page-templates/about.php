<?php
/*
Template Name: About Page
*/
?>

<?php get_header(); ?>

<section class="about-hero">

    <div class="container">

        <h1><?php the_title(); ?></h1>

        <div class="about-content">
            <?php the_content(); ?>
        </div>

    </div>

</section>

<?php get_footer(); ?>