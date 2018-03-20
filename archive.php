<?php
  Use Roots\Sage\Extras;

  $queried_obj = get_queried_object();
  $args = array(
    'cat'=> $queried_obj->term_id
  );
  $query = new WP_Query($args);

  //Extras\cpt_archive($query);

?>
