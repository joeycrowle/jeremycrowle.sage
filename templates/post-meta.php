<?php
$postTitle = get_the_title();
$postDate = date("Y",strtotime($post->post_date));;
$cat = get_the_category();
$postCategory = $cat[0]->name;
$tags = get_the_tags();
$tagArray = [];
$postDetails = '';
?>


<div class="post-meta">
  <div class="container r">
    <div class="row">
      <div class="col-sm-4">
        <h5 class=""><?php echo $postTitle; ?></h5>
        <p><?php echo $postDate; ?></p>
      </div>
      <div class="col-sm-4">
        <h5 class=""><?php echo $postCategory; ?></h5>
        <p>
          <?php
            foreach ($tags as $tag) {
              $tagArray[] = (string) $tag->name;
            }
            echo implode(", ", $tagArray);
          ?>
        </p>
        </div>
      <div class="col-sm-4">
        <h5 class="">Artwork Details</h5>
        <p>A series of three images. Edition of 5.</p>
      </div>
    </div>
  </div>
</div>
