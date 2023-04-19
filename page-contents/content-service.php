<?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	Exit;
}

/**
 * The Template Used For Displaying Service page Content
 *
 * @package WordPress
 * @subpackage X Centrum
 * @since X Centrum 1.0
 */
?>
<div id="main">
  <?php $service_page_banner = get_field('service_page_banner');?>
<?php if (isset($service_page_banner) && !empty($service_page_banner)): ?>
  <div class="service-page-banner" style="background-image: url(<?php echo $service_page_banner ?>);"></div>
<?php endif;?>
  <div class="service-detail-sec">
    <div class="wrap">
      <div class="title-block" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <?php $service_title = get_field('service_title');?>
        <?php if (isset($service_title) && !empty($service_title)): ?>
        <h2><?php echo $service_title ?></h2>
        <?php endif;?>
      </div>
      <div class="service-detail-row">
        <?php
$args = array('post_type' => 'cars', 'posts_per_page' => 10, 'order' => 'ASC');
$the_query = new WP_Query($args);
?>
<?php if ($the_query->have_posts()): ?>
              <?php while ($the_query->have_posts()): $the_query->the_post();?>
									        <div class="detail-block">
									          <figure data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
									            <img src="<?php echo get_field('service_img'); ?>" alt="Service">
									          </figure>
									          <div class="service-desc">
									            <div class="service-info" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
									              <h4><?php the_title();?></h4>
									              <p>
									                <?php the_content();?>
									              </p>
								          </div>
								        </div>
								      </div>
								    <?php endwhile;?>
                <?php endif;?>
<?php wp_reset_postdata();?>

      </div>
    </div><!--/.wrap-->
  </div>
  <!--service-detail-sec-->
  <div class="service-offer-sec">
    <div class="service-offer-row">
        <div class="offer-title-block">
          <?php $service_offer_title = get_field('service_offer_title');?>
        <?php if (isset($service_offer_title) && !empty($service_offer_title)): ?>
            <h3 data-sal="slide-up" data-sal-delay="50" data-sal-duration="800"><?php echo $service_offer_title ?></h3>
          <?php endif;?>
        </div>
        <div class="owl-carousel service-offer-slide">

            <?php $service_item = get_field('service_item');?>
            <?php foreach ($service_item as $key => $service) {?>
            <div class="item">
            <div class="service-offer-img">
                <img src="<?php echo $service['service_img']; ?>" alt="Car">
            </div>
            </div>
          <?php }?>
    </div>
  </div>
  <!--service-detail-sec-->
</div>
<!--/#main -->