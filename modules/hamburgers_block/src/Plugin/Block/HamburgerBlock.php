<?php

namespace Drupal\hamburgers_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;


/**
 * Provides a 'HamburgerBlock' block.
 *
 * @Block(
 *  id = "hamburger_block",
 *  admin_label = @Translation("Hamburger Block"),
 * )
 */
class HamburgerBlock extends BlockBase
{
  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration()
  {
    return [
      'icon_style' => $this->configuration['icon_style'],
      'link_url' => $this->configuration['link_url'],
    ];
    return parent::defaultConfiguration(); // TODO: Change the autogenerated stub
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state)
  {
    $form['icon_style'] = [
      '#type' => 'select',
      '#title' => $this->t('Icon Style'),
      '#description' => $this->t('Choose the style for the hamburger icon.'),
      '#options' => [
        "3dx" => "3dx",
        "3dx-r" => "3dx-r",
        "3dy" => "3dy",
        "3dy-r" => "3dy-r",
        "3dxy" => "3dxy",
        "3dxy-r" => "3dxy-r",
        "arrow" => "arrow",
        "arrow-r" => "arrow-r",
        "arrowalt" => "arrowalt",
        "arrowalt-r" => "arrowalt-r",
        "arrowturn" => "arrowturn",
        "arrowturn-r" => "arrowturn-r",
        "boring" => "boring",
        "collapse" => "collapse",
        "collapse-r" => "collapse-r",
        "elastic" => "elastic",
        "elastic-r" => "elastic-r",
        "emphatic" => "emphatic",
        "emphatic-r" => "emphatic-r",
        "minus" => "minus",
        "slider" => "slider",
        "slider-r" => "slider-r",
        "spin" => "spin",
        "spin-r" => "spin-r",
        "spring" => "spring",
        "spring-r" => "spring-r",
        "stand" => "stand",
        "stand-r" => "stand-r",
        "squeeze" => "squeeze",
        "vortex" => "vortex",
        "vortex-r" => "vortex-r",
      ],
      '#size' => 1,
      '#default_value' => $this->configuration['icon_style'],
    ];

    $form['link_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link URL'),
      '#description' => $this->t('The URL / anchor of the link for the target of this hamburger icon.'),
      '#default_value' => $this->configuration['link_url'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];


    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state)
  {
    $this->configuration['icon_style'] = $form_state->getValue('icon_style');
    $this->configuration['link_url'] = $form_state->getValue('link_url');
    parent::blockSubmit($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function build()
  {

    // Remember, every # variable that you pass to the build will also need to
    // be registered in the hook_theme() function!
    $build = [];

    // This will potentially need to be fixed.
    $url = Url::fromUserInput($this->configuration['link_url']);

    $hamburger_inner  = [
      '#markup' => '<span class="hamburger-box"><span class="hamburger-inner"></span></span>',
    ];

    $build[] = [
      '#theme' => 'hamburger_block',
      '#hamburger_icon' => [
        '#type' => 'link',
        '#title' => $hamburger_inner,
        '#url' => $url,
        '#attributes' => [
          'class' => [
            'hamburger--' . $this->configuration['icon_style'],
            'hamburger',
          ],
          'data-toggle' => 'collapse',
          'type' => 'button',
        ],
      ],
    ];


    return $build;
  }
}