<?php

namespace Drupal\clock_widget\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\clock_widget\Services\ClockWidgetService;

/**
 * Defines ClockWidgetController class.
 */
class ClockWidgetController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Clock widget service.
   *
   * @var \Drupal\clock_widget\ClockWidgetService
   */
  private $clockWidgetService;

  /**
   * {@inheritdoc}
   */
  public function __construct(ClockWidgetService $clock_widget_service) {
    $this->clockWidgetService = $clock_widget_service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('clock_widget.service')
    );
  }

  /**
   * Time based on user selected timezone.
   *
   * @return array
   *   Return markup array.
   */
  public function getDateTime() {
    return [
      '#type' => 'markup',
      '#markup' => $this->clockWidgetService->getDateTime()['date_time'],
    ];
  }

}
