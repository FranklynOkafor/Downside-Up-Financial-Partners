<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="du-header">
    <div class="du-header__inner du-container">
        <?php get_template_part('template-parts/header/site-branding'); ?>
        <?php get_template_part('template-parts/header/navigation'); ?>
    </div>
</header>
