<?php
/**
 * Plugin Name: Customize VdoCipher plugin
 * Description: Boilerplate plugin with which to extend VdoCipher Plugin
 * Version: 1.0
 * Author: VdoCipher
*/

new VdoCipherAddChapters();

class VdoCipherAddChapters
{
  public function __construct()
  {
    add_filter( 'vdocipher_add_shortcode_attributes', array($this, 'new_vdo_shortcode_attribute') );
    // add_action('vdocipher_customize_player', array( $this, 'insert_chapters' ) );
    add_action('vdocipher_customize_player', array( $this, 'insert_chapters_with_names' ) );
  }

  public function new_vdo_shortcode_attribute($shortcode_defaults){
    $shortcode_defaults['chapters'] = '';
    return $shortcode_defaults;
  }

  public function insert_chapters($vdo_args){
    $chapters_string = $vdo_args['chapters'];
    if ( $chapters_string !== '' ) {
      $chapter_time_array = explode(',', $chapters_string);
      wp_enqueue_script('vdo_chapters_print', plugin_dir_url(__FILE__).'js/printchapters.js');
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
      wp_enqueue_script('vdo_chapters_print', plugin_dir_url(__FILE__).'js/printchapters.js');
      wp_localize_script('vdo_chapters_print', 'vdoChapters', array(
        'chaptersTimeArr' => $chapter_time_array,
        'chaptersNameArr' => $chapter_name_array
      ));
    }
  }
}

new VdoCipherCustomizeWatermark();

class VdoCipherCustomizeWatermark
{
  public function __construct()
  {
    add_filter('vdocipher_annotate_preprocess', array($this, 'constant_string_replace'));
    add_filter('vdocipher_annotate_preprocess', array($this, 'display_full_name'));
  }

  public function constant_string_replace( $vdo_annotate_code )
  {
    $custom_variable = '{var1} is converted to this now';
    $vdo_annotate_code = str_replace('{var1}', $custom_variable, $vdo_annotate_code);
    return $vdo_annotate_code;
  }

  public function display_full_name( $vdo_annotate_code )
  {
    $fullname = "";
    if (is_user_logged_in()) {
      $current_user = wp_get_current_user();
      $firstname = $current_user->user_firstname;
      $lastname = $current_user->user_lastname;
      $fullname = $firstname . " " . $lastname;
    }
    $vdo_annotate_code = str_replace('{fullname}', $fullname, $vdo_annotate_code);
    return $vdo_annotate_code;
  }
}

new VdoCipherCustomize();
// This class enqueues the vdocipherapiready.js and overlay.css files.

class VdoCipherCustomize
{
  public function __construct()
  {
  // Function to make plugin stop if VdoCipher is not installed to be added
    add_action('vdocipher_customize_player', array($this, 'vdo_api_ready'));
    add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
  }

  public function vdo_api_ready()
  {
    wp_enqueue_script('vdocipher_api_ready', plugin_dir_url(__FILE__).'js/vdocipherapiready.js');
  }

  public function register_plugin_styles()
  {
      wp_register_style('vdocipher_player_overlay_style', plugin_dir_url(__FILE__).'styles/overlay.css');
      wp_enqueue_style('vdocipher_player_overlay_style');
  }
}
