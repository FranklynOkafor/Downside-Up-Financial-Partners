<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns the data for the FAQ Accordion section.
 *
 * Each item contains:
 *   question — string (serif font style, clickable trigger)
 *   answer   — string (body copy style, revealed on expand)
 */
function downside_up_get_faq_data() {
    return [
        'eyebrow'     => 'Frequently Asked Questions',
        'heading'     => 'Questions Before You Begin',
        'description' => 'Some of the most common questions about our approach and the Reality Check™ assessment.',
        
        'support_note' => [
            'title' => 'Still have a question?',
            'copy'  => 'A conversation often begins with a single question.',
            'icon'  => 'reality-check', // using reality-check question mark or another helper icon
        ],

        'items' => [
            [
                'question' => 'What is the Reality Check™?',
                'answer'   => 'The Reality Check™ is a guided assessment designed to help you understand your current financial situation, behaviors, and priorities. It\'s not a product selector or sales tool—it\'s a clarity tool. We help you see the full picture before making any financial decisions.'
            ],
            [
                'question' => 'Who is the assessment designed for?',
                'answer'   => 'It is designed for anyone looking to build a clearer relationship with their money. The framework adapts to different stages of life, from university students and young professionals to newlyweds, parents, small business owners, and pre-retirees.'
            ],
            [
                'question' => 'Will I receive investment advice immediately?',
                'answer'   => 'No. The Reality Check™ focuses on understanding first. We believe that meaningful recommendations can only come after a complete picture of your financial behaviors, decisions, and life context has been established.'
            ],
            [
                'question' => 'How long does the assessment take?',
                'answer'   => 'Approximately five minutes. We emphasize thoughtful reflection over speed, giving you a chance to check in with your priorities rather than rushing through a form.'
            ],
            [
                'question' => 'What happens after I complete the assessment?',
                'answer'   => 'You will receive a personalized evaluation that highlights your strengths, blind spots, and the key factors shaping your financial future. If you find those insights valuable, you may choose to schedule a conversation for additional guidance. There is no obligation.'
            ],
            [
                'question' => 'Do I need to become a client?',
                'answer'   => 'No. The Reality Check™ is valuable on its own. Its primary purpose is to help you better understand your situation and make more confident decisions, whether you choose to partner with us or navigate the next steps independently.'
            ],
        ],
    ];
}
