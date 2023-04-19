  <?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	Exit;
}

/**
 * The Template Used For Displaying Contact Page Content
 *
 * @package WordPress
 * @subpackage X x-centrum
 * @since X Centrum 1.0
 */
?>
<div id="main">
        <div class="top-head-blocks contact-title" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
            <div class="wrap">
                <div class="top-head-details sal-animate" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
                  <?php $contact_title = get_field('contact_title');?>
                  <?php if (isset($contact_title) && !empty($contact_title)): ?>
                  <h1><?php echo $contact_title ?></h1>
                <?php endif;?>
                </div>
            </div><!--/.wrap-->
        </div>
        <div class="contact-link-sec" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
            <div class="wrap">
                <div class="contact-link-row">
                  <?php $contact_box = get_field('contact_box');?>
                  <?php foreach ($contact_box as $key => $contact) {?>
                    <div class="contact-info">
                        <div class="contact-icon">
                            <i class="<?php echo $contact['icon_class_name']; ?>"></i>
                        </div>
                        <div class="contact-data">
                            <a href="<?php echo $contact['contact_url']; ?>" target="_blank">
                                <?php echo $contact['contact_value']; ?>
                            </a>
                        </div>
                    </div>
                  <?php }?>
                </div>
            </div><!--/.wrap-->
        </div>
        <!-- contact-banner-->
        <div class="contact-banner" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
          <?php $contact_banner_img = get_field('contact_banner_img');?>
          <?php if (isset($contact_banner_img) && !empty($contact_banner_img)): ?>
            <img src="<?php echo $contact_banner_img ?>" alt="banner-contact">
          <?php endif;?>
        </div>
        <!-- contact-banner-->
      <!-- contact-sec start -->
        <?php $contact_sec_img = get_field('contact_sec_img');?>
        <?php if (isset($contact_sec_img) && !empty($contact_sec_img)): ?>
      <div class="contact-sec" style="background-image: url(<?php echo $contact_sec_img ?>);">
         <?php endif;?>
        <div class="wrap">
          <div class="contact-blocks">
            <div class="contact-details" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
              <?php $contact_block_title = get_field('contact_block_title');?>
            <?php if (isset($contact_block_title) && !empty($contact_block_title)): ?>
              <h2><?php echo $contact_block_title ?></h2>
            <?php endif;?>

            <?php $contact_number = get_field('contact_number');?>
            <?php if (isset($contact_number) && !empty($contact_number)): ?>
              <h4><?php echo $contact_number ?></h4>
            <?php endif;?>

            <?php $contact_details = get_field('contact_details');?>
            <?php if (isset($contact_details) && !empty($contact_details)): ?>
              <p class="contact-para">
                <?php echo $contact_details ?>
              </p>
            <?php endif;?>
            </div>
            <div class="contact-form-sec">
              <div class="contact-details-form" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
            <?php $contact_form_title = get_field('contact_form_title');?>
            <?php if (isset($contact_form_title) && !empty($contact_form_title)): ?>
                <h2><?php echo $contact_form_title ?></h2>
            <?php endif;?>
                <?php $contact_form_short_code = get_field('contact_form_short_code');?>
        <?php if (isset($contact_form_short_code) && !empty($contact_form_short_code)): ?>
          <?php echo do_shortcode($contact_form_short_code); ?>
        <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- contact-sec end -->

      <!-- quote-sec start -->
      <div class="quote-sec contact-quote" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <div class="wrap">
          <?php $quote_sec_title = get_field('quote_sec_title');?>
          <?php if (isset($quote_sec_title) && !empty($quote_sec_title)): ?>
          <h2><?php echo $quote_sec_title ?></h2>
          <?php endif;?>
        </div>
      </div>
      <!-- quote-sec end -->
    </div>
    <!--/#main -->