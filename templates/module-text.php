<?php
$heading = get_sub_field('heading');
$subHeading = get_sub_field('subheading');
$copy = get_sub_field('copy');
$classes = ["post-text", "post-section", "container", "r"];
?>

<div class='<?php echo implode(" ", $classes); ?>'>
  <h3><?php echo $heading ?></h3>
  <h3><?php echo $subHeading ?></h3>
  <?php echo $copy ?>
</div>
