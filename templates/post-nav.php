<div class="post-nav">
<?php
$post_id = $post->ID; // current post ID
$cat = get_the_category();
$current_cat_id = $cat[0]->cat_ID; // current category ID
$child = get_category($current_cat_id);
$parent = $child->parent;
$args = array(
    'category' => $parent,
    'order'    => 'DESC'
);

$posts = get_posts( $args );
$ids = array();
foreach ( $posts as $thepost ) {
    $ids[] = $thepost->ID;
}
$thisindex = array_search( $post_id, $ids );
$previd    = isset( $ids[ $thisindex - 1 ] ) ? $ids[ $thisindex - 1 ] : 0;
$nextid    = isset( $ids[ $thisindex + 1 ] ) ? $ids[ $thisindex + 1 ] : 0;

if ( $previd ) {
    ?><a class="nav-item previous" rel="prev" href="<?php echo get_permalink($previd) ?>"><?php echo get_the_title($previd) ?></a><?php
}?>
  <p class="nav-item current"><?php echo get_the_title($post_id) ?></p>
<?php
if ( $nextid ) {
    ?><a class="nav-item next" rel="next" href="<?php echo get_permalink($nextid) ?>"><?php echo get_the_title($nextid) ?></a><?php
}
?>
</div>
