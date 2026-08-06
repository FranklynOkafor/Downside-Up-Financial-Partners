<?php
/**
 * Resource Grid section.
 * Loaded via: get_template_part( 'template-parts/sections/resources/resource-grid' );
 */

$du_paged = !empty($_GET['resource_page']) ? max(1, (int) $_GET['resource_page']) : 1;
$du_query = downside_up_get_resource_grid_query($du_paged);

if (!$du_query->have_posts()) {
    ?>
    <section class="du-resource-grid du-resource-grid--empty">
        <div class="du-container">
            <p class="du-text-body-md"><?php esc_html_e('No resources found for this topic yet.', 'downside-up'); ?></p>
        </div>
    </section>
    <?php
    return;
}

// Build the pagination base explicitly (rather than relying on
// paginate_links()'s default, which assumes standard /page/N/ archive
// pagination — this is a custom query on a static page template).
$du_pagination_base = remove_query_arg(['resource_page']);
$du_active_goal = downside_up_get_active_resource_goal();
if ($du_active_goal) {
    $du_pagination_base = add_query_arg('resource_category', $du_active_goal, $du_pagination_base);
}
$du_pagination_base = add_query_arg('resource_page', '%#%', $du_pagination_base);
?>
<section class="du-resource-grid" aria-label="<?php esc_attr_e('Resource articles', 'downside-up'); ?>">
    <div class="du-container">

        <div class="du-resource-grid__grid">
            <?php while ($du_query->have_posts()) : $du_query->the_post(); ?>
                <?php
                get_template_part('template-parts/cards/resource-card', null, [
                    'post' => get_post(),
                ]);
                ?>
            <?php endwhile; ?>
        </div>

        <?php if ($du_query->max_num_pages > 1) : ?>
            <nav class="du-resource-grid__pagination" aria-label="<?php esc_attr_e('Resource pages', 'downside-up'); ?>">
                <?php
                echo paginate_links([
                    'total'     => $du_query->max_num_pages,
                    'current'   => $du_paged,
                    'base'      => $du_pagination_base,
                    'format'    => '',
                    'prev_text' => downside_up_icon('arrow-right', ['width' => 16, 'height' => 16, 'class' => 'du-resource-grid__pagination-prev-icon']) . esc_html__('Previous', 'downside-up'),
                    'next_text' => esc_html__('Next', 'downside-up') . downside_up_icon('arrow-right', ['width' => 16, 'height' => 16]),
                    'type'      => 'list',
                ]);
                ?>
            </nav>
        <?php endif; ?>

    </div>
</section>
<?php
wp_reset_postdata();
