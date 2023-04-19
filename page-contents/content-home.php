<?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	Exit;
}

/**
 * The Template Used For Displaying Home page Content
 *
 * @package WordPress
 * @subpackage X Centrum
 * @since X Centrum 1.0
 */
?>


<div id="main">
      <!-- hero-img-sec start -->
      <?php
$banner_image = get_field('banner_image');
$banner_title = get_field('banner_title');
$banner_subtitle = get_field('banner_subtitle');
$banner_car_title = get_field('banner_car_title');
$banner_desc = get_field('banner_desc');
$banner_button = get_field('banner_button');
?>
           <?php if (!empty($banner_image)): ?>
      <div class="hero-img-sec" style="background-image: url(<?php echo $banner_image; ?>);">
      <?php else: ?>
        <div class="hero-img-sec" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/home-main-img.jpg);">
        <?php endif; //endif ?>
        <div class="wrap">
          <div class="hero-inner">
            <div class="hero-details">
                <?php if (!empty($banner_title)): ?>
              <h1><?php echo $banner_title; ?></h1>
              <?php endif; //endif ?>
              <?php if (!empty($banner_subtitle)): ?>
              <h3><?php echo $banner_subtitle; ?></h3>
              <?php endif; //endif ?>
            </div>
            <div class="find-car-block">
              <h3><?php echo $banner_car_title; ?></h3>
              <p><?php echo $banner_desc; ?></p>
              <a class="button" href="<?php echo site_url() ?>/offer/"><?php echo $banner_button; ?></a>
               <?php
$searchData = '';
if ($_POST['txtSearch'] != "") {
	$searchData = $_POST['txtSearch'];
}
?>
<?php /*
<form action="<?php echo site_url() ?>/offer/" method="GET" id="search_filter">
<div class="search-block">
<input type="text" placeholder="Zoek op trefwoord of specificatie" id="txtSearch" name="search_val">
<button type="submit" class="search_data">Bekijk resultaten</button>

</div>
<div class="car-selection-filter">

<?php echo do_shortcode('[xcentrum_recent_merkmodel num_data="19"]'); ?>

<?php echo do_shortcode('[xcentrum_recent_brandsof num_data="20"]'); ?>
<div class="custom-select">
<select id="price" name="price">
<option value="">Prijs tot</option>
<option value="500">€ 500</option>
<option value="1.000">€ 1.000</option>
<option value="1.500">€ 1.500</option>
<option value="2.00">€ 2.000</option>
<option value="2.500">€ 2.500</option>
<option value="3.000">€ 3.000</option>
<option value="3.500">€ 3.500</option>
<option value="4.000">€ 4.000</option>
<option value="4.500">€ 4.500</option>
<option value="5.000">€ 5.000</option>
<option value="6.000">€ 6.000</option>
<option value="7.000">€ 7.000</option>
<option value="8.000">€ 8.000</option>
<option value="9.000">€ 9.000</option>
<option value="10.000">€ 10.000</option>
<option value="12.500">€ 12.500</option>
<option value="15.000">€ 15.000</option>
<option value="17.500">€ 17.500</option>
<option value="20.000">€ 20.000</option>
<option value="25.000">€ 25.000</option>
<option value="30.000">€ 30.000</option>
<option value="35.000">€ 35.000</option>
<option value="40.000">€ 40.000</option>
<option value="45.000">€ 45.000</option>
<option value="50.000">€ 50.000</option>
<option value="75.000">€ 75.000</option>
<option value="100.000">€ 100.000</option>
<option value="125.000">€ 125.000</option>
<option value="150.000">€ 150.000</option>
</select>
</div>
<?php echo do_shortcode('[xcentrum_recent_year num_data="21"]'); ?>
</div>
</form>
 */?>
      </div>
    </div>
  </div>
</div>
      <!-- hero-img-sec end -->

      <!-- view-our-stock-sec start -->
      <div class="view-our-stock-sec">
        <div class="wrap">
          <div class="view-our-stock-blocks">
            <div class="view-stock-details" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
                <?php
$stock_title = get_field('stock_title');
$stock_description = get_field('stock_description');
$view_stock_button = get_field('view_stock_button');
$stock_image = get_field('stock_image');
?>
                 <?php if (!empty($stock_title)): ?>
              <h3><?php echo $stock_title; ?></h3>
              <?php endif; //endif ?>
              <?php if (!empty($stock_description)): ?>
              <p><?php echo $stock_description; ?></p>
                <?php endif; //endif ?>
                <?php //print_r($view_stock_button); ?>
                <?php if (!empty($view_stock_button)): ?>
              <a href="<?php echo $view_stock_button['url']; ?>" class="button"><?php echo $view_stock_button['title']; ?></a>
              <?php endif; //endif ?>
            </div>
            <?php if (!empty($stock_image)): ?>
            <div class="view-stock-img" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
              <img src="<?php echo $stock_image; ?>" alt="our-stock">
            </div>
            <?php endif; //endif ?>
          </div>
        </div>
      </div>
      <!-- view-our-stock-sec end -->

      <!-- car-more-sec start -->
      <?php
$welcome_title = get_field('welcome_title');
$welcome_description = get_field('welcome_description');
$welcome_image = get_field('welcome_image');
$view_more_button = get_field('view_more_button');
?>
      <div class="car-more-sec bg-dark right-text">
        <?php if (!empty($welcome_image)): ?>
        <div class="car-more-img" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
          <img src="<?php echo $welcome_image; ?>" alt="Welkom bij X-Centrum">
        </div>
        <?php endif; //endif ?>
        <div class="car-more-details">
          <div class="inner" data-sal="slide-left" data-sal-delay="50" data-sal-duration="800">
            <?php if (!empty($welcome_title)): ?>
            <h2><?php echo $welcome_title; ?></h2>
            <?php endif; //endif ?>
            <?php if (!empty($welcome_description)): ?>
            <p><?php echo $welcome_description; ?></p>
              <?php endif; //endif ?>
              <?php if (!empty($view_more_button)): ?>
            <a href="<?php echo $view_more_button['url']; ?>" class="button"><?php echo $view_more_button['title']; ?></a>
            <?php endif; //endif ?>
          </div>
        </div>
      </div>
      <!-- car-more-sec end -->
      <!-- selection-stock-sec start -->
      <div class="selection-stock-sec">
        <div class="wrap">
          <div class="main-title text-center" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
            <h2>Een selectie uit onze voorraad</h2>
          </div>
          <div class="selection-stock-blocks">

             <?php
echo do_shortcode('[xcentrum_recent_auto num="4"]');
?>
            </div>
          </div>
        </div>
      </div>
      <!-- selection-stock-sec end -->


      <?php
$brands = get_field('brands');
?>
      <!-- brands-sec start -->
      <div class="brands-sec">
        <div class="wrap">
          <ul class="brands-inner">
            <?php foreach ($brands as $key => $brand): ?>
                <li data-sal="slide-up" data-sal-delay="50" data-sal-duration="800"><img src="<?php echo $brand['image']; ?>" alt="<?php echo $brand['title']; ?>"></li>
            <?php endforeach?>
          </ul>
        </div>
      </div>
      <!-- brands-sec end -->

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
//foreach ($posts as $post): setup_postdata($post);?>
<?php
$args = array('post_type' => 'news', 'posts_per_page' => 3, 'orderby' => 'ID', 'order' => 'DSC');
$the_query = new WP_Query($args);
?>
<?php if ($the_query->have_posts()): ?>
<?php while ($the_query->have_posts()): $the_query->the_post();?>
																								<div class="news-block" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
																								<a href="<?php echo site_url() ?>/news-media-page">
																								<figure>
																								<img src="<?php echo get_field('news_img'); ?>" alt="news">
																								</figure>
																								</a>
																								<div class="news-inner">
																								<h3><a href="<?php echo site_url() ?>/news-media-page"><?php the_title();?></a></h3>
																								<p><?php the_content();?></p>
																								<a href="<?php echo site_url() ?>/news-media-page" class="read-more">Lees Meer <i class="icon-right-arrow"></i></a>
																								</div>
																								</div>
																								<?php endwhile;?>
                    <?php endif;?>
                    <?php wp_reset_postdata();?>


          </div>
        </div>
      </div>
      <!-- latest-news-sec end -->

      <!-- car-more-sec start -->
      <?php
$car_heading = get_field('car_heading');
$car_description = get_field('car_description');
$car_image = get_field('car_image');
?>
      <div class="car-more-sec left-text">
        <div class="car-more-details">
          <div class="inner" data-sal="slide-right" data-sal-delay="50" data-sal-duration="800">
            <?php if (!empty($car_heading)): ?>
            <h2><?php echo $car_heading; ?></h2>
            <?php endif; //endif ?>
            <?php if (!empty($car_description)): ?>
            <p><?php echo $car_description; ?></p>
              <?php endif; //endif ?>
          </div>
        </div>
         <?php if (!empty($car_image)): ?>
        <div class="car-more-img" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
          <img src="<?php echo $car_image; ?>" alt="car">
        </div>
        <?php endif; //endif ?>
      </div>
      <!-- car-more-sec end -->

    </div>
    <!--/#main -->