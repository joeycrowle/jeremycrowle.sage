<?php
  do_action('get_header');
  get_template_part('templates/header');
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
else :

endif;
?>
</div>

<?php get_template_part('templates/post-footer'); ?>
