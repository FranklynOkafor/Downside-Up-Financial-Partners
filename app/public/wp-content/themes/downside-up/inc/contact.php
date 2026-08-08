<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Contact Us page — data + configuration.
 *
 * Companion to:
 *   templates/template-contact.php
 *   template-parts/heroes/hero-contact.php
 *   template-parts/contact/contact-form.php
 *   template-parts/contact/operational-flow.php
 *   template-parts/contact/discovery-call.php
 *   inc/contact-form-handler.php
 *
 * Follows the same "pure data, ACF-optional, apply_filters at the end"
 * pattern already used by inc/hero.php, inc/hero-stats.php and
 * inc/cta/cta-personas.php — nothing persona/page specific is hardcoded
 * into templates, so content can change without touching markup.
 */

/**
 * "Our Presence" hero/intro section — eyebrow, headline, description and
 * the two physical hubs listed under it.
 */
function downside_up_get_hero_contact_data()
{
    $defaults = [
        'eyebrow'     => __('Our Presence', 'downside-up'),
        'headline'    => __('Where analytical rigor meets global accessibility.', 'downside-up'),
        'description' => __('Interpretation beats calculation. We have anchored our physical presence in hubs that reflect our commitment to clarity and narrative flow.', 'downside-up'),
        'locations'   => [
            [
                'name'    => __('London Principal Hub', 'downside-up'),
                'address' => __('22 Bishopsgate, London EC2N 4BQ', 'downside-up'),
            ],
            [
                'name'    => __('New York Strategy Center', 'downside-up'),
                'address' => __('One Vanderbilt, New York, NY 10017', 'downside-up'),
            ],
        ],
        // Decorative "location visual" — no map API, no external image
        // request; see template-parts/heroes/hero-contact.php.
        'map_title'    => __('London Financial District team.', 'downside-up'),
        'map_status'   => __('System Online: Live Map', 'downside-up'),
        'map_markers'  => [
            ['label' => __('1. DownSide Up HQ — London Office', 'downside-up'), 'x' => 30, 'y' => 68, 'primary' => true],
            ['label' => __('2. Canary Wharf Hub', 'downside-up'), 'x' => 82, 'y' => 40],
            ['label' => __('3. Finsbury Square Office', 'downside-up'), 'x' => 55, 'y' => 22],
            ['label' => __('4. Holborn Center', 'downside-up'), 'x' => 22, 'y' => 40],
            ['label' => __('5. Aldgate East', 'downside-up'), 'x' => 70, 'y' => 62],
            ['label' => __('6. Monument Branch', 'downside-up'), 'x' => 60, 'y' => 78],
        ],
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_hero_contact_data', $defaults);
    }

    $overrides = [
        'eyebrow'     => get_field('contact_hero_eyebrow'),
        'headline'    => get_field('contact_hero_headline'),
        'description' => get_field('contact_hero_description'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_hero_contact_data', $defaults);
}

/**
 * "Area of Interest" <select> options for the Direct Inquiry form.
 *
 * Reuses the six services already defined by downside_up_get_services_grid_data()
 * (the project's single source of truth for the service/information
 * architecture — see inc/services/services-data.php) rather than
 * duplicating those labels here, then layers on the handful of
 * contact-specific categories the design calls for. Structured as a flat
 * value => label map so it's trivial to re-order, rename, or extend later
 * without touching contact-form.php.
 */
function downside_up_get_contact_interest_options()
{
    $options = [
        'institutional-risk-assessment' => __('Institutional Risk Assessment', 'downside-up'),
    ];

    if (function_exists('downside_up_get_services_grid_data')) {
        $services = downside_up_get_services_grid_data();

        if (!empty($services['services']) && is_array($services['services'])) {
            foreach ($services['services'] as $du_service) {
                if (empty($du_service['anchor']) || empty($du_service['title'])) {
                    continue;
                }
                $options[$du_service['anchor']] = $du_service['title'];
            }
        }
    }

    $options['media-press']     = __('Media & Press', 'downside-up');
    $options['careers']         = __('Careers', 'downside-up');
    $options['general-inquiry'] = __('General Inquiry', 'downside-up');

    return apply_filters('downside_up_contact_interest_options', $options);
}

/**
 * "Operational Flow" card — office hours table + global-support note.
 */
function downside_up_get_operational_flow_data()
{
    $defaults = [
        'heading' => __('Operational Flow', 'downside-up'),
        'rows'    => [
            [
                'label'   => __('Monday — Friday', 'downside-up'),
                'value'   => __('08:00 — 20:00', 'downside-up'),
                'reserved' => false,
            ],
            [
                'label'   => __('Saturday', 'downside-up'),
                'value'   => __('10:00 — 16:00', 'downside-up'),
                'reserved' => false,
            ],
            [
                'label'   => __('Sunday', 'downside-up'),
                'value'   => __('Reserved', 'downside-up'),
                'reserved' => true,
            ],
        ],
        'note' => __('Global Support: Our digital analysis engine operates 24/7/365 regardless of physical hub hours.', 'downside-up'),
    ];

    return apply_filters('downside_up_operational_flow_data', $defaults);
}

/**
 * "Discovery Call" card — dark CTA card offering a 15-minute intro call.
 *
 * button_url: the project has no dedicated calendar/booking integration
 * (no Calendly, no booking CPT — confirmed by inspection). The only real,
 * already-established "start a conversation" flow in the theme is the
 * assessment funnel used everywhere else (downside_up_cta_assessment_url(),
 * home_url('/quiz/')), so that's what this button links to for now rather
 * than a fabricated booking widget. Swap this filter to a real scheduling
 * URL (Calendly, Cal.com, HubSpot Meetings, etc.) as soon as one exists —
 * no template changes required.
 */
function downside_up_get_discovery_call_data()
{
    $default_url = function_exists('downside_up_cta_assessment_url')
        ? downside_up_cta_assessment_url('resource-discovery')
        : home_url('/quiz/');

    $defaults = [
        'heading'     => __('Discovery Call', 'downside-up'),
        'description' => __('Schedule a 15-minute introductory session with a Lead Advisor to map your objectives.', 'downside-up'),
        'availability_label' => __('Availability', 'downside-up'),
        'next_slot_label'    => __('Next: Today 14:00', 'downside-up'),
        'button_text' => __('Reserve Your Slot', 'downside-up'),
        'button_url'  => $default_url,
    ];

    return apply_filters('downside_up_discovery_call_data', $defaults);
}

/**
 * Admin/business recipient for contact-form notifications.
 *
 * Single, filterable source of truth — used by inc/contact-form-handler.php
 * only, never hardcoded a second time anywhere else in the theme. Defaults
 * to the site's own admin_email (Settings > General) since the project has
 * no dedicated "business email" option/field defined yet. To route
 * inquiries elsewhere, either change the WordPress admin email or hook:
 *
 *   add_filter( 'downside_up_contact_recipient_email', function () {
 *       return 'advisors@downsideup.example';
 *   } );
 */
function downside_up_contact_recipient_email()
{
    $email = get_option('admin_email');

    return apply_filters('downside_up_contact_recipient_email', $email);
}

/**
 * "From" address used for both the admin notification and the visitor
 * confirmation email. Never the visitor's own address (SPF/DMARC), and
 * never an invented domain — defaults to the same configured admin_email
 * used above, which is guaranteed to exist on any WordPress install.
 * Filter this once real SMTP sending infrastructure (WP Mail SMTP, etc.)
 * is configured with a dedicated no-reply address.
 */
function downside_up_contact_from_email()
{
    $email = get_option('admin_email');

    return apply_filters('downside_up_contact_from_email', $email);
}

/**
 * Display name paired with the From address above.
 */
function downside_up_contact_from_name()
{
    $name = get_bloginfo('name');

    if (empty($name)) {
        $name = 'DownSide Up';
    }

    return apply_filters('downside_up_contact_from_name', $name);
}
