<?php

/**
 * Hero Stat
 * Showing the main stat of Downside Up
 * 
 * Template Part for the hero-stat section
 */

$stats = [
    [
        'number' => '1500+',
        'text' => 'Financial Assesment Completed',
    ],
    [
        'number' => '95%',
        'text' => 'Client Report Greater Financial Confidence',
    ],
    [
        'number' => '₦800M',
        'text' => 'Assets Guided Through Strategic Plalanning ',
    ],
]; ?>

<div class="du-hero-stat-section">
    <div class="du-container">
        <div class="du-hero-stat">
            <?php

            foreach ($stats as $stat) { ?>
                <section class="stat-container">
                    <div class="icon">
                        
                    </div>
                    <div class="stat-content">
                        <p class="du-stat-number number"><?php echo $stat['number']; ?></p>
                        <p class="text"><?php echo $stat['text']; ?></p>
                    </div>
                    <div class="stat-progress">
                        <div class="bar">
                            <div class="fill"></div>
                        </div>
                    </div>
                </section>
            <?php } ?>
        </div>
    </div>
</div>