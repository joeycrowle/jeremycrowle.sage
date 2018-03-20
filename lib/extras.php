<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');










//JOEYS STUFF

/**
 * GET ATTACHMENT STUFF
 */
function wp_get_attachment( $attachment_id ) {
	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

/**
 * NICE PICTURE ELEMENT
 */
function niceImage($imageID, $classes){
    $imgSm = wp_get_attachment_image_src($imageID, 'thumbnail');
    $imgMd = wp_get_attachment_image_src($imageID, 'medium');;
    $imgLg = wp_get_attachment_image_src($imageID, 'large');;
    $meta = wp_get_attachment($imageID);
    $alt = $meta['alt'];
    $imgSrc = wp_get_attachment_url( $imageID );
    $imgSrcset = wp_get_attachment_image_srcset( $imageID );

   return
    "<picture>
      <source srcset=".$imgSm[0]." media='(max-width: 768px)'>
      <source srcset=".$imgMd[0]." media='(max-width: 1440px)'>
      <source srcset=".$imgLg[0]." media='(max-width: 1920px)'>
      <img alt='".$alt."' src=".$imgSrc." data-src=".$imgSrc." class='".$classes."'>
    </picture>";
}


/**
 * CUSTOM POSTS IN ARCHIVES
 */
function cpt_archive($query) {
  if ( $query->is_category() && $query->is_main_query()  )  {
      $query->set( 'post_type',
          array(
              'post',
              'artworks',
              'photography',
              'commercial'
          )
      );
  }
  //return $query;
  add_filter('pre_get_posts', $query);
}
