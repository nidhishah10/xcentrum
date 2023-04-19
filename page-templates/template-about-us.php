<?php

//Exit if Directly accessed

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Template Name: About Us Page Template
 *
 * Handles to show about-us Page Content
 * @since X Centrum 1.0
 **/

get_header();
// Loop Start Here
while (have_posts()): the_post();
	// Include the About Us Page Content template.
	get_template_part('page-contents/content', 'about-us');
endwhile; //end of while
get_footer();?>