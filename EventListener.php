<?php

namespace Aizatto\Bundle\XHPBundle;

use xhp_symfony__base;
use xhp_x__base;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class EventListener {

  public function __construct($container) {
    $this->container = $container;
  }

  public function onKernelRequest(GetResponseEvent $event) {
    xhp_symfony__base::setContainer($this->container);
    xhp_x__base::$ENABLE_VALIDATION =
      $this->container->get('kernel')->isDebug();
  }

}
