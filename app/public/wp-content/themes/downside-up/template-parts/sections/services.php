<?php
$downside_up_services = [
    [
        'icon'  => 'file-text',
        'title' => __('Financial Planning', 'downside-up'),
        'text'  => __('A holistic blueprint of your financial destiny, mapping every asset to a future purpose.', 'downside-up'),
        'link'  => home_url('/services#financial-planning'),
    ],
    [
        'icon'  => 'trending-up',
        'title' => __('Investment', 'downside-up'),
        'text'  => __('Data-driven portfolio construction leveraging global markets for sustainable alpha generation.', 'downside-up'),
        'link'  => home_url('/services#investment'),
    ],
    [
        'icon'  => 'scale',
        'title' => __('Debt Management', 'downside-up'),
        'text'  => __('Sophisticated restructuring techniques to transform liabilities into powerful leverage tools.', 'downside-up'),
        'link'  => home_url('/services#debt-management'),
    ],
    [
        'icon'  => 'sun',
        'title' => __('Retirement', 'downside-up'),
        'text'  => __('Securing your legacy with bulletproof tax-optimized income streams for total peace of mind.', 'downside-up'),
        'link'  => home_url('/services#retirement'),
    ],
];
?>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <h2><?php esc_html_e('Expertly Curated Strategies', 'downside-up'); ?></h2>
            <p><?php esc_html_e('Tailored financial architecture designed for wealth preservation and aggressive growth optimization.', 'downside-up'); ?></p>
        </div>

        <div class="grid grid--4">
            <?php foreach ($downside_up_services as $service) : ?>
                <article class="service-card">
                    <span class="icon-badge">
                        <?php downside_up_icon($service['icon']); ?>
                    </span>

                    <h3><?php echo esc_html($service['title']); ?></h3>
                    <p><?php echo esc_html($service['text']); ?></p>

                    <a href="<?php echo esc_url($service['link']); ?>" class="service-card__link">
                        <?php esc_html_e('Explore', 'downside-up'); ?>
                        <?php downside_up_icon('arrow-right'); ?>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
