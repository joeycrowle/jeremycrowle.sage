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
$imgData = Extras\wp_get_attachment($imageId);
$imgTitle = $imgData['title'];
$imgCaption = $imgData['caption'];
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
        <h6><?php echo $imgTitle ?></h6>
        <p><?php echo $imgCaption ?></p>

      </div>
    <?php endif; ?>
</div>
