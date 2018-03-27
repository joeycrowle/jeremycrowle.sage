<header class="banner">
  <div class="links">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <?php
      if(is_single() || is_archive()) :
        $post_id = $post->ID; // current post ID
        $cat = get_the_category();
        $current_cat_id = $cat[0]->cat_ID; // current category ID
        $link = get_category_link($current_cat_id);
        $name = $cat[0]->name;
        ?>
        <a class="bread-crumb" href=<?php echo $link ?>><?php echo $name ?></a>
    <?php endif; ?>
  </div>

    <div class="hamburger">
      <div class="stroke"></div>
      <div class="stroke"></div>
      <div class="stroke"></div>
    </div>
    <div class="navigation">
      <div class="container nav-menus">
        <div class="row">
          <div class="col-sm-12 col-md-4 main-navigation-sub-menu">
            <?php
            if (has_nav_menu('current_works_navigation')) :
              wp_nav_menu(['theme_location' => 'current_works_navigation', 'menu_class' => 'nav']);
            endif;
            ?>
          </div>
          <div class="col-sm-12 col-md-4 main-navigation-sub-menu">
            <?php
            if (has_nav_menu('selected_works_navigation')) :
              wp_nav_menu(['theme_location' => 'selected_works_navigation', 'menu_class' => 'nav']);
            endif;
            ?>
          </div>
          <div class="col-sm-12 col-md-4 main-navigation-sub-menu">
            <?php
            if (has_nav_menu('details_navigation')) :
              wp_nav_menu(['theme_location' => 'details_navigation', 'menu_class' => 'nav']);
            endif;
            ?>
          </div>
        </div>
      </div>
    </div>
</header>
