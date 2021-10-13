<?php

declare(strict_types=1);

/*
 * @author  Moritz Vondano
 * @license LGPL-3.0-or-later
 */

namespace Mvo\ContaoXdebug\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class StripCookieListener
{
    public function __invoke(RequestEvent $event): void
    {
        $method = method_exists($event, 'isMainRequest') ? 'isMainRequest' : 'isMasterRequest';

        if (!$event->$method()) {
            return;
        }

        $event->getRequest()->cookies->remove('XDEBUG_SESSION');
    }
}
