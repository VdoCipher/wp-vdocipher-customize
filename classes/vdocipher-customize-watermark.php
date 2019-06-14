<?php

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
