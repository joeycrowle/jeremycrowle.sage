<footer class="content-info">
  <div class="container">
    <?php
      if(is_single() or is_front_page()){
        include('post-nav.php');
      }
    ?>
  </div>
</footer>
