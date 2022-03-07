<?php

if (function_exists('acf_add_options_page')) {
  acf_add_options_page();
}
// require_once __DIR__ . '/app/bootstrap.php';

if (function_exists('acf_add_local_field_group')) {
  acf_add_local_field_group(array(
    'key' => 'tracking',
    'title' => 'Tracking',
    'fields' => array(
      array(
        'key' => 'google_tag_manager',
        'label' => 'Code Google Tag Manager',
        'name' => 'google_tag_manager',
        'type' => 'text',
      )
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options',
        ),
      ),
    ),
  ));
}

require_once dirname(__DIR__) . '/resources/polylang.php';
require_once dirname(__DIR__) . '/resources/blocs-setup.php';
require_once dirname(__DIR__) . '/resources/wrap-blocks.php';

function remove_gutenberg_styles() {
  wp_dequeue_style( 'wp-block-library' );
}

add_action( 'wp_enqueue_scripts', 'remove_gutenberg_styles', 100 );

/**
 * Display svg function
 */
function display_svg($svg, $getUrl = false) {
  $uri = $getUrl ? get_template_directory_uri() . "/assets/images/svg" : get_template_directory() . "/assets/images/svg";
  $path = "$uri/$svg.svg";

  if ($getUrl) return $path;
  else if (file_exists($path)) include($path);
  else throw new Exception("SVG name doesn't exist in /images/svg folder", 1);
}

/**
 * Create all image sizes
 */
add_image_size('sm', 480, 0, true);
add_image_size('md', 768, 0, true);
add_image_size('lg', 1024, 0, true);
add_image_size('xl', 1200, 0, true);
add_image_size('xxl', 1400, 0, true);
add_image_size('xxxl', 1600, 0, true);
add_image_size('hd', 1920, 1080, true);

remove_image_size('1536x1536');
remove_image_size('2048x2048');
update_option('medium_large_size_w', '0');

/**
 * Populate ACF select field options with Gravity Forms forms
 */
function acf_populate_gf_forms_ids( $field ) {
	if ( class_exists( 'GFFormsModel' ) ) {
		$choices = [];

		foreach ( \GFFormsModel::get_forms() as $form ) {
			$choices[ $form->id ] = $form->title;
		}

		$field['choices'] = $choices;
	}

	return $field;
}
add_filter( 'acf/load_field/name=id-form', 'acf_populate_gf_forms_ids' );

/**
* Add menu location
*/
function wpb_custom_new_menu() {
    register_nav_menu('footer_navigation',__( 'Footer navigation' ));
    register_nav_menu('sub_footer_navigation',__( 'Sub Footer navigation' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

/**
 * Add custom styles to the Wordpress editor
 */
function add_style_select_buttons( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter( 'mce_buttons_2', 'add_style_select_buttons' );

/**
 * Create custom styles for Wordpress editor
 */
function my_custom_styles( $init_array ) {
  $style_formats = array(
      array(
          'title' => 'Texte mis en avant',
          'inline' => 'span',
          'classes' => 'underline',
          'wrapper' => true
      )
  );
  $init_array['style_formats'] = json_encode( $style_formats );
  return $init_array;
}
add_filter( 'tiny_mce_before_init', 'my_custom_styles' );
