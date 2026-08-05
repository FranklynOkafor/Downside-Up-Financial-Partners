<?php

/**
 * Generic search field component.
 *
 * Renders a real, functional WordPress search form (GET to home_url('/'),
 * 's' param) styled to the design system. Intended to be reused anywhere a
 * search input is needed — not specific to the Resources page.
 *
 * Args (passed via get_template_part's third parameter):
 *   'placeholder' (string, optional) — input placeholder text
 *   'aria_label'  (string, optional) — accessible label for the input
 *   'action'      (string, optional) — form action URL, defaults to home_url('/')
 *   'classes'     (string, optional) — extra classes on the root <form>
 */

$du_placeholder = isset($args['placeholder']) ? $args['placeholder'] : __('Search…', 'downside-up');
$du_aria_label   = isset($args['aria_label']) ? $args['aria_label'] : __('Search', 'downside-up');
$du_action       = isset($args['action']) ? $args['action'] : home_url('/');
$du_classes      = 'du-search-field';
if (!empty($args['classes'])) {
    $du_classes .= ' ' . $args['classes'];
}
?>
<form role="search" method="get" class="<?php echo esc_attr($du_classes); ?>" action="<?php echo esc_url($du_action); ?>">
    <span class="du-search-field__icon" aria-hidden="true">
        <?php echo downside_up_icon('search', ['class' => 'du-search-field__icon-svg', 'width' => 18, 'height' => 18]); ?>
    </span>
    <label for="du-search-field-input" class="du-sr-only"><?php echo esc_html($du_aria_label); ?></label>
    <input
        type="search"
        id="du-search-field-input"
        class="du-search-field__input du-text-body-md"
        name="s"
        value="<?php echo esc_attr(get_search_query()); ?>"
        placeholder="<?php echo esc_attr($du_placeholder); ?>"
        autocomplete="off">
</form>
