<?php
/**
 * Template Name: Aux
 */

?>

  <?php
  if(have_rows('rows')) :
    while(have_rows('rows')) : the_row();
    if(get_row_layout() == '2_column'){
      get_template_part('templates/module-2-column');
    }
    elseif(get_row_layout() == '1_column'){
      get_template_part('templates/module-1-column');
    }
    endwhile;
    endif;
  ?>
