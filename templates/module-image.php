<?php
Use Roots\Sage\Extras;

$imageObj = get_sub_field('image');
$imageId = $imageObj['ID'];
$style = get_sub_field('style');
$useCaption = get_sub_field('use_caption');
$captionHeading = get_sub_field('caption_heading');
$captionSubheading = get_sub_field('caption_subheading');
$caption = get_sub_field('caption');
$classes = ["post-img", "post-section"];
if($i == 0){
  $classes[] = "first";
}

if($style == 'Full'){
  array_push($classes, "img-full", "obj-fit");
}
elseif($style == 'Center'){
  array_push($classes, "img-center", "container");
}

if(!$useCaption){
  $classes[] = "no-caption";
}else{
  $classes[] = "caption";
 }


?>



<div class='<?php echo implode(" ", $classes); ?>'>
    <?php echo Extras\niceImage($imageId, 'lazyload'); ?>
    <?php if($useCaption) : ?>
      <div class="caption r">
        <h3><?php echo $captionHeading ?></h3>
        <h3><?php echo $captionSubheading ?></h3>
        <?php echo $caption ?>
      </div>
    <?php endif; ?>
</div>
