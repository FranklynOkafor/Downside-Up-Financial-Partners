<?php
$downside_up_partners = ['Stark', 'Merrill', 'Vanguard', 'Citadel', 'Bridgewater'];
?>

<section class="trust-signals">
    <div class="container">
        <p class="trust-signals__label">
            <?php esc_html_e('Trusted by Global Institutional Partners', 'downside-up'); ?>
        </p>

        <ul class="trust-signals__list">
            <?php foreach ($downside_up_partners as $partner) : ?>
                <li><?php echo esc_html($partner); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
