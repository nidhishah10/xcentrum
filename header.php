<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.ico">
  <!-- Include google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,400;1,700&display=swap"
    rel="stylesheet">
    <!-- End of google fonts -->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">

    <header id="header">
      <div class="wrap">
        <div class="header-row">

            <?php $logo = get_field('header_logo', 'option'); ?>
                        <?php if( isset($logo) && !empty($logo) ) : //to check site Logo ?>
                            <a href="<?php bloginfo('url'); ?>" id="logo" title="<?php bloginfo('name'); ?>">
                              <img src="<?php echo $logo; ?>" width="313" height="74" alt="<?php bloginfo('name'); ?>">
                            </a>
                        <?php else:  //else default name display ?>
                            <h4><a href="<?php bloginfo('url'); ?>" id="logo" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h4>
                        <?php endif; //endif ?>


         
          <nav id="mainmenu">
                         <?php 
                        if( has_nav_menu('main-menu') ) : // Check Main Menu Set or Not
                            wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => '','container_class'=>'','items_wrap' => '<ul>%3$s</ul>') );
                           endif; //endif
                      ?>
                    </nav>
          <!--/#mainmenu-->
           <?php 
           $header_contact_text = get_field('header_contact_text', 'option'); 
           $header_contact_number = get_field('header_contact_number', 'option'); 
           ?>
           <?php if( isset($header_contact_text) && !empty($header_contact_text)  && !empty($header_contact_number)) : //to check site Logo ?>
          <div class="header-contact">
            <a href="tel:<?php echo $header_contact_number?>" target="_blank"><i class="icon-call"></i><?php echo $header_contact_text?> <span><?php echo $header_contact_number?></span></a>
          </div>
          <?php endif; //endif ?>
        </div>
      </div>
      <!--/.wrap-->
    </header>
    <!--/#header-->









