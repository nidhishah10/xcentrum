<?php

//Exit if Directly accessed

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Template Name: Offer Details Page Template
 *
 * Handles to show offer-details Page Content
 * @since X Centrum 1.0
 **/

get_header();
// Loop Start Here
while (have_posts()): the_post();
	// Include the offer Details Page Content template.
	get_template_part('page-contents/content', 'offer-details');
endwhile; //end of while
get_footer();?>