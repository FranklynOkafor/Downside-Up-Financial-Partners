<?php get_header(); ?>

<main class="page">

    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
    ?>

        <article>

            <div class="section">
                <div class="container">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>

            <div class="page-content">
                <?php the_content(); ?>
            </div>

        </article>

    <?php
        endwhile;
    endif;
    ?>

</main>

<?php get_footer(); ?>