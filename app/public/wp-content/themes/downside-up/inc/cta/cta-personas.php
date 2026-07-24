<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * CTA persona content.
 *
 * Pure data — no markup, no logic. Add a new persona by adding a new
 * array entry here; template-parts/cta/cta-card.php and cta-carousel.php
 * pick it up automatically, no template changes needed.
 *
 * Key = persona slug, also used to build the assessment URL
 * (?persona=<slug>) so the assessment engine can branch by persona later.
 */
return [

    'university-student' => [
        'label'           => __('University Student', 'downside-up'),
        'headline'        => __('Everyone Starts Somewhere. Start with Confidence.', 'downside-up'),
        'description'     => __("Whether you're managing your first allowance, earning from side hustles, or simply trying to understand money, building the right habits now can shape your financial future for years to come.", 'downside-up'),
        'button_text'     => __('Build Your Financial Foundation', 'downside-up'),
        'supporting_text' => __('Free assessment • Takes about 5 minutes • No financial knowledge required', 'downside-up'),
    ],

    'young-graduate' => [
        'label'           => __('Young Graduate', 'downside-up'),
        'headline'        => __('You\'ve Started Earning. Now Make Every Paycheck Count.', 'downside-up'),
        'description'     => __("Your first salary is more than income—it's the beginning of your financial future. Learn how to spend wisely, save consistently, and make informed decisions from the start.", 'downside-up'),
        'button_text'     => __('See Where Your Money Can Take You', 'downside-up'),
        'supporting_text' => __('Receive personalized recommendations based on your current financial situation.', 'downside-up'),
    ],

    'young-professional' => [
        'label'           => __('Young Professional', 'downside-up'),
        'headline'        => __("You're Earning More. Is Your Money Working Harder?", 'downside-up'),
        'description'     => __('Discover opportunities to grow your wealth, reduce financial stress, and make confident decisions that move you closer to your long-term goals.', 'downside-up'),
        'button_text'     => __('See Where You Stand', 'downside-up'),
        'supporting_text' => __('Free assessment • Personalized insights in minutes', 'downside-up'),
    ],

    'newly-married-couple' => [
        'label'           => __('Newly Married Couple', 'downside-up'),
        'headline'        => __("Build a Financial Future You're Both Excited About.", 'downside-up'),
        'description'     => __('Marriage brings shared dreams—and shared financial decisions. Create a plan together, manage your money with confidence, and prepare for the milestones ahead.', 'downside-up'),
        'button_text'     => __("Start Your Couple's Financial Assessment", 'downside-up'),
        'supporting_text' => __('Plan together • Build together • Grow together', 'downside-up'),
    ],

    'parent' => [
        'label'           => __('Parent', 'downside-up'),
        'headline'        => __('The Best Gift You Can Give Your Family Is Financial Security.', 'downside-up'),
        'description'     => __('From daily expenses to education, emergencies, and retirement, every financial decision you make affects the people who depend on you. Build a strategy that protects what matters most.', 'downside-up'),
        'button_text'     => __("Assess Your Family's Financial Health", 'downside-up'),
        'supporting_text' => __("Discover practical steps to strengthen your family's financial future.", 'downside-up'),
    ],

    'small-business-owner' => [
        'label'           => __('Small Business Owner', 'downside-up'),
        'headline'        => __('Your Business Deserves a Financial Strategy as Strong as Your Vision.', 'downside-up'),
        'description'     => __("Growing a business isn't just about increasing revenue—it's about making smart financial decisions that improve cash flow, reduce risk, and support long-term success.", 'downside-up'),
        'button_text'     => __('Evaluate Your Business Finances', 'downside-up'),
        'supporting_text' => __('Identify opportunities to build a healthier, more resilient business.', 'downside-up'),
    ],

    'pre-retiree' => [
        'label'           => __('Pre-Retiree', 'downside-up'),
        'headline'        => __('Retirement Is Too Important to Leave to Chance.', 'downside-up'),
        'description'     => __('Whether retirement is five years away or just around the corner, understanding where you stand today can help you retire with greater confidence and peace of mind.', 'downside-up'),
        'button_text'     => __('Check Your Retirement Readiness', 'downside-up'),
        'supporting_text' => __('Get a clearer picture of your financial preparedness and next steps.', 'downside-up'),
    ],

];
