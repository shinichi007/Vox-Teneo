<?php

namespace Drupal\vox_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class VoxSettingsForm.
 */
class VoxSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return [
      'vox_module.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'vox_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $config = $this->config('vox_module.settings');

    $form['title'] = [
      '#type' => 'textfield',
      '#required' => TRUE,
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('title'),
    ];

    $form['subtitle'] = [
      '#type' => 'textfield',
      '#required' => TRUE,
      '#title' => $this->t('Subtitle'),
      '#default_value' => $config->get('subtitle'),
    ];

    $form['search'] = [
      '#type' => 'checkbox',
      '#required' => TRUE,
      '#title' => $this->t('Show Search'),
      '#default_value' => $config->get('search'),
    ];

    $form['banner'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Banner Path'),
      '#default_value' => $config->get('banner'),
    ];

    $form['banner_image_upload'] = [
      '#type' => 'file',
      '#title' => $this->t('Choose a file'),
      '#title_display' => 'invisible',
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    parent::validateForm($form, $form_state);

    $banner_image_upload = $this->getRequest()->files->get('files')['banner_image_upload'];
    if ($banner_image_upload instanceof UploadedFile) {
      if (in_array($banner_image_upload->getClientMimeType(), ['image/png', 'image/jpeg'])) {
        $banner = $banner_image_upload->move('sites/default/files/banner_image', 'banner.jpg');
        @chmod($banner->getPathname(), 0600 & ~umask());
        $form_state->setValue('banner', $banner->getPathname());
      }
      else {
        $form_state->setErrorByName('banner_image_upload', 'Unsupported media type');
      }
    }

    if (empty($form_state->getValue('banner'))) {
      $form_state->setErrorByName('banner', $this->t('@name field is required.', ['@name' => 'Banner Image']));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    parent::submitForm($form, $form_state);

    $config = $this->config('vox_module.settings');
    $config->set('title', $form_state->getValue('title'));
    $config->set('subtitle', $form_state->getValue('subtitle') ?: $config->get('subtitle'));
    $config->set('banner', $form_state->getValue('banner'));
    $config->set('search', $form_state->getValue('search'));
    $config->save();
  }

}
