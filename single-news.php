<?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	Exit;
}

/**
 * The Template Used For Displaying News Details page Content
 *
 * @package WordPress
 * @subpackage X Centrum
 * @since X Centrum 1.0
 */
get_header();?>
?>

<div id="main">
<?php $news_detail_banner = get_field('news_detail_banner');?>
<?php if (isset($news_detail_banner) && !empty($news_detail_banner)): ?>
  <div class="service-page-banner service-detail-banner"
  style="background-image: url(<?php echo $news_detail_banner ?>);">
<?php endif;?>
</div>
<div class="newss-media-details-sec">
  <!-- service-detail-info-sec start -->
  <div class="service-detail-sec service-detail-info-sec">
    <div class="wrap">
      <div class="title-block" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <?php $service_date = get_field('service_date');?>
        <?php if (isset($service_date) && !empty($service_date)): ?>
        <span class="posted-date"><?php echo $service_date ?></span>
        <?php endif;?>
      <?php $service_title = get_field('service_title');?>
      <?php if (isset($service_title) && !empty($service_title)): ?>
        <h2><?php echo $service_title ?></h2>
        <?php endif;?>
      </div>
      <div class="service-detail-info-block">
        <div class="top-desc">
          <?php $service_info = get_field('service_info');?>
          <?php if (isset($service_info) && !empty($service_info)): ?>

            <?php echo $service_info ?>

           <?php endif;?>
        </div>
      </div>
    </div>
    <!--/.wrap-->
  </div>
  <!-- service-detail-info-sec end -->
  <!-- news-slider-sec start -->
  <div class="news-slider-sec">
    <div class="wrap">
      <div class="back-btn">
        <?php $back_btn = get_field('back_btn');?>
          <?php if (isset($back_btn) && !empty($back_btn)): ?>
        <a href="#" class="button btn-outline btn-sm"><?php echo $back_btn ?> <i class="icon-right-arrow"></i></a>
        <?php endif;?>
      </div>
      <div class="main-news-slider">
        <div class="news-slider owl-carousel">
          <?php $slider_img_box = get_field('slider_img_box');?>
            <?php foreach ($slider_img_box as $key => $slider_img) {?>
          <div class="item">
            <div class="news-slider-img">
              <img src="<?php echo $slider_img['news_img']; ?>" alt="news">
            </div>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
  <!-- news-slider-sec end -->
</div>

</div>
<!--/#main -->
<?php get_footer();?>