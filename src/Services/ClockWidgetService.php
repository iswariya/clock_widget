<?php

namespace Drupal\clock_widget\Services;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Class ClockWidgetService.
 *
 * @package Drupal\clock_widget\Services
 */
class ClockWidgetService {
  
  /**
   * The config factory interface.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;
  
  /**
   * Constructor.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }
  
  /**
   * Gets my setting.
   */
  public function getDateTime() {
    $date = new DrupalDateTime();
    $date->setTimezone(new \DateTimeZone('Asia/Kolkata'));
    return $date->format('m/d/Y g:i a');
  }
  
}