<?php

//Exit if Directly accessed

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Template Name: News Details Page Template
 *
 * Handles to show news-details Page Content
 * @since X Centrum 1.0
 **/

get_header();
// Loop Start Here
while (have_posts()): the_post();
	// Include the News Details Page Content template.
	get_template_part('page-contents/content', 'news-details');
endwhile; //end of while
get_footer();?>