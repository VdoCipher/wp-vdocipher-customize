<?php
/**
 * Plugin Name: Customize VdoCipher plugin
 * Description: Boilerplate plugin with which to extend VdoCipher Plugin
 * Version: 1.0
 * Author: VdoCipher
*/

new VdoCipherAddShortcodeAttribute();

class VdoCipherAddShortcodeAttribute
{
  public function __construct()
  {
    add_filter( 'vdocipher_add_shortcode_attributes', array($this, 'new_vdo_shortcode_attribute') );
    add_action('vdocipher_customize_player', array( $this, 'customize_the_player' ) );
  }

  public function new_vdo_shortcode_attribute($shortcode_defaults){
    $shortcode_defaults['chapters'] = '';
    return $shortcode_defaults;
  }

  public function customize_the_player($vdo_args){
    $chapters = $vdo_args['chapters'];
    if ($chapters !== '') {
      $chapter_array = explode(',', $chapters);
      wp_enqueue_script('vdo_chapters_print', plugin_dir_url(__FILE__).'js/printchapters.js');
      wp_localize_script('vdo_chapters_print', 'vdoChapters', array(
        'chaptersArr' => $chapter_array
      ));
    }
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
