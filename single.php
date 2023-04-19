<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Quest Audio
 * @since 1.0
 * @version 1.0
 */
get_header();?>

       <!-- latest-news-sec start -->
      <?php
$news_section_background = get_field('news_section_background');
$news_section_heading = get_field('news_section_heading');
$posts = get_field('news');
?>
       <?php if (!empty($news_section_background)): ?>
       <div class="latest-news-sec" style="background-image: url('<?php echo $news_section_background; ?>');">
       <?php else: ?>
        <div class="latest-news-sec" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/news-bg.jpg');">
        <?php endif; //endif ?>


        <div class="wrap">
          <div class="main-title text-white text-center" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
            <?php if (!empty($news_section_heading)): ?>
            <h2><?php echo $news_section_heading; ?></h2>
            <?php endif; //endif ?>
          </div>
          <div class="latest-news-blocks">
            <?php
//$posts = get_posts( $args );
foreach ($posts as $post): setup_postdata($post);?>
			                      <div class="news-block" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
			                    <a href="<?php the_permalink();?>">
			                      <figure>
			                        <img src="<?php the_post_thumbnail_url();?>" alt="news">
			                      </figure>
			                    </a>
			                    <div class="news-inner">
			                      <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			                      <p><?php the_content();?></p>
			                      <a href="<?php the_permalink();?>" class="read-more">Lees Meer <i class="icon-right-arrow"></i></a>
			                    </div>
			                    </div>
			                    <?php
	wp_reset_postdata();endforeach;
?>


          </div>
        </div>
      </div>
      <!-- latest-news-sec end -->

<?php get_footer();?>