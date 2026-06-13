<?php
$downside_up_features = [
    [
        'icon'  => 'shield-check',
        'title' => __('Authority', 'downside-up'),
        'text'  => __('Our advisors are veterans of high-stakes finance, bringing decadal experience to every single interaction.', 'downside-up'),
    ],
    [
        'icon'  => 'eye',
        'title' => __('Clarity', 'downside-up'),
        'text'  => __('We strip away the jargon to provide crystal-clear insights that empower you to make decisive actions.', 'downside-up'),
    ],
    [
        'icon'  => 'sparkles',
        'title' => __('Simplicity', 'downside-up'),
        'text'  => __('Complex wealth management made effortless. We handle the mechanics while you focus on the vision.', 'downside-up'),
    ],
];
?>

<section class="section section--alt">
    <div class="container">
        <div class="grid grid--3">
            <?php foreach ($downside_up_features as $feature) : ?>
                <div class="feature">
                    <span class="icon--lg">
                        <?php downside_up_icon($feature['icon']); ?>
                    </span>

                    <h3><?php echo esc_html($feature['title']); ?></h3>
                    <p><?php echo esc_html($feature['text']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>