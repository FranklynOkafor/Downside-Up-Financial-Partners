<?php
/**
 * The template for displaying all single posts
 *
 * @link https://wordpress.org
 * @package Downside-up
 */

get_header(); // Includes header.php ?>

<main id="primary" class="site-main">
    <div class="container">

        <?php
        // Start the WordPress Loop
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <header class="entry-header">
                    <?php 
                    // Display Post Title
                    the_title( '<h1 class="entry-title">', '</h1>' ); 
                    ?>

                    <div class="entry-meta">
                        <span class="posted-on">
                            Published on: <?php echo get_the_date(); ?>
                        </span>
                        <span class="author">
                            by <?php the_author(); ?>
                        </span>
                    </div>
                </header>

                <?php 
                // Display Featured Image if it exists
                if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    // Display Core Post Content
                    the_content();

                    // Paginate post if split using <!--nextpage-->
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'your-theme' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>

                <footer class="entry-footer">
                    <span class="cat-links">
                        Categories: <?php the_category( ', ' ); ?>
                    </span>
                    <?php 
                    // Display Tags if available
                    the_tags( '<span class="tags-links">Tags: ', ', ', '</span>' ); 
                    ?>
                </footer>

            </article>

            <?php
            // If comments are open or there is at least one comment, load the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

            // Optional: Dynamic Next/Previous Post Navigation Links
            the_post_navigation( array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'your-theme' ) . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'your-theme' ) . '</span> <span class="nav-title">%title</span>',
            ) );

        endwhile; // End of the loop.
        ?>

    </div>
</main>

<?php
get_sidebar(); // Includes sidebar.php (Optional)
get_footer();  // Includes footer.php
