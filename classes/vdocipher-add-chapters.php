<?php
new VdoCipherAddChapters();

class VdoCipherAddChapters
{
  public function __construct()
  {
    add_filter( 'vdocipher_add_shortcode_attributes', array($this, 'new_vdo_shortcode_attribute') );
    // add_action('vdocipher_customize_player', array( $this, 'insert_chapters' ) );
    // add_action('vdocipher_customize_player', array( $this, 'insert_chapters_with_names' ) );
  }

  public function new_vdo_shortcode_attribute($shortcode_defaults){
    $shortcode_defaults['chapters'] = '';
    return $shortcode_defaults;
  }

  public function insert_chapters($vdo_args){
    $chapters_string = $vdo_args['chapters'];
    if ( $chapters_string !== '' ) {
      $chapter_time_array = explode(',', $chapters_string);
      wp_enqueue_script('vdo_chapters_print', plugins_url('../js/printchapters.js', __FILE__) );
      wp_localize_script('vdo_chapters_print', 'vdoChapters', array(
        'chaptersTimeArr' => $chapter_time_array
      ));
    }
  }

  public function insert_chapters_with_names($vdo_args){
    $chapters_string = $vdo_args['chapters'];
    if ( $chapters_string !== '' ) {
      $chapter_array = explode(';', $chapters_string);
      $chapter_name_array = array();
      $chapter_time_array = array();
      foreach ( $chapter_array as $chapter ){
        $individual_chapter = explode(',', $chapter);
        $chapter_name = $individual_chapter[0];
        array_push( $chapter_name_array,  $chapter_name);
        $chapter_time = end($individual_chapter);
        array_push( $chapter_time_array, $chapter_time );
      }
      wp_enqueue_script('vdo_chapters_print', plugins_url('../js/printchapters.js', __FILE__) );
      wp_localize_script('vdo_chapters_print', 'vdoChapters', array(
        'chaptersTimeArr' => $chapter_time_array,
        'chaptersNameArr' => $chapter_name_array
      ));
    }
  }
}
