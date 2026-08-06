<?php
/**
 * Goal Navigation section.
 * Loaded via: get_template_part( 'template-parts/sections/resources/goal-navigation' );
 *
 * Renders as plain links to the current page with a `resource_category`
 * query var — no JavaScript required, works with JS disabled, and stays
 * in sync with the Resource Grid via downside_up_get_active_resource_goal().
 */

$du_terms  = downside_up_get_resource_goal_terms();
$du_active = downside_up_get_active_resource_goal();

// Only "All Resources" to show — no categorized posts yet. Nothing to filter.
if (count($du_terms) < 2) {
    return;
}

$du_base_url = get_permalink();
?>
<nav class="du-goal-nav" aria-label="<?php esc_attr_e('Filter resources by topic', 'downside-up'); ?>">
    <div class="du-goal-nav__scroller du-container">
        <ul class="du-goal-nav__list">
            <?php foreach ($du_terms as $du_term) : ?>
                <?php
                $du_is_active = $du_term['slug'] === $du_active;
                $du_url = $du_term['slug']
                    ? add_query_arg('resource_category', $du_term['slug'], $du_base_url)
                    : $du_base_url;
                ?>
                <li class="du-goal-nav__item">
                    <a
                        href="<?php echo esc_url($du_url); ?>"
                        class="du-pill<?php echo $du_is_active ? ' du-pill--active' : ''; ?>"
                        <?php echo $du_is_active ? 'aria-current="true"' : ''; ?>
                    >
                        <?php echo esc_html($du_term['label']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>
