<header class="banner">
  <div class="links">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <?php
      if(is_single()) :
        $post_id = $post->ID; // current post ID
        $cat = get_the_category();
        $current_cat_id = $cat[0]->cat_ID; // current category ID
        $child = get_category($current_cat_id);
        $parent = $child->parent;
        $parentName = get_the_category_by_ID($parent);
        $parentLink = get_category_link($parent);
        ?>
        <a class="bread-crumb" href=<?php echo $parentLink ?>><?php echo $parentName ?></a>
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
            if (has_nav_menu('selected_works_navigation')) :
              wp_nav_menu(['theme_location' => 'selected_works_navigation', 'menu_class' => 'nav']);
            endif;
            ?>
          </div>
          <div class="col-sm-12 col-md-4 main-navigation-sub-menu">
            <?php
            if (has_nav_menu('previous_works_navigation')) :
              wp_nav_menu(['theme_location' => 'previous_works_navigation', 'menu_class' => 'nav']);
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
