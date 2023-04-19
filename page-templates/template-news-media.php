<?php

//Exit if Directly accessed

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Template Name: News Media Page Template
 *
 * Handles to show news-media Page Content
 * @since X Centrum 1.0
 **/

get_header();
// Loop Start Here
while (have_posts()): the_post();
	// Include the News Media Page Content template.
	get_template_part('page-contents/content', 'news-media');
endwhile; //end of while
get_footer();?>