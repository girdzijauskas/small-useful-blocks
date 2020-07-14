<?php

namespace Drupal\copyright_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'CopyrightBlock' block.
 *
 * @Block(
 *  id = "copyright_block",
 *  admin_label = @Translation("Copyright block"),
 * )
 */
class CopyrightBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'wrapper' => "div",
      'text' => "All rights reserved.",
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['wrapper'] = [
      '#type' => 'select',
      '#title' => $this->t('Wrapper'),
      '#description' => $this->t('Choose the wrapper for the copyright output.'),
      '#options' => ['div' => $this->t('div'), 'span' => $this->t('span')],
      '#default_value' => $this->configuration['wrapper'],
      '#size' => 2,
      '#weight' => '0',
    ];
    $form['text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text'),
      '#description' => $this->t('Input the text you would like to appear next to the year.'),
      '#default_value' => $this->configuration['text'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * Gets the current year.
   */
  public function getCurrentYear() {
    return date("Y");
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['wrapper'] = $form_state->getValue('wrapper');
    $this->configuration['text'] = $form_state->getValue('text');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'copyright_block';
    $build['#year'] = [
      '#markup' => $this->getCurrentYear(),
    ];
    $build['#text'] = [
      '#markup' => $this->configuration['text'],
    ];
    return $build;
  }

}
