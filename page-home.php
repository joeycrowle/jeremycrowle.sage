<?php use Roots\Sage\Extras;
$media = get_field('media');
$imgArray = [];
$vidArray = [];
$detect = new Mobile_Detect;
?>


<nav class="nav-primary home-primary-nav">
  <?php
  if (has_nav_menu('primary_navigation')) :
    wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
  endif;
  ?>
</nav>


<?php
if($media){
  foreach($media as $image){
    if($image['type'] == 'image'){
      array_push($imgArray, $image['id']);
    }
    elseif ($image['type'] == 'video'){
      array_push($vidArray, $image['id']);
    }
  }
}

if(count($imgArray) > 0){
  $randImgNum = Extras\randomPosition($imgArray);
}
if(count($vidArray) > 0){
  $randVidNum = Extras\randomPosition($vidArray);
}

if($detect->isMobile()) : ?>
  <div id="page-background" class="obj-fit">
    <?php echo Extras\niceImage( $imgArray[$randImgNum-1], 'lazyload' ); ?>
  </div>
<?php 
  else :
  $random = rand(1, sizeof($media));
  $bgMedia = $media[$random-1];

  if($bgMedia['type'] == 'image') : ?>
  <div id="page-background" class="obj-fit">
    <?php echo Extras\niceImage( $bgMedia['id'], 'lazyload' ); ?>
  </div>

  <?php
  elseif($bgMedia['type'] == 'video') :
    $url = $bgMedia['url'];
    include('templates/bg-video.php');
    endif;
   endif;

   if(have_posts()): while(have_posts()): the_post(); ?>
  <div class="home-introduction container">
    <?php echo the_content(); ?>
  </div>
<?php
  endwhile;
    endif;
?>
