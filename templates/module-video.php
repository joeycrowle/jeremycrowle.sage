<?php
$video = get_sub_field('video');
$style = get_sub_field('style');
$useCaption = get_sub_field('use_caption');
$captionHeading = get_sub_field('caption_heading');
$captionSubheading = get_sub_field('caption_subheading');
$caption = get_sub_field('caption');
$classes = ["post-video", "post-section"];

if($i == 0){
  $classes[] = "first";
}

if($style == "Full"){
  $classes[] = "full-width";
}
elseif ($style == "Center"){
  $classes[] = "centered container";
}
if(!$useCaption){
  $classes[] = "no-caption";
}else{
  $classes[] = "caption";
}
?>

<?php if($style == "Center") : ?>
<div class='<?php echo implode(" ", $classes); ?>'>
  <video controls preload="metadata" class="centered-video vjs-default-skin" width="100%" height="auto" data-setup='{}'>
    <source src=<?php echo $video . "#t=0.5" ?> type="video/mp4">
  </video>
  <?php if($useCaption) : ?>
    <div class="caption r">
      <h3><?php echo $captionHeading ?></h3>
      <h3><?php echo $captionSubheading ?></h3>
      <?php echo $caption ?>
    </div>
  <?php endif; ?>
</div>



<? elseif($style == "Full") : ?>
  <div class='<?php echo implode(" ", $classes); ?>'>
    <div class="jarallax" data-jarallax-video=<?php echo "mp4:" . $video ?>>
    </div>
  </div>
<?php endif; ?>
