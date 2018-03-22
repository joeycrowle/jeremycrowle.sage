<?php

  $queried_obj = get_queried_object();
  $args = array('cat'=> $queried_obj->term_id);
  $query = new WP_Query($args);

  if($query->have_posts()) : ?>
  <div class="post-list-container">
    <div class="post-list">
      <div class="grid-sizer"></div>
      <div class="gutter">

      </div>
    <?php
      while($query->have_posts()) :
        $query->the_post();
        $title = get_the_title();
        $permalink = get_the_permalink();
        $year = date("Y",strtotime($post->post_date));
        $categories = get_the_category();
        $category = $categories[0]->name;
        $tags = get_the_tags();
        $description = get_field('project_description');
    ?>
    <a href=<?php echo $permalink ?> class="post-item r">
      <h1><?php echo $title ?></h1>
      <p class="details">
        <?php echo $category . ", " . $year ?>
      </p>
      <?php
      if ($tags) :
        $i = 0;
        $s = '';
        $length = count($tags);
        ?>
      <div class="tags">
      <?php
        foreach($tags as $tag){
          if($i == 0 && $length < 1 || $i == $length-1){
            $s = '';
          }
          elseif($i == 0 && $length > 1 || $i>0 && $i<$length-1){
            $s = ', ';
          }
          //echo $tag->name . $s;
          echo "<p>". $tag->name . $s ."</p>";
          $i++;
        }
      endif;
      ?>
      </div>
      <div class="description">
        <?php echo $description ?>
      </div>
    </a>
  <?php
      endwhile;
    endif;
  ?>
  </div>
</div>
