<?php

//Exit if Directly accessed

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Template Name: Service Page Template
 *
 * Handles to show service Page Content
 * @since X Centrum 1.0
 **/

get_header();
// Loop Start Here
while (have_posts()): the_post();
	// Include the Service Page Content template.
	get_template_part('page-contents/content', 'service');
endwhile; //end of while
get_footer();?>