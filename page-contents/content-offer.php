<?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	Exit;
}

/**
 * The Template Used For Displaying Offer page Content
 *
 * @package WordPress
 * @subpackage X Centrum
 * @since X Centrum 1.0
 */

?>
<div id="main">

<?php 
  $top_head_img = get_field('top_head_img');
  $top_head_title = get_field('top_head_title');
  if (!isset($top_head_img) || empty($top_head_img)):
    $top_head_img = "";
  endif;
?>

  <!-- inner-top-head start -->
  <div class="inner-top-head">
    <div class="x-centrum-offer-banner" style="background-image: url(<?php echo $top_head_img; ?>)">
      <div class="wrap">
        <?php if (isset($top_head_title) && !empty($top_head_title)): ?>
          <h1><?php echo $top_head_title ?></h1>
        <?php endif;?>
      </div>
    </div>
  </div>
  <!-- inner-top-head end -->
  <!-- number-of-vehicles start -->
  <div class="number-of-vehicles-sec">
  <?php
$searchData = '';
if ($_POST['txtSearch'] != "") {
	$searchData = $_POST['txtSearch'];
}
?>
    <div class="wrap">
      <div class="main-title" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
        <h2>Aantal voertuigen</h2>
      </div>
      <div class="listing-sec">
        <div class="sidebar">
			<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
          <div class="search-filter" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
            <div class="filter-reset">
              <h6>Filteren</h6>
              <a href="<?php echo site_url(); ?>/offer/" title="Reset Filter" class="reset_filter">Reset Filter</a>
            </div>
            <div class="search-fil-block">
              <?php
$search_val = "";
if (isset($_GET['search_val']) && $_GET['search_val'] != "") {
	$search_val = $_GET['search_val'];
}
?>
              <input type="text" placeholder="Zoek op trefwoord of specificatie" id="txtSearch" name="txtSearch" value="<?php echo $search_val; ?>">
              <a href="" class="search_data"><i class="icon-search"></i></a>
            </div>
            <div class="search-suggestion">
              <ul>
                <li><a href="javascript:void(0)" data-value="Audi">Audi</a></li>
                <li><a href="javascript:void(0)" data-value="Sedan">Sedan</a></li>
                <li><a href="javascript:void(0)" data-value="SUV">SUV</a></li>
              </ul>
            </div>
          </div>
          <div class="filter-categories" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
             <input type="hidden" id="action" value="<?php echo site_url() ?>/wp-admin/admin-ajax.php" />
            <input type="hidden" id="action" method="POST" value="myfilter" />
            <div class="accordion-databox">

              <?php echo do_shortcode('[xcentrum_recent_category num_data="11"]'); ?>
				      <?php //echo do_shortcode('[xcentrum_recent_model num_data="10"]'); ?>
              <?php echo do_shortcode('[xcentrum_recent_brandstoftank num_data="12"]'); ?>
              <?php echo do_shortcode('[xcentrum_recent_price num_data="13"]'); ?>
              <?php echo do_shortcode('[xcentrum_recent_years num_data="14"]'); ?>
              <?php echo do_shortcode('[xcentrum_recent_kilometers num_data="15"]'); ?>
              <?php echo do_shortcode('[xcentrum_recent_transmission num_data="16"]'); ?>
              <?php echo do_shortcode('[xcentrum_recent_color num_data="18"]'); ?>
            </div>

          </div>
			</form>
        </div>
        <div class="main-listing">
          <div class="selection-stock-blocks tests">
           <?php echo do_shortcode('[xcentrum_recent num_data="6"]'); ?>
          </div>
          <?php echo do_shortcode('[xcentrum_pagination_code]'); ?>

      <!-- <div class="pagination" data-sal="slide-up" data-sal-delay="50" data-sal-duration="800">
            <ul>
              <li class="prev disabled"><a href="#"><i class="icon-double-arrow"></i></a></li>
              <li><span>1</span></li>
				      <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li class="next"><a href="#"><i class="icon-double-arrow"></i></a></li>
            </ul>
          </div> -->


        </div>
      </div>
    </div>
  </div>
  <!-- number-of-vehicles end -->

</div>
<!--/#main -->
