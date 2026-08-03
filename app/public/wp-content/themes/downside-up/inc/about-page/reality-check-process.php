<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns the data for the Reality Check™ Process section.
 *
 * Each step contains:
 *   number      — zero-padded ordinal shown above the icon tracker ("01")
 *   icon        — key for downside_up_icon(), used in both the tracker row and the card
 *   title       — serif headline rendered inside the card
 *   tag         — short ALL-CAPS sub-label below the title (label-caps, gold)
 *   description — body copy for the card
 */
function downside_up_get_reality_check_process_data() {

    return [

        'heading'     => 'The Reality Check™ Process',
        'eyebrow'     => 'Our Process',
        'description' => "A smarter way to understand your financial life.\nEvery journey begins with clarity.",

        'note' => [
            'quote' => "This isn't about products.\nIt's about perspective.",
            'copy'  => 'The Reality Check™ Process is built to help you see what matters most—so every recommendation we make is focused on your life, not our agenda.',
            'icon'  => 'star',
        ],

        'steps' => [
            [
                'number'      => '01',
                'icon'        => 'book-open',
                'title'       => 'Learn',
                'tag'         => 'Build Knowledge',
                'description' => 'Explore practical insights, financial frameworks, and real-world guidance designed to help you make sense of your financial world.',
            ],
            [
                'number'      => '02',
                'icon'        => 'clipboard-list',
                'title'       => 'Assess',
                'tag'         => 'Understand Your Reality',
                'description' => 'Take the Reality Check™ assessment. It\'s not a quiz—it\'s a deep evaluation of your financial behavior, decisions, and life context.',
            ],
            [
                'number'      => '03',
                'icon'        => 'lightbulb',
                'title'       => 'Understand',
                'tag'         => 'Receive Clarity',
                'description' => 'Get a personalized evaluation that highlights your strengths, blind spots, and the key factors shaping your financial future.',
            ],
            [
                'number'      => '04',
                'icon'        => 'calendar',
                'title'       => 'Book',
                'tag'         => 'Take the Next Step',
                'description' => 'Schedule a consultation to discuss your results, ask the right questions, and build a plan tailored to your goals.',
            ],
        ],

    ];

}
