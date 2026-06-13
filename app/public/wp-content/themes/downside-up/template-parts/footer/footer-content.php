<div class="footer-grid">
    <div class="footer-brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-branding__link" rel="home">
            <?php bloginfo('name'); ?>
        </a>
        <p><?php esc_html_e('Elite financial intelligence and high-end wealth hospitality for the modern era.', 'downside-up'); ?></p>
    </div>

    <div class="footer-col">
        <h4><?php esc_html_e('Solutions', 'downside-up'); ?></h4>
        <ul>
            <li><a href="<?php echo esc_url(home_url('/services#financial-planning')); ?>"><?php esc_html_e('Financial Planning', 'downside-up'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/services#retirement')); ?>"><?php esc_html_e('Retirement Strategy', 'downside-up'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/services#tax-optimization')); ?>"><?php esc_html_e('Tax Optimization', 'downside-up'); ?></a></li>
        </ul>
    </div>

    <div class="footer-col">
        <h4><?php esc_html_e('Company', 'downside-up'); ?></h4>
        <ul>
            <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('About Us', 'downside-up'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Contact Us', 'downside-up'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/careers')); ?>"><?php esc_html_e('Careers', 'downside-up'); ?></a></li>
        </ul>
    </div>

    <div class="footer-col">
        <h4><?php esc_html_e('Legal', 'downside-up'); ?></h4>
        <ul>
            <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>"><?php esc_html_e('Privacy Policy', 'downside-up'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/terms-of-service')); ?>"><?php esc_html_e('Terms of Service', 'downside-up'); ?></a></li>
        </ul>
    </div>
</div>

<div class="footer-bottom">
    <p>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?> Financial Partners. All rights reserved.</p>
</div>
