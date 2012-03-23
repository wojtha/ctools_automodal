<?php

/**
 * @file
 * API documentation for CTools Automodal.
 */

/**
 * Implements hook_modal_paths().
 */
function hook_modal_paths() {
  $paths = array();

  $paths['user/register'] = array(
    'style' => 'example-signup',
    'redirect' => 'user',
    'close' => TRUE,
  );

  $paths['contact-us'] = array(
    'style' => 'example-contact',
    'confirm' => array(
      'title' => t('Thank you'),
      'text' => t('Your message has been sent.'),
    ),
  );

  return $paths;
}

/**
 * Implements hook_modal_paths_alter().
 */
function hook_modal_paths_alter(&$paths) {

}

/**
 * Implements hook_modal_styles().
 */
function hook_modal_styles() {
  $styles = array();

  $styles['example-contact'] = array(
    'modalSize' => array(
      'type' => 'fixed',
      'width' => 500,
      'height' => 300,
    ),
  );

  $styles['example-signup'] = array(
    'modalSize' => array(
      'type' => 'fixed',
      'width' => 500,
      'height' => 500,
    ),
  );

  return $styles;
}

/**
 * Implements hook_modal_styles_alter().
 */
function hook_modal_styles_alter(&$styles) {

}

/**
 * Implements hook_modal_error_alter().
 */
function hook_modal_error_alter(&$commands, $path, $error) {
  if ($error == MENU_ACCESS_DENIED) {
    if (strpos($path, 'user/') !== FALSE) {
      $commands[0]['output'] = '<span class="ajax-error-page">' . t('You are already signed in.') . '</span>';
    }
    else {
      $commands[0]['output'] = '<span class="ajax-error-page">' . $commands[0]['output'] . '</span>';
    }
  }
}
