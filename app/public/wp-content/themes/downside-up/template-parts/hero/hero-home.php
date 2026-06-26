<section class="hero">
	<div class="container hero__inner">
		<div class="hero__content">
			<p class="eyebrow"><?php esc_html_e('The Private Office Experience', 'downside-up'); ?></p>

			<h1><?php esc_html_e('Redefining Wealth with Precision', 'downside-up'); ?></h1>

			<p class="hero__lead">
				<?php esc_html_e('At Downside Up, we merge elite financial intelligence with high-end hospitality. Your capital deserves more than management—it requires a sanctuary of strategy.', 'downside-up'); ?>
			</p>

			<div class="hero__actions">
				<a href="<?php echo esc_url(home_url('/start-assessment')); ?>" class="btn btn--primary">
					<?php esc_html_e('Start Assessment', 'downside-up'); ?>
				</a>
				<a href="<?php echo esc_url(home_url('/services')); ?>" class="btn btn--outline">
					<?php esc_html_e('Our Services', 'downside-up'); ?>
				</a>
			</div>
		</div>

		<div class="hero__visual" role="img" aria-label="<?php esc_attr_e('A private office overlooking the city skyline at dusk', 'downside-up'); ?>">
			<?php
			/**
			 * TODO: Swap this placeholder gradient for a real photo once one
			 * has been uploaded to the Media Library, e.g.:
			 *
			 * <?php echo wp_get_attachment_image( get_theme_mod( 'hero_image_id' ), 'large' ); ?>
			 * or an ACF image field once Phase 2 ACF setup is complete.
			 */
			?>
		</div>
	</div>
</section>