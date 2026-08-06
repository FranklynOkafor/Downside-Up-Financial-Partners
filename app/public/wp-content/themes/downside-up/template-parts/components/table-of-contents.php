<?php
/**
 * Sticky Table of Contents — Single Article template.
 * Loaded via: get_template_part( 'template-parts/components/table-of-contents' );
 *
 * data-du-toc / data-du-toc-list are read by assets/js/article-toc.js,
 * which builds the link list from the article's H2 headings, highlights
 * the current section on scroll, and smooth-scrolls on click.
 */
?>
<nav class="du-toc" data-du-toc aria-label="<?php esc_attr_e('Table of contents', 'downside-up'); ?>" hidden>
    <p class="du-toc__label du-text-label-caps"><?php esc_html_e('Table of Contents', 'downside-up'); ?></p>
    <ul class="du-toc__list" data-du-toc-list></ul>
</nav>
