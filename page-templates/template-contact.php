<?php

//Exit if Directly accessed

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Template Name: Contact Page Template
 *
 * Handles to show contact Page Content
 * @since X Centrum 1.0
 **/

get_header();
// Loop Start Here
while (have_posts()): the_post();
	// Include the Contact Page Content template.
	get_template_part('page-contents/content', 'contact');
endwhile; //end of while
get_footer();?>