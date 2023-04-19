<?php

//Exit if Directly accessed

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Template Name: Offer Page Template
 *
 * Handles to show offer Page Content
 * @since X Centrum 1.0
 **/

get_header();
// Loop Start Here
while (have_posts()): the_post();
	// Include the Offer Page Content template.
	get_template_part('page-contents/content', 'offer');
endwhile; //end of while
get_footer();?>