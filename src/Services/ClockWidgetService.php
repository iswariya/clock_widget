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
   * Date Time based on user selected timezone.
   */
  public function getDateTime() {
    $date = new DrupalDateTime();
    $date->setTimezone(new \DateTimeZone($this->configFactory->get('clock_widget.settings')->get('clock_widget_timezone')));
    return [
      'date_time' => $date->format('jS M Y g:i A'),
      'date' => $date->format('l\, j F Y'),
      'time' => $date->format('g:i a'),
    ];
  }
  
}