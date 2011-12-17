<?php

namespace Aizatto\Bundle\XHPBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use xhp_symfony__base;
use xhp_x__base;

class AizattoXHPBundle extends Bundle
{

  public function boot() {
    xhp_symfony__base::setContainer($this->container);
    xhp_x__base::$ENABLE_VALIDATION =
      $this->container->get('kernel')->isDebug();
  }

}
