<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
  public function __construct() {
    $GLOBALS['options'] = get_fields('options');
    $GLOBALS['navigation'] = $this->menu();
  }

  public function polylangActive() {
    return function_exists('pll_current_language') === true && function_exists('pll_the_languages') === true;
  }

  public static function formSubmit() {
    return isset($_REQUEST['gform_submit']) ? 'formsubmit-' . $_REQUEST['gform_submit'] : null;
  }

  public static function menu() {
    $dataHeader = [];
    $dataFooter = [];
    $dataSubFooter = [];

    $menuLocations = get_nav_menu_locations();
    $headerMenuId = isset($menuLocations['primary_navigation']) ? $menuLocations['primary_navigation'] : null;
    $footerMenuId = isset($menuLocations['footer_navigation']) ? $menuLocations['footer_navigation'] : null;
    $subFooterMenuId = isset($menuLocations['sub_footer_navigation']) ? $menuLocations['sub_footer_navigation'] : null;

    if ($headerMenuId) {
      $headerMenuNav = wp_get_nav_menu_items($headerMenuId);

      foreach($headerMenuNav as $item) {
        if ($item->menu_item_parent == 0) {
          $itemArray = array(
            'id' => $item->ID,
            'title' => $item->title,
            'url' => $item->url,
            'target' => $item->target,
            'children' => []
          );

          foreach ($headerMenuNav as $subItem) {
            if ($subItem->menu_item_parent != 0) {
              if (intval($subItem->menu_item_parent) === $item->ID) {
                $itemArray['children'][] = [
                  'id' => $subItem->ID,
                  'title' => $subItem->title,
                  'url' => $subItem->url,
                  'target' => $subItem->target
                ];
              }
            }
          }

          $dataHeader[] = $itemArray;
        }
      }
    }

    if ($footerMenuId) {
      $footerMenuNav = wp_get_nav_menu_items($footerMenuId);

      foreach($footerMenuNav as $item) {
        $dataFooter[] = array(
          'id' => $item->object_id,
          'title' => $item->title,
          'url' => $item->url,
          'target' => $item->target
        );
      }
    }

    if ($subFooterMenuId) {
      $subFooterMenuNav = wp_get_nav_menu_items($subFooterMenuId);

      foreach($subFooterMenuNav as $item) {
        $dataSubFooter[] = array(
          'id' => $item->object_id,
          'title' => $item->title,
          'url' => $item->url,
          'target' => $item->target
        );
      }
    }

    return [
      'header' => $dataHeader,
      'footer' => $dataFooter,
      'subfooter' => $dataSubFooter
    ];
  }

  public static function options() {
    $options = get_fields('options');

    return [ 'gtm' => $options['google_tag_manager'] ];
  }
}
