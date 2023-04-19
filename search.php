<?php get_header(); ?>
      <div class="top-banner">
        <div class="banner-shapes">
            <svg
            width="1309"
            height="1279"
            viewBox="0 0 1309 1279"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <g clip-path="url(#clip0_246_976)">
              <path
                class="top-shape"
              />
              <path
                class="left-bottom-shape"
                d="M261.17 583.796L233.904 574.598C228.146 572.669 222.064 571.892 216.006 572.312C209.948 572.732 204.032 574.341 198.597 577.047C193.161 579.753 188.312 583.502 184.327 588.082C180.342 592.662 177.298 597.981 175.37 603.737L162.133 642.981C160.711 647.227 158.466 651.152 155.527 654.53C152.588 657.909 149.011 660.675 145.002 662.671C140.992 664.667 136.629 665.854 132.16 666.164C127.691 666.474 123.205 665.901 118.957 664.477L93.9907 656.056C84.886 653.007 74.9437 653.699 66.3505 657.977C57.7572 662.256 51.2165 669.772 48.1669 678.872L25.9325 744.79C18.7718 765.913 20.2951 789.017 30.1676 809.023C40.0401 829.029 57.4538 844.299 78.5813 851.478L454.204 978.178C466.448 982.279 479.818 981.352 491.376 975.601C502.934 969.85 511.733 959.744 515.837 947.508L539.024 878.768C542.792 867.657 542.42 855.559 537.977 844.699C533.533 833.839 525.317 824.947 514.839 819.659C507.907 816.168 500.237 814.394 492.476 814.489L233.559 810.21L290.144 642.451C293.082 633.781 293.383 624.433 291.007 615.591C288.632 606.748 283.688 598.807 276.8 592.772C272.233 588.78 266.921 585.729 261.17 583.796V583.796Z"
                fill="#E2E9FB"
              />
            </g>
            <defs>
              <linearGradient
                id="paint0_linear_246_976"
                x1="549"
                y1="429"
                x2="194"
                y2="113.5"
                gradientUnits="userSpaceOnUse"
              >
                <stop stop-color="#F0F2F8" />
                <stop offset="1" stop-color="#D8DEF1" />
              </linearGradient>
              <clipPath id="clip0_246_976">
                <rect width="1309" height="1279" fill="white" />
              </clipPath>
            </defs>
          </svg>
        </div>
        <div class="wrap">
          
          <div class="top-banner-info">
            <h1>Search Results</h1>
          </div>
          
        </div>
      </div>
<?php
$s=get_search_query();
$args = array(
                's' =>$s
            );
    // The Query
$the_query = new WP_Query( $args );
?>
      <div id="main">
        <div id="primary" class="content-area one-column">
          <div id="content" class="site-content">

            <div class="page-main">
              <div class="wrap">
<?php
if ( $the_query->have_posts() ) {
        _e("<h2 style='font-weight:bold;color:#000'>Search Results for: ".get_query_var('s')."</h2>");
        while ( $the_query->have_posts() ) {
           $the_query->the_post();
                 ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                 <?php
        }
    }else{
?>
        <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
        <div class="alert alert-info">
          <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
        </div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>

<?php get_footer(); ?>