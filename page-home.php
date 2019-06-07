<?php use Roots\Sage\Extras;

$args = array(
  'cat' => 48,
  'posts_per_page' => 1
);
$query = new WP_Query($args);
?>


<?php if ($query->have_posts()): while($query->have_posts()) : $query->the_post();

  if( have_rows('rows') ): ?>
    <div class="post-layout">
    <?php
      $i=0;
      while ( have_rows('rows') ) : the_row();
          if( get_row_layout() == 'image' ):
            include('templates/module-image.php');
          elseif( get_row_layout() == 'video' ):
            include('templates/module-video.php');
          elseif( get_row_layout() == 'text'):
            include('templates/module-text.php');
          endif;
          $i++;
      endwhile;

      include('templates/post-meta.php');
      include('templates/post-nav.php');
  endif;
endwhile; endif; ?>
