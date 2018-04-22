<?php
include('templates/post-nav.php');

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

include('templates/post-meta.php');

?>



</div>
