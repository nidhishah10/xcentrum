<?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	Exit;
}

/**
 * The Template Used For Displaying News Media page Content
 *
 * @package WordPress
 * @subpackage X Centrum
 * @since X Centrum 1.0
 */
?>
<div id="main">
  <!-- inner-top-head start -->
  <div class="news-title inner-top-head only-title">
    <div class="wrap">
      <div class="top-head-blocks">
        <div class="top-head-details" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
          <?php $news_title = get_field('news_title');?>
          <?php if (isset($news_title) && !empty($news_title)): ?>
          <h1><?php echo $news_title ?></h1>
        <?php endif;?>
        </div>
      </div>
    </div>
  </div>
  <!-- inner-top-head end -->

  <!-- title-para-sec start -->
  <div class="news-desc title-para-sec text-center" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
    <div class="wrap">
      <?php $news_info = get_field('news_info');?>
      <?php if (isset($news_info) && !empty($news_info)): ?>
      <p><?php echo $news_info ?></p>
      <?php endif;?>
    </div>
  </div>
  <!-- title-para-sec end -->

  <!-- news-inner-sec start -->
  <div class="news-inner-sec">
    <div class="wrap">
      <div class="news-inner-blocks">
                <?php
$args = array('post_type' => 'news', 'posts_per_page' => 4, 'order' => 'ASC');
$the_query = new WP_Query($args);
?>
<?php if ($the_query->have_posts()): ?>
              <?php while ($the_query->have_posts()): $the_query->the_post();?>
												        <div class="news-inner-block" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
												          <a href="<?php echo the_permalink(); ?>">
												            <figure>
												              <img src="<?php echo get_field('news_img'); ?>" alt="News">
												            </figure>
												          </a>
												          <div class="inner">
												            <a href="<?php echo the_permalink(); ?>">
												              <h3><?php the_title();?></h3>
												            </a>
												            <p><?php the_content();?>
												            </p>
												            <a href="<?php echo the_permalink(); ?>" class="button btn-outline btn-sm"><?php echo get_field('lees_more_btn'); ?></a>
												          </div>
												        </div>
												                    <?php endwhile;?>
                <?php endif;?>
<?php wp_reset_postdata();?>
      </div>
      <div class="pagination" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
       <?php

$big = 999999999; // need an unlikely integer
echo paginate_links(array(
	'base' => str_replace($big, '%#%', get_pagenum_link($big)),
	'format' => '?paged=%#%',
	'current' => max(1, get_query_var('paged')),
	'total' => $the_query->max_num_pages,
	'prev_text' => '<i class="icon-double-arrow"></i>',
	'next_text' => '<i class="icon-double-arrow"></i>',

));
wp_reset_query();
?>
      </div>
    </div>
  </div>
  <!-- news-inner-sec end -->

</div>
<!--/#main -->