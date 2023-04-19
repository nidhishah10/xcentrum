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
<?php $service_banner_img = get_field('service_banner_img');?>
<?php if (isset($service_banner_img) && !empty($service_banner_img)): ?>
<div class="service-page-banner service-detail-banner"style="background-image: url(<?php echo $service_banner_img ?>);">
<?php endif;?>
<div class="detail-banner-row">
<?php $banner_title = get_field('banner_title');?>
<?php if (isset($banner_title) && !empty($banner_title)): ?>
  <h1><?php echo $banner_title ?></h1>
<?php endif;?>
</div>
</div>
<!-- service-detail-info-sec start -->
<div class="service-detail-sec service-detail-info-sec">
  <div class="wrap">
    <div class="title-block" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
      <?php $block_title = get_field('block_title');?>
      <?php if (isset($block_title) && !empty($block_title)): ?>
      <h2><?php echo $block_title ?></h2>
      <?php endif;?>
    </div>
    <div class="service-detail-info-block">
      <div class="top-desc">
      <?php $service_detail_block = get_field('service_detail_block');?>
      <?php if (isset($service_detail_block) && !empty($service_detail_block)): ?>
        <p>
          <?php echo $service_detail_block ?>
        </p>
      <?php endif;?>
      <?php $inner_car_img = get_field('inner_car_img');?>
      <?php if (isset($inner_car_img) && !empty($inner_car_img)): ?>
        <img src="<?php echo $inner_car_img ?>" alt="car" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
      <?php endif;?>
      <?php $service_detail_block1 = get_field('service_detail_block1');?>
      <?php if (isset($service_detail_block1) && !empty($service_detail_block1)): ?>
        <p>
         <?php echo $service_detail_block1 ?>
        </p>
      <?php endif;?>
      </div>
    </div>
  </div>
  <!--/.wrap-->
</div>
<!-- service-detail-info-sec end -->

<?php get_footer();?>