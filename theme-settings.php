<?php
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function astrocentro_br_v2_form_system_theme_settings_alter(&$form, &$form_state) {

  $form['astrocentro_br_v2_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Astrocentro v2 Settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  $form['astrocentro_br_v2_settings']['breadcrumbs'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show breadcrumbs'),
    '#default_value' => theme_get_setting('breadcrumbs','astrocentro_br_v2'),
    '#description'   => t("Check this option to show breadcrumbs in page. Uncheck to hide."),
  );
  $form['astrocentro_br_v2_settings']['slideshow'] = array(
    '#type' => 'fieldset',
    '#title' => t('Front Page Slideshow'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['astrocentro_br_v2_settings']['slideshow']['slideshow_display'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show slideshow'),
    '#default_value' => theme_get_setting('slideshow_display','astrocentro_br_v2'),
    '#description'   => t("Check this option to show Slideshow in front page. Uncheck to hide."),
  );
  $form['astrocentro_br_v2_settings']['slideshow']['slideimage'] = array(
    '#markup' => t('To change the Slide Images, Replace the slide-image-1.jpg, slide-image-2.jpg and slide-image-3.jpg in the images folder of the theme folder.'),
  );
  $form['astrocentro_br_v2_settings']['socialicon'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social Icon'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['astrocentro_br_v2_settings']['socialicon']['socialicon_display'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Social Icon'),
    '#default_value' => theme_get_setting('socialicon_display','astrocentro_br_v2'),
    '#description'   => t("Check this option to show Social Icon. Uncheck to hide."),
  );
  $form['astrocentro_br_v2_settings']['socialicon']['twitter_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Twitter Profile URL'),
    '#default_value' => theme_get_setting('twitter_url', 'astrocentro_br_v2'),
    '#description'   => t("Enter your Twitter Profile URL. Leave blank to hide."),
  );
  $form['astrocentro_br_v2_settings']['socialicon']['facebook_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Facebook Profile URL'),
    '#default_value' => theme_get_setting('facebook_url', 'astrocentro_br_v2'),
    '#description'   => t("Enter your Facebook Profile URL. Leave blank to hide."),
  );
  $form['astrocentro_br_v2_settings']['socialicon']['google_plus_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Plus Address'),
    '#default_value' => theme_get_setting('google_plus_url', 'astrocentro_br_v2'),
    '#description'   => t("Enter your Google Plus URL. Leave blank to hide."),
  );
  $form['astrocentro_br_v2_settings']['socialicon']['pinterest_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Pinterest Address'),
    '#default_value' => theme_get_setting('pinterest_url', 'astrocentro_br_v2'),
    '#description'   => t("Enter your Pinterest URL. Leave blank to hide."),
  );
}
