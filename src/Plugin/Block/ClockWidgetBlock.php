<?php

namespace Drupal\clock_widget\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\clock_widget\Services\ClockWidgetService;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Provides a 'Clock Widget' Block.
 *
 * @Block(
 *   id = "clock_widget_block",
 *   admin_label = @Translation("Clock Widget Block"),
 *   category = @Translation("Clock Widget"),
 * )
 */
class ClockWidgetBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Clock widget service.
   *
   * @var \Drupal\clock_widget\ClockWidgetService
   */
  private $clockWidgetService;

  /**
   * Config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  private $configFactory;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ClockWidgetService $clock_widget_service, ConfigFactoryInterface $config_factory) {
    $this->clockWidgetService = $clock_widget_service;
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('clock_widget.service'),
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'clock_widget',
      '#country' => $this->configFactory->get('clock_widget.settings')->get('clock_widget_country'),
      '#city' => $this->configFactory->get('clock_widget.settings')->get('clock_widget_city'),
      '#date' => $this->clockWidgetService->getDateTime()['date'],
      '#time' => $this->clockWidgetService->getDateTime()['time'],
    ];
  }

  /**
   * Disable cache.
   *
   * @return int
   *   A integer value.
   */
  public function getCacheMaxAge() {
    return 0;
  }

}
