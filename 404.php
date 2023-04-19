<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Quest Audio
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area one-column">
        <div class="error-404 not-found">
            <div class="page-content">
                <h2><?php _e('Oops! That page can&rsquo;t be found.', 'endpoint-health'); ?></h2>
                <p><?php _e('It looks like nothing was found at this location.', 'endpoint-health'); ?></p>
                <p><a href="<?php echo home_url(); ?>" class="button btn-lg btn-hover"><?php _e('Go to Homepage','endpoint-health');?></a></p>
            </div><!-- .page-content -->
        </div><!-- .error-404 -->
    </div><!-- #primary -->
</div><!-- .wrap -->
</div>

<?php get_footer(); ?>