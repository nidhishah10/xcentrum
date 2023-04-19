<?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	Exit;
}

/**
 * The Template Used For Displaying Service Details page Content
 *
 * @package WordPress
 * @subpackage X Centrum
 * @since X Centrum 1.0
 */
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

<!-- contact-sec start -->
<?php $contact_banner_img = get_field('contact_banner_img');?>
<?php if (isset($contact_banner_img) && !empty($contact_banner_img)): ?>
<div class="contact-sec" style="background-image: url(<?php echo $contact_banner_img ?>);">
<?php endif;?>
  <div class="wrap">
    <div class="contact-blocks">
      <div class="contact-details" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <?php $contact_title = get_field('contact_title');?>
        <?php if (isset($contact_title) && !empty($contact_title)): ?>
        <h2><?php echo $contact_title ?></h2>
        <?php endif;?>

        <?php $number = get_field('number');?>
        <?php if (isset($number) && !empty($number)): ?>
        <?php echo $number ?>
        <?php endif;?>
        <div class="add-con-sec">
          <div class="add-con-details">
        <?php $address = get_field('address');?>
        <?php if (isset($address) && !empty($address)): ?>
            <?php echo $address ?>
        <?php endif;?>
          </div>
          <div class="add-con-details">
        <?php $add_on_title = get_field('add_on_title');?>
        <?php if (isset($add_on_title) && !empty($add_on_title)): ?>
            <h5><?php echo $add_on_title ?></h5>
        <?php endif;?>
        <?php $phone_number = get_field('phone_number');?>
        <?php if (isset($phone_number) && !empty($phone_number)): ?>
            <a href="tel:0535743388" target="_blank"><?php echo $phone_number ?></a>
        <?php endif;?>
        <?php $email = get_field('email');?>
        <?php if (isset($email) && !empty($email)): ?>
            <a href="mailto:info@x-centrum.nl" target="_blank"><?php echo $email ?></a>
        <?php endif;?>
          </div>
        </div>
      </div>
      <div class="contact-form-sec">
        <div class="contact-details-form" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <?php $contact_form_title = get_field('contact_form_title');?>
        <?php if (isset($contact_form_title) && !empty($contact_form_title)): ?>
          <h2><?php echo $contact_form_title ?></h2>
          <?php endif;?>
         <!-- Contact Form Code Start -->
        <?php $contact_form_short_code = get_field('contact_form_short_code');?>
        <?php if (isset($contact_form_short_code) && !empty($contact_form_short_code)): ?>
          <?php echo do_shortcode($contact_form_short_code); ?>
        <?php endif;?>
        <!-- Contact Form End  -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- contact-sec end -->

<!-- quote-sec start -->
<div class="quote-sec" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
  <div class="wrap">
  <?php $quote_sec_title = get_field('quote_sec_title');?>
  <?php if (isset($quote_sec_title) && !empty($quote_sec_title)): ?>
    <h2><?php echo $quote_sec_title ?></h2>
  <?php endif;?>
  </div>
</div>
<!-- quote-sec end -->

<!-- car-more-sec start -->
<div class="car-more-sec right-text mb-70">
  <div class="car-more-img" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
  <?php $car_more_img = get_field('car_more_img');?>
  <?php if (isset($car_more_img) && !empty($car_more_img)): ?>
    <img src="<?php echo $car_more_img ?>" alt="About X-Centrum">
  <?php endif;?>
  </div>
  <div class="car-more-details">
    <div class="inner" data-sal="slide-left" data-sal-delay="50" data-sal-duration="800">
      <?php $car_info_title = get_field('car_info_title');?>
  <?php if (isset($car_info_title) && !empty($car_info_title)): ?>
      <h2><?php echo $car_info_title ?></h2>
    <?php endif;?>
  <?php $car_info = get_field('car_info');?>
  <?php if (isset($car_info) && !empty($car_info)): ?>
      <p><?php echo $car_info ?></p>
      <?php endif;?>
    </div>
  </div>
</div>
<!-- car-more-sec end -->