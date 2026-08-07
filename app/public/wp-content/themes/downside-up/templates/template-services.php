<?php
/**
 * Template Name: Services Page
 * Description: Premium services overview page — introduces the six core
 * services, the process, why clients choose DownSide Up, who it's for,
 * how it compares to traditional advice, FAQs, and a closing assessment CTA.
 */

get_header();

// 1. Hero
get_template_part('template-parts/heroes/hero', 'services');

// 2. Introduction (reuses Three Pillars component)
get_template_part('template-parts/sections/services/intro');

// 3. Services Grid (reuses the How We Help service card component)
get_template_part('template-parts/sections/services/services-grid');

// 4. Process (reuses the Reality Check™ Process component)
get_template_part('template-parts/sections/services/process');

// 5. Why Choose DownSide Up (reuses the Core Principles component)
get_template_part('template-parts/sections/services/why-choose');

// 6. Who We Help (reuses the About page audience/persona card component)
get_template_part('template-parts/sections/services/who-we-help');

// 7. Comparison (reuses the Methodology Comparison component)
get_template_part('template-parts/sections/services/comparison');

// 8. FAQ (reuses the FAQ accordion component)
get_template_part('template-parts/sections/services/faq');

// 9. Final CTA — reuses the existing single-persona CTA card as-is
// (template-parts/cta/cta-card.php via downside_up_cta()). The
// "resource-discovery" persona already reads "Take the Assessment" for
// its primary button and links to a consultation via its secondary
// link, matching this section's brief without a new CTA implementation.
downside_up_cta('resource-discovery');

get_footer();
