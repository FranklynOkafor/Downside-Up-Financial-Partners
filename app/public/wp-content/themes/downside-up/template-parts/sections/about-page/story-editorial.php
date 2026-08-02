<?php
/**
 * About page — Story section.
 * Loaded via: get_template_part( 'template-parts/sections/about-page/story-editorial' );
 *
 * Positioned directly after the About hero. The hero answered "What do we
 * believe?"; this section answers "Why do we believe it?" — editorial
 * long-form copy, two paragraphs, image on the left.
 *
 * Layout: two-column, image left / text right.
 * Mirrors the editorial language of the About hero (same eyebrow treatment,
 * same serif heading, same generous whitespace philosophy).
 *
 * Content is managed via downside_up_get_story_data() in inc/hero.php.
 * Swap to ACF fields later without touching this file.
 */

$du_story = downside_up_get_story_data();

if ( empty( $du_story ) ) {
    return;
}
?>
<section class="du-story" aria-labelledby="du-story-heading" data-du-reveal-section>
    <div class="du-story__inner du-container">

        <div class="du-story__media" data-du-reveal-item>
            <img
                src="<?php echo esc_url( $du_story['image_url'] ); ?>"
                alt="<?php echo esc_attr( $du_story['image_alt'] ); ?>"
                class="du-story__image"
                loading="lazy"
                decoding="async"
                width="900"
                height="1200"
            >
        </div>

        <div class="du-story__content" data-du-reveal-item>

            <?php if ( ! empty( $du_story['eyebrow'] ) ) : ?>
                <p class="du-story__eyebrow du-text-label-caps">
                    <?php echo esc_html( $du_story['eyebrow'] ); ?>
                </p>
            <?php endif; ?>

            <h2 id="du-story-heading" class="du-story__heading du-text-headline-xl">
                <?php echo esc_html( $du_story['heading'] ); ?>
            </h2>

            <?php if ( ! empty( $du_story['paragraphs'] ) && is_array( $du_story['paragraphs'] ) ) : ?>
                <div class="du-story__body">
                    <?php foreach ( $du_story['paragraphs'] as $du_paragraph ) : ?>
                        <p class="du-story__paragraph du-text-body-md">
                            <?php echo esc_html( $du_paragraph ); ?>
                        </p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>
