<?php
/**
 * Plugin Name: Recent Posts Slider Bootstrap
 * Description: This plugin displays recent post slider using bootstrap. Write [slide-up] to paste slider;
 * Version: 1.0.0
 * Author: ZVS
 * License: GPL2
 */

add_action('init', 'register_shortcodes');

function register_shortcodes() {
    add_shortcode("slide-up", 'slider_callback');
}


function slider_callback($args, $content){
    $head = '<div id="carousel-example-generic" class="slider-custom carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">';

    $foot = '</div>
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>';



    $args = array(
        'numberposts' => 3,
        'order'=> 'DESC',
        'post_mime_type' => 'image',
        'post_parent' => $postID,
        'post_status' => null,
        'post_type' => 'attachment'
    );
    $attachments = get_children( $args );
    $c =0;
    if ($attachments) {
        foreach($attachments as $attachment) {
            $c++;
            $image_attributes = wp_get_attachment_image_src( $attachment->ID, 'full' );
           // $content .= '<img src="'.wp_get_attachment_thumb_url( $attachment->ID ).'" class="current">';
            //$content .=  get_permalink($attachment->post_parent);

            $content .= '<div class="item';
            if($c==1) {
                $content .= ' active';
            }

            $post = get_post($attachment->post_parent);
            $content .= '"><img src="' . $image_attributes[0] .'" width="900" height="500" alt="caption" style="overflow:hidden; max-height: 500px;"><div class="carousel-caption">'.
                '<a href="' . get_permalink($attachment->post_parent) . '" style="padding: 40px; color: #fff;"><h3 style="letter-spacing: 3px;">' . $post->post_title . '</h3></a>'

                .'</div></div>';
        }
    }
    return $head . $content . $foot;
}