<?php
/**
 * Template Name: Aux
 */
?>

<div class="aux">
  <?php if(is_page('contact')) : ?>
    <div class="contact-form container r">
        <?php echo do_shortcode('[contact-form-7 id="413" title="Contact form 1"]'); ?>
    </div>
  <?php endif; ?>

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
</div>
