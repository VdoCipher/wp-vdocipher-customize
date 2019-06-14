<?php

new VdoCipherCustomizeEssentials();
// This class enqueues the vdocipherapiready.js and overlay.css files.

class VdoCipherCustomizeEssentials
{
  public function __construct()
  {
  // Function to make plugin stop if VdoCipher is not installed to be added
    add_action( 'vdocipher_customize_player', array($this, 'vdo_api_ready') );
    add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
  }

  public function vdo_api_ready()
  {
    wp_enqueue_script( 'vdocipher_api_ready', plugins_url( '../js/vdocipherapiready.js', __FILE__ ) );
  }

  public function register_plugin_styles()
  {
      wp_register_style( 'vdocipher_player_overlay_style', plugins_url('../styles/overlay.css', __FILE__) );
      wp_enqueue_style('vdocipher_player_overlay_style');
  }
}
