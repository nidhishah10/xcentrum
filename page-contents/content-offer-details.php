<?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	Exit;
}

/**
 * The Template Used For Displaying Offer Details page Content
 *
 * @package WordPress
 * @subpackage X Centrum
 * @since X Centrum 1.0
 */
?>
<div id="main">
  <!-- offer-page-banner start -->
 <div class="offer-page-banner">
        <div class="offer-banner-slide owl-carousel">
            <?php
echo do_shortcode('[xcentrum_recent_img num="10"]');
?>
        </div>
      </div>
      <!-- offer-page-banner end -->

  <!-- product-details-sec Start -->
   <div class="product-details-sec">
        <div class="wrap">
          <div class="product-details-inner">

        <?php
echo do_shortcode('[xcentrum_recent_product num="2"]');
?>
      </div>
    </div>
  </div>
  <!-- product-details-sec End -->

  <!-- specification-sec Start -->
  <div class="specification-sec more-pro-details">
    <div class="wrap">
      <div class="main-title" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <?php $specificaties_title = get_field('specificaties_title');?>
        <?php if (isset($specificaties_title) && !empty($specificaties_title)): ?>
        <h2><?php echo $specificaties_title; ?></h2>
        <?php endif;?>
      </div>
      <div class="specification-details">
         <?php
echo do_shortcode('[xcentrum_recent_speci num="9"]');
?>
      </div>
    </div>
  </div>
  <!-- specification-sec End -->

  <!-- options-sec Start -->
  <div class="options-sec more-pro-details">
    <div class="wrap">
      <div class="options">
                     <?php
echo do_shortcode('[xcentrum_recent_comfort num="1"]');
?>
      </div>
    </div>
  </div>
  <!-- options-sec End -->

  <!-- specification-sec Start -->
  <div class="specification-sec tech-per-sec more-pro-details">
    <div class="wrap">
      <div class="main-title" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <?php $tech_title = get_field('tech_title');?>
        <?php if (isset($tech_title) && !empty($tech_title)): ?>
        <h2><?php echo $tech_title; ?></h2>
        <?php endif;?>
      </div>
      <div class="specification-details">
      <?php
echo do_shortcode('[xcentrum_recent_tech num="8"]');
?>
</div>
    </div>
  </div>
  <!-- specification-sec End -->

  <!-- lease-sec Start -->
  <div class="lease-sec more-pro-details">
    <div class="wrap">
      <div class="main-title" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <?php $product_detail_title = get_field('product_detail_title');?>
        <?php if (isset($product_detail_title) && !empty($product_detail_title)): ?>
        <h2><?php echo $product_detail_title; ?></h2>
        <?php endif;?>
      </div>
      <div class="lease-details" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <?php $product_details = get_field('product_details');?>
        <?php if (isset($product_details) && !empty($product_details)): ?>
        <p><?php echo $product_details; ?></p>
        <?php endif;?>
        <div class="interested" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <?php $product_details1 = get_field('product_details1');?>
        <?php if (isset($product_details1) && !empty($product_details1)): ?>
          <?php echo $product_details1; ?>
            <?php endif;?>
        </div>
      </div>
    </div>
  </div>
  <!-- lease-sec End -->

  <!-- lease-sec Start -->
  <div class="test-drive-sec more-pro-details">
    <div class="wrap">
      <div class="main-title" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <?php $plan_title = get_field('plan_title');?>
        <?php if (isset($plan_title) && !empty($plan_title)): ?>
        <h2><?php echo $plan_title; ?><i class="icon-check"></i></h2>
        <?php endif;?>
      </div>
      <div class="lease-details" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <?php $description = get_field('description');?>
        <?php if (isset($description) && !empty($description)): ?>
        <p><?php echo $description; ?></p>
          <?php endif;?>
           <div>
          <?php $profit_btn = get_field('profit_btn');?>
          <button class="button poptrigger" data-rel="register_popup"><?php echo $profit_btn; ?></button>
          </div>
      </div>
    </div>
  </div>
  <!-- lease-sec End -->

  <!-- Register Popup Start -->
  <div class="popouterbox" id="register_popup">
      <div class="popup-block">
        <div class="pop-contentbox">
          <div class="main-title border-bottom">
            <h2>Vraag een proefrit aan</h2>
            <a href="#" class="close-dialogbox"><i class="icon-close"></i></a>
          </div>
        <div class="register-form"> 
            <?php echo do_shortcode('[contact-form-7 id="155" title="Contact Form"]'); ?>
            <!-- <form action="">
              <div class="form-group">
                  <input type="text" placeholder="Naam" class="textbox">
              </div>
              <div class="form-row">
                <div class="form-group">
                    <input type="email" placeholder="E-mail" class="textbox">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Telefoonnummer" class="textbox">
                </div>
              </div>
              <div class="form-group">
                  <textarea placeholder="Bericht" class="textarea"></textarea>
              </div>
              <div class="form-group reg-btn">
                <a href="#" class="button btn-outline">Verzenden <i class="icon-right-arrow"></i></a>
              </div>
            </form> -->
           </div> 
        </div>
      </div>
    </div>
    <!-- Register Popup End -->

</div>
<!-- Register Popup End -->
<!--/#main -->