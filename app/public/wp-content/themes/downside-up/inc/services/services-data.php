<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Data functions for the Services page (templates/template-services.php).
 *
 * Same convention as inc/hero.php / inc/how-it-works-data.php / the
 * about-page data files: hardcoded defaults render a complete page with
 * zero CMS content entered; ACF field values (if ACF is active and
 * populated) override them in place. Nothing here is invented outside
 * that pattern — every section reuses an existing template part and its
 * existing data shape.
 */

/**
 * Services page hero.
 * Consumed by template-parts/heroes/hero-services.php.
 */
function downside_up_get_services_hero_data()
{
    $defaults = [
        'eyebrow'              => __('Our Services', 'downside-up'),
        'headline_line1'       => __('Financial Guidance Built Around', 'downside-up'),
        'headline_emphasis'    => __('Your Life.', 'downside-up'),
        'description'          => __('At DownSide Up, we believe true financial planning starts with understanding the nuances of your situation. No cookie-cutter portfolios — just deliberate strategies built for resilience.', 'downside-up'),
        'primary_button_text'  => __('Explore Your Financial Profile', 'downside-up'),
        'primary_button_url'   => home_url('/quiz/'),
        'secondary_button_text'=> __('Book a Consultation', 'downside-up'),
        'secondary_button_url' => home_url('/consultation/'),
        'image_url'            => get_template_directory_uri() . '/assets/images/Editorial story.jpg',
        'image_alt'            => __('An advisor and client reviewing a financial plan together at a consultation table.', 'downside-up'),
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_services_hero_data', $defaults);
    }

    $overrides = [
        'eyebrow'              => get_field('services_hero_eyebrow'),
        'headline_line1'       => get_field('services_hero_headline_line1'),
        'headline_emphasis'    => get_field('services_hero_headline_emphasis'),
        'description'          => get_field('services_hero_description'),
        'primary_button_text'  => get_field('services_hero_primary_button_text'),
        'primary_button_url'   => get_field('services_hero_primary_button_url'),
        'secondary_button_text'=> get_field('services_hero_secondary_button_text'),
        'secondary_button_url' => get_field('services_hero_secondary_button_url'),
        'image_alt'            => get_field('services_hero_image_alt'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    if (get_field('services_hero_image')) {
        $defaults['image_url'] = get_field('services_hero_image')['url'];
    }

    return apply_filters('downside_up_services_hero_data', $defaults);
}

/**
 * Introduction section — reuses the Three Pillars visual language
 * (.du-pillars / .du-pillar-card in _how-it-works.css) for the three
 * supporting highlight items.
 * Consumed by template-parts/sections/services/intro.php.
 */
function downside_up_get_services_intro_data()
{
    $defaults = [
        'eyebrow'     => __('Advice That Meets You Where You Are', 'downside-up'),
        'heading'     => __('A Different Kind of Financial Partner', 'downside-up'),
        'description' => __("We recognise that every financial journey is distinct. Whether you're navigating complex estate laws, planning for an early retirement, or simply looking to build a robust safety net, our approach is calibrated to your specific coordinates — not a one-size-fits-all script.", 'downside-up'),
        'highlights'  => [
            [
                'icon'        => 'compass',
                'title'       => __('Calibrated to You', 'downside-up'),
                'description' => __('Every recommendation is shaped by your goals, timeline, and risk appetite — not a generic template.', 'downside-up'),
            ],
            [
                'icon'        => 'shield-check',
                'title'       => __('Downside-First Thinking', 'downside-up'),
                'description' => __('We plan for resilience first, so growth is built on a foundation that can withstand shocks.', 'downside-up'),
            ],
            [
                'icon'        => 'heart-handshake',
                'title'       => __('A Real Advisor Relationship', 'downside-up'),
                'description' => __('Every plan is backed by a human advisor you can talk to, not just an algorithm.', 'downside-up'),
            ],
        ],
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_services_intro_data', $defaults);
    }

    $overrides = [
        'eyebrow'     => get_field('services_intro_eyebrow'),
        'heading'     => get_field('services_intro_heading'),
        'description' => get_field('services_intro_description'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    if (have_rows('services_intro_highlights')) {
        $highlights = [];
        while (have_rows('services_intro_highlights')) {
            the_row();
            $highlights[] = [
                'icon'        => get_sub_field('icon'),
                'title'       => get_sub_field('title'),
                'description' => get_sub_field('description'),
            ];
        }
        if (!empty($highlights)) {
            $defaults['highlights'] = $highlights;
        }
    }

    return apply_filters('downside_up_services_intro_data', $defaults);
}

/**
 * Services grid — reuses the "How We Help" service-card component
 * (.du-help-card in _how-we-help.css), the same card already linked to
 * from the homepage teaser (see inc/how-we-help.php). Anchors below use
 * the six services named in the approved content architecture, and match
 * the anchors the homepage teaser links out to (inc/how-we-help.php was
 * updated alongside this file so all six links resolve).
 */
function downside_up_get_services_grid_data()
{
    $defaults = [
        'eyebrow'     => __('What We Offer', 'downside-up'),
        'heading'     => __('Services Built Around Outcomes', 'downside-up'),
        'description' => __('Six areas of focus, each designed to move you closer to a specific financial outcome.', 'downside-up'),
        'services'    => [
            [
                'title'       => __('Financial Planning', 'downside-up'),
                'description' => __('A comprehensive roadmap that puts every asset to work toward your long-term goals, so decisions get easier, not harder.', 'downside-up'),
                'icon'        => 'compass',
                'anchor'      => 'financial-planning',
            ],
            [
                'title'       => __('Investment Guidance', 'downside-up'),
                'description' => __('Evidence-based portfolio construction designed to weather market volatility while capturing long-term growth.', 'downside-up'),
                'icon'        => 'trending-up',
                'anchor'      => 'investment-guidance',
            ],
            [
                'title'       => __('Retirement Planning', 'downside-up'),
                'description' => __('A reliable, sustainable income strategy so retirement feels like a transition, not a cliff edge.', 'downside-up'),
                'icon'        => 'sunrise',
                'anchor'      => 'retirement-planning',
            ],
            [
                'title'       => __('Debt Management', 'downside-up'),
                'description' => __('Structured consolidation and repayment plans that free up cash flow and reduce the weight of outstanding liabilities.', 'downside-up'),
                'icon'        => 'trending-down',
                'anchor'      => 'debt-management',
            ],
            [
                'title'       => __('Wealth Preservation', 'downside-up'),
                'description' => __('Protecting what you have built with strategies that guard against inflation, risk, and unnecessary erosion.', 'downside-up'),
                'icon'        => 'shield-check',
                'anchor'      => 'wealth-preservation',
            ],
            [
                'title'       => __('Estate Planning', 'downside-up'),
                'description' => __('A clear, legally sound plan for transferring what you\'ve built to the people and causes that matter most.', 'downside-up'),
                'icon'        => 'book-open',
                'anchor'      => 'estate-planning',
            ],
        ],
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_services_grid_data', $defaults);
    }

    $overrides = [
        'eyebrow'     => get_field('services_grid_eyebrow'),
        'heading'     => get_field('services_grid_heading'),
        'description' => get_field('services_grid_description'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    if (have_rows('services_grid_items')) {
        $services = [];
        while (have_rows('services_grid_items')) {
            the_row();
            $services[] = [
                'title'       => get_sub_field('title'),
                'description' => get_sub_field('description'),
                'icon'        => get_sub_field('icon'),
                'anchor'      => get_sub_field('anchor'),
            ];
        }
        if (!empty($services)) {
            $defaults['services'] = $services;
        }
    }

    return apply_filters('downside_up_services_grid_data', $defaults);
}

/**
 * Process section — reuses the Reality Check™ Process component
 * (.du-rcp in about-page/_reality-check-process.css), same tracker +
 * card shape (number, icon, title, tag, description) and closing note.
 * Consumed by template-parts/sections/services/process.php.
 */
function downside_up_get_services_process_data()
{
    $defaults = [
        'eyebrow'     => __('How It Works', 'downside-up'),
        'heading'     => __('From First Question to a Working Plan', 'downside-up'),
        'description' => __("A structured path, start to finish.\nNo step is skipped, and nothing moves faster than you're ready for.", 'downside-up'),

        'note' => [
            'quote' => __("You're never handed a plan\nyou don't understand.", 'downside-up'),
            'copy'  => __('Every step builds on the last, so by the time you meet an advisor, the plan already reflects your reality.', 'downside-up'),
            'icon'  => 'reality-check',
        ],

        'steps' => [
            [
                'number'      => '01',
                'icon'        => 'compass',
                'title'       => __('Understand Your Situation', 'downside-up'),
                'tag'         => __('Where You Stand', 'downside-up'),
                'description' => __('We start with a conversation about your current finances, goals, and what "financial security" actually means to you.', 'downside-up'),
            ],
            [
                'number'      => '02',
                'icon'        => 'clipboard-list',
                'title'       => __('Complete the Assessment', 'downside-up'),
                'tag'         => __('The Reality Check™', 'downside-up'),
                'description' => __('A guided evaluation of your financial behaviour, decisions, and life context — not a generic quiz.', 'downside-up'),
            ],
            [
                'number'      => '03',
                'icon'        => 'lightbulb',
                'title'       => __('Receive Personalized Insights', 'downside-up'),
                'tag'         => __('Your Results', 'downside-up'),
                'description' => __('A clear breakdown of your strengths, blind spots, and the factors shaping your financial future.', 'downside-up'),
            ],
            [
                'number'      => '04',
                'icon'        => 'users',
                'title'       => __('Meet an Advisor', 'downside-up'),
                'tag'         => __('A Real Conversation', 'downside-up'),
                'description' => __('Walk through your results with an advisor who asks questions before offering answers.', 'downside-up'),
            ],
            [
                'number'      => '05',
                'icon'        => 'rocket',
                'title'       => __('Build Your Financial Plan', 'downside-up'),
                'tag'         => __('The Path Forward', 'downside-up'),
                'description' => __('A concrete plan with clear next steps, revisited as your life and goals change.', 'downside-up'),
            ],
        ],
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_services_process_data', $defaults);
    }

    $overrides = [
        'eyebrow'     => get_field('services_process_eyebrow'),
        'heading'     => get_field('services_process_heading'),
        'description' => get_field('services_process_description'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    if (have_rows('services_process_steps')) {
        $steps = [];
        while (have_rows('services_process_steps')) {
            the_row();
            $steps[] = [
                'number'      => get_sub_field('number'),
                'icon'        => get_sub_field('icon'),
                'title'       => get_sub_field('title'),
                'tag'         => get_sub_field('tag'),
                'description' => get_sub_field('description'),
            ];
        }
        if (!empty($steps)) {
            $defaults['steps'] = $steps;
        }
    }

    return apply_filters('downside_up_services_process_data', $defaults);
}

/**
 * Why Choose DownSide Up — reuses the Core Principles card component
 * (.du-principles / .du-principle-card in about-page/_principles-grid.css).
 * Consumed by template-parts/sections/services/why-choose.php.
 */
function downside_up_get_services_why_choose_data()
{
    $defaults = [
        'heading'     => __('Why Choose DownSide Up', 'downside-up'),
        'description' => __('The same four commitments behind every service on this page.', 'downside-up'),
        'items'       => [
            [
                'icon'        => 'compass',
                'title'       => __('Personalized Guidance', 'downside-up'),
                'description' => __('Every recommendation starts with your specific situation, not a standard template.', 'downside-up'),
            ],
            [
                'icon'        => 'calendar',
                'title'       => __('Long-Term Planning', 'downside-up'),
                'description' => __('We plan in decades, not quarters, so today\'s decisions hold up over time.', 'downside-up'),
            ],
            [
                'icon'        => 'brain',
                'title'       => __('Evidence-Based Recommendations', 'downside-up'),
                'description' => __('Guidance grounded in data and rigorous analysis, not trends or guesswork.', 'downside-up'),
            ],
            [
                'icon'        => 'heart-handshake',
                'title'       => __('Human-Centered Advice', 'downside-up'),
                'description' => __('A real advisor who listens first, backed by tools that keep the plan honest.', 'downside-up'),
            ],
        ],
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_services_why_choose_data', $defaults);
    }

    $overrides = [
        'heading'     => get_field('services_why_choose_heading'),
        'description' => get_field('services_why_choose_description'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    if (have_rows('services_why_choose_items')) {
        $items = [];
        while (have_rows('services_why_choose_items')) {
            the_row();
            $items[] = [
                'icon'        => get_sub_field('icon'),
                'title'       => get_sub_field('title'),
                'description' => get_sub_field('description'),
            ];
        }
        if (!empty($items)) {
            $defaults['items'] = $items;
        }
    }

    return apply_filters('downside_up_services_why_choose_data', $defaults);
}

/**
 * Who We Help — reuses the audience/persona card component from the
 * About page (.du-who-we-help / .du-who-we-help-card in
 * about-page/_what-we-offer.css and downside_up_get_what_we_offer()'s
 * data shape). Extends that same six-persona list with "Retirees" per
 * this page's approved content architecture, without changing the
 * shared About-page data function or its output.
 * Consumed by template-parts/sections/services/who-we-help.php.
 */
function downside_up_get_services_who_we_help_data()
{
    $defaults = [
        'eyebrow'     => __("Who It's For", 'downside-up'),
        'heading'     => __('Who We Help', 'downside-up'),
        'description' => __('Every financial journey is unique. We meet you where you are and help you move forward with clarity and confidence.', 'downside-up'),
        'footer_icon' => 'users',
        'footer_text' => __('Different stages. Different challenges. One partner committed to your financial clarity.', 'downside-up'),
        'items'       => array_merge(
            function_exists('downside_up_get_what_we_offer') ? downside_up_get_what_we_offer() : [],
            [
                [
                    'label'       => __('Retirees', 'downside-up'),
                    'title'       => __('Confident Continuity', 'downside-up'),
                    'intro'       => __('Making a lifetime of savings last, without second-guessing every withdrawal.', 'downside-up'),
                    'focus_label' => __('Primary Focus', 'downside-up'),
                    'focus'       => __('Sustainable income and peace of mind through every stage of retirement.', 'downside-up'),
                    'icon'        => 'sunrise',
                ],
            ]
        ),
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_services_who_we_help_data', $defaults);
    }

    $overrides = [
        'eyebrow'     => get_field('services_who_we_help_eyebrow'),
        'heading'     => get_field('services_who_we_help_heading'),
        'description' => get_field('services_who_we_help_description'),
        'footer_text' => get_field('services_who_we_help_footer_text'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_services_who_we_help_data', $defaults);
}

/**
 * Comparison — reuses the Methodology Comparison component
 * (.du-comparison / .du-compare-card in _how-it-works.css), with two
 * columns (Traditional Advice vs DownSide Up) instead of three.
 * Consumed by template-parts/sections/services/comparison.php.
 */
function downside_up_get_services_comparison_data()
{
    $defaults = [
        'eyebrow'     => __('A Different Approach', 'downside-up'),
        'heading'     => __('Traditional Advice vs. DownSide Up', 'downside-up'),
        'description' => __('The same underlying goal — a secure financial future — reached through a more transparent process.', 'downside-up'),
        'columns'     => [
            [
                'id'        => 'traditional',
                'title'     => __('Traditional Advice', 'downside-up'),
                'icon'      => 'users',
                'highlight' => false,
                'features'  => [
                    __('Advice built around standard products', 'downside-up'),
                    __('Periodic, calendar-based check-ins', 'downside-up'),
                    __('Recommendations based on averages', 'downside-up'),
                    __('Fee structures that can be hard to compare', 'downside-up'),
                ],
            ],
            [
                'id'        => 'downside-up',
                'title'     => __('DownSide Up', 'downside-up'),
                'icon'      => 'reality-check',
                'highlight' => true,
                'tag'       => __('Our Approach', 'downside-up'),
                'features'  => [
                    __('Advice built around your specific situation', 'downside-up'),
                    __('An assessment-led starting point, not a sales pitch', 'downside-up'),
                    __('Recommendations grounded in your own data', 'downside-up'),
                    __('A clear, upfront view of fees and next steps', 'downside-up'),
                ],
            ],
        ],
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_services_comparison_data', $defaults);
    }

    $overrides = [
        'eyebrow'     => get_field('services_compare_eyebrow'),
        'heading'     => get_field('services_compare_heading'),
        'description' => get_field('services_compare_description'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_services_comparison_data', $defaults);
}

/**
 * FAQ — reuses the FAQ Accordion component (.du-faq in
 * about-page/_faq-accordion.css and its faq-accordion.js behaviour).
 * Consumed by template-parts/sections/services/faq.php.
 */
function downside_up_get_services_faq_data()
{
    $defaults = [
        'eyebrow'     => __('Frequently Asked Questions', 'downside-up'),
        'heading'     => __('Questions About Our Services', 'downside-up'),
        'description' => __('A few common questions about how these services work together.', 'downside-up'),

        'support_note' => [
            'title' => __('Still deciding where to start?', 'downside-up'),
            'copy'  => __('The Reality Check™ assessment is the fastest way to find out.', 'downside-up'),
            'icon'  => 'reality-check',
        ],

        'items' => [
            [
                'question' => __('Do I need to choose a single service?', 'downside-up'),
                'answer'   => __("No. Most clients need a combination — for example, financial planning alongside investment guidance. Your advisor will recommend a combination based on your assessment results, not a single fixed package.", 'downside-up'),
            ],
            [
                'question' => __('How do I know which services apply to me?', 'downside-up'),
                'answer'   => __('Start with the Reality Check™ assessment. It highlights the areas that matter most for your situation, and your advisor uses those results to recommend a starting point.', 'downside-up'),
            ],
            [
                'question' => __('Can these services change as my life changes?', 'downside-up'),
                'answer'   => __('Yes. Plans are revisited as your circumstances change — a new job, marriage, a business, or retirement all shift which services matter most, and your plan moves with them.', 'downside-up'),
            ],
            [
                'question' => __('Do I need to be a current client to book a consultation?', 'downside-up'),
                'answer'   => __('No. A consultation is a low-commitment way to discuss your situation before deciding whether to move forward with any service.', 'downside-up'),
            ],
        ],
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_services_faq_data', $defaults);
    }

    $overrides = [
        'eyebrow'     => get_field('services_faq_eyebrow'),
        'heading'     => get_field('services_faq_heading'),
        'description' => get_field('services_faq_description'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    if (have_rows('services_faq_items')) {
        $items = [];
        while (have_rows('services_faq_items')) {
            the_row();
            $items[] = [
                'question' => get_sub_field('question'),
                'answer'   => get_sub_field('answer'),
            ];
        }
        if (!empty($items)) {
            $defaults['items'] = $items;
        }
    }

    return apply_filters('downside_up_services_faq_data', $defaults);
}
