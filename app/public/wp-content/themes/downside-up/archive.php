<?php
/**
 * The template for displaying archive pages
 *
 * @package YourThemeName
 */

get_header(); // Includes header.php
?>

<main id="primary" class="site-main container">

    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <?php
            // Displays archive title dynamically (e.g., Category: News, Tag: Tech, Author: John)
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            
            // Displays archive description if it exists
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header><!-- .page-header -->

        <div class="archive-loop-grid">
            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                /**
                 * Include the Post-Type-specific template for the content.
                 * If you want to bypass template parts, replace this line with your HTML loop content.
                 */
                get_template_part( 'template-parts/content', get_post_format() );

            endwhile;
            ?>
        </div><!-- .archive-loop-grid -->

        <div class="archive-pagination">
            <?php
            // Standard number-based archive pagination links
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '&laquo; Previous', 'your-text-domain' ),
                'next_text' => __( 'Next &raquo;', 'your-text-domain' ),
            ) );
            ?>
        </div><!-- .archive-pagination -->

    <?php else : ?>

        <section class="no-results not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'your-text-domain' ); ?></h1>
            </header>
            <div class="page-content">
                <p><?php esc_html_e( 'It seems there are no posts matching this archive criteria.', 'your-text-domain' ); ?></p>
                <?php get_search_form(); // Includes standard search bar ?>
            </div>
        </section>

    <?php endif; ?>

</main><!-- #primary -->

<?php
get_sidebar(); // Optional: Includes sidebar.php
get_footer();  // Includes footer.php
