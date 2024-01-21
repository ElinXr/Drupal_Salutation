<?php

namespace Drupal\nm_salutation;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Prepares the salutation to the world.
 */
class Salutation {

  use StringTranslationTrait;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected ConfigFactoryInterface $configFactory;

  /**
   * Salutation constructor.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Prepares the salutation to the end user.
   */
  public function getSalutation() {
    $config = $this->configFactory->get('nm_salutation.settings');
    $time = new \DateTime();
    $salutationMessage = '';

    if ((int) $time->format('G') >= 00 && (int) $time->format('G') < 12) {
      $salutationMessage = $config->get('morning_salutation');
    }

    elseif ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      $salutationMessage = $config->get('afternoon_salutation');
    }

    elseif ((int) $time->format('G') >= 18) {
      $salutationMessage = $config->get('evening_salutation');
    }
    return $salutationMessage;
  }

}
