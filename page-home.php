<?php use Roots\Sage\Extras; ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>
  <div class="home-introduction container">
    <?php echo the_content(); ?>
  </div>
<?php endwhile; endif; ?>

<nav class="nav-primary home-primary-nav">
  <?php
  if (has_nav_menu('primary_navigation')) :
    wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
  endif;
  ?>
</nav>



<?php
$media = get_field('media');
$i = 0;
if( $media ):
  $random = rand(1, sizeof($media));
  ?>
  <?php foreach( $media as $image ):
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
?>
