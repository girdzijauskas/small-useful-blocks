<?php

namespace Drupal\social_media_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a 'SocialMediaBlock' block.
 *
 * @Block(
 *  id = "social_media_block",
 *  admin_label = @Translation("Social media block"),
 * )
 */
class SocialMediaBlock extends BlockBase {

  /**
  * {@inheritdoc}
  */
  public function defaultConfiguration()
  {
    return [
      'linkedin_icon' => 'fa-linkedin-in',
      'linkedin_url' => 'https://www.linkedin.com/company/the-wbs-group/',
      'twitter_icon' => 'fa-twitter',
      'twitter_url' => 'https://twitter.com/thewbsgroup',
      'facebook_icon' => 'fa-facebook-f',
      'facebook_url' => 'https://www.facebook.com/TheWBSGroup/',
      'youtube_icon' => 'fa-youtube',
      'youtube_url' => 'https://www.youtube.com/',
    ] + parent::defaultConfiguration();
  }

  /**
  * {@inheritdoc}
  */
  public function blockForm($form, FormStateInterface $form_state)
  {
    $form['linkedin_icon'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Linkedin Icon'),
      '#description' => $this->t('Enter the class used for the linkedin icon. FontAwesome usage is assumed.'),
      '#default_value' => $this->configuration['linkedin_icon'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    $form['linkedin_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Linkedin Url'),
      '#description' => $this->t('Enter the URL to be used for the Linkedin icon.'),
      '#default_value' => $this->configuration['linkedin_url'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    $form['twitter_icon'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Twitter Icon'),
      '#description' => $this->t('Enter the class used for the Twitter icon.'),
      '#default_value' => $this->configuration['twitter_icon'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    $form['twitter_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Twitter Url'),
      '#description' => $this->t('Twitter URL'),
      '#default_value' => $this->configuration['twitter_url'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    $form['facebook_icon'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Facebook Icon'),
      '#description' => $this->t('Facebook Icon'),
      '#default_value' => $this->configuration['facebook_icon'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    $form['facebook_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Facebook Url'),
      '#description' => $this->t('Facebook URL'),
      '#default_value' => $this->configuration['facebook_url'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    $form['youtube_icon'] = [
      '#type' => 'textfield',
      '#title' => $this->t('YouTube Icon'),
      '#description' => $this->t('Youtube Icon'),
      '#default_value' => $this->configuration['youtube_icon'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    $form['youtube_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('YouTube Url'),
      '#description' => $this->t('YouTube Url'),
      '#default_value' => $this->configuration['youtube_url'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * Generates a link out of the URL of a social media platform.
   */
  public function generateLink($uri, $icon) {
    $url = Url::fromUri($uri);

    $link = [
      '#theme' => 'social_media_link',
      '#icon' => $icon,
      '#uri' => $url,
    ];

    return $link;
  }

  /**
  * {@inheritdoc}
  */
  public function blockSubmit($form, FormStateInterface $form_state)
  {
    $this->configuration['linkedin_icon'] = $form_state->getValue('linkedin_icon');
    $this->configuration['linkedin_url'] = $form_state->getValue('linkedin_url');
    $this->configuration['twitter_icon'] = $form_state->getValue('twitter_icon');
    $this->configuration['twitter_url'] = $form_state->getValue('twitter_url');
    $this->configuration['facebook_icon'] = $form_state->getValue('facebook_icon');
    $this->configuration['facebook_url'] = $form_state->getValue('facebook_url');
    $this->configuration['youtube_icon'] = $form_state->getValue('youtube_icon');
    $this->configuration['youtube_url'] = $form_state->getValue('youtube_url');
  }

  /**
  * {@inheritdoc}
  */
  public function build() {
    $build = [];

    $build['#theme'] = 'social_media_block';

    $build['#linkedin_link'] = $this->generateLink(
      $this->configuration['linkedin_url'], 
      $this->configuration['linkedin_icon']
    );

    $build['#twitter_link'] = $this->generateLink(
      $this->configuration['twitter_url'], 
      $this->configuration['twitter_icon']
    );

    $build['#facebook_link'] = $this->generateLink(
      $this->configuration['facebook_url'], 
      $this->configuration['facebook_icon']
    );

    $build['#youtube_link'] = $this->generateLink(
      $this->configuration['youtube_url'], 
      $this->configuration['youtube_icon']
    );
    
    return $build;
  }
}
