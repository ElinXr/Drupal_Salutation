<?php

namespace Drupal\nm_salutation\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\nm_salutation\Salutation;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block to display a salutation message to the end user.
 *
 * @Block(
 *   id = "salutation_block",
 *   admin_label = @Translation("Salutation Message"),
 * )
 */
class SalutationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Stores the salutation object.
   *
   * @var \Drupal\nm_salutation\Salutation
   */
  protected Salutation $salutation;

  /**
   * Creates a SalutationBlock instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, Salutation $salutation) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->salutation = $salutation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('nm_salutation.messages')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build = [];

    $build['content'] = [
      '#theme' => 'salutation_text',
      '#salutation_text' => $this->salutation->getSalutation(),
    ];

    return $build;
  }

}
