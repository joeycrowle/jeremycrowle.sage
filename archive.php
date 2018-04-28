<?php
  Use Roots\Sage\Extras;
  $queried_obj = get_queried_object();
  $args = array(
    'cat'=> $queried_obj->term_id,
    'posts_per_page'=> -1
  );
  $query = new WP_Query($args);
  $x = 0;

  if($query->have_posts()) : ?>
  <div class="post-list-container">
    <div class="post-list">
      <div class="grid-sizer"></div>
      <div class="gutter"></div>
    <?php
      while($query->have_posts()) :
        $query->the_post();
        $cat = get_the_category();
        $id = get_the_id();
        $thumb = get_post_thumbnail_id($id);
        $title = get_the_title();
        $permalink = get_the_permalink();
        $year = date("Y",strtotime($post->post_date));
        $tags = get_the_tags();
        $tagArray = [];
        $description = get_field('project_description');
        $postClasses = ["post-item", "r"];

        if($cat[0]->category_parent > 0){
          $post_category_id = $cat[0]->category_parent;
          $cat_name = $cat[0]->name;
        }else{
          $post_category_id = $cat[1]->cat_ID;
          $cat_name = $cat[1]->name;
        }


        if($x==0){
          $postClasses[] = "first";
        }
    ?>
    <a href=<?php echo $permalink ?> class='<?php echo implode(" ", $postClasses) ?>'>

      <?php if($x==0) : ?>
        <div class="post-thumbnail">
          <?php echo Extras\niceImage($thumb, "lazyload first-thumbnail") ?>
        </div>
      <?php endif; ?>



      <div class="post-details">
        <h1><?php echo $title ?></h1>
        <p class="details">
          <?php echo $cat_name . ", " . $year ?>
        </p>

        <?php if($tags) : ?>
          <div class="tags">
            <p>
            <?php
            foreach ($tags as $tag) {
              $tagArray[] = $tag->name;
            }
            echo implode(", ", $tagArray);
            ?>
            </p>
          </div>
        <?php endif; ?>

        <div class="description">
          <?php echo $description ?>
        </div>
      </div>
    </a>
  <?php
      $x++;
      endwhile;
    endif;
  ?>
  </div>
</div>
