<header class="banner">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
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
