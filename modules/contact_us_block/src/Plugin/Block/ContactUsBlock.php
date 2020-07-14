<?php

namespace Drupal\contact_us_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a 'ContactUsBlock' block.
 *
 * @Block(
 *  id = "contact_us_block",
 *  admin_label = @Translation("Contact us block"),
 * )
 */
class ContactUsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'phone_icon' => "fa-comments",
      'phone_number' => "+44 115 9465252",
      'email_icon' => "fa-envelope",
      'email_address' => "office@thewbsgroup.com",
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['phone_icon'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone Icon'),
      '#description' => $this->t('The icon class from Font Awesome.'),
      '#default_value' => $this->configuration['phone_icon'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '100',
    ];
    $form['phone_number'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone Number'),
      '#description' => $this->t('The phone number with which both the link href and text will be generated.'),
      '#default_value' => $this->configuration['phone_number'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '101',
    ];
    $form['email_icon'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email Icon'),
      '#description' => $this->t('The icon class from Font Awesome.'),
      '#default_value' => $this->configuration['email_icon'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '102',
    ];
    $form['email_address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('E-mail Address'),
      '#description' => $this->t('The e-mail address to be used to generate both the linkn and the text of the link.'),
      '#default_value' => $this->configuration['email_address'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '103',
    ];

    return $form;
  }

  /**
   * Generates the URL for the telephone link.
   */
  public function generateTelephoneUrl() {
    
    $url = Url::fromUri('tel:' . $this->configuration['phone_number']);
    // $url->setUnrouted();

    return $url;
  }

  /**
   * Generates the URL for the email link 
   */
  public function generateEmailUrl() {
    $url = Url::fromUri('mailto:' . $this->configuration['email_address']);

    return $url;
  }


  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['phone_icon'] = $form_state->getValue('phone_icon');
    $this->configuration['phone_number'] = $form_state->getValue('phone_number');
    $this->configuration['email_icon'] = $form_state->getValue('email_icon');
    $this->configuration['email_address'] = $form_state->getValue('email_address');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'contact_us_block';
    $build['#phone_icon'] = [
      '#markup' => $this->configuration['phone_icon'],
    ];
    $build['#phone_link'] = [
      '#type' => 'link',
      '#title' => $this->configuration['phone_number'],
      '#url' => $this->generateTelephoneUrl(),
    ];
    $build['#email_icon'] = $this->configuration['email_icon'];
    $build['#email_link'] = [
      '#type' => 'link',
      '#title' => $this->configuration['email_address'],
      '#url' => $this->generateEmailUrl(),
    ];

    return $build;
  }
}
