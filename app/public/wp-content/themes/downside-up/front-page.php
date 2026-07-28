<?php get_header(); ?>

<?php

//Hero Section
get_template_part('template-parts/heroes/hero', 'home');

// Wealth Info Section
get_template_part('template-parts/sections/wealth-info');

// Hero Stat
get_template_part('template-parts/sections/hero-stat');

// Testimonials Section
get_template_part('template-parts/sections/testimonials');

// CTA Carousel – 4 personas (will use inc/cta/cta-personas.php)
downside_up_cta();
?>

<?php get_footer(); ?>
