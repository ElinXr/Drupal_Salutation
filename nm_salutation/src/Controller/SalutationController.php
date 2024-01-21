<?php

namespace Drupal\nm_salutation\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\nm_salutation\Salutation;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller which provides the salutation message.
 */
class SalutationController extends ControllerBase {
  /**
   * The Salutation service.
   * @var \Drupal\nm_salutation\Salutation
   */
  protected Salutation $salutation;

  /**
   * SalutationController's constructor.
   *
   * @param \Drupal\nm_salutation\Salutation $salutation
   */
  public function __construct(Salutation $salutation) {
    $this->salutation = $salutation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('nm_salutation.messages')
    );
  }

  /**
   * Display the salutation message.
   *
   * @return array
   *   Return markup array.
   */
  public function showMessage() {
    return [
      '#type' => 'markup',
      '#markup' => $this->salutation->getSalutation(),
    ];
  }

}
