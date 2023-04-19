<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Quest Audio
 * @since 1.0
 * @version 1.0
 */
/* 
Template Name: Services Archives
*/
get_header(); ?>

 <div id="main">
      <?php
      $banner_image = get_field('banner_image');
      $banner_title = get_field('banner_title');
      $banner_content = get_field('banner_content');
    ?>
    <?php if( isset($banner_image) && !empty($banner_image)) : ?>
      <div class="top-banner" style="background-image: url(<?php echo $banner_image; ?>);">
      <?php else: ?>
         <div class="top-banner" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/top-banner.jpg);">
      <?php endif; ?>
        <div class="wrap">
          <div class="top-banner-inner">
            <div class="section-title sal-animate" data-sal="slide-up" data-sal-duration="800">
              <?php if( isset($banner_title) && !empty($banner_title)) : ?>
              <h2><?php echo $banner_title; ?></h2>
              <?php endif; ?>
            </div>
            <?php if( isset($banner_content) && !empty($banner_content)) : ?>
            <p><?php echo $banner_content; ?></p>
              <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Services Sec Start -->
      <div class="services-sec section-row">
        <div class="wrap">
          <div class="service-block">
            <?php echo the_content(); ?>
            <div class="all-services" id="ajax-posts">
              <?php 
                $args = array(
    'post_type' => 'services',
    'post_status' => 'publish',
    'posts_per_page' => 6
);
$posts = new WP_Query( $args );
if ( $posts -> have_posts() ) {
    while ( $posts->have_posts() ) : $posts->the_post();
      ?>

        <div class="service-col">
                <div class="service-inner">
                  <figure>
                    <img src="<?php the_post_thumbnail_url() ?>" alt="video-service" width="383" height="198">
                  </figure>
                  <div class="inner">
                    <h5><?php the_title(); ?> <i class="<?php echo get_field('icon'); ?>"></i></h5>
                    <?php the_content(); ?>
                  </div>
                </div>
              </div>

   <?php  endwhile;
}
wp_reset_query();
              ?>

              

            </div>
            <div class="load-more-btn">
              <a href="#" id="more_posts" class="button btn-secondary btn-lg">Load More</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Services Sec End -->

     <div class="join-section">
            <div class="wrap">
                <div class="join-data" data-sal="slide-up" data-sal-duration="800">
                    <?php $join_text = get_field('join_text'); ?>
                  <?php if( isset($join_text) && !empty($join_text) ) : ?>
                    <h3><?php echo $join_text; ?></h3>
                  <?php endif; //endif ?>
                </div>
                <?php 
                $join_contact_text = get_field('join_contact_text');
                $join_contact_url = get_field('join_contact_url'); 
                $join_join_text = get_field('join_join_text'); 
                $join_join_url = get_field('join_join_url');  
                ?>
                <div class="join-btns" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
                     <?php if( isset($join_contact_text) && !empty($join_contact_text) && isset($join_contact_url) && !empty($join_contact_url) ) : ?>
                        <a href="<?php echo $join_contact_url; ?>" class="button btn-lg"><?php echo $join_contact_text; ?></a>
                     <?php endif; //endif ?>
                     <?php if( isset($join_join_text) && !empty($join_join_text) && isset($join_join_url) && !empty($join_join_url) ) : ?>
                        <a href="<?php echo $join_join_url; ?>" class="button btn-outline-white btn-lg"><?php echo $join_join_text; ?></a>
                     <?php endif; //endif ?>
                    
                    
                </div>
            </div>
        </div>
              <div class="testimonial-section section-row">
            <div class="wrap">
                <div class="section-title" data-sal="slide-up" data-sal-duration="800">
                     <?php $testimonials_title = get_field('testimonials_title'); ?>
                     <?php if( isset($testimonials_title) && !empty($testimonials_title) ) : ?>
                     <h2><?php echo $testimonials_title; ?></h2>
                     <?php endif; ?>
                </div>
                <div class="testimonial-slider owl-carousel" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
                 <?php $testimonials = get_field('testimonials'); ?>
                    <?php foreach ($testimonials as $key => $testimonial) { ?>
                        <div class="item">
                            <div class="test-box">
                                <i class="icon-quotation"></i>
                                <p><?php echo $testimonial['comment']; ?></p>
                                <div class="test-author">
                                    <div class="author-img">
                                        <img src="<?php echo $testimonial['image']; ?>" alt="">
                                    </div>
                                    <div class="author-box">
                                        <h5><?php echo $testimonial['name']; ?></h5>
                                        <p><?php echo $testimonial['position']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
    <!--/#main -->


<?php

get_footer();

