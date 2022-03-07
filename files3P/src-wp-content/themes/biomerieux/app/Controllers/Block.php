<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Block extends Controller {
  public static function cover($data) {
    $datas = [
      'title' => $data['title'],
      'subtitle' => $data['subtitle'],
      'text' => $data['text'],
      'link' => $data['link'],
      'anchors' => [],
      'choice' => $data['choice'],
      'image' => $data['image'] ? Element::image($data['image'], '50vw', NULL, true) : NULL
    ];

    for($i = 0; $i < $data['anchors']; $i++) {
      $array = [
        'item' => $data['anchors_'. $i .'_anchor']
      ];

      array_push($datas['anchors'], $array);
    }

    return $datas;
  }

  public static function content($data) {
    return [
      'title' => $data['title'],
      'subtitle' => $data['subtitle'],
      'link' => $data['link'],
      'text' => $data['text'],
    ];
  }

  public static function process($data) {
    $datas = [
      'title' => $data['title'],
      'process' => []
    ];

    for($i = 0; $i < $data['process']; $i++) {
      $array = [
        'image' => $data['process_'. $i .'_image'] ? Element::image($data['process_'. $i .'_image'], '33vw', NULL, true) : NULL,
        'title' => $data['process_'. $i .'_title'],
        'subtitle' => $data['process_'. $i .'_subtitle'],
        'text' => $data['process_'. $i .'_text'],
        'link' => $data['process_'. $i .'_link']
      ];

      array_push($datas['process'], $array);
    }

    return $datas;
  }

  public static function client($data) {
    $datas = [
      'title' => $data['title'],
      'images' => [],
      'link' => $data['link']
    ];

    foreach ($data['images'] as $image) {
      $array = [
        'image' => $image ? Element::image($image, '20vw', 'contain', true) : NULL
      ];

      array_push($datas['images'], $array);
    }

    return $datas;
  }

  public static function keyFiguresPicto($data) {
    $datas = [
      'title' => $data['title'],
      'figures' => []
    ];

    for($i = 0; $i < $data['figures']; $i++) {
      $array = [
        'image' => $data['figures_'. $i .'_image'] ? Element::image($data['figures_'. $i .'_image'], '20vw', 'contain', true) : NULL,
        'figure' => $data['figures_' . $i . '_figure'],
        'text' => $data['figures_' . $i . '_text']
      ];

      array_push($datas['figures'], $array);
    }

    return $datas;
  }

  public static function imageText($data) {
    return [
      'invert' => $data['invert'],
      'title' => $data['title'],
      'subtitle' => $data['subtitle'],
      'text' => $data['text'],
      'link' => $data['link'],
      'image' => $data['image'] ? Element::image($data['image'], '50vw') : NULL
    ];
  }

  public static function keyFigures($data) {
    $datas = [
      'text' => $data['text'],
      'figures' => [],
    ];

    for($i = 0; $i < $data['figures']; $i++) {
      $array = [
        'figure' => $data['figures_' . $i . '_figure'],
        'text' => $data['figures_' . $i . '_text']
      ];

      array_push($datas['figures'], $array);
    }

    return $datas;
  }

  public static function slider($data) {
    $datas = [
      'title' => $data['title'],
      'slides' => [],
    ];

    for($i = 0; $i < $data['slides']; $i++) {
      $array = [
        'image' => $data['slides_'. $i .'_image'] ? Element::image($data['slides_'. $i .'_image'], '58vw') : NULL,
        'title' => $data['slides_' . $i . '_title'],
        'text' => $data['slides_' . $i . '_text'],
        'link' => $data['slides_' . $i . '_link']
      ];

      array_push($datas['slides'], $array);
    }

    return $datas;
  }

  public static function miniatures($data) {
    $datas = [
      'title' => $data['title'],
      'miniatures' => [],
    ];

    for($i = 0; $i < $data['miniatures']; $i++) {
      $array = [
        'image' => $data['miniatures_'. $i .'_image'] ? Element::image($data['miniatures_'. $i .'_image'], '58vw') : NULL,
        'title' => $data['miniatures_' . $i . '_title'],
        'text' => $data['miniatures_' . $i . '_text']
      ];

      array_push($datas['miniatures'], $array);
    }

    return $datas;
  }

  public static function processSlider($data) {
    $datas = [
      'title' => $data['title'],
      'slides' => [],
      'scroll_more' => $data['scroll_more']
    ];

    for($i = 0; $i < $data['slides']; $i++) {
      $array = [
        'image' => $data['slides_'. $i .'_image'] ? Element::image($data['slides_'. $i .'_image'], '58vw', 'contain', true) : NULL,
        'title' => $data['slides_' . $i . '_title'],
        'text' => $data['slides_' . $i . '_text']
      ];

      array_push($datas['slides'], $array);
    }

    return $datas;
  }

  public static function knowMore($data) {
    $datas = [
      'title' => $data['title'],
      'cards' => [],
    ];

    for($i = 0; $i < $data['cards']; $i++) {
      $array = [
        'image' => $data['cards_'. $i .'_image'] ? Element::image($data['cards_'. $i .'_image'], '58vw') : NULL,
        'title' => $data['cards_' . $i . '_title'],
        'text' => $data['cards_' . $i . '_text'],
        'link' => $data['cards_' . $i . '_link']
      ];

      array_push($datas['cards'], $array);
    }

    return $datas;
  }

  public static function download($data) {
    $datas = [
      'files' => [],
    ];

    for($i = 0; $i < $data['files']; $i++) {
      $array = [
        'title' => $data['files_' . $i . '_title'],
        'file' => wp_get_attachment_url($data['files_' . $i . '_file'])
      ];

      array_push($datas['files'], $array);
    }

    return $datas;
  }

  public static function form($data) {
    return [
      'title' => $data['title'],
      'text' => $data['text'],
      'id-form' => $data['id-form']
    ];
  }

  public static function faq($data) {
    $datas = [
      'faq' => []
    ];

    if ($data) {
      for($i = 0; $i < $data['category']; $i++) {
        $category = array(
          'anchor' => $data['category_'. $i .'_anchor'] ? $data['category_'. $i .'_anchor'] : NULL,
          'title' => $data['category_'. $i .'_title'],
          'questions' => []
        );

        for ($j = 0; $j < $data['category_'. $i .'_questions']; $j++) {
          $questions = array(
            'question' => $data['category_'. $i .'_questions_'. $j .'_question'],
            'answer_left' => $data['category_'. $i .'_questions_'. $j .'_answer_left'],
            'answer_right' => $data['category_'. $i .'_questions_'. $j .'_answer_right']
          );

          array_push($category['questions'], $questions);
        }

        array_push($datas['faq'], $category);
      }
    }

    return $datas;
  }

  public static function video($data) {
    $video = $data['youtube'];

    if (!empty($video)) {
      $src = '';

      preg_match('/src="(.+?)"/', $video, $matches);

      if ($matches) { $src = $matches[1]; }

      preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/', $video, $matches);
      $id = $matches[7];

      $params = array(
        'hd' => 1,
        'autoplay' => 0,
        'loop' => 0,
        'background' => 1,
        'mute' => 0,
        'autopause' => 0,
        'disablekb' => 1,
        'modestbranding' => 1,
        'showinfo' => 0,
        'fs' => 1,
        'playsinline' => 0,
        'iv_load_policy' => 3,
        'controls' => 1,
        'playlist' => $id
      );

      $new_src = add_query_arg($params, $src);
    }

    $video_array = array(
      'id' => isset($id) ? $id : '',
      'src' => isset($new_src) ? $new_src : ''
    );

    return [
      'anchor' => $data['anchor'] ? $data['anchor'] : NULL,
      'video' => $video_array,
      'suptitle' => $data['suptitle'],
      'title' => $data['title'],
      'poster' => $data['poster'] ? Element::image($data['poster'], '100vw') : NULL
    ];
  }
}
