<?php
/**
 * TSP Theme shortcode functions and definitions.
 *
 */

remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);

function t8_column($atts, $content = null){
   extract(shortcode_atts(array(
      'style' => '',
      'cols' => '',
   ), $atts));

   $classes = ' '.$style.' cols-'.$cols;

   return 
   		'<div class="t8-col'. $classes .'">'.
   
         do_shortcode($content) .

   		'</div>';

}
add_shortcode( 't8-column', 't8_column' );

function t8_columns($atts, $content = null){
   extract(shortcode_atts(array(
      'style' => '',
   ), $atts));

   $content = wpautop(trim($content)); 
   
   return 
   		'<div class="t8-cols-wrap '.$style.' cf">'.   
   
   		do_shortcode($content) .

   		'</div>';

}
add_shortcode( 't8-columns', 't8_columns' );

function t8_button($atts, $content = null){
   extract(shortcode_atts(array(
      'style' => 'green',
      'link' => '#',
      'target' => '_self',
   ), $atts));
 
   return 
         '<a class="'.$style.' button" target="'. $target .'" href="'. $link .'">'.
   
         do_shortcode($content) .

         '</a>';

}
add_shortcode( 'button', 't8_button' );

function t8_countdown($atts){
   extract(shortcode_atts(array(
      'due' => '+1 week',
   ), $atts));


   if (($timestamp = strtotime($due)) === false) {
      return '-';
   } else {
      
      $count = $timestamp - time();

      if( $count < 0 ) { // 0
         return '0 <span>days</span>';
      } elseif( $count < 60*60 ) { // minutes
         return round( $count/60 ) . '<span> minutes</span>';
      } elseif( $count < 60*60*24 ) { //hours
         return round( $count/(60*60) ) . '<span> hours</span>';
      } else { //days
         return round( $count/(60*60*24) ) . '<span> days</span>';
      }

   }

}
add_shortcode( 'countdown', 't8_countdown' );

function t8_gap($atts){
   extract(shortcode_atts(array(
      'size' => '1em',
   ), $atts));

      return '<span class="gap" style="margin-top:'.$size.'"><span/>';;

}
add_shortcode( 'gap', 't8_gap' );
