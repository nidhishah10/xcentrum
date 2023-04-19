<footer id="footer">
      <div class="wrap">
        <div class="footer-blocks">
          <div class="footer-block">

             <?php $logo = get_field('header_logo', 'option');?>
                        <?php if (isset($logo) && !empty($logo)): //to check site Logo ?>
																																																															<a href="<?php bloginfo('url');?>" class="ftr-logo" title="<?php bloginfo('name');?>">
																																																															<img src="<?php echo $logo; ?>" width="260" height="64" alt="<?php bloginfo('name');?>">
																																																															</a>
																																																															<?php else: //else default name display ?>
																																																															<h4><a href="<?php bloginfo('url');?>" id="logo" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a></h4>
																																																															<?php endif; //endif ?>


            <!-- <a href="index.html" class="ftr-logo"><img src="images/logo.svg" alt="logo" width="260" height="64"></a> -->
            <?php
$address_heading = get_field('address_heading', 'option');
$address = get_field('address', 'option');
?>
           <?php if (!empty($address_heading) && !empty($address)): ?>
            <div class="inner-ftr">
              <p><?php echo $address_heading; ?>:</p>
              <p><?php echo $address; ?></p>
            </div>
            <?php endif; //endif ?>
            <?php
$contact_heading = get_field('contact_heading', 'option');
$contact_number = get_field('contact_number', 'option');
$contact_email = get_field('contact_email', 'option');
?>
           <?php if (!empty($contact_heading) && !empty($contact_number) && !empty($contact_email)): ?>
            <div class="inner-ftr">
              <p><?php echo $contact_heading; ?>:</p>
              <a href="tel:<?php echo $contact_number; ?>" target="_blank"><?php echo $contact_number; ?></a>
              <a href="mailto:<?php echo $contact_email; ?>" target="_blank"><?php echo $contact_email; ?></a>
            </div>
            <?php endif; //endif ?>
          </div>
          <div class="footer-block ftr-links">
            <?php
$timings_heading = get_field('timings_heading', 'option');
$timings = get_field('timings', 'option');
?>
           <?php if (!empty($timings_heading)): ?>
            <h4><?php echo $timings_heading; ?></h4>
            <?php endif; //endif ?>
            <div class="time-details">
                <?php foreach ($timings as $key => $timing) {?>
                    <p><span><?php echo $timing['day']; ?>:</span><?php echo $timing['time']; ?></p>
                <?php }?>
            </div>
          </div>
        </div>
      </div>
      <!--/.wrap -->
    </footer>
    <!--/#footer -->
  </div>
  <!--/#wrapper-->

 <?php wp_footer();?>
 <script type="text/javascript">
   


</script>
</body>
