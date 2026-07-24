<?php
/**
 * Site branding — uploaded logo (Appearance > Customize > Site Identity)
 * stacked above the "DownSide Up" wordmark, links home.
 */
?>
<div class="du-site-branding">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="du-site-branding__link" rel="home">
        <?php $du_logo = downside_up_logo_image(['class' => 'du-site-branding__image']); ?>
        <?php if ($du_logo) : ?>
            <span class="du-site-branding__image-wrap"><?php echo $du_logo; ?></span>
        <?php endif; ?>
        <span class="du-site-branding__logo">DownSide Up</span>
    </a>
</div>
