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
/*

$i = 0;
if( $media ):
  $random = rand(1, sizeof($media));

  foreach( $media as $image ):
    $i++;
    if($i == $random){
      if($image['type'] == 'image'){
        $id = $image['id']; ?>
        <div id="page-background" class="obj-fit">
          <?php echo niceImage( $id, 'lazyload' ); ?>
        </div>
    <?php
      }
      elseif($image['type'] == 'video'){
        $url = $image['url'];
        include('templates/bg-video.php');
      }
    }
 endforeach;
endif;
*/
?>






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
?>

<?php if($detect->isMobile()){
  $testing = 'ismobile';
}else{
  $testing = 'isnotmobile';
} ?>

<div id="page-background" class="obj-fit">
  <?php echo Extras\niceImage($imgArray[$randImgNum-1], 'lazyload'); ?>
</div>









<?php if(have_posts()): while(have_posts()): the_post(); ?>
  <div class="home-introduction container">
    <?php echo $testing; ?>
  </div>
<?php endwhile; endif; ?>
