<?php
/**
 * Assessment CTA section.
 * Loaded via: get_template_part( 'template-parts/sections/resources/assessment-cta' );
 *
 * Thin placement wrapper only — the card itself is the same reusable
 * downside_up_cta() used anywhere else in the theme, so Blog/Insights/
 * search results get the identical card with a single function call.
 */
?>
<section class="du-resources-assessment-cta">
    <div class="du-container du-resources-assessment-cta__inner">
        <?php downside_up_cta('resource-discovery', 'compact'); ?>
    </div>
</section>
