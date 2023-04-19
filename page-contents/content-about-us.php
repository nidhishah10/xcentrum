<?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	Exit;
}

/**
 * The Template Used For Displaying About us page Content
 *
 * @package WordPress
 * @subpackage X Centrum
 * @since X Centrum 1.0
 */
?>

<div id="main">
<!-- inner-top-head start -->
<div class="inner-top-head only-title">
  <div class="wrap">
    <div class="top-head-blocks">
      <?php $banner_title = get_field('banner_title');?>
      <?php if (isset($banner_title) && !empty($banner_title)): ?>
      <div class="top-head-details">
        <h1><?php echo $banner_title ?></h1>
      </div>
    <?php endif;?>
    </div>
  </div>
</div>
<!-- inner-top-head end -->

  <!-- about-x-centrum-sec start -->
  <div class="about-x-centrum-sec">
    <?php $about_img = get_field('about_img');?>
    <?php if (isset($about_img) && !empty($about_img)): ?>
    <img src="<?php echo $about_img ?>" alt="about-x-centrum">
    <?php endif;?>
    <?php $about_title = get_field('about_title');?>
    <?php if (isset($about_title) && !empty($about_title)): ?>
    <h2><?php echo $about_title ?></h2>
    <?php endif;?>
  </div>
  <!-- about-x-centrum-sec end -->

  <!-- title-para-sec start -->
  <div class="title-para-sec">
    <div class="wrap">
    <?php $title = get_field('title');?>
    <?php if (isset($title) && !empty($title)): ?>
      <h2><?php echo $title ?></h2>
      <?php endif;?>

      <?php $information = get_field('information');?>
      <?php if (isset($information) && !empty($information)): ?>
      <p><?php echo $information ?></p>
      <?php endif;?>
    </div>
  </div>
  <!-- title-para-sec end -->

   <!-- car-more-sec start -->
   <div class="car-more-sec bg-dark right-text">
    <div class="car-more-img">
    <?php $car_more_img = get_field('car_more_img');?>
    <?php if (isset($car_more_img) && !empty($car_more_img)): ?>
      <img src="<?php echo $car_more_img ?>" alt="About X-Centrum">
    <?php endif;?>
    </div>
    <div class="car-more-details">
      <div class="inner">
      <?php $car_more_title = get_field('car_more_title');?>
      <?php if (isset($car_more_title) && !empty($car_more_title)): ?>
        <h2><?php echo $car_more_title ?></h2>
      <?php endif;?>

      <?php $car_more_info = get_field('car_more_info');?>
      <?php if (isset($car_more_info) && !empty($car_more_info)): ?>
        <p><?php echo $car_more_info ?></p>
      <?php endif;?>
      </div>
    </div>
  </div>
  <!-- car-more-sec end -->

  <!-- ready-for-you-sec start -->
  <div class="ready-for-you-sec">
    <div class="wrap">
      <div class="main-title">
      <?php $ready_for_you_title = get_field('ready_for_you_title');?>
      <?php if (isset($ready_for_you_title) && !empty($ready_for_you_title)): ?>
        <h2><?php echo $ready_for_you_title ?></h2>
      <?php endif;?>
      </div>
      <div class="team-members">
        <?php $team_members_box = get_field('team_members_box');?>
        <?php foreach ($team_members_box as $key => $team_members) {?>
        <div class="member">
          <figure>
            <img src="<?php echo $team_members['member_img']; ?>" alt="team-member">
          </figure>
          <div class="member-details">
            <?php echo $team_members['member_name']; ?>
            <a href="<?php echo $team_members['emai_url']; ?>" target="_blank"><?php echo $team_members['member_email']; ?></a>
            <a href="#" target="_blank"><?php echo $team_members['member_number']; ?></a>
          </div>
        </div>
         <?php }?>
      </div>
    </div>
  </div>
  <!-- ready-for-you-sec end -->

</div>
<!--/#main -->